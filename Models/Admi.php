<?php
class Admin
{
    private $UserId;

    
    // Getter and Setter for Id
    public function getUserId() {
        return $this->UserId;
    }

    public function setUserId($UserId) {
        $this->UserId = $UserId;
    }

}

?>