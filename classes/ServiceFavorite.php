<?php
	namespace App;
	
	class ServiceFavorite
	{
		private $db;
		private $order;
		private $poloniex;
		private $balance;
		private $user;
		
		public function __construct(IConn $db, IOrder $order, $poloniex, $balance, $user)

		{

			$this->db = $db->connect();
			$this->order = $order;
			$this->poloniex = $poloniex;			
			$this->balance = $balance;
			$this->user = $user;
		}
		
		public function showFavorite()

		{

			$query = "SELECT * FROM favorites WHERE `usuarios_id` = ?";
			$stmt = $this->db->prepare($query);
			$stmt->bindValue(1, $this->user->getId());
			$stmt->execute();
			return $stmt->fetchAll(\PDO::FETCH_OBJ);

		}



		public function updateFavorite()

		{

			$showFavorite = $this->showFavorite();
			$balance = $this->balance->balances();

			for ($i= 0; $i < count($showFavorite); $i++) { 

			$id = $showFavorite[$i]->id;
			$pair = $showFavorite[$i]->pair;
			$pricePoloniex = $balance[$pair]['last'];
			$volumePoloniex = number_format($balance[$pair]['baseVolume'], 3, '.', '');
			$changePoloniex = number_format($balance[$pair]['percentChange'] * 100, 2, '.', '');
				$query = "UPDATE `favorites` set `price` = ?, `volume` = ?, `change` = ? WHERE `id` = ?";
				$stmt = $this->db->prepare($query);
				$stmt->bindValue(1, $pricePoloniex);
				$stmt->bindValue(2, $volumePoloniex);
				$stmt->bindValue(3, $changePoloniex);
				$stmt->bindValue(4, $id);
				$stmt->execute();

			}

		}

		public function listFavorite()

		{

			$query = "SELECT * FROM favorites WHERE pair = :pair";
			$stmt = $this->db->prepare($query);
			$stmt->bindValue(":pair", $this->order->getPair());
			$stmt->execute();
			return $stmt->fetchAll(\PDO::FETCH_OBJ);

		}

		public function saveFavorite()

		{

			if($this->listFavorite() == null)

			{

			$query = "Insert into `favorites` (`pair`, `open`, `price`, `volume`, `change`, `value`, `usuarios_id`) VALUES (:pair, :open, :price, :volume, :change, :value, :usuarios_id)";
			$stmt = $this->db->prepare($query);
			$stmt->bindValue(":pair", $this->order->getPair());
			$stmt->bindValue(":open", 0);
			$stmt->bindValue(":price", 0);
			$stmt->bindValue(":volume", 0);
			$stmt->bindValue(":change", 0);
			$stmt->bindValue(":value", 0);
			$stmt->bindValue(":usuarios_id", $this->user->getId());
			$stmt->execute();

			return $this->db->lastInsertId();



			}else{

			return 0;

			}

		}


		public function deleteFavorite()

		{

			$query = "DELETE FROM `favorites` WHERE `pair` = :pair AND `usuarios_id` = :usuarios_id";
			$stmt = $this->db->prepare($query);
			$stmt->bindValue(":pair", $this->order->getPair());
			$stmt->bindValue(":usuarios_id", $this->user->getId());
			$ret = $stmt->execute();
			return $ret;

		}

		
	}

?>
