<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once 'connection.php';
include_once 'Film.php';
   
	$db = new dbObj();
	$connection =  $db->getConnstring();
	
	$film = new Film($connection);
	
	$film->episode_id = isset($_GET['episode_id']) ? $_GET['episode_id'] : die();

	$film->get_films();

	if($film->episode_id!=null)
	{
		$film_arr=array(
			"episode_id"=>$film->episode_id,
			"title"=>$film->title,
			"opening_crawl"=>$film->opening_crawl,
			"director"=>$film->director,
			"producer"=>$film->producer,
			"release_date"=>$film->release_date,
			"characters"=>$film->characters,
			"planets"=>$film->planets,
			"starships"=>$film->starships,
			"vehicles"=>$film->vehicles,
			"species"=>$film->species,
			"url"=>$film->url
		);
		echo json_encode($film_arr);
	}
	else{
		echo json_encode(array("detail"=>"Not Found"));
	}
?>
