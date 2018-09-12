<?php 
namespace App;
session_start();
        require_once '../vendor/autoload.php';
        include_once '../classes/conexao.php';
         $db = new \App\Conn(HOST_SERVER, DB_SERVER, USER_SERVER, PASS_SERVER);
         $user = new \App\User;
         $user->setUser($_SESSION['username'])->setPassIndex($_SESSION['pass']);

         $trade = new \App\Trade($db, $user);
         $access = $trade->access();
         $_SESSION['id'] = $access->id;
          if(count($access) > 0)
          {
            $user->setKey($access->key_poloniex);
            $user->setSecret($access->secret_poloniex);
            $user->setId($access->id);
         
          }
          
          
          $poloniex = new \App\poloniex($user->getKey(), $user->getSecret());
$serviceRun = new \App\ServiceRun($db);
             $configs = $serviceRun->getConfigData($_SESSION['id']);
             $running = new \App\Running;
$running->setBid($poloniex->get_ticker($configs[0]->pair)['highestBid'])->setAsk($poloniex->get_ticker($configs[0]->pair)['lowestAsk']);
echo json_encode("<table class='table table-hover'><thead><tr><td>".$configs[0]->pair."</td></tr><tr><td>Bid</td><td>Ask</td></tr></thead><tbody class='alert alert-info'><td>".$running->getBid()."</td><td>".$running->getAsk()."</td></tbody></table>"); ?>