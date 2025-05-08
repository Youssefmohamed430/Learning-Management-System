<?php
require_once 'DBController.php';

    class ScheduleController
    {
        protected $db;



        public function getCalender($studentid)
        {
            $this->db = new DBController;
            if($this->db->openConnection())
            {
                $query = "SELECT course.CrsName, course.Description, users.Name, courseregisteration.Grade 
                FROM student JOIN courseregisteration ON student.UserId = courseregisteration.StuId 
                JOIN course on courseregisteration.CrsId = course.CrsId JOIN facultymember ON facultymember.UserId = course.FacultyId 
                JOIN users on users.Id = facultymember.UserId WHERE student.UserId =  '" . $studentid . "'";

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