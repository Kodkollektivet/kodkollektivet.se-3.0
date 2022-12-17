<?php

namespace App\View\Components;
use Illuminate\View\Component;
use App\Models\event;
use App\Models\Post;
use App\Models\SocialMedia;


abstract class CommonLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    
    public static function footer()
    {
        $return = CommonLayout::addLinks([
            'events' => event::orderBy('created_at', 'desc')->take(3)->get(),
            'posts'  => Post::where('community', 1)->orderBy('created_at', 'desc')->take(3)->get(),
            'social' => SocialMedia::where('url', '!=', null)->where('feature', 1)->get()
        ]);

        return (object) $return;
    }

    public static function home()
    {
        $posts = CommonLayout::addLinks([post::where('community', 1)->orderBy('created_at', 'desc')->take(4)->get()]);

        return view('common.home')->with([
            'footer' => static::footer(),
            'posts'  => $posts[0]
        ]);
    }

    public static function origins()
    {
        $posts  = CommonLayout::addLinks([post::where('community', 1)->orderBy('created_at', 'desc')->take(2)->get()]);
        $events = CommonLayout::addLinks([Event::orderBy('date', 'desc')->take(2)->get()]);

        return view('common.origins')->with([
            'footer' => static::footer(),
            'posts'  => $posts[0],
            'events' => $events[0]
        ]);
    }

    public static function blog()
    {
        return view('common.blog')->with([
            'footer' => static::footer()
        ]);
    }

    public static function faq()
    {
        return view('common.projects')->with([
            'footer' => static::footer()
        ]);
    }

    public static function policy()
    {
        return view('common.policy')->with([
            'footer' => static::footer()
        ]);
    }

    public function addLinks(array $items) {
        foreach ($items as &$type) {
            foreach ($type as &$item) {
                $item->link = \App\Http\Controllers\ItemController::prepareLink($item->name);
            }
        }

        return $items;
    }

}
