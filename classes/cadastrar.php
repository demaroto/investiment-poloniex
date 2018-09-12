<?php 
session_start();
//require_once 'IConn.php';
require_once '../vendor/autoload.php';

if(isset($_GET['email']) && isset($_GET['pass']) && isset($_GET['key']) && isset($_GET['secret']))
{
  include_once 'conexao.php';
         $db = new \App\Conn(HOST_SERVER, DB_SERVER, USER_SERVER, PASS_SERVER);
         $user =  new \App\User;
         $user->setUser($_GET['email']);
         $user->setPass($_GET['pass']);
         $user->setKey($_GET['key']);
         $user->setSecret($_GET['secret']);

		$cadastrar = new \App\Cadastrar_class($db, $user);
	
	if($cadastrar->findLogin())
	{
		$cadastrar->findLogin();
		echo json_encode('Cadastrado com sucesso');
		
	}else{
		echo json_encode('Dados já existentes');
	}
}else{
	echo json_encode('Preencha os campos de e-mail e senha!');
}





 ?>