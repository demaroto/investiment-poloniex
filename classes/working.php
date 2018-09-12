<?php 
namespace App;
session_start();
$id = $_SESSION['id'];

require_once '../vendor/autoload.php';
include_once 'conexao.php';
$db = new \App\Conn(HOST_SERVER, DB_SERVER, USER_SERVER, PASS_SERVER);
$serviceRun = new \App\ServiceRun($db);
echo json_encode($serviceRun->working($id)[0]->pair); 

 ?>