<?php
class StudentCertificate
{
    private $CertificateId;
    private $StuId;

    
    // Getter and Setter for CertificateId
    public function getCertificateId() {
        return $this->CertificateId;
    }

    public function setCertificateId($CertificateId) {
        $this->CertificateId = $CertificateId;
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