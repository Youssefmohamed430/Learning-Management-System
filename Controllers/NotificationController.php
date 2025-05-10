<?php

    class NotificationController
    {
        private $db;
        public function AddNotification($NotificationModel)
        {
            $this->db = new DbController;
            
            if($this->db->openConnection())
            {
                $qry = "INSERT INTO notifications VALUES ('','".$NotificationModel->getMessage()."'
                ,'','".$NotificationModel->getdate()."','".$NotificationModel->getReceiverId()."')";
                $result = $this->db->insert($qry);
                if($result === false)
                    return "Error At query";
                else
                    return "";
            }
        }
        public function SendNotification($Id)
        {
            $this->db = new DbController;
            
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
    }
?>