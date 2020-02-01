@extends('layouts.app')

@section('content')
<div class='col-md-8 container-fluid'>
    <h4>Add Administrator</h4>
   
<form  action="{{ url('/post-admin/') }}" accept-charset="UTF-8" class="form-horizontal" role="form" method="POST">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name='name' id="exampleInputEmail1" aria-describedby="emailHelp" placeholder='FullName'>
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" class="form-control @error('email') is-invalid @enderror" name='email' id="exampleInputEmail1" aria-describedby="emailHelp" placeholder='email'>
      {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
    </div>
    <label for="exampleInputEmail1">Roles</label>
    <select  class="form-control" name='role'>
        @foreach($roles as $role)
      <option value="{{$role->id}}">{{$role->name}}</option>
      @endforeach
    </select>
    <label for="exampleInputEmail1">Password</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" name='password' placeholder='password'>
    <label for="exampleInputEmail1">Confirm Password</label>
    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name='c_password' placeholder='Confirm Password'>
<br>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>



@endsection
