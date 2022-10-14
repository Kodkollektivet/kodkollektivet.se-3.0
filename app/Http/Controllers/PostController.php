<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\user_actionController;
use App\Http\Controllers\ItemController;


class PostController extends Controller
{
    public function index($tag = null, $user = null, $community = true)
    {
        $authors = PostController::getAuthors(Post::where('community', 1)->get());

        if (!isset($tag) && !isset($user)) {
            
            $posts = Post::where('community', 1);
            $tags  = PostController::getTags($posts->get());

        } else {
            if (!isset($user)) {

                $tags  = PostController::getTags(Post::where('community', 1)->get());
                $posts = Post::where('community', 1);

            } elseif (\App\Models\User::where('username', $user)->first() != null) {

                $user  = \App\Models\User::where('username', $user)->first();

                if (!$user->remove_data || $posts = $community) {
                    $posts = $community ? $user->posts()->where('community', 1) : $user->posts()->whereNull('community');
                    $tags  = PostController::getTags($posts->get());
                    
                } else {
                    return;
                }
                
            }

            isset($tag) && in_array($tag, TagController::tagNames()->all()) ? $posts = $posts->whereHas('tags', function ($query) use ($tag) {
                                                                                            $query->where('name', $tag);
                                                                                        }) : null;
        }

        if (isset($posts)) {
            $posts_ready = $posts->orderBy('created_at', 'desc')->take(4)->get();

            foreach ($posts_ready as &$post) {
                $post->link = ItemController::prepareLink($post->name);
                $post->description = ItemController::hideSnippet($post->description);
            }

            return [
                'posts'   => $posts_ready,
                's_posts' => PostController::getSidebarPosts($community, isset($user) ? $user->id : null),
                'footer'  => \App\View\Components\CommonLayout::footer(),
                'total'   => $posts->count(),
                'tags'    => $tags,
                'tag'     => $tag,
                'authors' => $authors
            ];
        }

        return redirect()->route('blog');
    }

    public function fetchMore(User $check_user = null, Request $request)
    {
        $user  = \App\Models\User::where('username', isset($user) ? $user : $request->user)->first();
        $posts = !isset($user) ? Post::where('community', 1) : (isset($request->community) ? $user->posts()->where('community', 1)
                               : $user->posts()->whereNull('community'));

        isset($request->tag) && in_array($request->tag, TagController::tagNames()->all()) ? $posts = $posts->whereHas('tags', function ($query) use ($request) {
            $query->where('name', $request->tag);
        }) : null;

        $posts   = $posts->where('id', '>', $request->skip)->orderBy('created_at', 'desc')->take(4)->get();
        $html    = '';
        $post_id = $request->skip;

        foreach ($posts as $post) {
            $post_id++;
            $post->description = ItemController::hideSnippet($post->description);

            $html .= view('common.post')->with(['post' => $post, 'post_id' => $post_id, 'user' => $check_user]);
        }

        return response()->json(['html' => $html]);
    }

    public function readMore(Request $request)
    {
        $post = Post::find($request->id);

        if ($post) {
            $link = (isset($post->community) ? '/blog/entry/' : '/post/') . ItemController::prepareLink($post->name) ."/?id={$post->id}";

            return response()->json([
                'description' => substr(ItemController::hideSnippet($post->description), 0, 1000) . "&nbsp;&nbsp;<a href='$link'>View full post</a>"
            ]);
        }
    }

    public function single($name)
    {
        $post = isset($_GET) && isset($_GET['id']) ? Post::find($_GET['id']) : null;

        if (isset($post)) {
            $post->description = ItemController::renderCode($post->description);

            return view('common.item')->with([
                'item'    => $post,
                'updates' => \App\Models\user_action::where(['item_id' => $post->id, 'item_type' => 'post', 'action' => 'updated'])->orderBy('created_at', 'desc')->get(),
                'footer'  => \App\View\Components\CommonLayout::footer()
            ]);
        }
        
        return redirect()->route('blog');
    }

    public function countUserCommunityPosts($id)
    {
        return response()->json(['count' => Post::where('community', 1)->count()]);
    }

    public function getSidebarPosts($community, $user_id = null, $page = 1)
    {
        $posts = ($community ? Post::where('community', 1)       : Post::whereNull('community'));
        $posts = (isset($user_id) ? $posts->where('user_id', $user_id) : $posts);
        $pages = intval(ceil($posts->count() / 5));
        $posts = $posts->orderBy('created_at', 'desc')->skip(($page - 1) * 5)->take(5)->get();

        return [
            'r_posts' => $posts->count() ? PostController::renderSidebarPosts($posts) : null,
            'r_pages' => $pages > 1 ? PostController::renderSidebarPagi($community, $user_id, $page, $pages) : null
        ];
    }

    public function create(User $user, array $request) {
        if ($user->role->post) {
            $post = PostController::setPostColumns($user, new Post, $request);

            $post->user_id = $user->id;
            isset($request['image']) ? $post->image = ItemController::imageRequestStore($post, array($request['image']), 'item_cover') : null;

            $post->save();

            for ($i = 0; $i < 4; $i++) {
                if (isset($request["post_image_$i"])) {
                    ItemController::imageRequestStore($post, array($request["post_image_$i"]), 'post');
                } else {
                    break;
                }
            }

            user_actionController::create($user->id, $post->id, 'post', 'created');
            PostController::setTags($post, explode(',', $request['tags']));

            return response()->json(['redirect' => (isset($post->community) ? '/blog/entry/' : '/post/') . ItemController::prepareLink($post->name) . "/?id={$post->id}"]);
        }
    }

    public function update(User $user, array $request) {
        $post = Post::find($request['id']);

        if (isset($post) && PostController::hasPermission($user, $post, 'edit_posts')) {
            $post = PostController::setPostColumns($user, $post, $request);

            if (isset($request['image'])) {
                $post->image = ItemController::imageRequestStore($post, array($request['image']), 'image');
                ImageController::logDeleted($user->id, $post->author->id, "item_covers/$post->image");
            }

            $post->save();

            user_actionController::create($user->id, $post->id, 'post', 'updated');
            PostController::setTags($post, explode(',', $request['tags']));

            $image_lim = 5 - (isset($post->images) ? $post->images->count() : 0);

            for ($i = 0; $i < $image_lim; $i++) {
                if (isset($request["post_image_$i"])) {
                    ItemController::imageRequestStore($post, array($request["post_image_$i"]), 'post');
                } else {
                    break;
                }
            }

            return response()->json([
                'redirect' => (isset($post->community) ? '/blog/entry/' : '/post/') . ItemController::prepareLink($post->name) . "/?id={$post->id}"
            ]);

        }
    }

    public function delete(User $user, Request $request) {
        $post = Post::find($request->id);

        if (isset($post) && PostController::hasPermission($user, $post, 'delete_posts')) {
            $tags = isset($post->tags) ? $post->tags->pluck('id')->all() : [];
            foreach ($tags as $id) {
                $tag = \App\Models\post_tag::where(['post_id' => $post->id, 'tag_id' => $id])->first()->delete();
            }
            
            $action    = user_actionController::create($user->id, $post->id, 'post', 'deleted');
            $author    = $post->author;
            $deleteLog = \App\Models\DeleteLog::create([
                'user_id'   => $user->id,
                'action_id' => $action->id,
                'item' => json_encode([
                    'name'        => $post->name,
                    'intro'       => $post->intro,
                    'description' => $post->description,
                    'author'      => ['id' => $author->id, 'name' => $author->name, 'username' => $author->username]
                ])
            ]);

            $deleteLog->save();

            if (isset($post->image)) {

                ImageController::logDeleted($user->id, $author->id, "item_covers/$post->image", $log_id = $deleteLog->id);

                $delete = new Request(['images' => [$post->image], 'type' => 'item_cover']);

                ImageController::delete($delete);
            }

            if (isset($post->images)) {

                foreach ($post->images as $image) {
                    ImageController::logDeleted($user->id, $author->id, "posts/$image->src", $log_id = $deleteLog->id);
                }

                $delete = new Request(['images' => $post->images->pluck('src')->all(), 'type' => 'post']);

                ImageController::delete($delete);
            }

            $post->delete();

            return response()->json(['redirect' => (isset($post->community) ? 'blog' : "/member/{$user->username}/personal-posts")]);
        }

    }

    public function hasPermission(User $user, Post $post, string $permission) {

        return $user->id == $post->user_id && $user->role->post && 
                            (!isset($post->community) || (isset($user->position) && $user->position->$permission)) ||
                            (isset($user->position) && $user->position->edit_posts) ? $post : null;
    }

    private function setTags(Post $post, array $tags) {

        $setTags    = isset($post->tags) ? $post->tags->pluck('id')->all() : [];
        $deleteTags = array_diff($setTags, $tags);
        $max        = \App\Models\Tag::all()->count();

        foreach ($deleteTags as $id) {
            $tag = \App\Models\post_tag::where(['post_id' => $post->id, 'tag_id' => $id])->first()->delete();
        }

        foreach ($tags as $id) {
            if ($id <= $max && $id > 0 && !in_array($id, $setTags)) {
                $post_tag = new \App\Models\post_tag(['post_id' => $post->id, 'tag_id' => $id]);
                $post_tag->save();
            }
        }
    }

    private function setPostColumns(User $user, Post $post, array $request) {     

        $request['description'] = ItemController::normalizeHTML($request['description']);

        $columns = array('name', 'intro', 'description');

        foreach ($request as $key => $value) {
            isset($value) && in_array($key, $columns) && $post->$key != $value ? $post->$key = strip_tags($value) : null;
        }

        $post->description = ItemController::normalizeHTML($post->description, true);
        $post->community   = isset($user->position) && $user->position->create_posts && $request['community'] ? $request['community'] : null;

        return $post;
    }

    private function getTags($posts)
    {
        $tags      = array();

        foreach ($posts as $post) {
            foreach ($post->tags as $tag) {
                !in_array($tag->name, $tags) ? array_push($tags, $tag->name) : null;
            }
        }

        return $tags;
    }

    private function getAuthors($posts)
    {
        $authors = array();

        foreach ($posts as $post) {
            !in_array($post->author->username, $authors) ? array_push($authors, $post->author->username) : null;
        }

        return $authors;
    }

    private function renderSidebarPosts($posts)
    {
        $r_posts = '<li>
                        <div class="transition-none bg-base-100 border-b-2 border-gray-800 cursor-auto text-white font-semibold">All entries</div>
                    </li>';

        foreach ($posts as $post) {
            $link = '/blog/entry/' . ItemController::prepareLink($post->name) . "/?id={$post->id}";
            $date = date('F jS, Y', strtotime($post->created_at));

            $r_posts .= "<li>
                            <a href='{$link}' class='transition ease-in-out duration-300 hover:text-blue-100 flex flex-col items-start'>{$post->name}
                                <small class='text-gray-400 relative -mt-2'>{$date}</small>
                            </a>
                         </li>";

        }

        return $r_posts;
    }

    private function renderSidebarPagi($community, $user_id, $page, $pages)
    {
        $r_pages = '';
        $prev    = $page - 1;
        $next    = $page + 1;

        if ($prev > 0) {
            $action = 'getSidebarPosts(' . ($community ? 1 : 0) . ', ' . ($user_id ? $user_id : 'null') . ", {$prev})";
            
            $r_pages .= "
            <a onclick='{$action}' rel='prev' class='btn outline-none btn-md bg-gray-800 text-blue-200 border-base-100 transition ease-in-out duration-200 hover:text-primary hover:border-base-100 hover:bg-base-100 rounded-r-none' title='Previous page'>
                <svg class='w-5 h-5' fill='currentColor' viewBox='0 0 20 20'>
                    <path fill-rule='evenodd' d='M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z' clip-rule='evenodd' />
                </svg>
            </a>";
        }
        
        for ($i = $page; $i <= $page + 1; $i++) {
            $class  = $i == $page ? 'text-white cursor-not-allowed' : 'text-blue-200 transition ease-in-out duration-200 hover:text-primary hover:border-base-100 hover:bg-base-100';
            $action = $i != $page ? 'getSidebarPosts(' . ($community ? 1 : 0) . ', ' . ($user_id ? $user_id : 'null') . ", {$i})" : '';

            $r_pages .= $i <= $pages ? "
                <a onclick='{$action}' class='btn outline-none btn-md bg-gray-800 border-base-100 rounded-none {$class}' title='Go to page {$i}'>
                    {$i}
                </a>" : '';
        }

        if ($next <= $pages) {
            $action = $i != $page ? 'getSidebarPosts(' . ($community ? 1 : 0) . ', ' . ($user_id ? $user_id : 'null') . ", {$next})" : '';

            $r_pages .= "
            <a onclick='{$action}' rel='next' class='btn outline-none btn-md bg-gray-800 text-blue-200 border-base-100 transition ease-in-out duration-200 hover:text-primary hover:border-base-100 hover:bg-base-100 rounded-l-none' title='Next page'>
                <svg class='w-5 h-5' fill='currentColor' viewBox='0 0 20 20'>
                    <path fill-rule='evenodd' d='M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z' clip-rule='evenodd' />
                </svg>
            </a>";
        }

        return $r_pages;
        
    }

}
