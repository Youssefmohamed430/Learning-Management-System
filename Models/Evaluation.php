<?php
    class Evaluation {
        private $EvaluationId;
        private $Comment;
        private $Rating;
        private $Date;
        private $evaluator_id; // اللي بيقيم
        private $evaluatee_id; // اللي بيتقيم
        private $QuestionnaireId;

        function __construct($comment,$date,$evaluator_id,$evaluatee_id,$QuestionnaireId) {
            $this->Comment = $comment;
            $this->Date = $date;
            $this->evaluator_id = $evaluator_id;
            $this->evaluatee_id = $evaluatee_id;
            $this->QuestionnaireId = $QuestionnaireId;
        }


        public function getEvaluationId() { return $this->EvaluationId; }

        public function getComment() { return $this->Comment; }

        public function getDate() { return $this->Date; }

        public function getEvaluatorId() { return $this->evaluator_id; }

        public function getQuestionnaireId() { return $this->QuestionnaireId; }

        public function getEvaluateeId() { return $this->evaluatee_id; }
    }
?>