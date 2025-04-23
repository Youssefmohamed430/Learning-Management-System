<?php

class User {
    private $ID;
    private $Name;
    private $Username;
    private $Password;
    private $Email;
    private $RoleName;

    public function getID() { return $this->ID; }
    public function setID($ID) { $this->ID = $ID; }

    public function getName() { return $this->Name; }
    public function setName($Name) { $this->Name = $Name; }

    public function getUsername() { return $this->Username; }
    public function setUsername($Username) { $this->Username = $Username; }

    public function getPassword() { return $this->Password; }
    public function setPassword($Password) { $this->Password = $Password; }

    public function getEmail() { return $this->Email; }
    public function setEmail($Email) { $this->Email = $Email; }

    public function getRoleName() { return $this->RoleName; }
    public function setRoleName($RoleName) { $this->RoleName = $RoleName; }
}

?>