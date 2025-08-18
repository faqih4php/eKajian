<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jabatan::firstOrCreate([
            'name' => 'Personal'
        ]);

        Jabatan::firstOrCreate([
            'name' => 'Takmir'
        ]);

        Jabatan::firstOrCreate([
            'name' => 'Instansi'
        ]);
    }
}
