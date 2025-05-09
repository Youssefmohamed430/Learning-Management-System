<?php
if(isset($_POST["courseid"]))
{
    if(!empty($_POST["courseid"]))
    {
        session_start();
        $_SESSION["courseid"] = $_POST["courseid"];
    }
    else
    {
      $errmsg = "Error";
    }
}

require_once '../../../Controllers/CoursesController.php';
require_once '../../../Controllers/AdminController.php';
require_once '../../../Models/User.php';
require_once '../../../Models/Course.php';

$coursescontroller = new CoursesController;
session_start();
$mycourses = $coursescontroller->GetMYCourses($_SESSION["Id"]);

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

    <style>
  .card {
    height: 100%;
    margin-bottom: 0;
  }
  
  .card-img-top {
    height: 180px;
    object-fit: cover;
  }
  
  .card-body {
    display: flex;
    flex-direction: column;
  }
  
  .card-body form {
    margin-top: auto;
  }
  
  /* Ensure proper spacing between rows of cards */
  .row .mb-4:last-child {
    margin-bottom: 0 !important;
  }
  
  /* Improve button appearance */
  .btn-gradient-primary {
    width: 100%;
    margin-top: 10px;
  }
</style>
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
                <span class="menu-title">My Course</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="column">
              <div class="col-md-16 grid-margin stretch-card">
              <?php
              if (count($mycourses )==0){
                ?>
                    <div class="alert alert-danger" role="alert" style="font-size : 50px; ">
                          Not Courses register
                    </div>
                <?php
              }
                else  {
                    foreach ($mycourses as $course ){
                        ?>
                        <div class="card"  style="width: 18rem; min-width: 80px;">
                        <img class="card-img-top" src="../../../imgs/LMS.jpg" alt="Card image cap">
                        <div class="card-body">
                          <!-- <h4 class="card-title"></h4>
                          <p class="card-text">.</p> -->
                          <h4 class="card-title"><?php echo $course["CrsName"]; ?></h4>
                          <p class="card-text"><?php echo $course["Description"]; ?></p>
                          <form action="Coursedetails.php" method="post">
                                  <input type="hidden" name="courseid" value="<?php echo $course["CrsId"]?>"/>
                                  <button type="submit" class="btn btn-gradient-primary btn-fw">
                                    watch course
                                  </button>
                          </form>
                        </div>
                      </div>
                      <?php
                    }
                }
              ?>
            
              </div>
          </div>
        </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <!-- courses -->
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
