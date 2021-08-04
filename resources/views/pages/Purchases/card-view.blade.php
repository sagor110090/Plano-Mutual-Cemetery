@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Purchases</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Purchases</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive mb-3">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="GET" style="margin-bottom: 10px !important;"
                                action="{{ url('/purchase-card-view') }}" accept-charset="UTF-8"
                                class="form-inline my-2 my-lg-0 float-right" role="search">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Search..."
                                        value="{{ request('search') }}">
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        <div class="row">
                            @foreach($purchases as $item)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <h3>{{$item['PurchaseID']}}</h3>
                                    </div>
                                    <div class="card-body">

                                        <div class="card-text">Owner : {{ $item['Owner#']}}</div>
                                        <div class="card-text">PurchaseID : {{ $item['PurchaseID']}}</div>
                                        <div class="card-text">GraveID : {{ $item['GraveID']}}</div>
                                        <div class="card-text">Purchase_Date : {{ $item['Purchase_Date']}}</div>
                                        <div class="card-text">Purchase_Amt : {{ $item['Purchase_Amt']}}</div>
                                        <div class="card-text">Reference : {{ $item['Reference#']}}</div>
                                        <div class="card-text">Purchase_Notes : {{ $item['Purchase_Notes']}}</div>




                                    </div>
                                    <div class="card-footer text-center"> 
                                        <a href="{{ asset('purchase-edit/'.$item["PurchaseID"]) }}"
                                            class="btn btn-primary m-1">Edit</a>
                                        <a href="{{ asset('purchase-delete/'.$item["PurchaseID"]) }}"
                                            class="btn btn-danger m-1">Delete</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="pagination-wrapper"> {!! $purchases->appends(['search' => Request::get('search')])->render()
                    !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
