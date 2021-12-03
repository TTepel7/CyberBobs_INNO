<?php

namespace Database\Factories;

use App\Models\Staff_type;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Type\Integer;

class TeamFactory extends Factory
{
    protected $model=Team::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $c=$this->faker->company();
        return [
            'short_name'=>$c,
            'ur_name'=>$c,
            'activity'=>'Тестовая компания',
            'inn'=>'111222333',
            'logo'=>'http://innoapi.cyberbobs.xsph.ru/img/Group_145.svg',
            'staff_type_id'=>Staff_type::get()->random()->id,
            'site_url'=>$this->faker->url()
        ];
    }
}
