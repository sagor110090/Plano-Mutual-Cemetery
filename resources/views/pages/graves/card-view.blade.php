@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Graves</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Graves</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="content">
        <div class="col-md-12">
            <div class="row">
                @foreach($graves as $grave)
                <div class="col-md-3">
                    <div class="card m-3" style="min-width: 18rem; max-width:30.5%;">
                        <div class="card-header text-center">
                            <h3>{{$grave['GraveID']}}</h3>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">GraveID: {{$grave['GraveID']}}</h5>
                            <p class="card-text">Section: {{$grave['Section']}} </p>
                            <p class="card-text">Interred: {{$grave['Interred']? 'Yes' : 'No'}} </p>

                            <p class="card-text"> </p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>

                        </div>
                        <div class="card-footer text-center">
                            <a href="#" class="btn btn-info m-1">View</a>
                            <a href="#" class="btn btn-primary m-1">Edit</a>
                            <a href="#" class="btn btn-danger m-1">Delete</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {!! $graves->appends(['sort' => 'GraveID'])->links() !!}
        </div>

    </div> --}}
    <div class="content">
        <a href="{{ url('grave') }}"> <i class="nav-icon fas fa-th" aria-hidden="true"></i> Table view</a>
        <div class="row">
            <div class="col-md-12">
                <form method="GET" style="margin-bottom: 10px !important;" action="{{ url('/grave') }}"
                    accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                    @foreach($graves as $item)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header text-center">
                                <h3>{{$item['GraveID']}}</h3>
                            </div>
                            <div class="card-body">
                                <div class="card-text" >GraveID: {{$item->GraveID}}</div>
                                <div class="card-text" >Section: {{$item->Section}}</div>
                                <div class="card-text" >Lot: {{$item['Lot#']}}</div>
                                <div class="card-text" >Grave: {{$item['Grave#']}}</div>
                                <div class="card-text" >LotIndex: {{$item['LotIndex#']}}</div>
                                <div class="card-text" >LotText: {{$item->LotText}}</div>
                                <div class="card-text" >Interred: {{$item['Interred']? 'Yes' : 'No'}}</div>
                                <div class="card-text" >Deceased Salutation: {{$item->Deceased_Salutation}}</div>
                                <div class="card-text" >Deceased Fname: {{$item->Deceased_Fname}}</div>
                                <div class="card-text" >Deceased Lname: {{$item->Deceased_Lname}}</div>
                                <div class="card-text" >Deceased Pname: {{$item->Deceased_Pname}}</div>
                                <div class="card-text" >Deceased BirthDate: {{$item->Deceased_BirtdDate}}</div>
                                <div class="card-text" >Deceased DeathDate: {{$item->Deceased_DeatdDate}}</div>
                                <div class="card-text" >Deceased BurialDate: {{$item->Deceased_BurialDate}}</div>
                                <div class="card-text" >Grave Notes: {{$item->Grave_Notes}}</div>
                                <div class="card-text" >Vet: {{$item->Vet}}</div>
                                <div class="card-text" >Available: {{$item->Available}}</div>
                                <div class="card-text" >spacetype: {{$item->spacetype}}</div>

                            </div>
                            <div class="card-footer text-center">
                                <a href="#" class="btn btn-info m-1">View</a>
                                <a href="#" class="btn btn-primary m-1">Edit</a>
                                <a href="#" class="btn btn-danger m-1">Delete</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="pagination-wrapper"> {!! $graves->appends(['search' => Request::get('search')])->render() !!}
    </div>

</div>
@endsection
