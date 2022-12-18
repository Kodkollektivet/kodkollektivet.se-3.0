<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SponsorRequest;
use App\Http\Controllers\ImageController;
use App\Models\Sponsor;
use App\Models\User;


class SponsorController extends Controller
{

    public function index()
    {
        return Sponsor::where(['active' => 1])->get();
    }

    public function store(User $user, SponsorRequest $request)
    {
        if ($user->position_id == 1)
        {
            $store         = new Request();
            $store->images = array($request->logo);
            $store->type   = 'sponsor';

            $request->logo = ImageController::store($user, $store);

            $sponsor = Sponsor::create($request->all());

            if (isset($sponsor))
            {                
                return response()->json(['message' => 'Added successfully.'], 200);
            }
        }

        return response()->json(['message' => 'Unable to save record!'], 400);
    }

    public function update(User $user, SponsorRequest $request)
    {
        if ($user->position_id == 1)
        {
            $sponsor = Sponsor::find($request->id);

            if (isset($sponsor))
            {
                $delete_image = isset($request->logo) ? $sponsor->logo : null;

                if (isset($delete_image)) {
                    $delete         = new Request();
                    $delete->images = array($delete_image);
                    $delete->type   = $type;
        
                    \App\Http\Controllers\ImageController::delete($delete);
                }

                $store         = new Request();
                $store->images = array($request->logo);
                $store->type   = 'sponsor';

                $request->logo = ImageController::store($user, $store);

                $sponsor = Sponsor::create($request->all());

                if (isset($sponsor))
                {                
                    return response()->json(['message' => 'Added successfully.'], 200);
                }

                foreach ($sponsor as $key => &$value)
                {
                    isset($request->$key) && $request->$key != $value ? $sponsor->$key = $request->$key : null;
                }

                $sponsor::save();

                return response()->json(['message' => 'Updated successfully.'], 200);
            }
        }

        return response()->json(['message' => 'Unable to update!'], 400);
    }

    public function destroy(User $user, int $id)
    {
        if ($user->position_id == 1)
        {
            $sponsor = Sponsor::find($id);

            if (isset($sponsor)) {
                $sponsor::delete();
                return response()->json(['message' => 'Deleted successfully.'], 200);
            }

            return response()->json(['message' => 'Unable to delete record!'], 400);
        }
    }

}
