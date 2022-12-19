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

    public function form(User $user = null)
    {
        if (isset($user) && $user->role_id == 1)
        {
            return view('forms.sponsors')->with([
                'sponsors' => Sponsor::all(),
                'footer'   => \App\View\Components\CommonLayout::footer()
            ]);
        }
    }

    public function show(int $id)
    {
        $sponsor = Sponsor::find($id);

        if (isset($sponsor))
        {
            return response()->json(['sponsor' => $sponsor], 200);
        }

        return response()->json(400);
    }

    public function store(User $user, SponsorRequest $request)
    {
        if ($user->role_id == 1)
        {
            $request = $request->all();

            $store         = new Request();
            $store->images = array($request['logo']);
            $store->type   = 'sponsor';

            $request['logo']   = ImageController::store($user, $store);
            $request['active'] = $request['active'] == 'on';

            $sponsor = Sponsor::create($request);

            if (isset($sponsor))
            {                
                return response()->json(['message' => 'Added successfully.'], 200);
            }
        }

        return response()->json(['message' => 'Unable to save record!'], 400);
    }

    public function update(User $user, SponsorRequest $request)
    {
        if ($user->role_id == 1)
        {
            $sponsor = Sponsor::find($request->id);

            if (isset($sponsor))
            {
                $request = $request->all();
                $delete_image = isset($request['logo']) ? $sponsor->logo : null;

                if (isset($delete_image)) {
                    $delete         = new Request();
                    $delete->images = array($delete_image);
                    $delete->type   = 'sponsor';
        
                    \App\Http\Controllers\ImageController::delete($delete);

                    $store         = new Request();
                    $store->images = array($request['logo']);
                    $store->type   = 'sponsor';
    
                    $request['logo'] = ImageController::store($user, $store);
                }

                $request['active'] = $request['active'] == 'on';

                $columns = \Illuminate\Support\Facades\Schema::getColumnListing('sponsors');

                foreach ($request as $key => $value)
                {
                    in_array($key, $columns) && isset($value) ? $sponsor->$key = $value : null;
                }

                $sponsor->save();

                return response()->json(['message' => 'Updated successfully.'], 200);
            }
        }

        return response()->json(['message' => 'Unable to update!'], 400);
    }

    public function destroy(User $user, int $id)
    {
        if ($user->role_id == 1)
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
