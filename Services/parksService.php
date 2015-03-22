<?php

require('../Entities/park.php');
require('../database.php');
require('../plugins/nusoap/lib/nusoap.php');

class ParksService {
	
	private $db;
	private $server;
	private $namespace = "http://localhost/i-park/trunk/Services/parksService.php";

	
	function ParksService(){
		$this->db = new Database();
		
		$this->server = new soap_server();
		$this->server->wsdl->schemaTargetNamespace = $this->namespace;
 
		$this->server->configureWSDL("getAllParks");
		$this->server->register('getAllParks');	
	}
	
	function getAllParks(){
			
		$sql = "SELECT * FROM parks";
		$parks = Array();

		echo "<pre>";

		foreach($db->handler->query($sql) as $row)
		{
			$park = new Park();
			
			$park->id = $row["ID"];
			$park->name = $row["Name"];
			$park->company = $row["Company"];
			$park->address = $row["Address"];
			$park->zipCode = $row["ZIPCode"];
			$park->zipLocation = $row["ZIPLocation"];
			$park->country = $row["Country"];
			$park->latitude = $row["Latitude"];
			$park->longitude = $row["Longitude"];
			$park->phone = $row["Phone"];
			$park->openingHour = $row["OpeningHour"];
			$park->closingHour = $row["ClosingHour"];
			$park->pricePerHour = $row["PricePerHour"];
			$park->floors = $row["Floors"];
			$park->disabledPlaces = $row["DisabledPlaces"];
			$park->capacity = $row["Capacity"];
			$park->active = $row["Active"];
			$park->creationDate = $row["CreationDate"];
			
			$parks[] = $park;
		}

		print_r($parks);
		$POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
		$this->server->service($POST_DATA);
	}
	
}
?>