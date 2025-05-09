<?php
require_once '../../../Models/Evaluation.php';
require_once '../../../Controllers/EvaluateController.php';
require_once '../../../Controllers/DBController.php';
require_once '../../../Controllers/MemberController.php';
require_once '../../../Controllers/QuestionnaireController.php';
session_start();
// if (!isset($_SESSION["role"])) {
//     header("location: Login.php");
// } else {
//     if ($_SESSION["role"] != "Faculty") {
//         header("location: Login.php");
//     }
// }
$MemberController = new MemberController();
$QrController = new QuestionnaireController;
$EvController = new EvaluateController;
$errmsg = "";
$Questionnaires = $QrController->getAllQuestionnaires();
$Members = $MemberController->getCoTeacher();
$FacultyMembers = $MemberController->getFaciltyMmebers();
$EvaluationId = $_SESSION["EvaluationId"];
$Evaluate = null;
if (isset($_POST["Comment"]) && isset($_POST["QR"]) && isset($_POST["Date"]) && isset($_POST["EVE"]) && isset($_POST["EVR"])) {
    if (!empty($_POST["Comment"]) && !empty($_POST["QR"]) && !empty($_POST["Date"]) && !empty($_POST["EVR"]) && !empty($_POST["EVE"])) {

        $Evaluate = new Evaluation($EvaluationId, $_POST["Comment"] , $_POST["Date"] ,
                        $_POST["EVR"] , $_POST["EVE"] ,
                        $_POST["QR"]);

        $errmsg = $EvController->EditEvaluate($Evaluate);

        if($errmsg === "")
        {
            header("Location: EvaluateCoTeachers.php");
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
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
              </div>
            </form>
          </div>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="../../assets/images/faces/face1.jpg" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">Mohamed</p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
              </div>
            </li>
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
                  <span class="font-weight-bold mb-2">Mohamed</span>
                  <span class="text-secondary text-small">Faculty Member</span>
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
                    <h4 class="card-title">Evaluation</h4>
                    <br>
                    <form class="forms-sample" method = "post">
                      <div class="form-group">
                        <label for="exampleInputName1">Comment</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Comment" name = "Comment" required >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1" style="font-size : 20px">Questionnaires</label>
                        <select class="form-select " name="QR">
                          <?php
                              foreach ($Questionnaires as $Questionnaire)
                              {?>
                                <option value="<?php echo $Questionnaire["QuestionnaireId"] ?>"><?php echo $Questionnaire["Type"] ?></option>
                              <?php
                              } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputCity1">Date</label>
                        <input type="Date" class="form-control" id="exampleInputCity1" placeholder="Date" name="Date" required >
                        </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1" style="font-size : 20px">Evaluatee ID</label>
                        <select class="form-select " name="EVE">
                          <?php
                              foreach ($Members as $Member) 
                              {?>
                                <option value="<?php echo $Member["Id"] ?>"><?php echo $Member["Name"] ?></option>
                              <?php
                              } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1" style="font-size : 20px">Evaluator Id</label>
                        <select class="form-select " name="EVR">
                          <?php
                              foreach ($FacultyMembers as $Faculty) 
                              {?>
                                <option value="<?php echo $Faculty["Id"] ?>"><?php echo $Faculty["Name"] ?></option>
                              <?php
                              } ?>
                        </select>
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