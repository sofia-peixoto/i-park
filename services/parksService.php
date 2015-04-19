<?php
//http://www.codeproject.com/Articles/140189/PHP-NuSOAP-Tutorial

require_once('../database.php');
require_once('../entities/park.php');
require_once('../plugins/nusoap/lib/nusoap.php');

function helloWorld(){
	return "Hello World!";
}

//http://localhost:82/i-park/trunk/services/parksService.php/getAllParks?wsdl
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

//http://localhost:82/i-park/trunk/services/parksService.php/getParkByID?wsdl
function getParkByID($id){
	
	$db = new Database();

	$sql = "SELECT * FROM parks WHERE ID = :id";
	$stmt = $db->handler->prepare($sql);
	$stmt->bindParam(':id', $id);
	
	$stmt-> execute();
	
	$result = $stmt->fetch();
	
	return $result;
}

/*function insertNewPark($park){
	
	$db = new Database();

	$sql = "INSERT INTO parks ";
	$sql +=	"('Name','Company','Address','ZIPCode','ZIPLocation','Country','Latitude','Longitude', ";
	$sql +=	"'Phone','OpeningHour','ClosingHour','PricePerHour','Floors','DisabledPlaces','Capacity','CreationDate') ";
	$sql +=	"VALUES ";
	$sql +=	"(:name, :company, :address, :zipcode, :ziplocation, :country, :latitude, :longitude, ";
	$sql +=	":phone, :openingHour, :closingHour, :pricePerHour, :floors, :disabledPlaces, :capacity, NOW());";
	
	$stmt = $db->handler->prepare($sql);
	$stmt->bindParam(':name', $id);
	$stmt->bindParam(':company', $id);
	$stmt->bindParam(':address', $id);
	$stmt->bindParam(':zipcode', $id);
	$stmt->bindParam(':ziplocation', $id);
	$stmt->bindParam(':country', $id);
	$stmt->bindParam(':latitude', $id);
	$stmt->bindParam(':longitude', $id);
	$stmt->bindParam(':id', $id);
	$stmt->bindParam(':id', $id);
	$stmt->bindParam(':id', $id);
	$stmt->bindParam(':id', $id);
	$stmt->bindParam(':id', $id);
	$stmt->bindParam(':id', $id);
	$stmt->bindParam(':id', $id);
	$stmt->bindParam(':id', $id);
	
	$stmt-> execute();
	
	

}*/

$namespace = "http://" . $_SERVER['HTTP_HOST'] . "/i-park/trunk/Services/parksService.php";
$server = new soap_server();
$server->configureWSDL("ParksService");
$server->wsdl->schemaTargetNamespace = $namespace;


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
        array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Park[]')
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

//Operacao: getParkByID
$server->register("getParkByID",
    array("id" => "xsd:string"),
    array("return" => "tns:Park"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Get Park By ID");

	
//Operacao: helloWorld
$server->register("helloWorld",	
    array(),
    array("return" => "xsd:string"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Hello World");
	
// Get our posted data if the service is being consumed
// otherwise leave this data blank.                
$POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) 
                ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';

$server->service($POST_DATA);
?>