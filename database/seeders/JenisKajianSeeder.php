<?php

namespace Database\Seeders;

use App\Models\JenisKajian;
use Illuminate\Database\Seeder;

class JenisKajianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisKajian::firstOrCreate([
            'name' => 'Bada Subuh'
        ]);

        JenisKajian::firstOrCreate([
            'name' => 'Bada Dhuha'
        ]);

        JenisKajian::firstOrCreate([
            'name' => 'Bada Dhuhur'
        ]);

        JenisKajian::firstOrCreate([
            'name' => 'Bada Ashar'
        ]);
        
        JenisKajian::firstOrCreate([
            'name' => 'Bada Maghrib'
        ]);
        
        JenisKajian::firstOrCreate([
            'name' => 'Bada Isya'
        ]);
        
        JenisKajian::firstOrCreate([
            'name' => 'Khutbah Jumat'
        ]);
        
        JenisKajian::firstOrCreate([
            'name' => 'Idul Fitri'
        ]);
        
        JenisKajian::firstOrCreate([
            'name' => 'Idul Adha'
        ]);
    }
}
