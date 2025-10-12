@props(['title', 'value', 'color' => 'blue'])

<div class="bg-{{ $color }}-100 p-4 rounded-lg text-center shadow">
    <h3 class="text-sm text-gray-600">{{ $title }}</h3>
    <p class="text-xl font-bold text-{{ $color }}-700">{{ $value }}</p>
</div>
