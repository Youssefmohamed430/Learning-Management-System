<?php
  require_once '../../../Controllers/AdminController.php';
  require_once '../../../Controllers/CoursesController.php';
  require_once '../../../Controllers/DBController.php';
  require_once '../../../Models/Course.php';
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
  
  $courses = $CrsController->GetAllCourses();
  if($courses === false)
  {
    $errmsg = "Error";
  }

  if(isset($_POST["Crsid"]))
  {
    if(!empty($_POST["Crsid"]))
    {
        $errmsg = $CrsController->DeleteCourse($_POST["Crsid"]);
    }
  }

  if(isset($_POST["editCrsid"]))
  {
    if(!empty($_POST["editCrsid"]))
    {
      session_start();
      $_SESSION["Crsid"] = $_POST["editCrsid"];
      header("Location: EditCourse.php");
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
            </li>
            <li class="nav-item">
              <a class="nav-link" href="AssignCourseToMember.php">
                  <span class="menu-title">Assign Course to Admin</span>
                  <i class="fa fa-plus-circle menu-icon"></i>
              </a>
            </li>
            </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Courses</h4>
                      <table class="table">
                        <thead>
                          <tr>
                            <!-- <th>Profile</th> -->
                            <th>Id</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Faculty Member</th>
                            <th>Edit</th>
                            <th>Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          foreach($courses as $course)
                          {
                            ?>
                              <tr>
                                <td><?php echo $course["CrsId"]?></td>
                                <td><?php echo $course["CrsName"]?></td>
                                <td><?php echo $course["Description"]?></td>
                                <?php
                                  if($course["Name"] == NULL)
                                  {
                                    ?>
                                      <td>N/A</td>
                                    <?php
                                  }
                                  else
                                  {
                                    ?>
                                      <td><?php echo $course["Name"]?></td>
                                    <?php
                                  }
                                ?>
                                <td>
                                  <form action="" method="post">
                                    <input type="hidden" name="editCrsid" value="<?php echo $course["CrsId"]?>"/>
                                    <button type="submit" class="btn btn-gradient-primary btn-fw">
                                      <i class="fa fa-edit"></i>
                                    </button>
                                  </form>
                                </td>
                                <td>
                                  <form action="" method="post">
                                    <input type="hidden" name="Crsid" value="<?php echo $course["CrsId"]?>"/>
                                    <button type="submit" class="btn btn-gradient-primary btn-fw">
                                      <i class="fa fa-trash-o"></i>
                                    </button>
                                  </form>
                                </td>
                            <?php
                            }
                            ?>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            </div>
            <a href="/Learning-Management-System/Views/pages/samples/AddCourse.php" class="btn btn-gradient-primary btn-fw">
                Add Course
            </a>
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