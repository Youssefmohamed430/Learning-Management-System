<?php
class Course
{
    private $CrsId;
    private $CrsName;
    private $TeacherId;

    
    // Getter and Setter for CrsId
    public function getCrsId() {
        return $this->CrsId;
    }

    public function setCrsId($CrsId) {
        $this->CrsId = $CrsId;
    }

    // Getter and Setter for CrsName
    public function getCrsName() {
        return $this->CrsName;
    }

    public function setCrsName($CrsName) {
        $this->CrsName = $CrsName;
    }

    // Getter and Setter for TeacherId
    public function getTeacherId() {
        return $this->TeacherId;
    }

    public function setTeacherId($TeacherId) {
        $this->TeacherId = $TeacherId;
    }

}

?>