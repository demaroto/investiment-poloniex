<?php 
session_start();
require_once '../vendor/autoload.php';

 include_once 'conexao.php';
    $db = new \App\Conn(HOST_SERVER, DB_SERVER, USER_SERVER, PASS_SERVER);
	$user = new \App\User;
	$user->setUser($_SESSION['username'])->setPassIndex($_SESSION['pass']);
	$login = new \App\Login($db, $user);
	
	if($login->findLogin())
	{
	
		$login->updateLogin("offline");
		echo json_encode(true);
		session_destroy();
		
	}




 ?>