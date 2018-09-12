<?php 
namespace App;
require_once '../vendor/autoload.php';
include_once 'conexao.php';
$db = new \App\Conn(HOST_SERVER, DB_SERVER, USER_SERVER, PASS_SERVER);
$serviceRun = new \App\ServiceRun($db);
$order = new \App\Order;
$usuarios = $serviceRun->getUsersData();
$running = new \App\Running;



//Se tiver usuarios cadastrados
	if(count($usuarios) > 0){
		//Para cada usuário cadastrado
		for ($i=0; $i < count($usuarios); $i++) { 
			//Se usuario estiver ativo(online)
			if($usuarios[$i]->status == "online"){
				$running->setId($usuarios[$i]->id);
				$running->setKey($usuarios[$i]->key_poloniex);
				$running->setSecret($usuarios[$i]->secret_poloniex);
				$poloniex = new \App\poloniex($running->getKey(), $running->getSecret());
				$ordens = new \App\ServiceOrder($db, $order, $poloniex);
				//print_r($poloniex->get_my_trade_history('BTC_ETC'));
				//Se tiver configurações de moeda
				if(count($serviceRun->getConfigData($running->getId())) > 0){
					$configs = $serviceRun->getConfigData($running->getId());

					
					//Para cada configuracao
					for ($x=0; $x < count($configs); $x++) { 
						$listOrders = $ordens->listOrders($configs[$x]->usuarios_id);
						//print_r($listOrders);
						$running->setBid($poloniex->get_ticker($configs[$x]->pair)['highestBid'])->setOrderBook($poloniex->get_order_book($configs[$x]->pair))->setAsk($poloniex->get_ticker($configs[$x]->pair)['lowestAsk'])->setTaxa($configs[$x]->taxa);
						
						/*echo '<pre>';
						print_r($running->getOrderBook()['asks'][0]);
						echo '</pre>';
						echo '<pre>';
						print_r($running->getOrderBook()['bids'][0]);
						echo '</pre>';*/
						
						//print_r($listOrders);
						if(count($listOrders) > 0){				
						for ($j=0; $j < count($listOrders); $j++) { 
							$running->setTipo($listOrders[$j]->tipo);
							$running->setStatus($listOrders[$j]->status);
							$tipo = $running->getTipo();
							if($tipo == 'buy'){
								//Comprando ..

								print_r($serviceRun->buying($running->getId(), $running->getBid(), $running->getStatus(), $running->getOrderBook()['bids']));
							
							}elseif ($tipo == 'sell') {
								//Se estiver proximo prejuizo -- Venda
								if(($configs[$x]->prejuizo + ($configs[$x]->fibonacci - $configs[$x]->taxa)) >= $configs[$x]->limit){
							//Vende no lucro somente

								print_r($serviceRun->selling($running->getId(), $running->getAsk(), $running->getStatus(), $running->getOrderBook()['asks'], false));
								}else{

							//Vende no prejuizo e ativa fibonacci
								print_r($serviceRun->selling($running->getId(), $running->getAsk(), $running->getStatus(), $running->getOrderBook()['asks'], true));
								}
							}
											

						}
						}else{//Cria ordem
							$serviceRun->createOrder($running->getId());
							echo 'Criando ordem zerada';
						}
						
					}

			}

		}
	}
}
 ?>