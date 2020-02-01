@extends('layouts.app')

@section('content')
<div class="container">


        <div class="card">
                <div class="card-header">Purchase Product</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <div class="alert alert-success">
                    <h3>Wallet Balance :<small> &#8358; {{number_format($wallet->balance)}}</small></h3>
                </div>
                <br><br>
                <h2 class="text-center">Prodcuts</h2>
                <div class="list-group">
                    @foreach($products as $product)
                        <a href="{{url('/purchase/'.$product->id)}}"
                        class="list-group-item list-group-item-action">{{strtoupper($product->name)}}</a>
                    @endforeach
                 </div>


                </div>
            </div>



</div>
@endsection
