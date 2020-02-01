@extends('layouts.app')

@section('content')
<div class="container">


        <div class="card">
                <div class="card-header">All Users</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a class='btn btn-success' href='{{url('/create-admin/')}}'> Create Admin</a>
                <br><br>
                <h2 class="text-center">All Users</h2>
                <div class="list-group">
                    @foreach($alladmin as $admin)
                        <a href="{{url('/purchase/'.$admin->id)}}"
                        class="list-group-item list-group-item-action">{{strtoupper($admin->name)}} - <small> {{$admin->role['name']}}</small></a>
                    @endforeach
                 </div>


                </div>
            </div>



</div>
@endsection