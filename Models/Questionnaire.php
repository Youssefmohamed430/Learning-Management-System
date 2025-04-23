<?php
    class Questionnaire {
        private $QuestionnaireId;
        private $Type;
    
        public function getQuestionnaireId() { return $this->QuestionnaireId; }
        public function setQuestionnaireId($QuestionnaireId) { $this->QuestionnaireId = $QuestionnaireId; }
    
        public function getType() { return $this->Type; }
        public function setType($Type) { $this->Type = $Type; }
    }    
?>