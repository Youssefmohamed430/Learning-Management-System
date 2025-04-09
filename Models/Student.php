<?php
class Student
{
    private $UserId;

    
    // Getter and Setter for UserId
    public function getUserId() {
        return $this->UserId;
    }

    public function setUserId($UserId) {
        $this->UserId = $UserId;
    }

}

?>