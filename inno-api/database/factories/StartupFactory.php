<?php

namespace Database\Factories;

use App\Models\Cert_type;
use App\Models\Project_stage;
use App\Models\ProjectStatus;
use App\Models\Startup;
use App\Models\Team;
use App\Models\Team_member;
use App\Models\Transport_type;
use Illuminate\Database\Eloquent\Factories\Factory;

class StartupFactory extends Factory
{
    protected $model=Startup::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->realText(rand(30,60)),
            'description'=>$this->faker->realText(),
            'advantages_json'=>'["Снижение вероятности аварийной ситуации с пешеходом на 82%", "Увеличение средней скорости автомобилей на 27%", "Уменьшение времени задержки на переходе на 30%"]',
            'transport_type_id'=>Transport_type::get()->random(),
            'request_text'=>$this->faker->realText(rand(40,60)),
            'cert_type_id'=>Cert_type::get()->random(),
            'leader_id'=>Team_member::where('id','>',5)->get()->random(),
            'team_id'=>Team::where('id','>',6)->get()->random(),
            'project_stage_id'=>Project_stage::get()->random(),
            'image'=>$this->faker->imageUrl(),
            'pdf_url'=>'http://innoapi.cyberbobs.xsph.ru/CyberBobs.pdf',
            'project_status_id'=>ProjectStatus::get()->random()
        ];
    }
}
