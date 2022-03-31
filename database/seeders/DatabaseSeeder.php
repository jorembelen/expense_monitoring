<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\GlCode;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        GlCode::factory(50)->create();
        Employee::factory(50)->create();
        $this->call(UserSeeder::class);
        // $this->call(ExcelSeeder::class);
        // $this->call(EmployeesTableSeeder::class);
        // $this->call(GlCodesTableSeeder::class);
    }
}
