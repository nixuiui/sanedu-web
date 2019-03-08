<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class AdminUjianTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() {
        parent::setup();
        $user = factory(User::class)->create();
        $this->actingAs($user, 'adminujian');
    }

    public function text_an_admin_can_show_all_ujian() {
        $response = $this->get('/adminujian/ujian');
    }
}
