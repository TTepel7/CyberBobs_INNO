<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('cert_types')->insert([[
            'name' => 'Да, требуется сертификация и у нас она есть',
            'alias' => 'Сертификация есть'
        ], [
            'name' => 'Да, требуется сертификация, но у нас ее нет',
            'alias' => 'Сертификации нет'
        ], [
            'name' => 'Нет, не требуется',
            'alias' => 'Не требуется'
        ],]);

        DB::table('directions')->insert([[
            'name' => 'Доступный и комфортный городской транспорт',
            'alias' => 'Городской транспорт'
        ], [
            'name' => 'Новые виды мобильности',
            'alias' => 'Мобильность'
        ], [
            'name' => 'Безопасность дорожного движения',
            'alias' => 'Безопасность'
        ], [
            'name' => 'Здоровые улицы и экология',
            'alias' => 'Экология'
        ], [
            'name' => 'Цифровые технологии в транспорте',
            'alias' => 'ИТ'
        ]]);

        DB::table('project_stages')->insert([[
            'name' => 'Скрининг',
            'alias' => 'Скрининг'
        ], [
            'name' => 'Скоринг',
            'alias' => 'Скоринг'
        ], [
            'name' => 'Экспертный совет',
            'alias' => 'Экспертный совет'
        ],[
            'name' => 'Акселерационная программа',
            'alias' => 'Акселерационная программа'
        ],[
            'name' => 'Программа пилотирования',
            'alias' => 'Программа пилотирования'
        ],[
            'name' => 'Инвестирование',
            'alias' => 'Инвестирование'
        ],]);

        DB::table('staff_types')->insert([[
            'name' => 'Менее 20',
            'alias' => 'Менее 20'
        ], [
            'name' => 'От 20 до 100',
            'alias' => 'От 20 до 100'
        ], [
            'name' => 'От 100 до 500',
            'alias' => 'От 100 до 500'
        ], [
            'name' => 'Более 500',
            'alias' => 'Более 500'
        ]]);

        DB::table('transport_types')->insert([[
            'name' => 'Московский метрополитен',
            'alias' => 'Метро'
        ], [
            'name' => 'Мосгортранс',
            'alias' => 'Мосгортранс'
        ], [
            'name' => 'Центр организации дорожного движения',
            'alias' => 'ЦОДД'
        ], [
            'name' => 'Мостранспроект',
            'alias' => 'Мостранспроект'
        ], [
            'name' => 'Администратор Московского парковочного пространства',
            'alias' => 'АМПП'
        ]]);

        DB::table('project_statuses')->insert([[
            'name' => 'В работе',
            'alias' => 'В работе'
        ], [
            'name' => 'Приостановлен',
            'alias' => 'Приостановлен'
        ], [
            'name' => 'Закрыт',
            'alias' => 'Закрыт'
        ], [
            'name' => 'Отменен',
            'alias' => 'Отменен'
        ]]);
    }
}
