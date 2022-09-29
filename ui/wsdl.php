<?php

require_once('../lib/nusoap.php');

//$person = array('firstname' => 'Willi', 'age' => 22, 'gender' => 'male');

$connection = isset($_GET['connect']) ? $_GET['connect'] : 'NOOP';
$mode = isset($_GET['mode']) ? $_GET['mode'] : 'NOOP';
$method = isset($_GET['method']) ? $_GET['method'] : 'NOOP';
//$arguments = isset($_POST['arguments']) ? $_POST['arguments'] : [];
//$response = isset($_GET['response']) ? $_GET['response'] : 'status';

$proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
$proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
$proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
$proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';

$results = [];
$results['error'] = json_decode('{"data" : [], "options" : [] }');
$results['status'] = json_decode('{"data" : [ {"status" : "initialisation ..."} ], "options" : [] }');

//$argdata = print_r($_POST, TRUE);
//$results['arguments'] = $argdata;

if( $connection === 'NOOP') {
    $results['error'] = json_decode('{"data" : [{"error": "Connection string not defined"}], "options" : [] }');
}

if ($mode === 'NOOP') {
    $results['error'] = json_decode('{"data" : [{"error": "Query mode not defined"}], "options" : [] }');
}

if ($method === 'NOOP') {
    $results['error'] = json_decode('{"data" : [{"error": "Method to query not defined"}], "options" : [] }');
}

$results['status'] = json_decode('{"data" : [ {"status" : "connecting ..."} ], "options" : [] }');

$client = new nusoap_client($connection, 'wsdl', $proxyhost, $proxyport, $proxyusername, $proxypassword);
$err = $client->getError();

if ($err) {
	//$results['error'] = "Constructor error: " . $err;
    $results['error'] = json_decode('{"data" : [ {"error" : "'+$err+'"} ], "options" : [] }');
}

$results['status'] = json_decode('{"data" : [ {"status" : "wdsl connection completed, calling method: '+$method+' in mode: '+$mode+'  ..."} ], "options" : [] }');
$result = $client->call($method, []);              
$results['status'] = json_decode('{"data" : [ {"status" : "wdsl call completed, calling method: '+$method+' in mode: '+$mode+'  ..."} ], "options" : [] }');

// Check for a fault
if ($client->fault) {
    //$results['error'] = $result;
    $results['error'] = json_decode('{"data" : [ {"error" : "'+$result+'"} ], "options" : [] }');
} else {
    // Check for errors
    $err = $client->getError();
    if ($err) {
        $results['error'] = json_decode('{"data" : [ {"error" : "'+$err+'"} ], "options" : [] }');
    } else {
            // Display the result
        $results['status'] = json_decode('{"data" : [ {"status" : "ok"} ], "options" : [] }');
        //$results['status'] = json_encode('"status" : "ok"');

        //$results['result'] = json_decode($result);
        $results['result'] = $result;
    }
}

/*        
//$results['request'] = '{"data" : [ {"request" : "'+(string)htmlspecialchars($client->request, ENT_QUOTES)+'"} ], "options" : [] }';
//$results['response'] = '{"data" : [ {"response" : "'+json_encode(htmlspecialchars($client->response, ENT_QUOTES))+'"} ], "options" : [] }';
//$results['debug'] = '{"data" : [ {"debug" : "'+json_encode(htmlspecialchars($client->debug, ENT_QUOTES))+'"} ], "options" : [] }';
 
$results['request'] = '{"data" : [ {"request" : "'+htmlspecialchars($client->request, ENT_QUOTES)+'"} ], "options" : [] }';
$results['response'] = '{"data" : [ {"response" : "'+htmlspecialchars($client->response, ENT_QUOTES)+'"} ], "options" : [] }';
$results['debug'] = '{"data" : [ {"debug" : "'+htmlspecialchars($client->debug, ENT_QUOTES)+'"} ], "options" : [] }';
       
//$results['request'] = htmlspecialchars($client->request, ENT_QUOTES) ;
//$results['response'] = htmlspecialchars($client->response, ENT_QUOTES );
//$results['debug'] = htmlspecialchars($client->debug_str, ENT_QUOTES) ;
*/
$results['request'] = $client->request;
$results['response'] = $client->response;
$results['debug'] = $client->debug_str;


outputResults($results);

function outputResults($results) {
    header('Content-type: application/json');
    
    $jsonstring = json_encode($results);        
    echo $jsonstring;
    
    //echo $results;
}


?>