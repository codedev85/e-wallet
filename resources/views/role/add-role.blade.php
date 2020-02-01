@extends('layouts.app')

@section('content')
<div class='col-md-8 container-fluid'>
    <h4>Add Role</h4>
    <?php
    //   $bal = $wallet->credit - $wallet->debit;

    ?>
<form  action="{{ url('/post-role/') }}" accept-charset="UTF-8" class="form-horizontal" role="form" method="POST">
    @csrf
<div class="form-group">
        <label for="exampleInputPassword1">Add Role</label>
        <input type="text" class="form-control @error('role') is-invalid @enderror" name='role' placeholder='Add Role'/ >
        </div>
        
        @error('role')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>



@endsection
