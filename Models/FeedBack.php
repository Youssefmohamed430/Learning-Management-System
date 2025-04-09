<?php
class Feedback
{
    private $FeedbackId;
    private $Message;
    private $Rate;
    private $StuId;
    private $TeacherId;

    // Getter and Setter for FeedbackId
    public function getFeedbackId() {
        return $this->FeedbackId;
    }

    public function setFeedbackId($FeedbackId) {
        $this->FeedbackId = $FeedbackId;
    }

    // Getter and Setter for Message
    public function getMessage() {
        return $this->Message;
    }

    public function setMessage($Message) {
        $this->Message = $Message;
    }

    // Getter and Setter for Rate
    public function getRate() {
        return $this->Rate;
    }

    public function setRate($Rate) {
        $this->Rate = $Rate;
    }

    // Getter and Setter for StuId
    public function getStuId() {
        return $this->StuId;
    }

    public function setStuId($StuId) {
        $this->StuId = $StuId;
    }

    // Getter and Setter for TeacherId
    public function getTeacherId() {
        return $this->TeacherId;
    }

    public function setTeacherId($TeacherId) {
        $this->TeacherId = $TeacherId;
    }

}