
<x-app-layout class="min-h-screen bg-base bg-base-300" id="app">

    @include('layouts.navigation')
    
    <div class="min-h-screen bg-base" style="margin-top: -63px;">

        <main>

            <x-slot name="header">
            </x-slot>

            @yield('content')
            
        </main>

    </div>

    @include('components.footer')
</x-app-layout>
