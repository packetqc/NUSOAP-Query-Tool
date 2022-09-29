<?php
/*
 *	$Id: wsdlclient3.php,v 1.4 2007/11/06 14:48:49 snichol Exp $
 *
 *	WSDL client sample.
 *
 *	Service: WSDL
 *	Payload: rpc/encoded
 *	Transport: http
 *	Authentication: none
 */

require_once('../lib/nusoap.php');

/*
$results = array(
    'status'    => 'init...',
    'error'     => '',
    'result'     => '',
    'request'     => '',
    'response'     => '',
    'debug'     => ''
);
*/
$method = isset($_GET['method']) ? $_GET['method'] : 'function';
//$response = isset($_GET['response']) ? $_GET['response'] : 'status';

$proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
$proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
$proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
$proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';

$client = new nusoap_client('https://ddi.epaquet.net/api?WSDL', 'wsdl', $proxyhost, $proxyport, $proxyusername, $proxypassword);

$err = $client->getError();

$results = [];
$results['error'] = json_decode('{"data" : [], "options" : [] }');

if ($err) {
	//$results['error'] = "Constructor error: " . $err;
    $results['error'] = json_decode('{"data" : [ {"error" : "'+$err+'"} ], "options" : [] }');
}
 else {
    $results['status'] = json_decode('{"data" : [ {"status" : "ok"} ], "options" : [] }');
}

//$person = array('firstname' => 'Willi', 'age' => 22, 'gender' => 'male');



if ($method === 'function') {
        //$results[0] = "ok";
    $results['status'] = json_decode('{"data" : [ {"status" : "ok"} ], "options" : [] }');
} 
else {
        $result = $client->call($method, []);              
        
        // Check for a fault
        if ($client->fault) {
            //$results['error'] = $result;
            $results['error'] = json_decode('{"data" : [ {"error" : "'+$err+'"} ], "options" : [] }');
        } else {
                // Check for errors
                $err = $client->getError();
                if ($err) {
                        // Display the error
                        //$results['error'] = $err;
                    $results['error'] = json_decode('{"data" : [ {"error" : "'+$err+'"} ], "options" : [] }');
                } else {
                        // Display the result
                    $results['status'] = json_decode('{"data" : [ {"status" : "ok"} ], "options" : [] }');
                    //$results['status'] = json_encode('"status" : "ok"');
                    
                    //$results['result'] = json_encode($result);
                    $results['result'] = $result;
                }
        }
        
        //$results['request'] = '{"data" : [ {"request" : "'+(string)htmlspecialchars($client->request, ENT_QUOTES)+'"} ], "options" : [] }';
        //$results['response'] = '{"data" : [ {"response" : "'+json_encode(htmlspecialchars($client->response, ENT_QUOTES))+'"} ], "options" : [] }';
        //$results['debug'] = '{"data" : [ {"debug" : "'+json_encode(htmlspecialchars($client->debug, ENT_QUOTES))+'"} ], "options" : [] }';
        
        //$results['request'] = '{"data" : [ {"request" : "'+htmlspecialchars($client->request, ENT_QUOTES)+'"} ], "options" : [] }';
        //$results['response'] = '{"data" : [ {"response" : "'+htmlspecialchars($client->response, ENT_QUOTES)+'"} ], "options" : [] }';
        //$results['debug'] = '{"data" : [ {"debug" : "'+htmlspecialchars($client->debug, ENT_QUOTES)+'"} ], "options" : [] }';
        $results['request'] = json_encode(htmlspecialchars($client->request, ENT_QUOTES) );
        $results['response'] = json_encode(htmlspecialchars($client->response, ENT_QUOTES) );
        $results['debug'] = json_encode(htmlspecialchars($client->debug_str, ENT_QUOTES) );
}

//outputResults($results);
outputResults_dev($results);

function outputResults_dev($results) {
    header('Content-type: application/json');
    
    $jsonstring = json_encode($results);
        
    echo $jsonstring;
}

function outputResults($results) {
        
    print_r( "{ \n" );
    print_r( "\n\"data\" : [ \n" );

    //echo $results['result']."\n";
    /*foreach ($results['result'] as $rdata => $data){
        $i=1;
        foreach ($data as $key => $value) {
            digArray(0,$i,$key,$value);
            $i++;
        }
    }    
    */
    echo json_encode($results['result']);
    print_r( "], \n" );
    
    print_r( "\n\"status\" : [ \n" );
    ($results['status'] === '') ? print_r("") : print_r("{ \"DT_RowId\": \"row_1\", \"output\" : \"".$results['status']."\" }\n");
    print_r( "], \n" );
    
    print_r( "\n\"error\" : [ \n" );
    ($results['error'] === '') ? print_r("") : print_r("{ \"DT_RowId\": \"row_1\", \"output\" : \"".$results['error']."\" }\n");
    print_r( "], \n" );
    
    print_r( "\n\"request\" : [ \n" );
    ($results['request'] === '') ? print_r("") : print_r("{ \"DT_RowId\": \"row_1\", \"output\" : \"".$results['request']."\" }\n");
    print_r( "], \n" );
            
    print_r( "\n\"response\" : [ \n" );
    ($results['response'] === '') ? print_r("") : print_r("{ \"DT_RowId\": \"row_1\", \"output\" : \"".$results['response']."\" }\n");
    print_r( "], \n" );
        
    print_r( "\n\"debug\" : [ \n" );
    ($results['debug'] === '') ? print_r("") : print_r("{ \"DT_RowId\": \"row_1\", \"output\" : \"".$results['debug']."\" }\n");
    print_r( "], \n" );
    
    print_r( "\n\"options\" : [] \n}\n");
}

#0: STATUS
#1: ERROR
#2: RESULT
#3: REQUEST
#4: RESPONSE
#5: DEBUG
function outputArray($rowid,$data) {
    $j=0;
    //print_r("{ \"DT_RowId\": \"row_$rowid\", "); 
    print_r("{ "); 
    foreach ($data as $key2 => $value2) {
        if($j>0) {
            //print_r( ",\n");
            print_r( ",");
        }
        print_r("\"".$key2."\": \"".$value2."\"");        

        $j++;
    }
    print_r( " }" );    
}

function digArray($level,$rowid,$key,$data) {

    if($rowid>1) {
            print_r( ",\n");
    }

    if( is_array($data) && ($level < 1 ) ) {
        if( $level === 0 ) {
            print_r( "\n\"$key\" : [ \n" );
        }
        $i=1;
        foreach ($data as $key2 => $value2) {
            digArray($level+1,$i,$key2,$value2);
            $i++;
        }
         if( $level === 0 ) {
            print_r( "\n]\n" );
         }
    }
    else {
        outputArray($rowid,$data);
    }
}
?>