<?php 
session_start();
require_once '../vendor/autoload.php';
include_once 'conexao.php';
	//require_once 'IConn.php';


$db = new \App\Conn(HOST_SERVER, DB_SERVER, USER_SERVER, PASS_SERVER);
$user = new \App\User;
$serviceUser = new \App\ServiceUser($db, $user);
$key = isset($_GET['key']) ? $_GET['key'] : '';
$secret = isset($_GET['secret']) ? $_GET['secret'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'update') {
	$user->setUser($_SESSION['username'])->setPassIndex($_SESSION['pass'])->setKey($key)->setSecret($secret);
	$serviceUser = new \App\ServiceUser($db, $user);
	echo json_encode($serviceUser->update());
}


 ?>