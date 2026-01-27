<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, get India's country ID
        $indiaId = DB::table('countries')->where('name', 'India')->value('id');
        
        if (!$indiaId) {
            // Create India if it doesn't exist
            $indiaId = DB::table('countries')->insertGetId([
                'name' => 'India',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $states = [
            // States
            'Andhra Pradesh',
            'Arunachal Pradesh',
            'Assam',
            'Bihar',
            'Chhattisgarh',
            'Goa',
            'Gujarat',
            'Haryana',
            'Himachal Pradesh',
            'Jharkhand',
            'Karnataka',
            'Kerala',
            'Madhya Pradesh',
            'Maharashtra',
            'Manipur',
            'Meghalaya',
            'Mizoram',
            'Nagaland',
            'Odisha',
            'Punjab',
            'Rajasthan',
            'Sikkim',
            'Tamil Nadu',
            'Telangana',
            'Tripura',
            'Uttar Pradesh',
            'Uttarakhand',
            'West Bengal',
            // Union Territories
            'Andaman and Nicobar Islands',
            'Chandigarh',
            'Dadra and Nagar Haveli and Daman and Diu',
            'Delhi',
            'Jammu and Kashmir',
            'Ladakh',
            'Lakshadweep',
            'Puducherry',
        ];

        foreach ($states as $state) {
            DB::table('states')->updateOrInsert(
                ['name' => $state, 'country_id' => $indiaId],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }

        $this->command->info('Indian states seeded successfully!');
    }
}
