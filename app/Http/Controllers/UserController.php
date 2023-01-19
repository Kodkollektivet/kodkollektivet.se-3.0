<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\role;
use App\Models\Position;
use App\Models\Follows;

use Illuminate\Http\Request;
use App\Http\Controllers\ItemController;


class UserController extends Controller
{
    public function index(string $role = null, User $user = null) {

        $users = !isset($role) || $role == 'All' ? User::all()
                                : (role::where('name', $role)->first());

        if (isset($users) || $role == 'open-positions') {
            
            $open_positions = \App\Http\Controllers\PositionController::index();

            $return = array(
                'roles'      => role::all(),
                'user_total' => User::all()->count(),
                'footer'     => \App\View\Components\CommonLayout::footer(),
                'op_total'   => $open_positions->count()
            );

            $return['users'] = isset($users->users) ? $users->users : $users;
            
            if ($role == 'open-positions') {
                $return['positions']          = $open_positions;
                $return['view_applicants']    = isset($user) && ($user->role_id == 1 || $user->position_id == 14);
                $return['application_decide'] = isset($user->position) && $user->position->application_decide;
            }

            return view('user.listing.' . ($role == 'open-positions' ? $role : 'users'))->with($return);

        } else {
            return redirect()->route('members', ['role' => 'All']);
        }
    }

    public function single(string $username, string $page = 'main', string $tag = null, User $user_check = null) {

        $pre_user = User::where('username', $username)->first();
        $user     = isset($pre_user) ? $pre_user : (isset($user_check) ? $user_check : null);

        if (isset($user)) {
            $posts = $user->posts();

            if (in_array($page, ['main', 'other-activity']) && !$user->remove_data) {
            
                if ($page == 'main') {
                    $actions         = $user->actions;
                    $community_posts = $posts->where('community', 1)->orderBy('created_at', 'desc')->take(2)->get();
                    $personal_posts  = $user->posts()->whereNull('community')->orderBy('created_at', 'desc')->take(2)->get();
                    $techs           = \App\Http\Controllers\TechnologyController::userTech($user->technologies);
    
                    foreach ([$community_posts, $personal_posts] as &$type) {
                        foreach ($type as &$item) {
                            $item->link = ItemController::prepareLink($item->name);
                        }
                    }
                    
                } else {
                    $actions = $user->actions(false);
                }
    
                foreach ($actions as &$action) {
                    $action = \App\Http\Controllers\user_actionController::userActionActual($action);
                }
            }
    
            if ($page == 'notifications' && isset($user_check) && $user_check->username == $user->username) {
                $notifications = NotificationController::addActual($user->notifications->whereNull('viewed'));
            }
     
            return view("user.{$page}")->with([
                'user'                 => $user,
                'routes'               => ['Community Posts', 'Personal Posts', 'Other Activity'],
                'footer'               => \App\View\Components\CommonLayout::footer(),
                'community_post_count' => $posts->where('community', 1)->count(),
                'community_posts'      => isset($community_posts) ? $community_posts : null,
                'personal_posts'       => isset($personal_posts)  ? $personal_posts  : (
                                            $page == 'personal-posts' ? (!isset($tag) ? \App\Http\Controllers\PostController::index(null, $user->username, false) :
                                                \App\Http\Controllers\PostController::index($tag, $user->username, false)) : null
                                          ),
                'actions'              => isset($actions) ? $actions : null,
                'techs'                => isset($techs) && count($techs) ? $techs : null,
                'notifications'        => isset($notifications) ? $notifications : null,
                'allow_ban'            => isset($user_check) ? UserController::checkCanBan($user_check, $user) : false,
                'following'            => $user_check ? UserController::checkFollowing($user_check, $user) : null
            ]);

        }
        
        return redirect('/members');
    }

    public function allowedRoles(User $user) {
        return $user->role_id == 1 ? [$user->role, role::where('id', 2)->first(), role::where('id', 3)->first()] : [$user->role];
    }

    public function allowedPositions(User $user) {
        return in_array($user->position_id, [1, 2]) || $user->role_id == 3 ? Position::all() : [$user->position];
    }

    public function verify(User $user, string $key) {

        if ($user->role_id == 4 && $key == $user->verification) {
            $user->role_id = 2;
            $user->company ? $user->position_id = 16 : null;
            $user->email_verified_at = time();
            $user->save();

            return redirect("/edit-profile/?prompt=true");
        }

        return redirect("/member/$user->username");
    }

    public function update(array $request, User $user)
    {
        $user_columns    = \Illuminate\Support\Facades\Schema::getColumnListing('users');
        $profile_columns = \Illuminate\Support\Facades\Schema::getColumnListing('user_profiles');
        $profile         = \App\Models\UserProfile::where('user_id', $user->id)->first();

        while (isset($request['cover']) || isset($request['avatar'])) {

            $type    = isset($request['cover']) ? 'cover' : 'avatar';
            $data    = UserController::imageRequestStore($user, $request, $type);
            $request = $data->request;
            !isset($response) ? $response = array($type => $data->titl) : $response[$type] = $data->titl;
        }

        if (isset($request['role'])) {

            $role = role::where('name', $request['role'])->first();

            in_array($role, UserController::allowedRoles($user)) ? $request['role_id'] = $role->id : null;

            unset($request['role']);
        }

        if (isset($request['position'])) {

            $position = Position::where('name', $request['position'])->first();

            in_array($position, UserController::allowedPositions($user)) ? $request['position_id'] = $position->id
                        : ($request['position'] == 'Unspecified' ? $request['position_id'] = null : null);

            unset($request['position']);
        }

        if (isset($request['role_id'])) {
            $user->role_id == 1 && $request['role_id'] == 2 ? $request['position_id'] = null : null;
            $user->role_id == 1 && in_array($request['role_id'], [2, 3]) ? $request['date_ended'] = date('Y-m-d') : null;
        }
        
        isset($request['password']) ? $request['password'] = \Illuminate\Support\Facades\Hash::make($request['password']) : null;

        foreach ($request as $key => $value) {
            in_array($key, $user_columns) ? $user->$key = $value : (
            in_array($key, $profile_columns) ? $profile->$key = $value : null);
        }

        $profile->about = ItemController::normalizeHTML(strip_tags($profile->about), true);

        $user->save();
        $profile->save();

        return isset($response) ? response()->json($response) : null;
    }

    public function activityToggle(User $user) {
        $user->activity_hide = !$user->activity_hide;
        $user->save();

        $comment = '&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;';

        return response()->json(
            $user->activity_hide ? ['comment' => "$comment hidden from non-admins", 'button' => 'Display for everyone']
                                 : ['comment' => "$comment visible to everyone",    'button' => 'Hide my activity']
        );
    }

    public function destroy(User $user)
    {
        //
    }

    public function toggleBan(User $user, Request $request)
    {
        $ban_user = User::find($request->id);

        if (isset($ban_user) && isset($user->position_id) && UserController::checkCanBan($user, $ban_user)) {

            $action_text = $ban_user->role_id == 5 ? 'unban' : 'ban';

            $ban_user->role_id = $ban_user->role_id == 5 ? 2 : 5;
            $ban_user->position_id = null;
            $ban_user->save();

            $action = \App\Models\user_action::create(['user_id' => $user->id, 'item_id' => $ban_user->id, 'item_type' => 'user', 'action' => "{$action_text}ned"]);
            \App\Models\Notification::create(['user_id' => $ban_user->id, 'action_id' => $action->id]);

            return response()->json([
                'message' => "User $$ban_user->username has been $action_text!",
                'role'    => $ban_user->role->name,
                'button'  => $action_text == 'ban' ? 'unban' : 'ban',
                'confirm' => "Are you sure you want to $action_text {$ban_user->username}? ". 
                    ($action_text == 'unban' ? "Their role will be set to 'member'." : "They won't be able to use any of the website's functionality.")
            ]);
        }
    }

    public function toggleFollow(User $user, Request $request) {

        $follow_user = User::find($request->id);

        if (isset($follow_user)) {

            $following = UserController::checkFollowing($user, $follow_user);

            if ($following) {

                Follows::where('follower', $user->id)->where('following', $follow_user->id)->first()->delete();

                $response = ['button' => '<svg class="mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" height="24" viewBox="0 0 24 24"><path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg> Follow'];
                
            } else {

                $action   = \App\Models\user_action::create(['user_id'  => $user->id, 'item_id' => $follow_user->id, 'item_type' => 'user', 'action' => 'followed']);
                            \App\Models\Notification::create(['user_id' => $follow_user->id, 'action_id' => $action->id]);
                $response = ['button' => '<span class="text-xl font-bold my-0 mr-2 leading-4">– </span> Unfollow'];

                Follows::create(['follower' => $user->id, 'following' => $follow_user->id]);
            }
                       
            return response()->json($response);
        }
    }

    private function checkFollowing(User $user, User $follow_user) {

        $following_all = $user->following->pluck('username')->all();
        
        return in_array($follow_user->username, $following_all);
    }

    private function checkCanBan(User $user, User $ban_user) {

        return $user->id != $ban_user->id && isset($user->position) && $user->position->ban && !($user->position_id == 14 && $ban_user->position_id == 14)
            && ($ban_user->role_id != 1 || in_array($user->position_id, [1, 2]));   // Cannot ban self; mods cannot ban mods
    }                                                                               // cannot ban board unless president, vice

    private function imageRequestStore($user, $request, $type) {
        
        $store         = new Request();
        $store->images = array($request[$type]);
        $store->type   = $type;

        unset($request[$type]);

        $delete_image = isset($user->$type) ? $user->$type : (isset($user->profile->$type) ? $user->profile->$type : null);

        if (isset($delete_image)) {
            $delete         = new Request();
            $delete->images = array($delete_image);
            $delete->type   = $type;

            \App\Http\Controllers\ImageController::delete($delete);
        }

        $titl = \App\Http\Controllers\ImageController::store($user, $store);

        return (object) array('request' => $request, 'titl' => $titl);
    }

    private function getNames($data) {
        $names = array();

        foreach ($data as $item) {
            array_push($names, $item->name);
        }

        return implode(',', $names);
    }

}
