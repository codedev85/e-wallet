<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallet;
use Session;
use Auth;


class WalletController extends Controller
{
    //
    public function walletCreate(Request $request){


        $walletSession = $request->session()->get('wallet');
        $wallet = Wallet::where('user_email',Auth::user()->email)->firstOrfail();

        return view('wallet.create')->with('wallet',$wallet)->with('walletSession' , $walletSession);
    }

    public function payment(){

        return view('wallet.pay');
    }


    public function loadWallet(Request $request){

        $validatedData = $request->validate([
            'amount' => 'required|integer',

        ]);

        // $wallet = $request->session()->put('amount');
        $amount = $request->input('amount');
        $user_id = $request->input('user_id');


        if(empty($request->session()->get('wallet'))){
            $wallet = new Wallet();
            $wallet->fill($validatedData);
            $request->session()->put('wallet', $wallet);

        }else{
            $wallet = $request->session()->get('wallet');
            // dd($wallet);
            $wallet->fill($validatedData);
            $request->session()->put('wallet', $wallet);


        }


        return view('wallet.pay')->with('wallet',$wallet)->with('success','Wallet Funded!');;
    }

}
