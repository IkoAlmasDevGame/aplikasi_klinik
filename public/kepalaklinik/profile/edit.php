<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php if ($_SESSION['hak_akses'] == "kepala_klinik"): ?>
      <?php require_once("../ui/header.php"); ?>
      <?php $input = new core\Database; ?>
      <title><?php echo $judul ?></title>
   <?php else: ?>
      <?php header("Location:" . URL_BASE . "admin/ui/header.php?page=beranda"); ?>
      <?php exit(0); ?>
   <?php endif; ?>
</head>

<body>
   <?php require_once("../ui/sidebar.php") ?>
   <section class="content">
      <div class="content-wrapper">
         <div class="panel panel-default bg-body-secondary p-5 rounded rounded-2">
            <div class="panel panel-body bg-body-tertiary p-5">
               <div class="panel panel-heading">
                  <h4 class="panel panel-title fst-normal fw-semibold display-4 fs-3">
                     <?php $data = explode("-", $judul); ?>
                     <?php echo $data[1]; ?>
                  </h4>
                  <div class="d-flex justify-content-end align-items-end flex-wrap">
                     <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page" class="text-decoration-none">
                           Beranda
                        </a>
                     </li>
                     <li class="breadcrumb breadcrumb-item">
                        <a href="?page=edit-profile&id_pengguna=<?= $_SESSION['kepala'] ?>" aria-current="page"
                           class="text-decoration-none">
                           <?php echo $data[1]; ?>
                        </a>
                     </li>
                  </div>
               </div>
               <div class="form-horizontal">
                  <div class="d-flex justify-content-center align-items-center flex-wrap">
                     <div class="col-sm-6 col-md-6">
                        <div class="card shadow mb-4">
                           <div class="card-header py-2">
                              <h4 class="card-title text-center text-dark fs-4 fw-semibold">
                                 <?php echo $data[1]; ?>
                              </h4>
                           </div>
                           <div class="card-body my-2">
                              <?php $sql = $input->SELECT_WHERE("tb_user", "id_pengguna", $_SESSION['kepala']); ?>
                              <?php $set = mysqli_fetch_array($sql); ?>
                              <div class="text-center my-2 fw-normal fs-4">
                                 <?php echo $data[1] . " - " . $set['pengguna'] ?>
                                 <div class="border border-top"></div>
                              </div>
                              <form action="?aksi=edit_profile" class="form-group" method="post">
                                 <?php echo $input->form_input("hidden", "", "", "", "id_pengguna", "", "", $set['id_pengguna']); ?>
                                 <div class="form-inline my-1">
                                    <div class="row justify-content-center align-items-center flex-wrap">
                                       <div class="form-label col-sm-4">
                                          <label for="" class="control-label">Password Lama</label>
                                       </div>
                                       <div class="col-sm-6">
                                          <?php echo $input->form_input("password", "", "64", "form-control", "sandi_lama", "Enter Text Password ...", "", "") ?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-inline my-1">
                                    <div class="row justify-content-center align-items-center flex-wrap">
                                       <div class="form-label col-sm-4">
                                          <label for="" class="control-label">Password Baru</label>
                                       </div>
                                       <div class="col-sm-6">
                                          <?php echo $input->form_input("password", "", "64", "form-control", "sandi_baru", "Enter Text Password ...", "", "") ?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-inline my-1">
                                    <div class="row justify-content-center align-items-center flex-wrap">
                                       <div class="form-label col-sm-4">
                                          <label for="" class="control-label">Password Verify</label>
                                       </div>
                                       <div class="col-sm-6">
                                          <?php echo $input->form_input("password", "", "64", "form-control", "sandi_verify", "Enter Text Password ...", "", "") ?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="card-footer">
                                    <div class="text-center">
                                       <button type="submit" name="simpan" class="btn btn-primary"
                                          aria-current="page">
                                          <i class="fas fa-save fa-fw fw-1x"></i>
                                          Update Password
                                       </button>
                                       <button type="reset" class="btn btn-danger" aria-current="page">
                                          <i class="fas fa-eraser fa-fw fw-1x"></i>
                                          Hapus Semua
                                       </button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <?php require_once("../ui/footer.php") ?>