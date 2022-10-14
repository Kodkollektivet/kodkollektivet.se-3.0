<?php

namespace App\Http\Controllers\Forms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ItemController;


class ItemFormController extends Controller
{

    public function createEditItemForm(User $user, Request $request, string $type) {

        if (isset($type) && in_array($type, ['post', 'event'])) {

            $model      = ItemController::getModel($type);
            $controller = ItemController::getController($type);

            if (isset($model) && isset($controller)) {
                
                $item   = isset($request->id) ? $model::find($request->id) : null;
                $return = $user->role->post ? [
                    'footer' => \App\View\Components\CommonLayout::footer(),
                    'user'   => $user,
                    'tags'   => $type == 'post' ? \App\Models\Tag::all() : null,
                    'types'  => $type == 'event' ? \App\Http\Controllers\EventController::getTypes() : null,
                    'item'   => isset($item) ? $controller::hasPermission($user, $item, "edit_{$type}s") : null
                ] : null;
        
                if (isset($return) && isset($return['item'])) {
                    $return['tagnames'] = $item->tags->pluck('name')->all();
                    $return['item']->description  = \App\Http\Controllers\ItemController::normalizeHTML($item->description);
                }
        
                return isset($return) ? view('forms.post')->with($return) : redirect('/blog');
            }

            return redirect('/blog');
        }
    }

    public function createEditItem(User $user, \App\Http\Requests\ItemFormRequest $request, string $type) {
        $controller = ItemController::getController($type);

        return isset($request->id) ? $controller::update($user, $request->all()) : $controller::create($user, $request->all());
    }

    public function deleteImage(User $user, Request $request, string $type) {
        
        $model      = ItemController::getModel($type);
        $controller = ItemController::getController($type);

        $image = \App\Models\image::find($request->id);

        if (isset($image)) {
            $item = $model::find($image->item_id);

            if (isset($item) && $controller::hasPermission($user, $item, "edit_{$item}s")) {
                ImageController::logDeleted($user->id, $image->$type->author->id, "{$type}s/$image->src");

                $delete = new Request(['images' => [$image->src], 'type' => $type]);
                ImageController::delete($delete);
            }
        }
    }

    public function deleteItem(User $user, Request $request, string $type) {
        $controller = ItemController::getController($type);

        return isset($request->id) ? $controller::delete($user, $request) : null;
    }

}
