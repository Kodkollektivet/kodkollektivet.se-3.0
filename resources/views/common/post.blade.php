<div class="mt-10 post-wrapper" data-id="{{ $post_id }}" data-real-id="{{ $post->id }}">
    <article class="prose m-auto card bg-base-100 shadow-xl border-1 border-gray-800 mt-0">
        <h3 class="m-4 flex">
            
            <div class="avatar">
                <div class="w-8 h-8 rounded-full overflow-hidden ">
                <img class="m-0 object-center object-cover" src="/public/images/avatars/{{ isset($post->author->avatar) ? $post->author->avatar : 'generic.svg' }}" alt="Tailwind-CSS-Avatar-component" />
                </div>
            </div>          
            <code class="pl-6 text-sm underline-none">
                <a class="underline-none transition ease-in-out duration-200" href="/member/{{ $post->author->username }}">{{ !$post->author->remove_data ? $post->author->name : 'Data removed' }} ({{ $post->author->username }})</a> || {{ date('F jS, Y', strtotime($post->created_at)) }}.
            </code>
            @if (isset($user) && $post->author->id != $user->id)
                <div class="absolute right-2 top-0">
                    <svg onclick="toggleReportItem({{ $post->id }}, 'post')" class="fill-current h-4 transition ease-in-out duration-200 hover:fill-error cursor-pointer" title="Report" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M64 32V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V32C0 14.3 14.3 0 32 0S64 14.3 64 32zm40.8 302.8c-3 .9-6 1.7-8.8 2.6V13.5C121.5 6.4 153 0 184 0c36.5 0 68.3 9.1 95.6 16.9l1.3 .4C309.4 25.4 333.3 32 360 32c26.8 0 52.9-6.8 73-14.1c9.9-3.6 17.9-7.2 23.4-9.8c2.7-1.3 4.8-2.4 6.2-3.1c.7-.4 1.1-.6 1.4-.8l.2-.1c9.9-5.6 22.1-5.6 31.9 .2S512 20.6 512 32V288c0 12.1-6.8 23.2-17.7 28.6L480 288c14.3 28.6 14.3 28.6 14.3 28.6l0 0 0 0-.1 0-.2 .1-.7 .4c-.6 .3-1.5 .7-2.5 1.2c-2.2 1-5.2 2.4-9 4c-7.7 3.3-18.5 7.6-31.5 11.9C424.5 342.9 388.8 352 352 352c-37 0-65.2-9.4-89-17.3l-1-.3c-24-8-43.7-14.4-70-14.4c-27.5 0-60.1 7-87.2 14.8z"/></svg>
                </div>
            @endif
        </h3>
        <figure>
            <img class="border-y border-gray-800 mt-0"
            src="/public/images/item_covers/{{ isset($post->image) ? $post->image : 'default.jpg' }}"
            alt="Sample Image">
        </figure>
        
        <div class="card-body pt-0">
            <div class="flex w-full flex-row justify-between items-center">
                <h1 class="mb-0 ">{{ $post->name }}</h1>
                <h3 class="text-sm text-blue-100">
                    @foreach ($post->tags as $tag)
                        <a href="/post/{{ $tag->name }}" class="transition ease-in-out duration-200 underline-none hover:text-accent">#{{ $tag->name }}</a>
                    @endforeach
                </h3>
            </div>  
    
            <div class="divider mb-4"></div>
    
            <p class="text-base sm:text-lg md:text-xl font-semibol my-0">{{ $post->intro }}</p>
            
            <p class="post-description">{{ substr($post->description, 0, 120) }} [...]
                <a class="transition ease-in-out duration-200 underline-none" onclick="readMore({{ $post->id }})" data-boud="1" href="#void">Show more</a>    
            </p>        
    
        </div>
    </article>
</div>