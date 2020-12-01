<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kakeibo extends Model
{
    use HasFactory;

    // kakeibosテーブルと関連付ける
    protected $table = "kakeibos";
}
