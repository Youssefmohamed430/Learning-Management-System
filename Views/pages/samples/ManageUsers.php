<?php
  require_once '../../../Controllers/AdminController.php';
  require_once '../../../Controllers/UserController.php';
  require_once '../../../Controllers/MemberController.php';
  require_once '../../../Controllers/StudentController.php';

session_start();
if (!isset($_SESSION["role"])) {

  header("location: Login.php ");
} else {
  if ($_SESSION["role"] != "Admin") {
    header("location: Login.php ");
  }
}
  $admin = new AdminController;
  $Member = new MemberController;
  $Student = new AdminController;

  $errmsg = "";
  if(isset($_POST["userid"]))
  {
      if(!empty($_POST["userid"]))
      {
          $errmsg = $admin->DeleteUser($_POST["userid"]);
      }
      else
      {
        $errmsg = "Delete failed";
      }
  }

  if(isset($_POST["editadminid"]))
  {
      if(!empty($_POST["editadminid"]))
      {
          session_start();
          $_SESSION["userid"] = $_POST["editadminid"];
          header("Location: EditAdmin.php");
      }
      else
      {
        $errmsg = "Error";
      }
  }

  if(isset($_POST["editmemberid"]))
  {
      if(!empty($_POST["editmemberid"]))
      {
          session_start();
          $_SESSION["memberid"] = $_POST["editmemberid"];
          header("Location: EditMember.php");
      }
      else
      {
        $errmsg = "Error";
      }
  }

  if(isset($_POST["editstudentid"]))
  {
      if(!empty($_POST["editstudentid"]))
      {
          session_start();
          $_SESSION["studentid"] = $_POST["editstudentid"];
          header("Location: EditStudent.php");
      }
      else
      {
        $errmsg = "Error";
      }
  }

  $Admins = $admin->GetAll("Admin");
  $Students = $Student->GetAll("Student");
  $Members = $Member->GetAll("Faculty");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
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
                  <span class="font-weight-bold mb-2"><?php echo $_SESSION["Name"]?></span>
                  <span class="text-secondary text-small"><?php echo $_SESSION["role"]?></span>
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
          <!-- Admin Table-->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Admins</h4>
                    <table class="table">
                      <thead>
                        <tr>
                          <!-- <th>Profile</th> -->
                          <th>Id</th>
                          <th>Name</th>
                          <th>User Name</th>
                          <th>Email</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        foreach($Admins as $admin)
                        {
                          ?>
                            <tr>
                              <td><?php echo $admin["Id"]?></td>
                              <td><?php echo $admin["Name"]?></td>
                              <td><?php echo $admin["UserName"]?></td>
                              <td><?php echo $admin["Email"]?></td>
                              <td>
                                <form action="" method="post">
                                  <input type="hidden" name="editadminid" value="<?php echo $admin["Id"]?>"/>
                                  <button type="submit" class="btn btn-gradient-primary btn-fw">
                                    <i class="fa fa-edit"></i>
                                  </button>
                                </form>
                              </td>
                              <td>
                                <form action="" method="post">
                                  <input type="hidden" name="userid" value="<?php echo $admin["Id"]?>"/>
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
          <a href="/Learning-Management-System/Views/pages/samples/AddAdmin.php" class="btn btn-gradient-primary btn-fw">
              Add Admin
          </a>
        <!-- Members -->
        <div class="row mt-4">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Faculty Members</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <!-- <th>Profile</th> -->
                          <th>Id</th>
                          <th>Name</th>
                          <th>User Name</th>
                          <th>Email</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        foreach($Members as $Member)
                        {
                          ?>
                            <tr>
                              <td><?php echo $Member["Id"]?></td>
                              <td><?php echo $Member["Name"]?></td>
                              <td><?php echo $Member["UserName"]?></td>
                              <td><?php echo $Member["Email"]?></td>
                              <td>
                                <form action="" method="post">
                                  <input type="hidden" name="editmemberid" value="<?php echo $Member["Id"]?>"/>
                                  <button type="submit" class="btn btn-gradient-primary btn-fw">
                                    <i class="fa fa-edit"></i>
                                  </button>
                                </form>
                              </td>
                              <td>
                                <form action="" method="post">
                                  <input type="hidden" name="userid" value="<?php echo $Member["Id"]?>"/>
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
          <div class="mt-2">
              <a href="/Learning-Management-System/Views/pages/samples/AddFacultyMember.php" class="btn btn-gradient-primary btn-sm-custom">
                  Add Member
              </a>
          </div>
          <!-- Students -->
          <div class="row mt-4">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Students</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <!-- <th>Profile</th> -->
                          <th>Id</th>
                          <th>Name</th>
                          <th>User Name</th>
                          <th>Email</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        foreach($Students as $Student)
                        {
                          ?>
                            <tr>
                              <td><?php echo $Student["Id"]?></td>
                              <td><?php echo $Student["Name"]?></td>
                              <td><?php echo $Student["UserName"]?></td>
                              <td><?php echo $Student["Email"]?></td>
                              <td>
                                <form action="" method="post">
                                  <input type="hidden" name="editstudentid" value="<?php echo $Student["Id"]?>"/>
                                  <button type="submit" class="btn btn-gradient-primary btn-fw">
                                    <i class="fa fa-edit"></i>
                                  </button>
                                </form>
                              </td>
                              <td>
                                <form action="" method="post">
                                  <input type="hidden" name="userid" value="<?php echo $Student["Id"]?>"/>
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
          <div class="mt-2">
              <a href="/Learning-Management-System/Views/pages/samples/AddStudent.php" class="btn btn-gradient-primary btn-sm-custom">
                  Add Student
              </a>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <br>
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