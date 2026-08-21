<?php

namespace Tests\Feature;

use Tests\TestCase;

class MeetTheTeamTest extends TestCase
{
    public function test_meet_the_team_page_renders_with_accurate_roles(): void
    {
        $response = $this->withoutMiddleware(\App\Http\Middleware\ForceTrailingSlash::class)
            ->get('/meet-the-team/');

        $response->assertStatus(200);
        $response->assertSee('Dr. Elina Shalamov');
        $response->assertSee('Licensed Optometrist');
    }
}
