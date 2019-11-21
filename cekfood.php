<?php
echo "======================================\n";	
echo "= Auto Check Mission Gojek | Rama4rt =\n";	
echo "======================================\n";
echo "> Input List Token : ";
$list = trim(fgets(STDIN));
echo "Total Ada : ".count(explode("\n", str_replace("\r","",@file_get_contents($list))))." Token, Lets Check!\n";
foreach(explode("\n", str_replace("\r", "", @file_get_contents($list))) as $c => $akun)
	{
$token = trim($akun);
$header = array();
$header[] = 'Content-Type: application/json';
$header[] = 'X-AppVersion: 3.39.1';
$header[] = "X-Uniqueid: ac94e5d0e7f3f".rand(111,999);
$header[] = 'X-Location: -6.4'.rand(100,919).'21,106.0'.rand(132,999).'93';
$header[] = 'Authorization:Bearer '.$token.'';

echo ''.$token.' = ';
$cekmisi = curl('https://api.gojekapi.com/gobenefits/v1/journeys', null, $header);
$jscekmisi = json_decode($cekmisi[0]);
$misi = $jscekmisi->data->new_journeys[0]->description;
if($misi == null){
echo "\nZonk Gan!!! \n";
} else {
echo $misi;
echo "\n";
}
}
function curl($url, $fields = null, $headers = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if ($fields !== null) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        }
        if ($headers !== null) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $result   = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        return array(
            $result,
            $httpcode
        );
	}	
