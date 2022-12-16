<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\DoorbellCall;


class DiscordController extends Controller
{

    private static $messages = [
        'THE DOOR, PEOPLE, GET THE DOOR!!! ❄️ 🥶',
        'Looks like someone is trying to get in 🤔',
        'That door won\'t open itself 😬',
        '🌚',
        '🗿'
    ];

    public static function ringDoorbell(string $session_id = null)
    {
        if (env('DOORBELL_ACTIVE'))
        {
            $session = Session::find($session_id);

            if (isset($session) && !isset($session->doorbell_call))
            {
                $CURL = curl_init(env('DOORBELL_URL'));
    
                curl_setopt_array($CURL, [
                    CURLOPT_HTTPHEADER => [
                        'Content-Type: application/json',
                        'Connection: Keep-Alive'
                    ],
                    CURLOPT_POST       => 1,
                    CURLOPT_POSTFIELDS => json_encode([
                        "content" => static::$messages[array_rand(static::$messages)]
                    ]),
                ]);
    
                curl_exec($CURL);
                curl_close($CURL);
    
                DoorbellCall::create(['session_id' => $session_id]);
    
                die;
            }
            elseif (isset($session) && isset($session->doorbell_call))
            {
                return response()->json(['message' => 'We heard you the first time 👌'], 200);
            }
        }

        return response()->json(['message' => 'Who are you, and what do you think you are doing?'], 401);
    }

}
