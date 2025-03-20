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
                        <a href="?page=users" aria-current="page" class="text-decoration-none">
                           Data Master Users
                        </a>
                     </li>
                  </div>
               </div>
               <div class="card shadow mb-4">
                  <div class="card-header py-2">
                     <h4 class="card-title display-4 fst-normal fw-semibold text-dark">Data Master Users</h4>
                  </div>
                  <div class="card-body my-2">
                     <div class="card-tools">
                        <div class="text-start">
                           <?php if ($_SESSION['hak_akses'] == "admin"): ?>
                              <a href="?aksi=tambah-users" aria-current="page" class="btn btn-danger btn-xs">
                                 <i class="fas fa-plus fa-fw fa-1x"></i>
                                 <span>Tambah Data Users</span>
                              </a>
                           <?php endif; ?>
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
                                    <th class="text-center fw-normal">Opsional</th>
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
                                       <td class="text-center fw-normal">
                                          <a href="?aksi=edit-users&id_pengguna=<?= $data['id_pengguna'] ?>"
                                             aria-current="page" class="btn btn-sm btn-warning">
                                             <i class="fas fa-user-edit fa-1x fa-fw"></i>
                                          </a>
                                          <a href="?aksi=hapus_users&id_pengguna=<?= $data['id_pengguna'] ?>"
                                             aria-current="page"
                                             onclick="return confirm('Apakah anda ingin menghapus data ini ?');"
                                             class="btn btn-sm btn-danger">
                                             <i class="fas fa-trash-alt fa-1x fa-fw"></i>
                                          </a>
                                       </td>
                                       <td class="text-center fw-normal"><?php echo $no; ?></td>
                                       <td class="text-center fw-normal"><?php echo $data['id_pengguna'] ?></td>
                                       <td class="text-center fw-normal"><?php echo $data['pengguna'] ?></td>
                                       <td class="text-center fw-normal">
                                          <?php $sandi = md5($data['sandi'], false);
                                          echo ($sandi); ?>
                                       </td>
                                       <td class="text-center fw-normal">
                                          <?php if ($data['hak_akses'] == "admin"): ?>
                                             <span class="fs-6 display-4 fst-normal fw-normal">Admin</span>
                                          <?php elseif ($data['hak_akses'] == "dokter"): ?>
                                             <span class="fs-6 display-4 fst-normal fw-normal">Dokter</span>
                                          <?php elseif ($data['hak_akses'] == "kepala_klinik"): ?>
                                             <span class="fs-6 display-4 fst-normal fw-normal">Kepala Klinik</span>
                                          <?php endif; ?>
                                       </td>
                                       <td class="text-center fw-normal">
                                          <div class="btn position-relative">
                                             <?php if ($data['status'] == "online"): ?>
                                                <span class="position-absolute top-0 start-100 translate-middle p-2 bg-success border
                                              border-light rounded-circle">
                                                   <span class="visually-hidden">
                                                   </span>
                                                </span>
                                             <?php else: ?>
                                                <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border
                                                 border-light rounded-circle">
                                                   <span class="visually-hidden">
                                                   </span>
                                                </span>
                                             <?php endif; ?>
                                          </div>
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