@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Purchage</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Purchage</li>
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
                <form action="{{ url('purchase-store') }}" method="post" class="m-4">
                    @csrf
                    <div class=" ">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Purchase ID</label>
                            <input type="text" class="form-control" id="PurchaseID" name="PurchaseID"
                                placeholder="Purchase ID" value="{{ App\Models\Purchase::max('PurchaseID') + 1 }}" readonly="">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Owner</label>
                                    <select id="Owner" class="form-control" name="Owner#">
                                        @foreach (App\Models\Owner::get() as $item)
                                        <option value="{{ $item['Owner#'] }}">{{ $item['Own_Fname'].' '.$item['Own_Mname'].' '.$item['Own_Lname'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Grave ID</label>
                                    <input type="text" class="form-control" id="GraveID" name="GraveID"
                                        placeholder="Grave ID">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Purchase Date</label>
                                    <input type="date" class="form-control" id="Purchase_Date" name="Purchase_Date"
                                        placeholder="Purchase Date">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Purchase Amt</label>
                                    <input type="number" step="0.01" min="0" class="form-control"
                                        id="Purchase_Amt" placeholder="Purchase Amt" name="Purchase_Amt">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Reference#</label>
                            <input type="text" class="form-control" id="Reference" name="Reference#" maxlength="8"  placeholder="Reference#">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Purchase Notes</label>
                            <textarea class="form-control" id="Purchase_Notes" name="Purchase_Notes" placeholder="Purchase Notes"
                                rows="2"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary processu">Submit</button>

                </form>

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
