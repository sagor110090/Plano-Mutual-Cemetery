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
             <form action="{{ url('owner-store') }}" method="post" class="m-4">
                @csrf
                <div class="">

                    <div class="">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Owner ID</label>
                                    <input type="text" class="form-control" id="OwnerID" name="OwnerID#" placeholder="Owner ID" value="{{ App\Models\Owner::max('Owner#') + 1 }}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">LotIndex#</label>
                                    <input type="number" class="form-control" id="LotIndexC" maxlength="2"  name="LotIndex#" placeholder="LotIndex#">
                                </div>
                            </div>
                        </div>
                        <div class="box"> 
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Salutation</label>
                                        <input type="text" class="form-control" id="Own_Salutation" name="Own_Salutation" placeholder="Salutation" maxlength="3">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">First Name</label>
                                        <input type="text" class="form-control" id="Own_Fname" name="Own_Fname" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Middle Name</label>
                                        <input type="text" class="form-control" id="Own_Mname" name="Own_Mname" placeholder="Middle Name">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Last Name</label>
                                        <input type="text" class="form-control" id="Own_Lname" name="Own_Lname" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pname!</label>
                                        <input type="text" class="form-control" id="Own_Pname" name="Own_Pname" placeholder="Pname?">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box">
                            <p>Address</p>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address</label>
                                        <input type="text" class="form-control" id="Own_Address" name="Own_Address" placeholder="Address">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">City</label>
                                        <input type="text" class="form-control" id="Own_City" name="Own_City" placeholder="City">

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">State</label>
                                        <input type="text" class="form-control" id="Own_State" name="Own_State" placeholder="State">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Postal Code</label>
                                        <input type="text" class="form-control" id="Own_Zip" name="Own_Zip" placeholder="Postal Code" maxlength="5">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone</label>
                                        <input type="text" class="form-control" id="Own_Phone" name="Own_Phone" placeholder="Phone" maxlength="10">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Notes</label>
                            <textarea class="form-control" id="Own_Notes" name="Own_Notes" placeholder="Notes" rows="2" spellcheck="false"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary processu">Submit</button>

                </div>
            </div>
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
