<?php
    class DbController
    {
        private static $instance = null;
        public $dbHost="localhost";
        public $dbUser="root";
        public $dbPassword="";
        public $dbName="LMSDb";
        public $connection;


        private function __construct() {
        $this->connection = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

        public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new DbController();
        }

        return self::$instance;
    }


        public function openConnection()
        {
            return $this->connection;
        }

        public function closeConnection()
        {
            if($this->connection)
            {
                $this->connection->close();
            }
            else
            {
                echo "Connection is not opened";
            }
        }

        public function __clone() {}

        public function __wakeup() {}

        public function select($qry)
        {
            $result=$this->connection->query($qry);
            if(!$result)
            {
                echo "Error : ".mysqli_error($this->connection);
                return false;
            }
            else
            {
                return $result->fetch_all(MYSQLI_ASSOC);
            }

        }
        public function insert($qry)
        {
            $result=$this->connection->query($qry);
            if(!$result)
            {
                echo "Error : ".mysqli_error($this->connection);
                return false;
            }
            else
            {
                return mysqli_insert_id($this->connection);
            }
        }
        
        public function delete($qry)
        {
            $result=$this->connection->query($qry);
            if(!$result)
            {
                echo "Error : ".mysqli_error($this->connection);
                return false;
            }
            else
            {
                return $result;
            }
        }
        public function Update($qry)
        {
            $result=$this->connection->query($qry);
            if(!$result)
            {
                echo "Error : ".mysqli_error($this->connection);
                return false;
            }
            else
            {
                return true;
            }
        }
    }
?>