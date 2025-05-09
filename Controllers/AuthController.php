<?php
require_once 'DBController.php';
    class AuthController
    {
        protected $db;

        public function LogIn($Username,$Password)
        {
            session_start();
            $this->db = new DbController;

            if($this->db->openConnection())
            {
                $qry = " SELECT * FROM users WHERE UserName = '$Username' AND Password = '$Password'";
                $result = $this->db->select($qry);
                if($result === false)
                {
                    $_SESSION["errMsg"]="Error at query";
                    $this->db->closeConnection();
                    return false;
                }
                if(Count($result) == 0)
                {
                    $_SESSION["errMsg"]="You have entered wrong email or password";
                    $this->db->closeConnection();
                    return false;
                }
                $_SESSION["Id"] = $result[0]["Id"];
                $_SESSION["Name"] = $result[0]["Name"];
                $_SESSION["role"] = $result[0]["RoleName"];
                return true ;
            }
        }

        public function Logout() {
            $_SESSION = array(); 
            session_destroy();
        }
    }
?>