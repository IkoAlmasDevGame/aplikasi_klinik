<?php
if ($_SESSION['hak_akses'] == "") {
   header("location:" . URL_BASE . "index.php");
   exit(0);
}
?>

<?php if ($_SESSION['hak_akses'] == "admin"): ?>
   <?php $data = $cmb->SELECT_WHERE("tb_user", "id_pengguna", $_SESSION['admin']); ?>
   <?php $baseFile = mysqli_fetch_array($data); ?>
   <header id="header" class="header fixed-top d-flex align-items-center" style="position:fixed">
      <div class="d-flex align-items-center justify-content-between">
         <a href="" role="button" class="d-flex align-items-center fs-5 fst-normal fw-semibold">
            <img src="<?= BASE_URL ?>assets/icon/<?= $row['foto_icon'] ?>" class="img-responsive" width="32" height="32"
               alt="<?= $row['foto_icon'] ?>">
         </a>
         <i class="bi bi-list toggle-sidebar-btn mx-5 mx-lg-5"></i>
         <?php $data = explode(" ", $row['nama_website']); ?>
         <h4 class="fw-semibold fst-italic fs-5 display-4">
            <?php echo $data[1] . " " . $data[2] . " " . $data[3] . " " . $data[4]; ?>
         </h4>
      </div><!-- End Logo -->

      <nav class="header-nav ms-auto mx-3">
         <ul class="d-flex justify-content-center align-items-center mx-auto">
            <li class="nav-item dropdown pe-3">
               <a class="nav-link d-flex align-items-center pe-0" href="#" role="button" data-bs-toggle="dropdown"
                  aria-controls="dropdown">
                  <i class="fa fa-regular fa-calendar fa-2x"></i>
                  <span class="d-none d-md-block dropdown-toggle ps-2"></span>
               </a>
               <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <?php require_once("../ui/calendar.php") ?>
               </ul>
            </li>
            <li class="nav-item dropdown pe-4">
               <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" role="button"
                  data-bs-toggle="dropdown" aria-controls="dropdown">
                  <div class="btn btn-light position-relative">
                     <?php if ("user_logo.png" != "") { ?>
                        <img src="<?php echo BASE_URL . "assets/foto/user_logo.png" ?>" class="img-responsive rounded-2"
                           style="width: 25px; max-width: 100%;" alt="user_logo.png">
                        <?php if ($baseFile['status'] == "online"): ?>
                           <span class="position-absolute top-0 start-100 translate-middle
                      p-2 bg-success border border-light rounded-circle">
                              <span class="visually-hidden">
                              </span>
                           </span>
                        <?php endif; ?>
                     <?php } else { ?>
                        <img src="<?php echo BASE_URL . "assets/default/user_logo.png"; ?>" class="img-responsive rounded-2"
                           style="width: 25px; max-width: 100%;" alt="user_logo.png">
                        <?php if ($baseFile['status'] == "offline"): ?>
                           <span class="position-absolute top-0 start-100 translate-middle
                         p-2 bg-danger border border-light rounded-circle">
                              <span class="visually-hidden">
                              </span>
                           </span>
                        <?php endif; ?>
                     <?php } ?>
                  </div>
                  <span class="d-none d-md-block dropdown-toggle ps-2"></span>
               </a>
               <!-- End Profile Iamge Icon -->
               <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                  <li class="dropdown-header">
                     <h4 class="fs-6 fw-normal text-start text-dark">
                        <div class="form-inline row justify-content-start align-items-start flex-wrap my-2">
                           <div class="col-sm-4 col-md-4">
                              <label for="">username</label>
                           </div>
                           <div class="col-sm-1 col-md-1">:</div>
                           <div class="col-sm-6 col-md-6">
                              <?php echo $baseFile['pengguna']; ?>
                           </div>
                        </div>
                     </h4>
                     <hr class="dropdown-divider">
                     <h4 class="fs-6 fw-normal text-start text-dark">
                        <div class="form-inline row justify-content-start align-items-start flex-wrap my-2">
                           <div class="col-sm-4 col-md-4">
                              <label for="">Jabatan</label>
                           </div>
                           <div class="col-sm-1 col-md-1">:</div>
                           <div class="col-sm-6 col-md-6">
                              <?php echo $baseFile['hak_akses']; ?>
                           </div>
                        </div>
                     </h4>
                     <hr class="dropdown-divider my-2">
                     <div class="text-center">
                        <a href="?page=edit-profile&pengguna=<?= $_SESSION['username'] ?>" aria-current="page"
                           class="btn btn-sm btn-info mx-1">
                           <i class="fas fa-fw fa-user-edit fa-1x"></i>
                           Edit Profile
                        </a>
                        <a href="?page=logout&admin=<?= $baseFile['id_pengguna'] ?>"
                           onclick="return confirm('Apakah anda ingin keluar dari website ini ?')" aria-current="page"
                           class="btn btn-sm btn-danger mx-1">
                           <i class="fas fa-fw fa-sign-out-alt fa-1x"></i>
                           Log Out
                        </a>
                     </div>
                  </li>
               </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
         </ul>
      </nav><!-- End Icons Navigation -->
   </header>
   <!-- ======= Header ======= -->
   <!-- ======= Sidebar ======= -->
   <aside id="sidebar" style="background: rgba(100, 107, 107, 1);" class="sidebar">
      <ul class="sidebar-nav" id="sidebar-nav">
         <li class="nav-item">
            <a href="?page=beranda" aria-current="page" class="nav-link collapsed">
               <i class="fas fa-fw fa-home fa-1x"></i>
               <div class="fs-6 display-4 text-dark fw-normal">Beranda</div>
            </a>
         </li>
         <div class="my-3 border border-top"></div>
         <h4 class="fw-semibold display-4 fst-normal fs-4 text-light">Data Master Input</h4>
         <div class="my-3 border border-top"></div>
         <li class="nav-item">
            <a href="?page=dokter" aria-current="page" class="nav-link collapsed">
               <i class="fas fa-fw fa-user-nurse fa-1x"></i>
               <div class="fs-6 display-4 text-dark fw-normal">Data Dokter</div>
            </a>
         </li>
         <li class="nav-item">
            <a href="?page=pasien" aria-current="page" class="nav-link collapsed">
               <i class="fas fa-fw fa-user fa-1x"></i>
               <div class="fs-6 display-4 text-dark fw-normal">Data Pasien</div>
            </a>
         </li>
         <div class="my-3 border border-top"></div>
         <h4 class="fw-semibold display-4 fst-normal fs-5 text-light">Data Master Pendaftaran</h4>
         <div class="my-3 border border-top"></div>
         <li class="nav-item">
            <a href="?page=pendaftaran" aria-current="page" class="nav-link collapsed">
               <i class="fas fa-fw fa-file-upload fa-1x"></i>
               <div class="fs-6 display-4 text-dark fw-normal">Dalam Antrian</div>
            </a>
         </li>
         <li class="nav-item">
            <a href="?page=telah_diperiksa" aria-current="page" class="nav-link collapsed">
               <i class="fas fa-fw fa-check fa-1x"></i>
               <div class="fs-6 display-4 text-dark fw-normal">Telah Diperiksa</div>
            </a>
         </li>
         <li class="nav-item">
            <a href="?page=rekam_medis" aria-current="page" class="nav-link collapsed">
               <i class="fas fa-fw fa-file-alt fa-1x"></i>
               <div class="fs-6 display-4 text-dark fw-normal">Rekam Medis</div>
            </a>
         </li>
         <li class="nav-item">
            <a href="?page=users" aria-current="page" class="nav-link collapsed">
               <i class="fas fa-fw fa-users fa-1x"></i>
               <div class="fs-6 display-4 text-dark fw-normal">users</div>
            </a>
         </li>
         <div class="my-3 border border-top"></div>
         <h4 class="fw-semibold display-4 fst-normal fs-4 text-light">Data Master Laporan</h4>
         <div class="my-3 border border-top"></div>
         <li class="nav-item">
            <a href="?page=laporan-pasien" aria-current="page" class="nav-link collapsed">
               <i class="fas fa-fw fa-file-alt fa-1x"></i>
               <div class="fs-6 display-4 text-dark fw-normal">Laporan Pasien</div>
            </a>
         </li>
         <li class="nav-item">
            <a href="?page=laporan-dokter" aria-current="page" class="nav-link collapsed">
               <i class="fas fa-fw fa-file-alt fa-1x"></i>
               <div class="fs-6 display-4 text-dark fw-normal">Laporan Dokter</div>
            </a>
         </li>
         <li class="nav-item">
            <a href="?page=laporan-pendaftaran" aria-current="page" class="nav-link collapsed">
               <i class="fas fa-fw fa-file-alt fa-1x"></i>
               <div class="fs-6 display-4 text-dark fw-normal">Laporan Pendaftaran</div>
            </a>
         </li>
         <li class="nav-item">
            <a href="?page=laporan-rekam_medis" aria-current="page" class="nav-link collapsed">
               <i class="fas fa-fw fa-file-alt fa-1x"></i>
               <div class="fs-6 display-4 text-dark fw-normal">Laporan Rekam Medis</div>
            </a>
         </li>
         <li class="nav-item">
            <a href="?page=laporan-users" aria-current="page" class="nav-link collapsed">
               <i class="fas fa-fw fa-file-alt fa-1x"></i>
               <div class="fs-6 display-4 text-dark fw-normal">Laporan Users</div>
            </a>
         </li>
      </ul>
   </aside>
   <!-- ======= Sidebar ======= -->
   <main id="main" class="main">
      <section class="section dashboard">
         <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
               <div class="row">

               </div>

            </div><!-- End Right side columns -->

         </div>
      </section>
   <?php else: ?>
      <?php
      header("location:" . URL_BASE . "index.php");
      exit(0);
      ?>
   <?php endif; ?>