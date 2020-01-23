<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once 'connection.php';
include_once 'Starship.php';
   
	$db = new dbObj();
	$connection =  $db->getConnstring();
	
	$starships = new Starship($connection);
	
	$starships->id = isset($_GET['id']) ? $_GET['id'] : die();

	$starships->get_starships();

	if($starships->id!=null)
	{
		$starships_arr=array(
			"id"=>$starships->id,
			"name"=>$starships->name,
			"model"=>$starships->model,
			"manufacturer"=>$starships->manufacturer,
			"cost_in_credits"=>$starships->cost_in_credits,
			"crew"=>$starships->crew,
			"passengers"=>$starships->passengers,
			"cargo_capacity"=>$starships->cargo_capacity,
			"consumables"=>$starships->consumables,
			"hyperdrive_rating"=>$starships->hyperdrive_rating,
			"MGLT"=>$starships->MGLT,
			"starship_class"=>$starships->starship_class,
			"films"=>$starships->films,
			"pilots"=>$starships->pilots,
			"url"=>$starships->url
		);
		echo json_encode($starships_arr);
	}
	else{
		echo json_encode(array("detail"=>"Not Found"));
	}
?>
