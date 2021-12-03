<?php

namespace Database\Seeders;

use App\Models\Direction;
use App\Models\Pilot;
use App\Models\Startup;
use App\Models\Team;
use App\Models\Team_member;
use Illuminate\Database\Seeder;

class Test1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team_member::factory(80)->create();
        Team::factory(45)->create();
        Startup::factory(120)->create()->each(function ($startup){
            $startup->pilots()->saveMany(Pilot::factory(rand(1,3))->make());
            $startup->directions()->saveMany(Direction::get()->random(rand(1,2)));
        });
    }
}
