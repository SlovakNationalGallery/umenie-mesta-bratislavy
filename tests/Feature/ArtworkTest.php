<?php

namespace Feature;

use App\Models\Artwork;
use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArtworkTest extends TestCase
{
    use RefreshDatabase;

    public function test_location_with_multiple_artworks_count()
    {
        $artworks = Artwork::factory()->published()->count(2);
        Location::factory()
            ->hasAttached($artworks, [
                'order' => 0,
            ])
            ->current()
            ->create([
                'borough' => 'Staré Mesto',
            ]);

        $location = Artwork::getStats()['locations']['Bratislava I'][0];
        $this->assertEquals(2, $location->count);
    }
}
