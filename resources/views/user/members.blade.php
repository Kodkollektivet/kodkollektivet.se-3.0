@extends('layouts.common')
@section('content')


<div class="hero mt-16 border-b-2 border-gray-800" style="background-image: url(/public/images/covers/default.jpg);">
  <div class="hero-overlay bg-opacity-60 "></div>
  <div class="hero-content text-center text-neutral-content py-32">
    <div class="max-w-md">
        <p class="mb-2 uppercase">Now viewing</p>
        <h1 class="text-5xl font-bold capitalize">{{ str_replace('-', ' ', Route::current()->role) . (in_array(Route::current()->role, ['Member', 'Guest']) ? 's' : '') }}</h1>
    </div>
  </div>
</div>

<div class="from-base-300 to-base-100 via-neutral bg-gradient-to-br pt-10 border-b-2 border-gray-800">
    <div class="max-w-2xl mx-auto md:pt-10 pb-24 px-4 flex sm:px-6 lg:max-w-7xl lg:pt-4 lg:pb-32 xs:flex-wrap sm:flex-wrap md:flex-nowrap flex-row items-stretch" style="min-height: 70vh">

        <div class="xs:w-full sm:w-full">
            <div class="md:sticky lg:sticky md:top-16 lg:top-16 xs:mb-20 sm:mb-20 border-gray-800 bg-base-100 overflow-hidden rounded-2xl shadow-xl md:mr-4 lg:mr-4">
                <div class="bg-base-300 hover:bg-base-300 text-gray-500 hover:text-gray-500 border-b border-gray-800">
                    <p class="uppercase text-sm font-semibold p-3">Roles</p>
                </div>
                <ul class="menu xs:w-full sm:w-full md:w-56 lg:w-56 text-gray-500 ">
                    <li>
                        <a href="{{ route('members', ['role' => 'All']) }}" class="transition ease-in-out duration-300 hover:text-blue-100 @if (Route::current()->role == 'All') active @endif">All ({{ $user_total }})</a>
                    </li>
                    @foreach ($roles as $role)
                    <li>
                        <a href="{{ route('members', ['role' => $role->name]) }}" class="transition ease-in-out duration-300 hover:text-blue-100 @if (Route::current()->role == $role->name) active @endif">{{ $role->name }} ({{ count($role->users) }})</a>
                    </li>
                    @endforeach
                    <li>
                        <a href="{{ route('members', ['role' => 'Company']) }}" class="transition ease-in-out duration-300 hover:text-blue-100 @if (Route::current()->role == 'Company') active @endif">Company ({{ $cmpn_total }})</a>
                    </li>
                    <li>
                        <a href="{{ route('members', ['role' => 'open-positions']) }}" class="transition ease-in-out duration-300 hover:text-blue-100 @if (Route::current()->role == 'open-positions') active @endif">Open positions ({{ $op_total }})</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="flex flex-col items-stretch w-full">
            <div class="flex flex-row justify-end mb-4 w-full">
                @if (Auth::user())

                    @if (!in_array(Auth::user()->role_id, [4, 5]))

                    <div tabindex="1" >
                        <label for="invite" class="modal-button text-cyan-400 border-1 border-gray-700 shadow-xl btn bg-base-100 transition ease-in-out duration-200 hover:btn-info active:btn-info focus:btn-info hover:text-base-100 active:text-base-100 focus:text-base-100">
                            Invite
                            <svg class="relative ml-2 w-auto fill-current group-hover:fill-base-100" style="top: -1.5px; height: 12px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M511.6 36.86l-64 415.1c-1.5 9.734-7.375 18.22-15.97 23.05c-4.844 2.719-10.27 4.097-15.68 4.097c-4.188 0-8.319-.8154-12.29-2.472l-122.6-51.1l-50.86 76.29C226.3 508.5 219.8 512 212.8 512C201.3 512 192 502.7 192 491.2v-96.18c0-7.115 2.372-14.03 6.742-19.64L416 96l-293.7 264.3L19.69 317.5C8.438 312.8 .8125 302.2 .0625 289.1s5.469-23.72 16.06-29.77l448-255.1c10.69-6.109 23.88-5.547 34 1.406S513.5 24.72 511.6 36.86z"/></svg>
                        </label>
                        <input tabindex="1" type="checkbox" id="invite" class="modal-toggle" />
                        @include('components.invite-modal')
                    </div>

                    @endif

                @else
                <a href="{{route('register')}}" type="button" title="more about" class="text-accent btn bg-base-100 transition ease-in-out duration-200 hover:btn-info active:btn-info focus:btn-info ">
                    Join us
                </a>
                @endif
            </div>

            @if ((isset($users) && $users->count()) || (isset($positions) && $positions->count()))

            <div class="w-full overflow-scroll rounded-2xl ">

                <table id="main-table" class="table text-blue-100 rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8 border-1 border-gray-800 rounded-b-2xl bg-base-100 w-full mb-0">
                    @yield('listing')
                </table>

            </div>

            @else

            <div class="flex justify-center items-center flex-col" style="min-height: 300px">

                <img class="h-96  w-96 object-contain xs:mt-4 sm:mt-4 md:mt-10 lg:mt-10" src="/public/images/svg/lost.svg" alt="No items in this category.">
        
                <h1 class="text-blue-200 md:mt-12 lg:mt-12 xs:text-md sm:text-md md:text-xl lg:text-xl font-mono font-bold italic md:w-2/3 lg:w-2/3 text-center">
                    // &nbsp;We are currently populating the website; plase, bear with us 🐻
                </h1>
        
            </div>

            @endif
        </div>

    </div>

</div>

@if (Auth::check() && Route::current()->role == 'open-positions')

<div id="apply" class="overflow-hidden top-0 left-0 fixed w-full h-0 z-100 backdrop-blur-md bg-opacity-20 bg-base-300 flex justify-center items-center transition ease-in-out duration-300">
    <div class="modal-box relative">
        <button onclick="toggleApply()" class="absolute mr-6 mt-6 top-0 right-0 cursor-pointer">
            <svg class="relative ml-2 w-auto fill-blue-200 group-hover:fill-base-100" style="height: 21px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
        </button>
        <h3 class="font-bold text-lg text-blue-200"></h3>
        <input type="hidden" name="id" id="id">
        <textarea name="message" id="message" placeholder="Why do you think this position would be right for you?" class="mt-4 block w-full rounded-md text-gray-100 border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 sm:text-sm h-48 overflow-scroll"></textarea>
        <div class="modal-action">
            <button onclick="sendApply()" class="btn hover:btn-info">
                Send
                <svg class="relative ml-2 w-auto fill-current group-hover:fill-base-100" style="top: -1.2px; height: 13.5px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M511.6 36.86l-64 415.1c-1.5 9.734-7.375 18.22-15.97 23.05c-4.844 2.719-10.27 4.097-15.68 4.097c-4.188 0-8.319-.8154-12.29-2.472l-122.6-51.1l-50.86 76.29C226.3 508.5 219.8 512 212.8 512C201.3 512 192 502.7 192 491.2v-96.18c0-7.115 2.372-14.03 6.742-19.64L416 96l-293.7 264.3L19.69 317.5C8.438 312.8 .8125 302.2 .0625 289.1s5.469-23.72 16.06-29.77l448-255.1c10.69-6.109 23.88-5.547 34 1.406S513.5 24.72 511.6 36.86z"/></svg>
            </button>
        </div>
    </div>
</div>

    @if ($view_applicants)

    <div id="app-view" class="overflow-hidden top-0 left-0 fixed w-full h-0 z-100 backdrop-blur-md bg-opacity-20 bg-base-300 flex justify-center items-center transition ease-in-out duration-300">
        <div class="modal-box relative">
            <button onclick="toggleView()" class="absolute mr-6 mt-6 top-0 right-0 cursor-pointer">
                <svg class="relative ml-2 w-auto fill-blue-200 group-hover:fill-base-100" style="height: 21px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
            </button>
            <div class="flex">
                <a href="" tabindex="0" class="flex align-items-center text-blue-100 hover:text-blue-100">
                    <img class="rounded-full h-12 w-12 object-cover" src="" alt="Profile picture">
                    <div class="ml-3">
                        <div id="username"></div>
                        <div id="name" class="text-gray-500"></div>
                    </div>
                </a>
            </div>
            <p class="mt-4 text-blue-200 p-2 rounded-md border-2 border-gray-800 border-opacity-20 bg-base-300"></p>

            @if ($application_decide)

            <div class="modal-action">
                <button onclick="toggleReply($(this).data('id'), 0)" data-id="" class="btn btn-ghost border-blue-200 text-blue-200 hover:btn-error">
                    Decline
                    <svg class="relative ml-2 w-auto fill-current group-hover:fill-base-100" style="top: -1.2px; height: 13.5px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M367.2 412.5L99.5 144.8C77.1 176.1 64 214.5 64 256c0 106 86 192 192 192c41.5 0 79.9-13.1 111.2-35.5zm45.3-45.3C434.9 335.9 448 297.5 448 256c0-106-86-192-192-192c-41.5 0-79.9 13.1-111.2 35.5L412.5 367.2zM512 256c0 141.4-114.6 256-256 256S0 397.4 0 256S114.6 0 256 0S512 114.6 512 256z"/></svg>
                </button>
                <button onclick="toggleReply($(this).data('id'), 1)" data-id="" class="btn border-neutral hover:btn-info">
                    Approve
                    <svg class="relative ml-2 w-auto fill-current group-hover:fill-base-100" style="top: -1.2px; height: 13.5px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M470.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L192 338.7 425.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
                </button>
            </div>

            @endif
            
        </div>
    </div>

        @if ($application_decide)

        <div id="app-reply" class="overflow-hidden top-0 left-0 fixed w-full h-0 z-100 backdrop-blur-md bg-opacity-20 bg-base-300 flex justify-center items-center transition ease-in-out duration-300">
            <div class="modal-box relative">
                <button onclick="toggleReply()" class="absolute mr-6 mt-6 top-0 right-0 cursor-pointer">
                    <svg class="relative ml-2 w-auto fill-blue-200 group-hover:fill-base-100" style="height: 21px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
                </button>
                <h3 class="font-bold text-lg text-blue-200"></h3>
                <input id="app-id" name="id" type="hidden">
                <input id="approved" name="approved" type="hidden">
                <textarea name="reply" class="mt-4 block w-full h-48 rounded-md text-gray-100 border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 sm:text-sm" placeholder="Motivate your decision!"></textarea>
                <div class="modal-action">
                    <button onclick="sendReply()" data-id="" class="btn btn-ghost border-blue-200 text-blue-200 hover:btn-error">
                        Decline
                        <svg class="relative ml-2 w-auto fill-current group-hover:fill-base-100" style="top: -1.2px; height: 13.5px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M367.2 412.5L99.5 144.8C77.1 176.1 64 214.5 64 256c0 106 86 192 192 192c41.5 0 79.9-13.1 111.2-35.5zm45.3-45.3C434.9 335.9 448 297.5 448 256c0-106-86-192-192-192c-41.5 0-79.9 13.1-111.2 35.5L412.5 367.2zM512 256c0 141.4-114.6 256-256 256S0 397.4 0 256S114.6 0 256 0S512 114.6 512 256z"/></svg>
                    </button>
                    <button onclick="sendReply()" data-id="" class="btn border-neutral hover:btn-info">
                        Approve
                        <svg class="relative ml-2 w-auto fill-current group-hover:fill-base-100" style="top: -1.2px; height: 13.5px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M470.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L192 338.7 425.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
                    </button>
                </div>
            </div>
        </div>

        @endif

    @endif

@endif

@endsection

