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
                        <a href="?page=edit-perusahaan&id_setting=1" aria-current="page"
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
                              <h4 class="card-title text-center text-dark fs-5">
                                 <?php echo $data[0]; ?>
                              </h4>
                           </div>
                           <div class="card-body my-2">
                              <?php $sql = $input->SELECT_WHERE("tb_setting", "id_setting", $_GET['id_setting']); ?>
                              <?php $data = mysqli_fetch_array($sql); ?>
                              <form action="?aksi=edit_perusahaan" enctype="multipart/form-data" class="form-group"
                                 method="post">
                                 <?php echo $input->form_input("hidden", "", "", "", "id_setting", "", "", $data['id_setting']); ?>
                                 <?php echo $input->form_input("hidden", "", "", "", "foto_icon", "", "", $data['foto_icon']); ?>
                                 <div class="form-inline my-2">
                                    <div class="row justify-content-center align-items-center flex-wrap">
                                       <div class="form-label col-sm-4">
                                          <label for="" class="control-label">Nama Daveloper</label>
                                       </div>
                                       <div class="col-sm-6">
                                          <?php echo $input->form_input("text", "", "200", "form-control", "nama_developer", "Enter Text ...", "", $data['nama_developer']); ?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-inline my-2">
                                    <div class="row justify-content-center align-items-center flex-wrap">
                                       <div class="form-label col-sm-4">
                                          <label for="" class="control-label">Nama Website</label>
                                       </div>
                                       <div class="col-sm-6">
                                          <?php echo $input->form_input("text", "", "200", "form-control", "nama_website", "Enter Text ...", "", $data['nama_website']); ?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-inline my-2">
                                    <div class="row justify-content-center align-items-start flex-wrap">
                                       <div class="form-label col-sm-4">
                                          <label for="" class="control-label">Alamat Klinik</label>
                                       </div>
                                       <div class="col-sm-6">
                                          <textarea name="alamat" id="" maxlength="255" class="form-control"
                                             rows="3"><?php echo $data['alamat'] ?></textarea>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-inline my-2">
                                    <div class="row justify-content-center align-items-start flex-wrap">
                                       <div class="form-label col-sm-4">
                                          <label for="" class="control-label">Foto Logo</label>
                                       </div>
                                       <div class="col-sm-6">
                                          <div class="img-thumbnail col-sm-6 col-md-6">
                                             <?php if ($data['foto_icon'] != ""): ?>
                                                <img src="<?= BASE_URL ?>assets/icon/<?= $data['foto_icon'] ?>"
                                                   class="img-responsive" id="preview" width="100" height="100"
                                                   alt="<?= $data['foto_icon'] ?>">
                                             <?php else: ?>
                                                <img
                                                   src="https://th.bing.com/th/id/OIP.jxhJvX2q8gLQmiFuOWa1bAHaHa?w=161&h=180&c=7&r=0&o=5&pid=1.7"
                                                   class="img-responsive" id="preview" width="100" height="100"
                                                   alt="<?= $data['foto_icon'] ?>">
                                             <?php endif; ?>
                                          </div>
                                          <div class="my-1"></div>
                                          <div class="form-control">
                                             <input type="file" accept="image/*" onchange="previewImage(this)"
                                                name="foto_icon_new" class="form-control-file" id="">
                                          </div>
                                          <div class="my-1"></div>
                                          <input type="checkbox" name="ganti" id=""> Jika ingin ganti foto klick ini.
                                       </div>
                                    </div>
                                 </div>
                                 <div class="card-footer">
                                    <div class="text-end my-1">
                                       <button type="submit" class="btn btn-primary" name="simpan">
                                          <i class="fa fa-save fa-1x fa-fw"></i>
                                          Update Data Perusahaan
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