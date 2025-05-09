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
        public function RegisterCourse($courseId, $stuId)
        {
            $this->db = new DBController;
            if($this->db->openConnection())
            {
                $isRegistered = $this->IsStudentRegistered($stuId, $courseId);
                if($isRegistered)
                {
                    return "You are already registered for this course";
                }
                $courseCount = $this->db->select("SELECT COUNT(*) as count FROM courseregisteration WHERE StuId = '$stuId'");
                
                if($courseCount !== false && $courseCount[0]['count'] >= 7) {
                    return "You have reached the maximum limit of 7 courses";
                }

                $query = "INSERT INTO courseregisteration (StuId,CrsId) VALUES ('$stuId','$courseId')";
                $result = $this->db->insert($query);
                if($result === false)
                {
                    return "Error";
                }
                else
                {
                    return "Course Registered Successfully";
                }
            }
        }
        public function IsStudentRegistered($stuId, $courseId)
        {
            $this->db = new DBController;
            if($this->db->openConnection())
            {
                $query = "SELECT * FROM courseregisteration WHERE StuId = '$stuId' AND CrsId = '$courseId'";
                $result = $this->db->select($query);
                return ($result !== false && !empty($result));
            }
            return false;
        }
    }
    
?>
        // zenhoum
    public function GetMYCourses($studentid) 
    {
        $this->db = new DbController;
        if($this->db->openConnection()) 
        {
            $query = "SELECT CrsName, Course.CrsId, Description FROM course JOIN courseregisteration ON course.CrsId=courseregisteration.CrsId JOIN student ON courseregisteration.StuId= student.UserId where student.UserId='$studentid';";

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
    
    public function GetCourseVideos($couseid){
        $this->db = new DbController;
        if($this->db->openConnection()) 
        {
            $query = "SELECT VideoPath FROM coursevideos join course ON coursevideos.CrsId=course.CrsId WHERE course.CrsId='$couseid';";

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
    
    public function UploadCourseVideo($videoModel)
        {
            $this->db = new DBController;
            if($this->db->openConnection())
            {
                $crsId = $videoModel->getCrsId();
                $videoPath = $videoModel->getVideoPath();
                
                $query = "INSERT INTO coursevideos (VideoPath, CrsId) VALUES ('$videoPath', '$crsId')";
                
                $result = $this->db->insert($query);
                
                if($result === false)
                {
                    return "Error uploading video";
                }
                else
                {
                    return "";
                }
            }
            return "Database connection error";
        }

        public function GetFacultyCourses($facultyId)
        {
            $this->db = new DBController;
            if($this->db->openConnection())
            {
                $query = "SELECT CrsId, CrsName FROM course WHERE FacultyId = '$facultyId'";
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
            return false;
        }
    }

?>
