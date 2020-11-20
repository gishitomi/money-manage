<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kakeibo;

class KakeiboController extends Controller
{
    public function index() {
        return view('kakeibo.index');
    }
    public function create() {
        
    }


    public function showDetails() {
        $details = Kakeibo::all();
        return view('kakeibo.details', [
            'details' => $details,
        ]);
    }
}
