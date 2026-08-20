<?php

namespace Tests\Feature;

use Tests\TestCase;

class CounterPagesTest extends TestCase
{
    public function test_about_us_page_renders_with_expected_counters(): void
    {
        $response = $this->withoutMiddleware(\App\Http\Middleware\ForceTrailingSlash::class)
            ->get('/about-us/');

        $response->assertStatus(200);
        $response->assertSee('data-to-value="1999"', false);
        $response->assertSee('1999</span>', false);
        $response->assertSee('data-to-value="179"', false);
        $response->assertSee('179</span>', false);
        $response->assertSee('data-to-value="3"', false);
        $response->assertSee('3</span>', false);
    }

    public function test_services_page_renders_with_expected_counters(): void
    {
        $response = $this->withoutMiddleware(\App\Http\Middleware\ForceTrailingSlash::class)
            ->get('/services/');

        $response->assertStatus(200);
        $response->assertSee('data-to-value="1999"', false);
        $response->assertSee('1999</span>', false);
        $response->assertSee('data-to-value="179"', false);
        $response->assertSee('179</span>', false);
        $response->assertSee('data-to-value="3"', false);
        $response->assertSee('3</span>', false);
    }
}
