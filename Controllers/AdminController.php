<?php
    // require_once '../Models/User.php';
    require_once 'C:\xampp\htdocs\Learning-Management-System\Models\User.php';
    require_once 'C:\xampp\htdocs\Learning-Management-System\Controllers\AdminController.php';
    require_once 'C:\xampp\htdocs\Learning-Management-System\Controllers\DBController.php';


    class AdminController
    {
        protected $db;

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
            if(!IsUserNameValid($Admin->UserName))
                return "User Name must at least 3 letters";
            
            if(!IsPasswordValid($Admin->password))
                return "Password must at least 3 letters , first letter capital and contain numbers!";
            
            if(!IsEmailValid($Admin->password))
                return "InValid Email!";

            if($this->db->openConnection())
            {
                $query = "INSERT INTO 'users' VALUES
                ('','$Admin->Name','$Admin->UserName','$Admin->Password','$Admin->Email','$Admin->RoleName')";
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
        public function IsUserNameValid($Username) { return strlen($username) > 3 ; }

        public function IsEmailValid($Email) { return filter_var($email, FILTER_VALIDATE_EMAIL); }

        public function IsPasswordValid($Password) 
        { return strlen($Password) > 3 && ctype_upper($Password[0]) && strpbrk($Password, '0123456789'); }
    }
?>