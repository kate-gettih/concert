<?php

namespace Tests\Feature;

use App\Models\Concert;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConcertControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGetIdWithValidId(): void
    {
        $concert = Concert::factory()->create();
        $expected = [
            'id' => $concert->id,
            'description' => $concert->description,
            'singer_id' => $concert->singer_id,
            'date' => date('Y-m-d', strtotime($concert->date)),
        ];

        $response = $this->get('api/concert/' . $concert->id);

        $response->assertStatus(200);
        $response->assertJson($expected);
    }

    public function testGetBySingerIdWithValidId(): void
    {
        $concerts = Concert::factory(3)->create(['singer_id' => 1]);

        $expected = [
            [
                'id' => $concerts[0]->id,
                'description' => $concerts[0]->description,
                'city_id' => $concerts[0]->city_id,
                'singer_id' => $concerts[0]->singer_id,
                'date' => date('Y-m-d', strtotime($concerts[0]->date)),
            ],
            [
                'id' => $concerts[1]->id,
                'description' => $concerts[1]->description,
                'city_id' => $concerts[1]->city_id,
                'singer_id' => $concerts[1]->singer_id,
                'date' => date('Y-m-d', strtotime($concerts[1]->date)),
            ],
            [
                'id' => $concerts[2]->id,
                'description' => $concerts[2]->description,
                'city_id' => $concerts[2]->city_id,
                'singer_id' => $concerts[2]->singer_id,
                'date' => date('Y-m-d', strtotime($concerts[2]->date)),
            ],
        ];

        $response = $this->get('api/concerts/singer/1');

        $response->assertStatus(200);
        $response->assertJson($expected);
    }

}
