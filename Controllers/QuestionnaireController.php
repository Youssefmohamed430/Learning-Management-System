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

        public function AssignQuestionsToQuestionnaire($QuestionnaireId,$arrayquestions)
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

        public function GetQuestions()
        {
            $this->db = new DbController;
            
            if($this->db->openConnection())
            {
                $qry = "SELECT eq.QuestionId, eq.Text 
                        FROM evalquestion eq 
                        JOIN questionnaire q ON eq.questionnaireId = q.QuestionnaireId ";
                
                $result = $this->db->select($qry);
                
                if($result !== false)
                    return $result;
                else
                    return false;
            }
            return false;
        }

        public function AddFeedback($response, $rating)
        {
            $this->db = new DbController;
            
            if($this->db->openConnection())
            {   
                foreach($response as $res)
                {
                    $qry = "INSERT INTO questionresponse ( Response, Rating) VALUES ('$res', '$rating')";

                $result = $this->db->insert($qry);

                if($result !== false)
                        return $result;
                    else
                        return false;
                }
            }
            return false;   
        }
    }

?>
