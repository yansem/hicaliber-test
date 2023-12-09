<?php

namespace Database\Seeders;

use App\Models\House;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = base_path('property-data.csv');
        $csvData = File::get($csvFile);
        $rows = array_map('str_getcsv', explode("\n", $csvData));

        $header = array_shift($rows);

        foreach ($rows as $row) {
            $data = array_combine($header, $row);
            DB::table('houses')->insert([
                'name' => $data['Name'],
                'price' => $data['Price'],
                'bedrooms' => $data['Bedrooms'],
                'bathrooms' => $data['Bathrooms'],
                'storeys' => $data['Storeys'],
                'garages' => $data['Garages']
            ]);
        }
    }
}
