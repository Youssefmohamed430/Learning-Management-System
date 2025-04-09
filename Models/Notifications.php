<?php
class Notifications
{
    private $NotifId;
    private $Message;
    private $IsRead;
    private $DateSent;
    private $ReceiverId;

    // Getter and Setter for NotifId
    public function getNotifId() {
        return $this->NotifId;
    }

    public function setNotifId($NotifId) {
        $this->NotifId = $NotifId;
    }

    // Getter and Setter for Message
    public function getMessage() {
        return $this->Message;
    }

    public function setMessage($Message) {
        $this->Message = $Message;
    }

    // Getter and Setter for IsRead
    public function getIsRead() {
        return $this->IsRead;
    }

    public function setIsRead($IsRead) {
        $this->IsRead = $IsRead;
    }

    // Getter and Setter for DateSent
    public function getDateSent() {
        return $this->DateSent;
    }

    public function setDateSent($DateSent) {
        $this->DateSent = $DateSent;
    }

    // Getter and Setter for ReceiverId
    public function getReceiverId() {
        return $this->ReceiverId;
    }

    public function setReceiverId($ReceiverId) {
        $this->ReceiverId = $ReceiverId;
    }

}