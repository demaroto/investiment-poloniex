<?php 

namespace App;



class ServiceRun {

	public function __construct(IConn $db)

	{

		$this->db = $db->connect();

	}


		

			public function getUsersData(){

			$query = "SELECT * FROM usuarios";
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(\PDO::FETCH_OBJ);

			}

			public function getConfigData($id){
			$query = "SELECT * FROM configuracoes WHERE `usuarios_id` = ?";
			$stmt = $this->db->prepare($query);
			$stmt->bindValue(1, $id);
			$stmt->execute();
			return $stmt->fetchAll(\PDO::FETCH_OBJ);

			}

			private function getList($id){
	$query = "SELECT * FROM ordens, configuracoes WHERE `configuracoes_id` = ? AND `usuarios_id` = ?";
				$stmt = $this->db->prepare($query);
				$stmt->bindValue(1, $id);
				$stmt->bindValue(2, $id);
				$stmt->execute();
				$res = $stmt->fetchAll(\PDO::FETCH_OBJ);
				return $res;
			}


				private function fibbonaci($preco, $preco_fibbo, int $posFibbo, $config_id){
				$pos = $posFibbo++;
				if($posFibbo > 0){
					$fibo = $preco + $preco_fibbo;
					return $this->updateFibonacci($config_id, $fibo, $preco, $pos);
				
				}
			

			}
			private function updateFibonacci($config_id, $fibonacci, $preco, $pos){

			$query = "UPDATE configuracoes set `fibonacci` = ?, `preco_fibo` = ?, `qtd_fibo` = ? WHERE `id` = ?";
			$stmt = $this->db->prepare($query);
			$stmt->bindValue(1, $fibonacci);
			$stmt->bindValue(2, $preco);
			$stmt->bindValue(3, $pos);
			$stmt->bindValue(4, $config_id);
			return $stmt->execute();

			}
			//Quando estiver comprando
			public function buying($config_id, $preco, $status, $bid){
				$this->delay($config_id, $preco, $status);
				$listBD = $this->getList($config_id)[0];
				if($status == 'comprando'){
					//Percorre a BID
					for ($i=0; $i < count($bid); $i++) { 
						//Se encontrar o cabra
						if($bid[$i][0] <= $listBD->preco_buy && $bid[$i][1] >= $listBD->amount)
						{
							//Compra
						return 'Price: '.$bid[$i][0].' Amount: '.$bid[$i][1];	 
							
						}else{
							return $listBD;
						}
					}
					
				}
			}
			//Quando estiver vendendo
			public function selling($config_id, $preco, $status, $ask, $vendePrejuizo = false){
				$this->delay($config_id, $preco, $status);
					$listBD = $this->getList($config_id)[0];
				if($vendePrejuizo){					

					if($status == 'vendendo'){
					//Percorre a ASK
						for ($i=0; $i < count($ask); $i++) { 
						//Se encontrar o cabra
							if($ask[$i][0] >= $listBD->preco_sell && $ask[$i][1] >= $listBD->amount)
							{
							//Venda
							return 'Price: '.$bid[$i][0].' Amount: '.$bid[$i][1];	 
							
							}else{
								return $listBD;
								//Verifica se o preço caiu

							}
						}
				
					}

				}
				

			}

			private function delay($config_id, $preco){
				$query = "SELECT * FROM ordens, configuracoes WHERE `configuracoes_id` = ? AND `usuarios_id` = ?";
				$stmt = $this->db->prepare($query);
				$stmt->bindValue(1, $config_id);
				$stmt->bindValue(2, $config_id);
				$stmt->execute();
				$res = $stmt->fetchAll(\PDO::FETCH_OBJ);
				
				$valorAtualizado = $res[0]->preco_atualizado;
				$precoBuy = $res[0]->preco_atualizado - $res[0]->taxa;	
				$precoSell = $res[0]->preco_atualizado + $res[0]->taxa;		
				
				$timeAtualizado = $res[0]->timeAtualizado;	
				$UltimaAtualizacao = date('H:i:s.u');
				$timeReal = join("",explode(":", $UltimaAtualizacao));
			 	$timeBD = join("",explode(":", $timeAtualizado));

				//Se tempo de atualizacao for maior que os segundos	.. entao atualiza os valores
				if(($timeReal-$timeBD)>=$res[0]->delay){
					$this->atualizaValores($res[0]->configuracoes_id, $preco, $precoBuy, $precoSell);
					$this->timeUpdate($res[0]->configuracoes_id);
				}
			
				
			}

			private function atualizaValores($config_id, $precoAtualizado, $precoBuying, $precoSelling){
			$query = "UPDATE ordens set `preco_atualizado` = ?, `preco_buy` = ?, `preco_sell` = ? WHERE `configuracoes_id` = ?";
			$stmt = $this->db->prepare($query);
			$stmt->bindValue(1, $precoAtualizado);
			$stmt->bindValue(2, $precoBuying);
			$stmt->bindValue(3, $precoSelling);
			$stmt->bindValue(4, $config_id);
			$stmt->execute();
			}

			private function timeUpdate($id){
				$query = "UPDATE ordens set `timeAtualizado` = ? WHERE `configuracoes_id` = ?";
			$stmt = $this->db->prepare($query);
			$timeA = date('H:i:s.u');
			$stmt->bindValue(1, $timeA);
			$stmt->bindValue(2, $id);
			return $stmt->execute();

			}


//Adicionando as cunfigs
			public function addConfig($config, $tx){
				if($this->findConfig($config[12])){
					return $this->updateConfig($config, $tx);					
				}else{
				$query = "INSERT INTO `configuracoes` (`pair`, `btc`, `limit`, `taxa`, `delay`, `fibonacci`, `qtd_fibo`, `preco_fibo`, `prejuizo`, `automatico`, `parar`,`lucro`, `usuarios_id`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$stmt = $this->db->prepare($query);
				$stmt->bindValue(1, $config[0]);
				$stmt->bindValue(2, $config[1]);
				$stmt->bindValue(3, $config[2]);
				$stmt->bindValue(4, $config[3]);
				$stmt->bindValue(5, $config[4]);
				$stmt->bindValue(6, $config[5]);
				$stmt->bindValue(7, $config[6]);
				$stmt->bindValue(8, $config[7]);
				$stmt->bindValue(9, $config[8]);
				$stmt->bindValue(10, $config[9]);
				$stmt->bindValue(11, $config[10]);
				$stmt->bindValue(12, $config[11]);
				$stmt->bindValue(13, $config[12]);
				$this->addTaxa($tx);
				return $stmt->execute();

				}

			}

				private function updateConfig($config, $tx){
				$query = "UPDATE `configuracoes` set `pair` = ?, `btc` = ?, `limit` = ? , `taxa` = ?, `delay` = ?, `fibonacci` = ?, `qtd_fibo` = ?, `preco_fibo` = ?, `prejuizo` = ?, `automatico` = ?, `parar` = ? , `lucro` = ? WHERE `usuarios_id` = ?";
				$stmt = $this->db->prepare($query);
				$stmt->bindValue(1, $config[0]);
				$stmt->bindValue(2, $config[1]);
				$stmt->bindValue(3, $config[2]);
				$stmt->bindValue(4, $config[3]);
				$stmt->bindValue(5, $config[4]);
				$stmt->bindValue(6, $config[5]);
				$stmt->bindValue(7, $config[6]);
				$stmt->bindValue(8, $config[7]);
				$stmt->bindValue(9, $config[8]);
				$stmt->bindValue(10, $config[9]);
				$stmt->bindValue(11, $config[10]);
				$stmt->bindValue(12, $config[11]);
				$stmt->bindValue(13, $config[12]);
				$this->updateTaxa($tx);	
				return $stmt->execute();
			}

			private function addTaxa($tx){
				$query2 = "INSERT INTO `taxas` (`taxa8`, `taxa7`, `taxa6`, `taxa5`, `taxa4`, `taxa3`, `taxa2`, `taxa1`, `usuarios_id`) VALUES (?,?,?,?,?,?,?,?,?)";
				$stmt2 = $this->db->prepare($query2);
				$stmt2->bindValue(1, $tx[7]);
				$stmt2->bindValue(2, $tx[6]);
				$stmt2->bindValue(3, $tx[5]);
				$stmt2->bindValue(4, $tx[4]);
				$stmt2->bindValue(5, $tx[3]);
				$stmt2->bindValue(6, $tx[2]);
				$stmt2->bindValue(7, $tx[1]);
				$stmt2->bindValue(8, $tx[0]);
				$stmt2->bindValue(9, $tx[8]);
				return $stmt2->execute();

			}

			private function updateTaxa($tx){
				$query2 = "UPDATE `taxas` set `taxa1` = ?, `taxa2` = ?, `taxa3` = ?, `taxa4` = ?, `taxa5` = ?, `taxa6` = ?, `taxa7` = ?, `taxa8` = ? WHERE `usuarios_id` = ?";
				$stmt2 = $this->db->prepare($query2);
				$stmt2->bindValue(1, $tx[0]);
				$stmt2->bindValue(2, $tx[1]);
				$stmt2->bindValue(3, $tx[2]);
				$stmt2->bindValue(4, $tx[3]);
				$stmt2->bindValue(5, $tx[4]);
				$stmt2->bindValue(6, $tx[5]);
				$stmt2->bindValue(7, $tx[6]);
				$stmt2->bindValue(8, $tx[7]);
				$stmt2->bindValue(9, $tx[8]);
				return $stmt2->execute();

			}

			private function findConfig($id){
				$query = "SELECT * FROM configuracoes WHERE `usuarios_id` = ?";
				$stmt = $this->db->prepare($query);
				$stmt->bindValue(1, $id);
				return $stmt->execute();
			}

			public function working($id){
				$query = "SELECT * FROM configuracoes WHERE `usuarios_id` = ?";
				$stmt = $this->db->prepare($query);
				$stmt->bindValue(1, $id);
				$stmt->execute();
				return $stmt->fetchAll(\PDO::FETCH_OBJ);
			}

			//Cria a ordem caso tenha configuração, mas não possua ordem
			public function createOrder($id){
				$query = "INSERT INTO `ordens` (`order_number`, `tipo`, `amount`, `status`, `preco_buy`, `preco_atualizado`, `preco_sell`, `prejuizo`, `configuracoes_id`, `timeAtualizado`) VALUES (?,?,?,?,?,?,?,?,?,?)";
				$stmt = $this->db->prepare($query);
				$stmt->bindValue(1, 0);
				$stmt->bindValue(2, 'buy');
				$stmt->bindValue(3, 0);
				$stmt->bindValue(4, 'comprando');
				$stmt->bindValue(5, 0);
				$stmt->bindValue(6, 0);
				$stmt->bindValue(7, 0);
				$stmt->bindValue(8, 0);
				$stmt->bindValue(9, $id);
				$stmt->bindValue(10, 0);
				$stmt->execute();
				return $this->timeUpdate($id);
			}

			
		

}


 ?>