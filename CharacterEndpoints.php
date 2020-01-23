<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once 'connection.php';
include_once 'Character.php';
   
	$db = new dbObj();
	$connection =  $db->getConnstring();
	
	$character = new Character($connection);
	
	$character->id = isset($_GET['id']) ? $_GET['id'] : die();

	$character->get_characters();

	if($character->id!=null)
	{
		$character_arr=array(
			"id"=>$character->id,
			"name"=>$character->name,
			"height"=>$character->height,
			"mass"=>$character->mass,
			"hair_color"=>$character->hair_color,
			"skin_color"=>$character->skin_color,
			"eye_color"=>$character->eye_color,
			"birth_year"=>$character->birth_year,
			"gender"=>$character->gender,
			"homeworld"=>$character->homeworld,
			"species"=>$character->species,
			"films"=>$character->films,
			"starships"=>$character->starships,
			"vehicles"=>$character->vehicles,
			"url"=>$character->url
		);
		echo json_encode($character_arr);
	}
	else{
		echo json_encode(array("detail"=>"Not Found"));
	}
?>

