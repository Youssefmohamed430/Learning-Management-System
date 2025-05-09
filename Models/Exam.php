<?php
    class Exam {
        private $ExamId;
        private $Title;
        private $Type; //  pre or post exam
        private $Date;
        private $CrsId;
    
        public function getExamId() { return $this->ExamId; }
        public function setExamId($ExamId) { $this->ExamId = $ExamId; }
    
        public function getTitle() { return $this->Title; }
        public function setTitle($Title) { $this->Title = $Title; }
    
        public function getType() { return $this->Type; }
        public function setType($Type) { $this->Type = $Type; }
    
        public function getDate() { return $this->Date; }
        public function setDate($Date) { $this->Date = $Date; }
    
        public function getCrsId() { return $this->CrsId; }
        public function setCrsId($CrsId) { $this->CrsId = $CrsId; }
    }
?>