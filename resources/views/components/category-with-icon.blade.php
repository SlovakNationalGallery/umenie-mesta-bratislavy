@props(['name', 'id', 'icon'])
<a href="{{ route('artworks.index', ['categories[]' => $id]) }}"
    class="group flex items-center gap-x-4 md:gap-x-6 hover:text-red-500">
    <x-dynamic-component :component="'icons.pins.' . $icon" class="w-10 h-10 md:w-12 md:h-auto flex-shrink-0 group-hover:fill-red-500" />
    {{ Str::ucfirst($slot) }}
</a>
