<?php 
session_start();
        require_once '../vendor/autoload.php';
        include_once 'conexao.php';
         $db = new \App\Conn(HOST_SERVER, DB_SERVER, USER_SERVER, PASS_SERVER);
          $user = new  \App\User;
         $user->setUser($_SESSION['username'])->setPassIndex($_SESSION['pass']);
         $trade = new \App\Trade($db, $user);
         $order = new \App\Order;

         $access = $trade->access();
         
            if(count($access) > 0)
          {
            $key = $access->key;
            $secret = $access->secret;
          }

         $poloniex = new \App\poloniex($key, $secret);
         $service = new \App\ServiceOrder($db, $order, $poloniex);
         
         //Salvar Favoritos
      
	         echo json_encode($service->showFavorite());
	  	
	     
         
         

 ?>