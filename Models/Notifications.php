<?php
    class Notifications {
        private $NotifId;
        private $Message;
        private $IsRead;
        private $DateSent;
        private $ReceiverId;

        public function getNotifId() { return $this->NotifId; }
        public function setNotifId($NotifId) { $this->NotifId = $NotifId; }

        public function getMessage() { return $this->Message; }
        public function setMessage($Message) { $this->Message = $Message; }

        public function getIsRead() { return $this->IsRead; }
        public function setIsRead($IsRead) { $this->IsRead = $IsRead; }

        public function getDateSent() { return $this->DateSent; }
        public function setDateSent($DateSent) { $this->DateSent = $DateSent; }

        public function getReceiverId() { return $this->ReceiverId; }
        public function setReceiverId($ReceiverId) { $this->ReceiverId = $ReceiverId; }
    }
?>