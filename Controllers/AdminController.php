<?php
    // require_once '../Models/User.php';
    // require_once__DIR__ '../../Models/User.php' ;
    require_once 'E:\Xampp\htdocs\Learning-Management-System\Models\User.php';
    require_once 'DBController.php';


    class AdminController
    {
        protected $db;
        public function IsUserNameValid(string $Username) { return strlen($Username) > 3 ; }

        public function IsUserNameToken(string $Username)
        {
            $this->db = new DBController;
            if($this->db->openConnection()) 
            {
                $query = "SELECT * FROM users WHERE username = '$Username'";
                $result=$this->db->select($query);
                return Count($result) > 0;
            }
        }

        public function IsSSnToken(string $Ssn)
        {
            $this->db = new DBController;
            if($this->db->openConnection()) 
            {
                $query = "SELECT * FROM facultymember WHERE SsNo = '$Ssn'";
                $result=$this->db->select($query);
                return Count($result) > 0;
            }
        }

        public function IsEmailValid($Email) { return filter_var($Email, FILTER_VALIDATE_EMAIL); }

        public function IsPasswordValid($Password)
        { return strlen($Password) > 3 && ctype_upper($Password[0]) && strpbrk($Password, '0123456789'); }

        public function GetAll($Role) 
        {
            $this->db = new DBController;
            if($this->db->openConnection()) 
            {
                $query = "SELECT * FROM users WHERE RoleName = '" . $Role . "'";
                $result=$this->db->select($query);
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

        public function AddAdmin($Admin)
        {
            $this->db = new DBController;
            if(!$this->IsUserNameValid($Admin->getUsername()))
                return "User Name must at least 3 letters";

            if($this->IsUserNameToken($Admin->getUsername()))
                return "User Name Is Already registerd";
            
            if(!$this->IsPasswordValid($Admin->getPassword()))
                return "Password must at least 3 letters , first letter capital and contain numbers!";
            
            if(!$this->IsEmailValid($Admin->getEmail()))
                return "InValid Email!";

            if($this->db->openConnection())
            {
                $query = "INSERT INTO users VALUES 
                ('', '" . $Admin->getName() . "', '" . $Admin->getUsername() . "'
                ,'" . $Admin->getPassword() . "','" . $Admin->getEmail() . "'
                ,'" . $Admin->getRoleName() . "')";

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

        
        public function AddFacultyMember($member)
        {
            $this->db = new DBController;
            if(!$this->IsUserNameValid($member->getUsername()))
                return "User Name must at least 3 letters";

            if($this->IsUserNameToken($member->getUsername()))
                return "User Name Is Already registerd";
            
            if(!$this->IsPasswordValid($member->getPassword()))
                return "Password must at least 3 letters , first letter capital and contain numbers!";
            
            if(!$this->IsEmailValid($member->getEmail()))
                return "InValid Email!";

            if($this->IsSSnToken($member->getSsNo()))
                return "SSn Is Already registerd";

            if($this->db->openConnection())
            {
                $queryInsertUser = "INSERT INTO users VALUES 
                ('', '" . $member->getName() . "', '" . $member->getUsername() . "'
                ,'" . $member->getPassword() . "','" . $member->getEmail() . "'
                ,'" . $member->getRoleName() . "')";

                $result = $this->db->insert($queryInsertUser);

                if($result === false)
                {
                    echo "Error in Query";
                }
                else
                {
                    $querySelect = "SELECT * FROM users WHERE UserName = '" . $member->getUsername() . "'";
                    $SelectResult = $this->db->select($querySelect);
                    $queryInsertFaculty = "INSERT INTO facultymember VALUES 
                    ('" . $SelectResult[0]["Id"] . "', '" . $member->getSsNo() . "')";
                    $result = $this->db->insert($queryInsertFaculty);
                    return "";
                }
            }
        }

        public function AddStudent($student)
        {
            $this->db = new DBController;
            if(!$this->IsUserNameValid($student->getUsername()))
                return "User Name must at least 3 letters";

            if($this->IsUserNameToken($student->getUsername()))
                return "User Name Is Already registerd";
            
            if(!$this->IsPasswordValid($student->getPassword()))
                return "Password must at least 3 letters , first letter capital and contain numbers!";
            
            if(!$this->IsEmailValid($student->getEmail()))
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

        public function DeleteUser($userId)
        {
            $this->db = new DBController;
            if($this->db->openConnection())
            {
                $queryDeleteUser = "DELETE FROM users WHERE Id = '" . $userId . "'";

                $result = $this->db->delete($queryDeleteUser);

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

        public function ShowAdminData($adminid)
        {
            $this->db = new DBController;
            if($this->db->openConnection())
            {
                $query = "SELECT * FROM users WHERE Id = '" . $adminid . "'";

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

        public function ShowMemberData($memberid)
        {
            $this->db = new DBController;
            if($this->db->openConnection())
            {
                $query = "SELECT * FROM users JOIN facultymember ON Id = UserId WHERE Id = '" . $memberid . "'";

                $result = $this->db->select($query); 

                if($result === false)
                {
                    echo "Error in Query";
                    return false;
                }
                else
                {
                    $member = new FacultyMember;
                    $member->setId($result[0]["Id"]);
                    $member->setName($result[0]["Name"]);
                    $member->setUsername($result[0]["UserName"]);
                    $member->setEmail($result[0]["Email"]);
                    $member->setPassword($result[0]["Password"]);
                    $member->setSsNo($result[0]["SsNo"]);

                    return $member;
                }
            }
        }

        public function ShowStudentData($studentid)
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

                    return $student;
                }
            }
        }

        public function EditAdmin($adminmodel)
        {
            $this->db = new DBController;
            if($this->db->openConnection())
            {
                $Updatequery = "UPDATE users SET 
                    Name = '" . $adminmodel->getName() . "',
                    UserName = '" . $adminmodel->getUsername() . "',
                    Password = '" . $adminmodel->getPassword() . "',
                    Email = '" . $adminmodel->getEmail() . "'
                    WHERE id = " . $adminmodel->getId();

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

        public function EditMember($Membermodel)
        {
            $this->db = new DBController;
            if($this->db->openConnection())
            {
                $name     = $Membermodel->getName();
                $username = $Membermodel->getUsername();
                $password = $Membermodel->getPassword();
                $email    = $Membermodel->getEmail();
                $id       = $Membermodel->getId();
                $ssno     = $Membermodel->getSsNo();
                
                $Updatequery = "
                    UPDATE users SET 
                        Name = '$name',
                        UserName = '$username',
                        Password = '$password',
                        Email = '$email'
                    WHERE Id = '$id'
                ";
                
                $Updatequerymember = "
                    UPDATE facultymember SET 
                        SsNo = '$ssno'
                    WHERE UserId = '$id'
                ";

                $result1 = $this->db->Update($Updatequery);
                $result2 = $this->db->Update($Updatequerymember);

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

        public function EditStudent($Studentmodel)
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
    }
?>