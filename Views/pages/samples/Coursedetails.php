<?php
require_once '../../../Controllers/CoursesController.php';
require_once '../../../Controllers/DBController.php';
require_once '../../../Models/Course.php';


//  session_start();
// $coursescontroller = new CoursesController();
// $courseid =$_SESSION['courseid'];
// $coursevideos = $coursescontroller->GetCourseVideos($courseid);

session_start();
if (isset($_POST['courseid']) && !empty($_POST['courseid'])) {
    $_SESSION['courseid'] = $_POST['courseid'];
} elseif (!isset($_SESSION['courseid'])) {
    die("No course selected.");
}
$coursescontroller = new CoursesController();
$coursevideos = $coursescontroller->GetCourseVideos($_SESSION['courseid']);
?>
<!-- HTML لعرض الفيديوهات -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Course Videos</title>
  <!-- Plugins and styles -->
  <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="shortcut icon" href="../../assets/images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- Navbar -->
    <?php include_once '../samples/Components/nav.php'; ?>

    <div class="container-fluid page-body-wrapper">
      <!-- Sidebar -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="nav-profile-image">
                <img src="../../assets/images/faces/face1.jpg" alt="profile" />
                <span class="login-status online"></span>
              </div>
              <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold mb-2">David Grey. H</span>
                <span class="text-secondary text-small">Project Manager</span>
              </div>
              <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span class="menu-title">My Course</span>
              <i class="fa fa-mortar-board"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../index.html">
              <span class="menu-title">Exam</span>
              <i class="fa fa-pencil"></i>
            </a>
          </li>
        </ul>
      </nav>

      <!-- Main panel -->
      <div class="main-panel">
        <div class="content-wrapper">
          <?php if (empty($coursevideos)): ?>
            <div class="alert alert-danger text-center" style="font-size: 24px;">
              No videos available for this course.
            </div>
          <?php else: ?>
            <?php foreach ($coursevideos as $video): ?>
              <div class="mb-4">
                <h1>video</h1>
                <video controls class="w-100" style="max-height: 500px;">
                  <source src="<?php echo $video['VideoPath']; ?>" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

        <!-- Footer -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
              Copyright © 2023 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>.
            </span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
              Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i>
            </span>
          </div>
        </footer>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="../../assets/js/off-canvas.js"></script>
  <script src="../../assets/js/misc.js"></script>
  <script src="../../assets/js/settings.js"></script>
  <script src="../../assets/js/todolist.js"></script>
</body>
</html>
