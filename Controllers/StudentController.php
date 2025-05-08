<?php
    require_once 'E:\Xampp\htdocs\Learning-Management-System\Controllers\ValidationController.php';
    require_once '../../../Controllers/UserController.php';
    require_once 'DBController.php';

    class StudentController extends UserController
    {

        
        protected $db;
        public $validationController;
        

        function __construct() {
            $this->validationController = new ValidationController;
        }

        public function AddUser($student)
        {
            $this->db = new DBController;
            if(!$this->validationController->IsUserNameValid($student->getUsername()))
                return "User Name must at least 3 letters";

            if($this->validationController->IsUserNameToken($student->getUsername()))
                return "User Name Is Already registerd";
            
            if(!$this->validationController->IsPasswordValid($student->getPassword()))
                return "Password must at least 3 letters , first letter capital and contain numbers!";
            
            if(!$this->validationController->IsEmailValid($student->getEmail()))
                return "InValid Email!";

            if($this->db->openConnection())
            {
                $queryInsertUser = "INSERT INTO users VALUES 
                ('', '" . $student->getName() . "', '" . $student->getUsername() . "'
                ,'" . $student->getPassword() . "','" . $student->getEmail() . "'
                ,'" . $student->getRoleName() . "')";

                $result = $this->db->insert($queryInsertUser);

                if($result === false)
                {
                    echo "Error in Query";
                }
                else
                {
                    $querySelect = "SELECT * FROM users WHERE UserName = '" . $student->getUsername() . "'";
                    $SelectResult = $this->db->select($querySelect);
                    $queryInsertFaculty = "INSERT INTO student VALUES 
                    ('" . $SelectResult[0]["Id"] . "', '" . $student->getAge() . "')";
                    $result = $this->db->insert($queryInsertFaculty);
                    return "";
                }
            }
        }

        public function UpdateUser($Studentmodel)
        {
            $this->db = new DBController;
            if($this->db->openConnection())
            {
                $name     = $Studentmodel->getName();
                $username = $Studentmodel->getUsername();
                $password = $Studentmodel->getPassword();
                $email    = $Studentmodel->getEmail();
                $id       = $Studentmodel->getId();
                $age     = $Studentmodel->getAge();
                
                $Updatequery = "
                    UPDATE users SET 
                        Name = '$name',
                        UserName = '$username',
                        Password = '$password',
                        Email = '$email'
                    WHERE Id = '$id'
                ";
                
                $UpdatequeryStudent= "
                    UPDATE student SET 
                        Age = '$age'
                    WHERE UserId = '$id'
                ";

                $result1 = $this->db->Update($Updatequery);
                $result2 = $this->db->Update($UpdatequeryStudent);

                if($result1 === false || $result2 === false)
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

        public function ShowUserData($studentid)
        {
            $this->db = new DBController;
            if($this->db->openConnection())
            {
                $query = "SELECT * FROM users JOIN student ON Id = UserId WHERE Id = '" . $studentid . "'";

                $result = $this->db->select($query); 

                if($result === false)
                {
                    echo "Error in Query";
                    return false;
                }
                else
                {
                    $student = new Student;
                    $student->setId($result[0]["Id"]);
                    $student->setName($result[0]["Name"]);
                    $student->setUsername($result[0]["UserName"]);
                    $student->setEmail($result[0]["Email"]);
                    $student->setPassword($result[0]["Password"]);
                    $student->setAge($result[0]["Age"]);
                    $student->setRoleName($result[0]["RoleName"]);

                    return $student;
                }
            }
        }

        // ahmed
        public function getTranscript($studentId)
        {
            $this->db = new DBController;
            if($this->db->openConnection())
            {
                $query = "SELECT courseregisteration.CrsId, course.CrsName, courseregisteration.Grade FROM courseregisteration
                 JOIN course ON courseregisteration.CrsId = course.CrsId WHERE courseregisteration.StuId = " . $studentId;
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