<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php if ($_SESSION['hak_akses'] == "admin"): ?>
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
                           <a href="?page=rekam_medis" aria-current="page" class="text-decoration-none">
                              Data Master Rekam Medis
                           </a>
                        </li>
                     </div>
                  </div>
                  <div class="card shadow mb-4">
                     <div class="card-header py-2">
                        <h4 class="card-title display-4 fst-normal fw-normal">
                           Data Master Rekam Medis
                        </h4>
                     </div>
                     <div class="card-body my-2">
                        <div class="card-tools"></div>
                        <div class="card-footer my-2">
                           <table width="100%" border="0">
                              <tr>
                                 <td width="60%" align="right" valign="bottom">
                                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                                       <input type="text" name="pencarian"
                                          placeholder="mencari data rekam medis pasien ..."
                                          class="rounded rounded-1 border p-1 m-1 col-md-3" value="">
                                       <input type="submit" name="cari" class="btn btn-primary" value="CARI">
                                    </form>
                                 </td>
                              </tr>
                           </table>
                           <div class="table-responsive">
                              <table class="table table-striped-columns table-layout" id="datatable1">
                                 <thead>
                                    <tr>
                                       <th class="text-center fw-normal">Nomor</th>
                                       <th class="text-center fw-normal">Nomer Pasien</th>
                                       <th class="text-center fw-normal">Nama Pasien</th>
                                       <th class="text-center fw-normal">Nama Dokter</th>
                                       <th class="text-center fw-normal">Tanggal Periksa</th>
                                       <th class="text-center fw-normal">Terapi</th>
                                       <th class="text-center fw-normal">Diagnosa</th>
                                    </tr>
                                 </thead>
                                 <?php $no = 1; ?>
                                 <?php if (!isset($_POST['cari']) && empty($_POST['pencarian'])): ?>
                                 <tbody>
                                    <?php $res = $rekammedis->getByRekamMedis(); ?>
                                    <?php foreach ($res as $bc): ?>
                                    <?php $bc2 = $cmb->query("SELECT * FROM tb_pasien WHERE id_pasien='$bc[id_pasien]'")->fetch_array(); ?>
                                    <?php $bc3 = $cmb->query("SELECT * FROM tb_dokter WHERE id_dokter='$bc[id_dokter]'")->fetch_array(); ?>
                                    <tr>
                                       <td class="text-center fw-normal"><?php echo $no; ?></td>
                                       <td class="text-center fw-normal"><?php echo $bc['id_pasien'] ?></td>
                                       <td class="text-center fw-normal">
                                          <a href="" aria-current="page" data-bs-toggle="" data-bs-target=""
                                             class="text-decoration-none">
                                             <?php echo $bc2['nama_pasien'] ?>
                                          </a>
                                       </td>
                                       <td class="text-center fw-normal"><?php echo $bc3['nama_dokter'] ?></td>
                                       <td class="text-center fw-normal"><?php echo $bc['tgl_periksa'] ?></td>
                                       <td class="text-center fw-normal"><?php echo $bc['terapi'] ?></td>
                                       <td class="text-center fw-normal"><?php echo $bc['diagnosa'] ?></td>
                                    </tr>
                                    <?php $no++; ?>
                                    <?php endforeach; ?>
                                 </tbody>
                                 <?php else: ?>
                                 <tbody>
                                    <?php $result = $rekammedis->getByRekamMedis2(); ?>
                                    <?php foreach ($result as $bc): ?>
                                    <?php $bc2 = $cmb->query("SELECT * FROM tb_pasien WHERE id_pasien='$bc[id_pasien]'")->fetch_array(); ?>
                                    <?php $bc3 = $cmb->query("SELECT * FROM tb_dokter WHERE id_dokter='$bc[id_dokter]'")->fetch_array(); ?>
                                    <tr>
                                       <td class="text-center fw-normal"><?php echo $no; ?></td>
                                       <td class="text-center fw-normal"><?php echo $bc['id_pasien'] ?></td>
                                       <td class="text-center fw-normal">
                                          <a href="" aria-current="page" data-bs-toggle="" data-bs-target=""
                                             class="text-decoration-none">
                                             <?php echo $bc2['nama_pasien'] ?>
                                          </a>
                                       </td>
                                       <td class="text-center fw-normal"><?php echo $bc3['nama_dokter'] ?></td>
                                       <td class="text-center fw-normal"><?php echo $bc['tgl_periksa'] ?></td>
                                       <td class="text-center fw-normal"><?php echo $bc['terapi'] ?></td>
                                       <td class="text-center fw-normal"><?php echo $bc['diagnosa'] ?></td>
                                    </tr>
                                    <?php $no++; ?>
                                    <?php endforeach; ?>
                                 </tbody>
                                 <?php endif; ?>
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