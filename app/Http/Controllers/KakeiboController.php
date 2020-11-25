<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kakeibo;
use App\Models\Budget;
use Carbon\Carbon;

class KakeiboController extends Controller
{
    public function index(string $date) {
        $budget = Budget::whereDate('date', $date)->first();
        return view('kakeibo.index', [
            'budget' => $budget,
            'date' => $date
        ]);
    }
    public function create(Request $request) {
        $kakeibo = new Kakeibo();
        $kakeibo->type = $request->type;
        $kakeibo->date = $request->date;
        $kakeibo->money = $request->money;
        $kakeibo->money_type = $request->money_type;
        $kakeibo->description = $request->description;
        $kakeibo->save();

        return redirect(route('kakeibo.index'));
    }

    // public function() showNext()


    public function showDetails() {
        $details = Kakeibo::all();
        return view('kakeibo.details', [
            'details' => $details,
        ]);
    }
}
