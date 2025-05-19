<?php 

require_once '../../../Models/Exam.php';
require_once '../../../Models/Question.php';
require_once '../../../Models/StudentAnswer.php';
require_once '../../../Controllers/QuestionsController.php';
require_once '../../../Controllers/ExamController.php';
require_once '../../../Controllers/StudentAnswerController.php';

session_start();
if (!isset($_SESSION["role"])) {

  header("location: login.php ");
} else {
  if ($_SESSION["role"] != "Student") {
    header("location: login.php ");
  }
}

$errmsg = "";
$successMsg = "";

$examController = new ExamController;
$questionsController = new QuestionsController;
$studentAnswercontroller = new StudentAnswerController;

$exam = $examController -> getCourseExam($_SESSION["courseid"]);
$id=$exam[0]["ExamId"];
$questions = $questionsController -> getAllQuestion($id);
$answers = [];
    for($i = 0 ; $i < Count($questions);$i++)
    {
          $QId = $questions[$i]["QuestionId"];
        if(isset($_POST["answer".$QId]) )
        {
            if(!empty($_POST["answer".$QId]))
            {
                $studentanswer = new StudentAnswer;
                $studentanswer->setAnswer($_POST["answer".$QId]);
                $studentanswer->setQuestionId($QId);
                $studentanswer->setExamId($id);
                $answers[$i] = $studentanswer;
            }
        }
    }
    $result = $studentAnswercontroller->setAnswersToQuestions($answers);
    
        if($result === false)
            $errmsg = "Error";
        //   else
            // header("Location: \Learning-Management-System\Views\index.php");
        // print_r($exam[0]["ExamId"]); 



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
    <link rel="stylesheet" href="../../assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="../../assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
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
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"> <?php echo $exam[0]['Title'] ?></h4>
                    <p class="card-description"> A <?php echo $exam[0]['Type'] ?> Course Exam</p>
                    <form method="post" class="forms-sample">
                      <div class="form-group">
                        <?php
                              foreach($questions as $question) {
                            ?>
                              <label for="exampleInputName1"><?php echo $question['Text'] ?></label>
                              <input required name="answer<?php echo $question['QuestionId'] ?>" type="text" class="form-control" id="exampleInputName1" placeholder="Enter the answer">
                              <br>
                            <?php
                                }
                            ?>
                        </div>
                      <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
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
    <script src="../../assets/vendors/select2/select2.min.js"></script>
    <script src="../../assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <script src="../../assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../../assets/js/file-upload.js"></script>
    <script src="../../assets/js/typeahead.js"></script>
    <script src="../../assets/js/select2.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>