<?php

    class Connection_DB {
        private $serverName = 'localhost';
        private $userName = 'root';
        private $passwordUser = '';
        private $databaseName = 'php_mysql_crud';
        private $options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC);
        protected $connection;

        public function connect() {
            try {
                $this->connection = new PDO("mysql:host={$this->serverName};dbname={$this->databaseName}", $this->userName, $this->passwordUser, $this->options);
                return $this->connection;
            } catch (PDOException $pe) {
                die("Could not connect to the database {$this->databaseName}: ".$pe->getMessage());
            }
        }

        public function disconnect() {
            $this->connection = null;
        }
    }