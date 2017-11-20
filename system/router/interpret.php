<?php
    namespace CopperBot\System\Router;

    private $headers;
    private $baseUrl;

    class Interpret {
        public function __construct(){
            $baseHeaders = [
                "Access-Control-Allow-Origin" => "*",
                "Access-Control-Allow-Headers" => "Origin, X-Requested-With, Content-Type, Accept, Authorization",
                "Access-Control-Allow-Methods" => "GET, POST, PUT, DELETE"
            ];
            $this->setHeaders($baseHeaders);
        }

        private function setHeaders($headers){
            if(gettype($headers) !== "string"){
                array_push($this->$headers);
            }
            else {
                foreach($headers as $head){
                    $this->headers[] = $head;
                }
            }
        }

        private function getBaseUrl(){
            $currentPath = $_SERVER['PHP_SELF'];
            $pathInfo = pathinfo($currentPath); 
            $hostName = $_SERVER['HTTP_HOST']; 
            $protocol = (isset($_SERVER['HTTPS'])) ? 'https' : 'http';
            if($pathInfo['dirname'] == '/') {
                $pathInfo['dirname'] = '';
            }
            return htmlspecialchars(implode([$protocol, '://', $hostName, $pathInfo['dirname']]), ENT_QUOTES, 'UTF-8');
        }

        public function routeCommand(){
            $request = $this->getBaseUrl() . "/" . $_SERVER['REQUEST_URI'];
            if(!preg_match("#^/command$#", $request)){
                throw new Exception("URL non reconnue");
            }
            $cmdString = file_get_contents("../config/actions.json");
            $commands = json_decode($cmdString, true);
            $request = explode($_POST["command"], " ");
            foreach($commands as $command => $content){
                if($request[0] === $command){
                    echo $content;
                }
            }

        }

        public function passToCommand($command){
            try{
                $this->routeCommand();
            }
            catch(Exception $e){
                echo $e->getMessage();
            }
            foreach($this->headers as $key, $value){
                header($key . ":" . $value);
            }
            header("location:" . $this->getBaseUrl() . "/" . $redir);
        }
    }