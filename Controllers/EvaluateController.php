<?php
require_once 'DBController.php';

class EvaluateController{
    protected $db;

    public function AddEvaluate($Evaluate) 
{
    $this->db = new DBController;

    if ($this->db->openConnection()) {

        $Comment = $Evaluate->getComment();
        $Date = addslashes($Evaluate->getDate());
        $EvaluatorId = (int)$Evaluate->getEvaluatorId();
        $QuestionnaireId = $Evaluate->getQuestionnaireId();
        $Evaluatee = (int)$Evaluate->getEvaluateeId();

        $query = "INSERT INTO evaluation 
        (Comment, Date, evaluator_id, QuestionnaireId, evaluatee_id)
        VALUES 
        ('$Comment', '$Date', '$EvaluatorId', '$QuestionnaireId', '$Evaluatee')";

        $result = $this->db->insert($query);

        if ($result === false) {
            echo "Error in Query";
        } else {
            return "";
        }
    }
}

    public function getAllEvaluations($id){
        $this->db = new DbController;
            if($this->db->openConnection()) 
            {
                $query = "SELECT * 
                FROM evaluation where evaluation.evaluator_id = '$id' ";

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
    public function EditEvaluate($Evaluate,$EvlId)
        {
            $this->db = new DBController;
            if($this->db->openConnection())
            {

                $Comment = $Evaluate->getComment();
                $Date = $Evaluate->getDate();
                $EvaluatorId = (int)$Evaluate->getEvaluatorId();
                $QuestionnaireId = $Evaluate->getQuestionnaireId();
                $Evaluatee = (int)$Evaluate->getEvaluateeId();
                $Date = addslashes($Evaluate->getDate());

                $Updatequery = "UPDATE evaluation SET 
                Comment = '$Comment',
                Date = '$Date',
                evaluator_Id = '$EvaluatorId',
                QuestionnaireId = '$QuestionnaireId',
                evaluatee_Id = '$Evaluatee'
                WHERE EvaluationId = '$EvlId'";

                $result = $this->db->Update($Updatequery);

                if($result === false)
                {
                    echo "Error in Query";
                    return false;
                }
                else
                {
                    return "";
                }
            }
        }
        public function DeleteEvaluate($Evaluate) 
    {
        $this->db = new DBController;
        if($this->db->openConnection())
        {
            $queryDelete = "DELETE FROM evaluation WHERE EvaluationId = '$Evaluate'";

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