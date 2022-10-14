<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\PositionApplication;
use App\Models\User;


class PositionController extends Controller
{
    public function index($open_only = true) {
        return Position::doesntHave('users')->orWhere('open', true)->get();
    }

    public function apply(User $user, Request $request) {
        $error = 'Invalid request!';

        if (isset($request->id) && isset($request->message)) {
            $error    = 'You cannot apply for this position!';
            $position = Position::find($request->id);

            if (isset($position) && in_array($position, PositionController::index()->all()) && PositionController::canApply($user, $request->id)) {
                $app = new PositionApplication(['position_id' => $request->id,
                    'user_id' => $user->id, 'message' => $request->message]);

                $app->save();

                $countApps = $position->applications->count();

                return response()->json([
                    'message' => 'Applied successfully!',
                    'html'    => isset($user) && PositionController::canView($user) ? PositionController::renderApplicant($app, $countApps) : null,
                    'id'      => $position->id,
                    'count'   => $countApps
                ]);
            }
        }

        return response()->json(['message' => $error], 403);
    }

    public function single(User $user, Request $request) {
        if (isset($request->id) && PositionController::canView($user)) {
            $app = PositionApplication::find($request->id);

            if (isset($app)) {
                return response()->json([
                    'app'  => $app,
                    'user' => (object) [
                        'name'     => $app->user->name,
                        'username' => $app->user->username,
                        'role'     => $app->user->role->name,
                        'position' => isset($app->user->position_id) ? $app->user->position->name : null,
                        'avatar'   => isset($app->user->avatar) ? $app->user->avatar : 'generic.svg'
                    ]
                ]);
            }
        }
    }

    public function reply(User $user, Request $request) {
        if (isset($request->id) && isset($request->approved) && isset($request->reply)) {
            $app = PositionApplication::find($request->id);

            if (isset($app) && PositionController::canReply($user, $app)) {
                $app->approved = $request->approved;
                $app->reply    = $request->reply;

                $app->save();

                if ($app->approved) {
                    $app->user->position_id = $app->position_id;

                    $app->position->open = 0;
                    $app->position->timestamps = false;
                    $app->position->save();

                    if ($app->position_id != 14) {
                        $app->user->role_id = 1;

                        $user_reset = User::where('position_id', $app->position_id)->first();

                        if (isset($user_reset)) {
                            $user_reset->position_id = null;
                            $user_reset->save();
                        }
                    }

                    $app->user->save();

                    return response()->json(['message' => $app->user->username . ' promoted to ' . $app->position->name . '!', 'id' => $app->position_id]);
                }

                return response()->json(['message' => 'Application declined!', 'id' => $app->id]);
            }
        }

        return response()->json(['message' => 'Cannot process this application!'], 403);

    }

    private function canView(User $user) {
        return $user->role_id == 1 || $user->position_id == 14;
    }

    private function canApply(User $user, int $position_id) {
        return $user->role->apply_positions && PositionApplication::where(
            ['position_id' => $position_id, 'user_id' => $user->id, 'approved' => null])->first() == null;
    }

    private function canReply(User $user, PositionApplication $app) {
        return !isset($app->approved) && $app->user->role->apply_positions && $user->position->application_decide &&
            ($app->user != $user || in_array($app->position, Position::doesntHave('users')->get()->all()));
    }

    private function renderApplicant(PositionApplication $application, $countApps) {
        return htmlspecialchars_decode(($countApps == 1 ? "<tr class='position position-". $application->position_id ." bg-base-300 text-gray-500 mb-4 border-0 appearance-none w-full overflow-hidden'>
                                        <td class='p-3'>Applicant</th>
                                        <td class='p-3'>Currently</th>
                                        <td class='p-3 text-left'>Message</th>
                                        <td class='p-3 text-left'>Date</th>
                                   </tr>" : "") . "
                                   <tr class='position position-". $application->position_id . " app-" . $application->id ." bg-base-100 bg-none border-gray-800 border-b-2 appearance-none overflow-hidden'>
                                        <td class='appearance-none p-3 border-0'>
                                            <a href='". route('member', ['user' => $application->user->username]) ."' tabindex='0' class='flex align-items-center text-blue-100 hover:text-blue-100'>
                                                <img class='rounded-full h-12 w-12 object-cover' src='". asset('images/avatars') . (isset($application->user->avatar) ? '/' . $application->user->avatar : "/generic.svg") ."' alt='Profile picture'>
                                                <div class='ml-3'>
                                                    <div>". $application->user->username ."</div>
                                                    <div class='text-gray-500'>". $application->user->name ."</div>
                                                </div>
                                            </a>
                                        </td>
                                        <td class='appearance-none p-3 border-0'>
                                            <div class='flex align-items-center'>
                                                <div class='text-gray-500 font-semibold'>".
                                                    $application->user->role->name . (isset($application->user->position_id) ? ' / ' . $application->user->position->name : ($application->user->role_id == 1 ? ' / Unspecified' : '')) ."
                                                </div>
                                            </div>
                                        </td>
                                        <td class='appearance-none p-3 border-0'>
                                            <div class='flex align-items-center'>
                                                <div class='text-gray-500 font-semibold'>
                                                    <button onclick='viewMessage(". $application->id .")' class='btn btn-sm hover:text-secondary'>
                                                        View
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class='appearance-none p-3 border-0'>
                                            <div class='flex align-items-center'>
                                                <div class='text-gray-500 font-semibold'>".
                                                    gmdate('Y-m-d', strtotime($application->created_at)) ."
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                   ");
    }
}
