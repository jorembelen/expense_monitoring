<?php

namespace App\Http\Controllers;

use App\Models\CashAdvance;
use App\Models\CashBook;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pw = '123456';
        if(Hash::check($pw, auth()->user()->password)){
            return redirect()->route('reset.pw');
        }

        $totalEmp = Employee::pluck('id')->count();
        $totalCash = CashBook::latest()->first();

        if(auth()->user()->role_id == 2){
            $totalCashAdvance = CashAdvance::whereuser_id(auth()->id())->wherepayment_status(2)->sum('amount');
        }else{
            $totalCashAdvance = CashAdvance::wherepayment_status(2)->sum('amount');
        }

        return view('home', compact('totalEmp', 'totalCash', 'totalCashAdvance'));
    }
}
