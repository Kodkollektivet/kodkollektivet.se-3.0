@extends('user.members')

@section('listing')

<thead class="bg-base-300 text-gray-500 mb-4 border-b rounded-t-2xl border-gray-800">
    <tr>
        <th class="p-3"><span class="xs:hidden sm:hidden">Member</span></th>
        <th class="p-3">Status</th>
        <th class="p-3 text-left">Role</th>
    </tr>
</thead>
<tbody class="appearance-none rounded-b-2xl border-0 border-gray-800">

    @foreach ($users as $user)

        @if (!(in_array(Route::current()->role, ['Member', 'Guest']) && $user->company))

        <tr class="bg-base-100 cursor-pointer bg-none transition ease-in-out duration-300 hover:bg-neutral  border-0 appearance-none overflow-hidden ">
            <td class="appearance-none p-3 dropdown dropdown-hover border-0 w-max">
                <a href="{{ route('member', ['user' => $user->username]) }}" tabindex="0" class="flex align-items-center text-blue-100 hover:text-blue-100">
                    <img class="rounded-full h-12 w-12 object-cover" src="@if (!$user->remove_data && isset($user->avatar)) {{ '/public/images/avatars/' . $user->avatar }} @else {{ '/public/images/avatars/generic.svg' }} @endif" alt="Profile picture">
                    <div class="ml-3">
                        <div class="">{{ $user->username }}</div>
                        <div class="text-gray-500">{{ !$user->remove_data ? $user->name : 'Data removed' }}</div>
                    </div>
                    @if (!$user->remove_data && isset($user->profile) && isset($user->profile->status))
                    <div tabindex="0" class="dropdown-content menu shadow bg-info text-neutral rounded-box px-2 mt-12 ml-8 border-3 border-neutral py-1 xs:hidden sm:hidden">
                        {{ $user->profile->status }}
                    </div>
                    @endif
                </a>
            </td>
            <td tabindex="1" class="appearance-none p-3  border-0">
                <div class="dropdown dropdown-hover">
                    @if ($user->online)
                    <div class="badge bg-info  border-0 text-neutral text-xs ml-2">&nbsp;</div>
                    <div tabindex="1" class="dropdown-content menu shadow bg-base-300 rounded-box px-2 border-3 border-neutral py-1 -mt-2 ml-4">
                        Online
                    </div>
                    @else
                    <div class="badge text-neutral  border-0 bg-warning text-xs ml-2">&nbsp;</div>
                    <div tabindex="1" class="dropdown-content menu shadow bg-base-300 rounded-box px-2 border-3 border-neutral py-1 -mt-2 ml-4">
                        Offline
                    </div>
                    @endif
                </div>
            </td>
            <td class="appearance-none p-3  border-0">
                <div class="flex align-items-center">
                    <div class="text-gray-500 font-semibold">
                        @if (!$user->remove_data)
                        {{ $user->role->name }}
                        {{ isset($user->position_id) ? ' / ' . $user->position->name : ($user->role_id == 1 ? ' / Unspecified' : '') }}
                        @else
                        Data removed
                        @endif
                    </div>
                </div>
            </td>
        </tr>

        @endif

    @endforeach
</tbody>

@endsection