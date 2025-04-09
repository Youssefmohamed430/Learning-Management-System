<?php
class CourseVideo
{
    private $VideoId;
    private $Video;
    private $CrsId;

    
    // Getter and Setter for CrsId
    public function getCrsId() {
        return $this->CrsId;
    }

    public function setCrsId($CrsId) {
        $this->CrsId = $CrsId;
    }

    // Getter and Setter for VideoId
    public function getVideoId() {
        return $this->VideoId;
    }

    public function setVideoId($VideoId) {
        $this->VideoId = $VideoId;
    }

    // Getter and Setter for Video
    public function getVideo() {
        return $this->Video;
    }

    public function setVideo($Video) {
        $this->Video = $Video;
    }

}