<?php
/*
ini_set('display_errors', 1); 

//database login info
$host = 'localhost';
$port = '5432';
$dbname = 'pmc';
$user = 'postgres';
$password = 'sonata';

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
if (!$conn) {
	echo "Not connected : " . pg_error();
	exit;
}

//get the table and fields data
$table = $_GET['table'];
$fields = $_GET['fields'];

//turn fields array into formatted string
$fieldstr = "";
foreach ($fields as $i => $field){
	$fieldstr = $fieldstr . "l.$field, ";
}

//get the geometry as geojson in WGS84
$fieldstr = $fieldstr . "ST_AsGeoJSON(ST_Transform(l.geom,4326))";

//create basic sql statement
$sql = "SELECT $fieldstr FROM $table l";



//if a query, add those to the sql statement
if (isset($_GET['featname'])){
	$featname = $_GET['featname'];
	$distance = $_GET['distance'] * 1000; //change km to meters

	//join for spatial query - table geom is in EPSG:26916
	$sql = $sql . " LEFT JOIN $table r ON ST_DWithin(l.geom, r.geom, $distance) WHERE r.featname = '$featname';";
}

// echo $sql;

//send the query
if (!$response = pg_query($conn, $sql)) {
	echo "A query error occured.\n";
	exit;
}

//echo the data back to the DOM
while ($row = pg_fetch_row($response)) {
	foreach ($row as $i => $attr){
		echo $attr.", ";
	}
	echo ";";
}
*/
?>
<?php
/* $host  = "host=localhost";
$port  = "port=5432";
$dbname= "dbname=pmc";
$credentials = "user=postgres password=sonata";

$db = pg_connect( "$host $port $dbname $credentials"  );
if(!$db){
	die( "Error : Unable to open database\n" );
}

function wtf( $obj ) {
	echo '<pre>';
	print_r( $obj );
	echo '</pre>';
} */
?>
<?php 

	$dsn = "pgsql:host=tasgotbass.net;dbname=tasgotba_pmc;port=5432";
	$opt =[
		PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES    => false
	];
	$pdo = new PDO($dsn, 'tasgotba_pmcadmin', 'pmc2020??',$opt);
	$result = $pdo->query('SELECT *, ST_AsGeoJSON(geom, 9) AS geojson FROM public."sections"');
	
	//echo var_dump($result);
	//echo $result->rowCount();
	$features =[];
	
	foreach($result As $row){
		unset($row['geom']);
		$geometry = $row['geojson']=json_decode($row['geojson']);
		unset($row['geojson']);
		$feature =["type"=>"Feature", "geometry"=>$geometry,"properties"=>$row];
		array_push($features,$feature);
	
	}
	$featureCollection=["type"=>"FeatureCollection", "features"=>$features];
	echo json_encode($featureCollection);

	
	?>