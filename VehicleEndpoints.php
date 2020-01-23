<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once 'connection.php';
include_once 'Vehicle.php';
   
	$db = new dbObj();
	$connection =  $db->getConnstring();
	
	$vehicles = new Vehicle($connection);
	
	$vehicles->id = isset($_GET['id']) ? $_GET['id'] : die();

	$vehicles->get_vehicles();

	if($vehicles->id!=null)
	{
		$vehicles_arr=array(
			"id"=>$vehicles->id,
			"name"=>$vehicles->name,
			"model"=>$vehicles->model,
			"manufacturer"=>$vehicles->manufacturer,
			"cost_in_credits"=>$vehicles->cost_in_credits,
			"crew"=>$vehicles->crew,
			"passengers"=>$vehicles->passengers,
			"cargo_capacity"=>$vehicles->cargo_capacity,
			"consumables"=>$vehicles->consumables,
			"vehicle_class"=>$vehicles->vehicle_class,
			"films"=>$vehicles->films,
			"pilots"=>$vehicles->pilots,
			"url"=>$vehicles->url
		);
		echo json_encode($vehicles_arr);
	}
	else{
		echo json_encode(array("detail"=>"Not Found"));
	}
?>
