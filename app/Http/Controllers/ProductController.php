<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Wallet;
use App\Card;
Use Auth;


class ProductController extends Controller
{
    //
    public function createProduct(){
        
        $card = Card::all();
        return view('product.create')->with('card',$card);
    }

    public function addProduct(Request $request){

        // dd($request);

        $validatedData = $request->validate([
            'card' => 'required|string',
        ]);

        $product_name = $request->input('card');
        // $product_amount = $request->input('amount');

        $product =  new Product();
        $product->name = $product_name;
        // $product->amount = $product_amount;
        $product->save();
        return back()->with('success','Data saved successfully!');;

    }

    public function buyProduct(){

        $wallet = Wallet::where('user_email',Auth::user()->email)->firstOrfail();
       
        $products = Product::get();
        return view('product.purchase')->with('wallet',$wallet)->with('products',$products);
      
    }

    public function purchaseProduct(Request $request, $id){


      
        $findProduct = Product::where('id',$id)->firstOrfail();
        $productSession =  $request->session()->get('product');
        return view('product.buy-product')->with('findProduct',$findProduct)->with('productSession',$productSession);
     

    }

    public function cardPayment(Request $request){
// dd($request);
        $number        = $request->input('phone_number');
        $product_name  = $request->input('product_name');

        // dd($number);
        $validatedData = $request->validate([
            'product_name' => 'required|string',
            'amount' => 'required|integer',
            // 'phone_number' => 'required|regex:/^(\+36)[0-9]{9}$/',
            // numeric|phone_number|size:11',

        ]);
    $wallet = Wallet::where('user_email',Auth::user()->email)->firstOrfail();
    // dd($wallet);
    if($wallet->balance >= $request->input('amount')){
           
        if(empty($request->session()->get('product'))){

                $product = new Product();
                $product->fill($validatedData);
                $request->session()->put('product', $product);
                return view('product.tranx')->with('product',$product)->with('number',$number)->with('product_name' ,$product_name );
            }else{
                $product = $request->session()->get('product');
                $product->fill($validatedData);
                $request->session()->put('product', $product);
                return view('product.tranx')->with('product',$product)->with('number',$number)->with('product_name' ,$product_name );
            }

        }else{

            return back()->with('warning','Insufficient Fund!');
        }

        
    }


  


}
