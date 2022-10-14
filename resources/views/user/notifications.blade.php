@extends('user.profile')

@section('usertab')

<div class="flex flex-col items-stretch w-full">

    @if (Auth::check() && Auth::user()->id == $user->id)
        
        @if (isset($notifications) && $notifications->count() && Auth::check())

        <h2 class="text-xl font-extrabold tracking-tight text-gray-200 p-3 mt-4">
            Notifications
        </h2>

        <div class="w-full overflow-scroll rounded-2xl ">
                
            <table class="table text-blue-100 rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8 border-1 border-gray-800 rounded-b-2xl overflow-hidden bg-base-100">
                <thead class="bg-base-300 text-gray-500 mb-4 border-b rounded-t-2xl border-gray-800">
                    <tr>
                        <th class="p-3">New</th>
                    </tr>
                </thead>
                <tbody class="appearance-none rounded-b-2xl border-0 border-gray-800">

                    @foreach ($notifications as $notif)
                    <tr class="bg-base-100 bg-none transition ease-in-out duration-300 hover:bg-neutral  border-0 appearance-none overflow-hidden notif-new">
                        <td class="appearance-none p-3 dropdown dropdown-hover border-0">
                            @if ($notif->action->item_type == 'invite')
                            <a onclick="viewNotification($(this))" data-id="{{ $notif->id }}" data-url="/member/{{ $notif->action->user->username }}" class="cursor-pointer text-gray-500 font-semibold transition ease-in-out duration-200">
                            @else
                            <a href="/member/{{ $notif->action->user->username }}" class="text-gray-500 font-semibold transition ease-in-out duration-200">
                            @endif
                                {{ $notif->action->user->username }}&nbsp;
                            </a>
    
                            @if (isset($notif->action->actual))

                            {{ $notif->action->action }} {{ $notif->action->item_type }}: <span onclick="viewNotification($(this))" data-id="{{ $notif->id }}" data-url="/{{ $notif->action->actual->link }}" class="transition ease-in-out duration-200 hover:text-blue-600 cursor-pointer">"{{ $notif->action->actual->name }}".</span>
                        
                            @elseif (isset($notif->deleteLog))

                            {{ $notif->action->action }} your {{ $notif->action->item_type }}: {{ json_decode($notif->action->deleteLog->item)->name }}.

                            @else

                            {{ $notif->action->action }} your {{ $notif->action->item_type . ($notif->action->item_type == 'invite' ? ' to join the website! 🔥' : '.') }}

                            @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>

            </table>
        </table>

        @if ($notifications->count() < $user->notifications->count())

        <div class="flex justify-end">
            <div onclick="viewLastWeek($(this))" class="btn bg-base-100 transition ease-in-out duration-200 hover:btn-warning active:btn-success focus:btn-warning hover:text-neutral active:text-neutral focus:text-neutral">Show viewed</div>
        </div>

        @endif

        <script>
            window.headers = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

            function viewNotification(e) {
                $.ajax({
                    headers:     headers,
                    url:         "/view-notification",
                    method:      "POST",
                    data:        { id: e.data('id') },
                    success:     function (result) {
                        e.data('url') ? window.location.href = e.data('url') : e.remove()
                    }
                })
            }

            function viewLastWeek(e) {
                e.addClass('loading')

                if (e.text() == 'Show viewed') {
                    e.text('Hide viewed')
                    $.ajax({
                        headers:     headers,
                        url:         "/display-notifications-viewed",
                        method:      "POST",
                        success:     function (result) {
                            ($('.notif-new').last()[0]).insertAdjacentHTML('afterend',  result.html)
                        }
                    })
                } else {
                    e.text('Show viewed')
                    $('.notif-old').remove()
                }

                setTimeout(() => {
                    e.removeClass('loading')
                }, 100);

            }
        </script>

        @else

        <div class="flex justify-center items-center flex-col" style="min-height: 300px">

            <img class="h-96  w-96 object-contain " src="/public/images/svg/lost.svg" alt="No notifications.">

            <h1 class="text-blue-200 mt-12 text-xl font-mono font-bold italic">
                // &nbsp;There seems to be nothing here..
            </h1>

        </div>

        @endif

    @else

    <script>
        window.location.href = '/member/{{$user->username}}'
    </script>

    @endif

</div>

@endsection