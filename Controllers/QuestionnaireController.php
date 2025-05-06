<?php

require_once 'DBController.php';

    class QuestionnaireController
    {
        protected $db;

        public function AddQuestionnaire($type)
        {
            $this->db = new DbController;

            if($this->db->openConnection())
            {
                $qry = "INSERT INTO Questionnaire VALUES (
                '', '$type')";

                $result = $this->db->insert($qry);

                if($result !== false)
                    return $result;
                else
                    return false;
            }
        }

        public function AssignQuestionsToQuestionnaire($QuestionnaireId,$arrayquestions,$numberOfQuestions)
        {
            $this->db = new DbController;

            if($this->db->openConnection())
            {
                foreach($arrayquestions as $question)
                {
                    $qry = "INSERT INTO evalquestion VALUES ('','$question','$QuestionnaireId')";
                    $result = $this->db->insert($qry);
                    if($result === false)
                        return false;
                }
            }
        }
    }
?>