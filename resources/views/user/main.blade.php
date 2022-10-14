@extends('user.profile')

@section('usertab')
    @if (Auth::check() && Auth::user()->id == $user->id && !$user->remove_data && !(isset($user->profile->about) && strlen($user->profile->about) && isset($user->profile->cover) && isset($user->avatar) && $user->technologies->count()))

    <div id="prompt-wrapper" class="flex absolute top-12  w-full left-0 justify-center items-center">
        <div class="alert alert-info shadow-lg mt-10 border-0 w-max flex">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current flex-shrink-0 w-6 h-6 xs:hidden sm:hidden"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span id="prompt" class="ml-4 mr-2">{{ !in_array(Auth::user()->role_id, [4, 5]) ? 'Your profile looks quite empty; what do we do about this?.. 🤔' : (Auth::user()->role_id == 4 ? 'Verify your email address to customize the profile and share content!' : 'Whoops! Looks like you got banned before you cound configure your page... 🤔') }}</span>
            </div>
            <a {{ !in_array(Auth::user()->role_id, [4, 5]) ? 'href=/edit-profile/?prompt=true' : (Auth::user()->role_id == 4 ? 'onclick=verifyResend($("#prompt"))' : '') }} class="btn btn-sm text-xs btn-outline border-neutral text-neutral hover:text-info hover:bg-neutral hover:border-neutral">
                {{ !in_array(Auth::user()->role_id, [4, 5]) ? 'Fix this!' : 'Resend verification' }}
            </a>
        </div>
    </div>

    @endif

    <div class="flex flex-col items-stretch w-full">

        <h2 class="text-xl font-extrabold tracking-tight text-gray-200 p-3 pt-0 font-mono">
            {{ $user->remove_data ? 'Data removed' : $user->name }}
        </h2>
    
        <div class="rounded-2xl shadow-xl border-1 border-gray-800 bg-base-100  bg-opacity-40 backdrop-blur p-3 relative">

            <h2 class="text-blue-200 mb-2 text-lg font-bold">About:</h2>

            <p class="text-gray-400 text-md font-bold mt-3">
                @if (!$user->remove_data && isset($user->profile->about) && strlen($user->profile->about))
                {!! $user->profile->about .'&nbsp;&nbsp;<span id="profile-data-toggle" onclick="profileDataToggle()">Show more</span>' !!}
                @elseif ($user->remove_data)
                Data removed.
                @else
                No bio yet. Sad.
                @endif
            </p>
            
            @if (!$user->remove_data)

            <table id="profile-data" class="mt-4 overflow-hidden h-0 opacity-0 pointer-events-none transition ease-in-out duration-300 absolute">
                <tbody>
                @foreach (['discord', 'github', 'facebook', 'linkedin', 'website', 'campus', 'programme', 'LOE'] as $key)
                    @if (isset($user->profile->$key))
                    <?php $key != 'LOE' ? null : $nf = new NumberFormatter('en_US', NumberFormatter::ORDINAL); ?>

                    <tr class="text-gray-400 text-md mt-3">
                        <td class="pr-2 py-2">
                            <span class="font-bold capitalize mr-2">{{ $key != 'LOE' ? $key : 'Level of education' }}:</span>
                        </td>
                        <td class="p-2">
                            {{ $user->profile->$key . ($key != 'LOE' ? '' : " ({$nf->format($user->profile->year)} year)") }}
                        </td>
                    </tr>
                    
                    @endif
                @endforeach

                @if (isset($user->position_id))

                <tr class="text-gray-400 text-md mt-3">
                    <td  class="pr-2 py-2">
                        <span class="font-bold capitalize">Position:</span>
                    </td>
                    <td  class="p-2">
                        {{ $user->position->name }} {{ isset($user->profile->date_started) ? "(since ". date('F jS, Y', strtotime($user->profile->date_started)) .")" : '' }}
                    </td>
                </tr>

                @endif
                </tbody>
            </table>

            @endif

            <h2 class="text-blue-200 mt-4 pt-2 mb-1 text-lg font-bold">Technologies:</h3>

            <p class="text-gray-400 text-md mt-2 italic">
                @if (!$user->remove_data && isset($techs))
                
                    @foreach ($techs as $type => $items)

                    <h3 class="text-blue-200 mb-3 mt-4 font-bold tech-item {{ $type != 'Programming / markup languages' ? 'tech-hide' : '' }}">{{ $type }}:</h3>

                    <div class="grid grid-cols-12 gap-2 tech-item {{ $type != 'Programming / markup languages' ? 'tech-hide' : '' }}">
                        
                        @foreach ($items as $tech)

                        <?php $icon = isset($tech->icon) ? "<i class='scale-125 mr-2 devicon-" . $tech->icon . "'></i>"
                                    : "<svg height='14' class='fill-current mr-2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 512'><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M392.8 1.2c-17-4.9-34.7 5-39.6 22l-128 448c-4.9 17 5 34.7 22 39.6s34.7-5 39.6-22l128-448c4.9-17-5-34.7-22-39.6zm80.6 120.1c-12.5 12.5-12.5 32.8 0 45.3L562.7 256l-89.4 89.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l112-112c12.5-12.5 12.5-32.8 0-45.3l-112-112c-12.5-12.5-32.8-12.5-45.3 0zm-306.7 0c-12.5-12.5-32.8-12.5-45.3 0l-112 112c-12.5 12.5-12.5 32.8 0 45.3l112 112c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256l89.4-89.4c12.5-12.5 12.5-32.8 0-45.3z'/></svg>"; ?>

                        <div class="xs:col-span-6 sm:col-span-6 md:col-span-2 lg:col-span-2 rounded-md bg-opacity-75 bg-base-300 shadow-sm">                                
                            <div class="mt-1 flex">
                                <div class="flex items-center justify-center h-8 w-full rounded-md text-gray-100 sm:text-sm">
                                    {!! $icon !!} {{ $tech->name }}
                                </div>
                            </div>
                        </div>

                        @endforeach

                        @if ($type == 'Programming / markup languages' && count($items) < $user->technologies->count())

                        <div onclick="toggleUserTech()" id="tech-toggle" class="xs:col-span-6 sm:col-span-6 md:col-span-2 lg:col-span-2 rounded-md bg-opacity-75 bg-base-300 transition ease-in-out duration-200 hover:bg-indigo-500 cursor-pointer shadow-sm">                                
                            <div class="mt-1 flex">
                                <div id="inner" class="flex items-center justify-center h-8 w-full rounded-md text-gray-100 sm:text-sm">
                                    Show more
                                </div>
                            </div>
                        </div>

                        @endif
                        
                    </div>

                    @endforeach

                @elseif ($user->remove_data)
                Data removed.
                @else
                Hasn't added their skillset yet (what a bore).
                @endif
            </p>

        </div>

        @if ($community_posts && $community_post_count)

        <h2 class="text-xl font-extrabold tracking-tight text-gray-200 p-3 mt-4">
            Community Posts
        </h2>
    
        <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-2 xl:grid-cols-2 xl:gap-x-8">

            @foreach ($community_posts as $post)

            <a href="/post/{{ $post->link }}/?id={{ $post->id }}" class="card group bg-base-100 border-gray-800 shadow-xl text-gray-200 transition ease-in-out duration-200 hover:text-cyan-300">
                <div class="w-full h-60  rounded-lg rounded-b-none overflow-hidden ">
                    <img src="/public/images/item_covers/{{ isset($post->image) ? $post->image : 'default.jpg' }}" alt="Post {{ $post->name }} cover image." class="transition decoration-fuchsia-300 ease-in-out duration-300 w-full h-full object-center object-cover group-hover:opacity-75 group-hover:scale-105">
                </div>
                <div class="card-body h-1/3">
                    <h3 class="text-sm text-cyan-300">{{ date('F jS, Y', strtotime($post->created_at)) }}</h3>
                    <p class="mt-1 text-lg font-medium">{{ $post->name }}</p>
                </div>
            </a>

            @endforeach
    
        </div>
        <div class="flex flex-row justify-end mt-4">

            @if (Auth::check() && $user->username == Auth::user()->username && $user->position->create_posts)

            <a href="/item-create/post/?comm=1" type="button" class="mr-4 btn bg-base-100 transition ease-in-out duration-200 hover:btn-success active:btn-success focus:btn-success hover:text-neutral active:text-neutral focus:text-neutral">
                Create new
            </a>

            @endif

            <a href="{{ route('user-posts', ['user' => $user->username]) }}" type="button" class="text-accent btn bg-base-100 transition ease-in-out duration-200 hover:btn-info active:btn-info focus:btn-info ">
                View more
            </a>
        </div>

        @endif

        @if ($personal_posts && $personal_posts->count())

        <h2 class="text-xl font-extrabold tracking-tight text-gray-200 p-3 mt-4">
            Personal Posts
        </h2>
    
        <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-2 xl:grid-cols-2 xl:gap-x-8">
            
        @foreach ($personal_posts as $post)

            <a href="/post/{{ $post->link }}/?id={{ $post->id }}" class="card group bg-base-100 border-gray-800 shadow-xl text-gray-200 transition ease-in-out duration-200 hover:text-cyan-300">
                <div class="w-full h-60  rounded-lg rounded-b-none overflow-hidden ">
                    <img src="/public/images/item_covers/{{ isset($post->image) ? $post->image : 'default.jpg' }}" alt="Post {{ $post->name }} cover image." class="transition decoration-fuchsia-300 ease-in-out duration-300 w-full h-full object-center object-cover group-hover:opacity-75 group-hover:scale-105">
                </div>
                <div class="card-body h-1/3">
                    <h3 class="text-sm text-cyan-300">{{ date('F jS, Y', strtotime($post->created_at)) }}</h3>
                    <p class="mt-1 text-lg font-medium">{{ $post->name }}</p>
                </div>
            </a>

        @endforeach
    
        </div>

        <div class="flex flex-row justify-end my-4">

            @if (Auth::check() && $user->username == Auth::user()->username && $user->role->post)

            <a href="/item-create/post" type="button" class="mr-4 btn bg-base-100 transition ease-in-out duration-200 hover:btn-success active:btn-success focus:btn-success hover:text-neutral active:text-neutral focus:text-neutral">
                Create new
            </a>
    
            @endif

            <a href="{{ route('member', ['user' => $user->username]) }}/personal-posts" type="button" title="more about" class="text-accent btn bg-base-100 transition ease-in-out duration-200 hover:btn-info active:btn-info focus:btn-info ">
                View more
            </a>
        </div>

        @endif

        @if (isset($actions) && $actions->count() && (!$user->activity_hide || (Auth::check() && (Auth::user()->role_id == 1 || Auth::user()->position_id == 14 || Auth::user()->id == $user->id))))

        <h2 class="text-xl font-extrabold tracking-tight text-gray-200 p-3 mt-4">
            Other Activity <span id="activity-comment" class="text-gray-400 italic text-sm"> &nbsp;&nbsp;&nbsp;&nbsp;//&nbsp; {{ $user->activity_hide ? 'hidden from non-admins' : 'visible to everyone' }}</span>
        </h2>
                
        <div class="w-full overflow-scroll rounded-2xl ">

            <table class="table text-blue-100 rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8 border-1 border-gray-800 rounded-b-2xl overflow-hidden bg-base-100">
                <thead class="bg-base-300 text-gray-400 mb-4 border-b rounded-t-2xl border-gray-800">
                    <tr>
                        <th class="p-3">Recent</th>
                    </tr>
                </thead>
                <tbody class="appearance-none rounded-b-2xl border-0 border-gray-800">

                    @foreach ($actions as $action)
                    <tr class="bg-base-100 bg-none transition ease-in-out duration-300 hover:bg-neutral  border-0 appearance-none overflow-hidden ">
                        <td class="appearance-none p-3 dropdown dropdown-hover border-0">
                            <span class="text-gray-400 font-semibold">
                                {{ $user->name }}
                            </span>

                            @if (isset($action->actual))

                            {{ $action->action }} {{ $action->item_type }}: <a href="/{{ $action->actual->link }}" class="transition ease-in-out duration-200 ">{{ $action->actual->name }}.</a>
                        
                            @elseif (isset($action->deleteLog))

                            {{ $action->action }} {{ $action->item_type }}: {{ json_decode($action->deleteLog->item)->name }}.

                            @else

                            {{ $action->action }} {{ ($action->item_type == 'event' ? 'an ' : ($action->item_type == 'invite' ? 'the ' : 'a ')) . $action->item_type . ($action->item_type == 'invite' ? ' to join the website! 🔥' : '.')}}

                            @endif

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
    
        </div>

        <div class="flex flex-row justify-end my-4">

            @if (Auth::check() && Auth::user()->username == $user->username)

            <div id="activity-toggle" class="mr-4 btn bg-base-100 transition ease-in-out duration-200 hover:btn-warning active:btn-success focus:btn-warning hover:text-neutral active:text-neutral focus:text-neutral">
                {{ !$user->activity_hide ? 'Hide my activity' : 'Display for everyone' }}
            </div>

            @endif

            <a href="{{ route('member', ['user' => $user->username]) }}/other-activity" type="button" class="text-accent btn bg-base-100 transition ease-in-out duration-200 hover:btn-info active:btn-info focus:btn-info ">
                View more
            </a>
        </div>

        @endif

    </div>

    <script>
        function profileDataToggle() {
            if (!$('#profile-data').hasClass('loading')) {
                $('#profile-data').addClass('loading')

                if ($('#profile-data').hasClass('h-0') ) {
                    $('#profile-data').removeClass('absolute')
                    $('#profile-data-toggle').text('Show less')

                    setTimeout(() => {
                        $('#profile-data').removeClass('h-0').removeClass('opacity-0').removeClass('pointer-events-none').removeClass('loading')
                    }, 310)
                } else {
                    $('#profile-data').addClass('h-0').addClass('opacity-0').addClass('pointer-events-none')
                    $('#profile-data-toggle').text('Show more')

                    setTimeout(() => {
                        $('#profile-data').addClass('absolute').removeClass('loading')
                    }, 310)
                }
            }
        }

        function toggleUserTech() {
            if (!$('.tech-item.loading').length) {
                let toggler = $('#tech-toggle')
                    $('#tech-toggle').remove()

                if ($('.tech-item.tech-hide').length) {
                    toggler.find('#inner').text('Show less')
                    $('.tech-item.tech-hide').removeClass('tech-hide').addClass('tech-show')
                } else {
                    toggler.find('#inner').text('Show more')
                    $('.tech-item.tech-show').removeClass('tech-show').addClass('tech-hide')
                }

                setTimeout(() => {
                    $('.tech-item:not(.tech-hide)').last().append(toggler)
                }, 10);
            }
        }
    </script>

@endsection