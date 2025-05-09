<?php

require_once 'DBController.php';
require_once 'UserController.php';
require_once 'ValidationController.php';


    class MemberController extends UserController
    {
        protected $db;
        public $validationController;
        

        function __construct() {
            $this->validationController = new ValidationController;
        }

        public function AddUser($member)
        {
            $this->db = new DBController;
            if(!$this->validationController->IsUserNameValid($member->getUsername()))
                return "User Name must at least 3 letters";

            if($this->validationController->IsUserNameToken($member->getUsername()))
                return "User Name Is Already registerd";
            
            if(!$this->validationController->IsPasswordValid($member->getPassword()))
                return "Password must at least 3 letters , first letter capital and contain numbers!";
            
            if(!$this->validationController->IsEmailValid($member->getEmail()))
                return "InValid Email!";

            if($this->validationController->IsSSnToken($member->getSsNo()))
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

        public function UpdateUser($Membermodel)
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

        public function ShowUserData($memberid)
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
        public function GetAllFaculty()
        {
            $this->db = new DBController;
            if($this->db->openConnection())
            {
                $query = "SELECT Id, Name FROM users WHERE RoleName = 'Faculty'";
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