<?php
	namespace CopperBot\System;
	
	use CopperBot\System\Router\Interpret; 

	class Core {
		private static $router;

		public static function init(){
			$this->router = new Interpret();
			$this->router->routeCommand();
		}
	}