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
                    <form method="GET" style="margin-bottom: 10px !important;" action="{{ url('/purchase') }}" accept-charset="UTF-8"
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
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>PurchaseID</th>
                            <th>Owner#</th>
                            <th>GraveID</th>
                            <th>Purchase_Date</th>
                            <th>Purchase_Amt</th>
                            <th>Reference#</th>
                            <th>Purchase_Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchases as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$item->PurchaseID}}</td>
                            <td>{{$item['Owner#']}}</td>
                            <td>{{$item->GraveID}}</td>
                            <td>{{$item->Purchase_Date}}</td>
                            <td>{{$item->Purchase_Amt}}</td>
                            <td>{{$item['Reference#']}}</td>
                            <td>{{$item->Purchase_Notes}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="pagination-wrapper"> {!! $purchases->appends(['search' => Request::get('search')])->render() !!}
            </div>
        </div>
    </div>
</div>
</div>
@endsection
