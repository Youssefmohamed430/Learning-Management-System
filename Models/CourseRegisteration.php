<?php
    class CourseRegisteration {
        private $CrsId;
        private $StudId;
        private $Grade;
    
        public function getCrsId() { return $this->CrsId; }
        public function setCrsId($CrsId) { $this->CrsId = $CrsId; }
    
        public function getStudId() { return $this->StudId; }
        public function setStudId($StudId) { $this->StudId = $StudId; }
    
        public function getGrade() { return $this->Grade; }
        public function setGrade($Grade) { $this->Grade = $Grade; }
    }
    
?>