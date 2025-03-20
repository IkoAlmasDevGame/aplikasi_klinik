<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php if ($_SESSION['hak_akses'] == "admin"): ?>
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
                           <a href="?page=users" aria-current="page" class="text-decoration-none">
                              Data Master Users
                           </a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                           <a href="?aksi=tambah-users" aria-current="page" class="text-decoration-none">
                              <?php echo $data[1]; ?>
                           </a>
                        </li>
                     </div>
                  </div>
                  <div class="d-flex justify-content-center align-items-center flex-wrap">
                     <div class="col-sm-6 col-md-6">
                        <div class="card shadow mb-4">
                           <div class="card-header py-3">
                              <div class="d-flex justify-content-between align-items-center flex-wrap">
                                 <img src="<?= BASE_URL ?>assets/icon/<?= $row['foto_icon'] ?>" alt=""
                                    class="col-sm-2 col-md-2">
                                 <h4 class="card-title fs-4 fst-normal fw-normal">
                                    <?php echo $data[1]; ?>
                                 </h4>
                              </div>
                           </div>
                           <div class="card-body my-2">
                              <div class="form-horizontal">
                                 <form action="?aksi=tambah_users" class="form-group" role="form" method="post">
                                    <div class="form-inline my-2">
                                       <div class="row justify-content-center align-items-center flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Username</label>
                                          </div>
                                          <div class="col-sm-6">
                                             <?php echo $input->form_input("text", "", "50", "form-control", "pengguna", "Enter Text ...", "", ""); ?>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-inline my-2">
                                       <div class="row justify-content-center align-items-center flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Password</label>
                                          </div>
                                          <div class="col-sm-6">
                                             <?php echo $input->form_input("password", "", "50", "form-control", "sandi", "Enter Text ...", "", ""); ?>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-inline my-2">
                                       <div class="row justify-content-center align-items-center flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Hak Akses</label>
                                          </div>
                                          <div class="col-sm-6">
                                             <select name="hak_akses" required class="form-select" id="">
                                                <option value="">Pilih Hak Akses</option>
                                                <option value="admin">Admin</option>
                                                <option value="kepala_klinik">Kepala Klinik</option>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="card-footer my-2">
                                       <div class="text-end">
                                          <button type="submit" name="simpan" class="btn btn-primary">
                                             <i class="fas fa-save fa-fw fa-1x"></i>
                                             Simpan Data
                                          </button>
                                          <button type="reset" class="btn btn-default">
                                             <i class="fas fa-eraser fa-fw fa-1x"></i>
                                             Hapus Data
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