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
        $past = date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($date)) - 1, date(01), date('Y', strtotime($date))));
        $future = date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($date)) + 1, date(01), date('Y', strtotime($date))));
        $firstDate = date('Y-m-01', strtotime($date));
        $lastDate = date('Y-m-t', strtotime($date));
        $totalSpendDate = Kakeibo::whereBetween('date', [$firstDate, $lastDate]);
        return view('kakeibo.index', [
            'budget' => $budget,
            'date' => $date,
            'past' => $past,
            'future' => $future,
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
