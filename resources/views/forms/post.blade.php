@extends('layouts.common')

@section('content')

<style>
    @media (max-width: 768px) {
        article {
            padding: 0 24px;    
        }        
    }
</style>

<div class="b-32 pt-20 from-base-300 to-base-100 via-neutral bg-gradient-to-br border-t-2 border-b-2 border-gray-800 col-start-1 row-start-1 h-auto w-full">
    <article class="prose m-auto min-h-screen">
        <h1 class="mb-4 mt-10 cursor-text p-2 rounded-md border-2 border-gray-700 border-opacity-50 field" contenteditable="true" id="name">
            {{isset($item) ? $item->name : 'Your '. Request::route()->type .' title'}}
        </h1>
        <h3 class="mt-0 mb-2">
            <code class="p-0 xs:text-sm sm:text-sm">
                @if (!isset($item))

                <a class="underline-none transition ease-in-out duration-200" href="/member/{{ $user->username }}">{{ $user->name }} ({{ $user->username }})</a> || {{ date('F jS, Y') }}.

                @else

                <a class="underline-none transition ease-in-out duration-200" href="/member/{{ $item->author->username }}">{{ $item->author->name }} ({{ $item->author->username }})</a> || {{ date('F jS, Y', strtotime($item->created_at)) }}.

                @endif
            </code>
        </h3>

        <p class="text-base sm:text-lg md:text-xl p-2 font-semibold cursor-text rounded-md border-2 border-gray-700 border-opacity-50 field" contenteditable="true" id="intro" style="min-height: 10vh">
            {{isset($item) ? $item->intro : 'The intro for your '. Request::route()->type .'; keep it short! :)'}}
        </p>

        <div>
            <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-700 px-6 pt-5 pb-6 relative h-96 ">
                <div id="image-img" class="w-full h-full pointer-events-none z-0 opacity-50 absolute top-0 left-0 bg-cover" style="background-image: url('/public/images/{{isset($item) ? 'item_covers/' . $item->image : 'covers/default.jpg'}}')"></div>
                <div class="space-y-1 text-center relative z-1 flex flex-col justify-center items-center">
                    <svg class="mx-auto h-12 w-12 text-gray-100" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-100">
                        <label for="image" class="relative flex items-center cursor-pointer rounded-md font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500">
                            <span>Upload a file</span>
                            <input onchange="previewUploads(window.URL.createObjectURL(this.files[0]))" id="image" name="image" type="file" class="sr-only">
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-100">PNG, JPG, GIF up to .5MB</p>
                </div>
            </div>
            <label class="block ml-1 mt-2 text-sm text-gray-400 italic">//&nbsp; Main image</label>
        </div>

        <div class="alert alert-info shadow-lg my-4 border-none">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current flex-shrink-0 w-6 h-6 xs:hidden sm:hidden"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="m-0">Code snippets wrapped in <span class="italic">!-- start languageName --! ... !-- end --!</span> will be formatted and highlighted for you :)</p>
            </div>
        </div>
        
        <textarea style="min-height: 25vh" class="w-full bg-transparent cursor-text p-2 rounded-md border-2 border-gray-700 border-opacity-50" id="description">{!! isset($item) ? $item->description : 'The '. Request::route()->type .' itself. Separate paragraphs with an empty line.' !!}</textarea>

        <div id="uploads-wrapper" class="overflow-hidden transition ease-in-out duration-300 {{ isset($item) && $item->images->count() ? '' : 'h-0' }}">
            <div class="mt-1 flex w-full relative items-stretch overflow-scroll bg-base-100 bg-opacity-50 px-2 py-3 rounded-md border-2 border-gray-700 border-opacity-50 shadow-inner" id="uploads">
            
            @if (isset($item) && $item->images->count())

                @foreach ($item->images as $image)

                <img onclick="deleteImage($(this))" data-id="{{ $image->id }}" class="h-20 w-auto rounded-md object-cover object-center prev my-0 tansition ease-in-out duration-300 hover:opacity-50 cursor-not-allowed ml-2" src="/public/images/{{ Request::route()->type }}s/{{ $image->src }}" alt="Image preview">

                @endforeach

            @endif

            </div>
            <label class="ml-1 my-2 text-sm text-gray-400 italic flex">//&nbsp;{{ isset($item) ? 'Attached images' : 'Staged for upload'}}; you can try to append more than 5, but it won't work &nbsp; <svg class="h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM164.1 325.5C182 346.2 212.6 368 256 368s74-21.8 91.9-42.5c5.8-6.7 15.9-7.4 22.6-1.6s7.4 15.9 1.6 22.6C349.8 372.1 311.1 400 256 400s-93.8-27.9-116.1-53.5c-5.8-6.7-5.1-16.8 1.6-22.6s16.8-5.1 22.6 1.6zM208.4 208c0 17.7-14.3 32-32 32s-32-14.3-32-32s14.3-32 32-32s32 14.3 32 32zm128 32c-17.7 0-32-14.3-32-32s14.3-32 32-32s32 14.3 32 32s-14.3 32-32 32z"/></svg></label>
        </div>

        <p class="flex justify-end">
            <input id="images" name="images" type="file" class="sr-only">
            <label for="pre-image" class="mb-4 relative flex items-center cursor-pointer rounded-md font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500">
                <span class="btn btn-primary hover:text-neutral">Attach more images &nbsp; <svg class="h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M160 32c-35.3 0-64 28.7-64 64V320c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H160zM396 138.7l96 144c4.9 7.4 5.4 16.8 1.2 24.6S480.9 320 472 320H328 280 200c-9.2 0-17.6-5.3-21.6-13.6s-2.9-18.2 2.9-25.4l64-80c4.6-5.7 11.4-9 18.7-9s14.2 3.3 18.7 9l17.3 21.6 56-84C360.5 132 368 128 376 128s15.5 4 20 10.7zM256 128c0 17.7-14.3 32-32 32s-32-14.3-32-32s14.3-32 32-32s32 14.3 32 32zM48 120c0-13.3-10.7-24-24-24S0 106.7 0 120V344c0 75.1 60.9 136 136 136H456c13.3 0 24-10.7 24-24s-10.7-24-24-24H136c-48.6 0-88-39.4-88-88V120z"/></svg></span>
                <input onchange="previewUploads(window.URL.createObjectURL(this.files[0]), this.files[0])" id="pre-image" name="pre-image" type="file" class="sr-only">
            </label>
        </p>

        <input type="hidden" name="id" id="id" value="{{ isset($item) ? $item->id : '' }}">

        @if (Request::route()->type != 'event')

        <div id="tags" class="overflow-hidden shadow sm:rounded-md">
            <div class="space-y-6 bg-base-100 bg-opacity-50 xs:p-6 sm:p-6 md:px-4 md:py-5 lg:px-4 lg:py-5">
                <h3 class="mb-4 mt-0">
                    Select tags:
                </h3>
                <div class="grid grid-cols-12 gap-3 mt-4">

                    @foreach ($tags as $tag)

                    <div data-id="{{ $tag->id }}" onclick="toggleTag($(this), {{ $tag->id }})" class="tag xs:col-span-6 md:col-span-3 sm:col-span-6 lg:col-span-3 rounded-md {{isset($tagnames) && in_array($tag->name, $tagnames) ? 'bg-primary' : 'bg-base-300'}} bg-opacity-75 $class shadow-sm transition ease-in-out duration-200 hover:bg-indigo-500 cursor-pointer">                                
                        <div class="flex">
                            <div class="flex items-center justify-center h-8 w-full rounded-md text-gray-100 sm:text-sm">
                                {{ $tag->name }}
                            </div>
                        </div>
                   </div>

                   @endforeach
                
                </div>
            </div>
        </div>

        @endif

        @if (Request::route()->type == 'post' && isset($user->position) && $user->position->create_posts)

        <p>
            <select id="community" name="community" class="mt-1 block w-full rounded-md border-opacity-50 border-gray-700 bg-base-300 bg-opacity-50 text-gray-100 py-2 px-3 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                <option>Post in...</option>
                <option {{ isset($item) && !isset($item->community) ? 'selected' : '' }}>Personal</option>
                <option {{ isset($_GET['comm']) && $_GET['comm'] || (isset($item) && isset($item->community)) ? 'selected' : '' }}>Community</option>
            </select>
        </p>

        @elseif (Request::route()->type == 'event')

        <p class="flex flex-nowrap">
            <input id="place" name="place" type="text" placeholder="Enter location" value="{{ isset($item) ? $item->place : '' }}" class="w-1/2 mr-2 event-field mt-1 block rounded-md border-opacity-50 border-gray-700 bg-base-300 bg-opacity-50 text-gray-100 py-2 px-3 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:outline-none focus:ring-indigo-500 sm:text-sm">
            <input id="date" name="date" type="datetime-local" value="{{ isset($item) ? $item->date : '' }}" class="w-1/2 event-field mt-1 block rounded-md border-opacity-50 border-gray-700 bg-base-300 bg-opacity-50 text-gray-100 py-2 px-3 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:outline-none focus:ring-indigo-500 sm:text-sm">
        </p>

        <p>
            <select id="type" name="type" class="event-field mt-1 block w-full rounded-md border-opacity-50 border-gray-700 bg-base-300 bg-opacity-50 text-gray-100 py-2 px-3 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                <option>Post in...</option>

                @foreach ($types as $id => $name)
                <option {{ isset($item) && $item->type == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach

            </select>
        </p>

        @endif
        
        <br>

        <p class="text-sm">

            @if (!isset($item))

            Authored by <a href="/member/{{ $user->username }}" class="transition ease-in-out duration-200 no-underline">
                {{ $user->name }} ({{ $user->username }})</a> on {{ date('F jS, Y') }}.

            @else

            <a href="/member/{{$item->author->username}}" class="transition ease-in-out duration-200 no-underline">
                {{ $item->author->name }} ({{ $item->author->username }})</a> on {{ date('F jS, Y', strtotime($item->created_at)) }}.

            @endif
        </p>

        <p class="flex justify-end">
            <button onclick="submit()" class="btn btn-primary hover:text-neutral">Submit &nbsp; <svg class="h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg></button>
        </p>

    </article>

    @include('components.alert-modal')

    <div class="pt-10">
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="w-parallax">
                <use class="fill-base-100 opacity-70" xlink:href="#gentle-wave" x="48" y="0"  />
                <use class="fill-base-200 opacity-50" xlink:href="#gentle-wave" x="48" y="3" />
                <use class="fill-base-300 opacity-30" xlink:href="#gentle-wave" x="48" y="5"  />
                <use class="fill-base-300" xlink:href="#gentle-wave" x="48" y="7"  />
            </g>
        </svg>
    </div>

</div>

@if (isset($item) && $item->images->count())

<script>
    window.onload = function() {
        $('#uploads img').first().removeClass('ml-2')
    }
</script>

@endif

<script>
    window.headers = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    window.type    = '{{ Request::route()->type }}'

    function submit() {
        let formData = new FormData(),
            tags     = []

        $('article .field').each(function() {
            formData.append($(this).attr('id'), $(this).text())
        })

        if (type != 'event') {
            $('.tag.bg-primary').each(function() {
                tags.push($(this).data('id'))
            })

            formData.append('tags', tags)
            formData.append('community', $('#community').val() == 'Community' ? 1 : 0)
        } else {
            $('article .event-field').each(function() {
                formData.append($(this).attr('id'), $(this).val())
            })
        }

        formData.append('description', $('#description').val())
        formData.append('image', ($('#image'))[0].files[0] ? ($('#image'))[0].files[0] : '')
        formData.append('id', $('input#id').val() ? $('input#id').val() : '')
        formData.append('item_type', type)

        let postImages = Array.from($('#images').prop('files'))

        for (let i = 0; i < postImages.length; i++) {
            formData.append(`post_image_${i}`, postImages[i])
        }

        $.ajax({
            headers:     headers,
            url:         `/item-submit/${type}`,
            method:      "POST",
            data:        formData,
            processData: false,
            contentType: false,
            success:    function (result) {
                setTimeout(() => {
                    window.location.href = result.redirect
                }, 100)
            },
            error: function (result) {
                $('#alert-wrapper h2').text('Update failed!')
                $('#alert-wrapper p').text('')

                $.each(result.responseJSON.errors, function( key, value ) {
                    value.forEach(error => {
                        $('#alert-wrapper p').append(`<span class="error">${error}</span><br>`)
                    })
                })

                setTimeout(() => {
                    alertToggle()
                }, 10)
            }
        });
    }

    function previewUploads(url, file = null) {
        if (file) {
            let inputFiles = new DataTransfer(),
                mrgn       = $('.prev').length > 0 ? 'ml-2' : '',
                count      = $('#images').prop('files').length

            count ? Array.from($('#images').prop('files')).forEach(file => {
                inputFiles.items.add(file)
            }) : null
            inputFiles.items.add(file)

            $('#images').prop('files', inputFiles.files)
            $('#pre-image').prop('files', new DataTransfer().files)

            $('#uploads').append(`<img onclick="deleteImage(this)" class="h-20 w-auto rounded-md object-cover object-center prev my-0 tansition ease-in-out duration-300 hover:opacity-50 cursor-not-allowed ${mrgn}" src="${url}" alt="Image preview">`)

            setTimeout(() => {
                $('#uploads-wrapper').removeClass('h-0')
                console.log($('#images').prop('files'), $('#pre-image').prop('files'))
            }, 10);
        } else {
            console.log(url, $('#image-img'), $('#image-img').css('background-image'))
            $('#image-img').css('background-image', `url('${url}')`)
        }
    }
    function removeImage(file) {
        let inputFiles = new DataTransfer(),
            fileArray  = Array.from($('#images').prop('files')),
            index      = Array.from($('#uploads img')).findIndex(x => x == file)

        for (let i = 0; i < fileArray.length; i++) {
            i != index ? inputFiles.items.add(fileArray[i]) : null
        }

        file.remove()

        $('#images').prop('files', inputFiles.files)
        console.log($('#images').prop('files'), $('#pre-image').prop('files'))
    }

    function deleteImage(e) {
        let id = e.data('id')

        $.ajax({
            headers:     headers,
            url:         `/image-delete/${type}`,
            method:      "GET",
            data:        { id: id },
            success:    function () {
                e.remove()
            }
        });
    }

    function toggleTag(e, id) {
        e.hasClass("bg-primary") ? e.removeClass("bg-primary").addClass("bg-base-300") : e.removeClass("bg-base-300").addClass("bg-primary")
    }
 
</script>

@endsection