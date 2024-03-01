<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = 'Tonye Isaac';
        //
        User::create([
            'name' => $name,
            'password' => Hash::make('te196986'),
            'email' => 'Isaactamunotonye@gmail.com',
            'ccode' => '234',
            'mobile' => '8142914001',
            'refercode' => generateReferralCode($name),
            'parentcode' => '',
            'pro_pic' => 'user-default.jpg',
            'status' => 'active',
        ]);
    }
}






