<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;

class CardController extends Controller
{
    //
    public function addCard(){
        
        return view('product.add-card');
    }
    public function postCard(Request $request){

        $card = $request->input('product_name');

    
        $validatedData = $request->validate([
            'product_name' => 'required|string',
        ]);
        $newCard = new Card();
        $newCard->name = $card;
        $newCard->save();
        return back()->with('success','Saved Successfully!');
    }

}
