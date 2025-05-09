<?php
require_once '../../../Models/User.php';
require_once '../../../Models/Course.php';
require_once '../../../Models/FacultyMember.php';
require_once '../../../Controllers/CoursesController.php';
$coursesController = new CoursesController();
$errmsg = "";

session_start();
  if (!isset($_SESSION["role"])) {
  
    header("location: login.php ");
  } else {
    if ($_SESSION["role"] != "Student") {
      header("location: login.php ");
    }
  }
if(isset($_POST['course_id']))
{
    if(!empty($_POST['course_id'])){
        $errmsg = $coursesController->RegisterCourse($_POST['course_id'], $_SESSION["Id"]);
    }
    else{
        $errmsg = "Error";
    }
}
if(isset($_POST["Dropcourse_id"]))
{
    if(!empty($_POST["Dropcourse_id"])){
        $errmsg = $coursesController->DropCourse($_SESSION["Id"],$_POST["Dropcourse_id"]);
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
            <?php if($errmsg != ""): ?>
              <div class="alert <?php echo strpos($errmsg, 'Successfully') !== false ? 'alert-success' : 'alert-warning'; ?> alert-dismissible fade show" role="alert">
                  <?php echo $errmsg; ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>
            <div class="row">
              <?php
              $courses = $coursesController->GetAllCourses();
              if ($courses!='') {
                foreach ($courses as $i) {
                  if($coursesController->IsStudentRegistered($_SESSION["Id"], $i['CrsId'])){
                    ?>
                    <div class="col-md-4 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $i['CrsName']; ?></h5>
                          <p class="card-text"><?php echo $i['Description']; ?></p>
                          <p class="card-text"><small class="text-muted">Faculty: <?php echo $i['Name'] ?? 'Not Assigned'; ?></small></p>
                          <div class="alert alert-info">You are already registered for this course</div>
                          <form action="" method="post">
                            <input type="hidden" name="Dropcourse_id" value="<?php echo $i['CrsId']; ?>">
                            <button type="submit" name="DropCourse" class="btn btn-primary">Drop</button>
                          </form> 
                        </div>
                      </div>
                    </div>
                    <?php
                  } else {
                    ?>
                    <div class="col-md-4 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $i['CrsName']; ?></h5>
                          <p class="card-text"><?php echo $i['Description']; ?></p>
                          <p class="card-text"><small class="text-muted">Faculty: <?php echo $i['Name'] ?? 'Not Assigned'; ?></small></p>
                          <form action="" method="post">
                            <input type="hidden" name="course_id" value="<?php echo $i['CrsId']; ?>">
                            <button type="submit" name="register_course" class="btn btn-primary">Register</button>
                          </form>
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                }
              } else {
                echo '<div class="col-12"><div class="alert alert-info">No courses found.</div></div>';
              }
              ?>
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