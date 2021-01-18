<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kakeibo;
use App\Models\Budget;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class KakeiboController extends Controller
{
    public function index(Request $request) {
        return Auth::user()->kakeibos()->where('date', 'like', $request->date . '%')->orderBy('date', 'ASC')->where('money_type', 1)->get();
    }
}
