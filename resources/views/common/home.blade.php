@extends('layouts.common')

@section('content')

<div class="py-16 bg-base-300 h-screen" id="net" style="max-height: 821px;">
    <div class="container m-auto px-6 space-y-8 text-gray-400 md:px-12 lg:px-20 z-10 h-full">
        <div class="flex justify-center text-left gap-6 md:text-left md:flex lg:items-center lg:gap-16 h-full xs:flex-col md:flex-row lg:flex-row">
            <div class="md:order-last lg:order-last mb-6 space-y-6 md:mb-0 md:w-6/12 lg:w-6/12">
                <h1 class="xs:mt-20 sm:mt-20 md:mt-0 font-bold xs:text-4xl sm:text-4xl md:text-5xl lg:text-5xl text-gray-300 xs:text-center sm:text-center md:text-left">What is <code class="font-mono">$<span class="text-gray-100">this</span></code>?</h1>
                <p class="xs:text-lg sm:text-lg md:text-xl lg:text-xl xs:text-center sm:text-center md:text-left">Kodkollektivet is an IT student organization of Linnaeus University (Sweden).</p>
                <p class="xs:text-lg sm:text-lg md:text-xl lg:text-xl mt-2 xs:text-center sm:text-center md:text-left pb-4">We do a bunch of things, both software and hardware-wise.</p>
                <p class="text-lg mt-2 pb-4 xs:text-center sm:text-center md:text-left ">
                    Find us at Växjö Linnaeus Science Park, Framtidsvägen 14, Växjö.
                    <a href="#map" class="flex font-semibold transition ease-in-out duration-200">See map &nbsp;<svg class="fill-current w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 256c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z"/></svg></a>
                </p>
                <div class="flex flex-row-reverse flex-wrap gap-4 md:gap-6 xs:justify-center sm:justify-center md:justify-end lg:justify-end">
                    <a href="#projects" type="button" title="Projects" class="btn transition ease-in-out duration-200 bg-neutral border-1 border-gray-700 shadow-xl hover:btn-accent active:btn-accent focus:btn-accent">
                        Our work
                    </a>

                    @if (!Auth::check())

                    <a href="{{route('register')}}" type="button" title="more about" class="text-accent btn order-first bg-base-100 transition ease-in-out duration-200 hover:btn-info active:btn-info focus:btn-info">
                        Join us
                    </a>

                    @elseif (!in_array(Auth::user()->role_id, [4, 5]))

                    <div tabindex="1">
                        <label for="invite" class="modal-button text-accent btn order-first bg-base-100 transition ease-in-out duration-200 hover:btn-info active:btn-info focus:btn-info">
                            Invite
                            <svg class="relative ml-2 w-auto fill-current group-hover:fill-base-100" style="top: -1.5px; height: 12px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M511.6 36.86l-64 415.1c-1.5 9.734-7.375 18.22-15.97 23.05c-4.844 2.719-10.27 4.097-15.68 4.097c-4.188 0-8.319-.8154-12.29-2.472l-122.6-51.1l-50.86 76.29C226.3 508.5 219.8 512 212.8 512C201.3 512 192 502.7 192 491.2v-96.18c0-7.115 2.372-14.03 6.742-19.64L416 96l-293.7 264.3L19.69 317.5C8.438 312.8 .8125 302.2 .0625 289.1s5.469-23.72 16.06-29.77l448-255.1c10.69-6.109 23.88-5.547 34 1.406S513.5 24.72 511.6 36.86z"/></svg>
                        </label>
                        <input tabindex="1" type="checkbox" id="invite" class="modal-toggle" />
                        @include('components.invite-modal')
                    </div>

                    @endif
                </div>
            </div>

            <div class="pt-4 md:w-5/12 lg:w-6/12 h-4/6 relative xs:-mb-32 sm:-mb-32" style="max-height: 436px;">
            
                <div class="mockup-code w-full shadow-2xl h-full border-1 border-gray-800 text-white bg-transparent backdrop-blur">
                    <div class="h-full pt-5 border-t border-gray-800 bg-base-100 bg-opacity-10">
                        <span class="xs:text-sm sm:text-sm md:text-md lg:text-lg" id="typed" style="white-space:pre;"></span>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>

<div class="xs:pt-32 sm:pt-32 md:pt-20 lg:pt-20 from-base-300 to-base-100 via-neutral bg-gradient-to-br border-t-2 border-b-2 border-gray-800 xs:py-16 px-4 sm:py-24 md:py-24 lg:py-24 xs:px-0 sm:px-0 md:px-8 lg:px-8">  
    <div class="flex flex-col justify-center items-center mb-4 mt-0 max-w-2xl mx-auto lg:max-w-7xl">
        <img src="/public/images/svg/logo.svg" alt="KK logo" class="h-24 mb-2">
        <a href="/events">
            <h1 class="text-4xl font-bold pb-4 text-gray-200">What we <code class="font-mono">do()</code>;</h1>
        </a>
    </div>

    <div class="container m-auto text-gray-400 xs:pb-10 sm:pb-10 md:pb-32 lg:pb-32 max-w-2xl mx-auto lg:max-w-7xl xs:px-0 sm:px-0 md:px-4 lg:px-4">
        <div class="mx-auto grid gap-6 lg:w-full lg:grid-cols-3">
            <a href="/events/code-hubs-and-hackatons" class="transition ease-in-out duration-300 hover:bg-primary bg-opacity-40 backdrop-blur hover:text-base-300 rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8 border-1 bg-base-100 border-gray-800 relative">
                <div class="mb-16 space-y-4">
                    <h3 class="text-2xl font-semibold text-blue-100">Code hubs <code class="font-mono">&&</code> hackatons</h3>
                    <p class="mb-3">Fika, talks, teamwork and other cool stuff.</p>
                </div>
                <img src="/public/images/svg/events-code.svg" class="w-1/5 absolute right-6 bottom-6" alt="illustration" loading="lazy">
            </a>
            <a href="/events/workshops-and-company-events" class="transition ease-in-out duration-300 hover:bg-primary bg-opacity-40 backdrop-blur hover:text-base-300 rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8 border-1 bg-base-100 border-gray-800 relative">
                <div class="mb-16 space-y-4">
                    <h3 class="text-2xl font-semibold text-blue-100">Workshops <code class="font-mono">&&</code> company events</h3>
                    <p class="mb-3">Learn, network and meet your future employers!</p>
                </div>
                <img src="/public/images/svg/events-wrkshp.svg" class="w-1/5 absolute right-6 bottom-6" alt="illustration" loading="lazy">
            </a>
            <a href="/events/parties-and-more" class="transition ease-in-out duration-300 hover:bg-primary bg-opacity-40 backdrop-blur hover:text-base-300 rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8 border-1 bg-base-100 border-gray-800 relative">
                <div class="mb-16 space-y-4">
                    <h3 class="text-2xl font-semibold text-blue-100">Parties <code class="font-mono">&&</code> more</h3>
                    <p class="mb-3">Is there life aafter code? (research suggests there could be)</p>
                </div>
                <img id="projects" src="/public/images/svg/events-party.svg" class="w-1/5 absolute right-6 bottom-6" alt="illustration" loading="lazy">
            </a>
        </div>
    </div>

    @if (isset($sponsors) && $sponsors->count())


        <div class="container m-auto mb-4 mt-0 xs:pb-10  max-w-2xl mx-auto lg:max-w-7xl xs:px-0 sm:px-0 md:px-4 lg:px-4">
            <h1 class="text-4xl font-bold pb-2 text-gray-200">Our sponsors</h1>
            <h2 class="text-xl font-bold pb-4"><code class="font-mono">2022 / 2023</code></h2>
        </div>

        <div class="container flex-wrap justify-around m-auto text-gray-400 xs:pb-10 sm:pb-10 md:pb-32 lg:pb-32 max-w-2xl lg:max-w-7xl xs:px-0 sm:px-0 md:px-4 lg:px-4 mx-auto grid gap-6 lg:w-full lg:grid-cols-3">

            @foreach ($sponsors as $sponsor)

                <a href="{{ $sponsor->website }}" target="_blank" class="card w-96 bg-neutral text-neutral-content transition ease-in-out duration-300 hover:text-white">
                    <div class="card-body items-center">
                        <img class="w-full h-1/3 object-contain object-left" src="/public/images/sponsors/{{ $sponsor->logo }}" alt="{{ $sponsor->name }} logo">
                        <h2 class="card-title w-full mt-4">{{ $sponsor->name }}</h2>
                        <p class="w-full">{{ $sponsor->description }}</p>
                    </div>
                </a>
    
            @endforeach

            <div class="card w-96 bg-gradient-to-r from-cyan-500 to-blue-500 text-primary-content border-none shadow-xl h-max pb-8 self-end">
                <div class="card-body">
                    <h2 class="card-title w-full mt-4 text-3xl">Want to work with us?</h2>
                    <a href="mailto:office@kodkollektivet.se?subject=Sponsorship / collaboration" class="xs:ml-2 btn text-neutral btn-outline border-2 xs:btn-sm sm:btn-sm xs:text-xs sm:text-xs w-max flex">
                        Contact
                        <svg class="fill-current w-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"/></svg>
                    </a>
                </div>
            </div>

        </div>


    @endif

    <div>        
    <div class="max-w-2xl mx-auto pt-10 xs:pb-5 sm:pb-5 mb:pb-24 grid grid-cols-1 gap-y-16 gap-x-8 xs:px-0 sm:px-0 md:px-4 lg:px-4 sm:py-32 lg:max-w-7xl lg:pb-32 lg:grid-cols-2 xs:pt-16 sm:pt-24 md:pt-24 lg:pt-24">
      <div>
        <h2 class="text-3xl font-extrabold tracking-tight sm:text-4xl text-gray-200">Our projects</h2>

        <p class="mt-4 text-gray-500 text-lg">KK-V has a wide variety of things going on: from ai, microcontrollers and fullstack WEB development to white hat hacking on our own servers. We try to make everything accessible to everyone so you can jump in as a noob – or get something as a pro.</p>
        <p class="mt-4 text-gray-500 text-lg">We are always interested in new ideas. So if you have a project in mind implementing it with us will give you a head start.</p>
  
        <dl class="mt-16 grid xs:grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-x-6 gap-y-10 sm:gap-y-16 lg:gap-x-8">
          <div class="border-t border-gray-700 pt-4">
            <dt class="font-medium text-lg text-blue-100">Robotics</dt>
            <dd class="mt-2 text-md text-gray-500">Mice for mazes, drawing machines. Quadcopters, boats and subs, – controlled with AI.</dd>
          </div>

          <div class="border-t border-gray-700 pt-4">
            <dt class="font-medium text-lg text-blue-100">Education</dt>
            <dd class="mt-2 text-md text-gray-500">In collaboration with LNU and IT Gården we have ran education sessions and created projects for schools.</dd>
          </div> 

          <div class="border-t border-gray-700 pt-4">
            <dt class="font-medium text-lg text-blue-100">Hardware</dt>
            <dd class="mt-2 text-md text-gray-500">Making 3D printers and CNC’s. Physical parts of robotics projects.</dd>
          </div>
  
          <div class="border-t border-gray-700 pt-4">
            <dt class="font-medium text-lg text-blue-100">Software</dt>
            <dd class="mt-2 text-md text-gray-500">Internet of Things, servers and AI.</dd>
          </div>
  
          <div>
            <dd>
                <a href="{{route('projects')}}" class="btn w-full transition ease-in-out duration-200 btn-outline border-blue-100 text-blue-100 group group-hover:btn-warning hover:bg-yellow-400 hover:border-yellow-400 xs:mt-5 sm:mt-10 md:mt-10 lg:mt-10">
                    Learn more &nbsp;&nbsp; <svg class="relative transition ease-in-out duration-200 h-1/2 w-auto fill-blue-100 group-hover:fill-gray-900" xmlns="http://www.w3.org/2000/svg" style="top: -2.1px" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M9.375 233.4C3.375 239.4 0 247.5 0 256v128c0 8.5 3.375 16.62 9.375 22.62S23.5 416 32 416h32V224H32C23.5 224 15.38 227.4 9.375 233.4zM464 96H352V32c0-17.62-14.38-32-32-32S288 14.38 288 32v64H176C131.8 96 96 131.8 96 176V448c0 35.38 28.62 64 64 64h320c35.38 0 64-28.62 64-64V176C544 131.8 508.3 96 464 96zM256 416H192v-32h64V416zM224 296C201.9 296 184 278.1 184 256S201.9 216 224 216S264 233.9 264 256S246.1 296 224 296zM352 416H288v-32h64V416zM448 416h-64v-32h64V416zM416 296c-22.12 0-40-17.88-40-40S393.9 216 416 216S456 233.9 456 256S438.1 296 416 296zM630.6 233.4C624.6 227.4 616.5 224 608 224h-32v192h32c8.5 0 16.62-3.375 22.62-9.375S640 392.5 640 384V256C640 247.5 636.6 239.4 630.6 233.4z"/></svg>
                </a>
            </dd>
          </div>
  
        </dl>
      </div>
      <div class="grid grid-cols-2 grid-rows-2 gap-4 sm:gap-6 lg:gap-8 xs:hidden sm:hidden md:grid lg:grid mt-16">
        <img src="/public/images/static/static_0.jpg" class="bg-base-100 rounded-lg object-cover h-60 w-full">
        <img src="/public/images/static/static_1.jpg" class="bg-base-100 rounded-lg object-cover h-60 w-full">
        <img src="/public/images/static/static_2.jpg" class="bg-base-100 rounded-lg object-cover h-60 w-full">
        <img src="/public/images/static/static_3.jpg" class="bg-base-100 rounded-lg object-cover h-60 w-full">
      </div>
    </div>
  </div>
  
</div>

<div class="relative bg-base-300 overflow-hidden border-b-2 border-gray-800">
    <div class="max-w-7xl mx-auto h-full">
      <div class="relative bg-base-300 lg:max-w-2xl lg:w-full h-full" style="z-index: 1">
        <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-base-300 transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
          <polygon points="50,0 100,0 50,100 0,100" />
        </svg>
  
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 h-full xs:py-10 sm:py-10 md:py-24 lg:py-24 pb-32 pt-20">
            <div class="sm:text-center lg:text-left pt-8 pb-12 h-full flex flex-col justify-center relative z-10">
                <h1 class=" tracking-tight font-extrabold text-gray-200 xs:text-2xl sm:text-2xl md:text-5xl lg:text-5xl pt-4">
                <span>The origins of Kodkollektivet <br>by </span>
                <span class="text-blue-600 ">John Herrlin</span>
                </h1>
                <p class="mt-4 mb-4 pt-2 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:text-xl lg:mx-0">
                    "I was a network student here at LNU I was one of four founders of Kodkollektivet and I was the first president. 
                    Today I work as a Clojure developer in a small product company here in Växjö. I am big fan of free software. 
                    User of Emacs and the GNU/Linux system." &nbsp; <a href="{{route('origins')}}" class=" text-gray-400 hover:text-accent transition ease-in-out duration-200">Read more</a>
                </p>
            </div>
        </div>
      </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
      <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
           src="/public/images/static/jherrlin.jpg" alt="">
    </div>
  </div>

  
<div class="border-b-2 border-gray-800">  

    <div class="from-base-300 to-base-100 via-neutral bg-gradient-to-br sm:py-24 pb-32 pt-20">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">

            @if ($posts->count())

            <h2 class="text-3xl text-gray-200 font-extrabold tracking-tight sm:text-4xl mb-10">Blog</h2>
        
            <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">

                @foreach ($posts as $post)

                <a href="/post/{{ $post->link }}/?id={{ $post->id }}" class="card group bg-base-100 border-gray-800 shadow-xl text-gray-200 transition ease-in-out duration-200 hover:text-cyan-300">
                    <div class="w-full h-60  rounded-lg rounded-b-none overflow-hidden ">
                        <img src="/public/images/item_covers/{{ isset($post->image) ? $post->image : 'default.jpg' }}" alt="Post {{ $post->name }} cover image." class="transition decoration-fuchsia-300 ease-in-out duration-300 w-full h-full object-center object-cover group-hover:opacity-75 group-hover:scale-105">
                    </div>
                    <div class="card-body h-1/3">
                        <h3 class="text-sm text-cyan-300">{{ date('F jS, Y', strtotime($post->created_at)) }}</h3>
                        <p class="mt-1 text-lg font-medium">{{ $post->name }}</p>
                    </div>
                </a>

                @endforeach

            </div>

            @endif

            @include('components.open-house')

        </div>
    </div>

</div>

<section style="height: 678px; max-height: 50vh" class="max-w-screen m-0 p-0" id="map">

</section>

<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAho8y-HCKAoFsQk65H8c0C89PbY3CKsCs&callback=initMap"></script>
<script>
    // Initialize and add the map
    function initMap() {
    // The location of kkV
    const kkV = { lat: 56.8563535, lng: 14.8244578 };
    // The map, centered at kkV
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: kkV,
        styles: [
  {
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#1d2c4d"
      }
    ]
  },
  {
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#8ec3b9"
      }
    ]
  },
  {
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#1a3646"
      }
    ]
  },
  {
    "featureType": "administrative.country",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#4b6878"
      }
    ]
  },
  {
    "featureType": "administrative.land_parcel",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#64779e"
      }
    ]
  },
  {
    "featureType": "administrative.province",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#4b6878"
      }
    ]
  },
  {
    "featureType": "landscape.man_made",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#334e87"
      }
    ]
  },
  {
    "featureType": "landscape.natural",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#023e58"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#283d6a"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#6f9ba5"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#1d2c4d"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#023e58"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#3C7680"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#304a7d"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#98a5be"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#1d2c4d"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#2c6675"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#255763"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#b0d5ce"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#023e58"
      }
    ]
  },
  {
    "featureType": "transit",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#98a5be"
      }
    ]
  },
  {
    "featureType": "transit",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#1d2c4d"
      }
    ]
  },
  {
    "featureType": "transit.line",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#283d6a"
      }
    ]
  },
  {
    "featureType": "transit.station",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#3a4762"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#0e1626"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#4e6d70"
      }
    ]
  }
]
    });
    // The marker, positioned at kkV
    const marker = new google.maps.Marker({
        position: kkV,
        map: map,
    });
    }

    window.initMap = initMap;
</script>

@endsection

