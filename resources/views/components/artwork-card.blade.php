@props(['artwork'])
<div {{ $attributes }}>
    <a class="block" href="{{ route('artworks.show', $artwork) }}">
        {{ $artwork->coverPhotoMedia->img()->attributes(['class' => 'object-cover object-top transition-all grayscale hover:grayscale-0 ']) }}
    </a>
    <h4 class="text-2xl md:text-lg font-medium mt-2">{{ $artwork->name }}</h4>
    <span class="block text-sm">{{ $artwork->authors->map->name->join(', ') }}</span>
    <span class="block text-sm">{{ optional($artwork->yearBuilt)->toFormattedString() }}</span>
</div>
