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
                           <a href="?page=dokter" aria-current="page" class="text-decoration-none">
                              Data Master Dokter
                           </a>
                        </li>
                     </div>
                  </div>
                  <div class="card shadow mb-4">
                     <div class="card-header py-3">
                        <h4 class="card-title text-start fst-normal fw-lighter display-4">
                           Data Master Dokter
                        </h4>
                     </div>
                     <div class="card-body my-2">
                        <div class="card-tools">
                           <div class="text-start">
                              <?php if ($_SESSION['hak_akses'] == "admin"): ?>
                              <a href="?aksi=tambah-dokter" aria-current="page" class="btn btn-danger btn-xs">
                                 <i class="fas fa-plus fa-fw fa-1x"></i>
                                 <span>Tambah Dokter</span>
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
                                       <th class="fw-normal text-center">Opsional</th>
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
                                       <td class="text-center fw-normal">
                                          <a href="?aksi=edit-dokter&id_dokter=<?= $data['id_dokter'] ?>"
                                             aria-current="page" class="btn btn-sm btn-danger">
                                             <i class="fa fa-fw fa-edit fa-1x"></i>
                                          </a>
                                          <a href="?aksi=dokter_hapus&id_dokter=<?= $data['id_dokter'] ?>"
                                             onclick="return confirm('Apakah data dokter ini akan anda hapus ?')"
                                             aria-current="page" class="btn btn-sm btn-primary">
                                             <i class="fa fa-fw fa-trash-alt fa-1x"></i>
                                          </a>
                                       </td>
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
                  </div>
               </div>
            </div>
         </div>
      </section>
      <?php require_once("../ui/footer.php") ?>