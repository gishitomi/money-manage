<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kakeibo;
use App\Models\Budget;
use Carbon\Carbon;

class KakeiboController extends Controller
{
    public function index(Request $request) {
        return Kakeibo::where('date', 'like', $request->date . '%')->where('money_type', 1)->get();
    }
}
