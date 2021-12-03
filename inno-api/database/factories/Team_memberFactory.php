<?php

namespace Database\Factories;

use App\Models\Team_member;
use Illuminate\Database\Eloquent\Factories\Factory;

class Team_memberFactory extends Factory
{
    protected $model=Team_member::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name'=>$this->faker->firstName(),
            'last_name'=>$this->faker->lastName(),
            'position'=>$this->faker->jobTitle(),
            'email'=>$this->faker->email(),
            'phone'=>$this->faker->phoneNumber()
        ];
    }
}
