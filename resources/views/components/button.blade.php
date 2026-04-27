@props(['variant' => 'blue', 'icon' => null, 'href' => null])

@php
$colors = [
'blue' => 'bg-blue-500 hover:bg-blue-600',
'red' => 'bg-red-500 hover:bg-red-600',
'green' => 'bg-green-500 hover:bg-green-600',
'yellow' => 'bg-yellow-500 hover:bg-yellow-600',
'gray' => 'bg-gray-500 hover:bg-gray-600',
];

$colorClass = $colors[$variant] ?? $colors['blue'];
@endphp

@if($href)
<a href="{{ $href }}" {{ $attributes->merge(['class' => "inline-flex items-center font-semibold px-6 py-3 rounded-lg transition-colors $colorClass text-white"]) }}>
    @if($icon)
    <i class="fas fa-{{ $icon }} mr-2"></i>
    @endif
    {{ $slot }}
</a>
@else
<button {{ $attributes->merge(['class' => "inline-flex items-center font-semibold px-6 py-3 rounded-lg transition-colors $colorClass text-white"]) }}>
    @if($icon)
    <i class="fas fa-{{ $icon }} mr-2"></i>
    @endif
    {{ $slot }}
</button>
@endif