<?php 

namespace App;





class Route

{

	

	private $routes; 

	public function __construct()

		{

	

		}



	public function initRoutes()

		{

			$routes['home'] = array('route' => '/', 'controller' => 'IndexController', 'action' => 'home');

			$routes['config'] = array('route' => '/engine', 'controller' => 'IndexController', 'action' => 'config');

			return $routes;

			

		}



	public function Router($url)

	{

		

	if(array_key_exists($url, $this->initRoutes()))

	{

		return $this->initRoutes()[$url];

	}else{

		return $this->initRoutes()['home'];

	}



	}





}



 ?>