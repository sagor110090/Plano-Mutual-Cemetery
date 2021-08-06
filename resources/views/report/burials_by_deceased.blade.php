@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Burials by deceased</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Owner list</li>
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
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <tr>
                                <th>Owner Info / Interred Info</th>
                                <th>Death Date</th>
                                <th>GraveID</th>
                                <th>S</th>
                                <th>L</th>
                                <th>G</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($datas as $row)
                            <tr>
                                <td>

                                    <div class="row">
                                        <div class="col-3">Owner: #{{$row['Owner#']}}</div>
                                        <div class="col-9">{{$row['Own_Fname']}} {{$row['Own_Mname']}}
                                            {{$row['Own_Lname']}}</div>
                                    </div>
                                    <small><strong>Interred: {{$row['Deceased_Fname']}} {{$row['Deceased_Mname']}}
                                            {{$row['Deceased_Lname']}}</strong></small>

                                </td>
                                <td>{{ $row['Deceased_DeathDate'] ? date('d-M-Y', strtotime($row['Deceased_DeathDate'])) : '' }}</td>
                                <td>{{ $row['GraveID'] }}</td>
                                <td>{{ $row['Section'] }}</td>
                                <td>{{ $row['Lot#'] }}</td>
                                <td>{{$row['Grave#']}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
