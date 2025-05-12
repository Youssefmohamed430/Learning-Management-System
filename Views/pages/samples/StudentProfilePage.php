<?php

  require_once '../../../Models/Student.php';
  require_once '../../../Controllers/StudentController.php';
  require_once '../../../Controllers/ScheduleController.php';

  session_start();

if (!isset($_SESSION["role"])) {

  header("Location: \Learning-Management-System\Views\pages\samples\login.php");
} else {
  if ($_SESSION["role"] != "Student") {
    header("Location: \Learning-Management-System\Views\pages\samples\login.php");
  }
}

$studentInfo = new Student;
$studentController = new StudentController;
$calenderController = new ScheduleController;

if(isset($_SESSION["Id"]))
{
    if(!empty($_SESSION["Id"]))
    {
        $studentInfo = $studentController->ShowUserData($_SESSION["Id"]);
        $transcript = $studentController->getTranscript($_SESSION["Id"]);
        $calender = $calenderController->getCalender($_SESSION["Id"]);
    }
    else
    {
      $errmsg = "Error";
    }
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
      <?php include_once '../samples/Components/nav.php'?>
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
                <span class="font-weight-bold mb-2"><?php echo $_SESSION["Name"]; ?></span>
                <span class="text-secondary text-small"><?php echo $_SESSION["role"]; ?></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../index.php">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="col-md-12 grid-margin">
              <div class="card">
                <div class="card-body text-center">
                  <div style="margin-bottom: 10px;" class="d-flex justify-content-center align-items-center">
                    <h4 class="card-title mb-0">Personal Information</h4>
                      <i style="margin-left: 10px;" class="fa fa-id-card-o"></i>
                  </div>
                <div class="row justify-content-center">
                      <div style="font-size: 15px;" class="col-md-6">
                        <p><?php echo $studentInfo->getRoleName(); ?></p>
                        <p>Name: <?php echo $studentInfo->getName(); ?></p>
                        <p>Age: <?php echo $studentInfo->getAge(); ?></p>
                        <p>Email: <?php echo $studentInfo->getEmail(); ?></p>
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
                          <th style="font-size: medium;">Course ID</th>
                          <th style="font-size: medium;">Course Name</th>
                          <th style="font-size: medium;">Grade</th>
                        </tr>
                      </thead>
                      <tbody>

                      <?php
                        if(Count($transcript) > 0) {
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
                          <td colspan="3" class="p-0">
                            <div class="alert alert-danger text-center m-0 w-100" role="alert">
                              The Transcript is not available at this time
                            </div>
                          </td>
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
                          <th style="font-size: medium;">Event Type</th>
                          <th style="font-size: medium;">Date</th>
                          <th style="font-size: medium;">Course</th>
                          <th style="font-size: medium;">Teacher</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      <?php
                        if($calender !== false) {
                            foreach($calender as $row) {
                        ?>
                          <tr>
                            <td> <?php echo $row['EventType'] ?> </td>
                            <td> <?php echo $row['Date'] ?> </td>
                            <td> <?php echo $row['CrsName'] ?> </td>
                            <td> <?php echo $row['Name'] ?> </td>
                            </tr>
                            <?php
                            }
                        } else {
                        ?>
                          <tr>
                              <td colspan="4" class="p-0">
                                  <div class="alert alert-danger text-center m-0 w-100" role="alert">
                                      <?php echo $_SESSION["errmsg"];   ?>
                                  </div>
                              </td>
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