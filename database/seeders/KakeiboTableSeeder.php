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
        $kakeibo_type = ['食費', '家賃', '趣味', '交通費', '通信費', '被服費'];
        foreach($kakeibo_type as $item) {
            DB::table('kakeibos')->insert([
                'type' => $item,
                'date' => '2020/11/17',
                'money' => 100,
                'money_type' => 1,
                'description' => 'テスト',
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
