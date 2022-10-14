<x-guest-layout>
    <x-auth-card>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form id="hit-socket" method="POST" action="{{ route('register') }}" onsubmit="waitSocket()">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Username -->
            <div class="mt-4">
                <x-label for="username" :value="__('Username')" />

                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4 actions">
                <a class="underline text-sm text-base-content hover:text-blue-200 " href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4 btn-success mt-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>

        <script>
            function waitSocket() {
                document.querySelector('#hit-socket .actions').remove()
                document.querySelector('#hit-socket').insertAdjacentHTML('afterbegin',
                    `<div class="w-full h-full flex items-center justify-center py-6 absolute top-0 left-0 z-100 bg-base-300 bg-opacity-80" id="loader-wrapper">
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
            }
        </script>
    </x-auth-card>
</x-guest-layout>
