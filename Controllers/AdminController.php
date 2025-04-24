<?php
    // require_once '../Models/User.php';
    require_once 'C:\xampp\htdocs\Learning-Management-System\Models\User.php';
    require_once 'C:\xampp\htdocs\Learning-Management-System\Controllers\AdminController.php';
    require_once 'C:\xampp\htdocs\Learning-Management-System\Controllers\DBController.php';


    class AdminController
    {
        protected $db;
        public function IsUserNameValid(string $Username){ return strlen($Username) > 3 ; }

        public function IsUserNameToken(string $Username)
        {
            $this->db = new DBController;
            if($this->db->openConnection()) 
            {
                $query = "SELECT * FROM users WHERE username = '$Username'";
                $result=$this->db->select($query);
                return Count($result) > 0;
            }
        }

        public function IsEmailValid($Email) { return filter_var($Email, FILTER_VALIDATE_EMAIL); }

        public function IsPasswordValid($Password) 
        { return strlen($Password) > 3 && ctype_upper($Password[0]) && strpbrk($Password, '0123456789'); }

        public function GetAll($Role) 
        {
            $this->db = new DBController;
            if($this->db->openConnection()) 
            {
                $query = "SELECT * FROM users WHERE RoleName = '" . $Role . "'";
                $result=$this->db->select($query);
                if($result === false)
                {
                    echo "Error in Query";
                    return false;
                }
                else
                {
                    return $result;
                }
            }
        }

        public function AddAdmin($Admin)
        {
            $this->db = new DBController;
            if(!$this->IsUserNameValid($Admin->getUsername()))
                return "User Name must at least 3 letters";

            if($this->IsUserNameToken($Admin->getUsername()))
                return "User Name Is Already registerd";
            
            if(!$this->IsPasswordValid($Admin->getPassword()))
                return "Password must at least 3 letters , first letter capital and contain numbers!";
            
            if(!$this->IsEmailValid($Admin->getEmail()))
                return "InValid Email!";

            if($this->db->openConnection())
            {
                $query = "INSERT INTO users VALUES 
                ('', '" . $Admin->getName() . "', '" . $Admin->getUsername() . "'
                ,'" . $Admin->getPassword() . "','" . $Admin->getEmail() . "'
                ,'" . $Admin->getRoleName() . "')";

                $result=$this->db->insert($query);

                if($result === false)
                {
                    echo "Error in Query";
                }
                else
                {
                    return "";
                }
            }
        }
        
    }
?>