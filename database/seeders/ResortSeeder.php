<?php

namespace Database\Seeders;

use App\Models\Resort;
use Illuminate\Database\Seeder;

class ResortSeeder extends Seeder
{
    public function run(): void
    {
        $resorts = [
            "Asia Palace",
            "Baytur Resort & Spa",
            "Bellagio",
            "Chaika Resort",
            "Costa Brava",
            "Diamond Resort",
            "Dolinka Deluxe",
            "Dordoi Resorts",
            "Karven Four Seasons",
            "Novel",
            "Palm Beach",
            "Royal beach",
            "Аврора",
            "Ак Жол",
            "Ак Марал",
            "Акун",
            "Альбатрос",
            "Атлантис",
            "Витязь",
            "Голубой Иссык-Куль",
            "Дилором",
            "Евразия",
            "Золотые пески",
            "Илбирс Саадат",
            "Каприз",
            "Кейсар",
            "Колумб",
            "Кыргызское взморье",
            "Лагуна Сити",
            "Лазурный берег",
            "Париж",
            "Радуга",
            "Радуга West",
            "Рахат",
            "Симирам",
            "Солнышко",
            "Фонтан"
        ];

        foreach ($resorts as $resort) {
            Resort::query()->create([
                'name' => $resort,
            ]);
        }
    }
}
