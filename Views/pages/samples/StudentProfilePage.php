<?php

  require_once '../../../Models/Student.php';
  require_once '../../../Models/User.php';
  require_once '../../../Models/CourseRegisteration.php';
  require_once '../../../Controllers/DBController.php';
  require_once '../../../Controllers/StudentController.php';
  require_once '../../../Controllers/CoursesController.php';
  require_once '../../../Controllers/ScheduleController.php';

 session_start();
 $_SESSION["studentId"] = 3;
// if (!isset($_SESSION["role"])) {

//   header("location: Login.php ");
// } else {
//   if ($_SESSION["role"] != "Student") {
//     header("location: Login.php ");
//   }
// }

// if(isset($_POST["id"]))
// {
//     if(!empty($_POST["id"]))
//     {
//         session_start();
//         $_SESSION["studentId"] = $_POST["id"];
//     }
//     else
//     {
//       $errmsg = "Error";
//     }
// }

$studentInfo = new Student;
$studentController = new StudentController;
$calenderController = new ScheduleController;

$studentInfo = $studentController -> ShowUserData($_SESSION["studentId"]);
$transcript = $studentController -> getTranscript($_SESSION["studentId"]);
$calender = $calenderController -> getCalender($_SESSION["studentId"]);
?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <a class="navbar-brand brand-logo" href="../../index.html"><img src="../../assets/images/logo.svg" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="../../assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
            </form>
          </div>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-logout d-none d-lg-block">
              <a class="nav-link" href="#">
                <i class="mdi mdi-power"></i>
              </a>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="../../assets/images/faces/face1.jpg" alt="profile" />
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">David Grey. H</span>
                  <span class="text-secondary text-small">Project Manager</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../index.html">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
          </ul>
        </nav>
        
        


        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">

            </div>
            <div class="col-md-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                  <div style="margin-bottom: 10px;" class="d-flex align-items-center">
                    <h4 class="card-title mb-0">Personal Information</h4>
                    <i style="margin-left: 10px;" class="fa fa-id-card-o mr-2"></i>
                  </div>
                    <div class="row">
                      <div class="col-md-6">
                        <p > <?php echo $studentInfo-> getRoleName() ?> </p> 
                        <p > Name: <?php echo $studentInfo-> getName() ?> </p> 
                        <p > Age: <?php echo $studentInfo-> getAge() ?> </p>
                        <p > Email: <?php echo $studentInfo-> getEmail() ?> </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <div class="row">

              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  <div class="d-flex justify-content-center align-items-center" style="margin-bottom: 10px;">
                      <h4 class="card-title mb-0">Student Transcript</h4>
                      <i class="fa fa-check-square-o ml-3" style="font-size: 24px; margin-left: 7px;"></i>
                  </div>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Course ID</th>
                          <th>Course Name</th>
                          <th>Grade</th>
                        </tr>
                      </thead>
                      <tbody>

                      <?php
                        if(count($transcript) > 0) {
                            foreach($transcript as $course) {
                        ?>
                            <tr>
                                <td><?php echo $course['CrsId']; ?></td>
                                <td><?php echo $course['CrsName']; ?></td>
                                <td><?php echo $course['Grade']; ?></td>
                            </tr>
                        <?php
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="3"> The Transcript is not available at this time.  </td>
                            </tr>
                    <?php
                    }
                    ?>
                          
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  <div class="d-flex justify-content-center align-items-center" style="margin-bottom: 10px;">
                      <h4 class="card-title mb-0">Student Course Calendar</h4>
                      <i class="mdi mdi-calendar ml-2" style="font-size: 24px;margin-left: 6px;"></i>
                  </div>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Course</th>
                          <th>Course Description</th>
                          <th>Teacher</th>
                          <th>Exam Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      <?php
                        if(count($calender) > 0) {
                            foreach($calender as $row) {
                        ?>
                          <tr>
                            <td> <?php echo $row['CrsName'] ?> </td>
                            <td> <?php echo $row['Description'] ?> </td>
                            <td> <?php echo $row['Name'] ?> </td>
                            <?php 
                              if ($row['Grade'] === NULL){

                                ?>
                                <td><label class="badge badge-danger">Exam Not Taken</label></td>
                                </tr>
                            <?php 
                                }
                                  else{
                                  ?>
                                    <td><label class="badge badge-success">Exam Taken</label></td>
                                    </tr>
                                  <?php
                                }
                              ?>
                            <?php
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="3">The course calendar is not available at this time.</td>
                            </tr>
                      <?php
                      }
                    ?>

                      </tbody>

                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <script src="../../assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  </body>
</html>