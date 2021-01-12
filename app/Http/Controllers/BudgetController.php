<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateBudgets;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    public function showEditForm(string $date)
    {
        $budgets = Auth::user()->budgets();
        $budget = $budgets->whereDate('date', 'like', $date . '%')->first();
        // ログインしてるユーザー名を取得
        $userName = Auth::user()->name;
        return view('budgets.edit', [
            'date' => $date,
            'budget' => $budget,
            'userName' => $userName,
        ]);
    }
    public function edit(string $date, CreateBudgets $request)
    {
        $budgets = Auth::user()->budgets();
        $budget = $budgets->whereDate('date', 'like', $date . '%')->first();
        if (isset($budget)) {
            $edit_budget = $budget;
            $edit_budget->date = $request->date;
            $edit_budget->money = $request->budget;

            // ユーザーと紐付け
            Auth::user()->budgets()->save($edit_budget);
        } else {
            $new_budget = new Budget();
            $new_budget->date = $request->date;
            $new_budget->money = $request->budget;
            Auth::user()->budgets()->save($new_budget);
        }
        return redirect(route('kakeibo.index', ['date' => $date]));
    }
}
