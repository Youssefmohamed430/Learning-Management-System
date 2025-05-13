<?php

require_once 'DBController.php';
require_once __DIR__ .'/../Models/Notifications.php';
require_once 'NotificationController.php';

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
        public function GetFacultyFeedbacks($facultyId)
        {
            $this->db = new DBController;
            if($this->db->openConnection())
            {
                // Get all evaluations where faculty member is  evaluatee
                $query = "SELECT 
                            e.EvaluationId, 
                            e.Comment, 
                            e.Date, 
                            u.Name as EvaluatorName,
                            q.Type as QuestionnaireType
                        FROM evaluation e
                        JOIN users u ON e.evaluator_id = u.Id
                        JOIN questionnaire q ON e.QuestionnaireId = q.QuestionnaireId
                        WHERE e.evaluatee_id = '$facultyId'
                        ORDER BY e.Date DESC";
                
                $evaluations = $this->db->select($query);
                
                // get the question response for eache eval
                if($evaluations !== false && count($evaluations) > 0) {
                    foreach($evaluations as &$eval) {
                        $evalId = $eval['EvaluationId'];
                        $responseQuery = "SELECT 
                                            r.ResponseId, 
                                            r.Rating, 
                                            r.ResponseText, 
                                            q.Text as QuestionText
                                        FROM questionresponse r
                                        JOIN evalquestion q ON r.questionId = q.QuestionId
                                        WHERE r.evaluationId = '$evalId'";
                        
                        $responses = $this->db->select($responseQuery);
                        $eval['Responses'] = $responses !== false ? $responses : [];
                    }
                }
                
                return $evaluations !== false ? $evaluations : [];
            }
            return [];
        }

        public function getAllQuestionnairesCoteacher(){
            $this->db = new DBController;
            if($this->db->openConnection()) 
            {
                $query = "SELECT * FROM `evalquestion` JOIN questionnaire
                ON evalquestion.questionnaireId = questionnaire.QuestionnaireId
                WHERE questionnaire.Type = 'Co Teacher'";

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

    public function GetQuestions()
        {
            $this->db = new DbController; 
            
            if($this->db->openConnection())
            {
                $qry = "SELECT * 
                        FROM evalquestion eq 
                        JOIN questionnaire q ON eq.questionnaireId = q.QuestionnaireId 
                        WHERE q.Type = 'Teacher-Eval'";
                
                $result = $this->db->select($qry);
                
                if($result !== false)
                    return $result;
                else
                    return false;
            }
            return false;
        }

        public function AddFeedback($responsesarray,Evaluation $evalmodel)
        {
            $this->db = new DbController;
            
            if($this->db->openConnection())
            {
                $qry = "INSERT INTO evaluation VALUES ('','".$evalmodel->getComment()."',
                '".$evalmodel->getDate()."','".$evalmodel->getEvaluatorId()."',
                '".$evalmodel->getQuestionnaireId()."','".$evalmodel->getEvaluateeId()."')";
                $result = $this->db->insert($qry);

                foreach($responsesarray as $response)
                {
                    $query = "INSERT INTO questionresponse VALUES ('','".$response->getResponseText()."','$result'
                    ,'".$response->getQuestionId()."', '".$response->getRating()."')";

                    $responseresult = $this->db->insert($query);

                    if($responseresult === false)
                        return false;
                }
            }
            $querynotif = "SELECT Name From users Where Id = '".$evalmodel->getEvaluatorId()."'";
            $selectresult = $this->db->select($querynotif);

            $notification = new Notifications;
            $notification->setMessage("You have been rated by ".$selectresult[0]["Name"]);
            $notification->setDateSent(date("Y-m-d"));
            $notification->setReceiverId($evalmodel->getEvaluateeId());

            $notifcontroller = new NotificationController;
            $notifcontroller->AddNotification($notification);
            return "";
        }
        public function AddQuestionnaireCoTeacher($responsesarray,$EvaluationId){
            $this->db = new DbController;
            
            if($this->db->openConnection())
            {
                $result = True;
                foreach($responsesarray as $response)
                {                
                    $query = "INSERT INTO questionresponse VALUES ('','".$response->getRating()."','$EvaluationId'
                    ,'".$response->getQuestionId()."', '".$response->getResponseText()."')";

                    $responseresult = $this->db->insert($query);

                    if($responseresult === false){
                        $result = False;
                        return false;
                    }
                    else{
                        return "";
                    }
                }
            }
            
        }
    }

?>