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
    public function index(string $date)
    {
        $budgets = Auth::user()->budgets();
        $budget = $budgets->whereDate('date', 'like', $date . '%')->first();
        $past = date('Y-m', mktime(0, 0, 0, date('m', strtotime($date)), 0, date('Y', strtotime($date))));
        $future = date('Y-m', mktime(0, 0, 0, date('m', strtotime($date)) + 2, 0, date('Y', strtotime($date))));
        $firstDate = date('Y-m-01', strtotime($date));
        $lastDate = date('Y-m-t', strtotime($date));

        // 支出金額のしぼりこみ
        $totalSpendDate = Auth::user()->kakeibos();
        $totalSpendDate->whereBetween('date', [$firstDate, $lastDate]);
        $totalSpendDate->where('money_type', 1);
        // 取得した支出金額の合計を算出
        $totalSpend = $totalSpendDate->sum('money');

        // 収入金額のしぼりこみ
        $totalIncomDate = Auth::user()->kakeibos();
        $totalIncomDate->whereBetween('date', [$firstDate, $lastDate]);
        $totalIncomDate->where('money_type', 2);
        // 取得した収入金額の合計を算出
        $totalIncom = $totalIncomDate->sum('money');

        $allTotalIncomDate = Kakeibo::where('money_type', 2);
        $allTotallIncom = $allTotalIncomDate->sum('money');

        // ログインしてるユーザー名を取得
        $userName = Auth::user()->name;

        return view('kakeibo.index', [
            'budgets' => $budgets,
            'budget' => $budget,
            'date' => $date,
            'past' => $past,
            'future' => $future,
            'totalSpend' => $totalSpend,
            'totalIncom' => $totalIncom,
            'allTotalIncom' => $allTotallIncom,
            'userName' => $userName,
        ]);
    }
    public function create(string $date, CreateKakeibo $request)
    {
        $budgets = Auth::user()->budgets();
        $budget = $budgets->whereDate('date', 'like', $date . '%')->first();
        $kakeibo = new Kakeibo();
        $kakeibo->type = $request->type;
        $kakeibo->date = $request->date;
        $kakeibo->money = $request->money;
        $kakeibo->money_type = $request->money_type;
        $kakeibo->description = $request->description;
        Auth::user()->kakeibos()->save($kakeibo);

        return redirect(route('kakeibo.index', ['date' => $date]));
    }
    public function showDetails(string $date)
    {     
        $budgets = Auth::user()->budgets();
        $budget = $budgets->whereDate('date', 'like', $date . '%')->first();
        $past = date('Y-m', mktime(0, 0, 0, date('m', strtotime($date)), 0, date('Y', strtotime($date))));
        $future = date('Y-m', mktime(0, 0, 0, date('m', strtotime($date)) + 2, 0, date('Y', strtotime($date))));
        $firstDate = date('Y-m-01', strtotime($date));
        $lastDate = date('Y-m-t', strtotime($date));

        // 支出金額のしぼりこみ
        $totalSpendDate = Auth::user()->kakeibos();
        $totalSpendDate->whereBetween('date', [$firstDate, $lastDate]);
        $totalSpendDate->where('money_type', 1);
        // 取得した支出金額の合計を算出
        $totalSpend = $totalSpendDate->sum('money');

        // 収入金額のしぼりこみ
        $totalIncomDate = Auth::user()->kakeibos();
        $totalIncomDate->whereBetween('date', [$firstDate, $lastDate]);
        $totalIncomDate->where('money_type', 2);
        // 取得した収入金額の合計を算出
        $totalIncom = $totalIncomDate->sum('money');

        $allTotalIncomDate = Kakeibo::where('money_type', 2);

        $allTotallIncom = $allTotalIncomDate->sum('money');
        // ログインしてるユーザー名を取得
        $userName = Auth::user()->name;
        $details = Auth::user()->kakeibos();
        $dateDetails = $details->whereDate('date', 'like', $date . '%');

        // 支出金額のみ表示
        $spendDetails = $dateDetails->where('money_type', 1)->get();

        // 収入金額のみ表示
        $incomDetails = $totalIncomDate->get();

        return view('kakeibo.details', [
            'budgets' => $budgets,
            'budget' => $budget,
            'date' => $date,
            'past' => $past,
            'future' => $future,
            'totalSpend' => $totalSpend,
            'totalIncom' => $totalIncom,
            'allTotalIncom' => $allTotallIncom,
            'userName' => $userName,
            'spendDetails' => $spendDetails,
            'incomDetails' => $incomDetails,
        ]);
    }

    public function showStatisticsForm(string $date)
    {
        $budgets = Auth::user()->budgets();
        $budget = $budgets->whereDate('date', 'like', $date . '%')->first();
        $past = date('Y-m', mktime(0, 0, 0, date('m', strtotime($date)), 0, date('Y', strtotime($date))));
        $future = date('Y-m', mktime(0, 0, 0, date('m', strtotime($date)) + 2, 0, date('Y', strtotime($date))));
        $firstDate = date('Y-m-01', strtotime($date));
        $lastDate = date('Y-m-t', strtotime($date));

        // 支出金額のしぼりこみ
        $totalSpendDate = Auth::user()->kakeibos();
        $totalSpendDate->whereBetween('date', [$firstDate, $lastDate]);
        $totalSpendDate->where('money_type', 1);
        // 取得した支出金額の合計を算出
        $totalSpend = $totalSpendDate->sum('money');

        // 収入金額のしぼりこみ
        $totalIncomDate = Auth::user()->kakeibos();
        $totalIncomDate->whereBetween('date', [$firstDate, $lastDate]);
        $totalIncomDate->where('money_type', 2);
        // 取得した収入金額の合計を算出
        $totalIncom = $totalIncomDate->sum('money');

        $allTotalIncomDate = Kakeibo::where('money_type', 2);

        $allTotallIncom = $allTotalIncomDate->sum('money');
        // ログインしてるユーザー名を取得
        $userName = Auth::user()->name;
        $details = Auth::user()->kakeibos();
        $dateDetails = $details->whereDate('date', 'like', $date . '%');

        // 支出金額のみ表示
        $spendDetails = $dateDetails->where('money_type', 1)->get();

        // 収入金額のみ表示
        $incomDetails = $totalIncomDate->get();

        return view('kakeibo.statistics', [
            'budgets' => $budgets,
            'budget' => $budget,
            'date' => $date,
            'past' => $past,
            'future' => $future,
            'totalSpend' => $totalSpend,
            'totalIncom' => $totalIncom,
            'allTotalIncom' => $allTotallIncom,
            'userName' => $userName,
            'spendDetails' => $spendDetails,
            'incomDetails' => $incomDetails,
        ]);
    }
}
