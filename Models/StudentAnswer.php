<?php
    class StudentAnswer {
        private $AnswerId;
        private $Answer;
        private $IsCorrect;
        private $QuestionId;
        private $ExamId;

        public function getAnswerId() { return $this->AnswerId; }
        public function setAnswerId($AnswerId) { $this->AnswerId = $AnswerId; }

        public function getAnswer() { return $this->Answer; }
        public function setAnswer($Answer) { $this->Answer = $Answer; }

        public function getIsCorrect() { return $this->IsCorrect; }
        public function setIsCorrect($IsCorrect) { $this->IsCorrect = $IsCorrect; }

        public function getQuestionId() { return $this->QuestionId; }
        public function setQuestionId($QuestionId) { $this->QuestionId = $QuestionId; }

        public function getExamId() { return $this->ExamId; }
        public function setExamId($ExamId) { $this->ExamId = $ExamId; }
    }
?>