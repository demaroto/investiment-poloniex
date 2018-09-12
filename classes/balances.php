<?php 

//Balances
 namespace App;
session_start();



        require_once '../vendor/autoload.php';

		//require_once 'IConn.php';

        //require_once 'IOrder.php';



           include_once 'conexao.php';

         $db = new \App\Conn(HOST_SERVER, DB_SERVER, USER_SERVER, PASS_SERVER);

          $user = new \App\User;

         $user->setUser($_SESSION['username'])->setPassIndex($_SESSION['pass']);

         $trade = new \App\Trade($db, $user);

         $order = new \App\Order;

         $action = isset($_GET['action']) ? $_GET['action'] : '';

         $pair = isset($_GET['pair']) ? $_GET['pair'] : '';

         $order->setPair($pair);         

         $poloniex = new \App\poloniex($user->getKey(), $user->getSecret());

         $service = new \App\ServiceOrder($db, $order, $poloniex);

         if($action == 'all')

         {

           echo json_encode($service->balances()); 

       }elseif ($action == 'find') {

            if(count($service->findBalance()) > 0)

            {

            echo json_encode($service->findBalance());    

        }else{

            echo json_encode(0);   

            }

        }

         



 ?>