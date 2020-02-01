@extends('layouts.app')

@section('content')
<div class='col-md-8 container-fluid'>
    <h4>Add Product </h4>
    <a class='btn btn-success pull-right' class="text-right" href='{{url('/add-card/')}}'> Add New Product</a>
<form method="POST" action="{{url('/add-product/')}}">
    @csrf
 
    <div class="form-group">
            <label for="exampleInputEmail1">Product Name</label>
           
         <select  class="form-control" name='card'>
           @foreach($card as $cd)
             <option value="mtn">{{strtoupper($cd->name)}}</option>
             @endforeach
         </select>
        </div>
    {{-- <div class="form-group">
      <label for="exampleInputPassword1">Amount - (&#8358;)</label>
      <input type="text" name='amount' class="form-control"  placeholder="amount">
    </div> --}}

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection
