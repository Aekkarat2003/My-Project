<link rel="stylesheet" href="css/navbarl.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<!--Main Navigation-->
<header>
<?php 

if (isset($_SESSION['admin_login'])) {
    $admin_id = $_SESSION['admin_login'];
    $stmt = $conn->query("SELECT * FROM users WHERE id = $admin_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
  <!-- Sidebar -->
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <a 
          href="admin.php" 
          class="list-group-item list-group-item-action py-2 ripple <?php echo ($currentPage == 'admin') ? 'active' : ''; ?>" 
          aria-current="true">
          <i class="fa-solid fa-house me-3"></i><span>หน้าหลัก</span>
        </a>
        <a 
          href="edit_user.php" 
          class="list-group-item list-group-item-action py-2 ripple <?php echo ($currentPage == 'edit_user') ? 'active' : ''; ?>">
          <i class="fa-solid fa-user-pen me-3"></i><span>จัดการข้อมูลผู้ใช้</span>
        </a>
        <a 
          href="edit_techer.php" 
          class="list-group-item list-group-item-action py-2 ripple <?php echo ($currentPage == 'manage_teacher') ? 'active' : ''; ?>">
          <i class="fa-solid fa-chalkboard-user me-3"></i><span>จัดการข้อมูลครู</span>
        </a>
        <a 
          href="edit_student.php" 
          class="list-group-item list-group-item-action py-2 ripple <?php echo ($currentPage == 'manage_student') ? 'active' : ''; ?>">
          <i class="fa-solid fa-address-card me-3"></i><span>จัดการข้อมูลนักเรียน</span>
        </a>
        <a 
          href="edit_project.php" 
          class="list-group-item list-group-item-action py-2 ripple <?php echo ($currentPage == 'manage_project') ? 'active' : ''; ?>">
          <i class="fa-solid fa-file-pen me-3"></i><span>จัดการข้อมูลโครงงาน</span>
        </a>

      </div>
    </div>
  </nav>
  <!-- Sidebar -->

  <!-- Navbar -->
  <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu"
        aria-controls="sidebarMenu"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>

      <!-- Brand -->
      <a class="navbar-brand" href="#">
        <img
          src="logo/Udvc.png"
          alt="UDVC Logo"
          loading="lazy"
          width="30" 
          height="30"
        />
        <h2>UDVC</h2>
      </a>
      

      <!-- Right links -->
      <ul class="navbar-nav ms-auto d-flex flex-row">
        <!-- Notification dropdown -->
        <li class="nav-item dropdown">
          <a
            class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow"
            href="#"
            id="navbarDropdownMenuLink"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            <i class="fas fa-bell"></i>
            <span class="badge rounded-pill badge-notification bg-danger">1</span>
          </a>
          <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="navbarDropdownMenuLink"
          >
            <li>
              <a class="dropdown-item" href="#">Some news</a>
            </li>
            <li>
              <a class="dropdown-item" href="#">Another news</a>
            </li>
            <li>
              <a class="dropdown-item" href="#">Something else here</a>
            </li>
          </ul>
        </li>

        <!-- Avatar -->
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center"
            href="#"
            id="navbarDropdownMenuLink"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >

            <span class="ms-2"><?php echo $row['username'] ?></span>
          </a>
          <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="navbarDropdownMenuLink"
          >
            <li>
              <a class="dropdown-item" href="#">My profile</a>
            </li>
            <li>
              <a class="dropdown-item" href="#">Settings</a>
            </li>
            <li>
              <a class="dropdown-item" href="logout.php">Logout</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->
</header>
<!--Main Navigation-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!--Main layout-->
<main style="margin-top: 58px;">
  <div class="container pt-4"></div>
</main>
<!--Main layout-->