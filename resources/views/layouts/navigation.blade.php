
<div class="navbar px-4 py-2 sticky top-0 z-30 backdrop-blur transition-all duration-100 
    text-base-content shadow-sm border-b border-gray-700 bg-opacity-75 bg-base-300">
        <div class="flex-1">
          <a href="/" class="p-0 normal-case text-xl transition ease-in-out duration-200 font-semibold hover:text-teal-200">Kodkollektivet</a>
        </div>

        <div class="flex-none">
            @if (Auth::check() && Auth::user()->role_id == 4)

            <a onclick="verifyResend($(this))" class="btn border-none bg-transparent text-accent hover:text-teal-200 btn-sm text-xs xs:hidden">Resend verification email <svg class="ml-2 h-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L277.3 424.9l-40.1 74.5c-5.2 9.7-16.3 14.6-27 11.9S192 499 192 488V392c0-5.3 1.8-10.5 5.1-14.7L362.4 164.7c2.5-7.1-6.5-14.3-13-8.4L170.4 318.2l-32 28.9 0 0c-9.2 8.3-22.3 10.6-33.8 5.8l-85-35.4C8.4 312.8 .8 302.2 .1 290s5.5-23.7 16.1-29.8l448-256c10.7-6.1 23.9-5.5 34 1.4z"/></svg></a>

            @endif

          <ul class="menu menu-horizontal p-0 ">

            <li title="Menu" class="xs:block sm:block md:hidden lg:hidden" onclick="toggleNav()">
                <svg class="h-12 mr-2 fill-blue-200 transition ease-in-out duration-200 hover:fill-teal-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
            </li>

            <li>
                <a id="nav-projects" class="transition ease-in-out duration-200 hover:text-teal-200 xs:hidden" href="/projects">Projects</a>
            </li>
            <li>
                <a id="nav-events" class="transition ease-in-out duration-200 hover:text-teal-200 xs:hidden" href="/events">Events</a>
            </li>
            <li>
                <a id="nav-blog" class="transition ease-in-out duration-200 hover:text-teal-200 xs:hidden" href="/blog">Blog</a>
            </li>

            @if (isset(Auth::user()->position_id) && (Auth::user()->position->create_events || Auth::user()->position->edit_social))

            <li class="xs:hidden" tabindex="4">
                <a class="transition ease-in-out duration-200 hover:text-teal-200">
                    Admin
                    <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/></svg>
                </a>
                <ul tabindex="4" class="menu menu-compact dropdown-content p-2 shadow bg-base-100 rounded-box ">

                    @if (isset(Auth::user()->position->create_events))
                    <li class="w-full">
                        <a href="/item-create/event" class="transition ease-in-out duration-200 hover:text-teal-200">Create event</a>
                    </li>
                    @endif

                    @if (isset(Auth::user()->position->create_posts))
                    <li class="w-full">
                        <a href="/item-create/post/?comm=1" class="transition ease-in-out duration-200 hover:text-teal-200">Community post</a>
                    </li>
                    @endif
        
                    @if (isset(Auth::user()->position->edit_social))
        
                    <li class="w-full">
                        <a href="/social-media" class="transition ease-in-out duration-200 hover:text-teal-200">Edit social links</a>
                    </li>
        
                    @endif

                    <li class="w-full">
                        <a href="/reports" class="transition ease-in-out duration-200 hover:text-teal-200">View reports ({{ \App\Models\Report::where('resolved', 0)->count(); }})</a>
                    </li>

                    <li class="w-full">
                        <a onclick="doorbellToggle()" id="doorbell" class="transition ease-in-out duration-200 hover:text-teal-200">{{ env('DOORBELL_ACTIVE') ? 'Disable doorbell' : 'Enable doorbell' }}</a>
                    </li>
                </ul>
            </li>

            <script>
                function doorbellToggle() {
                    $.ajax({
                        url:         '/toggle-doorbell',
                        method:      "GET",
                        success:     function (result) {
                            result.option ? $('#doorbell').text(`${result.option} doorbell`) : null
                        },
                        error: function (result) {
                            
                        }
                    })
                }
            </script>

            @endif

            <li tabindex="0" class="xs:hidden">
                <a href="{{ route('members', ['role' => 'All']) }}" class="transition ease-in-out duration-200 hover:text-teal-200">
                    Members
                    <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/></svg>
                </a>
                <ul class="p-2 bg-base-100 transition ease-in-out duration-300">
                    <li>
                        <a href="{{ route('members', ['role' => 'Board']) }}" class="p-2 transition ease-in-out duration-200 hover:text-teal-200">Board</a>
                    </li>
                    <li>
                        <a href="{{ route('members', ['role' => 'open-positions']) }}" class="p-2 transition ease-in-out duration-200 hover:text-teal-200">Open positions</a>
                    </li>
                </ul>
            </li>
            
            @if (Auth::check())
            <div class="dropdown dropdown-end">
                <label tabindex="1" class="btn btn-ghost btn-circle avatar xs:btn-sm xs:mt-2">
                  <div class="w-full rounded-full">
                    @if (isset(Auth::user()->avatar))
                    <img src="/public/images/avatars/{{ Auth::user()->avatar }}" />
                    @else
                    <img src="/public/images/avatars/generic.svg" />
                    @endif
                  </div>
                </label>
                <ul tabindex="1" class="menu dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-36  ">
                    <li class="w-full">
                        <a class="w-full p-2" href="{{ route('member', ['user' => Auth::user()->username]) }}" :active="{{request()->routeIs('member', ['user' => Auth::user()->username]) }}">Profile</a>
                    </li>
                    @if (!in_array(Auth::user()->role_id, [4, 5]))
                    <li class="w-full">
                        <a class="w-full p-2" href="{{ route('edit-profile') }}">Settings</a>
                    </li>
                    @endif
                    <li class="w-full">
                        <a class="w-full p-2" href="/member/{{ Auth::user()->username }}/notifications">Notifications ({{ Auth::user()->notifications->whereNull('viewed')->count(); }})</a>
                    </li>

                    @if (!in_array(Auth::user()->role_id, [4, 5]))
                    <li class="w-full">
                        <a class="w-full p-2" href="/item-create/post">Post</a>
                    </li>
                    @endif

                    <li class="w-full">
                        <form class="w-full p-2" method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a class="w-full" :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                Log out
                            </a>

                        </form>
                    </li>
                </ul>
            </div>

            @else

            <a href="{{ route('login') }}" class="btn border-none bg-transparent hover:text-teal-200 btn-sm mt-2 mr-2 xs:hidden">Sign in</a>

            <a href="{{ route('register') }}" class="btn btn-outline btn-sm mt-2 xs:hidden">Sign up</a>

            @endif
          </ul>

        </div>
      </div>


      <ul id="mob-nav" class="menu menu-vertical xs:block sm:block md:hidden lg:hidden p-0 fixed w-0  h-screen overflow-scroll left-0 top-0 bg-gradient-to-r from-neutral to-base-300 transition ease-in-out duration-600" style="z-index: 100000">
        <br><br>

        @if (!Auth::check())

        <div class="absolute top-10 left-2">
            <a href="{{ route('login') }}" class="btn border-none bg-transparent hover:text-teal-200 btn-sm mt-2 mr-2">Sign in</a>

            <a href="{{ route('register') }}" class="btn btn-outline btn-sm mt-2">Sign up</a>
    
        </div>

        @endif

        <li title="Menu" class="absolute top-10 right-4" onclick="toggleNav()">
            <svg class="h-12 fill-blue-200 transition ease-in-out duration-200 hover:fill-teal-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M175 175C184.4 165.7 199.6 165.7 208.1 175L255.1 222.1L303 175C312.4 165.7 327.6 165.7 336.1 175C346.3 184.4 346.3 199.6 336.1 208.1L289.9 255.1L336.1 303C346.3 312.4 346.3 327.6 336.1 336.1C327.6 346.3 312.4 346.3 303 336.1L255.1 289.9L208.1 336.1C199.6 346.3 184.4 346.3 175 336.1C165.7 327.6 165.7 312.4 175 303L222.1 255.1L175 208.1C165.7 199.6 165.7 184.4 175 175V175zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z"/></svg>
        </li>

        <br><br><br>

        <li>
            <a id="nav-projects" class="transition ease-in-out duration-200 text-blue-200 hover:text-teal-200" href="/projects">Projects</a>
        </li>
        <li>
            <a id="nav-events" class="transition ease-in-out duration-200 text-blue-200 hover:text-teal-200" href="/events">Events</a>
        </li>
        <li>
            <a id="nav-blog" class="transition ease-in-out duration-200 text-blue-200 hover:text-teal-200" href="/blog">Blog</a>
        </li>

        @if (Auth::check())
        
            @if (isset(Auth::user()->position_id) && (Auth::user()->position->create_events || Auth::user()->position->edit_socia))
        
                <li class="w-full">
                    <a class="text-teal-200 uppercase cursor-default hover:text-teal-200 hover:bg-transparent ">Admin:</a>
                </li>
        
                @if (isset(Auth::user()->position->create_events))
                <li class="w-full px-4">
                    <a href="/item-create/event" class="transition ease-in-out duration-200 text-blue-200 hover:text-teal-200">Create event</a>
                </li>
                @endif

                @if (isset(Auth::user()->position->create_posts))
                <li class="w-full px-4">
                    <a href="/item-create/post/?comm=1" class="transition ease-in-out duration-200 text-blue-200 hover:text-teal-200">Community post</a>
                </li>
                @endif

                @if (isset(Auth::user()->position->edit_social))

                <li class="w-full px-4">
                    <a href="/social-media" class="transition ease-in-out duration-200 text-blue-200 hover:text-teal-200">Edit social links</a>
                </li>

                @endif

                <li class="w-full px-4">
                    <a href="/reports" class="transition ease-in-out duration-200 text-blue-200 hover:text-teal-200">View reports ({{ \App\Models\Report::where('resolved', 0)->count(); }})</a>
                </li>

        
            @endif

        @endif
    
        <li class="w-full">
            <a class="text-teal-200 uppercase cursor-default hover:text-teal-200 hover:bg-transparent ">Members:</a>
        </li>
        <li class="w-full px-4">
            <a href="{{ route('members', ['role' => 'All']) }}" class="transition ease-in-out duration-200 text-blue-200 hover:text-teal-200">Members</a>
        </li>
        <li class="w-full px-4">
            <a href="{{ route('members', ['role' => 'Board']) }}" class="transition ease-in-out duration-200 text-blue-200 hover:text-teal-200">Board</a>
        </li>
        <li class="w-full px-4">
            <a href="{{ route('members', ['role' => 'open-positions']) }}" class="transition ease-in-out duration-200 text-blue-200 hover:text-teal-200">Open positions</a>
        </li>
        
      </ul>

      <script>
        function toggleNav() {
            $('#mob-nav').hasClass('w-0') ? $('#mob-nav').addClass('w-screen').removeClass('w-0') : $('#mob-nav').removeClass('w-screen').addClass('w-0')
        }
      </script>