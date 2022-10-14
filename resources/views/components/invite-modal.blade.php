<div id="invite-modal" tabindex="1" class="modal">
    <div class="modal-box relative">
    <label id="invite-close" onclick="resetModal()" for="invite" class="absolute mr-6 mt-6 top-0 right-0 cursor-pointer">
        <svg class="relative ml-2 w-auto fill-blue-200 group-hover:fill-base-100" style="height: 21px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
    </label>
    <h3 class="font-bold text-lg text-blue-200">Whom are we drafting, Chief?</h3>
    <input id="invite-email" type="text" placeholder="sample@email.com" class="w-full mt-4 input input-bordered text-gray-400 " />
        <div class="modal-action">
            <div class="btn hover:btn-info" onclick="sendInvite()">
                Send
                <svg class="relative ml-2 w-auto fill-current group-hover:fill-base-100" style="top: -1.2px; height: 13.5px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M511.6 36.86l-64 415.1c-1.5 9.734-7.375 18.22-15.97 23.05c-4.844 2.719-10.27 4.097-15.68 4.097c-4.188 0-8.319-.8154-12.29-2.472l-122.6-51.1l-50.86 76.29C226.3 508.5 219.8 512 212.8 512C201.3 512 192 502.7 192 491.2v-96.18c0-7.115 2.372-14.03 6.742-19.64L416 96l-293.7 264.3L19.69 317.5C8.438 312.8 .8125 302.2 .0625 289.1s5.469-23.72 16.06-29.77l448-255.1c10.69-6.109 23.88-5.547 34 1.406S513.5 24.72 511.6 36.86z"/></svg>
            </div>
        </div>
    </div>
</div>

<script>
    function sendInvite() {
        resetModal()
        $('#invite-modal').append(
            `<div id="socket-wait" class="w-full h-full flex items-center justify-center py-6 absolute top-0 left-0 z-100 bg-base-300 bg-opacity-80" id="loader-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" width="57" height="57" viewBox="0 0 57 57" stroke="#fff">
                    <g fill="none" fill-rule="evenodd">
                        <g transform="translate(1 1)" stroke-width="2">
                            <circle cx="5" cy="50" r="5">
                                <animate attributeName="cy" begin="0s" dur="2.2s" values="50;5;50;50" calcMode="linear" repeatCount="indefinite"/>
                                <animate attributeName="cx" begin="0s" dur="2.2s" values="5;27;49;5" calcMode="linear" repeatCount="indefinite"/>
                            </circle>
                            <circle cx="27" cy="5" r="5">
                                <animate attributeName="cy" begin="0s" dur="2.2s" from="5" to="5" values="5;50;50;5" calcMode="linear" repeatCount="indefinite"/>
                                <animate attributeName="cx" begin="0s" dur="2.2s" from="27" to="27" values="27;49;5;27" calcMode="linear" repeatCount="indefinite"/>
                            </circle>
                            <circle cx="49" cy="50" r="5">
                                <animate attributeName="cy" begin="0s" dur="2.2s" values="50;50;5;50" calcMode="linear" repeatCount="indefinite"/>
                                <animate attributeName="cx" from="49" to="49" begin="0s" dur="2.2s" values="49;5;27;49" calcMode="linear" repeatCount="indefinite"/>
                            </circle>
                        </g>
                    </g>
                </svg>
            </div>`)

        $.ajax({
            headers:     {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:         `/invite-user`,
            method:      "POST",
            data:        { email:  $('#invite-email').val() },
            success:     function (result) {
                $('#invite-modal h3').text(result.message)
                $('#socket-wait').remove()
                setTimeout(() => {
                    $('#invite-close').click()
                }, 3000);
            },
            error: function (result) {
                $('#socket-wait').remove()
                for (const [key, value] of Object.entries(result.responseJSON.errors)) {
                    value.forEach(error => {
                        ($('#invite-modal h3')[0]).insertAdjacentHTML('afterend', `<p class="error text-red-400 mt-1">🧨&nbsp;&nbsp;${error}</p>`)
                    })
                }
            }
        })
    }

    function resetModal() {
        setTimeout(() => {
            $('#invite-modal h3').text('Whom are we drafting, Chief?')
            $('#invite-email').val('')
            $('#invite-modal .error').remove()
        }, 10);
    }
</script>