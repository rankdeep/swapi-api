<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once 'connection.php';
include_once 'Planet.php';
   
	$db = new dbObj();
	$connection =  $db->getConnstring();
	
	$planet = new Planet($connection);
	
	$planet->id = isset($_GET['id']) ? $_GET['id'] : die();

	$planet->get_planets();

	if($planet->id!=null)
	{
		$planet_arr=array(
			"id"=>$planet->id,
			"name"=>$planet->name,
			"rotation_period"=>$planet->rotation_period,
			"orbital_period"=>$planet->orbital_period,
			"diameter"=>$planet->diameter,
			"climate"=>$planet->climate,
			"gravity"=>$planet->gravity,
			"terrain"=>$planet->terrain,
			"surface_water"=>$planet->surface_water,
			"population"=>$planet->population,
			"residents"=>$planet->residents,
			"films"=>$planet->films,
			"url"=>$planet->url
		);
		echo json_encode($planet_arr);
	}
	else{
		echo json_encode(array("detail"=>"Not Found"));
	}
?>
