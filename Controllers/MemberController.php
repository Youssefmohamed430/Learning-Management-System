<?php

require_once 'C:\xampp\htdocs\Learning-Management-System\Controllers\DBController.php';

    class MemberController
    {
        protected $db;

        public function GetAllMembers() 
        {
            $this->db = new DbController;
            if($this->db->openConnection()) 
            {
                $query = "SELECT * FROM users WHERE RoleName = 'Faculty'";

                $result = $this->db->select($query);
                if($result === false)
                {
                    return false;
                }
                else
                {
                    return $result;
                }
            }
        }   
    }
?>