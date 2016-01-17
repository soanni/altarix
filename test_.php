<?php

require_once('Taxi.php');
//header('Content-Type: text/xml');

try {
    $client = new SoapClient('http://82.138.16.126:8888/TaxiPublic/Service.svc?wsdl',array("trace"=>1));
    var_dump($client->__getFunctions());
    echo '<pre>';
    echo '<h2>Types:</h2>';
    $types = $client->__getTypes();
    foreach ($types as $type) {
        $type = preg_replace(
            array('/(\w+) ([a-zA-Z0-9]+)/', '/\n /'),
            array('<font color="green">${1}</font> <font color="blue">${2}</font>', "\n\t"),
            $type
        );
        echo $type;
        echo "\n\n";
    }
    echo '</pre>';
    $result = $client->GetTaxiInfos(array('request' => array('RegNum' => 'ЕМ33377')));
    print_r($result);
    print_r(Taxi::constructFromResponse($result));
    //$result = $client->GetTaxiInfos();
    echo '<h2>Response</h2>';
    echo '<pre>';
    $response = $client->__getLastResponse();
    $correct_xml_from_response = '<?xml version="1.0" encoding="UTF-8"?>' . $response;
    $response_head = $client->__getLastResponseHeaders();
    var_dump($response);
    $res = simplexml_load_string($correct_xml_from_response);
    foreach($res->children('s', true) as $x){
        $children = $x->children(); //body
        foreach($children as $child){ //GetTaxiInfosResponse
            foreach($child->children() as $x){
                //taxi info
                echo $x->TaxiInfo->LicenseNum;
                echo $x->TaxiInfo->LicenseDate;
            }
        }
    }

    var_dump($response_head);
    echo '<pre/>';
    echo '<h2>Request</h2>';
    echo '<pre>';
    $request = $client->__getLastRequest();
    $request_head = $client->__getLastRequestHeaders();
    $xml = simplexml_load_string($request);

    //echo $xml->asXML();
    //$children = $xml->children('http://dtis.mos.ru/taxi');
    echo htmlentities($request);
    var_dump($request);
    var_dump($request_head);
    echo '<pre/>';
    echo '<pre>';
    var_dump($result);
    echo '<pre/>';
} catch (SoapFault $fault) {
    trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
}

function parseXmlResponse($response){
    $correct_xml_from_response = '<?xml version="1.0" encoding="UTF-8"?>' . $response;
    $res = simplexml_load_string($correct_xml_from_response);
    $arr = null;
    if($res){
        foreach($res->children('s', true) as $x){
            $children = $x->children(); //body
            foreach($children as $child){ //GetTaxiInfosResponse
                foreach($child->children() as $x){ //GetTaxiInfosResult
                    $taxi['LicenseNum'] = trim((string)$x->TaxiInfo->LicenseNum);
                    $taxi['LicenseDate'] = trim((string)$x->TaxiInfo->LicenseDate);
                    $taxi['Name'] = trim((string)$x->TaxiInfo->Name);
                    $taxi['OgrnNum'] = trim((string)$x->TaxiInfo->OgrnNum);
                    $taxi['OgrnDate'] = trim((string)$x->TaxiInfo->OgrnDate);
                    $taxi['Brand'] = trim((string)$x->TaxiInfo->Brand);
                    $taxi['Model'] = trim((string)$x->TaxiInfo->Model);
                    $taxi['RegNum'] = trim((string)$x->TaxiInfo->RegNum);
                    $taxi['Year'] = trim((string)$x->TaxiInfo->Year);
                    $taxi['BlankNum'] = trim((string)$x->TaxiInfo->BlankNum);
                    $taxi['Info'] = trim((string)$x->TaxiInfo->Info);
                    $arr[] = $taxi;
                }
            }
        }
    }
    return $arr;
}



