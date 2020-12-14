<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    public function showEditForm(string $date) {
        $budget = Budget::whereDate('date', 'like', $date . '%')->first();
        return view('budgets.edit', [
            'date' => $date,
            'budget' => $budget,
        ]);
    }
    public function edit(string $date, Request $request) {
        $budget = Budget::whereDate('date', 'like', $date . '%')->first();
        if(isset($budget)) {
            $edit_budget = $budget;
            $edit_budget->date = $request->date;
            $edit_budget->money = $request->budget;
            // $edit_budget->save();
            Auth::user()->budgets()->save($budget);
        }
        else {
            $new_budget = new Budget();
            $new_budget->date = $request->date;
            $new_budget->money = $request->budget;
            // $new_budget->save();
            Auth::user()->budgets()->save($budget);
        }
        return redirect(route('kakeibo.index', ['date' => $date]));
    }
}
