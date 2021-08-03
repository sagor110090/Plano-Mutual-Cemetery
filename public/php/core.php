
<?php

	$dsn = "pgsql:host=tasgotbass.net;dbname=tasgotba_pmc;port=5432";
	$opt =[
		PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES    => false
	];
	$pdo = new PDO($dsn, 'tasgotba_pmcadmin', 'pmc2020??',$opt);
	$result = $pdo->query('	SELECT *, ST_AsGeoJSON(geom, 9) AS geojson FROM public."pmc"  p LEFT	JOIN public."Graves" g ON g."GraveID" = p."all_spacei"');

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
