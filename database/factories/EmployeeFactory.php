<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'country_id'     => Country::inRandomOrder()->value('id'),
            'state_id'       => State::inRandomOrder()->value('id'),
            'city_id'        => City::inRandomOrder()->value('id'),
            'department_id'  => Department::inRandomOrder()->value('id'),
            'first_name'     => $this->faker->firstName(),
            'middle_name'    => $this->faker->firstName(),
            'last_name'      => $this->faker->lastName(),
            'address'        => $this->faker->streetAddress(),
            'zipcode'        => $this->faker->postcode(),
            'date_of_birth'  => $this->faker->date('Y-m-d', '-18 years'),
            'created_at'     => $this->faker->dateTimeBetween('-10 years', 'now'),
            'date_hired'     => $this->faker->date('Y-m-d', 'now'),
        ];
    }
}
