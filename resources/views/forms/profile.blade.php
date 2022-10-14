@extends('layouts.common')
@section('content')


<div class="from-base-300 to-base-100 via-neutral bg-gradient-to-br pt-10 border-b-2 border-gray-800">
    <div class="max-w-2xl mx-auto pt-10 pb-24 px-4 flex items-center xs:px-6 xs:py-12 sm:px-6 sm:py-12 md:max-w-7xl md:pt-4 md:pb-32 lg:max-w-7xl lg:pt-4 lg:pb-32 flex-col">

        @if (isset($prompt))

        <div id="prompt" class="alert alert-info shadow-lg mt-10 self-start border-0 w-full flex transition ease-in-out duration-700">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current flex-shrink-0 w-6 h-6 xs:hidden sm:hidden"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="ml-4 mr-2">{!! $prompt !!}</span>
            </div>
            <div onclick="disablePrompt()" class="btn btn-outline border-neutral text-neutral hover:text-info hover:bg-neutral hover:border-neutral">
                Understood
            </div>
        </div>

        @endif

        <div class="w-full">
            <div class="md:grid md:grid-cols-3 md:gap-6 lg:grid lg:grid-cols-3 lg:gap-6 mt-10">
              <div class="md:col-span-1 lg:col-span-1">
                <div class="xs:px-0 sm:px-0 md:px-4 lg:px-4">
                  <h3 class="text-lg font-medium leading-6 text-gray-100 mt-5">Profile</h3>
                  <p class="mt-1 text-sm text-gray-100">This information will be displayed publicly, so be careful what you share.</p>
                </div>
              </div>
              <div class="md:col-span-2 md:mt-0 lg:col-span-2 lg:mt-0">
                <form class="xs:mt-5 sm:mt-5" id="profile">
                  <div class="shadow rounded-md">
                    <div class="space-y-6 bg-neutral px-4 py-5 sm:p-6 xs:p-6">
                        <div class="xs:col-span-6 sm:col-span-6 md:col-span-3 lg:col-span-3">
                            <label for="username" class="block text-sm font-medium text-gray-100 mb-3">Username</label>
                            <input type="text" name="username" placeholder="MajorTom" value="{{ $user->username }}" id="username" class="mt-1 block w-full rounded-md border-gray-700 text-gray-100 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm">
                        </div>

                        <div class="xs:col-span-6 sm:col-span-6 md:col-span-3 lg:col-span-3">
                            <label for="name" class="block text-sm font-medium text-gray-100 mb-3">Full name</label>
                            <input type="text" name="name" placeholder="Name Surname" value="{{ $user->name }}" id="name" class="mt-1 block w-full rounded-md border-gray-700 text-gray-100 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm">
                        </div>
          
                        <div>
                            <label for="about" class="block text-sm font-medium text-gray-100 mb-3">About</label>
                            <div class="mt-1">
                                <textarea id="about" name="about" rows="3" class="mt-1 block w-full rounded-md text-gray-100 border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm" placeholder="Something, something-something...">{{ isset($data->about) ? str_Replace('<br><br>', PHP_EOL, $data->about) : '' }}</textarea>
                            </div>
                            <p class="ml-1 mt-2 text-sm text-gray-400 italic">//&nbsp; Brief description for your profile. One newline = new paragrapph :)</p>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-100 mb-3">Status</label>
                            <div class="mt-1">
                                <input type="text" id="status" name="status" rows="3" class="mt-1 block w-full rounded-md text-gray-100 border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm" value="{{ isset($data->status) ? $data->status : '' }}" placeholder="H3110, w0r1d!">
                            </div>
                            <p class="ml-1 mt-2 text-sm text-gray-400 italic">//&nbsp; What are you up to?</p>
                        </div>
            
                        <div>
                            <div class="block text-sm font-medium text-gray-100 mb-3">Photo</div>
                            <div class="mt-1 flex items-center">
                            <label for="avatar" class="inline-block h-12 w-12 overflow-hidden rounded-full bg-base-300 bg-opacity-50 border-gray-700 border-2 border-opacity-50">
                                <input id="avatar" onchange="previewUploads(window.URL.createObjectURL(this.files[0]), 'avatar')" name="avatar" type="file" class="sr-only">
                                <img title="change" id="avatar-img" class="cursor-pointer h-full w-full" src="/public/images/avatars/{{ isset($user->avatar) ? $user->avatar : 'generic.svg'}}">
                            </label>
                            </div>
                        </div>
          
                        <div>
                            <label class="block text-sm font-medium text-gray-100 mb-3">Cover photo</label>
                            <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-700 px-6 pt-5 pb-6 relative">
                                <div id="cover-img" class="w-full h-full pointer-events-none z-0 opacity-50 absolute top-0 left-0" style="background-image: url('/public/images/covers/{{ isset($data->cover) ? $data->cover : 'default.jpg' }}')"></div>
                                <div class="space-y-1 text-center relative z-1">
                                    <svg class="mx-auto h-12 w-12 text-gray-100" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-100">
                                        <label for="cover" class="relative cursor-pointer rounded-md bg-neutral font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500">
                                            <span>Upload a file</span>
                                            <input onchange="previewUploads(window.URL.createObjectURL(this.files[0]), 'cover')" id="cover" name="cover" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-100">PNG, JPG, GIF up to .5MB</p>
                                </div>
                            </div>
                        </div>

                        <div id="uploads" class="overflow-hidden transition ease-in-out duration-300 h-0">
                            <label class="block text-sm font-medium text-gray-100 mb-3">Staged for upload</label>
                            <div class="mt-1 flex relative items-stretch">
                                
                                <div id="avatar-prev" class="file-prev flex flex-col justify-between overflow-hidden transition ease-in-out duration-300 h-0">
                                    <img class="w-20 h-20 rounded-full object-cover object-center" src="" alt="Avatar preview">
                                    <label class="ml-1 mt-4 text-sm text-gray-400 italic">//&nbsp; Avatar</label>
                                </div>

                                <div id="cover-prev" class="file-prev flex flex-col justify-between ml-10 overflow-hidden transition ease-in-out duration-300 h-0">
                                    <img class="w-40 h-auto rounded-md" src="" alt="Cover preview">
                                    <label class="ml-1 mt-4 text-sm text-gray-400 italic">//&nbsp; Cover</label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="bg-base-300 bg-opacity-50 px-4 py-3 text-right xs:px-6 sm:px-6">
                      <div onclick="profileUpdate('profile')" class="inline-flex cursor-pointer justify-center rounded-md bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          
          <div class="block xs:hidden sm:hidden" aria-hidden="true">
            <div class="py-5"></div>
          </div>
          
          <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6 lg:grid lg:grid-cols-3 lg:gap-6">
              <div class="md:col-span-1 lg:col-span-1">
                <div class="xs:px-0 sm:px-0 md:px-4 lg:px-4">
                  <h3 class="text-lg font-medium leading-6 text-gray-100 mt-5">Contacts and external links</h3>
                  <p class="mt-1 text-sm text-gray-100">Where can people reach you and / or see your work, other than at KK?<br><br><span class="text-sm text-gray-400 italic">//&nbsp; Email is required; otherwise, share whatever you want to be available publically.</span></p>
                </div>
              </div>
              <div class="md:col-span-2 md:mt-0 lg:col-span-2 lg:mt-0">
                <form class="xs:mt-5 sm:mt-5" id="contacts">
                  <div class="inner relative overflow-hidden shadow rounded-md">
                    <div class="bg-neutral px-4 py-5 sm:p-6 xs:p-6">
                      <div class="grid grid-cols-6 gap-6">
          
                        <div class="sm:col-span-6 md:col-span-3 xs:col-span-6 lg:col-span-3">
                          <label for="email" class="block text-sm font-medium text-gray-100 mb-3">Email address</label>
                          <input type="email" name="email" id="email" autocomplete="email" value="{{ $user->email }}" placeholder="mail@mail.com" required class="mt-1 block w-full rounded-md text-gray-100 border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm">
                        </div>

                        <div class="sm:col-span-6 md:col-span-3 xs:col-span-6 lg:col-span-3">
                            <label for="phone" class="block text-sm font-medium text-gray-100 mb-3">Phone</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                              <input type="tel" name="phone" id="phone" value="{{ isset($data->phone) ? $data->phone : '' }}" class="block w-full flex-1 rounded-r-md focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm bg-base-300 bg-opacity-50 text-gray-100 border-opacity-50 border-gray-700" placeholder="+0012345678">
                            </div>
                          </div>

                          <div class="sm:col-span-6 md:col-span-3 xs:col-span-6 lg:col-span-3">
                            <label for="discord" class="block text-sm font-medium text-gray-100 mb-3">Discord</label>
                            <input type="text" name="discord" id="discord" autocomplete="email" value="{{ isset($data->discord) ? $data->discord : '' }}" placeholder="Username#id" class="mt-1 block w-full rounded-md text-gray-100 border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm">
                          </div>
                          
                          <div class="sm:col-span-6 md:col-span-3 xs:col-span-6 lg:col-span-3">
                            <label for="github" class="block text-sm font-medium text-gray-100 mb-3">GitHub</label>
                            <input type="text" name="github" id="github" autocomplete="github" value="{{ isset($data->github) ? $data->github : '' }}" placeholder="Username" class="mt-1 block w-full rounded-md text-gray-100 border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm">
                          </div>

                          <div class="sm:col-span-6 md:col-span-3 xs:col-span-6 lg:col-span-3">
                            <label for="facebook" class="block text-sm font-medium text-gray-100 mb-3">Facebook</label>
                            <input type="text" name="facebook" id="facebook" autocomplete="facebook" value="{{ isset($data->facebook) ? $data->facebook : '' }}" placeholder="Username" class="mt-1 block w-full rounded-md text-gray-100 border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm">
                          </div>
                          
                          <div class="sm:col-span-6 md:col-span-3 xs:col-span-6 lg:col-span-3">
                            <label for="linkedin" class="block text-sm font-medium text-gray-100 mb-3">Linkedin</label>
                            <input type="url" name="linkedin" id="linkedin" autocomplete="linkedin" value="{{ isset($data->linkedin) ? $data->linkedin : '' }}" placeholder="Profile URL" class="mt-1 block w-full rounded-md text-gray-100 border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm">
                          </div>

                        <div class="col-span-6">
                            <label for="website" class="block text-sm font-medium text-gray-100 mb-3">Website</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                              <span id="ssl-switch" class="inline-flex items-center rounded-l-m bg-base-300 px-3 text-sm text-gray-100 rounded-l-md border-gray-700 cursor-pointer transition ease-in-out duration-200 hover:shadow-inner hover:shadow-indigo-700 hover:bg-indigo-500" title="Click for SSL!" onclick="SSLToggle()">http://</span>
                              <input type="text" name="website" id="website" value="{{ isset($data->website) ? $data->website : '' }}" class="block w-full flex-1 rounded-r-md focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm bg-base-300 text-gray-100 bg-opacity-50 border-opacity-50 border-gray-700" placeholder="www.example.com">
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="bg-base-300 bg-opacity-50 px-4 py-3 text-right xs:px-6 sm:px-6">
                      <div onclick="profileUpdate('contacts')" class="cursor-pointer inline-flex justify-center rounded-md bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="block xs:hidden sm:hidden" aria-hidden="true">
            <div class="py-5"></div>
          </div>

          <div class="w-full">
            <div class="mt-10 sm:mt-0">
                <div class="md:grid md:grid-cols-3 md:gap-6 lg:grid lg:grid-cols-3 lg:gap-6">
                <div class="md:col-span-1 lg:col-span-1">
                    <div class="xs:px-0 sm:px-0 md:px-4 lg:px-4">
                    <h3 class="text-lg font-medium leading-6 text-gray-100 mt-5">LNU / KK details</h3>
                    <p class="mt-1 text-sm text-gray-100">Your programme and year, role in Kodkollektivet, etc.</p>
                    </div>
                </div>
                <div class="md:col-span-2 md:mt-0 lg:col-span-2 lg:mt-0">
                    <form class="xs:mt-5 sm:mt-5" id="lnuKk">
                    <div class="overflow-hidden shadow rounded-md">
                        <div class="bg-neutral px-4 py-5 sm:p-6 xs:p-6">
                            <fieldset>
                                <legend class="contents text-base font-medium text-gray-100">LNU</legend>
                                <p class="text-sm text-gray-100">General student info.</p>
                                <div class="grid grid-cols-6 gap-6 mt-4">
                                        
                                    <div class="xs:col-span-6 sm:col-span-6 md:col-span-3 lg:col-span-3">
                                        <label for="campus" class="block text-sm font-medium text-gray-100 mb-3">Campus</label>
                                        <select id="campus" name="campus" autocomplete="campus" class="mt-1 block w-full rounded-md border-opacity-50 border-gray-700 bg-base-300 bg-opacity-50 text-gray-100 py-2 px-3 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:outline-none focus:ring-indigo-500 xs:text-sm sm:text-sm">
                                            @foreach (['Växjö', 'Kalmar'] as $campus)
                                            <option {{ isset($data->campus) && $campus == $data->campus ? 'selected' : '' }}>{{ $campus }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="xs:col-span-6 sm:col-span-6 md:col-span-3 lg:col-span-3">
                                        <label for="programme" class="block text-sm font-medium text-gray-100 mb-3">Programme</label>
                                        <select id="programme" name="programme" autocomplete="programme" class="mt-1 block w-full rounded-md border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 text-gray-100 py-2 px-3 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:outline-none focus:ring-indigo-500 xs:text-sm sm:text-sm">
                                            @foreach (['Software Technology', 'Computer Technology', 'Network Security', 'Other'] as $programme)
                                            <option {{ isset($data->programme) && $programme == $data->programme ? 'selected' : '' }}>{{ $programme }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="xs:col-span-6 sm:col-span-6 md:col-span-3 lg:col-span-3">
                                        <label for="LOE" class="block text-sm font-medium text-gray-100 mb-3">Level of education</label>
                                        <select id="LOE" name="LOE" autocomplete="LOE" class="mt-1 block w-full rounded-md border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 text-gray-100 py-2 px-3 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:outline-none focus:ring-indigo-500 xs:text-sm sm:text-sm">
                                            @foreach (['Bachelor', 'Master', 'PhD', 'Other'] as $LOE)
                                            <option {{ isset($data->LOE) && $LOE == $data->LOE ? 'selected' : '' }}>{{ $LOE }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="xs:col-span-6 sm:col-span-6 md:col-span-3 lg:col-span-3">
                                        <label for="year" class="block text-sm font-medium text-gray-100 mb-3">Year</label>
                                        <select id="year" name="year" autocomplete="year" class="mt-1 block w-full rounded-md border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 text-gray-100 py-2 px-3 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:outline-none focus:ring-indigo-500 xs:text-sm sm:text-sm">
                                            @foreach ([1, 2, 3, 4, 5, 'Graduate', 'Dropout'] as $year)
                                            <option {{ isset($data->year) && $year == $data->year ? 'selected' : '' }}>{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                
                                </div>
                            </fieldset>

                            <fieldset class="mt-10">
                                <legend class="contents text-base font-medium text-gray-100">Kodkollektivet</legend>
                                <p class="text-sm text-gray-100">What's your deal here?</p>
                                <div class="grid grid-cols-6 gap-6 mt-4">
                                        
                                    <div class="xs:col-span-6 sm:col-span-6 md:col-span-3 lg:col-span-3">
                                        <label for="role" class="block text-sm font-medium text-gray-100 mb-3">Role</label>
                                        <select id="role" name="role" autocomplete="role" class="mt-1 block w-full rounded-md border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 text-gray-100 py-2 px-3 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:outline-none focus:ring-indigo-500 xs:text-sm sm:text-sm">
                                            @foreach ($roles as $role)
                                            <option {{ $role->name == $user->role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @if (isset($positions[0]))

                                    <div class="xs:col-span-6 sm:col-span-6 md:col-span-3 lg:col-span-3">
                                        <label for="position" class="block text-sm font-medium text-gray-100 mb-3">Position</label>
                                        <select id="position" name="position" autocomplete="position" class="mt-1 block w-full rounded-md border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 text-gray-100 py-2 px-3 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:outline-none focus:ring-indigo-500 xs:text-sm sm:text-sm">

                                            <option>Unspecified</option>

                                            @foreach ($positions as $position) {
                                                <option {{ $position->name == $user->position->name ? 'selected' : '' }}>{{ $position->name }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>

                                    <div class="sm:col-span-6 md:col-span-3 xs:col-span-6 lg:col-span-3">
                                        <label for="date_started" class="block text-sm font-medium text-gray-100 mb-3">Date started</label>
                                        <input type="date" name="date_started" id="date_started" autocomplete="date_started" value="{{ isset($data->date_started) ? $data->date_started : date('Y-m-d') }}" class="mt-1 block w-full rounded-md text-gray-100 border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm">
                                    </div>

                                        @if ($user->role_id == 3)

                                        <div class="sm:col-span-6 md:col-span-3 xs:col-span-6 lg:col-span-3">
                                            <label for="date_ended" class="block text-sm font-medium text-gray-100 mb-3">Date ended</label>
                                            <input type="date" name="date_ended" id="date_ended" autocomplete="date_ended" value="{{ isset($data->date_ended) ? $data->date_ended : date('Y-m-d') }}" class="mt-1 block w-full rounded-md text-gray-100 border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm">
                                        </div>

                                        @endif

                                    @endif
                
                                </div>
                            </fieldset>
                        </div>
                        <div class="bg-base-300 bg-opacity-50 px-4 py-3 text-right xs:px-6 sm:px-6">
                        <div onclick="profileUpdate('lnuKk')" class="cursor-pointer inline-flex justify-center rounded-md bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</div>
                        </div>
                    </div>
                    </form>
                </div>
                </div>
            </div>
          </div>  

          <div class="block xs:hidden sm:hidden" aria-hidden="true">
            <div class="py-5"></div>
          </div>
          
          <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6 lg:grid lg:grid-cols-3 lg:gap-6">
              <div class="md:col-span-1 lg:col-span-1">
                <div class="xs:px-0 sm:px-0 md:px-4 lg:px-4">
                  <h3 class="text-lg font-medium leading-6 text-gray-100 mt-5">Change passhowrd</h3>
                  <p class="mt-1 text-sm text-gray-100">And don't come to the Admins complaining about having forgotten it!</p>
                </div>
              </div>
              <div class="md:col-span-2 md:mt-0 lg:col-span-2 lg:mt-0 w-full">
                <form class="xs:mt-5 sm:mt-5" id="password">
                  <div class="overflow-hidden shadow rounded-md">
                    <div class="space-y-6 bg-neutral px-4 py-5 sm:p-6 xs:p-6">
                      
                      <fieldset>
                        <div class="grid grid-cols-6 gap-6 mt-4">

                            <div class="sm:col-span-6 md:col-span-3 xs:col-span-6 lg:col-span-3">
                                <label for="password" class="block text-sm font-medium text-gray-100 mb-3">New password</label>
                                
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="password" name="password" id="password_new" class="block w-full rounded-l-md text-gray-100 border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm">
                                    <span class="inline-flex items-center rounded-r-m bg-base-300 px-3 text-sm text-gray-100 rounded-r-md border-gray-700 cursor-pointer transition ease-in-out duration-200 hover:shadow-inner hover:shadow-indigo-700 hover:bg-indigo-500" title="Show password!" onclick="pvToggle('password_new')">
                                        <svg class="w-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM432 256c0 79.5-64.5 144-144 144s-144-64.5-144-144s64.5-144 144-144s144 64.5 144 144zM288 192c0 35.3-28.7 64-64 64c-11.5 0-22.3-3-31.6-8.4c-.2 2.8-.4 5.5-.4 8.4c0 53 43 96 96 96s96-43 96-96s-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6z"/></svg>
                                    </span>
                                </div>
                            </div>
                        
                            <div class="sm:col-span-6 md:col-span-3 xs:col-span-6 lg:col-span-3">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-100 mb-3">Confirm new password</label>
                                
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full rounded-l-md text-gray-100 border-gray-700 border-opacity-50 bg-base-300 bg-opacity-50 shadow-sm focus:border-indigo-500 transition ease-in-out duration-200 focus:ring-indigo-500 xs:text-sm sm:text-sm">
                                    <span class="inline-flex items-center rounded-r-m bg-base-300 px-3 text-sm text-gray-100 rounded-r-md border-gray-700 cursor-pointer transition ease-in-out duration-200 hover:shadow-inner hover:shadow-indigo-700 hover:bg-indigo-500" title="Show password!" onclick="pvToggle('password_confirmation')">
                                        <svg class="w-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM432 256c0 79.5-64.5 144-144 144s-144-64.5-144-144s64.5-144 144-144s144 64.5 144 144zM288 192c0 35.3-28.7 64-64 64c-11.5 0-22.3-3-31.6-8.4c-.2 2.8-.4 5.5-.4 8.4c0 53 43 96 96 96s96-43 96-96s-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6z"/></svg>
                                    </span>
                                </div>
                            </div>
    
                        </div>
                      </fieldset>
                    </div>
                    <div class="bg-base-300 bg-opacity-50 px-4 py-3 text-right xs:px-6 sm:px-6">
                        <div onclick="profileUpdate('password')" class="cursor-pointer inline-flex justify-center rounded-md bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="block xs:hidden sm:hidden" aria-hidden="true">
            <div class="py-5"></div>
          </div>
          
          <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6 lg:grid lg:grid-cols-3 lg:gap-6">
              <div class="md:col-span-1 lg:col-span-1">
                <div class="xs:px-0 sm:px-0 md:px-4 lg:px-4">
                    <h3 class="text-lg font-medium leading-6 text-gray-100 mt-5">Technologies</h3>
                    <p class="mt-1 text-sm text-gray-100">A great opportunity to flex your unique skillset :)</p>
                    <div class="tabs mt-4">

                        @foreach ($tech_types as $type)

                        <div onclick="setTechType($(this), '{{ $type }}')" class="py-2 w-full transition ease-in-out duration-200 hover:text-gray-100 text-gray-400 cursor-pointer">
                            {{ $type }}
                        </div>

                        @endforeach

                    </div>
                </div>
              </div>
              <div class="md:col-span-2 md:mt-0 lg:col-span-2 lg:mt-0 w-full">
                <form class="xs:mt-5 sm:mt-5" id="technologies">
                  <div class="overflow-hidden shadow rounded-md">
                    <div class="space-y-6 bg-neutral px-4 pb-5 sm:p-6 xs:p-6">
                      <fieldset>
                        <div class="grid grid-cols-12 gap-3 mt-4">

                            {!! $tech !!}
                        
                        </div>
                      </fieldset>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          
          <div class="block xs:hidden sm:hidden" aria-hidden="true">
            <div class="py-5"></div>
          </div>
          
          <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6 lg:grid lg:grid-cols-3 lg:gap-6">
              <div class="md:col-span-1 lg:col-span-1">
                <div class="xs:px-0 sm:px-0 md:px-4 lg:px-4">
                  <h3 class="text-lg font-medium leading-6 text-gray-100 mt-5">Manage data</h3>
                  <p class="mt-1 text-sm text-gray-100">Request your data to be removed from the platform or close account.</p>
                </div>
              </div>
              <div class="md:col-span-2 md:mt-0 lg:col-span-2 lg:mt-0 w-full">
                <form action="#" method="POST">
                  <div class="overflow-hidden shadow rounded-md xs:mt-5 sm:mt-5">
                    <div class="space-y-6 bg-neutral px-4 py-5 sm:p-6 xs:p-6">
                      
                      <fieldset>
                        <legend class="contents text-base font-medium text-error">WARNING!</legend>
                        <p class="text-sm text-error">These actions cannot be reversed.</p>
                        <div class="mt-4 flex xs:-ml-2 sm:-ml-2 relative">
                            <div onclick="confirmToggle('closeAccount')" class="btn xs:btn-sm sm:btn-sm xs:text-xs sm:text-xs transition ease-in-out duration-200 bg-neutral border-1 border-error text-error shadow-xl hover:btn-error active:btn-error focus:btn-error mr-4 xs:mr-0 sm:mr-0 xs:scale-90 sm:scale-90">
                                Close account <svg class="relative ml-2 w-auto fill-current group-hover:fill-base-100" style="top: -1.5px; height: 12px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M367.2 412.5L99.5 144.8C77.1 176.1 64 214.5 64 256c0 106 86 192 192 192c41.5 0 79.9-13.1 111.2-35.5zm45.3-45.3C434.9 335.9 448 297.5 448 256c0-106-86-192-192-192c-41.5 0-79.9 13.1-111.2 35.5L412.5 367.2zM512 256c0 141.4-114.6 256-256 256S0 397.4 0 256S114.6 0 256 0S512 114.6 512 256z"/></svg>
                            </div>
                            <div onclick="confirmToggle('removeData')" class="btn xs:btn-sm sm:btn-sm xs:text-xs sm:text-xs btn-outline shadow-xl transition ease-in-out duration-200 hover:btn-warning active:btn-warning focus:btn-warning xs:scale-90 sm:scale-90">
                                Remove data <svg class="relative ml-2 w-auto fill-current group-hover:fill-base-100" style="top: -1.5px; height: 12px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                            </div>
                        </div>
                      </fieldset>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
    </div>
</div>

@include('components.alert-modal')

<div id="confirm-wrapper" class="overflow-hidden top-0 left-0 fixed w-full h-0 z-100 backdrop-blur-md bg-opacity-20 bg-base-300 flex justify-center items-center">
    <div class="card w-96 bg-error shadow-xl">
        <div class="card-body text-base-100">
          <h2 class="card-title">WARNING!!!</h2>
          <p>Are you sure you want to proceed? This action cannot be reversed!</p>
          <div class="card-actions justify-end bg-transparent text-base-100 border-base-100">
            <div onclick="confirmToggle()" class="btn btn-primary bg-basse-100 bg-opacity-25 text-base-100 border-2 border-transparent transition ease-in-out duration-200 hover:text-base-100 hover:border-base-100 hover:bg-transparent">Cancel</div>
          </div>
        </div>
    </div>
</div>


<script>
    
    window.onload = function() {
        selectTab($(".tabs div:nth-child(1)"))
    }
    window.headers = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

    function disablePrompt() {
        history.pushState({}, null, '/edit-profile')
        $('#prompt').addClass('scale-0')

        setTimeout(() => {
            $('#prompt').remove()
        }, 710);
    }

    function previewUploads(url, type) {
        $(`#${type}-prev img`).attr('src', url)
        $(`#${type}-prev`).removeClass('h-0')
        setTimeout(() => {
            $('#uploads').removeClass('h-0')
        }, 10);
    }

    function setTechType(e, type) {
        if (e.hasClass('text-gray-400')) {
            selectTab(e)

            $.ajax({
                headers:    headers,
                url:        "/tech-type",
                method:     "GET",
                data:       { type: type },
                success:    function (response) {
                    $("#technologies .grid").html(response)
                }
            })
        }
    }

    function toggleTech(e, id) {
        e.hasClass("bg-primary") ? e.removeClass("bg-primary").addClass("bg-base-100") : e.removeClass("bg-base-100").addClass("bg-primary")

        $.ajax({
            headers:    headers,
            url:        "/user-tech/edit",
            method:     "GET",
            data:       { id: id },
            success:    function () {
                //
            }
        })
    }

    function selectTab(tab) {
        $(".tabs div.text-gray-100").addClass("text-gray-400").addClass("cursor-pointer").removeClass("text-gray-100")

        setTimeout(() => {
            tab.removeClass("text-gray-400").removeClass("cursor-pointer").addClass("text-gray-100")
        }, 10)
    }

    function confirmToggle(action = null) {
        if (action != null) {
            $('#confirm-wrapper .card-actions').append('<button onclick="confirmToggle()" class="btn btn-primary bg-base-100 text-error border-2 border-base-100 transition ease-in-out duration-200 hover:bg-error hover:text-base-100 hover:border-base-100">OK</button>')
            $('#confirm-wrapper button').click(function() {
                action == 'removeData' ? removeData() : closeAccount()
            })
            setTimeout(() => {
                $('#confirm-wrapper').removeClass('h-0').addClass('h-full')
            }, 10)
        } else {
            $('#confirm-wrapper').addClass('h-0').removeClass('h-full')
            setTimeout(() => {
                $('#confirm-wrapper button').remove()
            }, 10)
        }
    }

    function SSLToggle() {
        $('#ssl-switch').text() == 'http://' ? setSSLTexts('https://', 'No SSL?') : setSSLTexts('http://', 'Click for SSL!')
    }
    function setSSLTexts(text, titl) {
        $('#ssl-switch').text(text).attr('title', titl)
    }

    function profileUpdate(type) {
        type == 'contacts' ? $('#contacts .inner').append(
                                `<div id="socket-wait" class="w-full h-full flex items-center justify-center absolute top-0 left-0 z-100 bg-base-300 bg-opacity-80" id="loader-wrapper">
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
                                </div>`) : null

        let formData = new FormData()

        $(`#${type} input, #${type} textarea, #${type} select`).each(function() {
            !['cover', 'avatar'].includes($(this).attr('name')) ? formData.append($(this).attr('name'), $(this).val()) :
                ($(this))[0].files[0] ? formData.append($(this).attr('name'), ($(this))[0].files[0]) : null
        })

        formData.append('type', type)

        $.ajax({
            headers:     headers,
            url:         "/update-profile",
            method:      "POST",
            data:        formData,
            processData: false,
            contentType: false,
            success:    function (result) {
                $('#socket-wait').remove()
                result.cover  ? $('#cover-img').css('background-image', `url('/public/images/covers/${result.cover}')`) : null
                result.avatar ? $('#avatar-img').attr('src', `/images/avatars/${result.avatar}`) : null

                $('#uploads').addClass('h-0')
                setTimeout(() => {
                    $(`.file-prev`).addClass('h-0')
                }, 10);

                $('#alert-wrapper .error').remove()
                $('#alert-wrapper h2').text('Data updated successfully!')

                setTimeout(() => {
                    alertToggle()
                }, 10)
            },
            error: function (result) {
                $('#socket-wait').remove()
                $('#alert-wrapper h2').text('Update failed!')
                $('#alert-wrapper p').text('')

                $.each(result.responseJSON.errors, function( key, value ) {
                    value.forEach(error => {
                        $('#alert-wrapper p').append(`<span class="error">${error}</span><br>`)
                    })
                })

                setTimeout(() => {
                    alertToggle()
                }, 10)
            }
        });
    }

    function closeAccount() {
        $.ajax({
            headers:    headers,
            url:        "/close-account",
            method:     "POST",
            success:    function () {
                window.location.reload()
            }
        });
    }

    function removeData() {
        $.ajax({
            headers:    headers,
            url:        "/remove-data",
            method:     "POST",
            success:    function (result) {
                // 
            }
        });
    }

    function pvToggle(id) {
        $(`#${id}`).attr('type') == 'password' ? setPvAttrs(id, 'text', 'Hide password!', '<svg class="w-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c5.2-11.8 8-24.8 8-38.5c0-53-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zm223.1 298L373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5z"/></svg>')
                                               : setPvAttrs(id, 'password', 'Show password!', '<svg class="w-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM432 256c0 79.5-64.5 144-144 144s-144-64.5-144-144s64.5-144 144-144s144 64.5 144 144zM288 192c0 35.3-28.7 64-64 64c-11.5 0-22.3-3-31.6-8.4c-.2 2.8-.4 5.5-.4 8.4c0 53 43 96 96 96s96-43 96-96s-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6z"/></svg>')
    }
    function setPvAttrs(id, type, title, svg) {
        $(`#${id}`).attr('type', type)
        $(`#${id}+span`).attr('title', title).html(svg)
    }

</script>

@endsection