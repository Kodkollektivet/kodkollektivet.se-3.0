@extends('layouts.common')

@section('content')

@include('components.events-header')

<div class="from-base-300 to-base-100 via-neutral bg-gradient-to-br pt-10 border-b-2 border-gray-800" style="min-height: 70vh">
    <div class="max-w-2xl mx-auto pt-10 pb-24 px-4 flex items-center sm:px-6 sm:py-32 lg:max-w-7xl lg:pt-4 lg:pb-32 flex-col">

        @include('components.events-menu')

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
                          <div class="badge border-none text-neutral text-xs bg-{{$this_date > time() ? 'info' : 'warning'}}">
                              {{$this_date > time() ? 'PLANNED' : 'PAST'}}
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
                            <div class="flex items-center justify-between">
                                <span tabindex="0" class="text-sm text-blue-100">{{ date('F Y') }}, weeks {{ date('W', $calendar->month_start) }} – {{ date('W', strtotime('last day of this month')) }}</span>
                                <a href="/event-calendar" class="badge border-none text-neutral bg-info text-xs">
                                    YEAR >
                                </a>
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

                                        @php $tuesdays   = !in_array(date('m', $calendar->month_start), [6, 7, 8]);
                                             $count_days = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); @endphp

                                        @while ($count_days)

                                        <tr>

                                            <td class="pt-3">
                                                <div class=" py-2 flex w-full justify-start">
                                                    <p class="text-base text-gray-400 font-medium">{{ date('W', $calendar->month_start) }}</p>
                                                </div>
                                            </td>  

                                            @foreach ($calendar->dow as $day)

                                            @php $is_today = $calendar->today == $calendar->month_start @endphp

                                            <td class="pt-3">
                                                <div class="flex w-full {{ $day == 'Sun' ? 'justify-end' : 'justify-center' }}">

                                                    @if ($day == date('D', $calendar->month_start) && $count_days)

                                                        @if (!isset($calendar->events[$calendar->month_start]))

                                                            @if (!$tuesdays || date('D', $calendar->month_start) != 'Tue' || (date('m', $calendar->month_start) == 12 && date('d', $calendar->month_start) > 19) || (date('m', $calendar->month_start) == 1 && date('d', $calendar->month_start) < 5))
                                                            
                                                            <p onclick="toggleDetails()" class="{{ $is_today ? 'focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 focus:bg-indigo-500 hover:bg-indigo-500 text-base w-8 h-8 flex items-center justify-center font-medium text-white bg-indigo-700 rounded-full transition ease-in-out' : 'text-base text-gray-500 font-medium' }} {{ $day != 'Sun' ? 'p-2' : '' }}">{{ date('d', $calendar->month_start) }}</p>

                                                            @else

                                                            <p onclick="toggleDetails($(this))" title="Open house" data-link="#" data-intro="Weekly meetup at Linnaeus Science Park, Framtidsvägen 14. Free fika and snacks, everyone is welcome!" data-date="{{ date('F jS, Y', $calendar->month_start) }} (Tuesday, 17:00 - 19:00)" class="focus:outline-none focus:ring-2 focus:ring-offset-2 cursor-pointer {{ $calendar->month_start >= $calendar->today ? 'focus:ring-cyan-700 focus:bg-info hover:bg-info bg-cyan-700' : 'focus:ring-yellow-700 focus:bg-yellow-500 hover:bg-yellow-500 bg-yellow-700' }} text-base w-8 h-8 flex items-center justify-center font-medium text-white rounded-full transition ease-in-out">{{ date('d', $calendar->month_start) }}</p>

                                                            @endif

                                                        @else

                                                        @php $event = $calendar->events[$calendar->month_start]; @endphp

                                                        <p onclick="toggleDetails($(this))" title="{{ $event->name }}" data-link="/event/{{ $event->name }}/?id={{ $event->id }}" data-intro="{{ $event->intro }}" data-date="{{ date('F jS, Y (l, H:i)', strtotime($event->date)) }}" class="focus:outline-none focus:ring-2 focus:ring-offset-2 cursor-pointer {{ key($event) >= $calendar->today ? 'focus:ring-cyan-700 focus:bg-info hover:bg-info bg-cyan-700' : 'focus:ring-yellow-700 focus:bg-yellow-500 hover:bg-yellow-500 bg-yellow-700' }} text-base w-8 h-8 flex items-center justify-center font-medium text-white rounded-full transition ease-in-out">{{ date('d', $calendar->month_start) }}</p>

                                                        @endif

                                                        @php $calendar->month_start += 86400;
                                                            $count_days  -= 1; @endphp

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
                                <p class="text-base pt-2 text-gray-500 mt-2"></p>
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

