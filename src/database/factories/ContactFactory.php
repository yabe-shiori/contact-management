<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'gender' => $this->faker->randomElement([1, 2]),
            'email' => $this->faker->unique()->safeEmail,
            'postcode' => $this->faker->postcode,
            'address' => $this->faker->address,
            'opinion' => $this->faker->text,
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}
