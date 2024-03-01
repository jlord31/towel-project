<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use App\Models\Report;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Report::create([
            'user_id' => 1,
            'property_id' => 1,
            'message' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui aperiam, corrupti ab, facilis eligendi, accusantium doloremque eos harum asperiores vel recusandae aliquid numquam ducimus praesentium dolorem! At eos eaque quis.',
            'status' => 'unresolved',
        ]);
    }
}
