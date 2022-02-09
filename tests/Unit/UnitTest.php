<?php

namespace Vgplay\Heros\Tests\Unit;

use Vgplay\Heros\Models\Hero;
use Vgplay\Heros\Tests\TestCase;

class UnitTest extends TestCase
{
    public function testCreateHero()
    {
        $hero = Hero::factory()->create([
            'name' => 'Duong Qua',
            'slug' => 'duong-qua',
            'stats' => [
                'attack' => 1,
                'defense' => 2
            ]
        ]);

        $this->assertNotNull($hero);
        $this->assertEquals('Duong Qua', $hero->name);
        $this->assertEquals('duong-qua', $hero->slug);
        $this->assertEquals([
            'attack' => 1,
            'defense' => 2
        ], $hero->stats);
    }
}
