<ul class="menu relative xs:-mt-36 sm:-mt-36 xs:w-full sm:w-full xs:menu-vertical sm:menu-vertical md:menu-horizontal lg:menu-horizontal bg-base-100 rounded-box shadow-xl border-1 border-gray-800 self-center ">
    <li>
        <a href="/events/" class="transition text-blue-200 ease-in-out duration-200" {{ $uri == "events" ? 'disabled' : '' }}>ALL</a>
    </li>

    @foreach ($links as $link => $id)

    <li>
        <a href="/events/{{$link}}" class="transition text-blue-200 ease-in-out duration-200 capitalize" {{ $uri == "events/{$link}" ? 'disabled' : '' }}>{{str_replace('-', ' ', $link)}}</a>
    </li>

    @endforeach

    <li>
        <a href="/event-calendar" class="transition text-blue-200 ease-in-out duration-200 capitalize" {{ $uri == "event-calendar" ? 'disabled' : '' }}>Calendar</a>
    </li>

    @if (Auth::check() && Auth::user()->position_id && Auth::user()->position->create_events)

    <li>
        <a href="/item-create/event/" class="transition btn-info btn-outline ease-in-out duration-200 ">Create new <svg class="h-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg></a>
    </li>

    @endif
    
</ul>

@include('components.open-house')