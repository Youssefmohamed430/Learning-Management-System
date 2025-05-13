<?php
require_once 'DBController.php';

    class StudentAnswerController
    {
        protected $db;



        public function setAnswersToQuestions($answersarray)
        {
            $this->db = DBController::getInstance();

            if($this->db->openConnection())
            {
                foreach($answersarray as $answer)
                {
                    $studanswer = $answer->getAnswer();
                    $Qid = (int)$answer->getQuestionId();
                    $exmid = (int)$answer->getExamId();
                    $iscorrect = $this->isCorrect($studanswer,$answer->getQuestionId());

                    $query = "INSERT INTO studentanswer VALUES ('','$studanswer','$iscorrect','$Qid', '$exmid')";

                    $result = $this->db->insert($query);

                    if($result === false)
                        return false;
                }
            }
        }

        public function isCorrect($studentAnswer, $questionId)
        {
            $this->db = DBController::getInstance();
            if ($this->db->openConnection()) {
                $query = "SELECT CorrectAnswer FROM questions WHERE QuestionId = '$questionId';";

                $result = $this->db->select($query);

                if ($result === false) {
                    echo "Error in Query";
                    return false;
                } elseif (empty($result)) {
                    echo "No question found with this ID";
                    return false;
                } else {
                    return $result[0]['CorrectAnswer'] === $studentAnswer;
                }
            }
            return false;
        }
    }
?>