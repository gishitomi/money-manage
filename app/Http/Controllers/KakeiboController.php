<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateKakeibo;
use App\Models\Kakeibo;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use function PHPUnit\Framework\isNull;

class KakeiboController extends Controller
{
    public function index(string $date)
    {
        // if(isnull($date)) {
        //     abort(404);
        // }
        $budgets = Auth::user()->budgets();
        $budget = $budgets->whereDate('date', 'like', $date . '%')->first();
        $past = date('Y-m', mktime(0, 0, 0, date('m', strtotime($date)), 0, date('Y', strtotime($date))));
        $future = date('Y-m', mktime(0, 0, 0, date('m', strtotime($date)) + 2, 0, date('Y', strtotime($date))));
        $firstDate = date('Y-m-01', strtotime($date));
        $lastDate = date('Y-m-t', strtotime($date));

        // 支出金額のしぼりこみ
        $totalSpendDate = Auth::user()->kakeibos();
        $totalSpendDate->whereBetween('date', [$firstDate, $lastDate]);
        $totalSpendDate->where('money_type', 1)->where('delete_flag', 1);
        // 取得した支出金額の合計を算出
        $totalSpend = $totalSpendDate->sum('money');

        // 収入金額のしぼりこみ
        $totalIncomDate = Auth::user()->kakeibos();
        $totalIncomDate->whereBetween('date', [$firstDate, $lastDate]);
        $totalIncomDate->where('money_type', 2)->where('delete_flag', 1);
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
        $kakeibo->delete_flag = 1;
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
        $spendDetails = $dateDetails->where('money_type', 1)->where('delete_flag', 1)->orderBy('date', 'ASC')->get();

        // 収入金額のみ表示
        $incomDetails = $totalIncomDate->where('delete_flag', 1)->orderBy('date', 'ASC')->get();

        // 支出金額の件数を取得
        $spendCount = $dateDetails->where('money_type', 1)->count();

        // 収入金額の件数を取得
        $incomCount = $totalIncomDate->count();

        // 支出金額、収入金額全ての件数を取得
        $allCount = $spendCount + $incomCount;

        // id
        $kakeiboId = Auth::user()->kakeibos();
        // var_dump($kakeiboId);

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
            'spendCount' => $spendCount,
            'incomCount' => $incomCount,
            'allCount' => $allCount,
        ]);
    }

    public function detailsEdit(string $date, Request $request)
    {
        $kakeibos = Auth::user()->kakeibos();
        $detailData = $request->post();
        $deleteDataId = $detailData['delete_id'];

        foreach($deleteDataId as $deleteItemId) {
            // 削除処理
            // $kakeibos->delete($deleteItemId);

            // 20220110
            // delete_flagカラムを使ってDB上から削除せず非表示にする処理に変更
            $kakeibos->where('id', $deleteItemId)
            ->update([
                'delete_flag' => 0,
            ]);

        }
        return redirect(route('kakeibo.details', ['date' => $date]));
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

        $allTotalIncom = $allTotalIncomDate->sum('money');
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
            'allTotalIncom' => $allTotalIncom,
            'userName' => $userName,
            'spendDetails' => $spendDetails,
            'incomDetails' => $incomDetails,
        ]);
    }
}
