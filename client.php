<?php
require_once 'plugins/nusoap/lib/nusoap.php';
 
$client = new nusoap_client("http://localhost/i-park/trunk/Services/parksService.php?wsdl", true);
$error  = $client->getError();
 
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
}
 
$result = $client->call("getAllParks");
 
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

// echo "<h2>Request</h2><pre>" . htmlspecialchars($client->request, ENT_QUOTES) . "</pre>";
// echo "<h2>Response</h2><pre>" . htmlspecialchars($client->response, ENT_QUOTES) . "</pre>";
//echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
?>