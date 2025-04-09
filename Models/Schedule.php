<?php
class Schedule
{
    private $SchId;
    private $Date;
    private $CrsId;
    private $TeacherId;

    
    // Getter and Setter for SchId
    public function getSchId() {
        return $this->SchId;
    }

    public function setSchId($SchId) {
        $this->SchId = $SchId;
    }

    // Getter and Setter for CrsId
    public function getCrsId() {
        return $this->CrsId;
    }

    public function setCrsId($CrsId) {
        $this->CrsId = $CrsId;
    }

    // Getter and Setter for Date
    public function getDate() {
        return $this->Date;
    }

    public function setDate($Date) {
        $this->Date = $Date;
    }

    // Getter and Setter for Date
    public function getTeacherId() {
        return $this->TeacherId;
    }

    public function setTeacherId($TeacherId) {
        $this->TeacherId = $TeacherId;
    }

}

?>