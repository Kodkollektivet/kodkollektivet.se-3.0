<div id="alert-wrapper" class="overflow-hidden top-0 left-0 fixed w-full h-0 backdrop-blur-md bg-opacity-20 bg-base-300 flex justify-center items-center" style="z-index: 200;">
    <div class="card w-96 bg-base-100 shadow-xl">
        <div class="card-body text-gray-100">
          <h2 class="card-title"></h2>
          <p></p>
          <div class="card-actions justify-end">
            <button onclick="alertToggle()" class="btn btn-primary">OK</button>
          </div>
        </div>
    </div>
</div>

<script>

function alertToggle() {
    $('#alert-wrapper').hasClass('h-0') ? $('#alert-wrapper').removeClass('h-0').addClass('h-full') : $('#alert-wrapper').addClass('h-0').removeClass('h-full')
}

</script>