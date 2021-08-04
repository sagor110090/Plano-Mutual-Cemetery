@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">home</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
         <div class="card">
             <div class="card-header text-center">
                 <h3 class="top-header">Plano Mutual Cemetery</h3>
             </div>
             <div class="card-body">
                <div class="row">
                    <div class="col-md-6" style="border-right: 2px solid #18fafff7;">
                        <div class="card-header text-center">
                            <h5 class="sec-header">Data Entry</h5>
                        </div>
                        <div class="mt-4">
                            <a href="{{ url('purchase-create') }}" class="btn btn-default" >Enter Owners Purchase Graves</a>
                        </div>
                        <div class="mt-4">
                            <a href="{{ url('grave-create') }}" class="btn btn-default" >Enter  Graves Info</a>
                        </div>
                        <div class="mt-4">
                            <a href="{{url('owner-create')}}" class="btn btn-default" >Enter  Owner Info</a>
                        </div>
                    </div>
                    <div class="col-md-6" style="border-left: 2px solid #18fafff7;">
                        <div class="card-header text-center">
                            <h5 class="sec-header">Reports</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <a href="#" class="btn btn-default" >List Owaners by section</a>
                            </div>
                            <div class="col-md-6 mt-4">
                                <a href="#" class="btn btn-default" >List Owners by name</a>
                            </div>
                            <div class="col-md-6 mt-4">
                                <a href="#" class="btn btn-default" >List Owaners of section by purchase date</a>
                            </div>
                            <div class="col-md-6 mt-4">
                                <a href="#" class="btn btn-default" >Burials By Deceased Name</a>
                            </div>
                            <div class="col-md-6 mt-4">
                                <a href="#" class="btn btn-default" >Grave Available for Sale</a>
                            </div>
                            <div class="col-md-6 mt-4">
                                <a href="#" class="btn btn-default" >Masonic Graves Listing</a>
                            </div>
                            <div class="col-md-6 mt-4">
                                <a href="#" class="btn btn-default" >Graves Listing</a>
                            </div>
                            <div class="col-md-6 mt-4">
                                <a href="#" class="btn btn-default" >Owners Listing by Owners#</a>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
         </div>
    </div>
</div>

@endsection

@push('css')
    <style>
        .card-header{
            background: #00fff7;
        }
        .top-header{
            font-weight: 900;
        }
        .sec-header{
            font-weight: 600;
        }
        a.btn.btn-default {
            border: 2px solid burlywood;
        }
    </style>
@endpush
