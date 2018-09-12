<?php  namespace App;session_start();      require_once '../vendor/autoload.php';       include_once 'conexao.php';         $db = new \App\Conn(HOST_SERVER, DB_SERVER, USER_SERVER, PASS_SERVER);           $user = new  \App\User;         $user->setUser($_SESSION['username'])->setPassIndex($_SESSION['pass'])->setId($_SESSION['id']);         $trade = new \App\Trade($db, $user);         $order = new \App\Order;                 $order->setPair($_GET['pair']);         $access = $trade->access();                     if(count($access) > 0)          {            $key = $access->key_poloniex;            $secret = $access->secret_poloniex;          }         $poloniex = new \App\poloniex($key, $secret);           $balance = new \App\ServiceOrder($db, $order, $poloniex);         $serviceFavorite = new \App\ServiceFavorite($db, $order, $poloniex, $balance, $user);                  //Salvar Favoritos      		$action = isset($_GET['action']) ? $_GET['action'] : '';      		if($action == 'save')      		{      		echo json_encode($serviceFavorite->saveFavorite());	      		}elseif ($action == 'delete') {      			if($serviceFavorite->deleteFavorite())      			{      			echo json_encode('Favorito deletado com sucesso.');	      			}      			      		}	         	  		                        ?>