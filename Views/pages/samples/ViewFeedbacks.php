<?php
require_once '../../../Controllers/QuestionnaireController.php';
require_once '../../../Models/Evaluation.php';
require_once '../../../Models/QuestionResponse.php';

session_start();
if (!isset($_SESSION["role"])) {
    header("location: Login.php");
} else {
    if ($_SESSION["role"] != "Faculty") {
        header("location: Login.php");
    }
}

$questionnaireController = new QuestionnaireController();
$facultyId = $_SESSION["Id"];
$feedbacks = $questionnaireController->GetFacultyFeedbacks($facultyId);


$ratings = [];
$comments = [];

foreach ($feedbacks as $feedback) {
    if (!empty($feedback['Comment'])) {
        $comments[] = $feedback;
    }
    if (!empty($feedback['Responses'])) {
        $ratings[] = $feedback;
    }
}

// Determine which tab to show
$activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'ratings';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>View Feedbacks</title>
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
        .rating-stars {
            color: #ffc107;
            font-size: 1.2rem;
        }
        .feedback-card {
            margin-bottom: 20px;
            border-radius: 10px;
        }
        .nav-tabs .nav-link.active {
            font-weight: bold;
            border-bottom: 3px solid #4b49ac;
        }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <a class="navbar-brand brand-logo" href="../../../Views/index.php"><img src="../../assets/images/logo.svg" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="../../../Views/index.php"><img src="../../assets/images/logo-mini.svg" alt="logo" /></a>
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
                  <p class="mb-1 text-black"><?php echo $_SESSION["Name"]?></p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
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
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"><?php echo $_SESSION["Name"]?></span>
                  <span class="text-secondary text-small"><?php echo $_SESSION["role"]?></span>
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
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">View Feedbacks</h4>
                    
                    <ul class="nav nav-tabs" id="feedbackTabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link <?php echo $activeTab === 'ratings' ? 'active' : '' ?>" 
                           id="ratings-tab" 
                           href="?tab=ratings" 
                           role="tab">Ratings</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link <?php echo $activeTab === 'comments' ? 'active' : '' ?>" 
                           id="comments-tab" 
                           href="?tab=comments" 
                           role="tab">Comments</a>
                      </li>
                    </ul>
                    
                    <div class="tab-content mt-4" id="feedbackTabsContent">
                      <!-- Ratings Tab -->
                      <div class="tab-pane fade <?php echo $activeTab === 'ratings' ? 'show active' : '' ?>" 
                           id="ratings" 
                           role="tabpanel" 
                           aria-labelledby="ratings-tab">
                           
                        <?php if (empty($ratings)): ?>
                          <div class="alert alert-info">
                            No ratings available yet.
                          </div>
                        <?php else: ?>
                          <?php foreach ($ratings as $rating): ?>
                            <div class="card feedback-card">
                              <div class="card-header">
                                <h5>Evaluation from <?php echo htmlspecialchars($rating['EvaluatorName']); ?>
                                  <small class="float-right text-muted"><?php echo date('M d, Y', strtotime($rating['Date'])); ?></small>
                                </h5>
                                <p class="text-muted">Questionnaire: <?php echo htmlspecialchars($rating['QuestionnaireType']); ?></p>
                              </div>
                              <div class="card-body">
                                <?php foreach ($rating['Responses'] as $response): ?>
                                  <div class="mb-3">
                                    <h6><?php echo htmlspecialchars($response['QuestionText']); ?></h6>
                                    <?php if (!empty($response['Rating'])): ?>
                                      <div class="rating-stars">
                                        <?php 
                                        $filledStars = (int)$response['Rating'];
                                        $emptyStars = 5 - $filledStars;
                                        
                                        for ($i = 0; $i < $filledStars; $i++) {
                                            echo '<i class="mdi mdi-star"></i>';
                                        }
                                  
                                        for ($i = 0; $i < $emptyStars; $i++) {
                                            echo '<i class="mdi mdi-star-outline"></i>';
                                        }
                                        ?>
                                        <span class="ml-2">(<?php echo $response['Rating']; ?>/5)</span>
                                      </div>
                                    <?php endif; ?>
                                    <?php if (!empty($response['ResponseText'])): ?>
                                      <div class="mt-2 p-2 bg-light rounded">
                                        <p class="mb-0"><?php echo htmlspecialchars($response['ResponseText']); ?></p>
                                      </div>
                                    <?php endif; ?>
                                  </div>
                                  <hr>
                                <?php endforeach; ?>
                              </div>
                            </div>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </div>
                      
                      <!-- Comments Tab -->
                      <div class="tab-pane fade <?php echo $activeTab === 'comments' ? 'show active' : '' ?>" 
                           id="comments" 
                           role="tabpanel" 
                           aria-labelledby="comments-tab">
                           
                        <?php if (empty($comments)): ?>
                          <div class="alert alert-info">
                            No comments available yet.
                          </div>
                        <?php else: ?>
                          <?php foreach ($comments as $comment): ?>
                            <div class="card feedback-card">
                              <div class="card-header">
                                <h5>Comment from <?php echo htmlspecialchars($comment['EvaluatorName']); ?>
                                  <small class="float-right text-muted"><?php echo date('M d, Y', strtotime($comment['Date'])); ?></small>
                                </h5>
                                <p class="text-muted">Questionnaire: <?php echo htmlspecialchars($comment['QuestionnaireType']); ?></p>
                              </div>
                              <div class="card-body">
                                <blockquote class="blockquote">
                                  <p><?php echo htmlspecialchars($comment['Comment']); ?></p>
                                </blockquote>
                              </div>
                            </div>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
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
    <script src="../../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <script src="../../assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
  </body>
</html>