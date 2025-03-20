<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php if ($_SESSION['hak_akses'] == "dokter"): ?>
      <?php require_once("../ui/header.php"); ?>
      <?php $base = new core\Database; ?>
      <title><?php echo $judul ?></title>
      <?php else: ?>
      <?php header("Location:" . URL_BASE . "admin/ui/header.php?page=beranda"); ?>
      <?php exit(0); ?>
      <?php endif; ?>
      <style type="text/css">
      .table-layout {
         width: 1366px;
      }

      @media (min-width:1366px) {
         .table-layout {
            min-width: 1366px;
         }
      }
      </style>
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
                     </div>
                  </div>
                  <div class="card shadow mb-4">
                     <div class="card-header py-3">
                        <h4 class="card-title text-start fst-normal fw-lighter display-4">
                           Data Master Periksa
                        </h4>
                     </div>
                     <div class="card-body my-2">
                        <div class="card-tools"></div>
                        <div class="card-footer my-1">
                           <div class="table-responsive">
                              <table class="table table-layout table-striped-columns" id="datatable2">
                                 <thead>
                                    <tr>
                                       <th class="text-center fw-normal">Opsional</th>
                                       <th class="text-center fw-normal">Nomor</th>
                                       <th class="text-center fw-normal">Nomer Pasien</th>
                                       <th class="text-center fw-normal">Nama Pasien</th>
                                       <th class="text-center fw-normal">Nama Dokter</th>
                                       <th class="text-center fw-normal">Tanggal Periksa</th>
                                       <th class="text-center fw-normal">Waktu Daftar</th>
                                       <th class="text-center fw-normal">Status Periksa</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php $sql_login = $base->query("SELECT * FROM tb_user join tb_dokter on tb_user.id_dokter = tb_dokter.id_dokter 
                                    WHERE tb_user.pengguna = '$_SESSION[username]' and tb_user.sandi = '$_SESSION[password]' and tb_user.id_dokter = '$_SESSION[dokter]'"); ?>
                                    <?php $cek_login = mysqli_fetch_array($sql_login); ?>
                                    <?php $no = 0; ?>
                                    <?php $sql = $base->query("SELECT * FROM tb_pendaftaran join tb_dokter on tb_pendaftaran.id_dokter = tb_dokter.id_dokter
                                     WHERE tb_pendaftaran.stts='1' and tb_pendaftaran.id_dokter = '$_SESSION[dokter]'"); ?>
                                    <?php foreach ($sql as $bc): ?>
                                    <?php $sql2 = $base->query("SELECT * FROM tb_pasien WHERE id_pasien='$bc[id_pasien]'"); ?>
                                    <?php $bc2 = mysqli_fetch_array($sql2); ?>
                                    <?php $sql3 = $base->query("SELECT * FROM tb_dokter WHERE id_dokter='$bc[id_dokter]'"); ?>
                                    <?php $bc3 = mysqli_fetch_array($sql3); ?>
                                    <tr>
                                       <td class="text-center fw-normal">
                                          <a href="?aksi=inputRekamMedis&no=<?php echo $bc['no_pendaftaran'] ?>"
                                             aria-current="page" class="btn btn-sm btn-danger">
                                             <i class="fas fa-pencil-alt fa-1x fa-fw"></i>
                                             Periksa
                                          </a>
                                       </td>
                                       <td class="text-center fw-normal"><?php echo $no; ?></td>
                                       <td class="text-center fw-normal"><?php echo $bc['id_pasien'] ?></td>
                                       <td class="text-center fw-normal"><?php echo $bc2['nama_pasien'] ?></td>
                                       <td class="text-center fw-normal"><?php echo $bc3['nama_dokter'] ?></td>
                                       <td class="text-center fw-normal"><?php echo $bc['tgl_periksa'] ?></td>
                                       <td class="text-center fw-normal"><?php echo $bc['waktu_pendaftaran'] ?></td>
                                       <td class="text-center fw-normal">
                                          <?php if ($bc['stts'] == '1'): ?>
                                          <div class="fs-6 display-4 text-dark fw-normal">Dalam Antrian</div>
                                          <?php elseif ($bc['stts'] == '2'): ?>
                                          <div class="fs-6 display-4 text-dark fw-normal">Telah Diperiksa</div>
                                          <?php endif; ?>
                                       </td>
                                    </tr>
                                    <?php $no++; ?>
                                    <?php endforeach; ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <?php require_once("../ui/footer.php") ?>