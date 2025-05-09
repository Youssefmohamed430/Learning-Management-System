<?php
    class Question {
        private $QuestionId;
        private $Text;
        private $CorrectAnswer;
        private $ExamId;
    
        public function getQId() { return $this->QId; }
        public function setQId($QId) { $this->QId = $QId; }
    
        public function getText() { return $this->Text; }
        public function setText($Text) { $this->Text = $Text; }
    
        public function getCorrectAnswer() { return $this->CorrectAnswer; }
        public function setCorrectAnswer($CorrectAnswer) { $this->CorrectAnswer = $CorrectAnswer; }
    
        public function getExamId() { return $this->ExamId; }
        public function setExamId($ExamId) { $this->ExamId = $ExamId; }
    }
    
?>