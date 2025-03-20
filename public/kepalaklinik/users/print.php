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
                        <th class="text-center fw-normal">Nomor</th>
                        <th class="text-center fw-normal">Id Pengguna</th>
                        <th class="text-center fw-normal">Username</th>
                        <th class="text-center fw-normal">Password (md5)</th>
                        <th class="text-center fw-normal">Hak Akses</th>
                        <th class="text-center fw-normal">Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $no = 0; ?>
                     <?php $users = $userCreate->getByUsers(); ?>
                     <?php foreach ($users as $data): ?>
                        <tr>
                           <td class="text-center fw-normal"><?php echo $no; ?></td>
                           <td class="text-center fw-normal"><?php echo $data['id_pengguna'] ?></td>
                           <td class="text-center fw-normal"><?php echo $data['pengguna'] ?></td>
                           <td class="text-center fw-normal">
                              <?php $sandi = md5($data['sandi'], false);
                              echo ($sandi); ?>
                           </td>
                           <td class="text-center fw-normal">
                              <?php if ($data['hak_akses'] == "admin"): ?>
                                 <span class="fs-6 display-4 text-center fst-normal fw-normal">Admin</span>
                              <?php elseif ($data['hak_akses'] == "dokter"): ?>
                                 <span class="fs-6 display-4 text-center fst-normal fw-normal">Dokter</span>
                              <?php elseif ($data['hak_akses'] == "kepala_klinik"): ?>
                                 <span class="fs-6 display-4 text-center fst-normal fw-normal">Kepala
                                    Klinik</span>
                              <?php endif; ?>
                           </td>
                           <td class="text-center fw-normal">
                              <?php if ($data['status'] == "online"): ?>
                                 <div class="display-4 text-center fs-6 fw-medium fst-normal">Online</div>
                              <?php else: ?>
                                 <div class="display-4 text-center fs-6 fw-medium fst-normal">Offline</div>
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
      <script lang="javascript">
         function onload_print() {
            window.print();
         }
         window.onload = onload_print();
      </script>
   </section>
   <?php require_once("../ui/footer.php") ?>