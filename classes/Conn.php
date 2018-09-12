<?php 
namespace App;

class Conn implements IConn
{
	private $host;
	private $dbname;
	private $user;
	private $pass;

	public function __construct($host, $dbname, $user, $pass)
	{
		$this->host = $host;
		$this->dbname = $dbname;
		$this->user = $user;
		$this->pass = $pass;
	
	}

	public function connect()
	{
		try {
			return new \PDO("mysql:host={$this->host};dbname={$this->dbname}",
			 $this->user,
			 $this->pass
			 );
		} catch (Exception $e) {
			$cod = $e->getCode();
		
			switch ($cod) {
				case 2002:
					echo '<h2>Host incorreto!</h2>';
					break;
				case 1049 : 
					echo '<h2>Tabela não encontrada!</h2>';
					break;
				case 1045:
					echo '<h2>Acesso negado! Usuário ou senha incorreta.</h2>';
					break;
				default:
					echo '<h2>Erro desconhecido, contate o administrador do sistema!</h2>';
					echo '<br />';
					echo $e->getMessage();
					break;
			}
			exit;
		}
	
	}

	
}





		
          
 ?>