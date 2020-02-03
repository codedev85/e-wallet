
@extends('layouts.app')
<style>
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
.recipient{
    display:none;
}
.switchInput_field{
  display:block;
}
</style>


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

        <div class="form-group my_number">
        <label for="exampleInputPassword1">Phone Number</label>
        <input type="text" class="form-control" name='phone_number' placeholder='+234802******' >
        </div>
        {{-- <label for="exampleInputPassword1">Add Recipient</label><br>
        <label class="switch" id="switchBlock">
            <input type="checkbox" >
            <span class="slider round"></span>
          </label> --}}
        
        {{-- <div class="form-group recipient" id="form_recipient">
        <label for="exampleInputPassword1">Phone Number of The recipient</label>
        <input type="text" class="form-control recipient" id="form_number" name='phone_number' placeholder='+234802******' >
        </div> --}}

        <div class="form-group">
        <label for="exampleInputPassword1">Amount</label>
        <input type="text" class="form-control" name='amount' placeholder="Amount">
        </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

@endsection
