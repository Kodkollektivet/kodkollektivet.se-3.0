@extends('layouts.common')
@section('content')
<div class="relative bg-base-300 overflow-hidden ">
    <div class="max-w-7xl mx-auto h-full">
      <div class="relative z-10 bg-base-300 lg:max-w-2xl lg:w-full h-full">
        <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-base-300 transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
          <polygon points="50,0 100,0 50,100 0,100" />
        </svg>
  
        <div class="mx-auto max-w-7xl px-4  sm:px-6  lg:px-8 h-full sm:py-24 pb-32 pt-20">
            <div class="sm:text-center lg:text-left pt-8 pb-12 h-full flex flex-col justify-center">
                <h1 class=" tracking-tight font-extrabold text-gray-200 sm:text-5xl md:text-5xl pt-4">
                    {{ $project->name }}
                </h1>
                <h5 class="tracking-tight font-extrabold text-gray-200 text-lg pt-2">
                    @foreach ($project->tags as $tag)
                        <a href="/projects/{{$tag->name}}" class="transition ease-in-out duration-200">
                            #{{ $tag->name }}
                        </a>
                    @endforeach
                </h5>
                <p class="mt-4 mb-4 pt-2 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                    {{ $project->intro }}
                </p>

                
            </div>
        </div>
      </div>
    </div>

    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
      <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
           src="{{ $project->cover->src }}" alt="{{ $project->cover->alt }}">
    </div>

  </div>

<div class="b-32 pt-20 from-base-300 to-base-100 via-neutral bg-gradient-to-br border-t-2 border-b-2 border-gray-800 col-start-1 row-start-1 h-auto w-full">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 h-full">
        <div class="relative z-10 w-full h-full">
        
          <div class="mx-auto w-full px-0 sm:px-6 lg:px-8 h-full pb-32">
              <div class="sm:text-center lg:text-left pt-8 h-full flex flex-col justify-center">
                  <h2 class="tracking-tight font-extrabold text-gray-200 sm:text-2xl md:text-2xl pt-4">
                    Main info
                  </h2>
                  <p class="mt-4 mb-4 pt-2 text-base text-gray-400 sm:mt-5 sm:mx-auto md:mt-5 text-lg lg:mx-0">
                    {{ $project->description }}
                  </p>
              </div>

              <div class="flex flex-row flex-wrap">
                <div class="md:w-1/2 sm:w-full sm:text-center lg:text-left pt-8 pb-12 h-full flex flex-col justify-center">

                    <h3 class="tracking-tight font-extrabold text-gray-200 text-xl pt-4">
                        Progress
                    </h3>
                    <p class="mb-4 pt-1 text-base text-gray-400 sm:mt-5 sm:mx-auto md:mt-5 text-md italic lg:mx-0 flex flex-row">
                        <svg class="fill-current h-6 w-6 -t-1 relative" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M286.3 155.1C287.4 161.9 288 168.9 288 175.1C288 183.1 287.4 190.1 286.3 196.9L308.5 216.7C315.5 223 318.4 232.1 314.7 241.7C312.4 246.1 309.9 252.2 307.1 257.2L304 262.6C300.1 267.6 297.7 272.4 294.2 277.1C288.5 284.7 278.5 287.2 269.5 284.2L241.2 274.9C230.5 283.8 218.3 290.9 205 295.9L198.1 324.9C197 334.2 189.8 341.6 180.4 342.8C173.7 343.6 166.9 344 160 344C153.1 344 146.3 343.6 139.6 342.8C130.2 341.6 122.1 334.2 121 324.9L114.1 295.9C101.7 290.9 89.5 283.8 78.75 274.9L50.53 284.2C41.54 287.2 31.52 284.7 25.82 277.1C22.28 272.4 18.98 267.5 15.94 262.5L12.92 257.2C10.13 252.2 7.592 247 5.324 241.7C1.62 232.1 4.458 223 11.52 216.7L33.7 196.9C32.58 190.1 31.1 183.1 31.1 175.1C31.1 168.9 32.58 161.9 33.7 155.1L11.52 135.3C4.458 128.1 1.62 119 5.324 110.3C7.592 104.1 10.13 99.79 12.91 94.76L15.95 89.51C18.98 84.46 22.28 79.58 25.82 74.89C31.52 67.34 41.54 64.83 50.53 67.79L78.75 77.09C89.5 68.25 101.7 61.13 114.1 56.15L121 27.08C122.1 17.8 130.2 10.37 139.6 9.231C146.3 8.418 153.1 8 160 8C166.9 8 173.7 8.418 180.4 9.23C189.8 10.37 197 17.8 198.1 27.08L205 56.15C218.3 61.13 230.5 68.25 241.2 77.09L269.5 67.79C278.5 64.83 288.5 67.34 294.2 74.89C297.7 79.56 300.1 84.42 304 89.44L307.1 94.83C309.9 99.84 312.4 105 314.7 110.3C318.4 119 315.5 128.1 308.5 135.3L286.3 155.1zM160 127.1C133.5 127.1 112 149.5 112 175.1C112 202.5 133.5 223.1 160 223.1C186.5 223.1 208 202.5 208 175.1C208 149.5 186.5 127.1 160 127.1zM484.9 478.3C478.1 479.4 471.1 480 464 480C456.9 480 449.9 479.4 443.1 478.3L423.3 500.5C416.1 507.5 407 510.4 398.3 506.7C393 504.4 387.8 501.9 382.8 499.1L377.4 496C372.4 492.1 367.6 489.7 362.9 486.2C355.3 480.5 352.8 470.5 355.8 461.5L365.1 433.2C356.2 422.5 349.1 410.3 344.1 397L315.1 390.1C305.8 389 298.4 381.8 297.2 372.4C296.4 365.7 296 358.9 296 352C296 345.1 296.4 338.3 297.2 331.6C298.4 322.2 305.8 314.1 315.1 313L344.1 306.1C349.1 293.7 356.2 281.5 365.1 270.8L355.8 242.5C352.8 233.5 355.3 223.5 362.9 217.8C367.6 214.3 372.5 210.1 377.5 207.9L382.8 204.9C387.8 202.1 392.1 199.6 398.3 197.3C407 193.6 416.1 196.5 423.3 203.5L443.1 225.7C449.9 224.6 456.9 224 464 224C471.1 224 478.1 224.6 484.9 225.7L504.7 203.5C511 196.5 520.1 193.6 529.7 197.3C535 199.6 540.2 202.1 545.2 204.9L550.5 207.9C555.5 210.1 560.4 214.3 565.1 217.8C572.7 223.5 575.2 233.5 572.2 242.5L562.9 270.8C571.8 281.5 578.9 293.7 583.9 306.1L612.9 313C622.2 314.1 629.6 322.2 630.8 331.6C631.6 338.3 632 345.1 632 352C632 358.9 631.6 365.7 630.8 372.4C629.6 381.8 622.2 389 612.9 390.1L583.9 397C578.9 410.3 571.8 422.5 562.9 433.2L572.2 461.5C575.2 470.5 572.7 480.5 565.1 486.2C560.4 489.7 555.6 492.1 550.6 496L545.2 499.1C540.2 501.9 534.1 504.4 529.7 506.7C520.1 510.4 511 507.5 504.7 500.5L484.9 478.3zM512 352C512 325.5 490.5 304 464 304C437.5 304 416 325.5 416 352C416 378.5 437.5 400 464 400C490.5 400 512 378.5 512 352z"/>
                        </svg>
                         &nbsp; {{ $current_stage }}
                    </p>
                    <div class="rounded-full bg-neutral p-2 self-baseline shadow-xl border-2 border-info mt-2">
                        <div class="radial-progress text-info text-xl" style="--value:{{ $progress }}; --size:16rem; --thickness: 1rem;">{{ round($progress) }}% done</div>
                    </div>
                    
                </div>
                <div class="md:w-1/2 sm:w-full sm:text-center lg:text-left pt-8 pb-12 h-full flex flex-col justify-center sm:pl-0 md:pl-2">
                    <h3 class="tracking-tight font-extrabold text-gray-200 text-xl pt-4">
                        People involved
                    </h3>
                    @if (count($users) > 0)
                    <table class="table text-blue-100 rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8 border-1 border-gray-800 rounded-b-2xl overflow-hidden bg-base-100 mt-4">
                        <thead class="bg-base-300 text-gray-500 mb-4 border-b rounded-t-2xl border-gray-800">
                            <tr>
                                <th class="p-3">Member</th>
                                <th class="p-3">Status</th>
                                <th class="p-3 text-left">Role</th>
                            </tr>
                        </thead>
                        <tbody class="appearance-none rounded-b-2xl border-0 border-gray-800">
                            @foreach ($users as $user)
                            @if (!$user->remove_data)
                            <tr class="bg-base-100 cursor-pointer bg-none transition ease-in-out duration-300 hover:bg-neutral  border-0 appearance-none overflow-hidden ">
                                <td class="appearance-none p-3 dropdown dropdown-hover border-0">
                                    <a href="{{ route('member', ['user' => $user->username]) }}" tabindex="0" class="flex align-items-center text-blue-100 hover:text-blue-100">
                                        <img class="rounded-full h-12 w-12 object-cover" src="@if (isset($user->avatar)) {{ '/public/images/avatars/' . $user->avatar }} @else {{ '/public/images/avatars/generic.svg' }} @endif" alt="Profile picture">
                                        <div class="ml-3">
                                            <div class="">{{ $user->username }}</div>
                                            <div class="text-gray-500">{{ $user->name }}</div>
                                        </div>
                                        @if (isset($user->profile) && isset($user->profile->status))
                                        <div tabindex="0" class="dropdown-content menu shadow bg-info text-neutral rounded-box px-2 mt-12 ml-8 border-3 border-neutral py-1">
                                            {{ $user->profile->status }}
                                        </div>
                                        @endif
                                    </a>
                                </td>
                                <td tabindex="1" class="appearance-none p-3  border-0">
                                    <div class="dropdown dropdown-hover">
                                        @if ($user->online)
                                        <div class="badge bg-info  border-0 text-neutral text-xs ml-2">&nbsp;</div>
                                        <div tabindex="1" class="dropdown-content menu shadow bg-base-300 rounded-box px-2 border-3 border-neutral py-1 -mt-2 ml-4">
                                            Online
                                        </div>
                                        @else
                                        <div class="badge text-neutral  border-0 bg-warning text-xs ml-2">&nbsp;</div>
                                        <div tabindex="1" class="dropdown-content menu shadow bg-base-300 rounded-box px-2 border-3 border-neutral py-1 -mt-2 ml-4">
                                            Offline
                                        </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="appearance-none p-3  border-0">
                                    <div class="flex align-items-center">
                                        <div class="text-gray-500 font-semibold">
                                            {{ $user->role->name }}
                                            {{ isset($user->position_id) ? ' / ' . $user->position->name : ($user->role_id == 1 ? ' / Unspecified' : '') }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="mb-4 pt-1 text-base text-gray-400 sm:mt-5 sm:mx-auto md:mt-5 text-md italic lg:mx-0 flex flex-row">
                        <svg class="fill-current h-5 w-5"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M119.4 44.1C142.7 40.22 166.2 42.2 187.1 49.43L237.8 126.9L162.3 202.3C160.8 203.9 159.1 205.1 160 208.2C160 210.3 160.1 212.4 162.6 213.9L274.6 317.9C277.5 320.6 281.1 320.7 285.1 318.2C288.2 315.6 288.9 311.2 286.8 307.8L226.4 209.7L317.1 134.1C319.7 131.1 320.7 128.5 319.5 125.3L296.8 61.74C325.4 45.03 359.2 38.53 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 0 232.4 0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.09V44.1z"/>
                        </svg>
                         &nbsp; No assignees yet.
                    </p>
                    @endif
                </div>

                <style>
                    @media (min-width: 768px) {
                        .task {
                            width: 49%;
                        }
                    }
                    @media (max-width: 767px) {
                        .task {
                            width: 100%;
                        }
                    }
                </style>

                <?php $task_id = 0;
                      $current_stage_name = str_replace('Currently at: ', '', $current_stage); ?>

                @foreach ($project->stages as $stage)
                <div class="w-full text-left pt-8 pb-12 h-full flex flex-col justify-center">
                    <h3 class="tracking-tight font-extrabold text-gray-200 text-xl flex flex-row">
                        {{ $stage->order }}: {{ $stage->name }} &nbsp;
                        @if ($stage->progress == 100)
                        <svg class="fill-success h-5 w-5 -bottom-1 relative" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"/>
                        </svg>
                        @elseif ($stage->name == $current_stage_name)
                        <svg class="fill-primary h-5 w-5 -bottom-1 relative" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M495.9 166.6C499.2 175.2 496.4 184.9 489.6 191.2L446.3 230.6C447.4 238.9 448 247.4 448 256C448 264.6 447.4 273.1 446.3 281.4L489.6 320.8C496.4 327.1 499.2 336.8 495.9 345.4C491.5 357.3 486.2 368.8 480.2 379.7L475.5 387.8C468.9 398.8 461.5 409.2 453.4 419.1C447.4 426.2 437.7 428.7 428.9 425.9L373.2 408.1C359.8 418.4 344.1 427 329.2 433.6L316.7 490.7C314.7 499.7 307.7 506.1 298.5 508.5C284.7 510.8 270.5 512 255.1 512C241.5 512 227.3 510.8 213.5 508.5C204.3 506.1 197.3 499.7 195.3 490.7L182.8 433.6C167 427 152.2 418.4 138.8 408.1L83.14 425.9C74.3 428.7 64.55 426.2 58.63 419.1C50.52 409.2 43.12 398.8 36.52 387.8L31.84 379.7C25.77 368.8 20.49 357.3 16.06 345.4C12.82 336.8 15.55 327.1 22.41 320.8L65.67 281.4C64.57 273.1 64 264.6 64 256C64 247.4 64.57 238.9 65.67 230.6L22.41 191.2C15.55 184.9 12.82 175.3 16.06 166.6C20.49 154.7 25.78 143.2 31.84 132.3L36.51 124.2C43.12 113.2 50.52 102.8 58.63 92.95C64.55 85.8 74.3 83.32 83.14 86.14L138.8 103.9C152.2 93.56 167 84.96 182.8 78.43L195.3 21.33C197.3 12.25 204.3 5.04 213.5 3.51C227.3 1.201 241.5 0 256 0C270.5 0 284.7 1.201 298.5 3.51C307.7 5.04 314.7 12.25 316.7 21.33L329.2 78.43C344.1 84.96 359.8 93.56 373.2 103.9L428.9 86.14C437.7 83.32 447.4 85.8 453.4 92.95C461.5 102.8 468.9 113.2 475.5 124.2L480.2 132.3C486.2 143.2 491.5 154.7 495.9 166.6V166.6zM256 336C300.2 336 336 300.2 336 255.1C336 211.8 300.2 175.1 256 175.1C211.8 175.1 176 211.8 176 255.1C176 300.2 211.8 336 256 336z"/>
                        </svg>
                        @else
                        <svg class="fill-secondary h-5 w-5 -bottom-1 relative"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M304 48C304 74.51 282.5 96 256 96C229.5 96 208 74.51 208 48C208 21.49 229.5 0 256 0C282.5 0 304 21.49 304 48zM304 464C304 490.5 282.5 512 256 512C229.5 512 208 490.5 208 464C208 437.5 229.5 416 256 416C282.5 416 304 437.5 304 464zM0 256C0 229.5 21.49 208 48 208C74.51 208 96 229.5 96 256C96 282.5 74.51 304 48 304C21.49 304 0 282.5 0 256zM512 256C512 282.5 490.5 304 464 304C437.5 304 416 282.5 416 256C416 229.5 437.5 208 464 208C490.5 208 512 229.5 512 256zM74.98 437C56.23 418.3 56.23 387.9 74.98 369.1C93.73 350.4 124.1 350.4 142.9 369.1C161.6 387.9 161.6 418.3 142.9 437C124.1 455.8 93.73 455.8 74.98 437V437zM142.9 142.9C124.1 161.6 93.73 161.6 74.98 142.9C56.24 124.1 56.24 93.73 74.98 74.98C93.73 56.23 124.1 56.23 142.9 74.98C161.6 93.73 161.6 124.1 142.9 142.9zM369.1 369.1C387.9 350.4 418.3 350.4 437 369.1C455.8 387.9 455.8 418.3 437 437C418.3 455.8 387.9 455.8 369.1 437C350.4 418.3 350.4 387.9 369.1 369.1V369.1z"/>
                        </svg>
                        @endif
                    </h3>
                    <progress class="my-4 progress progress-{{$stage->progress < 25 ? 'warning' : ($stage->progress < 50 ? 'secondary' : ($stage->progress < 75 ? 'info' : 'success'))}} w-56 bg-base-100 progress-primary" value="{{ $stage->progress }}" max="100"></progress>

                    <p class="mt-4 mb-4 pt-2 text-base text-gray-400 sm:mt-5 sm:mx-auto md:mt-5 text-md lg:mx-0">
                        {{ $stage->description }}
                    </p>
                    <div class="flex flex-row flex-wrap justify-between items-start">
                        <?php $stage_first_task = $stage->tasks->first(); ?>
                        @foreach ($stage->tasks as $task)

                        <?php $task_id++;
                              $first_task = $task == $stage_first_task; ?>

                        <div class="relative rounded-2xl shadow-xl border-1 border-gray-800 bg-base-100 bg-opacity-40 backdrop-blur px-3 mb-6 task text-gray-400">
                            @if ($task->done)&nbsp;
                            <div class="badge border-none text-neutral bg-teal-300 absolute right-3 top-3">
                                <small>DONE</small>
                            </div>
                            @endif
                            <div class="card-body">
                                <div @if (!$first_task) x-data="accordion({{$task_id}}) @endif">
                                    <h5 @click=handleClick() title='{{ !$first_task ? "Click to view details" : "This one is open by default :)" }}' class="cursor-pointer card-title text-lg border-b-2 pb-2 border-gray-400 flex flex-row justify-between">
                                        <span>{{ $task->name }}</span>
                                        <svg :class="handleRotate()" class="fill-current text-gray-400 h-4 w-4 transform transition-transform duration-500 {{$first_task ? 'rotate-180' : ''}}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M374.6 310.6l-160 160C208.4 476.9 200.2 480 192 480s-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 370.8V64c0-17.69 14.33-31.1 31.1-31.1S224 46.31 224 64v306.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0S387.1 298.1 374.6 310.6z"/>
                                        </svg>
                                    </h5>
                                    <div @if (!$first_task) x-ref="tab" :style="handleToggle()" class="overflow-hidden max-h-0 duration-500 transition-all pt-2" @else class="pt-2" @endif>
                                        <p class="">
                                            <span class="tracking-tight font-extrabold text-md pr-4 mt-2">Description:</span>
                                            {{ $task->description }}
                                        </p>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('alpine:init', () => {
                                      Alpine.store('accordion', {
                                        tab: 0
                                      });
                                      
                                      Alpine.data('accordion', (idx) => ({
                                        init() {
                                          this.idx = idx;
                                        },
                                        idx: -1,
                                        
                                        handleClick() {
                                          this.$store.accordion.tab = this.$store.accordion.tab === this.idx ? 0 : this.idx;
                                        },
                                        handleRotate() {
                                          return this.$store.accordion.tab === this.idx ? 'rotate-180' : '';
                                        },
                                        handleToggle() {
                                          return this.$store.accordion.tab === this.idx ? `max-height: ${this.$refs.tab.scrollHeight}px` : '';
                                        }
                                      }));
                                    })
                                  </script>
                                <div class="card-actions justify-start">
                                    <?php $assignee_count = count($task->users); ?>
        
                                    <h6 class="tracking-tight font-extrabold  text-md pr-4 mt-2">
                                        Assignee{{ ($assignee_count > 1) ? 's' : ''}}:
                                    </h6>
                
                                    <div class="avatar-group -space-x-2 mb-4 mt-1">
                                        @if ($assignee_count > 0)
                                            @foreach ($task->users as $user)
                                            @if (!$user->remove_data)
                                            <a class="avatar bg-neutral w-8" href="/member/{{$user->username}}" title="{{ $user->name }} ({{ $user->username }})">
                                                <div class="w-12">
                                                    <img src="{{ isset($user->avatar) ? ('/public/images/avatars/' . $user->avatar) : ('/public/images/avatars/generic.svg') }}" />
                                                </div>
                                            </a>
                                            @endif
                                            @endforeach
                                        @else
                                            <p class="italic" style="margin-top: 2px">no space cadets dispatched.</p>
                                        @endif
                                    </div>
        
                                </div>
                            </div>
                        </div>
                        
                        @endforeach
                    </div>
                </div>

                @endforeach
                
              </div>
        </div>
          
        </div>
      </div>

    <div>
        <svg class="waves relative -mt-32 z-0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
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