@extends('user.profile')

@section('usertab')

<div class="flex flex-col items-stretch w-full">
            
    <div>
        <div>

        @if (!$user->remove_data && $personal_posts['total'])

        @include('common.wall', [
            'posts'     => $personal_posts['posts'],
            'total'     => $personal_posts['total'],
            'tags'      => $personal_posts['tags'],
            'tag'       => $personal_posts['tag'],
            'authors'   => $personal_posts['authors'],
            'tag_uri'   => "/member/{$user->username}/personal-posts/",
            'community' => false,
            'user'      => $user->username,
        ])

        @else

        <div class="flex justify-center items-center flex-col relative xs:-mt-20 sm:-mt-20" style="min-height: 300px">

            <img class="h-96  w-96 object-contain " src="/public/images/svg/lost.svg" alt="Activity hidden.">
    
            <h1 class="text-blue-200 md:mt-12 lg:mt-12 xs:text-md sm:text-md md:text-xl lg:text-xl font-mono font-bold italic md:w-2/3 lg:w-2/3 text-center">
                // &nbsp;There appears to be nothing here...
            </h1>
    
        </div>

        @endif

        </div>
    </div>

    <div id="pre-footer" class="opacity-0 pointer-events-none"></div>

</div>

@endsection