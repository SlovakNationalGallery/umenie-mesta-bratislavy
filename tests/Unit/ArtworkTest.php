<?php

namespace Tests\Unit;

use App\Models\Artwork;
use Tests\TestCase;

class ArtworkTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_description_roughly_converts_airtable_markdown_to_github_markdown()
    {
        $a = Artwork::factory(['description' => "foo\nbar"])->make();
        $this->assertEquals(
            $a->descriptionHtml->toString(),
            "<p>foo</p>\n<p>bar</p>\n"
        );
    }
}
