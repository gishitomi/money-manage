<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateKakeibo;
use App\Models\Kakeibo;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CalendarController extends Controller
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

        // ログインしてるユーザー名を取得
        $userName = Auth::user()->name;
        $details = Auth::user()->kakeibos();

        $allTotalIncomDate = Kakeibo::where('money_type', 2);

        $allTotalIncom = $allTotalIncomDate->sum('money');

        //カレンダーメソッド呼び出し
        $weeks = $this->calendar($date);

        return view('kakeibo.calendar', [
            'budgets' => $budgets,
            'budget' => $budget,
            'date' => $date,
            'past' => $past,
            'future' => $future,
            'userName' => $userName,
            'allTotalIncom' => $allTotalIncom,
            'weeks' => $weeks,
            'totalSpend' => $totalSpend,
            'totalIncom' => $totalIncom,
        ]);
    }

    public function calendar(string $date)
    {
        // タイムゾーンを設定
        date_default_timezone_set('Asia/Tokyo');

        $ym = $date;

        // タイムスタンプを作成し、フォーマットをチェックする
        $timestamp = strtotime($ym . '-01');
        if ($timestamp === false) {
            $ym = date('Y-m');
            $timestamp = strtotime($ym . '-01');
        }

        // 今日の日付 フォーマット　例）2021-06-3
        $today = date('Y-m-j');

        // 該当月の日数を取得
        $day_count = date('t', $timestamp);

        // １日が何曜日か　0:日 1:月 2:火 ... 6:土
        $youbi = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));


        // カレンダー作成の準備
        $weeks = [];
        $week = '';

        // 第１週目：空のセルを追加
        // 例）１日が火曜日だった場合、日・月曜日の２つ分の空セルを追加する
        $week .= str_repeat('<td></td>', $youbi);

        for ($day = 1; $day <= $day_count; $day++, $youbi++) {

            // 2021-06-3
            $date = $ym . '-' . $day;

            if ($today == $date) {
                // 今日の日付の場合は、class="today"をつける
                $week .= '<td class="today">' . $day;
            } else {
                $week .= '<td>' . $day;
            }
            $week .= '</td>';

            // 週終わり、または、月終わりの場合
            if ($youbi % 7 == 6 || $day == $day_count) {
                if ($day == $day_count) {
                    // 月の最終日の場合、空セルを追加
                    // 例）最終日が水曜日の場合、木・金・土曜日の空セルを追加
                    $week .= str_repeat('<td></td>', 6 - $youbi % 7);
                }

                // weeks配列にtrと$weekを追加する
                $weeks[] = '<tr>' . $week . '</tr>';

                // weekをリセット
                $week = '';
            }
        }
        return $weeks;
    }
}
