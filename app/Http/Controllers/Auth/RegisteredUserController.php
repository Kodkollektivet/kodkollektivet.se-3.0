<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;


use App\Http\Controllers\EmailController;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:25', 'min:3'],
            'username' => ['required', 'string', 'max:25', 'min:3', 'unique:users', 'alpha_dash'],
            'email'    => ['required', 'string', 'email', 'max:50', 'min:9', 'unique:users'],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'company'  => ['nullable', 'in:on,off']
        ]);

        $invite = \App\Models\Invite::where(['sent_to' => $request->email])->first();
        
        if (isset($invite) && !$invite->accepted)
        {
            $invite->accepted = true;
            $invite->save();
        } elseif(!isset($invite))
        {
            $request->email = EmailController::verify($request->email);
        } else {
            throw \Illuminate\Validation\ValidationException::withMessages(['email' => 'Email already in use or previous registration attempt failed.']);
        }

        $company = $request->company == 'on';

        $user = \App\Models\User::create([
            'name'         => $request->name,
            'username'     => $request->username,
            'email'        => $request->email,
            'password'     => \Illuminate\Support\Facades\Hash::make($request->password),
            'company'      => $company,
            'role_id'      => strpos($request->email, 'lnu.se') || isset($invite) ? 2 : 4,
            'position_id'  => $company && isset($invite) ? 16 : null,
            'verification' => !$company && !(strpos($request->email, 'lnu.se') || isset($invite)) ? uniqid("{$request->username}_", true) : null,
            'online'       => 1
        ]);

        isset($user->verification) && !$user->company ? EmailController::sendVerificationEmail($user->email, $user->verification)
                                                      : (isset($user->verification) && $user->company ? EmailController::sendCompanyNotification($user->email) : null);
        
        if (isset($invite))
        {
            $action = \App\Models\user_action::create(['user_id' => $user->id, 'item_id' => $invite->id, 'item_type' => 'invite', 'action' => 'accepted']);
                      \App\Models\Notification::create(['user_id' => $invite->author->id, 'action_id' => $action->id]);

            EmailController::sendInviteAccepted($invite->author, $user);
        }

        event(new \Illuminate\Auth\Events\Registered($user));
        \App\Models\UserProfile::create(['user_id' => $user->id]);

        \Illuminate\Support\Facades\Auth::login($user);

        return redirect()->route('member', ['user' => $user->username]);
    }
}
