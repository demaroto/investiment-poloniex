<?php 

namespace App;

	class Cadastrar_class 
	{
	private $db;
	private $user;
		public function __construct(IConn $db, $user)
			{
				$this->db = $db->connect();
				$this->user = $user;
			}

		public function findLogin()
			{
				$res = "";
				$query = "SELECT * FROM usuarios WHERE `email` = ?";
				$stmt = $this->db->prepare($query);
				$stmt->bindValue(1, $this->user->getUser());
				$stmt->execute();
					
				$res = $stmt->fetch(\PDO::FETCH_OBJ);
				//Se existir
				if($res)
					{
					return  false;
					}else{
						$this->insertLogin();
						return true;
					}
			}

		public function insertLogin()
		{
			$query = "Insert into `usuarios` (`email`, `pass`, `key`, `secret`, `online`, `saldo`) VALUES (:email, :pass, :key, :secret, :online, :saldo)";
			$stmt = $this->db->prepare($query);
			$stmt->bindValue(":email", $this->user->getUser());
			$stmt->bindValue(":pass", $this->user->getPass());
			$stmt->bindValue(":key", $this->user->getKey());
			$stmt->bindValue(":secret", $this->user->getSecret());
			$stmt->bindValue(":online", 'offline');
			$stmt->bindValue(":saldo", 0);
			$stmt->execute();
			return $this->db->lastInsertId();
		}


	}

 ?>