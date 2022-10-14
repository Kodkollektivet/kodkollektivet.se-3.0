<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\User;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comment = Comment::find($request->id);

        if (isset($comment) && $comment->replies->count()) {
            $html = '<div class="thread relative xs:ml-2 sm:ml-2 md:ml-10 lg:ml-10 flex flex-col">' . CommentController::buildThread($comment->replies);

            return response()->json(['html' => "$html<div title='Hide thread' id='thread-hide' class='absolute top-0 h-full'><div onclick='$(`#comment-$comment->id .view-thread`).click()' class='sticky left-0 btn btn-sm btn-primary xs:hidden sm:hidden'>
                <svg class='fill-current h-4' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 512'><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c5.2-11.8 8-24.8 8-38.5c0-53-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zm223.1 298L373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5z'/></svg>
            </div></div></div>"]);
        }
    }

    public function create(User $user, CommentRequest $request)
    {
        $item = \Illuminate\Support\Facades\DB::table("{$request->item_type}s")->find($request->item_id);

        if (isset($item) && $user->role->comment) {
            $comment = new Comment([
                'item_type' => $request->item_type,
                'item_id'   => $request->item_id,
                'user_id'   => $user->id,
                'content'   => $request->content,
                'origin'    => $request->origin
            ]);

            $comment->save();
            
            $action = isset($comment->origin) ? user_actionController::create($user->id, $comment->threadStart->item_id, $comment->threadStart->item_type, 'replied to a comment on')
                                              : user_actionController::create($user->id, $comment->item_id, $comment->item_type, 'commented on');

            $user_id = \App\Http\Controllers\ItemController::getModel($action->item_type)::find($action->item_id)->author->id;
            $user_id != $user->id ? \App\Models\Notification::create(['user_id' => $user_id, 'action_id' => $action->id]) : null;

            return response()->json([
                'html'  => CommentController::renderHTML($comment, $comment->item_type != 'comment' ? 'comment' : 'reply'),
                'count' => $comment->item_type == 'comment' ? $comment->parent->replies->count() : null
            ]);
        }
    }

    public function edit(comment $comment)
    {
        //
    }

    public function destroy(User $user, Request $request)
    {
        $comment = Comment::find($request->id);

        if (isset($comment) && (isset($user->position_id) || $user->id == $comment->user_id)) {     // Enable delete for mods and comment authors.
            $comment->delete();
        }
    }

    private function buildThread(object $replies, string $html = '') {
        foreach ($replies as $reply) {
            $html = CommentController::renderHTML($reply, 'reply') . CommentController::buildThread($reply->replies, $html);
        }

        return $html;
    }

    private function renderHTML(Comment $comment, string $type) {
        return htmlspecialchars_decode("<div id='comment-". $comment->id ."' class='comment relative grid grid-cols-1 w-full gap-4 px-4 mb-8 rounded-md bg-neutral shadow-lg'>
                                            <div class='flex xs:flex-col sm:flex-col md:flex-row lg:flex-row w-full justify-between relative'>
                                                <a href='". route('member', ['user' => $comment->author->username]) ."' tabindex='0' class='flex align-items-center text-blue-100 hover:text-blue-100  no-underline mt-4 mb-2'>
                                                    <img class='rounded-full h-12 w-12 object-cover m-0' src='". (isset($comment->author->avatar) ? '/public/images/avatars/' . $comment->author->avatar : '/public/images/avatars/generic.svg') ."' alt='Profile picture'>
                                                    <div class='ml-3'>
                                                        <div class=''>". $comment->author->username ."</div>
                                                        <div class='text-gray-500 no-underline'>". $comment->author->name ."</div>
                                                    </div>
                                                </a>
                                                <p class='xs:my-0 sm:my-0 md:mt-4 lg:mt-4 xs:text-sm sm:text-sm'>". date('F jS, Y, H:i:s', strtotime($comment->created_at)) ."</p>
                                            </div>
                                            <p class='m-0 text-blue-200'>". ($type == 'reply' ? "
                                                <span class='italic'>Replied to ". ($comment->parent->author->username == $comment->author->username ? 'their own' : "{$comment->parent->author->username}'s") ." <a onclick='highlight($" . "(`#{$comment->item_type}-{$comment->parent->id}`))' class='transition ease-in-out duration-200' href='#" . $comment->item_type ."-". $comment->parent->id . "'>comment:</a></span> " : "") 
                                                . $comment->content
                                            ."</p>
                                            ". ($comment->author->role->comment ? "
                                            <div class='flex justify-end mb-4'>
                                                <button onclick='renderReplyForm($comment->id, $comment->origin)' class='reply btn btn-outline btn-sm ml-2 mt-2'>Reply</button>
                                            </div>
                                            " : "") . "
                                        </div>");
    }
}
