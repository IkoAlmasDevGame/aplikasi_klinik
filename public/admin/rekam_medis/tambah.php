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
                           <a href="?page=rekam_medis" aria-current="page" class="text-decoration-none">
                              Data Master Pasien
                           </a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                           <a href="?aksi=tambah-rekam_medis" aria-current="page" class="text-decoration-none">
                              <?php echo $data[1]; ?>
                           </a>
                        </li>
                     </div>
                  </div>
                  <div class="d-flex justify-content-center align-items-center flex-wrap">
                     <div class="col-sm-6 col-md-6">
                        <div class="card shadow mb-4">
                           <div class="card-header py-3">
                              <h4 class="card-title text-center">
                                 <?php echo $data[1]; ?>
                              </h4>
                           </div>
                           <div class="card-body my-2">
                              <div class="form-horizontal">
                                 <form action="" role="form" class="form-group" enctype="multipart/form-data"
                                    method="post">
                                    <div class="form-inline my-2">
                                       <div class="row justify-content-center align-items-center flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Nama Pasien</label>
                                          </div>
                                          <div class="col-sm-5">
                                             <?php $result = $input->query("SELECT * from tb_pasien"); ?>
                                             <?php $jArray = "var prdName = new Array();\n" ?>
                                             <?php echo '<select name="prdId" onchange="document.getElementById(\'prd_name\').value = prdName[this.value]" class="form-select" required>'; ?>
                                             <?php echo '<option value="">Pilih Nama Pasien</option>'; ?>
                                             <?php foreach ($result as $row): ?>
                                             <?php echo '<option value="' . $row['id_pasien'] . '">' . $row['nama_pasien'] . '</option>';
                                             $jsArray .= "prdName['" . $row['id_pasien'] . "'] = '" . addslashes($row['nama_pasien']) . "';\n"; ?>
                                             <?php endforeach; ?>
                                             <?php echo '</select>'; ?>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-inline my-2">
                                       <div class="row justify-content-center align-items-center flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Nama Dokter</label>
                                          </div>
                                          <div class="col-sm-5">
                                             <?php $result = $input->query("SELECT * from tb_dokter"); ?>
                                             <?php $jArray = "var prdName = new Array();\n" ?>
                                             <?php echo '<select name="prdId1" onchange="document.getElementById(\'prd_name\').value = prdName[this.value]" class="form-select" required>'; ?>
                                             <?php echo '<option value="">Pilih Dokter</option>'; ?>
                                             <?php foreach ($result as $row): ?>
                                             <?php echo '<option value="' . $row['id_dokter'] . '">' . $row['nama_dokter'] . '</option>';
                                             $jsArray .= "prdName['" . $row['id_dokter'] . "'] = '" . addslashes($row['nama_dokter']) . "';\n"; ?>
                                             <?php endforeach; ?>
                                             <?php echo '</select>'; ?>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-inline my-2">
                                       <div class="row justify-content-center align-items-center flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Tanggal Periksa</label>
                                          </div>
                                          <div class="col-sm-5">
                                             <?php echo $input->form_input("date", "", "", "form-control", "tgl_periksa", "Enter Text ...", "", ""); ?>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-inline my-2">
                                       <div class="row justify-content-center align-items-center flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Umur</label>
                                          </div>
                                          <div class="col-sm-5">
                                             <?php echo $input->form_input("text", "numeric", "5", "form-control", "umur", "Enter Text ...", "", ""); ?>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-inline my-2">
                                       <div class="row justify-content-center align-items-center flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Terapi</label>
                                          </div>
                                          <div class="col-sm-5">
                                             <?php echo $input->form_input("text", "", "50", "form-control", "terapi", "Enter Text ...", "", ""); ?>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-inline my-2">
                                       <div class="row justify-content-center align-items-start flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Diagnosa</label>
                                          </div>
                                          <div class="col-sm-5">
                                             <textarea name="diagnosa" class="form-control" id=""
                                                placeholder="Enter Text ..." rows="3"></textarea>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="card-footer">
                                       <div class="text-end">
                                          <button type="submit" class="btn btn-outline btn-info" name="simpan">
                                             <i class="fa fa-save fa-fw"></i>
                                             Simpan
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