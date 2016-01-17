<?php

require_once('helpers.inc.php');

spl_autoload_register(function($className){
    require_once "classes/$className" . '.php';
});

$conn = dbConnect();
$sql = 'INSERT INTO requests (id, startdate, enddate, request_time, result, body, header) VALUES (NULL,?,?,?,?,?,?)';
try {
    $client = new SoapClient('http://82.138.16.126:8888/TaxiPublic/Service.svc?wsdl',array("trace"=>1));
    $start = date('Y-m-d H:i:s');
    $startmicro = microtime(true);
    $result = $client->GetTaxiInfos(array('request' => array('RegNum' => 'ЕМ33377')));
    $endmicro = microtime(true);
    $end = date('Y-m-d H:i:s');
    $time = $endmicro - $startmicro;
    $response = $client->__getLastResponse();
    $response_head = $client->__getLastResponseHeaders();
    $arr = parseXmlResponse($response);
    $compare_result = Taxi::compareWithPattern($arr[0]);
    $stmt = $conn->prepare($sql);
    if($compare_result){
        $stmt->execute(array($start,$end,$time,1,NULL,NULL));
    }else{
        $stmt->execute(array($start,$end,$time,0,$response, $response_head));
    }
    if($stmt->rowCount()){
        echo 'SQL INSERT SUCCESS';
        echo '<br/>';
    }
} catch (SoapFault $fault) {
    trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
}




