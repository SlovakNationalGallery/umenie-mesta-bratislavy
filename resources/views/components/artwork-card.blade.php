@props(['artwork', 'imgSizes' => null])
<div {{ $attributes }}>
    <a class="block" href="{{ route('artworks.show', $artwork) }}">
        <img srcset="{{ $artwork->coverPhotoMedia->getSrcset() }}" src="{{ $artwork->coverPhotoMedia->getUrl() }}"
            class="object-cover object-top transition-all grayscale hover:grayscale-0 w-full"
            sizes="{{ $imgSizes ?? '1px' }}"
            onload="{{ $imgSizes ? '' : "window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});" }}" />
    </a>
    <h4 class="text-2xl md:text-lg font-medium mt-2">{{ $artwork->name }}</h4>
    <span class="block text-sm">{{ $artwork->authors->map->name->join(', ') }}</span>
    <span class="block text-sm">{{ optional($artwork->yearBuilt)->toFormattedString() }}</span>
</div>

