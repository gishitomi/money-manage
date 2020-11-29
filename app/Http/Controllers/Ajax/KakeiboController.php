<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Kakeibo;
use Illuminate\Http\Request;

class KakeiboController extends Controller
{
    public function index(Request $request)
    {
        return Kakeibo::slect('type', 'money')->where('date', $request->date)->get();
    }
}
