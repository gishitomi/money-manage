<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KakeiboTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1, 9) as $number) {
            DB::table('kakeibos')->insert([
                'type' => $number,
                'date' => '2020/11/17',
                'money' => $number * 100,
                'money_type' => 1,
                'description' => 'テスト',
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
