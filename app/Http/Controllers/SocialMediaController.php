<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Models\SocialMedia;
use App\Models\User;


class SocialMediaController extends Controller
{
    public function index($user = null) {

        $allow_edit = isset($user) && SocialMediaController::checkAllowEdit($user);

        if ($allow_edit) {
            $social = SocialMedia::all();

            foreach ($social as &$media) {
                isset($media->password) ? $media->password = Crypt::decryptString($media->password) : null;
            }
        } else {
            $social = SocialMedia::where('url', '!=', null)->get();
        }

        return view('common.social')->with([

            'social' => $social,
            'edit'   => $allow_edit,
            'footer' => \App\View\Components\CommonLayout::footer()
        ]);
    }

    public function single(User $user, Request $request) {

        if (SocialMediaController::checkAllowEdit($user) && isset($request->id)) {

            $media = SocialMedia::find($request->id);
            isset($media->password) ? $media->password = Crypt::decryptString($media->password) : null;

            return response()->json(['media' => $media]);
        }
    }

    public function update(User $user, \App\Http\Requests\SocialMediaRequest $request) {

        if (SocialMediaController::checkAllowEdit($user) && isset($request->id)) {
            
            $media = SocialMedia::find($request->id);

            if (isset($media)) {
                unset($request->id);
                $data = $request->all();
                isset($data['password']) ? $data['password'] = Crypt::encryptString($data['password']) : null;

                foreach ($data as $key => $value) {
                    $media->$key = $value;
                }

                $media->save();
            }
        }
    }

    private function checkAllowEdit(User $user) {
        return isset($user->position) && $user->position->edit_social;
    }

}
