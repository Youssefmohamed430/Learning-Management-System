<?php
  require_once __DIR__ . '../../../../../Controllers/AuthController.php';
  require_once __DIR__ . '../../../../../Controllers/NotificationController.php';
if (isset($_POST["logout"]) && !empty($_POST["logout"])) {
  $authcontroller = new AuthController;
  $authcontroller->Logout();
  header("Location: \Learning-Management-System\Views\pages\samples\login.php"); 
  exit();
}

$notificationscontroller = new NotificationController;

$notifications = $notificationscontroller->SendNotification($_SESSION["Id"]);
?>
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <a class="navbar-brand brand-logo" href="../../../index.php">
              <img src="/Learning-Management-System/imgs/lmslogo.png" alt="logo" style="width: 100px; height: 70px; padding: 10px; border-radius: 5px; background-color: #fff; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);" />
          </a>
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
                  <img src="\Learning-Management-System\Views\assets\images\faces\face1.jpg" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black"><?php echo $_SESSION["Name"]?></p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <div class="dropdown-divider"></div>
                  <form action="" method="post">
                    <input type="hidden" name="logout" value="true"/>
                    <button type="submit" class="btn btn-gradient-primary btn-fw">
                        <i class="mdi mdi-logout me-2 text-primary"></i> Signout
                    </button>
                  </form>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-email-outline"></i>
                <span class="count-symbol bg-warning"></span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count-symbol bg-danger"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0">Notifications</h6>
                <?php
                  foreach($notifications as $notif)
                  {
                ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <p class="text-gray ellipsis mb-0"> <?php echo $notif->getMessage(); ?> </p>
                    <p class="text-gray ellipsis mb-0"> <?php echo $notif->getDateSent(); ?> </p>
                  </div>
                </a>
                <?php
                  }
                  ?>
              </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>