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

        // 1. Pega um Country que tenha pelo menos um State com Cities
        $country = Country::whereHas('states', function ($query) {
            $query->whereHas('cities');
        })
            ->inRandomOrder()
            ->first();

        // 2. Pega um State (do Country acima) que tenha Cities
        $state = State::where('country_id', $country->id)
            ->whereHas('cities')
            ->inRandomOrder()
            ->first();

        // 3. Pega uma City do State selecionado
        $city = City::where('state_id', $state->id)
            ->inRandomOrder()
            ->first();

        // 4. Pega um Department válido (se não existir, pode adicionar uma verificação)
        $department = Department::inRandomOrder()->first();

        return [
            'country_id'    => $country->id,
            'state_id'      => $state->id,
            'city_id'       => $city->id,
            'department_id' => $department->id,
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
