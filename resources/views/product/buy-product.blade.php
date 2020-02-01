@extends('layouts.app')

@section('content')
<div class='col-md-8 container-fluid'>
    <h4>Purchase Card</h4>
    <?php
    //   $bal = $wallet->credit - $wallet->debit;

    ?>
<form  action="{{ url('/card-payment/') }}" accept-charset="UTF-8" class="form-horizontal" role="form" method="POST">
    @csrf
<div class="form-group">
        <label for="exampleInputPassword1">Product Name</label>
        <input type="text" class="form-control"  value='{{strtoupper($findProduct->name)}}' disabled>
        <input type="hidden" class="form-control" name='product_name' value='{{strtoupper($findProduct->name)}}'>
        </div>

        <div class="form-group">
        <label for="exampleInputPassword1">Phone Number</label>
        <input type="text" class="form-control" name='phone_number' placeholder='+234802******' >
        </div>

        <div class="form-group">
        <label for="exampleInputPassword1">Amount</label>
        <input type="text" class="form-control" name='amount' placeholder="Amount">
        </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>



@endsection
