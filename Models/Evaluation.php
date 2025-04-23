<?php
    class Evaluation {
        private $EvaluationId;
        private $Comment;
        private $Date;
        private $evaluator_id; // اللي بيقيم
        private $QuestionnaireId;
        private $evaluatee_id; // اللي بيتقيم

        public function getEvaluationId() { return $this->EvaluationId; }
        public function setEvaluationId($EvaluationId) { $this->EvaluationId = $EvaluationId; }

        public function getComment() { return $this->Comment; }
        public function setComment($Comment) { $this->Comment = $Comment; }

        public function getDate() { return $this->Date; }
        public function setDate($Date) { $this->Date = $Date; }

        public function getEvaluatorId() { return $this->evaluator_id; }
        public function setEvaluatorId($evaluator_id) { $this->evaluator_id = $evaluator_id; }

        public function getQuestionnaireId() { return $this->QuestionnaireId; }
        public function setQuestionnaireId($QuestionnaireId) { $this->QuestionnaireId = $QuestionnaireId; }

        public function getEvaluateeId() { return $this->evaluatee_id; }
        public function setEvaluateeId($evaluatee_id) { $this->evaluatee_id = $evaluatee_id; }
    }
?>