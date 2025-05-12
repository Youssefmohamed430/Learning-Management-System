<?php
require_once 'DBController.php';

    class ScheduleController
    {
        protected $db;
        public $validationController;
        

        function __construct() {
            $this->validationController = new ValidationController;
        }

        public function SetSchedule($schedulemodel)
        {
            $this->db = new DBController;
            $date = $schedulemodel->getdate();
            $crsid = $schedulemodel->getCrsId();
            $evnttype = $schedulemodel->getEventType();
            $memberid = $schedulemodel->getTeacherId();

            if($this->db->openConnection())
            {
                $query = "INSERT INTO schedule VALUES ('','$evnttype','$date','$crsid','$memberid')";

                $result = $this->db->insert($query); 

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
        public function getCalender($studentid)
        {
            if(!$this->validationController->NumberOfCourses($studentid))
            {
                session_start();
                $_SESSION["errmsg"] = "Must Number of Courses More than 0";
                return false;
            }
            $this->db = new DBController;
            if($this->db->openConnection())
            {
                $query = "SELECT schedule.EventType, schedule.Date,course.CrsName ,users.Name 
                FROM student JOIN courseregisteration ON student.UserId = courseregisteration.StuId 
                JOIN course on courseregisteration.CrsId = course.CrsId 
                JOIN schedule on course.CrsId = schedule.CrsId 
                JOIN users on users.Id = schedule.FactulyId 
                WHERE student.UserId = '$studentid'";

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


    }



?>