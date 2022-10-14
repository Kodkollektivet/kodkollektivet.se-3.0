<?php

namespace App\Http\Controllers\Forms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TechnologyController;



class ProfileFormController extends Controller
{

    public static $prompt = '<b>Heads up!</b> Looks like you joined us recently; please, take the time to complete your profile 😗';

    public static function editProfileForm(User $user) {

        $date = date('Y-m-d', strtotime('7 days ago'));

        return !$user->remove_data && !in_array($user->role_id, [4, 5]) ? view('forms.profile')->with([

            'footer'    => \App\View\Components\CommonLayout::footer(),
            'user'      => $user,
            'data'      => $user->profile,
            'roles'     => UserController::allowedRoles($user),
            'positions' => UserController::allowedPositions($user),
            'tech_types'=> TechnologyController::getAllowedTypes(),
            'tech'      => TechnologyController::index($user),
            'prompt'    => isset($_GET['prompt']) && ($user->email_verified_at >= $date || $user->created_at >= $date) ? static::$prompt : null,
            
        ]) : redirect('/member');
    }

    public function updateProfile(User $user) {
        if (!$user->remove_data && !in_array($user->role_id, [4, 5])) {

            app()->request = ProfileFormController::unsetUnchanged(app()->request, $user);
            $validated     = app()->make(\App\Http\Requests\ProfileFormRequest::class)->all();  // create and validate
    
            isset($validated['email']) ? $validated['email'] = \App\Http\Controllers\EmailController::verify($validated['email']) : null;
    
            return UserController::update($validated, $user);
        }
    }

    private function unsetUnchanged(Request $request, User $user) {   
        $profile = $user->profile;

        foreach ($request->all() as $key => $value) {
            
            if (($user->$key == $value || $profile->$key == $value) && isset($value)) {
                unset($request[$key]);
            }
        }

        return $request;
    }

}
