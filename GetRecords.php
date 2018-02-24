<?php
$UserDataJson = file_get_contents('ZohoUserData.json');
$UserInfo = json_decode($UserDataJson,true);
$token = $UserInfo['CRMAutoToken'];
$url = "https://crm.zoho.com/crm/private/json/SalesOrders/getRecords";
$post_params = array();
$post_params['authtoken'] = $token;
$post_params['scope'] = 'crmapi';
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
//echo $result;
//$jsonData = file_get_contents('salesorder.json');
$json = json_decode($result,true);
//echo $jsonData;
foreach ($json["response"]["result"]["SalesOrders"]["row"] as $row){
    echo "<hr>"."<hr>"."Element number: ".$row["no"]."<br>"."<hr>"."<hr>";
    foreach ($row["FL"] as $element){
        if ($element["product"] != ""){
            foreach ($element["product"] as $product) {
                echo "<hr>" . "Product number: " . $product["no"] . "<br>"."<hr>";
                foreach ($product["FL"] as $prodelem){
                    echo $prodelem["val"].": ".$prodelem["content"]."<br>";
                }
            }
        }else{
            echo $element["val"].": ".$element["content"]."<br>";
        }
    }
}
?>