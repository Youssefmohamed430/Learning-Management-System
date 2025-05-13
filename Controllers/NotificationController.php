<?php

    class NotificationController
    {
        private $db;
        public function AddNotification($NotificationModel)
        {
            $this->db = DBController::getInstance();
            
            if($this->db->openConnection())
            {
                $qry = "INSERT INTO notifications VALUES ('','".$NotificationModel->getMessage()."'
                ,'','".$NotificationModel->getDateSent()."','".$NotificationModel->getReceiverId()."')";
                $result = $this->db->insert($qry);
                if($result === false)
                    return "Error At query";
                else
                    return "";
            }
        }
        public function SendNotification($Id)
        {
            $this->db = DBController::getInstance();
            
            if($this->db->openConnection())
            {
                $qry = "SELECT * FROM notifications WHERE ReceiverId = '$Id'";
                $result = $this->db->select($qry);
                if($result === false)
                    return "Error At query";
                else
                    return $result;
            }
        }
        public function MarkAsRead($notifId)
        {
            $this->db = DBController::getInstance();
            
            if($this->db->openConnection())
            {
                $qry = "UPDATE notifications SET IsRead = 1 WHERE NotifId = '$notifId'";
                $result = $this->db->Update($qry);
                if($result === false)
                    return "Error At query";
                else
                    return $result;
            }
        }
    }
?>