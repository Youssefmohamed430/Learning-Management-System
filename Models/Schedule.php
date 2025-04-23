<?php
    class Schedule {
        private $SchId;
        private $EventType; // exam or course
        private $Date;
        private $CrsId;
        private $FactulyId;
    
        public function getSchId() { return $this->SchId; }
        public function setSchId($SchId) { $this->SchId = $SchId; }
    
        public function getEventType() { return $this->EventType; }
        public function setEventType($EventType) { $this->EventType = $EventType; }
    
        public function getDate() { return $this->Date; }
        public function setDate($Date) { $this->Date = $Date; }
    
        public function getCrsId() { return $this->CrsId; }
        public function setCrsId($CrsId) { $this->CrsId = $CrsId; }
    
        public function getTeacherId() { return $this->FactulyId; }
        public function setTeacherId($FactulyId) { $this->FactulyId = $FactulyId; }
    }
?>