<?php
require_once '../../../Models/Exam.php';
require_once '../../../Controllers/ExamController.php';
require_once '../../../Controllers/DBController.php';
require_once '../../../Controllers/CoursesController.php';
session_start();
// if (!isset($_SESSION["role"])) {
//     header("location: Login.php");
// } else {
//     if ($_SESSION["role"] != "Faculty") {
//         header("location: Login.php");
//     }
// }
$coursecontroller = new CoursesController;
$ExmController = new ExamController;
$errmsg = "";
$courses = $coursecontroller->GetAllCourses();


if(isset($_POST["ExamId"]) &&isset($_POST["Title"]) && isset($_POST["CrsId"]) && isset($_POST["Date"]) && isset($_POST["Type"]))
{
  if(!empty($_POST["ExamId"])  &&!empty($_POST["Title"])  && !empty($_POST["CrsId"]) && !empty($_POST["Date"]) && !empty($_POST["Type"]))
  {
    $Exam = new Exam;
        $Exam->setExamId($_SESSION['ExamId']);
        $Exam->setTitle($_POST["Title"]);
        $Exam->setType($_POST["Type"]);
        $Exam->setDate($_POST["Date"]);
        $Exam->setCrsId($_POST["CrsId"]);

        $errmsg = $ExmController->EditExam($Exam);

        if($errmsg === "")
        {
            header("Location: Exams.php");
        }
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
              <a class="nav-link" href="UploadCourseMaterial.php">
                <span class="menu-title">Upload Course Material</span>
                <i class="fa fa-video-camera menu-icon"></i> 
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="ViewFeedbacks.php">
                <span class="menu-title">View Feedbacks</span>
                <i class="fa fa-comments menu-icon"></i> 
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="EvaluateCoTeachers.php">
                <span class="menu-title">Evaluate Co-Teachers</span>
                <i class="fa fa-edit menu-icon"></i> 
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Exams.php">
                <span class="menu-title">Exams</span>
                <i class="fa fa-file-text menu-icon"></i> 
              </a>
            </li>
            
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="card-body">
                    <h4 class="card-title">Exams</h4>
                    <br>
                    <form class="forms-sample" method = "Post">
                      <div class="form-group">
                        <label for="exampleInputName1">Exam Title</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Exam Title" name = "Title" required >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Exam Id</label>
                        <input type="number" class="form-control" id="exampleInputEmail3" placeholder="Exam ID" name = "ExamId" required value = 1>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1" style="font-size : 20px">Courses</label>
                        <select class="form-select " name="CrsId">
                          <?php
                              foreach ($courses as $course) 
                              {?>
                                <option value="<?php echo $course["CrsId"] ?>"><?php echo $course["CrsName"] ?></option>
                              <?php
                              } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputCity1">Date</label>
                        <input type="Date" class="form-control" id="exampleInputCity1" placeholder="Date" name="Date" required >
                        </div>
                      <div class="form-group">
                        <label for="exampleInputCity1">Exam Type</label>
                        <input type="text" class="form-control" id="exampleInputCity1" value = "post" name="Type" required >
                      </div>
                      <button type="submit" class="btn btn-gradient-primary me-2" >Submit</button>
                      <a class="btn btn-light" href = "Exams.php">Cancel</a>
                    </form>
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