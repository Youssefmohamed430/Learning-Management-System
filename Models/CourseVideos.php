<?php
    class CoursesVideos {
        private $VideoId;
        private $VideoPath;
        private $CrsId;
    
        public function getVideoId() { return $this->VideoId; }
        public function setVideoId($VideoId) { $this->VideoId = $VideoId; }
    
        public function getVideoPath() { return $this->VideoPath; }
        public function setVideoPath($VideoPath) { $this->VideoPath = $VideoPath; }
    
        public function getCrsId() { return $this->CrsId; }
        public function setCrsId($CrsId) { $this->CrsId = $CrsId; }
    }
?>
