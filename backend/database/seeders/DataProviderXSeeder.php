<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataProviderX;

class DataProviderXSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data for DataProviderX
        $data = [
            [
                'parentAmount' => 200,
                'Currency' => 'USD',
                'parentEmail' => 'parent1@parent.eu',
                'statusCode' => 1,
                'registerationDate' => '2018-11-30',
                'parentIdentification' => 'd3d29d70-1d25-11e3-8591-034165a3a613',
            ],
            // Add more sample data...
        ];

        // Insert data into the data_provider_x table
        DataProviderX::insert($data);
    }
}
