<?php
class Certificate
{
    private $CertificateId;
    private $CertificateName;
    private $CrsId;

    
    // Getter and Setter for CertificateId
    public function getCertificateId() {
        return $this->CertificateId;
    }

    public function setCertificateId($CertificateId) {
        $this->CertificateId = $CertificateId;
    }

    // Getter and Setter for CertificateName
    public function getCertificateName() {
        return $this->CertificateName;
    }

    public function setCertificateName($CertificateName) {
        $this->CertificateName = $CertificateName;
    }

    // Getter and Setter for CrsId
    public function getCrsId() {
        return $this->CrsId;
    }

    public function setCrsId($CrsId) {
        $this->CrsId = $CrsId;
    }

}

?>