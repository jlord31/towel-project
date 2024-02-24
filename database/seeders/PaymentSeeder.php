<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_methods')->insert([
            ['title' => 'Razorpay', 'img' => 'razorpay.png', 'attributes' => 'RZP_KEY', 'show_on_mobile' => 0, 'description' => 'Card, UPI, Net banking, Wallet(Phone Pe, Amazon Pay, Freecharge)', 'status' => 'active'],
            ['title' => 'Pay TO Owner', 'img' => 'pay_to_owner.png', 'attributes' => 'Wallet ID: 00000-00202020-020200202-020022020', 'show_on_mobile' => 0, 'description' => 'Pay via Bitcoin to Wallet ID:01022923-2322323-231445342-23', 'status' => 'active'],
            ['title' => 'Paypal', 'img' => 'paypal.png', 'attributes' => 'PAYPAL CLIENT KEY,0', 'show_on_mobile' => 0, 'description' => 'Credit/Debit card with Easier way to pay – online and on your mobile.', 'status' => 'active'],
            ['title' => 'Stripe', 'img' => 'stripe.png', 'attributes' => 'PK_KEY,SK_KEY', 'show_on_mobile' => 0, 'description' => 'Accept all major debit and credit cards from customers in every country', 'status' => 'active'],
            ['title' => 'Wallet', 'img' => 'wallet.png', 'attributes' => '-', 'show_on_mobile' => 0, 'description' => 'Complete Payment Using Wallet', 'status' => 'active'],
            ['title' => 'PayStack', 'img' => 'pay_stack.png', 'attributes' => 'PK_KEY,pk_test_c5932b2c3172b7863cd654f75860c74bf4c05fc8,SK_KEY,sk_test_2cafd22fdc4851692f7a645021e8a13450d3105b', 'show_on_mobile' => 0, 'description' => 'Credit/Debit card with Easier way to pay – online and on your mobile.', 'status' => 'active'],
            ['title' => 'FlutterWave', 'img' => 'flutter_wave.png', 'attributes' => 'FLUTTERWAVE_KEY,FLWPUBK_TEST-e831d0f58a22992361a190230968cc52-X', 'show_on_mobile' => 0, 'description' => 'Card,pay with USSD,pay with bank,pay with barter', 'status' => 'active'],
            ['title' => 'Paytm', 'img' => 'paytm.png', 'attributes' => 'MID,MKEY,TEST', 'show_on_mobile' => 0, 'description' => 'Credit/Debit card,net banking,paytm wallet', 'status' => 'active'],
            ['title' => 'SenangPay', 'img' => 'senang_pay.png', 'attributes' => 'MID,MKEY,TEST', 'show_on_mobile' => 0, 'description' => 'Accept all major debit and credit cards all Related Banks', 'status' => 'active'],
            
        ]);
    }
}
