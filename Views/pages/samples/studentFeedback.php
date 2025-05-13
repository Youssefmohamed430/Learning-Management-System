<?php
require_once '../../../Controllers/MemberController.php';
require_once '../../../Controllers/QuestionnaireController.php';
require_once '../../../Models/QuestionResponse.php';
require_once '../../../Models/Evaluation.php';
session_start();
$memberController = new MemberController();
$questionnaireController = new QuestionnaireController();
$faculty = $memberController->GetAllFaculty();
$questions = $questionnaireController->GetQuestions();
$response = new QuestionResponse;
$answers = [];
$errmsg;
if(isset($_POST["faculty_id"]) && isset($_POST["comment"]))
{
    if(!empty($_POST["faculty_id"]) && !empty($_POST["comment"]))
    {
        for($i = 0 ; $i < Count($questions);$i++)
        {
            $QId = $questions[$i]["QuestionId"];
            if(isset($_POST["answer".$QId]) && isset($_POST["rating".$QId]))
            {
                if(!empty($_POST["answer".$QId]) && !empty($_POST["rating".$QId]))
                {
                    $response = new QuestionResponse;
                    $response->setResponseText($_POST["answer".$QId]);
                    $response->setQuestionId($QId);
                    $response->setRating($_POST["rating".$QId]);
                    $answers[$i] = $response;
                }
            }
        }
        $eval = new Evaluation($_POST["comment"],date("Y-m-d"),$_SESSION["Id"],$_POST["faculty_id"],$questions[0]["QuestionnaireId"]);
        $result = $questionnaireController->AddFeedback($answers,$eval);

        if($result === false)
            $errmsg = "Error";
          else
              header("Location: \Learning-Management-System\Views\index.php");
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
      <?php include_once '../samples/Components/nav.php';?>
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
            <h1>Student Feedback</h1>
          <form method="post" action="">
            <div class="form-group">
                <label for="facultySelect">Choose the faculty member</label>
                <select class="form-control" id="facultySelect" name="faculty_id" required>
                    <option value="">Select Faculty Member</option>
                      <?php
                      if($faculty !== false && !empty($faculty)) {
                          foreach($faculty as $member) {
                            ?>
                              <option value="<?php echo $member["Id"];?>" ><?php echo $member["Name"];?></option>
                              <?php
                          }
                      }
                      ?>
                </select>
            </div>
            <?php
            if($questions !== false && !empty($questions)) {
                for($i = 0 ; $i < Count($questions) ; $i++) {
                    ?>
                    <div class="form-group">
                        <label><?php echo $questions[$i]['Text']; ?></label>
                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Answer" name="answer<?php echo $questions[$i]["QuestionId"]?>">
                    </div>
                    <div class="form-group">
                        <label>Rating</label>
                        <select class="form-control" name="rating<?php echo $questions[$i]["QuestionId"]?>" required>
                            <option value="">Select Rating</option>
                            <option value="1" >1 - Poor</option>
                            <option value="2" >2 - Fair</option>
                            <option value="3" >3 - Good</option>
                            <option value="4" >4 - Very Good</option>
                            <option value="5" >5 - Excellent</option>
                        </select>
                    </div>
                    <?php
                }
            }
            ?>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Additional Comments</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="comment" rows="3"></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit Feedback</button>
        </form>

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