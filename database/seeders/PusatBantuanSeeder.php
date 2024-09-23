<?php

namespace Database\Seeders;

use App\Models\WebConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PusatBantuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebConfig::create([
            'key' => 'whatsapp',
            'value' => '082147309044'
        ]);

        WebConfig::create([
            'key' => 'email',
            'value' => 'jehemgaul123@gmail.com'
        ]);

        WebConfig::create([
            'key' => 'telepon',
            'value' => '036158495'
        ]);
    }
}
