<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kakeibo extends Model
{
    use HasFactory;

    const TYPE = [
        '食費' => ['icon' => '<i class="fas fa-utensils fa-2x"></i>'],
        

    ];
    // タイプのアイコンを取得
    public function getTypeIconAttribute()
    {
        // 初期値...カラムを取得
        $type = $this->attributes['type'];
        // 定義されていなければ空文字を返す
        if (!isset(self::TYPE[$type])) {
            return '';
        }

        return self::TYPE[$type]['icon'];
    }

    // kakeibosテーブルと関連付ける
    protected $table = "kakeibos";
}
