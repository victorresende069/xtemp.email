<?php
header("Access-Control-Allow-Origin: *");
header('Cache-Control: no-cache, must-revalidate'); 
header("Content-Type: text/json; charset=UTF-8");
date_default_timezone_set('America/Porto_Velho');
header("HTTP/1.1 200 OK");
$dados = file_get_contents("php://input");
$UserAgent = $_SERVER['HTTP_USER_AGENT'];
$date = date("d/m/y");
$hours = date("H:i:s");
$internetProtocol = getenv('HTTP_CLIENT_IP')?:
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');
require_once('../funcs/database/connect.php'); //BANCO DE DADOS
$obj = json_decode($dados);
require_once('switch.php'); //ROTAS DO API
?>
