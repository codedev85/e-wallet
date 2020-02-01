
@extends('layouts.app')

@section('content')


<div class="container-fluid col-md-8" >
<form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
        <div class="row" style="margin-bottom:40px;">
          <div class="col-md-8 col-md-offset-2">
            <p>
                <div>

                  <h3 ><b>Product Details</b></h3>
                  <h5><b> Product Name:</b>  <small>{{$product_name }}</small></h5>
                  <h5><b>Phone Number :</b> <small>{{$number}}</small></h5>
                  <h5><b> Amount:</b>  ₦ {{ $product->amount }}</h5>



                </div>
            </p>
            <input type="hidden" name="email" value="{{Auth::user()->email}}">
             {{-- required --}}
            <input type="hidden" name="orderID" value="345">
        <input type="hidden" name="amount" value="{{$product->amount }}00">
            {{-- requiredinkobo --}}
            <input type="hidden" name="quantity" value="3">
            <input type="hidden" name="metadata" value="{{ json_encode($array = ['user_id' => Auth::user()->id,'email'=> Auth::user()->email,'product_name' => $product_name, 'number' => $number ,'wallet_payment' =>null ]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
            <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
            {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

             <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}


            <p>
              <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
              <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
              </button>
            </p>
          </div>
        </div>
</form>
</div>

@endsection

