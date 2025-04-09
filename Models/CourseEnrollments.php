<?php
class CourseEnrollment
{
    private $CrsId;
    private $StuId;

    
    // Getter and Setter for CrsId
    public function getCrsId() {
        return $this->CrsId;
    }

    public function setCrsId($CrsId) {
        $this->CrsId = $CrsId;
    }

    // Getter and Setter for StuId
    public function getStuId() {
        return $this->StuId;
    }

    public function setStuId($StuId) {
        $this->StuId = $StuId;
    }

}

?>