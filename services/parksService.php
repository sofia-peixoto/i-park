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

//http://localhost:82/i-park/trunk/services/parksService.php/insertNewPark?wsdl
function insertNewPark($id, $name, $company, $address, $zipCode, $zipLocation, $country, $latitude, $longitude, $phone, $openingHour, $closingHour, $pricePerHour, $floors, $disabledPlaces, $capacity, $creationDate){
	
	try {
		
		$db = new Database();

		$sql = "INSERT INTO parks ";
		$sql = $sql . "(Name,Company,Address,ZIPCode,ZIPLocation,Country,Latitude,Longitude, ";
		$sql = $sql . "Phone,OpeningHour,ClosingHour,PricePerHour,Floors,DisabledPlaces,Capacity,CreationDate) ";
		$sql = $sql . "VALUES ";
		$sql = $sql . "(:name, :company, :address, :zipcode, :ziplocation, :country, :latitude, :longitude, ";
		$sql = $sql . ":phone, :openingHour, :closingHour, :pricePerHour, :floors, :disabledPlaces, :capacity, NOW());";
		
		$stmt = $db->handler->prepare($sql);
		
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':company', $company);
		$stmt->bindParam(':address', $address);
		$stmt->bindParam(':zipcode', $zipCode);
		$stmt->bindParam(':ziplocation', $zipLocation);
		$stmt->bindParam(':country', $country);
		$stmt->bindParam(':latitude', $latitude);
		$stmt->bindParam(':longitude', $longitude);
		$stmt->bindParam(':phone', $phone);
		$stmt->bindParam(':openingHour', $openingHour);
		$stmt->bindParam(':closingHour', $closingHour);
		$stmt->bindParam(':pricePerHour', $pricePerHour);
		$stmt->bindParam(':floors', $floors);
		$stmt->bindParam(':disabledPlaces', $disabledPlaces);
		$stmt->bindParam(':capacity', $capacity);
		
		$stmt->execute();
		
	} catch (Exception $e) {
		
		return "Exception " . $e;
		
	}
	
	return "OK";
	
}

//http://localhost:82/i-park/trunk/services/parksService.php/getCurrentStocking?wsdl
function getCurrentStocking($id){
	
	$db = new Database();

	$sql = "SELECT * FROM stocking WHERE ParkID = :id ORDER BY Date DESC LIMIT 1";
	$stmt = $db->handler->prepare($sql);
	$stmt->bindParam(':id', $id);
	
	$stmt-> execute();
	
	$result = $stmt->fetch();
	
	return $result;
	
}

//http://localhost:82/i-park/trunk/services/parksService.php/insertStocking?wsdl
function insertStocking($parkid, $value, $date){
	
	try {
		
		$db = new Database();

		$sql = "INSERT INTO stocking ";
		$sql = $sql . "(ParkID,Value,`Date`) ";
		$sql = $sql . "VALUES ";
		$sql = $sql . "(:parkid, :value, NOW());";
		
		$stmt = $db->handler->prepare($sql);
		
		$stmt->bindParam(':parkid', $parkid);
		$stmt->bindParam(':value', $value);
		
		$stmt->execute();
		
	} catch (Exception $e) {
		
		return "Exception " . $e;
		
	}
	
	return "OK";
	
}

//esta função permite obter a query final de uma prepared statement
function parms($string,$data) {
	$indexed=$data==array_values($data);
	foreach($data as $k=>$v) {
		if(is_string($v)) $v="'$v'";
		if($indexed) $string=preg_replace('/\?/',$v,$string,1);
		else $string=str_replace("$k",$v,$string);
	}
	return $string;
}

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

//Tipo: Stocking
$server->wsdl->addComplexType('Stocking','stocking','struct','all','',
	array( 	'ID' => array('name' => 'ParkID','type' => 'xsd:string'),
			'ParkID' => array('name' => 'ParkID','type' => 'xsd:string'),
			'Value' => array('name' => 'Value','type' => 'xsd:string'),
			'Date' => array('name' => 'CreationDate','type' => 'xsd:string')
		));
		
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

//Operacao: insertNewPark
$server->register("insertNewPark",
    array("park" => "tns:Park"),
    array("return" => "xsd:string"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Insert a New Park");

//Operacao: getCurrentStocking
$server->register("getCurrentStocking",
    array("id" => "xsd:string"),
    array("return" => "tns:Stocking"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Get Current Stocking");

//Operacao: insertStocking
$server->register("insertStocking",
    array("stocking" => "tns:Stocking"),
    array("return" => "xsd:string"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Insert a Stocking");
	
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
$POST_DATA = isset($HTTP_RAW_POST_DATA) 
                ? $HTTP_RAW_POST_DATA : '';

@$server->service($POST_DATA);
?>