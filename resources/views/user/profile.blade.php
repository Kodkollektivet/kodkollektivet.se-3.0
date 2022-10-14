@extends('layouts.common')

@section('content')


<?php $board = in_array($user->role_id, [1, 3]); ?>

<div id="cover-img" class="hero mt-16 h-80 border-b-2 border-gray-800 bg-fixed"style="background-image: url('/public/images/covers/{{ isset($user->profile->cover) ? $user->profile->cover : 'default.jpg' }}');">
  <div class="hero-overlay bg-opacity-60 "></div>
  <div class="hero-content text-center text-neutral-content py-32">
    <div class="max-w-md">
        @if (!$user->remove_data && isset($user->profile->status) )
        <p id="typed" class="mb-12 uppercase italic font-mono font-bold"></p>
        @elseif ($user->remove_data)
        <p class="mb-12 uppercase italic">This user has removed their data.</p>
        @endif
    </div>
  </div>
</div>

<div class="from-base-300 to-base-100 via-neutral bg-gradient-to-br pt-10 border-b-2 border-gray-800">
    <div class="max-w-2xl mx-auto px-4 flex sm:px-6 lg:max-w-7xl sm:flex-wrap mb-8 relative z-20">

        <div class="min-w-full flex flex-row rounded-2xl border-1 border-gray-800 bg-base-100 xs:p-1 sm:p-1 xs:pt-3 sm:pt-3 md:p-3 lg:p-3 bg-opacity-40 backdrop-blur -mt-32 relative">

            <div class="relative xs:mr-2 sm:mr-2 xs:mt-2 sm:mt-2">

                <img class="rounded-md object-cover xs:h-20 sm:h-20 xs:w-20 sm:w-20 h-40 w-40" src="@if (!$user->remove_data && isset($user->avatar)) {{ '/public/images/avatars/' . $user->avatar }} @else {{ '/public/images/avatars/generic.svg' }} @endif" alt="User" />

                @if ($user->online)
                <div
                    class="absolute -right-3 xs:bottom-6 sm:bottom-6 md:bottom-5 lg:bottom-5 h-5 w-5 rounded-full border-4 border-gray-800 bg-info"
                    title="User is online"></div>
                @else
                <div
                    class="absolute -right-3 xs:bottom-6 sm:bottom-6 md:bottom-5 lg:bottom-5 h-5 w-5 rounded-full border-4 border-gray-800 bg-warning"
                    title="User is offline"></div>
                @endif
            </div>

            <div class="flex flex-col xs:pl-4 sm:pl-4 md:pl-16 lg:pl-16 md:pr-6 lg:pr-6 w-max">
                <div class="flex h-8 flex-row">
                    <a id="user-wrapper" class="flex" href="/member/{{ $user->username }}">
                        <h2 class="text-lg font-semibold text-blue-100"> {{ $user->username }}</h2>
                        {!! $user->role_id == 5 ? '<div class="badge badge-error gap-2 ml-2 uppercase text-xs mt-1">Banned</div>' : '' !!}
                    </a>
                </div>

                @if (!$user->remove_data)
                <div class="my-2 flex xs:flex-col sm:flex-col md:flex-row lg:flex-row md:space-x-2 lg:space-x-2">

                    <div class="flex flex-row xs:pb-2 sm:pb-2">
                        <svg height="14" class="fill-gray-500 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M176 448C167.3 448 160 455.3 160 464V512h32v-48C192 455.3 184.8 448 176 448zM272 448c-8.75 0-16 7.25-16 16s7.25 16 16 16s16-7.25 16-16S280.8 448 272 448zM164 172l8.205 24.62c1.215 3.645 6.375 3.645 7.59 0L188 172l24.62-8.203c3.646-1.219 3.646-6.375 0-7.594L188 148L179.8 123.4c-1.215-3.648-6.375-3.648-7.59 0L164 148L139.4 156.2c-3.646 1.219-3.646 6.375 0 7.594L164 172zM336.1 315.4C304 338.6 265.1 352 224 352s-80.03-13.43-112.1-36.59C46.55 340.2 0 403.3 0 477.3C0 496.5 15.52 512 34.66 512H128v-64c0-17.75 14.25-32 32-32h128c17.75 0 32 14.25 32 32v64h93.34C432.5 512 448 496.5 448 477.3C448 403.3 401.5 340.2 336.1 315.4zM64 224h13.5C102.3 280.5 158.4 320 224 320s121.8-39.5 146.5-96H384c8.75 0 16-7.25 16-16v-96C400 103.3 392.8 96 384 96h-13.5C345.8 39.5 289.6 0 224 0S102.3 39.5 77.5 96H64C55.25 96 48 103.3 48 112v96C48 216.8 55.25 224 64 224zM104 136C104 113.9 125.5 96 152 96h144c26.5 0 48 17.88 48 40V160c0 53-43 96-96 96h-48c-53 0-96-43-96-96V136z"/></svg>
                        <div class="text-xs text-gray-400/80 hover:text-gray-400"> {{ $user->name }} </div>
                    </div>

                    <div class="flex flex-row xs:pb-2 sm:pb-2">
                        <svg height="14" class="fill-gray-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M414.8 40.79L286.8 488.8C281.9 505.8 264.2 515.6 247.2 510.8C230.2 505.9 220.4 488.2 225.2 471.2L353.2 23.21C358.1 6.216 375.8-3.624 392.8 1.232C409.8 6.087 419.6 23.8 414.8 40.79H414.8zM518.6 121.4L630.6 233.4C643.1 245.9 643.1 266.1 630.6 278.6L518.6 390.6C506.1 403.1 485.9 403.1 473.4 390.6C460.9 378.1 460.9 357.9 473.4 345.4L562.7 256L473.4 166.6C460.9 154.1 460.9 133.9 473.4 121.4C485.9 108.9 506.1 108.9 518.6 121.4V121.4zM166.6 166.6L77.25 256L166.6 345.4C179.1 357.9 179.1 378.1 166.6 390.6C154.1 403.1 133.9 403.1 121.4 390.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4L121.4 121.4C133.9 108.9 154.1 108.9 166.6 121.4C179.1 133.9 179.1 154.1 166.6 166.6V166.6z"/></svg>
                        <div id="role-text" class="text-xs text-gray-400/80 hover:text-gray-400 capitalize">
                            {{ $user->role->name }}
                            {{ isset($user->position_id) ? ' / ' . $user->position->name : ($user->role_id == 1 ? ' / Unspecified' : '') }}
                        </div>
                    </div>

                    <div class="flex flex-row xs:pb-2 sm:pb-2">
                        <svg height="14" class="fill-gray-500 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M207.8 20.73c-93.45 18.32-168.7 93.66-187 187.1c-27.64 140.9 68.65 266.2 199.1 285.1c19.01 2.888 36.17-12.26 36.17-31.49l.0001-.6631c0-15.74-11.44-28.88-26.84-31.24c-84.35-12.98-149.2-86.13-149.2-174.2c0-102.9 88.61-185.5 193.4-175.4c91.54 8.869 158.6 91.25 158.6 183.2l0 16.16c0 22.09-17.94 40.05-40 40.05s-40.01-17.96-40.01-40.05v-120.1c0-8.847-7.161-16.02-16.01-16.02l-31.98 .0036c-7.299 0-13.2 4.992-15.12 11.68c-24.85-12.15-54.24-16.38-86.06-5.106c-38.75 13.73-68.12 48.91-73.72 89.64c-9.483 69.01 43.81 128 110.9 128c26.44 0 50.43-9.544 69.59-24.88c24 31.3 65.23 48.69 109.4 37.49C465.2 369.3 496 324.1 495.1 277.2V256.3C495.1 107.1 361.2-9.332 207.8 20.73zM239.1 304.3c-26.47 0-48-21.56-48-48.05s21.53-48.05 48-48.05s48 21.56 48 48.05S266.5 304.3 239.1 304.3z"/></svg>
                        <div class="text-xs text-gray-400/80 hover:text-gray-400">{{ $user->email }}</div>
                    </div>
                </div>
                @endif

                <div class="mt-2 flex flex-row items-center space-x-5 xs:hidden sm:hidden">

                    @if ($board)
                    <a href="{{ route('member', ['user' => $user->username]) }}/community-posts" class="flex h-20 w-40 flex-col items-center justify-center rounded-md border-1 transition ease-in-out duration-300 hover:bg-primary bg-opacity-40 backdrop-blur text-gray-500 hover:text-base-300 shadow-xl px-2 py-12 sm:px-2 lg:px-2 border-1 bg-base-100 border-gray-800">
                        <div class="flex flex-row items-center justify-center">
                            <svg class="mr-3 fill-current" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" height="24" viewBox="0 0 24 24">
                            <path
                                d="M2.5 19.6L3.8 20.2V11.2L1.4 17C1 18.1 1.5 19.2 2.5 19.6M15.2 4.8L20.2 16.8L12.9 19.8L7.9 7.9V7.8L15.2 4.8M15.3 2.8C15 2.8 14.8 2.8 14.5 2.9L7.1 6C6.4 6.3 5.9 7 5.9 7.8C5.9 8 5.9 8.3 6 8.6L11 20.5C11.3 21.3 12 21.7 12.8 21.7C13.1 21.7 13.3 21.7 13.6 21.6L21 18.5C22 18.1 22.5 16.9 22.1 15.9L17.1 4C16.8 3.2 16 2.8 15.3 2.8M10.5 9.9C9.9 9.9 9.5 9.5 9.5 8.9S9.9 7.9 10.5 7.9C11.1 7.9 11.5 8.4 11.5 8.9S11.1 9.9 10.5 9.9M5.9 19.8C5.9 20.9 6.8 21.8 7.9 21.8H9.3L5.9 13.5V19.8Z" />
                            </svg>

                            <span class="font-bold "> {{ $community_post_count }} </span>
                        </div>

                        <div class="mt-2 text-sm ">community posts</div>
                    </a>
                    @endif

                    <div
                        class="flex h-20 w-40 flex-col items-center justify-center rounded-md border-1 transition ease-in-out duration-300 hover:bg-primary bg-opacity-40 backdrop-blur text-gray-500 hover:text-base-300 shadow-xl px-2 py-12 sm:px-2 lg:px-2 border-1 bg-base-100 border-gray-800">
                        <div class="flex flex-row items-center justify-center">
                            
                            <svg class="mr-3 fill-current" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M256 287.4V32c0-17.67-14.31-32-32-32S192 14.33 192 32v216.3C218.7 248.4 243.7 263.1 256 287.4zM170.8 251.2c2.514-.7734 5.043-1.027 7.57-1.516L93.41 51.39C88.21 39.25 76.34 31.97 63.97 31.97c-20.97 0-31.97 18.01-31.97 32.04c0 4.207 .8349 8.483 2.599 12.6l81.97 191.3L170.8 251.2zM416 224c-17.69 0-32 14.33-32 32v64c0 17.67 14.31 32 32 32s32-14.33 32-32V256C448 238.3 433.7 224 416 224zM320 352c17.69 0 32-14.33 32-32V224c0-17.67-14.31-32-32-32s-32 14.33-32 32v96C288 337.7 302.3 352 320 352zM368 361.9C356.3 375.3 339.2 384 320 384c-27.41 0-50.62-17.32-59.73-41.55c-7.059 21.41-23.9 39.23-47.08 46.36l-47.96 14.76c-1.562 .4807-3.147 .7105-4.707 .7105c-6.282 0-12.18-3.723-14.74-9.785c-.8595-2.038-1.264-4.145-1.264-6.213c0-6.79 4.361-13.16 11.3-15.3l46.45-14.29c17.2-5.293 29.76-20.98 29.76-38.63c0-34.19-32.54-40.07-40.02-40.07c-3.89 0-7.848 .5712-11.76 1.772l-104 32c-18.23 5.606-28.25 22.21-28.25 38.22c0 4.266 .6825 8.544 2.058 12.67L68.19 419C86.71 474.5 138.7 512 197.2 512H272c82.54 0 151.8-57.21 170.7-134C434.6 381.8 425.6 384 416 384C396.8 384 379.7 375.3 368 361.9z"/></svg>

                            <span class="font-bold "> {{ count($user->events) }} </span>
                        </div>

                        <div class="mt-2 text-sm ">events partaking</div>
                    </div>

                    <div
                        class="flex h-20 w-40 flex-col items-center justify-center rounded-md border-1 transition ease-in-out duration-300 hover:bg-primary bg-opacity-40 backdrop-blur text-gray-500 hover:text-base-300 shadow-xl px-2 py-12 sm:px-2 lg:px-2 border-1 bg-base-100 border-gray-800">
                        <div class="flex flex-row items-center justify-center">
                            <svg class="mr-3 fill-current" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" height="24" viewBox="0 0 24 24">
                            <path
                                d="M5.68,19.74C7.16,20.95 9,21.75 11,21.95V19.93C9.54,19.75 8.21,19.17 7.1,18.31M13,19.93V21.95C15,21.75 16.84,20.95 18.32,19.74L16.89,18.31C15.79,19.17 14.46,19.75 13,19.93M18.31,16.9L19.74,18.33C20.95,16.85 21.75,15 21.95,13H19.93C19.75,14.46 19.17,15.79 18.31,16.9M15,12A3,3 0 0,0 12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12M4.07,13H2.05C2.25,15 3.05,16.84 4.26,18.32L5.69,16.89C4.83,15.79 4.25,14.46 4.07,13M5.69,7.1L4.26,5.68C3.05,7.16 2.25,9 2.05,11H4.07C4.25,9.54 4.83,8.21 5.69,7.1M19.93,11H21.95C21.75,9 20.95,7.16 19.74,5.68L18.31,7.1C19.17,8.21 19.75,9.54 19.93,11M18.32,4.26C16.84,3.05 15,2.25 13,2.05V4.07C14.46,4.25 15.79,4.83 16.9,5.69M11,4.07V2.05C9,2.25 7.16,3.05 5.68,4.26L7.1,5.69C8.21,4.83 9.54,4.25 11,4.07Z" />
                            </svg>

                            <span class="font-bold "> {{ count($user->projects) }} </span>
                        </div>

                        <div class="mt-2 text-sm ">projects involved in</div>
                    </div>
                </div>
            </div>

            @if (Auth::check())

            <div class="w-100 flex flex-grow flex-col items-end justify-start absolute right-2">
                <div class="flex flex-row space-x-3">

                    @if (Auth::user()->id != $user->id && !in_array(Auth::user()->role_id, [4, 5]))

                    <button id="toggle-follow" onclick="toggleFollow({{ $user->id }})" class="flex rounded-md {{ $following ? 'bg-warning hover:brightness-90 hover:-hue-rotate-30' : 'bg-teal-400 hover:bg-primary'}} py-2 px-4 text-base-300 transition ease-in-out duration-300 xs:absolute xs:-top-20 xs:-right-2 sm:absolute sm:-top-20 sm:-right-2">
                        @if ($following) <span class="text-xl font-bold my-0 mr-2 leading-4">– </span> Unfollow @else <svg class="mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" height="24" viewBox="0 0 24 24"><path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg> Follow @endif
                    </button>

                    @endif

                    @if (Auth::user()->id != $user->id || (Auth::user()->id == $user->id && !in_array($user->role_id, [4, 5])))

                    <div class="dropdown dropdown-end">

                        <label tabindex="0" class="flex rounded-md bg-gray-100 py-2 px-1 text-white transition-all duration-150 ease-in-out hover:bg-gray-200 cursor-pointer">
                            <div>
                                <svg class="fill-gray-500" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" height="24" viewBox="0 0 24 24"><path d="M12,16A2,2 0 0,1 14,18A2,2 0 0,1 12,20A2,2 0 0,1 10,18A2,2 0 0,1 12,16M12,10A2,2 0 0,1 14,12A2,2 0 0,1 12,14A2,2 0 0,1 10,12A2,2 0 0,1 12,10M12,4A2,2 0 0,1 14,6A2,2 0 0,1 12,8A2,2 0 0,1 10,6A2,2 0 0,1 12,4Z" /></svg>
                            </div>
                        </label>

                        <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box">

                            @if (Auth::user()->id != $user->id)
                            
                            <li>
                                <p onclick="toggleReportItem({{ $user->id }}, 'user')" class="p-2 transition ease-in-out duration-200 text-blue-200 hover:text-teal-200">Report</p>
                            </li>

                                @if (isset(Auth::user()->position_id) && Auth::user()->position->edit_users)

                                <li>
                                    <a href="/edit-profile/?user={{ $user->id }}" class="p-2 transition ease-in-out duration-200 text-blue-200 hover:text-teal-200">Edit</a>
                                </li>

                                @endif

                                @if ($allow_ban)

                                <li>
                                    <p onclick="toggleConfirmBan({{ $user->id }})" id="ban-text" class="p-2 transition ease-in-out duration-200 text-blue-200 hover:text-teal-200 capitalize">{{ $user->role_id == 5 ? 'unban' : 'ban' }}</p>
                                </li>

                                @endif

                            @else

                            <li>
                                <a href="/edit-profile" class="p-2 transition ease-in-out duration-200 text-blue-200 hover:text-teal-200">Settings</a>
                            </li>

                            @endif

                        </ul>

                    </div>

                    @endif

                </div>
            </div>

            @endif


        </div>

    </div>

    <div class="max-w-2xl mx-auto md:pt-10 pb-24 px-4 flex sm:px-6 lg:max-w-7xl lg:pt-4 lg:pb-32 xs:flex-wrap sm:flex-wrap md:flex-nowrap flex-row items-stretch relative z-10" style="min-height: 70vh">
        <div class="xs:w-full sm:w-full">
            <div class="md:sticky lg:sticky md:top-16 lg:top-16 xs:mb-20 sm:mb-20 ">

                @if (Auth::check() && $user->username == Auth::user()->username && Auth::user()->role->post)

                <div class="w-full md:pr-4 lg:pr-4 mb-4 mt-1">
                    <a href="/item-create/post" class="btn btn-outline btn-primary w-full">Write... &nbsp; <svg class="h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg></a>
                </div>

                @endif

                <div class="overflow-hidden rounded-2xl shadow-xl md:mr-4 lg:mr-4 border-1 border-gray-800 bg-base-100 bg-opacity-40 backdrop-blur">
                    
                    <ul class="menu xs:w-full sm:w-full w-56 text-gray-500 ">
                        <li>
                            <a href="{{ route('member', ['user' => $user->username]) }}" class="transition ease-in-out duration-300 hover:text-blue-100 @if (Route::current()->page == '') active @endif">About</a>
                        </li>

                        @foreach ($routes as $route)

                            @if ($board || $route != 'Community Posts')
                            <?php $a_route = str_replace(' ', '-', strtolower($route)); ?>
                            <li>
                                <a href="{{ route('member', ['user' => $user->username]) . '/' . $a_route }}" class="transition ease-in-out duration-300 hover:text-blue-100 @if (Route::current()->page == $a_route) active @endif">{{ $route }}</a>
                            </li>
                            @endif

                        @endforeach

                        @if (Auth::check() && Auth::user()->id == $user->id)

                            <li>
                                <a href="{{ route('member', ['user' => $user->username]) }}/notifications" class="transition ease-in-out duration-300 hover:text-blue-100 @if (Route::current()->page == 'notifications') active @endif">Notifications</a>
                            </li>

                        @endif

                    </ul>
                </div>

                @if (isset($personal_posts['s_posts']))

                <div class="overflow-hidden rounded-2xl shadow-xl mr-4 border-1 border-gray-800 bg-base-100 bg-opacity-40 backdrop-blur my-4">
                    
                    <ul id="sidebar-posts" class="menu w-56 text-gray-500">

                        {!! $personal_posts['s_posts']['r_posts'] !!}

                    </ul>
                    
                    @if (isset($personal_posts['s_posts']['r_pages']))

                    <div class="btn-group py-2 w-full flex justify-center">
                        <div>
                            <span id="sidebar-posts-pagi" class="relative z-0 inline-flex shadow-sm rounded-xl overflow-hidden">

                                {!! $personal_posts['s_posts']['r_pages'] !!}

                            </span>
                        </div>
                    </div>

                    @endif
                </div>

                @endif

            </div>
        </div>

        @yield('usertab')

    </div>

</div>

@if ($allow_ban) 

<div id="confirm-wrapper" class="overflow-hidden top-0 left-0 fixed w-full h-0 z-100 backdrop-blur-md bg-opacity-20 bg-base-300 flex justify-center items-center">
    <div class="card w-96 bg-error shadow-xl">
        <div class="card-body -100">
            <h2 class="card-title capitalize">{{ $user->role_id == 5 ? "un" : "" }}ban user?</h2>
            <p>Are you sure you want to {{ $user->role_id == 5 ? "un" : "" }}ban {{ $user->username }}? {{ $user->role_id == 5 ? "Their role will be set to 'member'." : "They won't be able to use any of the website's functionality." }}</p>
            <div class="card-actions justify-end bg-transparent border-base-100 mt-2">
                <div onclick="toggleConfirmBan()" class="btn btn-primary bg-basse-100 bg-opacity-25 -100 border-2 border-transparent transition ease-in-out duration-200 hover:-100 hover:border-base-100 hover:bg-transparent">Cancel</div>
                <button data-id="" onclick="toggleBan($(this).data('id'))" id="confirm" class="btn btn-primary bg-base-100 text-error border-2 border-base-100 transition ease-in-out duration-200 hover:bg-error hover:-100 hover:border-base-100">OK</button>  
            </div>
        </div>
    </div>
</div>

<script>
    window.headers = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

    function toggleConfirmBan(id = false) {
        setTimeout(() => {
            if (id) {
                $('#confirm-wrapper button#confirm').data('id', id)
                setTimeout(() => {
                    $('#confirm-wrapper').removeClass('h-0').addClass('h-full')
                }, 10)
            } else {
                $('#confirm-wrapper').addClass('h-0').removeClass('h-full')
            }
        }, 10)
    }

    function toggleBan(id) {
        $.ajax({
            headers:     headers,
            url:         "/ban-user",
            method:      "POST",
            data:        {id: id},
            success:     function (result) {
                $('#role-text').text(result.role)
                $('#ban-text').text(result.button)
                $('#confirm-wrapper h2').text(`User ${result.button == 'unban' ? '' : 'un'}banned!`)
                $('#user-wrapper .badge').length ? $('#user-wrapper .badge').remove() : $('#user-wrapper').append('<div class="badge badge-error gap-2 ml-2 uppercase text-xs mt-1">Banned</div>')
                setTimeout(() => {
                    toggleConfirmBan()
                }, 1000)

                setTimeout(() => {
                    $('#confirm-wrapper h2').text(`${result.button == 'unban' ? 'un' : ''}ban user?`)
                    $('#confirm-wrapper p').text(result.confirm)
                }, 1010);
            }
        })
    }
</script>

@endif

@if (isset($actions) && Auth::check() && Auth::user()->username == $user->username)

<script>
    window.onload = function() {
        $('#activity-toggle').click(function() {
            activityToggle()
        })
    }

    function activityToggle() {
        $.ajax({
            headers:     {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:         "/activity-toggle",
            method:      "POST",
            success:     function (result) {
                $('#activity-comment').html(result.comment)
                $('#activity-toggle').text(result.button)
            },
            error: function (result) {
                console.log(result)
            }
        })
    }
</script>

@endif

@if (Auth::check() && Auth::user()->username != $user->username)

@include('components.report-modal')

<script>
    function toggleFollow(id) {
        $.ajax({
            headers:     {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:         "/follow-user",
            method:      "POST",
            data:        {id: id},
            success:     function (result) {
                $('#toggle-follow').html(result.button)
                result.button.includes('Unfollow') ? $('#toggle-follow').removeClass('bg-teal-400').removeClass('hover:bg-primary').addClass('bg-warning')
                                                                        .addClass('hover:brightness-90').addClass('hover:-hue-rotate-30')
                                                   : $('#toggle-follow').addClass('bg-teal-400').addClass('hover:bg-primary').removeClass('bg-warning')
                                                                        .removeClass('hover:brightness-90').removeClass('hover:-hue-rotate-30')
            }
        })
    }
</script>

@endif

@endsection

