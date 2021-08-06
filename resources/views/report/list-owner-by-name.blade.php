@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Owner by name</h1>
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
                    @foreach ($datas as $key => $items)
                    <h1 class="text-blue">Name: {{ $key }}</h1>
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Section</th>
                                <th width="5%">Owner#</th>
                                <th width="5%">Sal.</th>
                                <th>Owner Name</th>
                                <th>GraveID</th>
                                <th>L</th>
                                <th>G</th>
                                <th>LotText</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $info)
                                <tr>
                                    <td>{{ $info['Section'] }}</td>
                                    <td>{{ $info['Owner#'] }}</td>
                                    <td>{{ $info['Own_Salutation'] }}</td>
                                    <td>{{ $info['Own_Fname'].' '.$info['Own_Mname'].' '.$info['Own_Lname'] }}</td>
                                    <td>{{ $info['GraveID'] }}</td>
                                    <td>{{ $info['Lot#'] }}</td>
                                    <td>{{ $info['Grave#'] }}</td>
                                    <td>{{ $info['LotText'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endforeach
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
