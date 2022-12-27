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