<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use bfinlay\SpreadsheetSeeder\SpreadsheetSeeder;

class ExcelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SpreadsheetSeeder::class,
        ]);
    }
}
