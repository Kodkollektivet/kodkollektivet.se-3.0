@extends('user.members')

@section('listing')

<thead class="bg-base-300 text-gray-500 mb-4 border-b rounded-t-2xl border-gray-800">
    <tr>
        <th class="p-3" style="z-index: 0;">Position</th>
        <th class="p-3">Type</th>
        <th class="p-3 text-left">Applications</th>
        <th class="p-3 text-left">Apply</th>
    </tr>
</thead>
<tbody class="appearance-none rounded-b-2xl border-0 border-gray-800">
    @foreach ($positions as $position)
    <tr class="position-{{ $position->id }} bg-base-100 bg-none transition ease-in-out duration-300 hover:bg-opacity-20 hover:bg-neutral border-0 appearance-none overflow-hidden ">
        <td class="appearance-none p-3 h-full border-0">
            <a class="text-blue-100 hover:text-blue-100">
                {{ $position->name }}
            </a>
        </td>
        <td class="appearance-none p-3 h-full border-0">
            <p class="text-blue-100">
                {{ $position->name == 'Moderator' ? 'Member' : 'Board' }}
            </p>
        </td>
        
        <td class="appearance-none p-3 h-full border-0">

            @if ($view_applicants && $position->applications->count())

            <button id="count-{{ $position->id }}" onclick="viewApplications({{ $position->id }})" class="btn btn-sm hover:text-secondary">
                View ({{ $position->applications->count() }})
            </button>

            @else

            <p id="count-{{ $position->id }}" class="text-blue-100">
                {{ $position->applications->count() ? $position->applications->count() : 'No applications' }}
            </p>

            @endif

        </td>

        <td class="appearance-none p-3 h-full border-0">
            <button onclick="{{ !Auth::check() ? 'window.location.href = \'/register\'' : 'toggleApply(' . $position->id .', "'. $position->name .'")' }}" class="btn btn-sm hover:text-secondary">
                Apply
            </button>
        </td>
    </tr>

    @if ($position->applications->count())

    <tr class="position position-{{ $position->id }} bg-base-300 text-gray-500 mb-4 border-0 appearance-none w-full hidden overflow-hidden">
        <td class="p-3">Applicant</th>
        <td class="p-3">Currently</th>
        <td class="p-3 text-left">Message</th>
        <td class="p-3 text-left">Date</th>
    </tr>

        @foreach ($position->applications as $application)

        <tr class="position position-{{ $position->id }} app-{{ $application->id }} bg-base-100 bg-none border-gray-800 border-b-2 appearance-none hidden overflow-hidden">
            <td class="appearance-none p-3 border-0">
                <a href="{{ route('member', ['user' => $application->user->username]) }}" tabindex="0" class="flex align-items-center text-blue-100 hover:text-blue-100">
                    <img class="rounded-full h-12 w-12 object-cover" src="@if (!$application->user->remove_data && isset($application->user->avatar)) {{'/public/images/avatars/' . $application->user->avatar }} @else {{ '/public/images/avatars/generic.svg' }} @endif" alt="Profile picture">
                    <div class="ml-3">
                        <div class="">{{ $application->user->username }}</div>
                        <div class="text-gray-500">{{ !$application->user->remove_data ? $application->user->name : 'Data removed' }}</div>
                    </div>
                </a>
            </td>
            <td class="appearance-none p-3 border-0">
                <div class="flex align-items-center">
                    <div class="text-gray-500 font-semibold">
                        @if (!$application->user->remove_data)
                        {{ $application->user->role->name }}
                        {{ isset($application->user->position_id) ? ' / ' . $application->user->position->name : ($application->user->role_id == 1 ? ' / Unspecified' : '') }}
                        @else
                        Data removed
                        @endif
                    </div>
                </div>
            </td>
            <td class="appearance-none p-3 border-0">
                <div class="flex align-items-center">
                    <div class="text-gray-500 font-semibold">
                        @if (!$application->user->remove_data)
                        <button onclick="viewMessage({{ $application->id }})" class="btn btn-sm hover:text-secondary">
                            View
                        </button>
                        @else
                        Data removed
                        @endif
                    </div>
                </div>
            </td>
            <td class="appearance-none p-3 border-0">
                <div class="flex align-items-center">
                    <div class="text-gray-500 font-semibold">
                        @if (!$application->user->remove_data)
                        {{ gmdate('Y-m-d', strtotime($application->created_at)) }}
                        @else
                        Data removed
                        @endif
                    </div>
                </div>
            </td>
        </tr>
        @endforeach

    @endif
    @endforeach

</tbody>


@if (Auth::check())

<script>
    window.headers = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

    function toggleApply(id = null, name = null) {
        if (!(id && name)) {
            $('#apply').removeClass('h-screen').addClass('h-0')
            $('#message').val('')
        } else {
            $('#apply #id').val(id)
            $('#apply h3').text(name)
            setTimeout(() => {
                $('#apply').removeClass('h-0').addClass('h-screen')
            }, 10)
        }
    }

    function sendApply() {
        let data = {id: $('#id').val(), message: $('#message').val()}

        $.ajax({
            headers:    headers,
            url:        "/position-apply",
            method:     "GET",
            data:       data,
            success:    function (response) {
                $('#apply h3').html(`<span class="flex">${response.message} &nbsp; <svg class="h-6 relative -m-b-2 fill-success" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM164.1 325.5C182 346.2 212.6 368 256 368s74-21.8 91.9-42.5c5.8-6.7 15.9-7.4 22.6-1.6s7.4 15.9 1.6 22.6C349.8 372.1 311.1 400 256 400s-93.8-27.9-116.1-53.5c-5.8-6.7-5.1-16.8 1.6-22.6s16.8-5.1 22.6 1.6zM208.4 208c0 17.7-14.3 32-32 32s-32-14.3-32-32s14.3-32 32-32s32 14.3 32 32zm128 32c-17.7 0-32-14.3-32-32s14.3-32 32-32s32 14.3 32 32s-14.3 32-32 32z"/></svg></span>`)

                if (typeof(viewApplications) !== 'undefined') {
                    let last = ($(`tr.position-${response.id}`).last())[0]

                    viewApplications(response.id)
                    last.insertAdjacentHTML("afterend", response.html)
                }

                appCount(response.id, response.count)
                setTimeout(() => {
                    toggleApply()
                }, 1200);
            },
            error:  function (result) {
                $('#apply h3').html(`<span class="flex">${result.responseJSON.message} &nbsp; <svg class="h-6 relative -m-b-2 fill-error" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M512 256c0 141.4-114.6 256-256 256S0 397.4 0 256S114.6 0 256 0S512 114.6 512 256zM161.3 382.1c-5.4 12.3 8.7 21.6 21.1 16.4c22.4-9.5 47.4-14.8 73.7-14.8s51.3 5.3 73.7 14.8c12.4 5.2 26.5-4.1 21.1-16.4c-16-36.6-52.4-62.1-94.8-62.1s-78.8 25.6-94.8 62.1zM176.4 272c17.7 0 32-14.3 32-32c0-1.5-.1-3-.3-4.4l10.9 3.6c8.4 2.8 17.4-1.7 20.2-10.1s-1.7-17.4-10.1-20.2l-96-32c-8.4-2.8-17.4 1.7-20.2 10.1s1.7 17.4 10.1 20.2l30.7 10.2c-5.8 5.8-9.3 13.8-9.3 22.6c0 17.7 14.3 32 32 32zm192-32c0-8.9-3.6-17-9.5-22.8l30.2-10.1c8.4-2.8 12.9-11.9 10.1-20.2s-11.9-12.9-20.2-10.1l-96 32c-8.4 2.8-12.9 11.9-10.1 20.2s11.9 12.9 20.2 10.1l11.7-3.9c-.2 1.5-.3 3.1-.3 4.7c0 17.7 14.3 32 32 32s32-14.3 32-32z"/></svg></span>`)
            }
        })
        
    }
</script>

    @if ($view_applicants)

    <script>
        function viewApplications(id) {
            $('.position').addClass('hidden')
            setTimeout(() => {
                $(`.position-${id}`).removeClass('hidden')
            }, 10)
        }

        function appCount(id, count) {
            $(`#count-${id}`).prop('nodeName') == 'button' ? $(`#count-${id}`).text(`View ${count}`) : $(`#count-${id}`).replaceWith(`<button id="count-${id}" onclick="viewApplications(${id})" class="btn btn-sm hover:text-secondary">
                                                                                                                                        View (${count})
                                                                                                                                    </button>`)
        }

        function viewMessage(id) {
            $.ajax({
                headers:    headers,
                url:        "/position-application-data",
                method:     "GET",
                data:       { id: id },
                success:    function (response) {
                    $('#app-view a').attr('href', `/member/${response.user.username}`)
                    $('#app-view img').attr('src', `/images/avatars/${response.user.avatar}`)
                    $('#app-view p').text(response.app.message)
                    $('#app-view #username').text(`${response.user.username} (${response.user.role})`)
                    $('#app-view #name').text(response.user.name)
                    $('#app-view button').attr('data-id', response.app.id)

                    setTimeout(() => { toggleView() }, 10)
                }
            })
        }

        function toggleView() {
            $('#app-view').hasClass('h-0') ? $('#app-view').removeClass('h-0').addClass('h-screen') : $('#app-view').addClass('h-0').removeClass('h-screen')
        }
        
    </script>

    @else

    <script>
        function appCount(id, count) {
            $(`#count-${id}`).text(count)
        }
    </script>

    @endif

    @if ($application_decide)

    <script>
        
        function toggleReply(id = null, approved = null) {
            id ? $('#app-reply').removeClass('h-0').addClass('h-screen') : $('#app-reply').addClass('h-0').removeClass('h-screen')
            $('#app-reply h3').text((approved ? 'Approve the user for this position?' : 'Decline application?'))
            $('#app-reply #app-id').val(id)
            $('#app-reply #approved').val(approved)
        }

        function sendReply() {
            let data = {}

            $('#app-reply input, #app-reply textarea').each(function() {
                data[$(this).attr('name')] = $(this).val()
            })
            
            $.ajax({
                headers:    headers,
                url:        "/position-application-reply",
                method:     "GET",
                data:       data,
                success:    function (response) {
                    toggleView()
                    response.message == 'Application declined!' ? $(`.app-${response.id}`).remove() : $(`.position-${response.id}`).remove()
                    $('#app-reply h3').text(response.message)
                    setTimeout(() => { toggleReply() }, 1200)
                },
                error: function (result) {
                    toggleView()
                    $('#app-reply h3').text(result.responseJSON.message)
                    setTimeout(() => { toggleReply() }, 1200)
                }
            })
        }

    </script>

    @endif

@endif

@endsection