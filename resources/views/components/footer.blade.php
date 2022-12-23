@if (!in_array(Request::getRequestUri(), ['/login', '/register']))

<footer class="footer py-20 text-base-content max-w-2xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
    <div>
        <div class="font-title inline-flex text-3xl">
            <span class="text-primary ">Kod</span> <span class="text-base-content ">Kollektivet</span>
        </div>
        <p class="opacity-50"> is an IT student organization of<br>Linnaeus University (Sweden).</p>
    </div>
    <div class="xs:hidden sm:hidden md:block lg:block">
        <span class="footer-title">Social</span> 
        <div class="pt-3 gap-y-2 {{ isset($footer->social) && $footer->social->count() > 3 ? 'grid grid-cols-2 gap-x-4' : 'flex flex-col ' }}">
            @foreach ($footer->social as $social)
            <a target="_blank" href="{{ $social->url }}" class="link link-hover transition ease-in-out duration-200 hover:no-underline">{{ $social->name }}</a>
            @endforeach
            <a href="/social-media" class="link link-hover transition ease-in-out duration-200 hover:no-underline">View all</a>
        </div>
    </div>
    <div class="xs:hidden sm:hidden md:flex lg:flex flex-col">
        @if ($footer->events->count())

        <span class="footer-title">Events</span> 
        @foreach ($footer->events as $event)
        <a href="/event/{{ $event->link }}/?id={{$event->id}}" class="group link link-hover transition ease-in-out duration-200 hover:no-underline capitalize">{{ $event->name }}</a>
        @endforeach
        <a href="/events" class="group link link-hover transition ease-in-out duration-200 hover:no-underline">View all</a>

        @endif
    </div>
    <div class="xs:hidden sm:hidden md:flex lg:flex flex-col">
        @if ($footer->posts->count())
        
        <span class="footer-title">Blog</span>
        @foreach ($footer->posts as $post)
        <a href="/blog/entry/{{ $post->link }}/?id={{$post->id}}" class="group link link-hover transition ease-in-out duration-200 hover:no-underline capitalize">{{ $post->name }}</a>
        @endforeach
        <a href="/blog" class="group link link-hover transition ease-in-out duration-200 hover:no-underline">View all</a>

        @endif
    </div>
    <div><span class="footer-title">Links</span>
        <a class="group link link-hover transition ease-in-out duration-200 hover:no-underline">Home</a>
        <a href="/projects" class="group link link-hover transition ease-in-out duration-200 hover:no-underline">Projects</a>
        <a href="/members" class="group link link-hover transition ease-in-out duration-200 hover:no-underline">Members</a>
        <a href="/privacy-policy" class="group link link-hover transition ease-in-out duration-200 hover:no-underline">Privacy policy</a>
        <a href="/social-media" class="group link link-hover transition ease-in-out duration-200 hover:no-underline xs:block sm:block md:hidden lg:hidden">Social media</a>
    </div>
</footer>

<footer class="footer flex items-center justify-center p-4 bg-neutral w-full">
    <div class="flex items-center justify-between w-full text-neutral-content max-w-2xl mx-auto lg:max-w-7xl lg:px-6">
        <div class="items-center grid-flow-col">
            <p>© {{ date('Y') }} - Kodkollektivet, built by <a class="transition ease-in-out duration-200" href="/member/theAlex">theAlex</a></p>
          </div> 
          <div class="flex flex-nowrap xs:gap-2 sm:gap-2 md:gap-4 lg:gap-4 md:place-self-center md:justify-self-end">
            <a href="https://github.com/Kodkollektivet" target="_blank" class="group link link-hover transition ease-in-out duration-200 hover:no-underline" class="transition ease-in-out duration-200">
              <svg xmlns="http://www.w3.org/2000/svg" class="fill-current xs:h-4 sm:h-4 md:h-6 lg:h-6" viewBox="0 0 496 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"/></svg>
            </a> 
            <a href="https://www.youtube.com/channel/UC-RTLmclEA4gdc7aVOqHkLw" target="_blank" class="group link link-hover transition ease-in-out duration-200 hover:no-underline" class="transition ease-in-out duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current xs:h-4 sm:h-4 md:h-6 lg:h-6"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path></svg>
            </a>
            <a href="https://instagram.com/Kodkollektivet" target="_blank" class="group link link-hover transition ease-in-out duration-200 hover:no-underline" class="transition ease-in-out duration-200">
              <svg xmlns="http://www.w3.org/2000/svg" class="fill-current xs:h-4 sm:h-4 md:h-6 lg:h-6" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
            </a>
            <a href="https://www.facebook.com/kodkollektivet/" target="_blank" class="group link link-hover transition ease-in-out duration-200 hover:no-underline" class="transition ease-in-out duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current xs:h-4 sm:h-4 md:h-6 lg:h-6"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path></svg>
            </a>
          </div>
    </div>
</footer>

@endif

<!-- TODO: save assets, move script to a .js file -->

@if (in_array(Request::getRequestUri(), ['/', '/login', '/register', '/forgot-password']))

<script src="/public/js/three.min.js"></script>
<script src="/public/js/vanta.net.min.js"></script>
<script>
    VANTA.NET({
        el: "#net",
        mouseControls: true,
        touchControls: true,
        gyroControls: false,
        minHeight: 200.00,
        minWidth: 200.00,
        scale: 1.00,
        scaleMobile: 1.00,
        backgroundColor: 0x0c1422,
        color: 0xebd6,
        maxDistance: 21.00,
        spacing: 20.00
    })
</script>

@endif

<script src="/public/js/typed.min.js"></script>

@if (in_array(Request::getRequestUri(), ['/', '/origins']) || strpos(Request::getRequestUri(), 'member/'))
@php $uri = Request::getRequestUri(); @endphp

<script>
var typed6 = new Typed('#typed', {
    strings: [`{!! $uri == '/' ? '<pre data-prefix="1"><code class="italic language-php">// TODO: make this look</code></pre><pre data-prefix="2"><code class="italic language-php">// actually decent.</code></pre><pre data-prefix="3"><code class="italic language-php">// ...</code></pre><pre data-prefix="4"><code class="italic language-php">  </code></pre><pre data-prefix="5" class="bg-white text-base-300"><code>echo "But how?";</code></pre>' : (
        $uri == '/origins' ? 'Thanks to all members!' : ( isset($user->profile->status) ? $user->profile->status : 'No status to show. Wow.')
    ) !!}`],
    typeSpeed: 60,
    backSpeed: 45,
    loop: true,
    cursorChar: '',
});

</script>

@endif

@if (Auth::check() && Auth::user()->role_id == 4)

<a onclick="verifyResend()" class="btn border-none bg-transparent text-accent hover:text-teal-200 btn-sm text-xs">Resend verification email <svg class="ml-2 h-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L277.3 424.9l-40.1 74.5c-5.2 9.7-16.3 14.6-27 11.9S192 499 192 488V392c0-5.3 1.8-10.5 5.1-14.7L362.4 164.7c2.5-7.1-6.5-14.3-13-8.4L170.4 318.2l-32 28.9 0 0c-9.2 8.3-22.3 10.6-33.8 5.8l-85-35.4C8.4 312.8 .8 302.2 .1 290s5.5-23.7 16.1-29.8l448-256c10.7-6.1 23.9-5.5 34 1.4z"/></svg></a>

<script>
    function verifyResend(e) {
        $.ajax({
            headers:     {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:         "/verify-resend",
            method:      "POST",
            success:     function (result) {
                e.text(result.message)
                setTimeout(() => {
                    e.attr('id') == 'prompt' ? $('#prompt-wrapper').remove() : e.remove()
                }, 2000)
            }
        })
    }
</script>

@endif