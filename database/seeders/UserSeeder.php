<?php

namespace Database\Seeders;

use App\Models\CashBook;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'role_id' => 1,
            'password' => 'password',
        ]);
        User::create([
            'name' => 'Peter Parker',
            'username' => 'peter.parker',
            'email' => 'peter@parker.com',
            'role_id' => 2,
            'user_code' => '488122',
            'password' => 'password',
        ]);

        CashBook::create([
            'in' => 5000,
            'out' => 0,
            'balance' => 5000,
        ]);

    }

}
