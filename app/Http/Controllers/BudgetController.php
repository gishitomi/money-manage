<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function showEditForm(string $date) {
        return view('budgets.edit');
    }
}
