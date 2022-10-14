@extends('user.profile')

@section('usertab')

<div class="flex flex-col items-stretch w-full">

    @if (!$user->remove_data && $actions->count() && (!$user->activity_hide || (Auth::check() && (Auth::user()->role_id == 1 || Auth::user()->position_id == 14 || Auth::user()->id == $user->id))))

    <h2 class="text-xl font-extrabold tracking-tight text-gray-200 p-3 mt-4">
        Other Activity <span id="activity-comment" class="text-gray-500 italic text-sm"> &nbsp;&nbsp;&nbsp;&nbsp;//&nbsp; {{ $user->activity_hide ? 'hidden from non-admins' : 'visible to everyone' }}</span>
    </h2>
            
    <div class="w-full overflow-scroll rounded-2xl ">

        <table class="table text-blue-100 rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8 border-1 border-gray-800 rounded-b-2xl overflow-hidden bg-base-100">
            <thead class="bg-base-300 text-gray-500 mb-4 border-b rounded-t-2xl border-gray-800">
                <tr>
                    <th class="p-3">Recent</th>
                </tr>
            </thead>
            <tbody class="appearance-none rounded-b-2xl border-0 border-gray-800">

                @foreach ($actions as $action)
                <tr class="bg-base-100 bg-none transition ease-in-out duration-300 hover:bg-neutral  border-0 appearance-none overflow-hidden ">
                    <td class="appearance-none p-3 dropdown dropdown-hover border-0">
                        <span class="text-gray-500 font-semibold">
                            {{ $user->name }}
                        </span>
                        @if (isset($action->actual))

                        {{ $action->action }} {{ $action->item_type }}: <a href="/{{ $action->actual->link }}" class="transition ease-in-out duration-200 ">"{{ $action->actual->name }}".</a>
                    
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

        <div id="activity-toggle" class="btn bg-base-100 transition ease-in-out duration-200 hover:btn-warning active:btn-success focus:btn-warning hover:text-neutral active:text-neutral focus:text-neutral">
            {{ !$user->activity_hide ? 'Hide my activity' : 'Display for everyone' }}
        </div>

        @endif

    </div>

    @else

    <div class="flex justify-center items-center flex-col relative xs:-mt-20 sm:-mt-20" style="min-height: 300px">

        <img class="h-96  w-96 object-contain " src="/public/images/svg/lost.svg" alt="Activity hidden.">

        <h1 class="text-blue-200 md:mt-12 lg:mt-12 xs:text-md sm:text-md md:text-xl lg:text-xl font-mono font-bold italic md:w-2/3 lg:w-2/3 text-center">
            // &nbsp;The user has hidden their activity.
        </h1>


    </div>

    @endif

</div>

@endsection