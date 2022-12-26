@extends('layouts.common')

@section('content')

<div class="hero mt-16 border-b-2 border-gray-800" style="min-height: 336px; background-image: url(/public/images/static/static_7.jpg);">
  <div class="hero-overlay bg-opacity-60 "></div>
  <div class="hero-content text-center text-neutral-content py-32">
    <div class="max-w-md">
        <p class="mb-2 uppercase"> What's happening?</p>
      <h1 class="font-bold capitalize text-{{in_array($type, ['all events', 'parties & more']) ? '5xl' : '3xl'}}">{{ $type }}</h1>
    </div>
  </div>
</div>

<div class="from-base-300 to-base-100 via-neutral bg-gradient-to-br pt-10 border-b-2 border-gray-800" style="min-height: 70vh">
    <div class="max-w-2xl mx-auto pt-10 pb-24 px-4 flex items-center sm:px-6 sm:py-32 lg:max-w-7xl lg:pt-4 lg:pb-32 flex-col">

        <ul class="menu relative xs:-mt-36 sm:-mt-36 xs:w-full sm:w-full xs:menu-vertical sm:menu-vertical md:menu-horizontal lg:menu-horizontal bg-base-100 rounded-box shadow-xl border-1 border-gray-800 ">
            <li>
                <a href="/events/" class="transition text-blue-200 ease-in-out duration-200" {{ $uri == "events" ? 'disabled' : '' }}>ALL</a>
            </li>

            @foreach ($links as $link => $id)
            <li>
                <a href="/events/{{$link}}" class="transition text-blue-200 ease-in-out duration-200 capitalize " {{ $uri == "events/{$link}" ? 'disabled' : '' }}>{{str_replace('-', ' ', $link)}}</a>
            </li>
            @endforeach

            @if (Auth::check() && Auth::user()->position_id && Auth::user()->position->create_events)

            <li>
                <a href="/item-create/event/" class="transition btn-info btn-outline ease-in-out duration-200 ">Create new <svg class="h-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg></a>
            </li>

            @endif
            
        </ul>

        @include('components.open-house')

        <div class="flex xs:flex-col sm:flex-col md:flex-col lg:flex-row lg:items-stretch w-full">

            <div class="flex flex-col xs:w-full sm:w-full md:w-full lg:w-4/6">

                @if ($events->count())

                @foreach ($events as $event)
                
                <?php $this_date = strtotime($event->date); ?>
                <div class="card lg:card-side bg-base-100 shadow-xl border-1 border-gray-800 w-full mt-10">
                    <figure class="lg:h-64  lg:w-1/3">
                        <img class="lg:h-full lg:w-full object-cover" src="/public/images/item_covers/{{ isset($event->image) ? $event->image : 'default.jpg' }}" alt="Event picture">
                    </figure>
        
                    <div class="card-body lg:h-64  lg:w-2/3">
                      <p class="text-sm text-blue-100">{{ date('F jS, Y (l, H:i)', $this_date) }}</p>
                      <h2 class="card-title text-gray-200">{{ $event->name }}
                          <div class="badge border-none text-neutral bg-{{$this_date > time() ? 'info' : 'warning'}}">
                              <small>{{$this_date > time() ? 'PLANNED' : 'PAST'}}</small>
                          </div>
                      </h2>
                      <p class="text-gray-500 text-lg ">{{ substr($event->intro, 0, 120) }} [...]</p>
                      <div class="card-actions justify-end">
                        <a href="/event/{{ $event->link }}/?id={{ $event->id }}" class="btn btn-outline border-gray-400 text-gray-400 transition ease-in-out duration-300 hover:text-neutral hover:border-neutral hover:bg-primary xs:btn-sm xs:text-xs sm:btn-sm sm:text-sm">Read more</a>
                      </div>
                    </div>
                </div>

                @endforeach
        
                {{ $events->links('pagination.custom') }}
        
                @else
        
                <div class="flex justify-center items-center flex-col" style="min-height: 300px">
        
                    <img class="h-96  w-96 object-contain xs:mt-4 sm:mt-4 md:mt-10 lg:mt-10" src="/public/images/svg/lost.svg" alt="No items in this category.">
            
                    <h1 class="text-blue-200 md:mt-12 lg:mt-12 xs:text-md sm:text-md md:text-xl lg:text-xl font-mono font-bold italic md:w-2/3 lg:w-2/3 text-center">
                        // &nbsp;We are currently populating the website; plase, bear with us 🐻
                    </h1>
            
                </div>
        
                @endif
        
            </div>
  
            <div class="xs:w-full sm:w-full md:w-full lg:w-2/6 mt-10 relative">
                <div class="flex items-center justify-center w-full lg:pl-6 sticky top-16">

                    <div class="w-full bg-base-100 rounded-xl shadow-xl border-1 border-gray-800">
                        <div class="p-8">
                            <div class="flex items-center">
                                <span tabindex="0" class="text-sm text-blue-100">{{ date('F Y') }}, weeks {{ date('W', $calendar->month_start) }} – {{ date('W', strtotime('last day of this month')) }}</span>
                            </div>
                            <div class="flex items-center justify-between pt-3 overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr>

                                            <th>
                                                <div class="w-full flex justify-start">
                                                    <p class="text-sm text-center text-gray-200">W. №</p>
                                                </div>
                                            </th>

                                            @foreach($calendar->dow as $day)

                                            <th>
                                                <div class="w-full flex {{ $day == 'Sun' ? 'justify-end' : 'justify-center' }}">
                                                    <p class="text-sm text-center text-gray-200">{{ $day }}</p>
                                                </div>
                                            </th>

                                            @endforeach
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @while ($calendar->count_days)

                                        <tr>

                                            <td class="pt-3">
                                                <div class=" py-2 flex w-full justify-start">
                                                    <p class="text-base text-gray-400 font-medium">{{ date('W', $calendar->month_start) }}</p>
                                                </div>
                                            </td>  

                                            @foreach ($calendar->dow as $day)

                                            @php $is_today = $calendar->today == $calendar->month_start @endphp

                                            <td class="pt-3">
                                                <div class="{{ $is_today ? 'px-0' : 'py-2' }} flex w-full {{ $day == 'Sun' ? 'justify-end pr-0' : 'justify-center px-2' }}">

                                                    @if ($day == date('D', $calendar->month_start) && $calendar->count_days)

                                                        @if (!isset($calendar->events[$calendar->month_start]))
                                                        
                                                        <p onclick="toggleDetails()" class="{{ $is_today ? 'focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 focus:bg-indigo-500 hover:bg-indigo-500 text-base w-8 h-8 flex items-center justify-center font-medium text-white bg-indigo-700 rounded-full transition ease-in-out' : 'text-base text-gray-500 font-medium' }}">{{ date('d', $calendar->month_start) }}</p>

                                                        @else

                                                        @php $event = $calendar->events[$calendar->month_start]; @endphp

                                                        <p onclick="toggleDetails($(this))" title="{{ $event->name }}" data-link="/event/{{ $event->name }}/?id={{ $event->id }}" data-intro="{{ $event->intro }}" data-date="{{ date('F jS, Y (l, H:i)', strtotime($event->date)) }}" class="focus:outline-none focus:ring-2 focus:ring-offset-2 cursor-pointer {{ key($event) >= $calendar->today ? 'focus:ring-cyan-700 focus:bg-info hover:bg-info bg-cyan-700' : 'focus:ring-yellow-700 focus:bg-yellow-500 hover:bg-yellow-500 bg-yellow-700' }} text-base w-8 h-8 flex items-center justify-center font-medium text-white rounded-full transition ease-in-out">{{ date('d', $calendar->month_start) }}</p>

                                                        @endif

                                                    @php $calendar->month_start += 86400;
                                                         $calendar->count_days  -= 1; @endphp

                                                    @endif

                                                </div>
                                            </td>

                                            @endforeach

                                        </tr>
                                        
                                        @endwhile

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <a href="" id="event-view" class="border-t-2 border-gray-800 opacity-0 h-0 transition ease-in-out duration-200">
                            <div>
                                <p class="text-sm text-blue-100 mb-2"></p>
                                <p class="text-lg font-medium text-gray-200"></p>
                                <p class="text-sm pt-2 text-gray-500 mt-2"></p>
                            </div>
                        </a>

                    </div>
                </div>
            </div>

        </div>
        
    </div>

</div>

<script>

    function toggleDetails(e = null) {
        if (e) {
            $('#event-view').attr('href', e.data('link'))

            $('#event-view div').addClass('p-8')

            $('#event-view p:nth-child(1)').text(e.data('date'))
            $('#event-view p:nth-child(2)').text(e.attr('title'))
            $('#event-view p:nth-child(3)').text(e.data('intro'))

            setTimeout(() => {
                $('#event-view').removeClass('opacity-0').removeClass('h-0')
            }, 10)
        } else {
            $('#event-view').addClass('opacity-0').addClass('h-0')
            $('#event-view div').removeClass('p-8')
            $('#event-view').attr('href', '')

            $('#event-view p').each(function () {
                $(this).text('')
            })
        }
    }

</script>

@endsection

