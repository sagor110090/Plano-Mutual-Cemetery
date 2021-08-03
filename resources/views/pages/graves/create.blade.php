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



<div class="content">
    <div class="card">
        <div class="card-body">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
             <form action="{{ url('grave-store') }}" method="post" class="m-4">
                @csrf
                <div class="offset-md-3">
                <div class="form-group row">
                    <label class="col-md-2" for="GraveID">GraveID</label>
                    <input type="text"  maxlength="2" class="form-control col-md-4" name="GraveID" id="GraveID">
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="Section">Section</label>
                    <input type="text"  maxlength="2" class="form-control col-md-4" name="Section" id="Section">
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="Lot#">Lot#</label>
                    <input type="text"  maxlength="2" class="form-control col-md-4" name="Lot#" id="Lot#">
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="Grave#">Grave#</label>
                    <input type="text"  maxlength="2" class="form-control col-md-4" name="Grave#" id="Grave#">
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="LotIndex#">LotIndex#</label>
                    <input type="number" class="form-control col-md-4" name="LotIndex#" id="LotIndex#">
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="LotText">LotText</label>
                    <input type="text"  maxlength="2" class="form-control col-md-4" name="LotText" id="LotText">
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="Interred">Interred</label>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" value="1" class="form-check-input" name="Interred" id="Interred" checked>
                        yes
                      </label>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="Deceased_Salutation">Deceased_Salutation</label>
                    <input type="text"  maxlength="2" class="form-control col-md-4" name="Deceased_Salutation" id="Deceased_Salutation">
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="Deceased_Fname">Deceased_Fname</label>
                    <input type="text"  maxlength="10" class="form-control col-md-4" name="Deceased_Fname" id="Deceased_Fname">
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="Deceased_Lname">Deceased_Lname</label>
                    <input type="text"  maxlength="10" class="form-control col-md-4" name="Deceased_Lname" id="Deceased_Lname">
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="Deceased_Pname">Deceased_Pname</label>
                    <input type="text"  maxlength="10" class="form-control col-md-4" name="Deceased_Pname" id="Deceased_Pname">
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="Deceased_BirthDate">Deceased_BirthDate</label>
                    <input type="date" class="form-control col-md-4" name="Deceased_BirthDate" id="Deceased_BirthDate">
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="Deceased_DeathDate">Deceased_DeathDate</label>
                    <input type="date" class="form-control col-md-4" name="Deceased_DeathDate" id="Deceased_DeathDate">
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="Deceased_BurialDate">Deceased_BurialDate</label>
                    <input type="date" class="form-control col-md-4" name="Deceased_BurialDate" id="Deceased_BurialDate">
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="Grave_Notes">Grave_Notes</label>
                    <textarea name="Grave_Notes" class="form-control col-md-4" id="Grave_Notes" cols="30" rows="4"></textarea>
                </div>
                {{-- <div class="form-group row">
                    <label class="col-md-2" for="Vet">Vet</label>
                    <input type="text"  maxlength="3" class="form-control col-md-4" name="Vet" id="Vet">
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="Available">Available</label>
                    <input type="text"  maxlength="3" class="form-control col-md-4" name="Available" id="Available">
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="spacetype">spacetype</label>
                    <input type="text"  maxlength="3" class="form-control col-md-4" name="spacetype" id="spacetype">
                </div> --}}

                <button type="submit" class="btn btn-success offset-md-6">Save</button>
            </div>
             </form>


        </div>
    </div>
</div>
</div>
@endsection

@push('css')
<style>
    label.col-md-2 {
    background: beige;
    padding: 0.5%;
    border-left: 17px solid #28a745;
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
