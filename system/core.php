<?php
	namespace CopperBot;
	
	use CopperBot\System\Router\Interpret; 

	class Core {
		private static $router;

		public static function init(){
			Core::$router = new Interpret();
			Core::$router->routeCommand();
		}
	}

	Core::init();