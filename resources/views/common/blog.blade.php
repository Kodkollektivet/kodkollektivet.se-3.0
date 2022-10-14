@extends('layouts.common')
@section('content')

<?php $route   = Request::route()->getName();
      $user    = strpos($route, 'blog') == false ? Request::route()->user : false;
      $tag_uri = $user ? "/posts/$user/" : "/blog/"; ?>

<div class="hero mt-16 border-b-2 border-gray-800" style="background-image: url(/public/images/static/static_6.jpg);">
    <div class="hero-overlay bg-opacity-60 "></div>
    <div class="hero-content text-center text-neutral-content py-32">
        <div class="max-w-md">
            <p class="mb-2 uppercase">
                {!! strpos($route, 'blog') !== false ? 'H3110 w0r1d!' : "Published by <a href='/member/$user'>$user</a>" !!}
            </p>
            <h1 class="text-5xl font-bold capitalize">{{ isset($tag) ? "#$tag" : 'Blog' }}</h1>
        </div>
    </div>
</div>
  
<div class="b-32 pt-20 from-base-300 to-base-100 via-neutra bg-gradient-to-br border-t-2 border-b-2 border-gray-800 col-start-1 row-start-1 h-auto w-full" id="blog-wrapper" data-tag="{{ $tag }}">
    
    <div class="flex justify-center items-stretch xs:flex-col sm:flex-col xs:px-6 sm:px-6">

        @if ($posts->count())

        <div class="w-max xs:w-full sm:w-full">
            <div class="md:sticky lg:sticky md:top-16 lg:top-16">

                @if (Auth::check() && isset(Auth::user()->position) && Auth::user()->position->create_posts)

                <div class="w-full md:pr-4 lg:pr-4 mb-4 mt-1">
                    <a href="/item-create/post/?comm=1" class="btn btn-outline btn-primary w-full">Write... &nbsp; <svg class="h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg></a>
                </div>

                @endif

                <div class="overflow-hidden rounded-2xl shadow-xl md:mr-4 lg:mr-4 border-1 border-gray-800 bg-base-100  bg-opacity-40 backdrop-blur">
                    
                    <ul class="menu w-56 text-gray-500 xs:w-full sm:w-full">

                        <li>
                            <div class="transition-none bg-base-100 border-b-2 border-gray-800 cursor-auto text-white font-semibold">Contributors</div>
                        </li>

                        @foreach ($authors as $author)
                        <li>
                            <a href="{{ route('user-posts', ['user' => $author]) . '/'}}" class="transition ease-in-out duration-300 hover:text-blue-100 {{ $user && $author == $user ? 'active' : '' }}">{{ $author }}</a>
                        </li>
                        @endforeach

                        @if ($user)
                        <li>
                            <a href="{{ route('blog') }}" class="transition ease-in-out duration-300 hover:text-blue-100">All posts</a>
                        </li>
                        @endif

                    </ul>

                </div>

                @if (isset($s_posts))

                <div class="overflow-hidden rounded-2xl shadow-xl md:mr-4 lg:mr-4 border-1 border-gray-800 bg-base-100 bg-opacity-40 backdrop-blur my-4">
                    
                    <ul id="sidebar-posts" class="menu md:w-56 lg:w-56 xs:w-full sm:w-full text-gray-500">

                        {!! $s_posts['r_posts'] !!}

                    </ul>

                    @if (isset($s_posts['r_pages']))

                    <div class="btn-group py-2 w-full flex justify-center">
                        <div>
                            <span id="sidebar-posts-pagi" class="relative z-0 inline-flex shadow-sm rounded-xl overflow-hidden">

                                {!! $s_posts['r_pages'] !!}

                            </span>
                        </div>
                    </div>

                    @endif

                </div>

                @endif
                
            </div>
        </div>

        <div>
            <div>

            @include('common.wall', [
                'posts'     => $posts,
                'total'     => $total,
                'tags'      => $tags,
                'tag'       => $tag,
                'authors'   => $authors,
                'community' => true
                ])

            </div>

        </div>

        @else

        <div class="flex justify-center items-center flex-col relative xs:-mt-10 sm:-mt-10" style="min-height: 300px">

            <img class="h-96 w-96 object-contain xs:px-4 sm:px-4" src="/public/images/svg/lost.svg" alt="No items in this category.">
    
            <h1 class="text-blue-200 md:mt-12 lg:mt-12 xs:text-md sm:text-md md:text-xl lg:text-xl font-mono font-bold italic md:w-2/3 lg:w-2/3 text-center">
                // &nbsp;We are currently populating the website; plase, bear with us 🐻
            </h1>
    
        </div>

        @endif

    </div>

    <div class="pt-10" id="pre-footer">
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

@endsection