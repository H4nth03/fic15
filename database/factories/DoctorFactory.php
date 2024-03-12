<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'doctor_name' => $this->faker->name(),
            'doctor_email' => $this->faker->email(),
            'doctor_phone' => $this->faker->phoneNumber(),
            'doctor_specialist' => $this->faker->word(),
            'photo' => $this->faker->imageUrl(),
            'address' => $this->faker->address(),
            'sip' => $this->faker->word(),



        ];
    }
}
