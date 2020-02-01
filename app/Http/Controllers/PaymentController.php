<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Wallet;
use App\Transaction;
use Auth;
use Paystack;

class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()

    {
        // dd($request);
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback(Request $request)
    {
        // dd($request);
        $paymentDetails = Paystack::getPaymentData();
    // dd($paymentDetails['data']);
      //  dd($paymentDetails['data']['metadata']);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want

        $bal = Wallet::where('user_email', Auth::user()->email)->firstOrfail();

            if($paymentDetails['data']['metadata']['product_name'] !== null &&
              
               Auth::user()->id == $paymentDetails['data']['metadata']['user_id'] &&
              
               $bal->balance > $paymentDetails['data']['amount']/100 ){

                    $tranx = new Transaction();
                    $tranx->amount = $paymentDetails['data']['amount']/100;
                    $tranx->user_id = $paymentDetails['data']['metadata']['user_id'];
                    $tranx->product_name = $paymentDetails['data']['metadata']['product_name'];
                    $tranx->phone_number = $paymentDetails['data']['metadata']['number'];
                    $tranx->save();
// dd($bal->balance);
                    // $bal = Wallet::where('user_email', Auth::user()->email)->firstOrfail();

                    $wallet = Wallet::where('user_email',Auth::user()->email)->update([

                        'credit'  => $bal->credit - ($paymentDetails['data']['amount']/100),
                        'debit'   => $bal->debit + ($paymentDetails['data']['amount']/100),
                        'balance' => $bal->balance - ($paymentDetails['data']['amount']/100),

                    ]);
                    
        return redirect('home');
 
        }elseif( $paymentDetails['data']['metadata']['wallet_payment'] == true){

            $bal = Wallet::where('user_email', $paymentDetails['data']['metadata']['email'])->firstOrfail();
      //dd($bal);
       if($bal->credit !== 0.0){
          
            $wallet = Wallet::where('user_email',$paymentDetails['data']['metadata']['email'])->update([

                'credit' => $bal->credit + ($paymentDetails['data']['amount']/100),
                'balance' => ($bal->balance + ($paymentDetails['data']['amount']/100)) - $bal->debit,
            ]);
        }else{
           
            $wallet = Wallet::where('user_email',$paymentDetails['data']['metadata']['email'])->update([

                'credit' => $bal->credit + ($paymentDetails['data']['amount']/100),
                'balance' => ($paymentDetails['data']['amount']/100),
            ]);

        }
            
        return redirect('home');

        }else{

            return redirect('home');
        }



    }
}
