<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class LegacyRedirectTest extends TestCase
{
    public function test_all_configured_legacy_urls_return_301_with_matching_destination(): void
    {
        $redirects = Config::get('redirects');

        $this->assertNotEmpty($redirects);

        foreach ($redirects as $from => $to) {
            $this->get($from)
                ->assertStatus(301)
                ->assertRedirect($to);
        }
    }

    public function test_unknown_tag_returns_404(): void
    {
        $this->get('/tag/does-not-exist')
            ->assertStatus(404);
    }

    public function test_unknown_category_returns_404(): void
    {
        $this->get('/category/does-not-exist')
            ->assertStatus(404);
    }
}
