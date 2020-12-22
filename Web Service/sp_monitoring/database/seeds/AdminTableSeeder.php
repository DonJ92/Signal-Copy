<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add the master administrator, user id of 1
        Admin::create([
            'name' => 'SuperAdmin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin')
        ]);
    }
}
