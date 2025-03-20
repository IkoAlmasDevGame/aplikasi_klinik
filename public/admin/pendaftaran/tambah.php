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
                           <a href="?page=pendaftaran" aria-current="page" class="text-decoration-none">
                              Data Master Pendaftaran
                           </a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                           <a href="?aksi=tambah-pendaftaran" aria-current="page" class="text-decoration-none">
                              <?php echo $data[1]; ?>
                           </a>
                        </li>
                     </div>
                  </div>
                  <div class="form-horizontal">
                     <div class="d-flex justify-content-center align-items-center flex-wrap">
                        <div class="col-sm-6 col-md-6">
                           <div class="card shadow mb-1">
                              <div class="card-header py-1">
                                 <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <img src="<?= BASE_URL ?>assets/icon/<?= $row['foto_icon'] ?>" alt=""
                                       class="col-sm-2 col-md-2">
                                    <h4 class="card-title fs-4 fst-normal fw-normal">
                                       <?php echo $data[1]; ?>
                                    </h4>
                                 </div>
                              </div>
                              <div class="card-body my-1">
                                 <form action="?aksi=pendaftaran_tambah" class="form-group" method="post">
                                    <div class="form-inline my-2">
                                       <div class="row justify-content-center align-items-center flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Pilih Pasien Terdaftar</label>
                                          </div>
                                          <?php echo $input->cmb_dinamis("id_pasien", "tb_pasien", "nama_pasien", "id_pasien", ""); ?>
                                       </div>
                                    </div>
                                    <div class="form-inline my-2">
                                       <div class="row justify-content-center align-items-center flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Pilih Dokter Terdaftar</label>
                                          </div>
                                          <?php echo $input->cmb_dinamis2("id_dokter", "tb_dokter", "stts", "1", "nama_dokter", "id_dokter", ""); ?>
                                       </div>
                                    </div>
                                    <div class="card-footer my-1">
                                       <div class="text-center">
                                          <button type="submit" name="simpan" class="btn btn-xs btn-primary">
                                             <i class="fa fa-fw fa-save fa-1x"></i>
                                             <span>Simpan Data</span>
                                          </button>
                                          <button type="reset" class="btn btn-danger btn-xs">
                                             <i class="fa fa-fw fa-eraser fa-1x"></i>
                                             <span>Hapus Data</span>
                                          </button>
                                       </div>
                                       <div class="text-center my-3">
                                          <?php echo "&copy; " . $row['nama_developer'] . ", " . date('Y'); ?>
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