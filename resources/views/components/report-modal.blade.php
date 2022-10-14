
<div id="report-modal" class="overflow-hidden top-0 left-0 fixed w-full h-0 z-20 backdrop-blur-md bg-opacity-20 bg-base-300 flex justify-center items-center">
    <div class="card w-96 bg-error shadow-xl m-4">
        <div class="card-body -100">
        <h2 class="card-title"></h2>
        <select id="type" name="type" class="mt-1 mb-2 block w-full rounded-md border-opacity-50 border-gray-700 bg-transparent text-gray-700 py-2 px-3 shadow-sm focus:border-neutral transition ease-in-out duration-200 focus:outline-none focus:ring-indigo-500 sm:text-sm">
            @foreach (['Spam', 'Abuse / harassment', 'Misinformation', 'Inappropriate content'] as $r_type)
            <option>{{ $r_type }}</option>
            @endforeach
        </select>
        <p class="mt-2">Describe the issue:</p>
        <textarea id="content" name="content" class="mt-1 mb-2 block w-full rounded-md border-opacity-50 h-24 border-gray-700 bg-transparent text-gray-700 py-2 px-3 shadow-sm focus:border-neutral transition ease-in-out duration-200 focus:outline-none focus:ring-indigo-500 sm:text-sm"></textarea>
        <div class="card-actions justify-end bg-transparent -100 border-base-100">
            <div onclick="toggleReportItem()" class="btn btn-primary bg-basse-100 bg-opacity-25 -100 border-2 border-transparent transition ease-in-out duration-200 hover:-100 hover:border-base-100 hover:bg-transparent">Cancel</div>
            <button data-id="" data-type="" onclick="reportItem($(this).data('id'), $(this).data('type'))" id="confirm" class="btn btn-primary bg-base-100 text-error border-2 border-base-100 transition ease-in-out duration-200 hover:bg-error hover:-100 hover:border-base-100">OK</button>  
        </div>
        </div>
    </div>
</div>

<script>
    function toggleReportItem(id = false, type = false) {
        if (id) {
            $('#report-modal button#confirm').data('id', id).data('type', type)
            $('#report-modal h2').text(`Report ${type}?`)
            setTimeout(() => {
                $('#report-modal').removeClass('h-0').addClass('h-full')
            }, 10)
        } else {
            $('#report-modal').addClass('h-0').removeClass('h-full')
        }
    }

    function reportItem(id, type) {
        $.ajax({
            headers:     {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:         `/item-report/${type}`,
            method:      "POST",
            data:        { item_id: id, type: $('#type').val(), content: $('#content').val() },
            success:     function (result) {
                $('#report-modal h2').text(result.message)
                setTimeout(() => {
                    toggleReportItem()
                }, 1500);
            },
            error: function (result) {
                console.log(result)
            }
        });
    }
</script>