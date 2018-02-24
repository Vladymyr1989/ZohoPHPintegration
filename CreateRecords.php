<?php
$UserDataJson = file_get_contents('ZohoUserData.json');
$UserInfo = json_decode($UserDataJson,true);
$token = $UserInfo['CRMAutoToken'];
$url = "https://crm.zoho.com/crm/private/xml/SalesOrders/insertRecords";
$xml = file_get_contents('RecordXML.xml');
$post_params = array();
$post_params['newFormat'] = '1';
$post_params['authtoken'] = $token;
$post_params['scope'] = 'crmapi';
$post_params['xmlData'] = $xml;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_params);
$result = curl_exec($ch);
curl_close($ch);
echo $result;
?>