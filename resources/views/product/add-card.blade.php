@extends('layouts.app')

@section('content')
<div class='col-md-8 container-fluid'>
    <h4>Purchase Card</h4>
    <?php
    //   $bal = $wallet->credit - $wallet->debit;

    ?>
<form  action="{{ url('/post-card/') }}" accept-charset="UTF-8" class="form-horizontal" role="form" method="POST">
    @csrf
<div class="form-group">
        <label for="exampleInputPassword1">Add Product</label>
        <input type="text" class="form-control @error('product_name') is-invalid @enderror" name='product_name' placeholder='Add Product'/ >
        </div>
        
        @error('product_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>



@endsection
