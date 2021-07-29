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
    <div class="card">
        <div class="card-body">
            <div class="table-responsive mb-3">
                    <form method="GET" style="margin-bottom: 10px !important;" action="{{ url('/grave') }}" accept-charset="UTF-8"
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
                            <th>GraveID</th>
                            <th>Section</th>
                            <th>Lot#</th>
                            <th>Grave#</th>
                            <th>LotIndex#</th>
                            <th>LotText</th>
                            <th>Interred</th>
                            <th>Deceased_Salutation</th>
                            <th>Deceased_Fname</th>
                            <th>Deceased_Lname</th>
                            <th>Deceased_Pname</th>
                            <th>Deceased_BirthDate</th>
                            <th>Deceased_DeathDate</th>
                            <th>Deceased_BurialDate</th>
                            <th>Grave_Notes</th>
                            <th>Vet</th>
                            <th>Available</th>
                            <th>spacetype</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($graves as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$item->GraveID}}</td>
                            <td>{{$item->Section}}</td>
                            <td>{{$item['Lot#']}}</td>
                            <td>{{$item['Grave#']}}</td>
                            <td>{{$item['LotIndex#']}}</td>
                            <td>{{$item->LotText}}</td>
                            <td>{{$item->Interred}}</td>
                            <td>{{$item->Deceased_Salutation}}</td>
                            <td>{{$item->Deceased_Fname}}</td>
                            <td>{{$item->Deceased_Lname}}</td>
                            <td>{{$item->Deceased_Pname}}</td>
                            <td>{{$item->Deceased_BirtdDate}}</td>
                            <td>{{$item->Deceased_DeatdDate}}</td>
                            <td>{{$item->Deceased_BurialDate}}</td>
                            <td>{{$item->Grave_Notes}}</td>
                            <td>{{$item->Vet}}</td>
                            <td>{{$item->Available}}</td>
                            <td>{{$item->spacetype}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="pagination-wrapper"> {!! $graves->appends(['search' => Request::get('search')])->render() !!}
            </div>
        </div>
    </div>
</div>
</div>
@endsection
