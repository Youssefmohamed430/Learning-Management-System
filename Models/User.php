<?php
class User
{
    private $Id;
    private $Name;
    private $UserName;
    private $Password;
    private $Email;
    private $RoleId;

    
    // Getter and Setter for Id
    public function getId() {
        return $this->Id;
    }

    public function setId($Id) {
        $this->Id = $Id;
    }

    // Getter and Setter for Name
    public function getName() {
        return $this->Name;
    }

    public function setName($Name) {
        $this->Name = $Name;
    }

    // Getter and Setter for UserName
    public function getUserName() {
        return $this->UserName;
    }

    public function setUserName($UserName) {
        $this->UserName = $UserName;
    }

    // Getter and Setter for Password
    public function getPassword() {
        return $this->Password;
    }

    public function setPassword($Password) {
        $this->Password = $Password;
    }

    // Getter and Setter for Email
    public function getEmail() {
        return $this->Email;
    }

    public function setEmail($Email) {
        $this->Email = $Email;
    }

    // Getter and Setter for RoleId
    public function getRoleId() {
        return $this->RoleId;
    }

    public function setRoleId($RoleId) {
        $this->RoleId = $RoleId;
    }
}

?>