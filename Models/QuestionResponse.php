<?php
    class QuestionResponse {
        private $ResponseId;
        private $evaluationId;
        private $questionId;
        private $ResponseText;

        public function getResponseId() { return $this->ResponseId; }
        public function setResponseId($ResponseId) { $this->ResponseId = $ResponseId; }

        public function getEvaluationId() { return $this->evaluationId; }
        public function setEvaluationId($evaluationId) { $this->evaluationId = $evaluationId; }

        public function getQuestionId() { return $this->questionId; }
        public function setQuestionId($questionId) { $this->questionId = $questionId; }

        public function getResponseText() { return $this->ResponseText; }
        public function setResponseText($ResponseText) { $this->ResponseText = $ResponseText; }
    }
?>