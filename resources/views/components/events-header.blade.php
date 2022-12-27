<div class="hero mt-16 border-b-2 border-gray-800" style="min-height: 336px; background-image: url(/public/images/static/static_7.jpg);">
    <div class="hero-overlay bg-opacity-60 "></div>
    <div class="hero-content text-center text-neutral-content py-32">
        <div class="max-w-md">
            <p class="mb-2 uppercase">{{ isset($type) ? 'What\'s happening?' : 'Event calendar' }}</p>
            <h1 class="font-bold capitalize text-{{ !isset($type) || in_array($type, ['all events', 'parties & more']) ? '5xl' : '3xl' }}">{{ isset($type) ? $type : 'Year '.date('Y') }}</h1>
        </div>
    </div>
</div>