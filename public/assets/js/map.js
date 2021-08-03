//global variables
var arLayers;
var map;
var cemetery;
var url = 'php/core.php';  // GeoJSON from live PHP data feed.
var urlSection= 'php/sections.php';  // GeoJSON from live PHP data feed.
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
        //attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 30,
        id: 'streets-v11',
        tileSize: 512,
        zoomOffset: -1,
    
    }).addTo(map);


    // Null variable that will hold layer
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

/* map.on('zoomend', function () {
    if (map.getZoom() >=  18 && map.hasLayer(cemsection)) {
        map.removeLayer(cemsection);
        map.addLayer(cemetery);
    }
    if (map.getZoom() = 18 && map.hasLayer(cemetery) == false)
    {
        map.removeLayer(cemetery);
        map.addLayer(cemsection);
    }   
}); */


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

    //fp = feature.properties;
    // Tagging each state poly with their name for the search control.
   // layer._leaflet_id = feature.properties.all_spacei;

    arCemIDs.push(att.all_spacei.toString());
   // arCemName.push(fp.fullname.toString());
    //console.log(arCemIDs);
   // var popupContent = "<p><b>Space ID </b>" + feature.properties.all_spacei /* +
      //  "</br>REGION: "+ feature.properties.SUB_REGION +
   // */;

    //layer.bindPopup(popupContent);

    lyr.on("click", function (e) {
        cemetery.setStyle(style); //resets layer colors
        lyr.setStyle(highlight);  //highlights selected.



        // person.isStudent = person.age >= 18 ? 'yes' : 'no'


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




/*  Search by Grave ID */
$('#btnGraveID').click(function () {
    var val = $('#txtFindGraveID').val();
    var lyr = returnLayerByAttribute(cemetery,'all_spacei', val);
    if (lyr) {
        if (lyrSearch) {
            lyrSearch.remove();
        }
        lyrSearch = L.geoJSON(lyr.toGeoJSON(), { style: highlight}).addTo(map);
        map.fitBounds(lyr.getBounds().pad(1));
        var att = lyr.feature.properties;
        $('#divProjectData').html("<h4 class='text-center'> Grave Information</h4> <h5>Grave ID : " + " " + att.all_spacei + "<br>" + "</h5<h5>Burial Type : " + (att.all_spacet === null ? "" : att.all_spacet) + 
        "<br>" + "</h5<h5>Deceased Birth Date : " + (att.Deceased_BirthDate === null ? "" : formatDate(att.Deceased_BirthDate)) +"</h5>");

    } else {
        $('#divProjectError').html("*** Grave ID not Found ***")
    }
});

$("#lblProject").click(function(){
    $("#divProjectData").toggle(); 
});



/*  Search by name */
$('#btnName').click(function () {
    var val = $('#txtFindName').val();
    var lyr = returnLayerByAttribute(cemetery,'Full_Name', val);
    if (lyr) {
        if (lyrSearch) {
            lyrSearch.remove();
        }
        lyrSearch = L.geoJSON(lyr.toGeoJSON(), { style: highlight }).addTo(map);
        map.fitBounds(lyr.getBounds().pad(1));
        var att = lyr.feature.properties;
        $('#divNameData').html("<h4 class='text-center'> Grave Information</h4> <h5>Grave ID : " + " " + att.all_spacei + 
        "<br>" + "</h5<h5>Burial Type : " + (att.spacetype === null ? "" : att.spacetype) + 
        "<br>" + "</h5<h5>Deceased Name : " + (att.Full_Name === null ? "" : att.Full_Name)   +
        "<br>" + "</h5<h5>Deceased Birth Date : " + (att.Deceased_BirthDate === null ? "" : dateformat(att.Deceased_BirthDate))  +"</h5>");

       /* Deceased_BirthDate
        Deceased_DeathDate
        Deceased_BurialDate*/

    } else {
        $('#divNameError').html("*** Grave ID not Found ***")
    }
});
$("#lblName").click(function(){
    $("#divNameData").toggle(); 
});

//filter

$("input[name=fltCem]").click(function(){
    arCemIDs =[];
    cemetery.refresh();
});

function filterCemetery(json){
    var att= json.properties;
    var optFilter = $("input[name=fltCem]:checked").val();
    if (optFilter=='ALL'){
        return true;
    } else{
        return (att.all_availa==optFilter || att.all_spacet==optFilter || att.all_vet==optFilter );
    }
}


// Control for turning on/off overlay layers by checkbox

document.querySelector("input[name=cemspace]").addEventListener('change', function() {
	if(this.checked) map.addLayer(cemetery)
      else map.removeLayer(cemetery)
      


    });
    

    document.querySelector("input[name=cemsection]").addEventListener('change', function() {
        if(this.checked) map.addLayer(cemsection)
          else map.removeLayer(cemsection)
          
    
          
        });


  var dateformat=    moment().format('MMM D, YYYY');




//sidebar toggle


