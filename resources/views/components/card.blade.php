@props(['icon' => null, 'title' => null])

<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-sm hover:shadow-lg transition-shadow p-6 text-center']) }}>
    @if($icon)
    <div class="text-blue-500 text-4xl mb-4">
        <i class="fas fa-{{ $icon }}"></i>
    </div>
    @endif

    @if($title)
    <h5 class="text-xl font-semibold mb-2 text-gray-800">
        {{ $title }}
    </h5>
    @endif

    <div class="text-gray-600">
        {{ $slot }}
    </div>
</div>