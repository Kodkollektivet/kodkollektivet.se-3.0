    <article class="card bg-base-100 prose m-auto w-full  shadow-xl flex-wrap border-1 border-gray-800">
        <div class="card-body xs:p-2 sm:p-2">
            <div class="flex flex-wrap justify-center">

                <a href="{{ $tag_uri }} " class="btn rounded-full btn-outline m-1 xs:text-sm sm:text-sm btn-sm" {{isset($tag) ? '' : 'disabled' }}>
                    all
                </a>

                @foreach ($tags as $item)

                <a href="{{ $tag_uri . $item }}" class="btn rounded-full btn-outline m-1 xs:text-sm sm:text-sm btn-sm" {{$item == $tag ? 'disabled' : '' }}>
                    #{{ $item }}
                </a>

                @endforeach

            </div>
        </div>
    </article> 

    <?php $post_id = 0; ?>

    @foreach ($posts as $post)

    <?php $post_id += 1; ?>

    <div class="mt-10 post-wrapper" data-id="{{ $post_id }}" data-real-id="{{ $post->id }}">
        <article class="prose m-auto card bg-base-100 shadow-xl border-1 border-gray-800 mt-0">
            <h3 class="xs:mx-2 sm:mx-2 xs:my-4 sm:my-4 md:m-4 lg:m-4 flex relative">
                <div class="avatar">
                    <div class="w-8 h-8 rounded-full overflow-hidden ">
                    <img class="m-0 object-center object-cover" src="/public/images/avatars/{{ !$post->author->remove_data && isset($post->author->avatar) ? $post->author->avatar : 'generic.svg' }}" alt="Tailwind-CSS-Avatar-component" />
                    </div>
                </div>          
                <code class="xs:pl-4 sm:pl-4 md:pl-6 lg:pl-6 xs:text-xs sm:text-xs md:text-sm lg:text-sm underline-none">
                    <a class="underline-none transition ease-in-out duration-200" href="/member/{{ $post->author->username }}">{{ !$post->author->remove_data ? $post->author->name : 'Data removed' }} ({{ $post->author->username }})</a> || {{ date('F jS, Y, H:i:s', strtotime($post->created_at)) }}
                </code>
                @if (Auth::check() && $post->author->id != Auth::user()->id)
                    <div class="absolute right-2 top-0">
                        <svg onclick="toggleReportItem({{ $post->id }}, 'post')" class="fill-current h-4 transition ease-in-out duration-200 hover:fill-error cursor-pointer" title="Report" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M64 32V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V32C0 14.3 14.3 0 32 0S64 14.3 64 32zm40.8 302.8c-3 .9-6 1.7-8.8 2.6V13.5C121.5 6.4 153 0 184 0c36.5 0 68.3 9.1 95.6 16.9l1.3 .4C309.4 25.4 333.3 32 360 32c26.8 0 52.9-6.8 73-14.1c9.9-3.6 17.9-7.2 23.4-9.8c2.7-1.3 4.8-2.4 6.2-3.1c.7-.4 1.1-.6 1.4-.8l.2-.1c9.9-5.6 22.1-5.6 31.9 .2S512 20.6 512 32V288c0 12.1-6.8 23.2-17.7 28.6L480 288c14.3 28.6 14.3 28.6 14.3 28.6l0 0 0 0-.1 0-.2 .1-.7 .4c-.6 .3-1.5 .7-2.5 1.2c-2.2 1-5.2 2.4-9 4c-7.7 3.3-18.5 7.6-31.5 11.9C424.5 342.9 388.8 352 352 352c-37 0-65.2-9.4-89-17.3l-1-.3c-24-8-43.7-14.4-70-14.4c-27.5 0-60.1 7-87.2 14.8z"/></svg>
                    </div>
                @endif
            </h3>
            <figure class="xs:mb-0 sm:mb-0">
                <img class="border-y border-gray-800 mt-0 w-full h-auto object-cover"
                src="/public/images/item_covers/{{ isset($post->image) ? $post->image : 'default.jpg' }}"
                alt="'{{ $post->name }}' cover image">
            </figure>
            
            <div class="card-body  xs:p-2 sm:p-2 pt-0">
                <div class="flex w-full xs:flex-col sm:flex-col md:flex-row lg:flex-row  justify-between items-center">
                    <h1 class="mb-0">
                        {{ $post->name }}
                    </h1>
                    <h3 class="text-sm text-blue-100">
                        @foreach ($post->tags as $tag)
                            <a href="{{ $tag_uri . $tag->name }}" class="transition ease-in-out duration-200 underline-none hover:text-accent">#{{ $tag->name }}</a>
                        @endforeach
                    </h3>
                </div>        
                <div class="divider mb-4"></div>
        
                <p class="text-base sm:text-lg md:text-xl font-semibol my-0">{{ $post->intro }}</p>
                
                <p class="post-description">{!! substr($post->description, 0, strpos($post->description, '<br>')) !!} [...]
                    <a class="transition ease-in-out duration-200 underline-none" onclick="readMore({{ $post->id }})" href="#void">Show more</a>    
                </p>
                
                <div class="flex w-full justify-between items-center">
                    <span class="flex" title="Comments: {{ $post->comments->count() }}">
                        <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M208 352c114.9 0 208-78.8 208-176S322.9 0 208 0S0 78.8 0 176c0 38.6 14.7 74.3 39.6 103.4c-3.5 9.4-8.7 17.7-14.2 24.7c-4.8 6.2-9.7 11-13.3 14.3c-1.8 1.6-3.3 2.9-4.3 3.7c-.5 .4-.9 .7-1.1 .8l-.2 .2 0 0 0 0C1 327.2-1.4 334.4 .8 340.9S9.1 352 16 352c21.8 0 43.8-5.6 62.1-12.5c9.2-3.5 17.8-7.4 25.3-11.4C134.1 343.3 169.8 352 208 352zM448 176c0 112.3-99.1 196.9-216.5 207C255.8 457.4 336.4 512 432 512c38.2 0 73.9-8.7 104.7-23.9c7.5 4 16 7.9 25.2 11.4c18.3 6.9 40.3 12.5 62.1 12.5c6.9 0 13.1-4.5 15.2-11.1c2.1-6.6-.2-13.8-5.8-17.9l0 0 0 0-.2-.2c-.2-.2-.6-.4-1.1-.8c-1-.8-2.5-2-4.3-3.7c-3.6-3.3-8.5-8.1-13.3-14.3c-5.5-7-10.7-15.4-14.2-24.7c24.9-29 39.6-64.7 39.6-103.4c0-92.8-84.9-168.9-192.6-175.5c.4 5.1 .6 10.3 .6 15.5z"/></svg>
                        &nbsp; {{ $post->comments->count() }}
                    </span>
                    <span class="flex" title="Attached images: {{ $post->images->count() }}">
                        <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M160 32c-35.3 0-64 28.7-64 64V320c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H160zM396 138.7l96 144c4.9 7.4 5.4 16.8 1.2 24.6S480.9 320 472 320H328 280 200c-9.2 0-17.6-5.3-21.6-13.6s-2.9-18.2 2.9-25.4l64-80c4.6-5.7 11.4-9 18.7-9s14.2 3.3 18.7 9l17.3 21.6 56-84C360.5 132 368 128 376 128s15.5 4 20 10.7zM256 128c0 17.7-14.3 32-32 32s-32-14.3-32-32s14.3-32 32-32s32 14.3 32 32zM48 120c0-13.3-10.7-24-24-24S0 106.7 0 120V344c0 75.1 60.9 136 136 136H456c13.3 0 24-10.7 24-24s-10.7-24-24-24H136c-48.6 0-88-39.4-88-88V120z"/></svg>
                        &nbsp; {{ $post->images->count() }}
                    </span>
                </div>
        
            </div>
        </article>
    </div>
    
    @endforeach

    @if ($total > 4)

    <div class="v-full flex flex-col items-center justify-center py-6" id="loader-wrapper">
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
        <h2 class="text-xl font-extrabold tracking-tight text-gray-200 pt-3">
            Loading more posts...
        </h2>
    </div>

    @endif

@if (Auth::check())
    @include('components.report-modal')
@endif

<script>
    window.postTotal = {{ $total }};
    window.tag       = $('#blog-wrapper').data('tag');
    window.isRunning = false;

    $.fn.isInViewport = function() {
        return $(this).offset().top < ($(window).scrollTop() + $(window).height());
    };

    function readMore(id) {
        $.ajax({
            url:        "/api/posts-read-more/",
            method:     "GET",
            data:       { id : id },
            success:    function (result) {
                $(`div.post-wrapper[data-real-id="${id}"]`).find('p.post-description').html(result.description);
            }
        });
    }

    function getSidebarPosts(community, user_id, page) {
        $.ajax({
            url:        "/api/posts-sidebar/",
            method:     "GET",
            data:       {
                            community: community,
                            user_id:   user_id,
                            page:      page
                        },
            success:    function (result) {
                $('#sidebar-posts').html(result.r_posts);
                $('#sidebar-posts-pagi').html(result.r_pages);
            },
            error:      function (result) {
            }
        });
    }

    @if ($total > 4)

    window.totalPosts = {{ $total }}

    $(window).on('resize scroll', function() {
        let lastId = $('div.post-wrapper').last().data('real-id'),
            loadedCount = $('div.post-wrapper').last().data('id')

        if ($('#pre-footer').isInViewport() && postTotal > loadedCount && !isRunning) {
            window.isRunning = true
            $('html').css('overflow', 'hidden')
            
            setTimeout(() => {
                lastId = $('div.post-wrapper').last().data('real-id')
                loadedCount = $('div.post-wrapper').last().data('id')

                if (postTotal > loadedCount) {
                    $.ajax({
                        url:        "/posts-fetch-more/",
                        method:     "GET",
                        data:       {
                                        skip: lastId,
                                        tag:  tag,
                                        {{ $community ? 'community: true,' : '' }}
                                        {!! $user ? "user: \"$user\"" : '' !!}
                                    },
                        success:    function (result) {
                            $('div.post-wrapper').last().after(result.html)
                            $('html').css('overflow', 'auto')
                            setTimeout(() => {
                                loadedCount = $('div.post-wrapper').last().data('id')
                                if (loadedCount >= totalPosts) {
                                    $('#loader-wrapper svg').remove()
                                    $('#loader-wrapper h2').text('That\'s all, for now :)')
                                }
                            }, 10)
                        }
                    });
                }

                window.isRunning = false;

            }, 2000);
        }
    });

    @endif

</script>
