<?php

namespace Database\Factories;

use App\Models\Pilot;
use Illuminate\Database\Eloquent\Factories\Factory;

class PilotFactory extends Factory
{
    protected $model=Pilot::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pilot_owner_id'=>6,
            'stages_json'=>'[{"date": "Январь 2021", "text": "Тестирование системы мониторинга дорожного движения на площади тверской заставы"}, {"date": "Март 2021", "text": "Тестирование системы адаптивного регулирования в Люблино и Новомосковском"}, {"date": "Май 2021", "text": "Тестирование системы учета посетителей / пассажиропотока на транспортном пересадочном узле и в местах скопления людей"}]',
            'doc_url'=>'http://innoapi.cyberbobs.xsph.ru/Shablon_otchyota_o_rezultatakh_pilota_v6_2021_10_26.docx'
        ];
    }
}
