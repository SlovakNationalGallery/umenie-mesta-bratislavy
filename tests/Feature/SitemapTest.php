<?php

namespace Tests\Feature;

use App\Models\Artwork;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class SitemapTest extends TestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;

    public function test_sitemap_lists_static_pages()
    {
        $this->get('/sitemap.xml')
            ->assertStatus(200)
            ->assertSee(url('/'))
            ->assertSee(route('about'))
            ->assertSee(route('artworks.index'));
    }

    public function test_sitemap_lists_presentable_artworks()
    {
        $privateArtwork = Artwork::factory()->create();
        $presentableArtwork = Artwork::factory()->presentable()->create();

        $this->get('/sitemap.xml')
            ->assertSee(route('artworks.show', $presentableArtwork))
            ->assertDontSee(route('artworks.show', $privateArtwork));
    }
}
