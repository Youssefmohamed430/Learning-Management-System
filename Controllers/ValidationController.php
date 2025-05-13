<?php
    class ValidationController
    {
        private $db; 

        public function IsUserNameValid(string $Username) { return strlen($Username) > 3 ; }

        public function IsUserNameToken(string $Username)
        {
            $this->db = DBController::getInstance();
            if($this->db->openConnection()) 
            {
                $query = "SELECT * FROM users WHERE username = '$Username'";
                $result=$this->db->select($query);
                return Count($result) > 0;
            }
        }

        public function IsSSnToken(string $Ssn)
        {
            $this->db = DBController::getInstance();
            if($this->db->openConnection()) 
            {
                $query = "SELECT * FROM facultymember WHERE SsNo = '$Ssn'";
                $result=$this->db->select($query);
                return Count($result) > 0;
            }
        }

        public function IsEmailValid($Email) { return filter_var($Email, FILTER_VALIDATE_EMAIL); }

        public function IsPasswordValid($Password)
        { return strlen($Password) > 3 && ctype_upper($Password[0]) && strpbrk($Password, '0123456789'); }
        
        public function NumberOfCourses($StuId){
            $this->db = DBController::getInstance();
            if($this->db->openConnection()) 
            {
                $query = "SELECT * FROM courseregisteration WHERE StuId = '$StuId'";
                $result=$this->db->select($query);
                return Count($result) > 0;
            }
        }
    }
?>