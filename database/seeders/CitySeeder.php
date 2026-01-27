<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get India's country ID
        $indiaId = DB::table('countries')->where('name', 'India')->value('id');
        
        if (!$indiaId) {
            // Create India if it doesn't exist
            $indiaId = DB::table('countries')->insertGetId([
                'name' => 'India',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Get Tamil Nadu's state ID
        $tamilNaduId = DB::table('states')
            ->where('name', 'Tamil Nadu')
            ->where('country_id', $indiaId)
            ->value('id');
        
        if (!$tamilNaduId) {
            $this->command->error('Tamil Nadu state not found. Please run StateSeeder first.');
            return;
        }

        $cities = [
            'Chennai',
            'Coimbatore',
            'Madurai',
            'Tiruchirappalli',
            'Salem',
            'Tirunelveli',
            'Tiruppur',
            'Ranipet',
            'Nagercoil',
            'Thanjavur',
            'Vellore',
            'Kancheepuram',
            'Erode',
            'Tiruvannamalai',
            'Pollachi',
            'Rajapalayam',
            'Sivakasi',
            'Pudukkottai',
            'Neyveli',
            'Nagapattinam',
            'Viluppuram',
            'Tiruchengode',
            'Vaniyambadi',
            'Theni',
            'Cuddalore',
            'Kumbakonam',
            'Tirupattur',
            'Avadi',
            'Pallavaram',
            'Ambattur',
            'Tambaram',
            'Hosur',
            'Karur',
            'Dindigul',
            'Krishnagiri',
            'Namakkal',
            'Ooty',
            'Kodaikanal',
            'Kanyakumari',
            'Rameswaram',
        ];

        foreach ($cities as $city) {
            DB::table('cities')->updateOrInsert(
                ['name' => $city, 'state_id' => $tamilNaduId, 'country_id' => $indiaId],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }

        $this->command->info('Tamil Nadu cities seeded successfully!');
    }
}
