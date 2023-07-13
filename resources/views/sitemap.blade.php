<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml"
    xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>weekly</changefreq>
    </url>
    <url>
        <loc>{{ route('about') }}</loc>
        <changefreq>weekly</changefreq>
    </url>
    <url>
        <loc>{{ route('artworks.index') }}</loc>
        <changefreq>daily</changefreq>
    </url>
    @foreach ($artworks as $a)
        <url>
            <loc>{{ route('artworks.show', $a->id) }}</loc>
            <lastmod>{{ $a->updated_at->toISOString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1</priority>
        </url>
    @endforeach
</urlset>
