<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once 'connection.php';
include_once 'Species.php';
   
	$db = new dbObj();
	$connection =  $db->getConnstring();
	
	$species = new Species($connection);
	
	$species->id = isset($_GET['id']) ? $_GET['id'] : die();

	$species->get_species();

	if($species->id!=null)
	{
		$species_arr=array(
			"id"=>$species->id,
			"name"=>$species->name,
			"classification"=>$species->classification,
			"designation"=>$species->designation,
			"average_height"=>$species->average_height,
			"skin_color"=>$species->skin_color,
			"hair_color"=>$species->hair_color,
			"eye_color"=>$species->eye_color,
			"average_lifespan"=>$species->average_lifespan,
			"homeworld"=>$species->homeworld,
			"language"=>$species->language,
			"films"=>$species->films,
			"people"=>$species->people,
			"url"=>$species->url
		);
		echo json_encode($species_arr);
	}
	else{
		echo json_encode(array("detail"=>"Not Found"));
	}
?>
