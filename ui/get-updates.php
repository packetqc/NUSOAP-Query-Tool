<?php

$file="../db/data/updates.db";
$csv= file_get_contents($file);
$array = array_map("str_getcsv", explode("\n", $csv));

print_r( "{ \"data\": [ " );

$headers = array();
//$data = array();

foreach ($array[0] as $key => $value) {
    foreach ( explode( "|", $value) as $value2) {
        $headers[$value2] = 1;
        //$data[$value2] = array();
    }
}

for ($index = 1; $index < count($array)-1; $index++) {                    
    if($index>1) {
            print_r( ",");
    }
    print_r( "{" );

    print_r("\"DT_RowId\": \"row_$index\",");    
    
    $i=0;    
    $value = explode( "|", $array[$index][$i]);      
    
    $j=0;    
    foreach ($headers as $key2 => $value2){
        if($j>0) {
            print_r( ",");
        }
        
        
        print_r("\"".$key2."\": \"".$value[$i]."\"");        
        $j++;
        $i++;
    }    
    print_r( "}" );
}

print_r( "], \"options\": [] }");

?>