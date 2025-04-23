<?php
    class QuestionResponse {
        private $ResponseId;
        private $Rating;
        private $evaluationId;
        private $questionId;

        public function getResponseId() { return $this->ResponseId; }
        public function setResponseId($ResponseId) { $this->ResponseId = $ResponseId; }

        public function getRating() { return $this->Rating; }
        public function setRating($Rating) { $this->Rating = $Rating; }

        public function getEvaluationId() { return $this->evaluationId; }
        public function setEvaluationId($evaluationId) { $this->evaluationId = $evaluationId; }

        public function getQuestionId() { return $this->questionId; }
        public function setQuestionId($questionId) { $this->questionId = $questionId; }
    }
?>