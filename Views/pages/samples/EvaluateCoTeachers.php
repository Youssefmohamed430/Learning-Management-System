<?php

require_once '../../../Controllers/DBController.php';
require_once '../../../Controllers/EvaluateController.php';

session_start();
if (!isset($_SESSION["role"])) {
    header("location: Login.php");
} else {
    if ($_SESSION["role"] != "Faculty") {
        header("location: Login.php");
    }
}
$errmsg = "";
$EvController = new EvaluateController;
$Evaluations = $EvController->getAllEvaluations($_SESSION["Id"]);
if($Evaluations === false){
  $errmsg = "Error";
}

if(isset($_POST["DeleteEvaluate"]))
{
  if(!empty($_POST["DeleteEvaluate"]))
  {
    $errmsg = $EvController->DeleteEvaluate($_POST["DeleteEvaluate"]);
  }
}

if(isset($_POST["EditEvaluate"]))
{
  if(!empty($_POST["EditEvaluate"]))
  {
    session_start();
    $_SESSION["EvaluationId"] = $_POST["EditEvaluate"];
    header("Location: EditEvaluate.php");
  }
  else
  {
    $errmsg = "Error";
  }
}
if(isset($_POST["EvaluationQuestionnaire"]))
{
  if(!empty($_POST["EvaluationQuestionnaire"]))
  {
    session_start();
    $_SESSION["EvaluationId"] = $_POST["EvaluationQuestionnaire"];
    header("Location: EvaluationQuestionnaire.php");
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
                  <span class="font-weight-bold mb-2"><?php $_SESSION["Name"]?></span>
                  <span class="text-secondary text-small"><?php $_SESSION["role"]?></span>
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
          <table class="table">
              <thead>
                  <tr>
                    <th>Evaluation Id</th>
                    <th>Comment</th>
                    <th>Date</th>
                    <th>evaluatee_id</th>
                    <th>Edit Evaluation</th>
                    <th>Evaluation Questionnaire</th>
                    <th>Delete Evaluation</th>
                    </tr>
              </thead>
          <tbody>
              <?php 
                foreach($Evaluations as $Evaluate)
                {
                  ?>
                  <tr>
                  <td><?php echo $Evaluate["EvaluationId"]?></td>
                  <td><?php echo $Evaluate["Comment"]?></td>
                  <td><?php echo $Evaluate["Date"]?></td>
                  <td><?php echo $Evaluate["evaluatee_id"]?></td>
                  
                  <td>
                  <form action="" method="post">
                  <input type="hidden" name="EditEvaluate" value="<?php echo $Evaluate["EvaluationId"]?>"/>
                  <button type="submit" class="btn btn-gradient-primary btn-fw">
                  <i class="fa fa-edit"></i>
                  </button>
                  </form>
                  </td>
                  <td>
                  <form action="" method="post">
                  <input type="hidden" name="EvaluationQuestionnaire" value="<?php echo $Evaluate["EvaluationId"]?>"/>
                  <button type="submit" class="btn btn-gradient-primary btn-fw">
                  <i class="fa fa-edit"></i>
                  </button>
                  </form>
                  </td>
                  <td>
                  <form action="" method="post">
                  <input type="hidden" name="DeleteEvaluate" value="<?php echo $Evaluate["EvaluationId"]?>"/>
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
                <br>
                <a href="CreateEvaluate.php" class="btn btn-gradient-primary btn-fw">
                Create Evaluate
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