<?php

namespace App\Http\Controllers;

use App\Models\image;
use Illuminate\Http\Request;


class ImageController extends Controller
{
    public function delete(Request $request)
    {
        if (ImageController::checkTypeAllowed($request->type))
        {
            foreach ($request->images as $image)
            {
                $path = public_path('images/' . $request->type . 's/') . $image;
                file_exists($path) ? unlink($path) : null;

                $item = image::where('src', $image)->first();
                isset($item) ? $item->delete() : null;
            }
        }
    }

    public function store(object $item, Request $request)
    {

        if (ImageController::checkTypeAllowed($request->type))
        {
            foreach ($request->images as $image)
            {
                $titl = time() . '_' . str_replace(' ', '', ($image->getClientOriginalName()));

                while (file_exists(public_path("images/" . $request->type . "s/$titl")))
                {
                    $titl = rand(1, 9) . $titl;
                }

                $image->move(public_path('images/' . $request->type . 's/'), $titl);
                $path = public_path("images/" . $request->type . "s/$titl");

                file_exists($path) ? ImageController::imageResize($path, $request->type) : die;

                return ImageController::imageSaveDB($item, $titl, $request);
            }
        }
    }

    public function logDeleted(int $user_id, int $author_id, string $src, int $log_id = null)
    {

        if (file_exists(public_path("/images/$src")))
        {
            $src_new = substr($src, strpos($src, '/') + 1);

            copy(public_path("/images/$src"), public_path("/images/deleted/$src_new"));
    
            $deletedImage = new \App\Models\DeletedImage([
                'user_id'   => $user_id,
                'author_id' => $author_id,
                'src'       => $src_new,
                'log_id'    => $log_id
            ]);
    
            $deletedImage->save();
    
            ImageController::imageResize(public_path("/images/deleted/$src_new"));
        }
    }

    private function checkTypeAllowed(string $type)
    {
        return isset($type) && in_array($type, ['avatar', 'cover', 'event', 'post', 'project', 'item_cover', 'sponsor']);
    }

    private function imageResize(string $path, string $type = null)
    {
        $image     = \Intervention\Image\Facades\Image::make($path);
        $max_width = isset($type) && $type != 'cover' ? 600 : (isset($type) ? 1920 : 100);

        if ($image->width() > $max_width)
        {
            $width  = $image->width();
            $height = $image->height();

            $image->resize($max_width, intval($height / $width * $max_width))->save($path);
        }
    }

    private function imageSaveDB(object $item, string $titl, Request $request)
    {
        if (!in_array($request->type, ['avatar', 'sponsor']) && strpos($request->type, 'cover') === false)
        {
            image::create(['src' => $titl, 'item_id' => $item->id, 'item_type' => $request->type]);
        }
        else {
            if ($request->type == 'avatar')
            {
                $item->avatar = $titl;
                $item->save();
            }
            elseif ($request->type == 'cover')
            {
                $item->profile->cover = $titl;
                $item->profile->save();
            }

            return $titl;
        }
    }

}
