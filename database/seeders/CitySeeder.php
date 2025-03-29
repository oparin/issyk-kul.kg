<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            'Ананьево',
            'Бает',
            'Балыкчы',
            'Бостери',
            'Григорьевка',
            'Жети-Огуз',
            'Каджи-Сай',
            'Кара-Ой (Долинка)',
            'Каракол',
            'Корумду',
            'Кош-Кол',
            'Кызыл-Суу',
            'Сары-Ой',
            'Тамга',
            'Тамчы',
            'Темир',
            'Тюп',
            'Чок-Тал',
            'Чолпон-Ата',
            'Чон-Сары-Ой',
        ];

        foreach ($cities as $city) {
            City::query()->create([
                'name' => $city,
            ]);
        }
    }
}
