<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user_action;


class user_actionController extends Controller
{
    public function create($user_id, $item_id, $item_type, $action)
    {
        return user_action::create(['user_id' => $user_id, 'item_id' => $item_id, 'item_type' => $item_type, 'action' => $action]);
    }

    public function userActionActual(user_action $action) {

        $action->actual = $action->item_type != 'invite' ? \Illuminate\Support\Facades\DB::table("{$action->item_type}s")->where('id', $action->item_id)->first() : null;

        if (isset($action->actual)) {
            
            $name     = \App\Http\Controllers\ItemController::prepareLink($action->actual->name);
            $pre_link = "$name/?id={$action->actual->id}";

            $action->actual->link = in_array($action->item_type, ['event', 'project']) || $action->item_type == 'post' && !isset($action->actual->community) ? 
                "$action->item_type/$pre_link" : ($action->item_type == 'post' && isset($action->actual->community) ? "blog/entry/$pre_link" : "member/{$action->actual->username}");
        }

        return $action;
    }
}
