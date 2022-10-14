@extends('layouts.common')
@section('content')

<div class="hero mt-16 border-b-2 border-gray-800" style="background-image: url(/public/images/static/static_8.jpg);">
    <div class="hero-overlay bg-opacity-60 "></div>
    <div class="hero-content text-center text-neutral-content py-32">
      <div class="max-w-md">
          <p class="mb-2 uppercase">Things we build</p>
        <h1 class="text-5xl font-bold capitalize">{{ $uri == 'projects' ? $uri : str_replace('projects/', '', $uri) }}</h1>
      </div>
    </div>
  </div>
  
  <div class="from-base-300 to-base-100 via-neutral bg-gradient-to-br pt-10 border-b-2 border-gray-800">
        <div class="max-w-2xl mx-auto pt-10 pb-24 px-4 flex items-center sm:px-6 sm:py-32 lg:max-w-7xl lg:pt-4 lg:pb-32 flex-col">


            <ul class="menu relative xs:-mt-36 sm:-mt-36 xs:w-full sm:w-full xs:menu-vertical sm:menu-vertical md:menu-horizontal lg:menu-horizontal bg-base-100 rounded-box shadow-xl border-1 border-gray-800 ">

                <li>
                    <a href="/projects/" class="transition text-blue-200 ease-in-out duration-200" {{$uri == 'projects' ? 'disabled' : '' }}>ALL</a>
                </li>
    
                @foreach ($tags as $tag)
                <li>
                    <a href="/projects/{{str_replace(' ', '-', $tag)}}" class="transition text-blue-200 ease-in-out duration-200 capitalize " {{$uri == "projects/{$tag}" ? 'disabled' : '' }}>{{$tag}}</a>
                </li>
                @endforeach
                
            </ul>

            @if ($projects->count())
          
            <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 xl:gap-x-8 w-full mt-10">

                @foreach ($projects as $project)

                <div href="#" class="card group bg-base-100 shadow-xl border-1 border-gray-800">
                    <a href="/project/{{ str_replace(' ', '-', $project->name) }}?id={{$project->id}}" class="w-full h-80  rounded-lg rounded-b-none overflow-hidden ">
                        <img src="{{ $project->image->src }}" alt="{{ $project->image->alt }}" class="transition decoration-fuchsia-300 duration-300 ease-in-out w-full h-full object-center object-cover group-hover:opacity-75 group-hover:scale-105">
                    </a>
                    <div class="card-body h-1/3">
                        <h3 class="text-sm text-blue-100">
                            @foreach ($project->tags as $tag)
                                <a href="/projects/{{ $tag->name }}" class="transition ease-in-out duration-200 underline-none hover:text-accent">#{{ $tag->name }}</a>
                            @endforeach
                        </h3>
                        <p class="mt-1 text-lg font-medium text-gray-200">{{ $project->name }}</p>
                    </div>
                </div>

                @endforeach
        
            </div>

            {{ $projects->links() }}

            @else
            <div class="flex justify-center items-center flex-col" style="min-height: 300px">

                <img class="h-96  w-96 object-contain xs:mt-4 sm:mt-4 md:mt-10 lg:mt-10" src="/public/images/svg/lost.svg" alt="No items in this category.">
        
                <h1 class="text-blue-200 md:mt-12 lg:mt-12 xs:text-md sm:text-md md:text-xl lg:text-xl font-mono font-bold italic md:w-2/3 lg:w-2/3 text-center">
                    // &nbsp;We are currently populating the website; plase, bear with us 🐻
                </h1>
        
            </div>

            @endif

        </div>
  
  </div>

@endsection