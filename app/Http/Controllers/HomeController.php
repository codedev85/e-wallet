<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallet;
use App\Transaction;
Use Auth;

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
    public function index(Request $request)
    {

        $walletSession  = $request->session()->get('wallet');
        $wallet = Wallet::where('user_email',Auth::user()->email)->firstOrfail();
        $transactions = Transaction::where('user_id',Auth::user()->id)->simplePaginate(10);
       
        return view('home')->with('walletSession' , $walletSession )->with('wallet',$wallet)->with('transactions' ,$transactions );
    }
}
