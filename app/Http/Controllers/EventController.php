<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\event;
use App\Models\User;
use App\Models\user_action;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\user_actionController;
use App\Http\Controllers\CalendarController;
use App\Models\Notification;
use App\Models\event_user;
use App\View\Components\CommonLayout;


class EventController extends Controller
{
    public static $links = array(
            'code-hubs-and-hackatons'      => 1,
            'workshops-and-company-events' => 2,
            'parties-and-more'             => 3
        );

    public static function getTypes()
    {
        $types = array();

        foreach (static::$links as $name => $id)
        {
            $types[$id] = ucfirst(str_replace('-', ' ', $name));
        }

        return $types;
    }

    public static function index($type = null)
    {
        $return = [
            'links'    => static::$links,
            'footer'   => CommonLayout::footer(),
            'calendar' => CalendarController::index()
        ];

        if (isset($type) && in_array($type, array_keys(static::$links)))
        {
            $return['uri']    = "events/$type";
            $return['type']   = str_replace('and', '&', str_replace('-', ' ', $type));
            $return['events'] = event::where('type', static::$links[$type])->paginate(5);
        } else {
            $return['uri']    = "events";
            $return['type']   = "all Events";
            $return['events'] = event::orderBy('date', 'desc')->paginate(5);
        }

        foreach ($return['events'] as &$event)
        {
            $event->link = ItemController::prepareLink($event->name);
        }

        return view('common.events')->with($return);
        
    }

    public function create(User $user, array $request)
    {
        if ($user->position->create_events)
        {
            $event = EventController::setEventColumns($user, new Event, $request);

            $event->user_id = $user->id;
            isset($request['image']) ? $event->image = ItemController::imageRequestStore($event, array($request['image']), 'item_cover') : null;

            $event->save();

            for ($i = 0; $i < 4; $i++)
            {
                if (isset($request["post_image_$i"]))
                {
                    ItemController::imageRequestStore($event, array($request["post_image_$i"]), 'event');
                } else {
                    break;
                }
            }

            user_actionController::create($user->id, $event->id, 'event', 'created');

            return response()->json([
                'redirect' => '/event/' . ItemController::prepareLink($event->name) . "/?id={$event->id}"
            ]);
        }
    }

    public function show($name)
    {
        if (isset($_GET) && isset($_GET['id']))
        {
            $event = event::find(filter_var($_GET['id'], FILTER_VALIDATE_INT));

            if (isset($event))
            {
                $event->description = ItemController::renderCode($event->description);

                return view('common.item')->with([
                    'date'    => time(),
                    'item'    => $event,
                    'updates' => \App\Models\user_action::where([
                                    'item_id'   => $event->id,
                                    'item_type' => 'event',
                                    'action'    => 'updated'
                                ])->orderBy('created_at', 'desc')->get(),
                    'type'    => EventController::getTypes()[$event->type],
                    'footer'  => CommonLayout::footer()
                ]);
            }
        }

        return redirect(route('events'));
    }

    public function subscribe(User $user, Request $request)
    {
        $event = event::find($request->event_id);

        if (isset($event) && !EventController::eventUserExists($user->id, $event->id))
        {
            event_user::create(['user_id' => $user->id, 'event_id' => $event->id]);

            $action = user_action::create(['user_id' => $user->id, 'item_id' => $event->id, 'item_type' => 'event', 'action' => 'signed up for']);

            $event->author->id != $user->id ? Notification::create(['user_id' => $event->author->id, 'action_id' => $action->id]) : null;

            $avatar = isset($user->avatar) ? ('/public/images/avatars/' . $user->avatar) : ('/public/images/avatars/generic.svg');

            return response()->json([
                'status'  => 'success',
                'message' => 'You have successfully signed up for this event.',
                'html'    => EventController::altButtonHtml($user->id, $event->id, 'subscribe'),
                'avatar'  => "<a class='avatar bg-neutral w-14 h-14 border-2 border-neutral attendee' href='/member/$user->username' title='$user->name ($user->username)' data-id='$user->id'>
                                <img class='m-0' src='$avatar' />
                              </a>"
            ]);
        }

        return response()->json([
            'status'  => 'error',
            'message' => 'You are not authorized to sign up for this event.'
        ]);
    }

    public function unSubscribe(User $user, Request $request)
    {
        $event = event::find($request->event_id);

        if (isset($event))
        {
            if (EventController::eventUserExists($user->id, $event->id))
            {
                event_user::where(['user_id' => $user->id, 'event_id' => $event->id])->delete();

                $action = user_action::create(['user_id' => $user->id, 'item_id' => $event->id, 'item_type' => 'event', 'action' => 'is no longer planning to attend']);
                $event->author->id != $user->id ? Notification::create(['user_id' => $event->author->id, 'action_id' => $action->id]) : null;

                return response()->json([
                    'status'  => 'success',
                    'message' => 'You have successfully unsubscribed.',
                    'html'    => EventController::altButtonHtml($user->id, $event->id, 'unsubscribe')
                ]);
            }
        }

        return response()->json([
            'status'  => 'error',
            'message' => 'You are not authorized to make this request.'
        ]);
    }

    private function EventUserExists($user_id, $event_id)
    {
        return event_user::where(['user_id' => $user_id, 'event_id' => $event_id])->count();
    }

    private function altButtonHtml($user_id, $event_id, $action)
    {
        $btn_action = $action == 'unsubscribe' ? 'subscribe' : 'unsubscribe';
        
        $btn_text   = $btn_action == 'subscribe' ? "I'll be attending" : 'No longer interrested';
        $btn_class  = $btn_action == 'subscribe' ? 'btn-success' : 'btn-error';
        $btn_icon   = $btn_action == 'subscribe' ? "<svg class='h-4 fill-current relative' style='top: -1px;' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M128 447.1V223.1c0-17.67-14.33-31.1-32-31.1H32c-17.67 0-32 14.33-32 31.1v223.1c0 17.67 14.33 31.1 32 31.1h64C113.7 479.1 128 465.6 128 447.1zM512 224.1c0-26.5-21.48-47.98-48-47.98h-146.5c22.77-37.91 34.52-80.88 34.52-96.02C352 56.52 333.5 32 302.5 32c-63.13 0-26.36 76.15-108.2 141.6L178 186.6C166.2 196.1 160.2 210 160.1 224c-.0234 .0234 0 0 0 0L160 384c0 15.1 7.113 29.33 19.2 38.39l34.14 25.59C241 468.8 274.7 480 309.3 480H368c26.52 0 48-21.47 48-47.98c0-3.635-.4805-7.143-1.246-10.55C434 415.2 448 397.4 448 376c0-9.148-2.697-17.61-7.139-24.88C463.1 347 480 327.5 480 304.1c0-12.5-4.893-23.78-12.72-32.32C492.2 270.1 512 249.5 512 224.1z'/></svg>"
                                                 : "<svg class='h-4 fill-current relative' style='top: -1px;' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M119.4 44.1C142.7 40.22 166.2 42.2 187.1 49.43L237.8 126.9L162.3 202.3C160.8 203.9 159.1 205.1 160 208.2C160 210.3 160.1 212.4 162.6 213.9L274.6 317.9C277.5 320.6 281.1 320.7 285.1 318.2C288.2 315.6 288.9 311.2 286.8 307.8L226.4 209.7L317.1 134.1C319.7 131.1 320.7 128.5 319.5 125.3L296.8 61.74C325.4 45.03 359.2 38.53 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 0 232.4 0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.09V44.1z'/></svg>";

        return "<button class='modal-button btn btn-sm text-sm btn-outline $btn_class' onclick='subscribe($user_id, $event_id, `events-{$btn_action}`)' id='event-action'>
                    $btn_text &nbsp;$btn_icon
                </button>";
    }

    public function hasPermission(User $user, Event $event, string $permission)
    {
        return isset($user->position) && ($user->position->$permission || $user->id == $event->user_id) ? $event : null;
    }

    public function update(User $user, array $request)
    {
        $event = event::find($request['id']);

        if (isset($event) && EventController::hasPermission($user, $event, 'edit_events'))
        {
            $event = EventController::setEventColumns($user, $event, $request);

            if (isset($request['image']))
            {
                $event->image = ItemController::imageRequestStore($event, array($request['image']), 'image');
                ImageController::logDeleted($user->id, $event->author->id, "event_covers/$event->image");
            }

            $event->save();

            user_actionController::create($user->id, $event->id, 'event', 'updated');

            $image_lim = 5 - (isset($event->images) ? $event->images->count() : 0);

            for ($i = 0; $i < $image_lim; $i++)
            {
                if (isset($request["post_image_$i"]))
                {
                    ItemController::imageRequestStore($event, array($request["post_image_$i"]), 'event');
                } else {
                    break;
                }
            }

            return response()->json([
                'redirect' => '/event/' . ItemController::prepareLink($event->name) . "/?id={$event->id}"
            ]);
        }
    }

    public function delete(User $user, Request $request)
    {
        $event = event::find($request->id);

        if (isset($event) && EventController::hasPermission($user, $event, 'delete_events'))
        {
            $action    = user_actionController::create($user->id, $event->id, 'event', 'deleted');
            $author    = $event->author;
            $deleteLog = \App\Models\DeleteLog::create([
                'user_id'   => $user->id,
                'action_id' => $action->id,
                'item'            => json_encode([
                    'name'        => $event->name,
                    'intro'       => $event->intro,
                    'description' => $event->description,
                    'place'       => $event->place,
                    'date'        => $event->date,
                    'type'        => $event->type,
                    'author'      => [
                        'id'       => $author->id,
                        'name'     => $author->name,
                        'username' => $author->username
                    ]
                ])
            ]);

            $deleteLog->save();

            if (isset($event->image))
            {
                ImageController::logDeleted($user->id, $author->id, "item_covers/$event->image", $log_id = $deleteLog->id);

                $delete = new Request(['images' => [$event->image], 'type' => 'item_cover']);
                ImageController::delete($delete);
            }

            if (isset($event->images))
            {
                foreach ($event->images as $image)
                {
                    ImageController::logDeleted($user->id, $author->id, "events/$image->src", $log_id = $deleteLog->id);
                }

                $delete = new Request(['images' => $event->images->pluck('src')->all(), 'type' => 'event']);
                ImageController::delete($delete);
            }

            $event->delete();

            return response()->json(['redirect' => '/events']);
        }

    }

    private function setEventColumns(User $user, Event $event, array $request)
    {        
        $request['description'] = ItemController::normalizeHTML($request['description']);

        $columns = array('name', 'intro', 'description', 'place', 'date');

        foreach ($request as $key => $value)
        {
            isset($value) && in_array($key, $columns) && $event->$key != $value ? $event->$key = strip_tags($value) : null;
        }

        $event->type        = array_search($request['type'], EventController::getTypes());
        $event->description = ItemController::normalizeHTML($event->description, true);

        return $event;
    }

}
