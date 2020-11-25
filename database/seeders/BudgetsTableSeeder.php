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
        $data = ['01', '02', '03', '04'];
        foreach($data as $item) {
            DB::table('budgets')->insert([
                'date' => '2020/' . $item . '/01',
                'money' => 20000,
            ]);
        }
    }
}
