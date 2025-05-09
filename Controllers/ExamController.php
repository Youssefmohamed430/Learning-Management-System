<?php
require_once 'DBController.php';
require_once __DIR__ . '/../Models/Exam.php';
class ExamController {
    protected $db;

    public function AddExam($Exam) 
{
    $this->db = new DBController;

    if ($this->db->openConnection()) {

        $Title = $Exam->getTitle();
        $Type = $Exam->getType();
        $Date = $Exam->getDate();
        $CrsId = $Exam->getCrsId();

        $Date = addslashes($Exam->getDate());

        $query = "INSERT INTO exam VALUES 
                ('', '$Title', '$Type' ,'$Date' , '$CrsId')";
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

    public function getAllExames(){
        $this->db = new DbController;
            if($this->db->openConnection()) 
            {
                $query = "SELECT exam.ExamId, exam.Title, exam.Type , course.CrsName FROM exam JOIN course ON exam.CrsId = course.CrsId";;

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
    public function GetExam($ExamId){
    $this->db = new DbController;
    if($this->db->openConnection()) 
    {
        $query = "SELECT ExamId, Title, Type, Date, CrsId 
        FROM exam 
        WHERE ExamId = '$ExamId'";

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

    public function getCourseExam($courseId)
    {
        $this->db = new DbController;
    if($this->db->openConnection()) 
    {
        $query = "SELECT ExamId, Title, Type, Date, CrsId 
        FROM exam 
        WHERE CrsId = '$courseId'";

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

    public function DeleteExam($ExamId) 
    {
        $this->db = new DBController;
        if($this->db->openConnection())
        {
            $queryDelete = "DELETE FROM exam WHERE ExamId = '$ExamId'";

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
