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
         width: 1200px;
      }

      @media (min-width:1200px) {
         .table-layout {
            min-width: 1200px;
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
                  <table class="table table-layout table-bordered">
                     <thead>
                        <tr>
                           <th class="fw-normal text-center">Nomor</th>
                           <th class="fw-normal text-center">Id Dokter</th>
                           <th class="fw-normal text-center">Nama Dokter</th>
                           <th class="fw-normal text-center">Jenis Kelamin</th>
                           <th class="fw-normal text-center">Umur</th>
                           <th class="fw-normal text-center">Alamat</th>
                           <th class="fw-normal text-center">Username</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $no = 1; ?>
                        <?php $result = $dokter->getByDocter(); ?>
                        <?php foreach ($result as $data): ?>
                        <tr>
                           <td class="text-center fw-normal"><?php echo $no; ?></td>
                           <td class="text-center fw-normal"><?php echo $data['id_dokter'] ?></td>
                           <td class="text-center fw-normal"><?php echo $data['nama_dokter'] ?></td>
                           <td class="text-center fw-normal"><?php echo $data['jk_dokter'] ?></td>
                           <td class="text-center fw-normal"><?php echo $data['umur'] . " tahun" ?></td>
                           <td class="text-center fw-normal"><?php echo $data['alamat_dokter'] ?></td>
                           <td class="text-center fw-normal"><?php echo $data['pengguna'] ?></td>
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