<?php

require_once 'C:\xampp\htdocs\Learning-Management-System\Controllers\DBController.php';

    class CoursesController
    {
        protected $db;

        public function IsAssignedToAnotherMember($courseId,$MemberId)
        {
            $this->db = new DbController;
            if($this->db->openConnection()) 
            {
                $qry = "SELECT * FROM course WHERE CrsId = '$courseId' AND FacultyId = '$MemberId'";
                $result = $this->db->select($qry);
                return Count($result) > 0;
            }
        }

        public function GetAllCourses() 
        {
            $this->db = new DbController;
            if($this->db->openConnection()) 
            {
                $query = "SELECT CrsId,CrsName,Description,Name FROM course JOIN users ON FacultyId = Id";

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
        
        public function AssignCoursetoMember($course) 
        {
            if($this->IsAssignedToAnotherMember($course->getCrsId(),$course->getTeacherId()))
                return "This Course is already Assigned";

            $this->db = new DbController;
            if($this->db->openConnection()) 
            {
                $crsid = $course->getCrsId();
                $facultyid = $course->getTeacherId();

                $query = "UPDATE course SET FacultyId = '$facultyid' WHERE CrsId = '$crsid' ";

                $result = $this->db->Update($query);
                
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
    }
?>