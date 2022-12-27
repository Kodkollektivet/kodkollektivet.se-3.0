@extends('layouts.common')

@section('content')

@include('components.events-header')

<div class="from-base-300 to-base-100 via-neutral bg-gradient-to-br pt-10 border-b-2 border-gray-800" style="min-height: 70vh">
    <div class="max-w-2xl mx-auto pt-10 pb-24 px-4 flex items-center sm:px-6 sm:py-32 lg:max-w-7xl lg:pt-4 lg:pb-32 flex-col">

        @include('components.events-menu')

        <div class="flex xs:flex-col sm:flex-col md:flex-col lg:flex-row lg:items-stretch w-full">

            <div class="flex flex-col xs:w-full sm:w-full md:w-full lg:w-4/6">

                @if ($events->count())

                @foreach ($events as $event)
                
                <?php $this_date = strtotime($event->date); ?>
                <div class="card lg:card-side bg-base-100 shadow-xl border-1 border-gray-800 w-full mt-10">
                    <figure class="lg:h-64  lg:w-1/3">
                        <img class="lg:h-full lg:w-full object-cover" src="/public/images/item_covers/{{ isset($event->image) ? $event->image : 'default.jpg' }}" alt="Event picture">
                    </figure>
        
                    <div class="card-body lg:h-64  lg:w-2/3">
                      <p class="text-sm text-blue-100">{{ date('F jS, Y (l, H:i)', $this_date) }}</p>
                      <h2 class="card-title text-gray-200">{{ $event->name }}
                          <div class="badge border-none text-neutral text-xs bg-{{$this_date > time() ? 'info' : 'warning'}}">
                              {{$this_date > time() ? 'PLANNED' : 'PAST'}}
                          </div>
                      </h2>
                      <p class="text-gray-500 text-lg ">{{ substr($event->intro, 0, 120) }} [...]</p>
                      <div class="card-actions justify-end">
                        <a href="/event/{{ $event->link }}/?id={{ $event->id }}" class="btn btn-outline border-gray-400 text-gray-400 transition ease-in-out duration-300 hover:text-neutral hover:border-neutral hover:bg-primary xs:btn-sm xs:text-xs sm:btn-sm sm:text-sm">Read more</a>
                      </div>
                    </div>
                </div>

                @endforeach
        
                {{ $events->links('pagination.custom') }}
        
                @else
        
                <div class="flex justify-center items-center flex-col" style="min-height: 300px">
        
                    <img class="h-96  w-96 object-contain xs:mt-4 sm:mt-4 md:mt-10 lg:mt-10" src="/public/images/svg/lost.svg" alt="No items in this category.">
            
                    <h1 class="text-blue-200 md:mt-12 lg:mt-12 xs:text-md sm:text-md md:text-xl lg:text-xl font-mono font-bold italic md:w-2/3 lg:w-2/3 text-center">
                        // &nbsp;We are currently populating the website; plase, bear with us 🐻
                    </h1>
            
                </div>
        
                @endif
        
            </div>
  
            <div class="xs:w-full sm:w-full md:w-full lg:w-2/6 mt-10 relative">
                @include('components.month')
            </div>

        </div>
        
    </div>

</div>

@endsection

