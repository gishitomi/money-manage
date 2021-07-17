<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kakeibo extends Model
{
    use HasFactory;

    const TYPE = [
        '食費' => ['icon' => '<i class="fas fa-utensils fa-lg"></i>'],
        '光熱費' => ['icon' => '<i class="far fa-lightbulb fa-lg"></i>'],
        '家賃' => ['icon' => ' <i class="fas fa-home fa-lg"></i>'],
        '交通費' => ['icon' => '<i class="fas fa-car fa-lg"></i>'],
        '生活費' => ['icon' => '<i class="fas fa-hands fa-lg"></i>'],
        '趣味' => ['icon' => '<i class="fas fa-star fa-lg"></i>'],
        '貯蓄' => ['icon' => '<i class="fas fa-yen-sign fa-lg"></i>'],
        '被服費' => ['icon' => '<i class="fas fa-tshirt fa-lg"></i>'],
        '美容費' => ['icon' => '<i class="fas fa-cut fa-lg"></i>'],
        '医療費' => ['icon' => '<i class="fas fa-hospital-alt fa-lg"></i>'],
        'その他' => ['icon' => '<i class="fas fa-comment-dots fa-lg"></i>'],
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
