@extends('layouts.common')
@section('content')

<div class="from-base-300 to-base-100 via-neutral bg-gradient-to-br xs:pt-0 sm:pt-0 pt-10 border-b-2 border-gray-800 min-h-screen">
    <div class="max-w-2xl mx-auto pt-4 pb-24 px-4 flex items-center sm:px-6 sm:py-32 lg:max-w-7xl lg:pb-32 flex-col">

        <div class="block" aria-hidden="true">
            <div class="py-5"></div>
          </div>
          
          <div class="xs:mt-0 sm:mt-0 md:mt-10 lg:mt-10 w-full">
            <div class="md:grid md:grid-cols-3 md:gap-6 lg:grid lg:grid-cols-4 lg:gap-6">
              <div class="md:col-span-1 lg:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-100 md:mt-5 lg:mt-5 xs:text-center sm:text-center w-full">
                        Select sponsor:
                    </h3>
                    <div class="tabs xs:mt-2 sm:mt-2 md:mt-4 lg:mt-4 xs:flex sm:flex xs:justify-center sm:justify-start xs:gap-2 sm:gap-2 xs:mb-10 sm:mb-10">

                        @foreach ($sponsors as $sponsor)

                        <div onclick="viewSponsor($(this), {{ $sponsor->id }})" class="md:py-2 lg:py-2 md:w-full lg:w-full xs:btn xs:btn-outline xs:btn-xs xs:text-xs sm:btn sm:btn-outline sm:btn-xs sm:text-xs transition ease-in-out duration-200 hover:text-gray-100 text-gray-400 cursor-pointer xs:rounded-full sm:rounded-full">
                            {{ $sponsor->name }}
                        </div>

                        @endforeach

                        <div onclick="addSponsorForm($(this))" class="md:py-2 lg:py-2 md:w-full lg:w-full xs:btn xs:btn-outline xs:btn-xs xs:text-xs sm:btn sm:btn-outline sm:btn-xs sm:text-xs transition ease-in-out duration-200 hover:text-gray-100 text-gray-400 cursor-pointer xs:rounded-full sm:rounded-full">
                            Add sponsor
                        </div>

                    </div>
                </div>
              </div>
              <div class="md:col-span-2 md:mt-0 lg:col-span-3 lg:mt-0">
                <form id="sponsor">
                    
                  <div class="overflow-hidden shadow sm:rounded-md">
                    <div class="bg-neutral px-4 py-5 sm:p-6">

                        <div class="col-span-6 xs:col-span-3 sm:col-span-3 mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-100 mb-3">Company name</label>
                            <input type="text" name="name" placeholder="Corporate_hell[0]" value="{{ $sponsors[0]->name }}" id="name" class="mt-1 block w-full rounded-md border-gray-700 text-gray-100 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm">
                        </div>

                        <div class="col-span-6 xs:col-span-3 sm:col-span-3 mb-4">
                            <label for="website" class="block text-sm font-medium text-gray-100 mb-3">Website</label>
                            <input type="text" name="website" placeholder="https://www.somesite.se" value="{{ isset($sponsors[0]->website) ? $sponsors[0]->website : '' }}" id="website" class="mt-1 block w-full rounded-md border-gray-700 text-gray-100 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm">
                        </div>
          
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-100 mb-3">Description</label>
                            <div class="mt-1">
                                <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-md text-gray-100 border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm" placeholder="Something, something-something...">{{ $sponsors[0]->description }}</textarea>
                            </div>
                            <p class="ml-1 mt-2 text-sm text-gray-400 italic">//&nbsp; Tell the users about this company. I'm sure they are great.</p>
                        </div>

                        <div>
                            <div class="block text-sm font-medium text-gray-100 mb-3">Logo</div>
                            <div class="mt-1 flex items-center">
                            <label for="logo" class="inline-block bg-base-300 bg-opacity-50 border-gray-700 border-2 border-opacity-50 rounded-md overflow-hidden">
                                <input id="logo" onchange="previewUploads(window.URL.createObjectURL(this.files[0]), 'logo')" name="logo" type="file" class="sr-only">
                                <img title="change" id="logo-img" class="cursor-pointer h-full w-full object-contain object-center" src="/public/images/sponsors/{{ $sponsors[0]->logo }}">
                            </label>
                            </div>
                        </div>

                        <div id="uploads" class="overflow-hidden transition ease-in-out duration-300 h-0 pt-4">
                            <label class="block text-sm font-medium text-gray-100 mb-3">Staged for upload</label>
                            <div class="mt-1 flex relative items-stretch">
                                
                                <div id="logo-prev" class="file-prev flex flex-col justify-between overflow-hidden transition ease-in-out duration-300 h-0">
                                    <img class="w-40 h-auto rounded-md overflow-hidden" src="" alt="Logo preview">
                                    <label class="mt-4 text-sm text-gray-400 italic">//&nbsp; Logo</label>
                                </div>

                            </div>
                        </div>

                        <div class="block mt-4">
                            <label for="active" class="inline-flex items-center" onclick="toggleActive()">
                                <input id="active" type="checkbox" class="rounded border-gray-300 text-blue-400 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="active" {{ $sponsors[0]->active ? 'checked value=on' : 'value=off' }}>
                                <span class="ml-2 text-sm font-medium text-gray-100">Active sponsor</span>
                            </label>
                        </div>

                    </div>

                    <div class="bg-base-300 bg-opacity-50 px-4 py-3 text-right xs:px-6 sm:px-6">
                        <div id="update" data-id="{{ $sponsors[0]->id }}" onclick="updateSponsor($(this).data('id'))" class="inline-flex cursor-pointer justify-center rounded-md bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</div>
                    </div>

                  </div>
                </form>
              </div>
            </div>
        </div>

    </div>
</div>

<div id="alert-wrapper" class="overflow-hidden top-0 left-0 fixed w-full h-0 z-100 backdrop-blur-md bg-opacity-20 bg-base-300 flex justify-center items-center">
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
    window.headers = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    window.onload = function() {
        selectTab($(".tabs div:nth-child(1)"))
        $('.preview').click(function() {
            console.log($(this).data('url'))
        })
    }

    function previewUploads(url, type) {
        $(`#${type}-prev img`).attr('src', url)
        $(`#${type}-prev`).removeClass('h-0')
        setTimeout(() => {
            $('#uploads').removeClass('h-0')
        }, 10);
    }

    function toggleActive() {
        $('#sponsor input#active').attr('checked') ? $('#sponsor input#active').removeAttr('checked').val('off') : $('#sponsor input#active').attr('checked', '').val('on')
    }

    function selectTab(tab) {
        $(".tabs div.text-gray-100").addClass("text-gray-400").addClass("cursor-pointer").removeClass("text-gray-100")

        setTimeout(() => {
            tab.removeClass("text-gray-400").removeClass("cursor-pointer").addClass("text-gray-100")
        }, 10)
    }

    function viewSponsor(e, id) {
        if (e.hasClass('text-gray-400')) {
            selectTab(e)

            $.ajax({
                headers:    headers,
                url:        `/sponsor/${id}`,
                method:     "GET",
                success:    function (response) {
                    if (response.sponsor) {
                        for (const [key, value] of Object.entries(response.sponsor)) {
                            key != 'logo' && key != 'active' ? $(`input#${key}, textarea#${key}`).val(value) : null
                        }

                        response.sponsor.active ? $('input#active').val('on').attr('checked', '') : $('input#active').val('off').removeAttr('checked', '')
                        $('#logo-img').attr('src', `/public/images/sponsors/${response.sponsor.logo}`)
                        $('#update').data('id', response.sponsor.id)
                    }
                }
            })
        }
    }

    function addSponsorForm(e) {
        if (e.hasClass('text-gray-400')) {
            selectTab(e)

            $('#sponsor input, #sponsor textarea').each(function() {
                $(this).val('')
                $('#logo-img').attr('src', '/public/images/item_covers/default.jpg')
                $('#update').data('id', 0)
                $('#sponsor input#active').attr('checked', '').val('on')
            })
        }
    }

    function updateSponsor(id) {
        let formData = new FormData(),
            logoSet  = ($('#sponsor input#logo'))[0].files.length

        $('#sponsor input, #sponsor textarea').each(function() {
            $(this).attr('name') != 'logo' ? formData.append($(this).attr('name'), $(this).val()) : null
        })

        logoSet ? formData.append('logo', ($('#sponsor input#logo'))[0].files[0]) : null
        id ? formData.append('id', id) : null

        $.ajax({
            headers:    headers,
            url:        id ? "/sponsor-update" : "/sponsor-store",
            method:     "POST",
            data:       formData,
            processData: false,
            contentType: false,
            success:    function (response) {
                $('#alert-wrapper h2').text('Data updated successfully!')

                setTimeout(() => {
                    alertToggle()
                }, 10)
            },
            error:      function (result) {
                $('#alert-wrapper h2').text('Update failed!')
                $('#alert-wrapper p').text('')

                $.each(result.responseJSON.errors, function( key, value ) {
                    $('#alert-wrapper p').append(`${value[0]}<br>`)  
                });

                setTimeout(() => {
                    alertToggle()
                }, 10)
            }
        })
    }

    function alertToggle() {
        $('#alert-wrapper').hasClass('h-0') ? $('#alert-wrapper').removeClass('h-0').addClass('h-full') : $('#alert-wrapper').addClass('h-0').removeClass('h-full')
    }

    function pvToggle() {
        $('input#password').attr('type') == 'password' ? setPvAttrs('text', 'Hide password!', '<svg class="w-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c5.2-11.8 8-24.8 8-38.5c0-53-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zm223.1 298L373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5z"/></svg>')
                                                       : setPvAttrs('password', 'Show password!', '<svg class="w-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM432 256c0 79.5-64.5 144-144 144s-144-64.5-144-144s64.5-144 144-144s144 64.5 144 144zM288 192c0 35.3-28.7 64-64 64c-11.5 0-22.3-3-31.6-8.4c-.2 2.8-.4 5.5-.4 8.4c0 53 43 96 96 96s96-43 96-96s-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6z"/></svg>')
    }
    function setPvAttrs(type, title, svg) {
        $('input#password').attr('type', type)
        $('input#password+span').attr('title', title).html(svg)
    }
</script>

@endsection