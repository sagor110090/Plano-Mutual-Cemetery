@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Owner</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Owner</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>



    <div class="content">
        <div class="card">
            <div class="card-body">
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif

                <div class="content">
                    <a href="{{ url('owner') }}"> <i class="nav-icon fas fa-th" aria-hidden="true"></i> Table view</a>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="GET" style="margin-bottom: 10px !important;"
                                action="{{ url('/owner-card-view') }}" accept-charset="UTF-8"
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
                        <div class="col-md-12">
                            <div class="row">
                                @foreach($owners as $item)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header text-center">
                                            <h3>{{$item['Owner#']}}</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-text">owner : {{ $item['Owner#'] }}</div>
                                            <div class="card-text">LotIndex : {{ $item['LotIndex#'] }}</div>
                                            <div class="card-text">Own_Salutation : {{ $item['Own_Salutation'] }}</div>
                                            <div class="card-text">Own_Fname : {{ $item['Own_Fname'] }}</div>
                                            <div class="card-text">Own_Mname : {{ $item['Own_Mname'] }}</div>
                                            <div class="card-text">Own_Lname : {{ $item['Own_Lname'] }}</div>
                                            <div class="card-text">Own_Pname : {{ $item['Own_Pname'] }}</div>
                                            <div class="card-text">Own_Address : {{ $item['Own_Address'] }}</div>
                                            <div class="card-text">Own_City : {{ $item['Own_City'] }}</div>
                                            <div class="card-text">Own_State : {{ $item['Own_State'] }}</div>
                                            <div class="card-text">Own_Zip : {{ $item['Own_Zip'] }}</div>
                                            <div class="card-text">Own_Phone : {{ $item['Own_Phone'] }}</div>
                                            <div class="card-text">Own_Notes : {{ $item['Own_Notes'] }}</div>


                                        </div>
                                        <div class="card-footer text-center"> 

                                            <a href="{{ asset('owner-edit/'.$item["Owner#"]) }}"
                                                class="btn btn-primary m-1">Edit</a>
                                            <a href="{{ asset('owner-delete/'.$item["Owner#"]) }}" class="btn btn-danger m-1">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pagination-wrapper"> {!! $owners->appends(['search' => Request::get('search')])->render()
                    !!}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    label {
        background: beige;
        padding: 0.5%;
        border-left: 5px solid #28a745;
    }

    input.form-control {
        border: 1px solid #28a745;
        border-radius: unset;
    }

    textarea.form-control {
        border: 1px solid #28a745;
        border-radius: unset;
    }
</style>
@endpush
