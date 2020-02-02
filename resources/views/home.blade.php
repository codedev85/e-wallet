@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="pull-right">
                <a class='btn btn-success' href='{{url('/create-wallet/')}}'> Add Money To wallet</a>

                @if($wallet->balance != 0)
                <a class='btn btn-success' href='{{url('/buy-product/')}}'> Purchase Card</a>
                @endif
                @if(Auth::user()->role_id == 1)
                <a class='btn btn-success' href='{{url('/create-product/')}}'> Create Product</a>
                <a class='btn btn-success' href='{{url('/add-role/')}}'> Add Role</a>
                <a class='btn btn-success' href='{{url('/all-user/')}}'> All Admin</a>
                @endif
            </div>
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <?php

                $totlaCredit = $wallet->credit + $wallet->debit;
                ?>
                <div class="alert alert-success">
                    <h3>Wallet Balance :<small> &#8358; {{number_format($wallet->balance)}}</small></h3>
                </div>
                @if($wallet->balance > 0.0 && $wallet->balance < 1000)
                <h6>
                       You are running low on credit recharge your wallet
                </h6>
                @elseif($wallet->balance == 0.0)
                <h6>
                    You need to load your wallet to make a transaction
                </h6>
                @endif
                <br>

                <div class="alert alert-danger">
                        <h3>Total debit :<small> &#8358; {{number_format($wallet->debit)}}</small></h3>
                    </div>
                    <br>
                <div class="alert alert-info">
                        <h3>Total Credit :<small> &#8358; {{number_format($totlaCredit)}}</small></h3>
                    </div>
                    <br>
                <h2 class="text-center">Transaction History</h2>
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Initiated By</th>
                        <th scope="col">Date</th>

                      </tr>
                    </thead>
                    <tbody>
                @foreach($transactions as $tranx)
                      <tr>
                        <th scope="row">{{$tranx->id}}</th>
                        <td>{{$tranx->product_name}}</td>
                        <td>{{$tranx->phone_number}}</td>
                        <td> &#8358; {{number_format($tranx->amount)}}</td>
                        <td>
                          @if($tranx->user_id == Auth::user()->id)
                             You
                         @endif
                        </td>
                        <td>{{$tranx->created_at->format('j M y H:i:s')}}</td>

                      </tr>
              @endforeach
                    </tbody>
                  </table>
{{ $transactions->links() }}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
