<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ImageController;


class ItemController extends Controller
{
    public function imageRequestStore(object $item, array $images, string $type)
    {
        $store        = new Request(['images' => $images, 'type' => ($type == 'image' ? 'item_cover' : $type)]);
        $delete_image = isset($item->$type) ? $item->$type : null;

        if (isset($delete_image))
        {
            $delete         = new Request();
            $delete->images = array($delete_image);
            $delete->type   = $type == 'image' ? 'item_cover' : $type;

            ImageController::delete($delete);
        }

        return ImageController::store($item, $store);
    }

    public function renderCode(string $string)
    {
        $string_data = ItemController::replaceSafe($string);

        if ($string_data->allow)
        {
            $text = substr($string, $string_data->start, $string_data->end);
            $code = str_replace(' --!', '">', str_replace('!-- end --!', '</code></pre></div>', str_replace('!-- start', '<div class="mockup-code tw-ignore"><pre><code class="', $text)));

            $string = str_replace($text, $code, $string);

            ItemController::renderCode($string);
        }

        return $string;
    }

    public function hideSnippet(string $string)
    {
        $string_data = ItemController::replaceSafe($string);
        
        if ($string_data->allow)
        {
            $string = str_replace(substr($string, $string_data->start, $string_data->end - 24), "[ CODE SNIPPET ]&nbsp;", $string);
            ItemController::hideSnippet($string);
        }

        return $string;
    }

    public function normalizeHTML(string $html, $setBreaks = false)
    {
        $html = str_replace('<br><br>', '<br>', $html);
        
        while (substr_count($html, '<br><br>'))
        {
            $html = str_replace(['<br><br>'], '<br>', $html);
        }

        return !$setBreaks ? str_replace('<br>', PHP_EOL, $html) : str_replace(PHP_EOL, '<br>', $html);
    }

    public function prepareLink($item_name)
    {
        return str_replace(['?', '&', '='], '', str_replace(' ', '-', $item_name));
    }

    public function getModel($name)
    {
        if (class_exists('\App\Models\\'.ucfirst($name))) {
            return '\App\Models\\'.ucfirst($name);
        } elseif (class_exists('\App\Models\\'.$name)) {
            return '\App\Models\\'.$name;
        }

        return null;
    }

    public function getController($name)
    {
        $controller = '\App\Http\Controllers\\'. ucfirst($name) .'Controller';
        
        return class_exists($controller) ? $controller : null;
    }

    private function replaceSafe(string $string)
    {
        $start_count = substr_count($string, '!-- start');
        $end_count   = substr_count($string, '!-- end --!');
        $start_index = strpos($string, '!-- start');
        $end_index   = strpos($string, '!-- end --!') + 11;     // Including last index of end substring.

        return (object)['allow' => $start_count && $start_count == $end_count && $start_index < $end_index, 'start' => $start_index, 'end' => $end_index];
    }
    
}