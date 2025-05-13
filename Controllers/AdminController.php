<?php
    require_once 'DBController.php';
    // require_once 'E:\Xampp\htdocs\Learning-Management-System\Models\User.php';
    require_once __DIR__ . '/../Models/User.php';
    require_once 'ValidationController.php';
    require_once 'UserController.php';


    class AdminController extends UserController
    {
        protected $db;
        public $validationController;
        

        function __construct() {
            $this->validationController = new ValidationController;
        }
        
        public function AddUser($Admin)
        {
            $this->db = DBController::getInstance();

            if(!$this->validationController->IsUserNameValid($Admin->getUsername()))
                return "User Name must at least 3 letters";

            if($this->validationController->IsUserNameToken($Admin->getUsername()))
                return "User Name Is Already registerd";
            
            if(!$this->validationController->IsPasswordValid($Admin->getPassword()))
                return "Password must at least 3 letters , first letter capital and contain numbers!";
            
            if(!$this->validationController->IsEmailValid($Admin->getEmail()))
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

        public function ShowUserData($adminid)
        {
            $this->db = DBController::getInstance();
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

        public function UpdateUser($adminmodel)
        {
            $this->db = DBController::getInstance();

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
    }
?>