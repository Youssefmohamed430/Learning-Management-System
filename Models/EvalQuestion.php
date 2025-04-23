<?php
    class EvalQuestion {
        private $QuestionId;
        private $Text;
        private $questionnaireId;
    
        public function getQuestionId() { return $this->QuestionId; }
        public function setQuestionId($QuestionId) { $this->QuestionId = $QuestionId; }
    
        public function getText() { return $this->Text; }
        public function setText($Text) { $this->Text = $Text; }
    
        public function getQuestionnaireId() { return $this->questionnaireId; }
        public function setQuestionnaireId($questionnaireId) { $this->questionnaireId = $questionnaireId; }
    }
    
?>