<?php
    class Admin extends User 
    {
        private $UserId;
    
        public function getUserId() { return $this->UserId; }
        public function setUserId($UserId) { $this->UserId = $UserId; }
    }
?>