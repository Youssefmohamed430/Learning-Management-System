<?php

  require_once '../../../Models/User.php';
  require_once '../../../Models/Course.php';
  require_once '../../../Controllers/AdminController.php';
  require_once '../../../Controllers/CoursesController.php';
  require_once '../../../Controllers/DBController.php';
  session_start();
  if (!isset($_SESSION["role"])) {
  
    header("location: Login.php ");
  } else {
    if ($_SESSION["role"] != "Admin") {
      header("location: Login.php ");
    }
  }
  $errmsg = "";
  $CrsController = new CoursesController;
  $course = new Course;
  session_start();

  if (isset($_SESSION['Crsid'])) 
  {
      $result = $CrsController->GetCourse($_SESSION['Crsid']);
      if($result === false)
      {
          $errmsg = "Error";
      }
  } 

  
  if(isset($_POST["CrsName"]) && isset($_POST["Description"]) && isset($_POST["MemberName"]))
  {
    if(!empty($_POST["CrsName"]) && !empty($_POST["Description"]) && !empty($_POST["MemberName"]))
    {
          $membername = "";
          $course->setCrsId($_SESSION['Crsid']);
          $course->setCrsName($_POST["CrsName"]);
          $course->setDescription($_POST["Description"]);
          $membername = $_POST["MemberName"];
          $errmsg = $CrsController->EditCourse($course,$membername);
          
          if($errmsg === "")
          {
              header("Location: ManageCourses.php");
          }
    }
      else
      {
          $errmsg = "Please fill all fields";
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
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Add New Course</h3>
                    <br>
                    <form class="forms-sample" method = "Post">
                    <?php 
                      if($errmsg!="")
                      {
                          ?>
                              <div class="alert alert-danger" role="alert"><?php echo $errmsg ?></div>
                          <?php
                      }
                    ?>
                    <div class="form-group">
                        <label for="exampleInputConfirmPassword1" style="font-size : 20px">Course Name</label>
                        <input type="text" class="form-control" 
                        id="InputName" placeholder="Name" name = "CrsName" value="<?php echo $result[0]["CrsName"]?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1" style="font-size : 20px">Discrption</label>
                        <textarea cols="30" rows="5" class="form-control"
                        placeholder="Discrption" name="Description"><?php echo $result[0]["Description"]?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1" style="font-size : 20px">Faculty Member</label>
                        <input type="text" class="form-control" id="InputName" 
                        placeholder="Member" name = "MemberName" value="<?php echo $result[0]["Name"]?>">
                      </div>
                      <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
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