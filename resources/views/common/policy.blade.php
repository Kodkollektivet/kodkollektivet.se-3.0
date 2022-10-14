@extends('layouts.common')
@section('content')
<div class="relative bg-base-300 overflow-hidden ">
    <div class="max-w-7xl mx-auto h-full">
      <div class="relative z-10 bg-base-300 lg:max-w-2xl lg:w-full h-full">
        <svg class="hidden md:block lg:block absolute right-0 inset-y-0 h-full w-48 text-base-300 transform translate-x-1/2 z-20" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
          <polygon points="50,0 100,0 50,100 0,100" />
        </svg>
  
        <div class="mx-auto max-w-7xl px-4  sm:px-6  lg:px-8 h-full xs:pb-12 xs:pt-16  sm:pb-12 sm:pt-16 md:pb-32 md:pt-20 relative z-30">
            <div class="text-left pt-8 pb-12 h-full flex flex-col justify-center">
                <h1 class=" tracking-tight font-extrabold text-gray-200 xs:text-3xl sm:text-3xl md:text-5xl lg:text-5xl pt-4">
                    About cookies
                </h1>
                <p class="mt-4 mb-0 xs:text-base sm:text-base text-gray-500 sm:mt-5 md:text-xl lg:text-xl sm:max-w-xl sm:mx-auto md:mt-5 lg:mx-0">
                    Websites use cookie files to help users navigate efficiently and perform certain functions. Cookies that are required for the website to operate properly are allowed to be set without your permission. All other cookies need to be approved before they can be set in the browser. You can change your consent to cookie usage at any time on our Privacy Policy page.
                </p>
            </div>
        </div>
      </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
      <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
           src="/public/images/static/static_5.jpg" alt="">
    </div>
  </div>

<div class="b-32 pt-20 from-base-300 to-base-100 via-neutral bg-gradient-to-br border-t-2 border-b-2 border-gray-800 col-start-1 row-start-1 h-auto w-full">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 h-full">
        <div class="relative z-10 w-full h-full">
        
          <div class="mx-auto w-full px-0 sm:px-6 lg:px-8 h-full pb-32">
              <div class="text-left xs:pt-0 sm:pt-0 pt-8 pb-12 h-full flex flex-col justify-center">
                  <h2 class="tracking-tight font-extrabold text-gray-200 xs:text-xl sm:text-xl md:text-2xl lg:text-2xl pt-4">
                    Cookies are small text files that are placed on your computer by websites that you visit.
                  </h2>
                  <p class="mt-4 mb-0 text-base text-gray-400 sm:mt-5 sm:mx-auto md:mt-5 lg:mx-0">
                      Websites use cookies to help users navigate efficiently and perform certain functions. Cookies that are required for the website to operate properly are allowed to be set without your permission. All other cookies need to be approved before they can be set in the browser. You can change your consent to cookie usage at any time on our Privacy Policy page.
                  </p>
              </div>

              <div class="flex flex-row flex-wrap">
                <div class="md:w-1/2 lg:w-1/2 text-left xs:pt-0 sm:pt-0 pt-8 pb-12 h-full flex flex-col justify-center">
                    <h3 class="tracking-tight font-extrabold text-gray-200 text-xl pt-4">
                        Strictly necessary
                    </h3>
                    <p class="mt-4 mb-0 text-base text-gray-400 sm:mt-5 sm:mx-auto md:mt-5 text-md lg:mx-0 sm:pr-0 md:pr-2 xs:pr-0 lg:pr-2">
                        Strictly necessary cookies allow core website functionality such as user login and account management. The website cannot be used properly without strictly necessary cookies.
                    </p>
                </div>
                <div class="md:w-1/2 lg:w-1/2 text-left xs:pt-0 sm:pt-0 pt-8 pb-12 h-full flex flex-col justify-center sm:pl-0 md:pl-2 xs:pl-0 lg:pl-2">
                    <h3 class="tracking-tight font-extrabold text-gray-200 text-xl pt-4">
                        Performance
                    </h3>
                    <p class="mt-4 mb-0 text-base text-gray-400 sm:mt-5 sm:mx-auto md:mt-5 text-md lg:mx-0">
                        Performance cookies are used to help make the website faster. These cookies are used to store information about your preferences and your visit to the website.
                    </p>
                </div>

                <div class="md:w-1/2 lg:w-1/2 text-left xs:pt-0 sm:pt-0 pt-8 pb-12 h-full flex flex-col justify-center">
                    <h3 class="tracking-tight font-extrabold text-gray-200 text-xl pt-4">
                        Targeting
                    </h3>
                    <p class="mt-4 mb-0 text-base text-gray-400 sm:mt-5 sm:mx-auto md:mt-5 text-md lg:mx-0 sm:pr-0 md:pr-2 xs:pr-0 lg:pr-2">
                        Targeting cookies are used to help us understand your interests and provide you with targeted advertising. These cookies are used to collect information about your visit to the website, such as the pages you have visited or the links you have clicked on.
                    </p>
                </div>
                <div class="md:w-1/2 lg:w-1/2 text-left xs:pt-0 sm:pt-0 pt-8 pb-12 h-full flex flex-col justify-center sm:pl-0 md:pl-2 xs:pl-0 lg:pl-2">
                    <h3 class="tracking-tight font-extrabold text-gray-200 text-xl pt-4">
                        Functionality
                    </h3>
                    <p class="mt-4 mb-0 text-base text-gray-400 sm:mt-5 sm:mx-auto md:mt-5 text-md lg:mx-0">
                        Functionality cookies are used to remember your preferences and allow you to access the website more efficiently. These cookies are used to store information about your preferences and your visit to the website.
                    </p>
                </div>
                <div class="md:w-1/2 lg:w-1/2 text-left xs:pt-0 sm:pt-0 pt-8 pb-12 h-full flex flex-col justify-center">
                    <h3 class="tracking-tight font-extrabold text-gray-200 text-xl pt-4">
                        Unclassified
                    </h3>
                    <p class="mt-4 mb-0 text-base text-gray-400 sm:mt-5 sm:mx-auto md:mt-5 text-md lg:mx-0 sm:pr-0 md:pr-2 xs:pr-0 lg:pr-2">
                        Unclassified cookies are cookies that do not belong to any other category or are in the process of categorization.

                    </p>
                </div>
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