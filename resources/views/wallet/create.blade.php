@extends('layouts.app')

@section('content')
<div class='col-md-8 container-fluid'>
    <h4>Load Wallet</h4>
    <?php
      $bal = $wallet->credit - $wallet->debit;

    ?>
<form  action="{{ url('/load-wallet/') }}" accept-charset="UTF-8" class="form-horizontal" role="form" method="POST">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control"  id="exampleInputEmail1" aria-describedby="emailHelp" value='{{Auth::user()->name}}' disabled>
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='{{Auth::user()->email}}'disabled>
      <input type="hidden" class="form-control" name='user_id' value='{{Auth::user()->id}}'>
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <label for="exampleInputEmail1">Total Crredit - (&#8358;)</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='{{number_format($wallet->credit,2)}}' disabled>
    <label for="exampleInputEmail1">Total Debit  - (&#8358;)</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='{{number_format($wallet->debit, 2)}}' disabled>
    <label for="exampleInputEmail1">Balance  - (&#8358;)</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='{{number_format($bal,2)}}' disabled>
    <div class="form-group">
      <label for="exampleInputPassword1">Amount</label>
      <input type="text" class="form-control" name='amount' placeholder="Amount">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>



@endsection
