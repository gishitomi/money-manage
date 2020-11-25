<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BudgetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [50000, 10000, 60000];
        foreach($data as $item) {
            DB::table('budgets')->insert([
                'date' => '2020/11/24',
                'money' => $item,
            ]);
        }
    }
}
