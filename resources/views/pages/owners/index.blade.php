@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Owners</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Owners</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


<div class="content">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive mb-3">
                    <form method="GET" style="margin-bottom: 10px !important;" action="{{ url('/owner') }}" accept-charset="UTF-8"
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
                            <th>Owner#</th>
                            <th>LotIndex#</th>
                            <th>Own_Salutation</th>
                            <th>Own_Fname</th>
                            <th>Own_Mname</th>
                            <th>Own_Lname</th>
                            <th>Own_Pname</th>
                            <th>Own_Address</th>
                            <th>Own_City</th>
                            <th>Own_State</th>
                            <th>Own_Zip</th>
                            <th>Own_Phone</th>
                            <th>Own_Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($owners as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$item['Owner#']}}</td>
                            <td>{{$item['LotIndex#']}}</td>
                            <td>{{$item->Own_Salutation}}</td>
                            <td>{{$item->Own_Fname}}</td>
                            <td>{{$item->Own_Mname}}</td>
                            <td>{{$item->Own_Lname}}</td>
                            <td>{{$item->Own_Pname}}</td>
                            <td>{{$item->Own_Address}}</td>
                            <td>{{$item->Own_City}}</td>
                            <td>{{$item->Own_State}}</td>
                            <td>{{$item->Own_Zip}}</td>
                            <td>{{$item->Own_Phone}}</td>
                            <td>{{$item->Own_Notes}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="pagination-wrapper"> {!! $owners->appends(['search' => Request::get('search')])->render() !!}
            </div>
        </div>
    </div>
</div>
</div>
@endsection
