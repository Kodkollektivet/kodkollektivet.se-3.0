@extends('layouts.common')

@section('content')

<div class="hero mt-16 border-b-2 border-gray-800" style="min-height: 336px; background-image: url(/public/images/static/static_9.jpg);">
  <div class="hero-overlay bg-opacity-60 "></div>
  <div class="hero-content text-center text-neutral-content py-32">
    <div class="max-w-md">
        <p class="mb-2 uppercase font-bold font-mono italic">Well, good luck down there.</p>
        <h1 class="font-bold uppercase text-3xl mb-4">User reports / {{ $type }}</h1>
        <a href="/reports/{{ $type == 'resolved' ? '' : 'resolved' }}" class="uppercase font-bold font-mono transition ease-in-out duration-200 text-blue-200 hover:text-blue-100">View {{ $type == 'resolved' ? 'pending 🧨' : 'resolved 🍀' }}</a>
    </div>
  </div>
</div>

<div class="from-base-300 to-base-100 via-neutral bg-gradient-to-br pt-10 border-b-2 border-gray-800">
    <div class="max-w-2xl mx-auto pt-10 pb-24 px-4 sm:px-6 sm:py-32 lg:max-w-7xl lg:pt-4 lg:pb-32 flex flex-wrap items-stretch">

        @if ($reports->count())

        @foreach ($reports as $report)

        <div id="report-{{ $report->id }}" class="card-wrapper xs:w-full sm:w-full md:w-1/2 lg:w-1/2 p-2">
            <div class="card w-full bg-base-100 shadow-xl text-blue-200 report-card mb-4 relative overflow-hidden h-full">
                <div class="card-body p-4">
                    <h2 class="card-title text-sm font-mono mb-0 uppercase">
                        <span>
                            By <a class="transition ease-in-out duration-200" href="/member/{{ $report->author->username }}">{{$report->author->username}}</a> regarding 
    
                            @if (isset($report->item) && $report->item_type != 'comment')
                            @php $link = $report->item_type == 'user' ? "/member/{$report->item->username}" : (
                                    $report->item_type == 'post' ? '/blog/entry/' : '/event/') . "{$report->item->link}/?id={$report->item->id}"
                            @endphp
                            {{ $report->item_type }}: <a class="transition ease-in-out duration-200" href="{{ $link }}">{{ $report->item_type != 'user' ? $report->item->name : $report->item->username }}</a>
                            @elseif (isset($report->item))
                            @php $link = isset($report->item->actual) ? (get_class($report->item->actual) == 'App\Models\Post' ? '/blog/entry/' : '/event/') . "{$report->item->actual->link}/?id={$report->item->actual->id}"
                                        : null; @endphp
    
                            {{ $report->item->author->username }}'s comment on {!! isset($report->item->actual) ? "<a class='transition ease-in-out duration-200' href='$link'>". $report->item->actual->name .'</a>' : "deleted $report->item_type" !!}
                                                    
                            @else
                            deleted {{ $report->item_type }}
                            @endif
                        </span>
                    </h2>
    
                    <p class=" mb-2">
                        <span class="font-mono ">
                            Reason: 
                        </span>
                        {{ $report->type }}
                    </p>
                    <p>
                        <span class="font-mono">
                            Description:
                        </span>
                        {{ $report->content }}
                    </p>
    
                    @if ($report->item_type == 'comment' && isset($report->item))
                    <p>
                        <span class="font-mono">
                        Reported comment: 
                        </span>
                        <span class="italic">
                            "{{ $report->item->content }}"
                        </span>
                    </p>
                    @endif
    
                    <div class="card-actions justify-end mt-4">
                        {!! !($report->resolved) && $report->item_type == 'comment' && isset($report->item) ? "<button onclick='deleteComment({$report->item->id}); toggleResolved({$report->id})' class='btn btn-error btn-sm btn-outline text-xs'>Delete comment</button>" : '' !!}
                        <button onclick="toggleResolved({{ $report->id }})" class="btn btn-{{ $report->resolved ? 'error' : 'primary'}} btn-sm btn-outline text-xs">Mark {{ $report->resolved ? 'un' : ''}}resolved</button>
                    </div>
                </div>
            </div>
        </div>

        @endforeach

        <div class="w-full px-2 flex justify-between flex-wrap">
            {{ $type == 'resolved' ? $reports->links() : '' }}
            <a href="/reports/{{ $type == 'resolved' ? '' : 'resolved' }}" class="btn btn-outline xs:btn-sm sm:btn-sm xs:text-sm sm:text-sm uppercase font-bold font-mono transition ease-in-out duration-200 mt-12 {{ $type == 'resolved' ? 'border-red-500 text-red-500 hover:border-red-500 hover:bg-red-500' : 'border-lime-400 text-lime-400 hover:border-lime-400 hover:bg-lime-400' }}">View {{ $type == 'resolved' ? 'pending 🧨' : 'resolved 🍀' }}</a>
        </div>

        @else

        <div class="flex justify-center items-center flex-col w-full relative xs:-mt-10 sm:-mt-10" style="min-height: 300px">
    
            <img class="h-96 w-96 object-contain " src="/public/images/svg/lost.svg" alt="Activity hidden.">
    
            <h1 class="text-blue-200 md:mt-12 lg:mt-12 xs:text-md sm:text-md md:text-xl lg:text-xl font-mono font-bold italic md:w-2/3 lg:w-2/3 text-center">
                // &nbsp;It's all quiet and peaceful, for now.
            </h1>
    
        </div>
    
        @endif

    </div>

</div>

<script>
    window.headers = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

    function deleteComment(id) {
        $.ajax({
            headers:    headers,
            url:        "/comment-delete",
            method:     "POST",
            data:       { id: id },
            success:    function (result) {
                
            }
        });
    }

    function toggleResolved(id) {
        $.ajax({
            headers:    headers,
            url:        "/report-resolved",
            method:     "POST",
            data:       { id: id },
            success:    function (result) {
                if (result.success) {
                    $(`#report-${id} .card`).append(`<div class="w-full h-full flex items-center justify-center py-6 absolute top-0 left-0 z-100 bg-base-300 bg-opacity-80" id="loader-wrapper">
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
                                               </div>`)

                    setTimeout(() => {
                        $(`#report-${id}`).remove()                        
                    }, 1500);
                }
            }
        });
    }
</script>

@endsection