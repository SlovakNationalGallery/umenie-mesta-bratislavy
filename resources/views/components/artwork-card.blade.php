@props(['artwork'])
<a class="mt-8 block" href="TODO">
    {{ $artwork->coverPhotoMedia->img()->attributes(['class' => 'w-full rounded-2xl max-h-60 object-cover object-center']) }}
</a>
<h4 class="text-2xl font-medium mt-2">{{ $artwork->name }}</h4>
<span class="block text-sm">{{ $artwork->authors->map->name->join(', ') }}</span>
<span class="block text-sm">{{ optional($artwork->yearBuilt)->toFormattedString() }}</span>
