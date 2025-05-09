<?php
  require_once '../../../Controllers/StudentController.php';
  require_once '../../../Models/Student.php';
  session_start();
  if (!isset($_SESSION["role"])) {
  
    header("location: Login.php ");
  } else {
    if ($_SESSION["role"] != "Admin") {
      header("location: Login.php ");
    }
  }
  $StudentController = new StudentController;
  $student = new Student;
  $errmsg = "";

  session_start();

  if (isset($_SESSION['studentid'])) 
  {
      $result = $StudentController->ShowUserData($_SESSION['studentid']);
      if($result === false)
      {
          $errmsg = "Error";
      }
  } 
  else 
  {
      $errmsg = "Error";
  }

  if(isset($_POST["Name"]) && isset($_POST["Username"]) && isset($_POST["Email"]) && isset($_POST["Password"]) && isset($_POST["age"]))
  {
    if(!empty($_POST["Name"]) && !empty($_POST["Username"]) && !empty($_POST["Email"]) && !empty($_POST["Password"]) && !empty($_POST["age"]))
    {
          $student->setId($_SESSION['studentid']);
          $student->setName($_POST["Name"]);
          $student->setUsername($_POST["Username"]);
          $student->setEmail($_POST["Email"]);
          $student->setPassword($_POST["Password"]);
          $student->setRoleName("Faculty");
          $student->setAge($_POST["age"]);

          $errmsg = $StudentController->UpdateUser($student);
          
          if($errmsg === "")
          {
              header("Location: ManageUsers.php");
          }
    }
      else
      {
          $errmsg = "Please fill all fields";
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
          <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Faculty Member</h4>
                    <form class="forms-sample" method = "Post">
                    <?php 
                      if($errmsg!="")
                      {
                          ?>
                              <div class="alert alert-danger" role="alert"><?php echo $errmsg ?></div>
                          <?php
                      }
                    ?>
                    <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Name</label>
                        <input type="text" class="form-control" id="InputName" placeholder="Name" name = "Name" value = "<?php echo $result->getName()?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Username</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" name="Username" value = "<?php echo $result->getUsername()?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Age</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="age" name="age" value = "<?php echo $result->getAge()?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="Email" value = "<?php echo $result->getEmail()?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="Password" value = "<?php echo $result->getPassword()?>">
                      </div>
                      <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
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