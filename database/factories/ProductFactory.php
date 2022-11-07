<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(mt_rand(2,4)),
            'slug' => $this->faker->slug(),
            // 'body' => '<p>' . implode('</p><p>',$this->faker->paragraphs(mt_rand(5,10))) . '</p>',
            'detail' => collect($this->faker->paragraphs(mt_rand(5,10)))
                        ->map(fn($p) =>"<p>$p</p>")
                        ->implode(''),
            'stock' => mt_rand(50,200),
            'price' => mt_rand(30000,150000) 
        ];
    }
}
