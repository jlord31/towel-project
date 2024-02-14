<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Admin::create([
            'username' => 'luxhouseinc',
            'password' => Hash::make('te196986'),
            'email' => 'admin@towel-ng.com',
            'image' => 'admin.png',
            'designation' => 'Super Admin',
        ]);
    }
}
