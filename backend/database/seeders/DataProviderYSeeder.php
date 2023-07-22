<?php

namespace Database\Seeders;

use App\Models\DataProviderY;
use Illuminate\Database\Seeder;

class DataProviderYSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data for DataProviderY
        $data = [
            [
                'balance' => 300,
                'currency' => 'AED',
                'email' => 'parent2@parent.eu',
                'status' => 100,
                'created_at' => '2018-12-22',
                'id' => '4fc2-a8d1',
            ],
            // Add more sample data...
        ];

        // Insert data into the data_provider_y table
        DataProviderY::insert($data);
    }
}
