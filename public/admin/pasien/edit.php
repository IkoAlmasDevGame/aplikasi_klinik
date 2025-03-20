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
                           <a href="?page=pasien" aria-current="page" class="text-decoration-none">
                              Data Master Pasien
                           </a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                           <a href="?aksi=edit-pasien&id_pasien=<?= $_GET['id_pasien'] ?>" aria-current="page"
                              class="text-decoration-none">
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
                                 <?php $result = $input->query("SELECT * FROM tb_pasien WHERE id_pasien = '$_GET[id_pasien]'"); ?>
                                 <?php $data = mysqli_fetch_array($result); ?>
                                 <form action="?aksi=pasien_ubah" class="form-group" method="post">
                                    <?php echo $input->form_input("hidden", "", "", "", "id_pasien", "", "", $data['id_pasien']); ?>
                                    <div class="form-inline my-2">
                                       <div class="row justify-content-center align-items-center flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">NIK Pasien</label>
                                          </div>
                                          <div class="col-sm-6">
                                             <?php echo $input->form_input("text", "numeric", "25", "form-control", "nik_pasien", "Enter Text ...", "", $data['nik_pasien']); ?>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-inline my-2">
                                       <div class="row justify-content-center align-items-center flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Nama Pasien</label>
                                          </div>
                                          <div class="col-sm-6">
                                             <?php echo $input->form_input("text", "", "30", "form-control", "nama_pasien", "Enter Text ...", "", $data['nama_pasien']); ?>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-inline my-2">
                                       <div class="row justify-content-center align-items-center flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Umur</label>
                                          </div>
                                          <div class="col-sm-6">
                                             <?php echo $input->form_input("text", "numeric", "10", "form-control", "umur", "Enter Text ...", "", $data['umur']); ?>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-inline my-1">
                                       <div class="row justify-content-center align-items-center flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Jenis Kelamin</label>
                                          </div>
                                          <div class="col-sm-6">
                                             <select name="jk" class="form-select" required>
                                                <option value="">Pilih Salah Satu</option>
                                                <option value="Laki-laki" <?php if ($data['jk'] == "Laki-laki") { ?>
                                                   selected <?php } ?>>Laki-laki</option>
                                                <option value="Perempuan" <?php if ($data['jk'] == "Perempuan") { ?>
                                                   selected <?php } ?>>Perempuan</option>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-inline my-2">
                                       <div class="row justify-content-center align-items-center flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Tanggal Lahir</label>
                                          </div>
                                          <div class="col-sm-6">
                                             <?php echo $input->form_input("date", "", "", "form-control", "tgl_lahir", "Enter Text ...", "", $data['tgl_lahir']); ?>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-inline my-1">
                                       <div class="row justify-content-center align-items-start flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Alamat</label>
                                          </div>
                                          <div class="col-sm-6">
                                             <textarea name="alamat_pasien" maxlength="255" class="form-control"
                                                placeholder="Enter Text ..." id=""
                                                rows="5"><?php echo $data['alamat_pasien'] ?></textarea>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-inline my-2">
                                       <div class="row justify-content-center align-items-center flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Tanggal Daftar</label>
                                          </div>
                                          <div class="col-sm-6" aria-readonly="true">
                                             <input type="date" name="tgl_daftar" maxlength="" inputmode=""
                                                class="form-control" placeholder="Enter Text ..."
                                                value="<?= $data['tgl_daftar'] ?>" readonly id="">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-inline my-1">
                                       <div class="row justify-content-center align-items-center flex-wrap">
                                          <div class="form-label col-sm-4">
                                             <label for="" class="control-label">Status</label>
                                          </div>
                                          <div class="col-sm-6">
                                             <select name="stts" class="form-select" required>
                                                <option value="">Pilih Salah Satu</option>
                                                <option value="1" <?php if ($data['stts'] == "1") { ?> selected
                                                   <?php } ?>>Masih Aktif</option>
                                                <option value="0" <?php if ($data['stts'] == "0") { ?> selected
                                                   <?php } ?>>Tidak Aktif</option>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="card-footer my-1">
                                       <div class="text-center">
                                          <button type="submit" name="simpan" class="btn btn-xs btn-primary">
                                             <i class="fa fa-fw fa-save fa-1x"></i>
                                             <span>Ubah Data</span>
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