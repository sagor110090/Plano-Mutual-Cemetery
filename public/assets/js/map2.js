//global variables
var arLayers;
var map;
var cemetery;
var url = 'php/core.php'; 
var fp;
var osm;
var ctlLayers;
var cem;



    //var url = 'usa.json';  // my GeoJSON data source, in this case a static file not a live PHP data feed.
var arr = [];
var arr1 = [];

  // Initialize autocomplete with empty source.
  $( "#txtFindGraveID" ).autocomplete();
     map = L.map('map',{
         zoomControl:false
     }).setView([33.02529, -96.68338], 18);
     L.control.zoom({
        position: 'topright'
      }).addTo(map);

	 osm=new L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png',{ 
               // attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
               maxZoom: 30,
               id: 'streets-v11',
               tileSize: 512,
               zoomOffset: -1,
            
            
            });
		
	var OpenStreetMap_BlackAndWhite = L.tileLayer('http://{s}.tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png', {
    maxZoom: 30,
    tileSize: 512,
    zoomOffset: -1

	//attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	});
	OpenStreetMap_BlackAndWhite.addTo(map);
	
	
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

	
		function forEachFeature(feature, layer) {
            // Tagging each state poly with their name for the search control.
            layer._leaflet_id = feature.properties.all_spacei;

            var popupContent = "<p><b>Grave: </b>"+ feature.properties.all_spacei /* +
                "</br>REGION: "+ feature.properties.SUB_REGION +
                "</br>STATE ABBR: "+ feature.properties.STATE_ABBR +
                "</br>POP2010: "+ feature.properties.POP2010.toLocaleString() +
                "</br>Pop 2010 per SQMI: "+ feature.properties.POP10_SQMI.toLocaleString() +
                "</br>Males: "+ feature.properties.MALES.toLocaleString() +
                "</br>Females: "+ feature.properties.FEMALES.toLocaleString() +
                "</br>SQ Miles: "+ feature.properties.SQMI.toLocaleString() +'</p>' */;

            layer.bindPopup(popupContent);

            layer.on("click", function (e) { 
                cemetery.setStyle(style); //resets layer colors
                layer.setStyle(highlight);  //highlights selected.
            }); 
		}

	
// Null variable that will hold layer
 cemetery = L.geoJson(null, {onEachFeature: forEachFeature, style: style});

	$.getJSON(url, function(data) {
        cemetery.addData(data);
	
        for (i = 0; i < data.features.length; i++) {  //loads State Name into an Array for searching
            arr1.push({label:data.features[i].properties.all_spacei, value:""});
        }
       addDataToAutocomplete(arr1);  //passes array for sorting and to load search control.
    });

 cemetery.addTo(map);

  ////////// Autocomplete search
	function addDataToAutocomplete(arr) {
                 
        arr.sort(function(a, b){ // sort object by id
            var nameA=a.label, nameB=b.label
            if (nameA < nameB) //sort string ascending
                return -1 
            if (nameA > nameB)
                return 1
            return 0 //default return value (no sorting)
        })

   		// The source for autocomplete.  https://api.jqueryui.com/autocomplete/#method-option
		$( "#txtFindGraveID" ).autocomplete("option", "source", arr); 
	
		$( "#txtFindGraveID" ).on( "autocompleteselect", function( event, ui ) {
			polySelect(ui.item.label);  //grabs selected Grave id
			ui.item.value='';
		});
	}	///////////// Autocomplete search end


// fire off click event and zoom to polygon  
  		function polySelect(a){
			map._layers[a].fire('click');  // 'clicks' on grave  name from search
			var layer = map._layers[a];
			map.fitBounds(layer.getBounds());  // zooms to selected poly
        }
// END...fire off click event and zoom to polygon

	
var baseMaps = {
    "Open Street Map": osm,
   	"OSM B&W":OpenStreetMap_BlackAndWhite
};

var overlayMaps = {
    "Cemetery":cemetery
};	
	
//Add layer control
L.control.layers(baseMaps, overlayMaps).addTo(map);