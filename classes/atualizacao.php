<?php  namespace App;session_start();require_once '../vendor/autoload.php';include_once 'conexao.php';date_default_timezone_set('America/Sao_Paulo');$date = date('Y-m-d H:i:s');$db = new \App\Conn(HOST_SERVER, DB_SERVER, USER_SERVER, PASS_SERVER);$user = new \App\User;$user->setUser($_SESSION['username'])->setPassIndex($_SESSION['pass']);$trade = new \App\Trade($db, $user);$order = new \App\Order;$access = $trade->access();$user->setKey($access->key_poloniex)->setSecret($access->secret_poloniex);$action = $_GET['action'] ? $_GET['action'] : '';  if($action != '')  {        if($action == 'validation')        {          $poloniex = new \App\poloniex($user->getKey(), $user->getSecret());          $service = new \App\ServiceOrder($db, $order, $poloniex);          $order->setIdUser($access->id);          for($p = 0; $p < count($service->listEngine()); $p++)          {            $order->setPair($service->listEngine()[$p]->pair);          //echo json_encode($user->getSecret());          echo json_encode($service->validation());          }        }elseif($action == 'start')        {          $poloniex = new \App\poloniex($user->getKey(), $user->getSecret());			$moeda = $_GET['moeda'];          $order->setPair($moeda)->setBtc(0.005)->setTaxa(504)->setStart('running')->setIdUser($access->id)->setPosition(1)->setTypeOrder('buy')->setDataOpened(NULL)->setDataStart($date)->setId(1);          $service = new \App\ServiceOrder($db, $order, $poloniex);          echo json_encode($service->updateOrder());        }elseif($action == 'save')        {          //Require BTC, TAXA, ID_USER, STATUS, MAX_ORDERS, PAIR;          $btc = isset($_GET['btc']) ? $_GET['btc'] : false;          $osc = isset($_GET['osc']) ? $_GET['osc'] : false;          $osc_sell = isset($_GET['osc_sell']) ? $_GET['osc_sell'] : false;          $pair = isset($_GET['pair']) ? $_GET['pair'] : false;          $numberOrders = isset($_GET['numberOrders']) ? $_GET['numberOrders'] : false;          if(!$btc || !$osc || !$pair || !$numberOrders || !$osc_sell)          {            echo json_encode('Erro ao salvar! Verifique se preencheu todos os campos.');            exit;          }          $order->setIdUser($access->id)->setStart('running')->setBtc($btc)->setTaxa($osc)->setTaxaSell($osc_sell)->setMaxOrders($numberOrders)->setPair($pair)->setPosition(1)->setTypeOrder('buy')->setDataStart($date)->setVerify(1);          $poloniex = new \App\poloniex($user->getKey(), $user->getSecret());          $service = new \App\ServiceOrder($db, $order, $poloniex);         echo json_encode($service->saveEngine());                  }elseif ($action == 'deleteEngine') {          $pair = isset($_GET['pair']) ? $_GET['pair'] : false;         $order->setIdUser($access->id)->setPair($pair);         $poloniex = new \App\poloniex($user->getKey(), $user->getSecret());        $service = new \App\ServiceOrder($db, $order, $poloniex);        echo json_encode($service->deleteEngine());        }elseif ($action == 'stopEngine') {          $pair = isset($_GET['pair']) ? $_GET['pair'] : false;         $order->setIdUser($access->id)->setPair($pair)->setStart('stoped');         $poloniex = new \App\poloniex($user->getKey(), $user->getSecret());        $service = new \App\ServiceOrder($db, $order, $poloniex);        echo json_encode($service->stopEngine());        }elseif ($action == 'playEngine') {          $pair = isset($_GET['pair']) ? $_GET['pair'] : false;         $order->setIdUser($access->id)->setPair($pair)->setStart('running');         $poloniex = new \App\poloniex($user->getKey(), $user->getSecret());        $service = new \App\ServiceOrder($db, $order, $poloniex);        echo json_encode($service->playEngine());        }  }else{    return false;  } ?>