<?php


function parseXmlResponse($response){
    $correct_xml_from_response = '<?xml version="1.0" encoding="UTF-8"?>' . $response;
    $res = simplexml_load_string($correct_xml_from_response);
    $arr = null;
    if($res !== false){
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

function dbConnect(){
    $host = '127.0.0.1';
    $db = 'altarix';
    $user = 'root';
    $pwd = 'jd5xugLMrr';
    try{
        return new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
    }catch(PDOException $e) {
        //echo 'Cannot connect to database';
        echo $e->getMessage();
        exit;
    }
}