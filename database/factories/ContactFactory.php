<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Contact;
use App\Models\Company;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name'    => fake()->firstName(),
            'last_name'     => fake()->lastName(),
            'phone'         => fake()->phoneNumber(),
            'email'         => fake()->email(),
            'address'       => fake()->address(),
            'company_id'    => Company::pluck('id')->random(),
            // 'user_id'       => User::factory(),
            // 'user_id'       => Company::all()->random()->user_id,
            'user_id' => Company::find(Company::pluck('id')->random())->user_id
        ];
    }
}
