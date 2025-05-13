<?php
require_once 'DBController.php';

    class StudentAnswerController
    {
        protected $db;



        public function setAnswerToQuestion($Answer)
        {
            $this->db = new DBController;
            if($this->db->openConnection())
            {
                $Is_Correct = $this->isCorrect($Answer);
                $QID = $this->$Answer['QuestionId'];
                $ExamId = $this->$Answer['ExamId'];
                $query = "INSERT INTO studentanswer
                values ('' , $Answer , $Is_Correct , $QID , $ExamId)";

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

        public function isCorrect($Answer)
        {
            $this->db = new DBController;
            if($this->db->openConnection())
            {
                $query = "SELECT questions.QuestionId, questions.ExamId, questions.CorrectAnswer, studentanswer.Answer FROM questions JOIN studentanswer on questions.QuestionId = studentanswer.QuestionId;";

                $result = $this->db->select($query); 

                if($result === false)
                {
                    echo "Error in Query";
                    return false;
                }
                elseif ($result[0]['CorrectAnswer'] === $result[0]['Answer']) {
                    return $result;
                }else {
                    return false;
                }
            }
        }


    }



?>