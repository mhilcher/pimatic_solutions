<?php
error_reporting(1);

/* Definition der Variablen */
//username and password of account
$username = ""; //username pimatic
$password = ""; //password pimatic
//login form action url
$url="http://PIMATIC_URL:PIMATIC_PORT/api/variables/" . $_POST["var"];
$path = "/tmp";
$cookie_file_path = $path."/cookie2.txt";
$debug = true;

if ($debug) file_put_contents("putvar.log", date('Y-m-d H:i:s') . "\n", FILE_APPEND); //Debug

/* Auslesen der POST-Variablen */
$json_string = $_POST["valueOrExpression"];

if ($debug) file_put_contents("putvar.log", implode(", ", array_keys($_POST)) . " => " . implode(", ", $_POST) . "\n", FILE_APPEND); //Debug

/* Umwandeln der POST-Daten in json */
$data = array("type" => "value", "valueOrExpression" => $json_string);
$data_string = json_encode($data);

/* Senden der Daten via cUrl */
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_NOBODY, false);
curl_setopt($ch, CURLOPT_USERPWD, $username.":".$password);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
curl_setopt($ch, CURLOPT_COOKIE, "cookiename=0");
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_string)));

$json2 = curl_exec($ch);

if ($debug) file_put_contents("putvar.log", $json2 . "\n", FILE_APPEND);

echo date('Y-m-d H:i:s') . "   \n   " . $json2;

curl_close($ch);
?>