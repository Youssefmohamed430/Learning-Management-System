<?php
    class FacultyMember {
        private $UserId;
        private $SsNo;
    
        public function getUserId() { return $this->UserId; }
        public function setUserId($UserId) { $this->UserId = $UserId; }
    
        public function getSsNo() { return $this->SsNo; }
        public function setSsNo($SsNo) { $this->SsNo = $SsNo; }
    }
?>