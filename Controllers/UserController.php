<?php
// require_once '../Models/User.php';
    require_once __DIR__ . '/../Models/User.php';
    abstract class UserController
    {
        private $db;

        abstract public function AddUser(User $User);

        abstract public function UpdateUser(User $User);

        abstract public function ShowUserData($id);

        public function DeleteUser($userId)
        {
            $this->db = DBController::getInstance();
            if($this->db->openConnection())
            {
                $queryDeleteUser = "DELETE FROM users WHERE Id = '" . $userId . "'";
                $result = $this->db->delete($queryDeleteUser);
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

        public function GetAll($Role) 
        {
            $this->db = DBController::getInstance();
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
        public function getAllUser() {
            $this->db = DBController::getInstance();

            if ($this->db->openConnection()) {
            $query = "SELECT * FROM `users` WHERE RoleName = 'Faculty';";

            $result = $this->db->select($query);

            if ($result === false) {
                return false;
            } else {
                return $result;
            }
        }
}

    }
?>