<?php
require_once 'DBController.php';

    class StudentAnswerController
    {
        protected $db;



        public function setAnswerToQuestion($questionId)
        {
            $this->db = DBController::getInstance();
            if($this->db->openConnection())
            {
                $query = "";

                $result = $this->db->select($query); 

                if($result === false)
                {
                    echo "Error in Query";
                    return false;
                }
                else
                {
                    return $result;
                }
            }
        }

        public function isCorrect($questionId)
        {
            $this->db = DBController::getInstance();
            if($this->db->openConnection())
            {
                $query = "SELECT questions.CorrectAnswer, studentanswer.Answer FROM questions JOIN studentanswer on questions.QuestionId = studentanswer.QuestionId;";

                $result = $this->db->select($query); 

                if($result === false)
                {
                    echo "Error in Query";
                    return false;
                }
                elseif ($result[0]['CorrectAnswer'] === $result[0]['Answer']) {
                    return true;
                }else {
                    return false;
                }
            }
        }
    }
?>