<?php 
class Router
{
	private $uri;
	private $routes = array();
	function __construct($uri)
	{
		$this -> uri = parse_url($uri,PHP_URL_PATH);
	}

	public function post($action,$path){
		$route = new Route($path,$action);
		$this->routes['POST'][] = $route; 
	}

	public function get($action,$path){
		$route = new Route($path,$action);
		$this->routes['GET'][] = $route; 		
	}

	public function run(){
		if(!isset($this -> routes[$_SERVER['REQUEST_METHOD']])){
			echo 'False:1';
			return False;
		}


		foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
			if($route->match($this->uri)){
				$route -> call();
				return True;
			}
		}
		echo 'False:2';
		return False;
		
	}

}


