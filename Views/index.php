<?php
session_start();
if (!isset($_SESSION["role"])) {

  header("Location: \Learning-Management-System\Views\pages\samples\login.php");
} 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
            body {
                background-color: #1a1a1a;
            }
            .hero-section {
                padding: 80px 0;
                min-height: 80vh;
                display: flex;
                align-items: center;
            }

            h1 {
                margin-bottom: 30px;
            }

            .lead {
                font-size: 1.25rem;
                margin-bottom: 20px;
            }

            @keyframes float {
                0% {
                    transform: translateY(0px);
                }
                50% {
                    transform: translateY(-30px);
                }
                100% {
                    transform: translateY(0px);
                }
            }

            .floating-image {
                animation: float 4s ease-in-out infinite;
                text-align: center;
            }

            .floating-image img {
                max-width: 100%;
                height: auto;
            }

            @media (max-width: 992px) {
                .hero-section {
                    padding: 40px 0;
                    min-height: auto;
                }

                .col-lg-6:first-child {
                    margin-bottom: 40px;
                }
            }
        </style>
  </head>
  <body>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-3">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/purple-bootstrap-admin-template/" target="_blank" class="btn me-2 buy-now-btn border-0">Buy Now</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/purple-bootstrap-admin-template/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white mr-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- partial:partials/_navbar.html -->
      <?php include_once '../Views/pages/samples/Components/nav.php'?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="assets/images/faces/face1.jpg" alt="profile" />
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"><?php echo $_SESSION["Name"]; ?></span>
                  <span class="text-secondary text-small"><?php echo $_SESSION["role"]; ?></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <?php
            if ($_SESSION["role"] == "Admin") { ?>
              <li class="nav-item">
                <a class="nav-link" href="../Views/pages/samples/ManageUsers.php">
                  <span class="menu-title">Manage Users</span>
                  <i class="fa fa-users menu-icon"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../Views/pages/samples/ManageCourses.php">
                  <span class="menu-title">Manage Courses</span>
                  <i class="fa fa-book menu-icon"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../Views/pages/samples/AddQuestionnaire.php">
                  <span class="menu-title">Add Evaluation</span>
                  <i class="fa fa-pencil-square-o menu-icon"></i>
                </a>
              </li>
              <?php
              }?>
              <?php
            if ($_SESSION["role"] == "Student") { ?>
              <li class="nav-item">
                <a class="nav-link" href="../Views/pages/samples/StudentProfilePage.php">
                  <span class="menu-title">Profile</span>
                  <i class="fa fa-user-circle-o menu-icon"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../Views/pages/samples/Mycourse.php">
                  <span class="menu-title">My Courses</span>
                  <i class="fa fa-book menu-icon"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../Views/pages/samples/studentEnrolCourses.php"><!-- Ezzat -->
                  <span class="menu-title">Register Course</span>
                  <i class="fa fa-check-square menu-icon"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../Views/pages/samples/studentFeedback.php">
                  <span class="menu-title">Set Feedbacks</span>
                  <i class="fa fa-comments menu-icon"></i> 
                </a>
              </li>
              <?php
              }?>
                <?php
            if ($_SESSION["role"] == "Faculty") { ?>
              <li class="nav-item">
                <a class="nav-link" href="../Views/pages/samples/UploadCourseMaterial.php">
                  <span class="menu-title">Upload Course Material</span>
                  <i class="fa fa-video-camera menu-icon"></i> 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../Views/pages/samples/ViewFeedbacks.php">
                  <span class="menu-title">View Feedbacks</span>
                  <i class="fa fa-comments menu-icon"></i> 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../Views/pages/samples/EvaluateCoTeachers.php">
                  <span class="menu-title">Evaluate Co-Teachers</span>
                  <i class="fa fa-edit menu-icon"></i> 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../Views/pages/samples/Exams.php">
                  <span class="menu-title">Exams</span>
                  <i class="fa fa-file-text menu-icon"></i> 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../Views/pages/samples/SetSchedule.php">
                  <span class="menu-title">Set Schedule</span>
                  <i class="fa fa-calendar menu-icon"></i>
                </a>
              </li>
              <?php
              }?>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h3 class="display-4 fw-bold text-light">Welcome To Learning Management System</h3>
                        <p class="lead text-light opacity-75">
                          Experience a modern Learning Management System crafted to enhance the educational journey. Designed for ease of use,
                          it empowers instructors to deliver engaging content and fosters a dynamic learning environment for students, 
                          all within an intuitive platform. 
                        </p> 
                        <p class="text-light opacity-75"> 
                          This system simplifies administrative processes, strengthens collaboration between educators and learners,
                          and ensures seamless access anytime, anywhere. With a focus on efficiency and user satisfaction, 
                          it transforms classroom management into a streamlined, impactful experience.
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <div class="floating-image">
                            <img src="../imgs/LMS.jpg" class="img-fluid" alt="Attendance System">
                        </div>
                    </div>
                </div>
            </div>
        </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/chart.umd.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script src="assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>