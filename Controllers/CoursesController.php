<?php

require_once 'DBController.php';

    class CoursesController
    {
        protected $db;

        public function IsAssignedToAnotherMember($courseId)
        {
            $this->db = new DbController;
            if ($this->db->openConnection())
            {
                $qry = "SELECT FacultyId FROM course WHERE CrsId = '$courseId'";
                $result = $this->db->select($qry);

                if (!empty($result) && $result[0]["FacultyId"] !== null) {
                    return true;
                }
                return false;
            }
            return false;
        }

        public function GetAllCourses() 
        {
            $this->db = new DbController;
            if($this->db->openConnection()) 
            {
                $query = "SELECT CrsId,CrsName,Description,Name FROM course Left JOIN users ON FacultyId = Id";

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

        public function GetCourse($CrsId) 
        {
            $this->db = new DbController;
            if($this->db->openConnection()) 
            {
                $query = "SELECT CrsId,CrsName,Description,Name FROM course Left JOIN users ON FacultyId = Id WHERE CrsId = '$CrsId'";

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
                    return "Error";
                }
                else
                {
                    return "";
                }
            }
        }

        public function DeleteCourse($crsid) 
        {
            $this->db = new DBController;
            if($this->db->openConnection())
            {
                $queryDeletecourse = "DELETE FROM course WHERE CrsId = '$crsid'";

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

        public function AddCourse($course)
        {
            $this->db = new DBController;

            if($this->db->openConnection())
            {
                $name = $course->getCrsName();
                $desc = $course->getDescription();
                $query = "INSERT INTO course VALUES 
                ('', '$name', NULL ,'$desc')";

                $result=$this->db->insert($query);

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

        public function EditCourse($Coursemodel,$membername)
        {
            $this->db = new DBController;
            if($this->db->openConnection())
            {
                $queryId = "SELECT Id FROM users WHERE Name = '$membername'";
                $memberId = $this->db->select($queryId);

                if ($memberId === false || empty($memberId)) {
                    return "Please write the correct name";
                }
        
                if (!isset($memberId[0]["Id"])) {
                    return "No valid member ID found for the given name";
                }

                $name = $Coursemodel->getCrsName();
                $desc = $Coursemodel->getDescription();
                $id = $Coursemodel->getCrsId();

                $Updatequery = "UPDATE course SET 
                    CrsName = '$name',
                    Description = '$desc',
                    FacultyId = '".$memberId[0]["Id"]."'
                    WHERE CrsId = '$id' ";

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
    }
?>