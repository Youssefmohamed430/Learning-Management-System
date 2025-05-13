<?php
require_once 'DBController.php';

class QuestionsController{

    protected $db;

    public function AddQuestion($Question , $EXId){
            $this->db = DBController::getInstance();

    if ($this->db->openConnection()) {

        $QId = $Question->getQId();
        $Text = $Question->getText();
        $CorrectAnswer = $Question->getCorrectAnswer();
        $ExamId = $EXId;

        $query = "INSERT INTO questions VALUES 
                ('', '$Text' ,'$CorrectAnswer' , '$ExamId')";
        $result = $this->db->insert($query);

        if ($result === false) {
            echo "Error in Query";
        } else {
            return "";
        }
    } else {
        echo "Connection Failed";
    }
    }

    public function getAllQuestion($ExamId){
            $this->db = DBController::getInstance();
            if($this->db->openConnection()) 
            {
                $query = "SELECT questions.QuestionId , questions.Text, questions.CorrectAnswer 
                FROM questions 
                JOIN exam ON exam.ExamId = questions.ExamId 
                WHERE questions.ExamId = $ExamId";

                $result = $this->db->select($query);
                if($result === false)
                {
                    return false;
                }
                else
                {
                    return $result;
                }   
            }
    }
    public function DeleteQuestion($QId) 
    {
            $this->db = DBController::getInstance();
        if($this->db->openConnection())
        {
            $queryDelete = "DELETE FROM questions WHERE questions.QuestionId = '$QId'";

            $result = $this->db->delete($queryDelete);
            if($result === false)
            {
                echo "Error in Query";
            }
            else
            {
                return "";
            }
        }
    }

}

?>
