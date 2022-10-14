<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\user_technology;


class UserTechController extends Controller
{
    public function edit(User $user, int $id) {
        
        $user_tech = UserTechController::names($user);
        $tech      = \App\Models\Technology::find($id);

        if (isset($tech)) {
            in_array($tech->name, $user_tech) ? user_technology::where(['technology_id'  => $id, 'user_id'  => $user->id])->first()->delete()
                                              : user_technology::create(['technology_id' => $id, 'user_id' => $user->id]);
        }
    }

    public function names(User $user) {
        $names = array();

        foreach ($user->technologies->all() as $tech) {
            array_push($names, $tech->name);
        }

        return $names;
    }
}
