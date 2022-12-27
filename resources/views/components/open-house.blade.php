<div class="card w-full bg-gradient-to-r from-cyan-500 to-blue-500 text-primary-content mt-10 border-none shadow-xl">
    <div class="card-body">
        <h2 class="card-title text-2xl mb-0" id="api-response">Open house every Tuesday</h2>
        <p class="xs:text-md sm:text-md md:text-lg lg:text-lg mt-2 mb-4">

            @php $open = !in_array(date('m'), [6, 7, 8, 12, 1]) || (date('m') == 12 && date('d') < 20) || (date('m') == 1 && date('d') > 4); @endphp

            @if ($open)
            Feel free to drop by our lab at Linnaeus Science Park, Framtidsvägen 14, anytime between 17 and 19.<br>
            There be free fika and snacks! 🍪&nbsp;☕️
            @else
            Looks like we are on holiday 🤔 see you next semester!
            @endif
        </p>

        @if (env('DOORBELL_ACTIVE') && date('H') >= 17 && date('H') <= 22 && ($open))

        <div class="card-actions justify-start mt-0 relative xs:w-full sm:w-full xs:flex-nowrap sm:flex-nowrap">
            @if (Request::route()->getName() != 'home')
            <a href="/#map" class="btn xs:btn-sm sm:btn-sm xs:text-xs sm:text-xs" id="mwsltr">Map</a>
            @endif
            <a onclick="ringDoorbell()" class="xs:ml-2 {{ Request::route()->getName() != 'home' ? 'sm:ml-2 md:ml-4 lg:ml-4' : '' }} btn text-neutral btn-outline border-2 xs:btn-sm sm:btn-sm xs:text-xs sm:text-xs">Ring the doorbell</a>
        </div>

        <script>
            function ringDoorbell() {
                $.ajax({
                    headers:     {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:         '/ring-doorbell',
                    method:      "POST",
                    success:     function (result) {
                        result.message ? $('#api-response').text(result.message) : null
                    },
                    error: function (result) {
                        result.responseJSON && result.responseJSON.message ? $('#api-response').text(result.responseJSON.message) : null
                    }
                })
            }
        </script>

        @endif

    </div>
</div>