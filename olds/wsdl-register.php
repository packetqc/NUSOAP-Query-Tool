<?php

require_once('../lib/nusoap.php');

$proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
$proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
$proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
$proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';

function wsdl_register($url) {
    $client = new nusoap_client($url, 'wsdl', $proxyhost, $proxyport, $proxyusername, $proxypassword);
    
    $err = $client->getError();
    if ($err) {
            echo '<h2>Registration failed</h2><pre>' . $err . '</pre>';
    }
    else {
        echo '<h2>Registration successful</h2>';
    }
}

wsdl_register('https://ddi.epaquet.net/api?WSDL');

?>
