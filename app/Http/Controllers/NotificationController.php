<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;


class NotificationController extends Controller
{

    public function markViewed(User $user, Request $request) {

        $notification = Notification::find($request->id);

        if (isset($notification) && $notification->user->id == $user->id) {
            $notification->viewed = true;
            $notification->save();
        }

    }

    public function indexLastWeek(User $user) {

        $notifications = NotificationController::addActual(Notification::where('user_id', $user->id)->where('viewed', 1)->where('created_at', '>=', date('Y-m-d', strtotime('7 days ago')))->get());

        return isset($notifications) ? response()->json(['html' => NotificationController::renderHTML($notifications)]) : null;
    }

    public function addActual(object $notifications = null) {

        if (isset($notifications) && $notifications->count()) {
            foreach ($notifications as &$notif) {
                $notif->action = \App\Http\Controllers\user_actionController::userActionActual($notif->action);
            }

            return $notifications;
        }

        return null;
    }

    private function renderHTML(object $notifications) {

        $html = "<tr class='bg-base-300 text-gray-500 mb-4 border-b rounded-t-2xl border-gray-800 notif-old'>
                    <td class='p-3 uppercase font-bold'>Viewed</td>
                 </tr>";

        foreach ($notifications as $notif) {
            
            $html .= "<tr class='bg-base-100 bg-none transition ease-in-out duration-300 hover:bg-neutral  border-0 appearance-none overflow-hidden notif-old'>
                        <td class='appearance-none p-3 dropdown dropdown-hover border-0'>
                            <a href='/member/". $notif->action->user->username ."' class='text-gray-500 font-semibold transition ease-in-out duration-200'>".
                                $notif->action->user->username ."&nbsp;
                            </a>". (isset($notif->action->actual) ? $notif->action->action .' '. $notif->action->item_type .": <a class='transition ease-in-out duration-200' href='/". $notif->action->actual->link ."'>". $notif->action->actual->name ."</a>"
                            : (isset($notif->action->deleteLog) ? $notif->action->action. " your ". $notif->action->item_type .":". json_decode($notif->action->deleteLog->item)->name
                            : $notif->action->action . " your ". $notif->action->item_type)) .".
                        </td>
                      </tr>";
        }

        return htmlspecialchars_decode($html);
    }

}
