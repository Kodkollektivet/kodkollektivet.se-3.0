@extends('layouts.common')
@section('content')


<div class="from-base-300 to-base-100 via-neutral bg-gradient-to-br xs:pt-0 sm:pt-0 pt-10 border-b-2 border-gray-800 min-h-screen">
    <div class="max-w-2xl mx-auto pt-4 pb-24 px-4 flex items-center sm:px-6 sm:py-32 lg:max-w-7xl lg:pb-32 flex-col">

        @if (!$edit)
        @foreach($social as $media)
        <?php $mock = in_array($media->name, ['discord', 'linkedin']); ?>

          <div class="block xs:hidden sm:hidden" aria-hidden="true">
            <div class="py-5"></div>
          </div>
          
          <div class="mt-10 w-full">
            <div class="md:grid md:grid-cols-3 md:gap-6 lg:grid lg:grid-cols-3 lg:gap-6">
              <div class="md:col-span-1 lg:col-span-1">
                <div class="px-0">
                    <a target="_blank" href="{{ $media->url }}">
                        <h3 class="text-lg font-medium leading-6 text-gray-100 mt-5 flex transition ease-in-out duration-200 hover:text-secondary">
                            {{ $media->name }} <svg class="ml-2 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"/></svg>
                        </h3>
                    </a>
                    <p class="mt-1 text-sm text-gray-100">{{ $media->description }} </p>
                </div>
              </div>
              <div class="md:col-span-2 lg:col-span-2 mt-10">
                <form id="{{ $media->name }}">
                    
                  <div class="overflow-hidden shadow rounded-md">
                    <div class="bg-neutral md:px-4 md:py-5 lg:px-4 lg:py-5">
                        <iframe src="/canvas/?url={{ $media->url }}" data-url="{{ $media->url }}" class="{{ $media->name }} preview w-full h-96 rounded-md shadow-lg overflow-scroll"></iframe>
                    </div>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>

        @endforeach

        @else
        <div class="block" aria-hidden="true">
            <div class="py-5"></div>
          </div>
          
          <div class="xs:mt-0 sm:mt-0 md:mt-10 lg:mt-10 w-full">
            <div class="md:grid md:grid-cols-3 md:gap-6 lg:grid lg:grid-cols-4 lg:gap-6">
              <div class="md:col-span-1 lg:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-100 md:mt-5 lg:mt-5 xs:text-center sm:text-center w-full">
                        Select media:
                    </h3>
                    <div class="tabs xs:mt-2 sm:mt-2 md:mt-4 lg:mt-4 xs:flex sm:flex xs:justify-center sm:justify-start xs:gap-2 sm:gap-2 xs:mb-10 sm:mb-10">

                        @foreach ($social as $media)

                        <div onclick="setMedia($(this), {{ $media->id }})" class="md:py-2 lg:py-2 md:w-full lg:w-full xs:btn xs:btn-outline xs:btn-xs xs:text-xs sm:btn sm:btn-outline sm:btn-xs sm:text-xs transition ease-in-out duration-200 hover:text-gray-100 text-gray-400 cursor-pointer xs:rounded-full sm:rounded-full">
                            {{ $media->name }}
                        </div>

                        @endforeach

                    </div>
                </div>
              </div>
              <div class="md:col-span-2 md:mt-0 lg:col-span-3 lg:mt-0">
                <form id="media">
                    
                  <div class="overflow-hidden shadow sm:rounded-md">
                    <div class="bg-neutral px-4 py-5 sm:p-6">

                        <div class="col-span-6 xs:col-span-3 sm:col-span-3 mb-4">
                            <label for="username" class="block text-sm font-medium text-gray-100 mb-3">Username</label>
                            <input type="text" name="username" placeholder="MajorTom" value="{{ isset($social[0]->username) ? $social[0]->username : '' }}" id="username" class="mt-1 block w-full rounded-md border-gray-700 text-gray-100 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm">
                        </div>

                        <div class="col-span-6 xs:col-span-3 sm:col-span-3 mb-4">
                            <label for="url" class="block text-sm font-medium text-gray-100 mb-3">URL</label>
                            <input type="text" name="url" placeholder="https://www.somesite.se" value="{{ isset($social[0]->url) ? $social[0]->url : '' }}" id="url" class="mt-1 block w-full rounded-md border-gray-700 text-gray-100 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm">
                        </div>

                        <div class="col-span-6 xs:col-span-3 sm:col-span-3 mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-100 mb-3">Password</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input type="password" name="password" id="password" class="block w-full rounded-l-md text-gray-100 border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm" value="{{ isset($social[0]->password) ? $social[0]->password : '' }}">
                                <span class="inline-flex items-center rounded-r-m bg-base-300 px-3 text-sm text-gray-100 rounded-r-md border-gray-700 cursor-pointer transition ease-in-out duration-200 hover:shadow-inner hover:shadow-indigo-700 hover:bg-indigo-500" title="Show password!" onclick="pvToggle()">
                                    <svg class="w-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM432 256c0 79.5-64.5 144-144 144s-144-64.5-144-144s64.5-144 144-144s144 64.5 144 144zM288 192c0 35.3-28.7 64-64 64c-11.5 0-22.3-3-31.6-8.4c-.2 2.8-.4 5.5-.4 8.4c0 53 43 96 96 96s96-43 96-96s-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6z"/></svg>
                                </span>
                            </div>
                        </div>
          
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-100 mb-3">Description</label>
                            <div class="mt-1">
                                <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-md text-gray-100 border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm" placeholder="Something, something-something...">{{ isset($social[0]->description) ? $social[0]->description : '' }}</textarea>
                            </div>
                            <p class="ml-1 mt-2 text-sm text-gray-400 italic">//&nbsp; Tell the users what this media is used for.</p>
                        </div>

                    </div>

                    <div class="bg-base-300 bg-opacity-50 px-4 py-3 text-right xs:px-6 sm:px-6">
                        <div id="update" data-id="{{ $social[0]->id }}" onclick="updateMedia($(this).data('id'))" class="inline-flex cursor-pointer justify-center rounded-md bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</div>
                    </div>

                  </div>
                </form>
              </div>
            </div>
        </div>

        @endif
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

    function selectTab(tab) {
        $(".tabs div.text-gray-100").addClass("text-gray-400").addClass("cursor-pointer").removeClass("text-gray-100")

        setTimeout(() => {
            tab.removeClass("text-gray-400").removeClass("cursor-pointer").addClass("text-gray-100")
        }, 10)
    }

    function setMedia(e, id) {
        if (e.hasClass('text-gray-400')) {
            selectTab(e)
            $('input#password').attr('type') == 'text' ? pvToggle() : null

            $.ajax({
                headers:    headers,
                url:        "/set-media",
                method:     "GET",
                data:       { id: id },
                success:    function (response) {
                    if (response.media) {
                        for (const [key, value] of Object.entries(response.media)) {
                            $(`input#${key}, textarea#${key}`).val(value)
                        }

                        $('#update').data('id', response.media.id)
                    }
                }
            })
        }
    }

    function updateMedia(id) {
        let data = {'id': id}

        $('#media input, #media textarea').each(function() {
            data[$(this).attr('name')] = $(this).val()
        })

        $.ajax({
            headers:    headers,
            url:        "/update-media",
            method:     "GET",
            data:       data,
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