<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php if ($_SESSION['hak_akses'] == "dokter"): ?>
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
                        <a href="?page=antrian" aria-current="page" class="text-decoration-none">
                           Data Master Periksa
                        </a>
                     </li>
                     <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=editRekamMedis&no=<?= $_GET['no'] ?>" aria-current="page"
                           class="text-decoration-none">
                           <?php echo $data[1] ?>
                        </a>
                     </li>
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
                                 <?php $data = $input->SELECT_WHERE("tb_rekam_medis", "id", $_GET['no']); ?>
                                 <?php $bc5 = mysqli_fetch_array($data); ?>
                                 <form action="?aksi=edit_input" class="form-group" role="form" method="post">
                                    <input type="hidden" name="id" value="<?= $bc5['id'] ?>">
                                    <div class="form-inline my-2">
                                       <div class="row justify-content-center align-items-center flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Pasien</label>
                                          </div>
                                          <?php $bc6 = $input->query("SELECT * FROM tb_pasien WHERE id_pasien = '$bc5[id_pasien]'")->fetch_array(); ?>
                                          <div class="col-sm-6">
                                             <input type="text" name=""
                                                value="<?= $bc5['id_pasien'] . " - " . $bc6['nama_pasien'] ?>"
                                                class="form-control" required disabled id="">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-inline my-2">
                                       <div class="row justify-content-center align-items-center flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Dokter</label>
                                          </div>
                                          <?php $bc7 = $input->query("SELECT * FROM tb_dokter WHERE id_dokter = '$bc5[id_dokter]'")->fetch_array(); ?>
                                          <div class="col-sm-6">
                                             <input type="text" name=""
                                                value="<?= $bc5['id_dokter'] . " - " . $bc7['nama_dokter'] ?>"
                                                class="form-control" required disabled id="">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-inline my-2">
                                       <div class="row justify-content-center align-items-center flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Umur</label>
                                          </div>
                                          <div class="col-sm-6">
                                             <?php echo $input->form_input("text", "numeric", "5", "form-control", "umur", "Enter Text ...", "", $bc5['umur']); ?>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-inline my-2">
                                       <div class="row justify-content-center align-items-center flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Terapi</label>
                                          </div>
                                          <div class="col-sm-6">
                                             <?php echo $input->form_input("text", "", "50", "form-control", "terapi", "Enter Text ...", "", $bc5['terapi']); ?>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-inline my-2">
                                       <div class="row justify-content-center align-items-start flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Diagnosa</label>
                                          </div>
                                          <div class="col-sm-6">
                                             <textarea name="diagnosa" class="form-control" id=""
                                                placeholder="Enter Text ..."
                                                rows="3"><?php echo $bc5['diagnosa'] ?></textarea>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="card-footer">
                                       <div class="text-end">
                                          <button type="submit" class="btn btn-outline btn-info" name="simpan">
                                             <i class="fa fa-save fa-fw"></i>
                                             Update Data
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
      </div>
   </section>
   <?php require_once("../ui/footer.php") ?>