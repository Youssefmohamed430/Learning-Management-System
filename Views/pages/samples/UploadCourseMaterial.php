<?php
require_once '../../../Controllers/CoursesController.php';
require_once '../../../Models/CourseVideos.php';

session_start();
if (!isset($_SESSION["role"])) {
  header("Location: \Learning-Management-System\Views\pages\samples\login.php");
} else {
    if ($_SESSION["role"] != "Faculty") {
      header("Location: \Learning-Management-System\Views\pages\samples\login.php");
    }
}

$coursesController = new CoursesController();
$facultyId = $_SESSION["Id"];
$courses = $coursesController->GetFacultyCourses($facultyId);

$errmsg = "";
$successmsg = "";

// Handle form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["upload"])) {
    // Handle file upload
    $targetDir = "../../../Videos/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    
    $targetFile = $targetDir . basename($_FILES["videoFile"]["name"]);
    $uploadOk = 1;
    $videoFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    // Check if file is a video
    $validExtensions = array("mp4", "avi", "mov", "wmv");
    if (!in_array($videoFileType, $validExtensions)) {
        $errmsg = "Sorry, only MP4, AVI, MOV & WMV files are allowed.";
        $uploadOk = 0;
    }
    
    // Check if file already exists
    if (file_exists($targetFile)) {
        $errmsg = "Sorry, file already exists.";
        $uploadOk = 0;
    }
    
    // Upload file if everything is ok
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["videoFile"]["tmp_name"], $targetFile)) {
            $videoModel = new CoursesVideos();
            $videoModel->setCrsId($_POST["courseId"]);
            $videoModel->setVideoPath($targetFile);
            
            $result = $coursesController->UploadCourseVideo($videoModel);
            
            if ($result === "") {
                $successmsg = "The video has been uploaded successfully.";
            } else {
                $errmsg = $result;
                // Delete the uploaded file if DB insertion failed
                unlink($targetFile);
            }
        } else {
            $errmsg = "Sorry, there was an error uploading your file.";
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
    <title>Upload Course Material</title>
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
        .nav-tabs .nav-link.active {
          font-weight: bold;
          border-bottom: 3px solid #4b49ac;
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
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"><?php echo $_SESSION["Name"]?></span>
                  <span class="text-secondary text-small"><?php echo $_SESSION["role"]?></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="UploadCourseMaterial.php">
                  <span class="menu-title">Upload Course Material</span>
                  <i class="fa fa-video-camera menu-icon"></i> 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="ViewFeedbacks.php">
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
                    <h4 class="card-title">Upload Course Material</h4>
                    
                    <?php if (!empty($errmsg)): ?>
                      <div class="alert alert-danger">
                        <?php echo $errmsg; ?>
                      </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($successmsg)): ?>
                      <div class="alert alert-success">
                        <?php echo $successmsg; ?>
                      </div>
                    <?php endif; ?>
                    
                    <form method="post" enctype="multipart/form-data" class="forms-sample">
                      <div class="form-group">
                        <label for="courseSelect">Select Course</label>
                        <select class="form-control" id="courseSelect" name="courseId" required>
                          <option value="">-- Select Course --</option>
                          <?php foreach ($courses as $course): ?>
                            <option value="<?php echo $course['CrsId']; ?>" <?php echo (isset($_POST['courseId']) && $_POST['courseId'] == $course['CrsId']) ? 'selected' : ''; ?>>
                              <?php echo $course['CrsName']; ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      
                      <div class="form-group">
                            <label>Video Upload</label>
                            <div class="input-group col-xs-12">
                                <input type="file" name="videoFile" id="videoFile" class="form-control" style="display: none;" required>
                                <input type="text" class="form-control file-upload-info" id="file-info" disabled placeholder="Upload Video">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary" type="button" id="browse-btn">Browse</button>
                                </span>
                            </div>
                            <small class="form-text text-muted">Supported formats: MP4, AVI, MOV, WMV</small>
                        </div>
                      
                      <button type="submit" name="upload" class="btn btn-gradient-primary mr-2">Upload</button>
                    </form>
                    
                    <hr>
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
    <!-- Custom js for this page -->
    <script>
        $(document).ready(function() {
            // Handle file browse button click
            $('#browse-btn').click(function() {
                $('#videoFile').click();
            });

            // Update the file info when a file is selected
            $('#videoFile').change(function() {
                var fileName = $(this).val().split('\\').pop();
                $('#file-info').val(fileName);
            });

            // Handle course selection change
            $('#courseSelect').change(function() {
                if ($(this).val()) {
                    window.location.href = 'UploadCourseMaterial.php?courseId=' + $(this).val();
                }
            });
            
            // Initialize with courseId from URL if present
            const urlParams = new URLSearchParams(window.location.search);
            const courseId = urlParams.get('courseId');
            if (courseId) {
                $('#courseSelect').val(courseId);
            }
            
        });
    </script>
    <!-- End custom js for this page -->
  </body>
</html>