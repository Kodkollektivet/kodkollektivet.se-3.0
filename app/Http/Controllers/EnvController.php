<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class EnvController extends Controller
{
    public function DoorbellToggle(User $user)
    {
        if ($user->role_id == 1)
        {
            $status = env('DOORBELL_ACTIVE');

            file_put_contents(app()->environmentFilePath(), str_replace(
                'DOORBELL_ACTIVE='.(int)$status,
                'DOORBELL_ACTIVE='.(int)!$status,
                file_get_contents(app()->environmentFilePath())
            ));

            return response()->json(['option' => !$status ? 'Disable' : 'Enable']);
        }
    }
}
