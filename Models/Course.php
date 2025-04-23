<?php
    class Course {
        private $CrsId;
        private $CrsName;
        private $Description;

    
        public function getCrsId() { return $this->CrsId; }
        public function setCrsId($CrsId) { $this->CrsId = $CrsId; }
    
        public function getCrsName() { return $this->CrsName; }
        public function setCrsName($CrsName) { $this->CrsName = $CrsName; }
    
        public function getTeacherId() { return $this->FacultyId; }
        public function setTeacherId($FacultyId) { $this->FacultyId = $FacultyId; }
    
        public function getDescription() { return $this->Description; }
        public function setDescription($Description) { $this->Description = $Description; }
    }    
?>