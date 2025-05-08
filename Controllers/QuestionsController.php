<?php
require_once 'DBController.php';

class QuestionsController{

    protected $db;

    public function AddQuestion($Question){
        $this->db = new DBController;

    if ($this->db->openConnection()) {

        $QId = $Question->getQId();
        $Text = $Question->getText();
        $CorrectAnswer = $Question->getCorrectAnswer();
        $ExamId = $Question->getExamId();

        $query = "INSERT INTO exam VALUES 
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
        $this->db = new DbController;
            if($this->db->openConnection()) 
            {
                $query = "SELECT questions.QuestionId , questions.Text, questions.CorrectAnswer 
                FROM exam 
                JOIN questions ON exam.ExamId = questions.ExamId 
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
    public function DeleteExam($QId) 
    {
        $this->db = new DBController;
        if($this->db->openConnection())
        {
            $queryDeletecourse = "DELETE FROM questions WHERE questions = '$QId'";
            $result = $this->db->delete($queryDeletecourse);
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
