<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'admission_number' => 'EHS/' .$this->faker->numberBetween(2024, 2025) .'/'. $this->faker->unique()->numberBetween(1000, 9999),
            'admission_year'   => $this->faker->numberBetween(2024, 2025),
            'first_name'       => $this->faker->firstName(),
            'middle_name'      => $this->faker->firstName(),
            'last_name'        => $this->faker->lastName(),
            'school_class_id'  => 1, // adjust to your classes
            'class_arm'        => $this->faker->randomElement(['1', '2']),
            'date_of_birth'    => $this->faker->dateTimeBetween('2005-01-01', '2015-12-31')->format('Y-m-d'),
            'gender'           => $this->faker->randomElement(['Male', 'Female']),
            'religion'         => $this->faker->randomElement(['Christianity', 'Islam', 'Traditional']),
            'address'          => $this->faker->address(),
            'state_of_origin'  => $this->faker->state(),
            'lga'              => $this->faker->city(),
            'phone'            => $this->faker->phoneNumber(),
            'passport_photo'   => null,
            'result_pin' => strtoupper($this->faker->unique()->bothify('PIN####')),
            'graduated_at'     => null,
        ];
    }
}
