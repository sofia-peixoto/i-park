<?php
require_once 'plugins/nusoap/lib/nusoap.php';

header('Content-Type: text/html; charset=utf-8');

//http://localhost:82/i-park/trunk/client.php

function getAllParks(){
	$client = new nusoap_client("http://" . $_SERVER['HTTP_HOST'] . "/i-park/trunk/Services/parksService.php?wsdl", true);
	$error  = $client->getError();
	 
	if ($error) {
		echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	}
	 
	$result = $client->call("getAllParks");
	 
	if ($client->fault) {
		
		echo "<h2>Fault</h2><pre>";
		print_r($result);
		echo "</pre>";
		echo "#1";
		
	} else {
		
		$error = $client->getError();
		
		if ($error) {
			echo "<h2>Error</h2><pre>" . $error . "</pre>";
		} else {
			echo '<h2>Result</h2><pre>';
			print_r($result);
			echo '</pre>';
		}
		
	}
	
}

function getParkByID(){
	
	$client = new nusoap_client("http://" . $_SERVER['HTTP_HOST'] . "/i-park/trunk/Services/parksService.php?wsdl", true);
	$error  = $client->getError();
	 
	if ($error) {
		echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	}
	 
	$result = $client->call("getParkByID", array('id' => '2'));
	
	if ($client->fault) {
		
		echo "<h2>Fault</h2><pre>";
		print_r($result);
		echo "</pre>";
		
	} else {
		
		$error = $client->getError();
		
		if ($error) {
			echo "<h2>Error</h2><pre>" . $error . "</pre>";
		} else {
			echo '<h2>Result</h2><pre>';
			print_r($result);
			echo '</pre>';
		}
		
	}
	
}

function insertNewPark(){
	
	$park = Array('ID' => '', "Name" => "Parque 4", "Company" => "Empresa BlaBla", "Address" => "Rua sem saida", "ZIPCode" => "1234-123", "ZIPLocation" => "Cidade", "Country" => "Portugal", "Latitude" => "", "Longitude" => "", "Phone" => "123123123", "OpeningHour" => "10:00", "ClosingHour" => "21:00", "PricePerHour" => '1', "Floors" => '1', "DisabledPlaces" => '8', "Capacity" => '130', 'Active' => '1', 'CreationDate' => '');
	
	$client = new nusoap_client("http://" . $_SERVER['HTTP_HOST'] . "/i-park/trunk/Services/parksService.php?wsdl", false);
	$error  = $client->getError();
	 
	if ($error) {
		echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	}
	
	$result = $client->call("insertNewPark", $park);
	
	if ($client->fault) {
		
		echo "<h2>Fault</h2><pre>";
		print_r($result);
		echo "</pre>";
		
	} else {
		
		$error = $client->getError();
		
		if ($error) {
			echo "<h2>Error</h2><pre>" . $error . "</pre>";
		} else {
			print_r($result);
		}
		
	}
	
}

function getCurrentStocking(){
	
	$client = new nusoap_client("http://" . $_SERVER['HTTP_HOST'] . "/i-park/trunk/Services/parksService.php?wsdl", true);
	$error  = $client->getError();
	 
	if ($error) {
		echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	}
	 
	$result = $client->call("getCurrentStocking", array('id' => '3'));
	
	if ($client->fault) {
		
		echo "<h2>Fault</h2><pre>";
		print_r($result);
		echo "</pre>";
		
	} else {
		
		$error = $client->getError();
		
		if ($error) {
			echo "<h2>Error</h2><pre>" . $error . "</pre>";
		} else {
			echo '<h2>Result</h2><pre>';
			print_r($result);
			echo '</pre>';
		}
		
	}
	
}

function insertStocking(){
	
	$park = Array('ParkID' => '3', 'Value' => '4', 'Date' => '');
	
	$client = new nusoap_client("http://" . $_SERVER['HTTP_HOST'] . "/i-park/trunk/Services/parksService.php?wsdl", false);
	$error  = $client->getError();
	 
	if ($error) {
		echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	}
	
	$result = $client->call("insertStocking", $park);
	
	if ($client->fault) {
		
		echo "<h2>Fault</h2><pre>";
		print_r($result);
		echo "</pre>";
		
	} else {
		
		$error = $client->getError();
		
		if ($error) {
			echo "<h2>Error</h2><pre>" . $error . "</pre>";
		} else {
			print_r($result);
		}
		
	}
	
}

//getAllparks();
//getParkByID();
//insertNewPark();
getCurrentStocking();
//insertStocking();

//echo "<h2>Request</h2><pre>" . htmlspecialchars($client->request, ENT_QUOTES) . "</pre>";
//echo "<h2>Response</h2><pre>" . htmlspecialchars($client->response, ENT_QUOTES) . "</pre>";
//echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
?>