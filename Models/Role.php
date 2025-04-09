<?php
class Role
{
    private $RoleId;
    private $RoleName;

    
    // Getter and Setter for RoleId
    public function getRoleId() {
        return $this->RoleId;
    }

    public function setId($RoleId) {
        $this->RoleId = $RoleId;
    }

    // Getter and Setter for RoleName
    public function getRoleName() {
        return $this->RoleName;
    }

    public function setRoleName($RoleName) {
        $this->RoleName = $RoleName;
    }

}

?>