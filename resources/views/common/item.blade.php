@extends('layouts.common')

@section('content')

<link rel="stylesheet" href="/public/css/highlight/styles/github-dark.min.css">

<?php $this_date = isset($item->date) ? strtotime($item->date) : null;
      $post      = get_class($item) == 'App\Models\Post'; ?>

<style>
        @media (max-width: 768px) {
            article {
                padding: 0 24px;    
            }        
        }
</style>

<div class="b-32 pt-20 from-base-300 to-base-100 via-neutral bg-gradient-to-br border-t-2 border-b-2 border-gray-800 col-start-1 row-start-1 h-auto w-full">
    <article class="prose m-auto">
        <h1 class="mb-4 mt-10 relative">{{ $item->name }}

        @if (!$post)

        <div class="relative -top-1 badge border-none text-neutral bg-{{$this_date > $date ? 'info' : 'warning'}}">
            <small>{{$this_date > $date ? 'PLANNED' : 'PAST'}}</small>
        </div>
        
        @endif

        @if (Auth::check() && $item->author->id != Auth::user()->id)
            <div class="absolute right-2 top-0">
                <svg onclick="toggleReportItem({{ $item->id }}, '{{ $post ? 'post' : 'event'}}')" class="fill-current h-4 transition ease-in-out duration-200 hover:fill-error cursor-pointer" title="Report" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M64 32V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V32C0 14.3 14.3 0 32 0S64 14.3 64 32zm40.8 302.8c-3 .9-6 1.7-8.8 2.6V13.5C121.5 6.4 153 0 184 0c36.5 0 68.3 9.1 95.6 16.9l1.3 .4C309.4 25.4 333.3 32 360 32c26.8 0 52.9-6.8 73-14.1c9.9-3.6 17.9-7.2 23.4-9.8c2.7-1.3 4.8-2.4 6.2-3.1c.7-.4 1.1-.6 1.4-.8l.2-.1c9.9-5.6 22.1-5.6 31.9 .2S512 20.6 512 32V288c0 12.1-6.8 23.2-17.7 28.6L480 288c14.3 28.6 14.3 28.6 14.3 28.6l0 0 0 0-.1 0-.2 .1-.7 .4c-.6 .3-1.5 .7-2.5 1.2c-2.2 1-5.2 2.4-9 4c-7.7 3.3-18.5 7.6-31.5 11.9C424.5 342.9 388.8 352 352 352c-37 0-65.2-9.4-89-17.3l-1-.3c-24-8-43.7-14.4-70-14.4c-27.5 0-60.1 7-87.2 14.8z"/></svg>
            </div>
        @endif

        </h1>

        <p class="flex">
            <div>

            @if ($post)

            <span>Tagged:</span>

                <?php $tag_uri = isset($item->community) ? '/blog/' : "/member/{$item->author->username}/personal-posts/"; ?>

                 &nbsp;<a class="transition ease-in-out duration-200" href="{{ $tag_uri }}">#blog-{{ isset($item->community) ? 'public' : 'personal' }}</a>

                @foreach ($item->tags as $tag)

                 &nbsp;<a class="transition ease-in-out duration-200" href="{{ $tag_uri . $tag->name }}">#{{ $tag->name }}</a>

                @endforeach


            @else

                <span>Posted in:</span>

                &nbsp;<a class="transition ease-in-out duration-200" href="/events">Events</a>

                &nbsp;<a class="transition ease-in-out duration-200" href="/events/{{ str_replace(' ', '-', $type) }}">{{ $type }}</a>

            @endif

            </div>

        </p>

        <h3 class="mt-0 mb-2">
            <code class="p-0">
                <a class="underline-none transition ease-in-out duration-200 xs:text-sm sm:text-sm" href="/member/{{ $item->author->username }}">{{ !$item->author->remove_data ? $item->author->name : 'Data removed' }} ({{ $item->author->username }})</a> <span class="xs:text-sm sm:text-sm">|| {{ date('F jS, Y, H:i:s', strtotime($item->created_at)) }}</span> 
            </code>
        </h3>

        <p class=" text-xl font-semibold mt-10 italic ">
            {{ $item->intro }}
        </p>

        @if (!$post)

        <p class=" text-lg font-semibold flex flex-col">
            <span class="flex mb-2 xs:text-sm sm:text-sm">
                <svg class="fill-current w-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 256c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z"/></svg>
                Where: {{ $item->place }}
            </span>
            <span class="flex xs:text-sm sm:text-sm">
                <svg class="fill-current w-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M256 512C114.6 512 0 397.4 0 256S114.6 0 256 0S512 114.6 512 256s-114.6 256-256 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>
                When: {{ date('F jS, Y (l, H:i)', $this_date) }}
            </span>
        </p>

        @endif

        @if (!$post)

            <div class="divider mb-4"></div>

            @if ($this_date > $date || $item->users->count())

            <h3 class="tracking-tight font-extrabold text-xl flex xs:flex-col sm:flex-col justify-between">
                <span class="xs:order-2 sm:order-2 xs:text-sm sm:text-sm">{{ $this_date > $date ? 'Planning to attend:' : 'Attended:' }}</span>

                @if (isset($date) && $this_date > $date && Auth::check())
                    @if (!in_array($item->id, Auth::user()->events->pluck('id')->toArray()))
                    <button class="modal-button btn btn-sm text-sm btn-outline btn-success xs:order-1 sm:order-1 xs:mb-6 sm:mb-6" onclick='subscribe({{ Auth::user()->id }}, {{ $item->id }}, "events-subscribe")' id="event-action">
                        I'll be attending &nbsp;
                        <svg class="h-4 fill-current relative" style="top: -1px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M128 447.1V223.1c0-17.67-14.33-31.1-32-31.1H32c-17.67 0-32 14.33-32 31.1v223.1c0 17.67 14.33 31.1 32 31.1h64C113.7 479.1 128 465.6 128 447.1zM512 224.1c0-26.5-21.48-47.98-48-47.98h-146.5c22.77-37.91 34.52-80.88 34.52-96.02C352 56.52 333.5 32 302.5 32c-63.13 0-26.36 76.15-108.2 141.6L178 186.6C166.2 196.1 160.2 210 160.1 224c-.0234 .0234 0 0 0 0L160 384c0 15.1 7.113 29.33 19.2 38.39l34.14 25.59C241 468.8 274.7 480 309.3 480H368c26.52 0 48-21.47 48-47.98c0-3.635-.4805-7.143-1.246-10.55C434 415.2 448 397.4 448 376c0-9.148-2.697-17.61-7.139-24.88C463.1 347 480 327.5 480 304.1c0-12.5-4.893-23.78-12.72-32.32C492.2 270.1 512 249.5 512 224.1z"/></svg>
                    </button>
                    @else
                    <button class="modal-button btn btn-sm text-sm btn-outline btn-error xs:order-1 sm:order-1 xs:mb-6 sm:mb-6" onclick='subscribe({{ Auth::user()->id }}, {{ $item->id }}, "events-unsubscribe")' id="event-action">
                        No longer interrested &nbsp;
                        <svg class="h-4 fill-current relative" style="top: -1px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M119.4 44.1C142.7 40.22 166.2 42.2 187.1 49.43L237.8 126.9L162.3 202.3C160.8 203.9 159.1 205.1 160 208.2C160 210.3 160.1 212.4 162.6 213.9L274.6 317.9C277.5 320.6 281.1 320.7 285.1 318.2C288.2 315.6 288.9 311.2 286.8 307.8L226.4 209.7L317.1 134.1C319.7 131.1 320.7 128.5 319.5 125.3L296.8 61.74C325.4 45.03 359.2 38.53 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 0 232.4 0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.09V44.1z"/></svg>
                    </button>
                    @endif
                @endif

            </h3>

            <div class="avatar-group -space-x-4 mt-6 mb-12">
                @if (!$item->users->count() && $this_date > $date)
                <div class="avatar bg-neutral xs:w-10 xs:h-10 sm:w-10 sm:h-10 md:w-14 md:h-14 lg:w-14 lg:h-14 border-2 border-neutral attendee" title="Be the first one to sign up!" data-id="0">
                    <img class="m-0" src="/public/images/avatars/generic.svg" />
                </div>
                @else
                    @foreach ($item->users as $user)
                    @if (!$user->remove_data)
                    <a class="avatar bg-neutral xs:w-10 xs:h-10 sm:w-10 sm:h-10 md:w-14 md:h-14 lg:w-14 lg:h-14 border-2 border-neutral attendee" href="/member/{{$user->username}}" title="{{ $user->name }} ({{ $user->username }})" data-id="{{ $user->id }}">
                        <img class="m-0" src="{{ isset($user->avatar) ? ('/public/images/avatars/' . $user->avatar) : ('/public/images/avatars/generic.svg') }}" />
                    </a>
                    @endif
                    @endforeach
                @endif
            </div>

            @endif

        @endif
        
        <p>
            <img class="border-1 w-full border-gray-700 rounded-2xl overflow-hidden mb-10 shadow-xl"
                 src="/public/images/item_covers/{{ isset($item->image) ? $item->image : 'default.jpg' }}"
                 alt="'{{ $item->name }}' main image.">
        </p>
        
        <p class="overflow-x-scroll">{!! $item->description !!}</p>
        
        <br>

        @if (isset($item->images) && $item->images->count())
            
        <div id="image-tiles" class="grid grid-cols-6 col-span-2 gap-2 mb-4">

            <?php $count = 0;
                  $max   = $item->images->count(); ?>

            @foreach ($item->images as $image)

            <?php $count++; ?>

            <div class=" overflow-hidden rounded-00 shadow-md {{ ($max > 1 && $count <= 2) || $max == 4 ? 'col-span-3 max-h-[14rem]' : ($max == 1 || ($count == 3 && $max == 3) ? 'col-span-6 max-h-[14rem]' : ($max == 5 ? 'col-span-2 max-h-[10rem]' : '')) }} flex relative cursor-pointer items-center justify-center">
                <div class="absolute z-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fill-blue-200 h-12"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352c79.5 0 144-64.5 144-144s-64.5-144-144-144S64 128.5 64 208s64.5 144 144 144z"/></svg>
                </div>
              <img id="img-{{ $count }}" onclick="showPopover({{ $count }})" class="h-full w-full m-0 object-cover tarnsition ease-in-out duration-300 hover:opacity-40 relative z-2"
                   src="/public/images/{{ $post ? 'post' : 'event' }}s/{{ $image->src }}"
                   alt="'{{ $item->name }}' attached image.">
            </div>

            @endforeach

        </div>

        <div id="img-popover" class="bg-base-300 bg-opacity-20 backdrop-blur-md fixed top-0 left-0 w-screen h-0 flex justify-center items-center transition ease-in-out duration-300 overflow-hidden  ">

            <button data-bound="" onclick="showPopover($(this).data('bound'))" class="prev btn btn-circle border-gray-700 shadow-xl mr-4">❮</button>
            <img class="rounded-xl shadow-xl border-gray-800 border-2" src="/public/images/{{ $post ? 'post' : 'event' }}s/{{ $item->images[0]->src }}" alt="Image preview">
            <button data-bound="" onclick="showPopover($(this).data('bound'))" class="next btn btn-circle border-gray-700 shadow-xl ml-4">❯</button>

        </div>
        
        @endif

        <p class="text-sm">
            Authored by <a href="/member/{{$item->author->username}}" class="transition ease-in-out duration-200 no-underline">
                {{ !$item->author->remove_data ? $item->author->name : 'Data removed' }} ({{ $item->author->username }})</a> on {{ date('F jS, Y', strtotime($item->created_at)) }}.
        </p>

        @if (count($updates))

        <?php $update = $updates->first(); ?>

        <div class="">
            <p class="text-sm m-0">
            Last revised by <a href="/member/{{$update->user->username}}" class="transition ease-in-out duration-200 no-underline">
                {{ $update->user->name }} ({{ $update->user->username }})</a> on {{ date('F jS, Y', strtotime($update->created_at)) }}.
            </p>
            @if (count($updates) > 1)
            <div tabindex="1" >
                <label for="invite" class="h-full font-bold mt-3 transition ease-in-out duration-200 hover:text-blue-600 no-underline cursor-pointer">
                    Revision history
                </label>
                <input tabindex="1" type="checkbox" id="invite" class="modal-toggle" />
                <div tabindex="1" class="modal">
                    <div class="modal-box relative">
                        <label for="invite" class="absolute mr-6 mt-6 top-0 right-0 cursor-pointer">
                            <svg class="relative ml-2 w-auto fill-blue-200 group-hover:fill-base-100" style="height: 21px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
                        </label>
                        <h3 class="font-bold text-lg text-blue-200 capitalize">The epic of uncertainty & poor spelling</h3>
                        <hr class="mb-4">
                        <ul class="p-0 mb-4">
                            @foreach ($updates as $update)
                            <li class="text-sm list-none p-0">
                                <a href="/member/{{$update->user->username}}" class="transition ease-in-out duration-200 no-underline">
                                    {{ $update->user->name }} ({{ $update->user->username }})
                                </a> {{ date('F jS, Y', strtotime($update->created_at)) }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif
        </div>

        @endif

        @if (Auth::check() && (Auth::user()->id == $item->author->id || (isset(Auth::user()->position) && ($post && (Auth::user()->position->edit_posts || Auth::user()->position->remove_posts) || (!$post && Auth::user()->position->edit_events || Auth::user()->position->remove_events)))))

        <p class="flex justify-end mt-10 xs:justify-start sm:justify-start">

            @if (Auth::user()->id == $item->author->id || (($post && Auth::user()->position->edit_posts) || (!$post && Auth::user()->position->edit_events)))
            
            <button onclick="toggleDeleteItem({{ $item->id }})" class="btn btn-outline btn-error hover:text-neutral xs:btn-sm sm:btn-sm xs:text-xs sm:text-xs">Delete {{ $post ? 'post' : 'event' }} &nbsp; <svg class="h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></button>
            
            @endif

            @if (Auth::user()->id == $item->author->id || (($post && Auth::user()->position->remove_posts) || (!$post && Auth::user()->position->remove_events)))

            <a href="/item-edit/{{ $post ? 'post' : 'event' }}/?id={{ $item->id }}" class="btn btn-primary hover:text-neutral ml-4 xs:btn-sm sm:btn-sm xs:text-xs sm:text-xs">Edit {{ $post ? 'post' : 'event' }} &nbsp; <svg class="h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg></a>
        
            @endif

        </p>

        @endif

        @if (!Auth::check())

        <div class="card w-full bg-gradient-to-r from-cyan-500 to-blue-500 text-primary-content mt-10 xs:py-4 sm:py-4 md:pt-0 lg:pt-0 md:pb-8 lg:pb-8 border-none shadow-xl">
            <div class="card-body pt-0">
                <h2 class="card-title text-white text-2xl mb-0">Join the discussion!</h2>
                <p class="text-white xs:text-md sm:text-md md:text-lg lg:text-lg">Only verified members can comment on posts and events.</p>
                <div class="card-actions justify-start mt-0 relative xs:w-full sm:w-full xs:flex-nowrap sm:flex-nowrap">
                    <a href="{{route('register')}}" class="btn text-white xs:btn-sm sm:btn-sm xs:text-xs sm:text-xs" id="mwsltr">Register</a>
                    <a href="{{route('login')}}" class="xs:ml-2 sm:ml-2 md:ml-4 lg:ml-4 btn text-neutral btn-outline border-2 xs:btn-sm sm:btn-sm xs:text-xs sm:text-xs">Login</a>
                </div>
            </div>
        </div>

        @endif

        @if (isset($item->comments) && ($item->comments->count() || (Auth::check() && Auth::user()->role->comment)))

        <hr class="my-4">

        <div class="flex flex-col">
            <h3 class="text-blue-200 mb-4">
                Comments
            </h3>

            @if (Auth::check() && Auth::user()->role->comment)

            <form id="add-comment" class="mb-8 flex">

                <a href="{{ route('member', ['user' => Auth::user()->username]) }}" tabindex="0" class="flex align-items-center">
                    <img class="rounded-full h-12 w-12 object-cover m-0" src="{{ isset(Auth::user()->avatar) ? '/public/images/avatars/' . Auth::user()->avatar : '/public/images/avatars/generic.svg' }}" alt="Profile picture">
                </a>

                <div class="w-full ml-2 relative">
                    <textarea id="post-comment" name="about" class="block w-full text-gray-100 border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm rounded-l-md rounded-r-full pr-12" placeholder="Got something to say?"></textarea>
                    <div onclick="sendReply($('#post-comment').val(), '{{ $post ? 'post' : 'event' }}', {{ $item->id }})" class="btn btn-sm btn-primary btn-circle absolute right-3 p-0 flex justify-center items-center" style="top: 13px"><svg class="h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L277.3 424.9l-40.1 74.5c-5.2 9.7-16.3 14.6-27 11.9S192 499 192 488V392c0-5.3 1.8-10.5 5.1-14.7L362.4 164.7c2.5-7.1-6.5-14.3-13-8.4L170.4 318.2l-32 28.9 0 0c-9.2 8.3-22.3 10.6-33.8 5.8l-85-35.4C8.4 312.8 .8 302.2 .1 290s5.5-23.7 16.1-29.8l448-256c10.7-6.1 23.9-5.5 34 1.4z"/></svg></div>
                </div>

            </form>

            @endif
            
            @foreach ($item->comments as $comment)

            <div id="comment-{{ $comment->id }}" class="comment relative grid grid-cols-1 w-full gap-4 px-4 mb-8 rounded-md bg-neutral shadow-lg">
                <div class="flex xs:flex-col sm:flex-col md:flex-row lg:flex-row w-full justify-between relative">
                    <a href="{{ route('member', ['user' => $comment->author->username]) }}" tabindex="0" class="flex align-items-center text-blue-100 hover:text-blue-100  no-underline mt-4 mb-2">
                        <img class="rounded-full h-12 w-12 object-cover m-0" src="@if (!$comment->author->remove_data && isset($comment->author->avatar)) {{ '/public/images/avatars/' . $comment->author->avatar }} @else {{ '/public/images/avatars/generic.svg' }} @endif" alt="Profile picture">
                        <div class="ml-3">
                            <div class="">{{ $comment->author->username }}</div>
                            <div class="text-gray-500 no-underline">{{ !$comment->author->remove_data ? $comment->author->name : 'Data removed' }}</div>
                        </div>
                    </a>
                    <p class="xs:my-0 sm:my-0 md:mt-4 lg:mt-4 xs:text-sm sm:text-sm">{{ date('F jS, Y, H:i:s', strtotime($comment->created_at)) }}</p>
                </div>
                <p class="m-0 text-blue-200 xs:text-sm sm:text-sm">{{ $comment->content }}</p>
                <div class="flex justify-end mb-4">
                    <?php $reply_count = isset($comment->replies) ? $comment->threadDepth() : 0; ?>

                    @if (Auth::check() && $comment->author->id != Auth::user()->id)
                        <div class="relative mt-3 mr-3">
                            <svg onclick="toggleReportItem({{ $comment->id }}, 'comment')" class="fill-current h-4 transition ease-in-out duration-200 hover:fill-error cursor-pointer" title="Report" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M64 32V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V32C0 14.3 14.3 0 32 0S64 14.3 64 32zm40.8 302.8c-3 .9-6 1.7-8.8 2.6V13.5C121.5 6.4 153 0 184 0c36.5 0 68.3 9.1 95.6 16.9l1.3 .4C309.4 25.4 333.3 32 360 32c26.8 0 52.9-6.8 73-14.1c9.9-3.6 17.9-7.2 23.4-9.8c2.7-1.3 4.8-2.4 6.2-3.1c.7-.4 1.1-.6 1.4-.8l.2-.1c9.9-5.6 22.1-5.6 31.9 .2S512 20.6 512 32V288c0 12.1-6.8 23.2-17.7 28.6L480 288c14.3 28.6 14.3 28.6 14.3 28.6l0 0 0 0-.1 0-.2 .1-.7 .4c-.6 .3-1.5 .7-2.5 1.2c-2.2 1-5.2 2.4-9 4c-7.7 3.3-18.5 7.6-31.5 11.9C424.5 342.9 388.8 352 352 352c-37 0-65.2-9.4-89-17.3l-1-.3c-24-8-43.7-14.4-70-14.4c-27.5 0-60.1 7-87.2 14.8z"/></svg>
                        </div>
                    @endif

                    @if ($reply_count)

                    <button data-alt="Hide thread" onclick="toggleThread({{ $comment->id }}, $(this))" class="view-thread btn border-none bg-transparent hover:text-teal-200 btn-sm mt-2">View {{ $reply_count }} repl{{$reply_count > 1 ? 'ies' : 'y'}}</button>

                    @endif

                    @if (Auth::check() && Auth::user()->role->comment)

                    <button onclick="renderReplyForm({{ $comment->id }})" class="reply btn btn-outline btn-sm ml-2 mt-2">Reply</button>

                    @endif

                </div>
            </div>

            @endforeach

        </div>

        @endif

    </article>

    <div class="pt-10">
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="w-parallax">
                <use class="fill-base-100 opacity-70" xlink:href="#gentle-wave" x="48" y="0"  />
                <use class="fill-base-200 opacity-50" xlink:href="#gentle-wave" x="48" y="3" />
                <use class="fill-base-300 opacity-30" xlink:href="#gentle-wave" x="48" y="5"  />
                <use class="fill-base-300" xlink:href="#gentle-wave" x="48" y="7"  />
            </g>
        </svg>
    </div>

</div>

<script src="/public/js/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad()</script>

@if (Auth::check())

    @if ($item->author->id != Auth::user()->id)
        @include('components.report-modal')
    @endif

    @if ((Auth::user()->id == $item->author->id || (isset(Auth::user()->position) && Auth::user()->position->remove_posts)))

    <div id="confirm-wrapper" class="overflow-hidden top-0 left-0 fixed w-full h-0 z-100 backdrop-blur-md bg-opacity-20 bg-base-300 flex justify-center items-center">
        <div class="card w-96 bg-error shadow-xl">
            <div class="card-body -100">
            <h2 class="card-title">WARNING!!!</h2>
            <p>Are you sure you want to proceed? This action cannot be reversed!</p>
            <div class="card-actions justify-end bg-transparent -100 border-base-100">
                <div onclick="toggleDeleteItem()" class="btn btn-primary bg-basse-100 bg-opacity-25 -100 border-2 border-transparent transition ease-in-out duration-200 hover:-100 hover:border-base-100 hover:bg-transparent">Cancel</div>
                <button data-id="" onclick="deletePost($(this).data('id'))" id="confirm" class="btn btn-primary bg-base-100 text-error border-2 border-base-100 transition ease-in-out duration-200 hover:bg-error hover:-100 hover:border-base-100">OK</button>  
            </div>
            </div>
        </div>
    </div>

    <script>
        window.type = '{{ $post ? 'post' : 'event' }}'

        function toggleDeleteItem(id = false) {
            if (id) {
                $('#confirm-wrapper button#confirm').data('id', id)
                setTimeout(() => {
                    $('#confirm-wrapper').removeClass('h-0').addClass('h-full')
                }, 10)
            } else {
                $('#confirm-wrapper').addClass('h-0').removeClass('h-full')
            }
        }

        function deletePost(id) {
            $.ajax({
                headers:     {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:         `/item-delete/${type}`,
                method:      "GET",
                data:        { id: id },
                success:     function (result) {
                    setTimeout(() => {
                        window.location.href = result.redirect
                    }, 100)
                },
                error: function (result) {
                    console.log(result)
                }
            });
        }
    </script>

    @endif

    @if (Auth::check() && Auth::user()->role->comment)

    <script>
        window.user = {
            route:  '{{ route('member', ['user' => Auth::user()->username]) }}',
            avatar: '{{ isset(Auth::user()->avatar) ? ('/public/images/avatars/' . Auth::user()->avatar) : ('/public/images/avatars/generic.svg') }}'
        }

        function sendReply(content, type, id, origin) {
            $.ajax({
                headers:     {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:         "/comment-create",
                method:      "POST",
                data:        {
                    content:   content,
                    item_type: type,
                    item_id:   id,
                    origin:    origin
                },
                success:     function (result) {
                    if (type == 'post' || type == 'event') {
                        ($('form#add-comment')[0]).insertAdjacentHTML('afterend', result.html)
                        $('form#add-comment textarea').val('')
                    } else {
                        $(`#comment-${id} .view-thread`).text(`View ${result.count} replies`)

                        if ($(`#comment-${id} .view-thread`).length && !$(`#comment-${id}`).parent().hasClass('thread') ) {
                            $('form#add-reply+.thread').length ? ($('form#add-reply+.thread')[0]).insertAdjacentHTML('afterbegin', result.html)
                                : $(`#comment-${id} .view-thread`).click()
                        } else {
                            $(`#comment-${id}`).parent().hasClass('thread') ? ($(`.thread #comment-${id}`)[0]).insertAdjacentHTML('afterend', result.html) : ($(`#comment-${id} .reply`)[0]).insertAdjacentHTML('afterend', `
                                <button data-alt="Hide thread" onclick="toggleThread(${id}, $(this))" class="view-thread btn border-none bg-transparent hover:text-teal-200 btn-sm mt-2">View ${result.count} repl${(result.count > 1 ? 'ies' : 'y')}</button>
                            `)
                            
                            setTimeout(() => {
                                $(`#comment-${id} .view-thread`).click()
                            }, 10)
                        }

                        setTimeout(() => {
                            $('#add-reply').remove()
                        }, 10)
                    }
                },
                error: function (result) {
                    console.log(result)
                }
            });
        }

        function renderReplyForm(id, origin = null) {
            if (!$(`#comment-${id}+#add-reply`).length && id) {
                $('#add-reply').remove()

                setTimeout(() => {
                    ($(`#comment-${id}`)[0]).insertAdjacentHTML('afterend', `
                    <form id="add-reply" class="mb-8 flex">
                        <a href="${user.route}" tabindex="0" class="flex align-items-center">
                            <img class="rounded-full h-12 w-12 object-cover m-0" src="${user.avatar}" alt="Profile picture">
                        </a>

                        <div class="w-full ml-2 relative">
                            <textarea id="reply-comment" class="block w-full text-gray-100 border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm rounded-l-md rounded-r-full pr-12" placeholder="Reply to this comment..."></textarea>
                            <div onclick="sendReply($('#reply-comment').val(), 'comment', ${id}, ${origin ? origin : id})" class="btn btn-sm btn-primary btn-circle absolute right-3 p-0 flex justify-center items-center" style="top: 13px"><svg class="h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L277.3 424.9l-40.1 74.5c-5.2 9.7-16.3 14.6-27 11.9S192 499 192 488V392c0-5.3 1.8-10.5 5.1-14.7L362.4 164.7c2.5-7.1-6.5-14.3-13-8.4L170.4 318.2l-32 28.9 0 0c-9.2 8.3-22.3 10.6-33.8 5.8l-85-35.4C8.4 312.8 .8 302.2 .1 290s5.5-23.7 16.1-29.8l448-256c10.7-6.1 23.9-5.5 34 1.4z"/></svg></div>
                        </div>

                    </form>`)
                }, 10);

            } else {
                $('#add-reply').remove()
            }
        }
    </script>

    @endif

@endif

<script>

    window.onload = function() {
        $('#img-popover').click(function(e) {
            !($(e.target).is('button') || $(e.target).is('img')) ? $('#img-popover').removeClass('h-screen').addClass('h-0') : null
        })
    }

    function subscribe(user_id, event_id, endpoint) {
        $.ajax({
            headers:    {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:        `/${endpoint}`,
            method:     "POST",
            data:       { event_id: event_id },
            success:    function (result) {
                $('#event-action').replaceWith(result.html);
                if (endpoint == 'events-unsubscribe') {
                    $(`.attendee[data-id="${user_id}"]`).remove();
                    setTimeout(() => {
                        !$(`.attendee`).length ? $('.avatar-group').append(`<div class="avatar bg-neutral w-14 h-14 border-2 border-neutral attendee" title="i saw that." data-id="0">
                                                                                <img class="m-0" src="/public/images/avatars/angry.svg" />
                                                                            </div>`) : null;
                    }, 10);
                } else {
                    $('.avatar-group').append(result.avatar);
                    $('.attendee[data-id="0"]').remove();
                }

                console.log(endpoint);
            },
            error:      function (result) {
                alert(result);
            }
        });
    }
    
    function showPopover(id) {
        let max = $('#image-tiles img').length

        $('#img-popover img').attr('src', $(`#img-${id}`).attr('src'))
        $('#img-popover .prev').data('bound', id > 1 ? id - 1 : max)
        $('#img-popover .next').data('bound', id < max ? id + 1 : 1)

        setTimeout(() => {
            $('#img-popover').hasClass('h-0') ? $('#img-popover').removeClass('h-0').addClass('h-screen') : null            
        }, 10);
    }

    function toggleThread(id, e) {
        if (e.data('alt') == 'Hide thread') {
            $.ajax({
                url:         "/comment-replies",
                method:      "GET",
                data:        { id: id },
                success:     function (result) {
                    ($(`#comment-${id}`)[0]).insertAdjacentHTML('afterend', result.html)
                    e.data('alt', e.text())
                    setTimeout(() => {
                        $('#add-reply').remove()
                        e.text('Hide thread')                        
                    }, 10);
                },
                error: function (result) {
                    console.log(result)
                }
            })
        } else {
            highlight()

            e.text(e.data('alt'))
            setTimeout(() => {
                $(`#comment-${id}+.thread`).length ? $(`#comment-${id}+.thread`).remove() : $(`#comment-${id}+#add-reply+.thread`).remove()
                e.data('alt', 'Hide thread')
            }, 10);
        }
    }

    function highlight(e = null) {
        $('.comment').removeClass('border-2').removeClass('border-blue-200').removeClass('border-opacity-20')

        e ? setTimeout(() => {
            e.addClass('border-2').addClass('border-blue-200').addClass('border-opacity-20')
        }, 10) : null
    }

</script>

@endsection