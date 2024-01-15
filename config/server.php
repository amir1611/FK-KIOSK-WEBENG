<?php
    class ConfigServer {
        public $server_path;
        public $dir_name;
        public $deploy = true;
        public $server_host;

        public function __construct() {
            if ($this->deploy) {
                $this->server_path =  $_SERVER['PHP_SELF'];
                $this->dir_name = dirname(dirname($this->server_path));
                $this->server_host = "http://" . $_SERVER['HTTP_HOST'] . $this->dir_name;
            } else {
        
                $this->server_host = "http://" . $_SERVER['HTTP_HOST'];
            }

            return $this->server_host;
        }

        function getServerHost() {
            return $this->server_host;
        }

        function threeLayerDir() {
            $this->dir_name = dirname(dirname(dirname($this->server_path)));
            $this->server_host = "http://" . $_SERVER['HTTP_HOST'] . $this->dir_name;
            return $this->server_host;
        }
    }
?>