<?php

require_once('../lib/nusoap.php');

$connection = isset($_GET['connect']) ? $_GET['connect'] : 'https://NOCONNECTION.STRING.CONFIGURED';

$proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
$proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
$proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
$proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';

function wsdl_interoper($url) {
  /*  $client = new nusoap_client($url, 'wsdl', $proxyhost, $proxyport, $proxyusername, $proxypassword);
    
    $err = $client->getError();
    if ($err) {
            echo '<h2>Registration failed</h2><pre>' . $err . '</pre>';
    }
    else {
        echo '<h2>Registration successful</h2>';
    }
    
    //$proxy = $client->getProxyClassCode();
    print_r ($client->__getFunctions());
  */  
    //$url 	  = "https://ddi.epaquet.net/api?WSDL";
    //$url 	  = $connection;
    
    $client   = new SoapClient($url, array("trace" => 1, "exception" => 0)); 

    print_actions( $client->__getFunctions() );

}


function print_actions ( $theactionarray )   {
        print_r( "{ \"data\": [ " );
        
        $i = 0;
	foreach ( $theactionarray as $action ) {
		if( $i > 0) {
                    print_r( ",");
                }
                $i++;
                $e=explode(" ",$action);
		$f=explode("(",$e[1]);
		//print_r( "{ \"DT_RowId\": \"row_$i\", \"method\": \"".$f[0]."\", \"interoper\": \"$i\" }" );
                print_r( "{ \"DT_RowId\": \"row_$i\", \"method\": \"".$f[0]."\" }" );
	}
        print_r( "], \"options\": [] }");
}

//wsdl_interoper('https://ddi.epaquet.net/api?WSDL');
wsdl_interoper($connection);

?>
