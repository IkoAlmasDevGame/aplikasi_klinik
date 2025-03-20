<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php if ($_SESSION['hak_akses'] == "kepala_klinik"): ?>
      <?php require_once("../ui/header.php"); ?>
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
   <section class="content">
      <div class="content-wrapper">
         <div class="panel panel-default bg-body-secondary p-5 rounded rounded-2">
            <div class="panel panel-body bg-body-tertiary p-5">
               <div class="panel panel-heading">
                  <h4 class="panel panel-title fst-normal fw-semibold display-4 fs-3">
                     <?php $data = explode("-", $judul); ?>
                     <?php echo $data[1]; ?>
                  </h4>
               </div>
               <table class="table table-bordered table-layout">
                  <thead>
                     <tr>
                        <th class="text-center fw-normal">Nomor</th>
                        <th class="text-center fw-normal">Nomor Pasien</th>
                        <th class="text-center fw-normal">Nama Pasien</th>
                        <th class="text-center fw-normal">Umur Pasien</th>
                        <th class="text-center fw-normal">Jenis Kelamin</th>
                        <th class="text-center fw-normal">Tanggal Lahir</th>
                        <th class="text-center fw-normal">Alamat Pasien</th>
                        <th class="text-center fw-normal">Tanggal Daftar</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $no = 1; ?>
                     <?php $res = $pasien->getByPasien(); ?>
                     <?php foreach ($res as $bc): ?>
                        <?php $tahun_lahir = floatval($bc['tgl_lahir']); ?>
                        <?php $hasil = date('Y') - $tahun_lahir; ?>
                        <tr>
                           <td class="text-center fw-normal"><?php echo $no; ?></td>
                           <td class="text-center fw-normal"><?php echo $bc['nik_pasien'] ?></td>
                           <td class="text-center fw-normal"><?php echo $bc['nama_pasien'] ?></td>
                           <td class="text-center fw-normal"><?php echo $hasil . " tahun" ?></td>
                           <td class="text-center fw-normal"><?php echo $bc['jk'] ?></td>
                           <td class="text-center fw-normal"><?php echo $bc['tgl_lahir'] ?></td>
                           <td class="text-center fw-normal">
                              <?php
                              $a = $bc['alamat_pasien'];
                              if (strlen($a) > 30) {
                                 echo substr($a, 0, 30), " (...)";
                              } else {
                                 echo $a;
                              }
                              ?>
                           </td>
                           <td class="text-center fw-normal"><?php echo $bc['tgl_daftar'] ?></td>
                        </tr>
                        <?php $no++; ?>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </section>
   <script lang="javascript">
      function onload_print() {
         window.print();
      }
      window.onload = onload_print();
   </script>
   <?php require_once("../ui/footer.php") ?>