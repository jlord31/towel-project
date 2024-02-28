<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    private function generateRandomNumber() {
        return mt_rand(1000, 9999);
    }
    
    private function generateReferralCode($fullName) {
        // Split the full name into first name and last name
        $nameParts = explode(' ', $fullName);

        $firstName = $nameParts[0];

        $randomNumber = $this->generateRandomNumber();
        
        $referralCode = ucfirst($firstName) . $randomNumber;

        return $referralCode;
    }
    
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Tonye Isaac',
            'password' => Hash::make('te196986'),
            'email' => 'Isaactamunotonye@gmail.com',
            'ccode' => '234',
            'mobile' => '8142914001',
            'refercode' => $this->generateReferralCode('Tonye Isaac'),
            'parentcode' => '',
            'pro_pic' => 'user-default.jpg',
            'status' => 'active',
        ]);
    }
}






