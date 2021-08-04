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
                        <li class="breadcrumb-item active">Map</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container ">
            <div id="map" class="map mt-2">
            </div>
        </div>

        <!--   popup modal  -->
        <!-- Modal -->
        <div class="modal fade " id="graveModal" tabindex="-1" aria-labelledby="graveodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h2 class="modal-title text-white text-center" id="graveModalLabel"> </h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body " style="padding:8px;">
                        <div class="table-fixheader">
                            <div style="overflow-x:hidden;padding: 2px;">
                                <table class="table table-striped ">
                                    <tr>
                                        <thead>
                                            <th style="width: 16.66% ;border:none;"></th>
                                            <th style="width: 25%; border:none;"></th>
                                        </thead>
                                    </tr>
                                    <tbody id="gravebody">
                                        <tr>
                                            <th scope="row">Grave ID</th>
                                            <td id="tblGraveID"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Deceased Name</th>
                                            <td id="tblDName"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Interred</th>
                                            <td id="tblInterred"></td>
                                        </tr>

                                        <tr>
                                            <th scope="row">Deceased Birth Date</th>
                                            <td id="tblDDOB"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Deceased Death Date</th>
                                            <td id="tblDDD"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Deceased Burial Date</th>
                                            <td id="tblDBurialD"></td>
                                        </tr>

                                    </tbody>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="/vendors/leaflet/leaflet.css">
<link rel="stylesheet" href="assets/css/style.css">
@endpush

@push('js')
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="vendors/jquery/jquery.min.js"></script>
<script src="vendors/jquery-ui/jquery-ui.min.js"></script>
<script src="vendors/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="vendors/leaflet/leaflet.js"></script>


<!--   leaflet leaflet-plugins -->
<script src="vendors/leaflet-plugins/ajax/leaflet.ajax.min.js"></script>
<script src="vendors/leaflet-plugins/layercontrol/dist/leaflet.groupedlayercontrol.min.js"></script>
<script src="assets/js/moment.js"></script>
<script>
var arLayers;
var map;
var cemetery;
var url = '/core';  // GeoJSON from live PHP data feed.
var urlSection= '/sections';  // GeoJSON from live PHP data feed.
//var url = 'data/Absec.geojson';// GeoJSON from local.
var fp;
var lyrOsm;
var ctrLayers;
var cem;
var lyrSearch;
var featureID;
var arCemIDs = [];
var cemjs;
var featureVal;
var arCemName =[];
var cemsec;
var cemsection;
var fullname;
var dateformat;


// initialize map
$( document ).ready(function() {

    map = L.map('map', { zoomControl: false }).setView([33.02529, -96.68338], 18);
    L.control.zoom({
        position: 'topright'
    }).addTo(map);
    lyrOsm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 30,
        id: 'streets-v11',
        tileSize: 512,
        zoomOffset: -1,

    }).addTo(map);
    $.ajax({
        url: url,
        success: function (response) {
            cemjs = JSON.parse(response);
            cemetery = L.geoJson.ajax(url, { onEachFeature: forEachFeature, style: style,filter:filterCemetery});
           // ctrLayers.addOverlay(cemetery, "Cemetery");
            arCemIDs.sort(function(a,b){return a-b});
             $('#txtFindGraveID').autocomplete({
                source: arCemIDs
            });
            arCemName.sort(function(a,b){return a-b});
            $('#txtFindName').autocomplete({
                source: arCemName
            });
            console.log(cemetery);
           cemetery.addTo(map);
        },
        error: function (xhr, status, error) {
            alert("ERROR: " + error);
        }
    });
    // load sections
    $.ajax({
        url: urlSection,
        success: function (response) {
            cemSec = JSON.parse(response);
            cemsection = L.geoJson.ajax(urlSection, { style: style });

            cemsection.addTo(map);
        },
        error: function (xhr, status, error) {
            alert("ERROR: " + error);
        }
    });


var baseMaps = {
    "Open Street Map": lyrOsm

};

var overlayMaps = {

};

//Add layer control
ctrLayers = L.control.layers(baseMaps, overlayMaps).addTo(map);




map.on('zoomend' , function (e) {

    if (map.getZoom()>18)
    {
       // marker.setLatLng(geo);
        cemetery.addTo(map);
        cemsection.remove(map);
    }else {
        cemetery.remove();
        cemsection.addTo(map)


    }
});

});





function forEachFeature(json, lyr) {
    var att = json.properties;
    var fullname= (att.Full_Name === null ? "" : att.Full_Name)  ;
   // console.log(fullname);
    lyr.bindTooltip("<h4>Grave ID: "+att.all_spacei+"</h4>Space Type: "+(att.all_spacet === null ? "" : att.all_spacet)+"<br>Deceased Name: "+ fullname);
  // amends the value to an string, even if its undefined or null etc
    var dname = fullname;
    dname = ""+ dname;
    arCemName.push(dname.toString());

    arCemIDs.push(att.all_spacei.toString());

    lyr.on("click", function (e) {
        cemetery.setStyle(style); //resets layer colors
        lyr.setStyle(highlight);  //highlights selected.


        $('#grave-id').html('<span>Grave ID: </span>' + att.all_spacei);
        $('#deceasedName').html('<span>Deceased Name: </span>' + fullname );

        //Fill Grave modal and show
        $('#graveModalLabel').html('Grave ID:  ' + att.all_spacei );

        $('#tblGraveID').html( att.all_spacei);
        $('#tblDName').html( (att.Interred === null ? "" : fullname));
        $('#tblInterred').html( (att.Interred === true ? "Yes" : ""));
        //$('#tblInterred1').html( att.interred);


       // $('#tblDDOB').html((att.Deceased_BirthDate === null ?"" : att.Deceased_BirthDate ) );
       $('#tblDDOB').html((att.Deceased_BirthDate === null ?"" : formatDate(att.Deceased_BirthDate )) );
        $('#tblDDD').html((att.Deceased_DeathDate === null ? "" : formatDate(att.Deceased_DeathDate )));
        $('#tblDBurialD').html((att.Deceased_BurialDate === null ? "" : formatDate(att.Deceased_BurialDate) ));



        $('#graveModal').modal('show');



        $('.btn-group a[href="#results"]').tab('show').addClass('active');


        // $('this').addClass('active');

    });
}

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [month, day, year].join('/');
}

$("#btnreset").click(function () {
    cemetery.setStyle(style); //resets layer colors
    $('#grave-id').html('');
    $('#deceasedName').html('');
});

// Set style function that sets fill color property
function style(feature) {
    return {
        fillColor: 'green',
        fillOpacity: 0.5,
        weight: 2,
        opacity: 1,
        color: '#ffffff',
        dashArray: '3'
    };
}
var highlight = {
    'fillColor': 'yellow',
    'weight': 2,
    'opacity': 1
};



//general function for search
function returnLayerByAttribute(lyr,att,val){
    var arLayers = lyr.getLayers();

    for (i = 0; i < arLayers.length - 1; i++) {
        // console.log(arLayers);
        var featureVal = arLayers[i].feature.properties[att];
        //  console.log(featureID);
        if (featureVal == val) {
            return arLayers[i];
        }

    }
    return false;

}
setInterval(() => {
    var lyr = returnLayerByAttribute(cemetery,'all_spacei', "{!! request()->get('graveId') !!}");

    if (lyr) {
        lyrSearch = L.geoJSON(lyr.toGeoJSON(), { style: highlight}).addTo(map);
        map.fitBounds(lyr.getBounds().pad(1));
        var att = lyr.feature.properties;
        $('#divProjectData').html("<h4 class='text-center'> Grave Information</h4> <h5>Grave ID : " + " " + att.all_spacei + "<br>" + "</h5<h5>Burial Type : " + (att.all_spacet === null ? "" : att.all_spacet) +
        "<br>" + "</h5<h5>Deceased Birth Date : " + (att.Deceased_BirthDate === null ? "" : formatDate(att.Deceased_BirthDate)) +"</h5>");

    } else {
        console.log('not found');
    }
}, 4000);






function filterCemetery(json){
    var att= json.properties;
    var optFilter = $("input[name=fltCem]:checked").val();
    if (optFilter=='ALL'){
        return true;
    } else{
        return (att.all_availa==optFilter || att.all_spacet==optFilter || att.all_vet==optFilter );
    }
}





</script>


<script>
    $(document).ready(function () {
      $('.toggle-sidebar').on('click', function () {
        $('.sidebar').toggleClass('close');
      });

      $('.drkgreen-btn').on('click', function () {
        $('.drkgreen-btn').removeClass('active');
        $('this').addClass('active');
      });
      $('.map-pin').on('click', function () {
        $('.map-pin-comment').toggleClass('active');
      });



    });

</script>
@endpush
