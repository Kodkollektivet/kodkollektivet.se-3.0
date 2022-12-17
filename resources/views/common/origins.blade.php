@extends('layouts.common')

@section('content')

<div class="b-32 pt-20 from-base-300 to-base-100 via-neutral bg-gradient-to-br border-t-2 border-b-2 border-gray-800 col-start-1 row-start-1 h-auto w-full">
    <article class="prose m-auto xs:px-4 sm:px-4 relative z-10">
        <h1 class="mb-4 mt-10">The origins of Kodkollektivet</h1>
        <h3 class="mt-0 mb-2">– by 
            <code><a class="no-underline transition ease-in-out duration-300 hover:text-primary" href="#void">
                John Herrlin
            </a></code>
        </h3>

        <div class="divider mb-4"></div>

        <p class="text-base sm:text-lg md:text-xl font-semibold">I was a network student here at LNU I was one of four founders of Kodkollektivet and I was the first president. Today I work as a Clojure developer in a small product company here in Växjö. I am big fan of free software. User of Emacs and the GNU/Linux system.</p>
        <h4 >The beginning of Kodkollektivet</h4>
        <p>I will talk about how Kodkollektivet started, the initial ideas and how we progressed. In the beginning the four of us. Otto, Ralle, me and Johan. Students in network security and software technology. We wanted to do projects outside of school. All of us had a big interest in programming. We thought that we could organize a place where small companies/startups could come to us with requests and that we could help them with development projects. Students could join us and get a little bit of money when working on thesis projects. We did some projects. For example members of early Kodkollektivet helped the local newspaper with one development project. But we soon realized that this would take alot of time from the students and that school stuff would be suffering. That's not really something that is valuable to the students in the long run, school must be in the first room. During this period when had came up with the name Kodkollektivet and it was set. But now we didn't know what to do with it.</p>
        <h4 class="mb-2">The demand for people in the IT business.</h4>
        <p>We did see that the demand for resources in the IT companies was big. Companies wanted to get in contact with students and students wanted to create a network. A network that they could use when writing theisis or a place to work when they finished university. We didn't see much of the companies around the university, but when we approached them they where very happy. There was a gap where we could build a bridge.</p>
        
        <p>
            <img class="border-1 border-gray-700 rounded-2xl overflow-hidden mb-10 shadow-xl"
                 src="/public/images/static/static_4.jpg"
                 alt="Sample Image">
        </p>

        <h4 class="mb-2">LitheKod</h4>
        <p>Around this time a friend of mine was a student at Linköpings university. He was president of a student union called LiTheKod. Lithekod was mainly for computer science students. They been around for some time. The university provided them with an free office space, internet connection and a public IP address. The companies know about them and they got old hardware and other resources from the companies. People in the student union implemented stuff like TCP/IP stacks on old server and got them up and running. Sounds amazing, right! :)</p>
        <h4 class="mb-2">Student unions at that time.</h4>
        <p>There are many great student unions at LNU. But we missed some place to get nerdy and get some of the same benefits as LiThekod. We wanted to talk about Linux, ideas on free software, programming languages and so on. So there was another gap where we could build a bridge.</p>
        <h4 class="mb-2">Comes together</h4>
        <p>So the demand for resources together with the gap of nerdyness created the blank space where we could create something that we believed in. All of a sudden everything was pretty clear. Create a social space where people could create networks, have fun and learn something without spending to much time on it. We more or less toke the ideas from LitheKod, but twisted it and did it our way.</p>
        <h4 class="mb-2">Sharing knowledge and ideas.</h4>
        <p>When we started Kodkollektivet the most important idea was the sharing of information. This was done in difference environments. Either by doing projects together (we didn't put much focus on this), students give presentation on CodeHubs. Or doing company events where the company is responsible to give some kind knowledge to the students.</p>
        <h4 class="mb-2">Company events</h4>
        <p>The companies in the region was exited to get in contact with us and do events. But we had to be carefully, we didn't want Kodkollektivet to be just a recruitment platform. There must be some kind of knowledge sharing from them to the students. Companies talked about the architecture decisions, gave lectures on map/filter/reduce. Made hackathons and so on. Yeah you are thinking correct, we did all of this bullshit just to get them to give us free food and free beers! :) February 2017 first small hackathon with Sigma.</p>
        <h4 class="mb-2">Four foundation pillars</h4>
        <p class="mb-4">I would say that this four was the foundation pillars to why Kodkollektivet became. - Place to get nerdy - Information sharing - Free beer and food ;) - Networking</p>
        
        <div class="relative z-10 mockup-code text-white mt-10 mb-20 border-1 border-gray-700 shadow-xl bg-transparent backdrop-blur">
            <div class="h-full border-t border-gray-700 w-full">
                <pre class="bg-transparent border-0" data-prefix="$"><code class="language-shell" ><span id="typed"></span></code></pre>
            </div>
        </div>

        @if ($events->count() || $posts->count())

        <h1 class="text-3xl font-extrabold tracking-tight sm:text-4xl mb-2 w-full text-blue-200">What's happening now?</h1>

            @if ($events->count())

            <h2 class="text-2xl text-blue-200 font-extrabold tracking-tight sm:text-3xl mt-4 mb-10">– Events</h2>
        
            <div class="grid gap-y-6 grid-cols-2 gap-x-6">

                @foreach ($events as $event)

                <a href="/event/{{ $event->link }}/?id={{ $event->id }}" class="card group bg-base-100 border-gray-800 shadow-xl text-gray-200 transition ease-in-out duration-200 hover:text-cyan-300">
                    <div class="w-full h-60  rounded-lg rounded-b-none overflow-hidden ">
                        <img src="/public/images/item_covers/{{ isset($event->image) ? $event->image : 'default.jpg' }}" alt="Post {{ $event->name }} cover image." class="transition decoration-fuchsia-300 ease-in-out duration-300 w-full h-full object-center object-cover group-hover:opacity-75 group-hover:scale-105">
                    </div>
                    <div class="card-body h-1/3">
                        <h3 class="text-sm text-cyan-300">{{ date('F jS, Y', strtotime($event->created_at)) }}</h3>
                        <p class="mt-1 text-lg font-medium">{{ $event->name }}</p>
                    </div>
                </a>

                @endforeach

            </div>

            <div class="xs:w-1/2 sm:w-1/3 md:w-1/3 lg:w-1/3 pl-0.5">
                <a href="/events" class="btn w-full transition ease-in-out duration-200 btn-outline border-blue-100 text-blue-100 group group-hover:btn-warning hover:bg-yellow-400 hover:border-yellow-400 xs:mt-5 sm:mt-10 md:mt-10 lg:mt-10">
                    View all
                </a>
            </div>

            @endif

            @if ($posts->count())

            <h2 class="text-2xl text-blue-200 font-extrabold tracking-tight sm:text-3xl mt-4 mb-10">– Recent posts</h2>
        
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

            <div class="xs:w-1/2 sm:w-1/3 md:w-1/3 lg:w-1/3 pl-0.5">
                <a href="/blog" class="btn w-full transition ease-in-out duration-200 btn-outline border-blue-100 text-blue-100 group group-hover:btn-warning hover:bg-yellow-400 hover:border-yellow-400 xs:mt-5 sm:mt-10 md:mt-10 lg:mt-10">
                    View all
                </a>
            </div>
            
            @endif

        @endif

    </article>

    <div>
        <svg class="waves relative z-0 -mt-16" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
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

@endsection