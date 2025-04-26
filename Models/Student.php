<?php
    class Student extends User
    {
        private $UserId;
        private $Age;
    
        public function getUserId() { return $this->UserId; }
        public function setUserId($UserId) { $this->UserId = $UserId; }
    
        public function getAge() { return $this->Age; }
        public function setAge($Age) { $this->Age = $Age; }
    }
    
?>