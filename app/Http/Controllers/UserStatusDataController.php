<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


class UserStatusDataController extends Controller
{
    public function closeAccount(User $user) {
        $user->closed = true;
        $user->save();

        AuthenticatedSessionController::destroy(app()->request);
    }

    public function requestRemoveData(User $user) {
        $user->remove_data = true;
        $user->save();
    }

    public function removeData(User $user) {
        $user->email = 'Data removed';
        $user->name = 'Data removed';
        $user->role_id = 5;
        $user->avatar = null;
        $user->position_id = null;
        $user->save();

        foreach ($user->profile as &$value) {
            $value = null;
        }
        $profile->save();

        foreach ($user->posts as $post) {
            !$post->community ? $post->delete() : null;
        }

        foreach ($user->actions as $action) {
            $action->delete();
        }
    }

}
