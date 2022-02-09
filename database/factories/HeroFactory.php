<?php

namespace Vgplay\Heros\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Vgplay\Heros\Models\Hero;

class HeroFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hero::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $name = $this->faker->name(),
            'slug' => Str::slug($name),
            'image' => $this->faker->imageUrl(),
            'icon' => $this->faker->imageUrl(64, 64),
            'stats' => []
        ];
    }
}
