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
                        <th class="text-center fw-normal">Nomer Pasien</th>
                        <th class="text-center fw-normal">Nama Pasien</th>
                        <th class="text-center fw-normal">Nama Dokter</th>
                        <th class="text-center fw-normal">Tanggal Periksa</th>
                        <th class="text-center fw-normal">Terapi</th>
                        <th class="text-center fw-normal">Diagnosa</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $no = 1; ?>
                     <?php $res = $rekammedis->getByRekamMedis(); ?>
                     <?php foreach ($res as $bc): ?>
                        <?php $bc2 = $cmb->query("SELECT * FROM tb_pasien WHERE id_pasien='$bc[id_pasien]'")->fetch_array(); ?>
                        <?php $bc3 = $cmb->query("SELECT * FROM tb_dokter WHERE id_dokter='$bc[id_dokter]'")->fetch_array(); ?>
                        <tr>
                           <td class="text-center fw-normal"><?php echo $no; ?></td>
                           <td class="text-center fw-normal"><?php echo $bc['id_pasien'] ?></td>
                           <td class="text-center fw-normal">
                              <?php echo $bc2['nama_pasien'] . "<br>" . $bc2['nik_pasien'] ?>
                           </td>
                           <td class="text-center fw-normal"><?php echo $bc3['nama_dokter'] ?></td>
                           <td class="text-center fw-normal"><?php echo $bc['tgl_periksa'] ?></td>
                           <td class="text-center fw-normal"><?php echo $bc['terapi'] ?></td>
                           <td class="text-center fw-normal"><?php echo $bc['diagnosa'] ?></td>
                        </tr>
                        <?php $no++; ?>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <script lang="javascript">
         function onload_print() {
            window.print();
         }
         window.onload = onload_print();
      </script>
   </section>
   <?php require_once("../ui/footer.php") ?>