<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateKakeibo;
use App\Models\Kakeibo;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KakeiboController extends Controller
{
    public function index(string $date) {
        $budget = Budget::whereDate('date', 'like', $date . '%')->first();
        $past = date('Y-m', mktime(0, 0, 0, date('m', strtotime($date)), 0, date('Y', strtotime($date))));
        $future = date('Y-m', mktime(0, 0, 0, date('m', strtotime($date)) + 2, 0, date('Y', strtotime($date))));
        $firstDate = date('Y-m-01', strtotime($date));
        $lastDate = date('Y-m-t', strtotime($date));

        // 支出金額のしぼりこみ
        $totalSpendDate = Kakeibo::query();
        $totalSpendDate->whereBetween('date', [$firstDate, $lastDate]);
        $totalSpendDate->where('money_type', 1);
        // 取得した支出金額の合計を算出
        $totalSpend = $totalSpendDate->sum('money');

        // 収入金額のしぼりこみ
        $totalIncomDate = Kakeibo::query();
        $totalIncomDate->whereBetween('date', [$firstDate, $lastDate]);
        $totalIncomDate->where('money_type', 2);
        // 取得した収入金額の合計を算出
        $totalIncom = $totalIncomDate->sum('money');

        $allTotalIncomDate = Kakeibo::where('money_type', 2);
        $allTotallIncom = $allTotalIncomDate->sum('money');

        // グラフへの引き渡し
        $log_list = Kakeibo::where('date', 'like', $date . '%')->get();
        $money = [];
        $type = [];
        foreach ($log_list as $log) {
            $money[] = $log->money;
            $type[] = $log->type;
        }
        


        return view('kakeibo.index', [
            'budget' => $budget,
            'date' => $date,
            'past' => $past,
            'future' => $future,
            'totalSpend' => $totalSpend,
            'totalIncom' => $totalIncom,
            'allTotalIncom' => $allTotallIncom,
            'log_list' => $log_list,
            'type' => $type,
            'money' => $money,
        ]); 
    }
    public function create(string $date, CreateKakeibo $request) {
        $budget = Budget::whereDate('date', $date)->first();
        $kakeibo = new Kakeibo();
        $kakeibo->type = $request->type;
        $kakeibo->date = $request->date;
        $kakeibo->money = $request->money;
        $kakeibo->money_type = $request->money_type;
        $kakeibo->description = $request->description;
        Auth::user()->kakeibos()->save($kakeibo);

        return redirect(route('kakeibo.index', ['date' => $budget->date]));
    }
    public function showDetails() {
        $details = Kakeibo::all();
        return view('kakeibo.details', [
            'details' => $details,
        ]);
    }
}
