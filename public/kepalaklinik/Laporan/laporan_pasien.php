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
                        <a href="?page=laporan-pasien" aria-current="page" class="text-decoration-none">
                           <?php echo $data[1] ?>
                        </a>
                     </li>
                  </div>
               </div>
               <div class="card shadow mb-4">
                  <div class="card-header py-3">
                     <h4 class="card-title text-start fst-normal fw-lighter display-4">
                        <?php echo $data[1] ?>
                     </h4>
                  </div>
                  <div class="card-body my-2">
                     <div class="card-tools">
                        <div class="text-start my-1">
                           <a href="?page=print_pasien" aria-current="page" class="btn btn-danger">
                              <i class="fas fa-print fa-fw fa-1x"></i>
                              Print File
                           </a>
                           <a href="?page=pdf_pasien" aria-current="page" class="btn btn-info btn-outline-dark">
                              <i class="fas fa-file-export fa-fw fa-1x"></i>
                              Export File To PDF
                           </a>
                        </div>
                        <div class="d-flex justify-content-end align-items-end flex-wrap">
                           <div class="col-sm-2 col-md-2 text-center">
                              <div class="rounded-2 bg-info py-2 text-light fs-5 fw-bold">
                                 <marquee behavior="scroll" scrollamount="15" direction="left">
                                    <?php echo salam() . ", " . $_SESSION['username'] ?>
                                 </marquee>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="card-footer my-2">
                        <div class="table-responsive">
                           <table class="table table-layout table-striped-columns" id="datatable2">
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
               </div>
            </div>
         </div>
      </div>
   </section>
   <?php require_once("../ui/footer.php") ?>