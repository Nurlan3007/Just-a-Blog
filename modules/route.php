<?php 
# code...
class Route{
	private $action;
	private $path;

	function __construct($action,$path)
	{
		$this->action = $action;
		$this->path = $path;
	}

	public function match($uri){
		return $this->path == $uri;
	}

	public function FindNameFilesInCatalog($catalog){
		if(!is_string($catalog))	
			return 'Catalog should be string';
		
		$dir = $catalog;
		$files = scandir($dir);
		array_shift($files);
		array_shift($files);
		
		if(count($files) == 0)
			return 'Catalog haven`t files';

		return $files;
	}

	public function call(){
		if(is_string($this->action)){
			$catalog = 'Controllers';
			$files = $this -> FindNameFilesInCatalog($catalog);

			foreach ($files as $file)
				require_once "$catalog/$file";

			$segments = explode('@',$this->action);
			$object = new $segments[0]();
			call_user_func([$object,$segments[1]]);
		}else
			call_user_func($this -> action);
	}
}