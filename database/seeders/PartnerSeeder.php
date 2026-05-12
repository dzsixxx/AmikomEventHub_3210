<?php

namespace Database\Seeders;

use App\Models\Partner; // Wajib dipanggil
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker; // Memanggil library Faker

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Menggunakan format Indonesia

        // Looping sebanyak 5 kali untuk membuat 5 data partner
        foreach (range(1, 5) as $index) {
            Partner::create([
                'name' => $faker->company,
                // Membuat URL logo fiktif menggunakan placehold.co
                'logo_url' => 'https://placehold.co/200x200/4f46e5/white?text=Partner+' . $index,
            ]);
        }
    }
}