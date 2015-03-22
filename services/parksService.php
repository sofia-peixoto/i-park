<?php
require_once('../database.php');
require_once('../entities/park.php');
require_once('../plugins/nusoap/lib/nusoap.php');

function helloWorld(){
	return "Hello World!";
}

function getAllParks(){
	$db = new Database();

	$sql = "SELECT * FROM parks";
	$parks = Array();

	foreach($db->handler->query($sql) as $row)
	{
		$park = Array();
		
		$park["ID"] = $row["ID"];
		$park["Name"] = $row["Name"];
		$park["Company"] = $row["Company"];
		$park["Address"] = $row["Address"];
		$park["ZIPCode"] = $row["ZIPCode"];
		$park["ZIPLocation"] = $row["ZIPLocation"];
		$park["Country"] = $row["Country"];
		$park["Latitude"] = $row["Latitude"];
		$park["Longitude"] = $row["Longitude"];
		$park["Phone"] = $row["Phone"];
		$park["OpeningHour"] = $row["OpeningHour"];
		$park["ClosingHour"] = $row["ClosingHour"];
		$park["PricePerHour"] = $row["PricePerHour"];
		$park["Floors"] = $row["Floors"];
		$park["DisabledPlaces"] = $row["DisabledPlaces"];
		$park["Capacity"] = $row["Capacity"];
		$park["Active"] = $row["Active"];
		$park["CreationDate"] = $row["CreationDate"];
		
		$parks[] = $park;
	}

	return $parks;
}

$namespace = "http://localhost/i-park/trunk/Services/parksService.php";
$server = new soap_server();
$server->configureWSDL("parksService", $namespace);

//Tipo: Park
$server->wsdl->addComplexType('Park','park','struct','all','',
	array( 	'ID' => array('name' => 'ID','type' => 'xsd:string'),
			'Name' => array('name' => 'Name','type' => 'xsd:string'),
			'Company' => array('name' => 'Company','type' => 'xsd:string'),
			'Address' => array('name' => 'Address','type' => 'xsd:string'),
			'ZIPCode' => array('name' => 'ZIPCode','type' => 'xsd:string'),
			'ZIPLocation' => array('name' => 'ZIPLocation','type' => 'xsd:string'),
			'Country' => array('name' => 'Country','type' => 'xsd:string'),
			'Latitude' => array('name' => 'Latitude','type' => 'xsd:string'),
			'Longitude' => array('name' => 'Longitude','type' => 'xsd:string'),
			'Phone' => array('name' => 'Phone','type' => 'xsd:string'),
			'OpeningHour' => array('name' => 'OpeningHour','type' => 'xsd:string'),
			'ClosingHour' => array('name' => 'ClosingHour','type' => 'xsd:string'),
			'PricePerHour' => array('name' => 'PricePerHour','type' => 'xsd:string'),
			'Floors' => array('name' => 'Floors','type' => 'xsd:string'),
			'DisabledPlaces' => array('name' => 'DisabledPlaces','type' => 'xsd:string'),
			'Capacity' => array('name' => 'Capacity','type' => 'xsd:string'),
			'Active' => array('name' => 'Active','type' => 'xsd:string'),
			'CreationDate' => array('name' => 'CreationDate','type' => 'xsd:string')
		));

//Tipo: ParksArray
$server->wsdl->addComplexType('ParksArray','parksArray','array','','SOAP-ENC:Array',
	array(), 
	array(
        array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Parks[]')
    ),
    'tns:Park');

//Operacao: getAllParks
$server->register("getAllParks",
    array(),
    array("return" => "tns:ParksArray"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Get All Parks");

//Operacao: helloWorld
$server->register("helloWorld",	
    array(),
    array("return" => "xsd:string"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Hello World");
	
@$server->service($HTTP_RAW_POST_DATA);
?>