<?php 
session_start();
if(!isset($_SESSION['username']))
        {
         
          header("location: login.php");
          exit;
        }



      date_default_timezone_set('America/Sao_Paulo');
        require_once 'vendor/autoload.php';
        include_once 'classes/conexao.php';
         $db = new \App\Conn(HOST_SERVER, DB_SERVER, USER_SERVER, PASS_SERVER);
         $user = new \App\User;
         $user->setUser($_SESSION['username'])->setPassIndex($_SESSION['pass']);
         $trade = new \App\Trade($db, $user);
         $order = new \App\Order;
         $access = $trade->access();
         $_SESSION['id'] = $access->id;
          if(count($access) > 0)
          {
            $user->setKey($access->key);
            $user->setSecret($access->secret);
            $user->setId($access->id);
            $order->setIdUser($user->getId());
          }

           try {
          $poloniex = new \App\poloniex($user->getKey(), $user->getSecret());
         $service = new \App\ServiceOrder($db, $order, $poloniex);
         $service_user = new \App\ServiceUser($db, $user, $poloniex);
         $user->setSaldo($service_user->getBalance('BTC'));
         
         $rout = new App\Route;
         $url = $_SERVER['REQUEST_URI'];
          $url = parse_url($url, PHP_URL_PATH);
          $url = explode("/", $url);
          $action = $rout->Router($url[1])['action'];
        $pg = new \App\IndexController;
                    
         } catch (Exception $e) {
           echo "<h1>Erro de conexão!</h1>";
           exit;
         }

         echo $user->getSaldo();

 ?>