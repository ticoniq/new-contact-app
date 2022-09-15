<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'      => fake()->company(),
            'address'   => fake()->address(),
            'website'   => fake()->domainName(),
            'email'     => fake()->email(),
            // 'user_id'   => User::factory(),
            'user_id' => User::pluck('id')->random()
        ];
    }
}
