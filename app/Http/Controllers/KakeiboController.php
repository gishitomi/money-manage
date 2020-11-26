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

        // 支出金額のしぼりこみ
        $totalSpendDate = Kakeibo::whereBetween('date', [$firstDate, $lastDate]);
        $totalSpendDate = Kakeibo::where('money_type', 1);
        // 取得した支出金額の合計を算出
        $totalSpend = $totalSpendDate->sum('money');

        // 収入金額のしぼりこみ
        $totalIncomDate = Kakeibo::whereBetween('date', [$firstDate, $lastDate]);
        $totalIncomDate = Kakeibo::where('money_type', 2);
        // 取得した収入金額の合計を算出
        $totalIncom = $totalIncomDate->sum('money');

        $allTotalIncomDate = Kakeibo::where('money_type', 2);
        $allTotallIncom = $allTotalIncomDate->sum('money');

        return view('kakeibo.index', [
            'budget' => $budget,
            'date' => $date,
            'past' => $past,
            'future' => $future,
            'totalSpend' => $totalSpend,
            'totalIncom' => $totalIncom,
            'allTotalIncom' => $allTotallIncom,
        ]); 
    }
    public function create(string $date, Request $request) {
        $budget = Budget::whereDate('date', $date)->first();
        $kakeibo = new Kakeibo();
        $kakeibo->type = $request->type;
        $kakeibo->date = $request->date;
        $kakeibo->money = $request->money;
        $kakeibo->money_type = $request->money_type;
        $kakeibo->description = $request->description;
        $kakeibo->save();

        return redirect(route('kakeibo.index', ['date' => $budget->date]));
    }

    // public function() showNext()


    public function showDetails() {
        $details = Kakeibo::all();
        return view('kakeibo.details', [
            'details' => $details,
        ]);
    }
}
