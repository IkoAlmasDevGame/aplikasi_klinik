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
                           <a href="?page=pendaftaran" aria-current="page" class="text-decoration-none">
                              Data Master Pendaftaran
                           </a>
                        </li>
                     </div>
                  </div>
                  <div class="card shadow mb-4">
                     <div class="card-header py-3">
                        <h4 class="card-title text-start fst-normal fw-lighter display-4">
                           Data Master Pendaftaran
                        </h4>
                     </div>
                     <div class="card-body my-2">
                        <div class="card-tools">
                           <div class="text-start">
                              <?php if ($_SESSION['hak_akses'] == "admin"): ?>
                              <a href="?aksi=tambah-pendaftaran" aria-current="page" class="btn btn-danger btn-xs">
                                 <i class="fas fa-plus fa-fw fa-1x"></i>
                                 <span>Tambah Data Pendaftaran</span>
                              </a>
                              <a href="?aksi=hapus_semua_data" aria-current="page"
                                 onclick="return confirm('Apakah kamu ingin menghapus semua data ini ?')"
                                 class="btn btn-warning">
                                 <i class="fas fa-trash-alt fa-1x fa-fw"></i>
                                 <span>Hapus Semua Data</span>
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
                           <div class="tabel-responsive">
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
                                    <?php $no = 1; ?>
                                    <?php $res = $pendaftaran->getByPendaftaran(); ?>
                                    <?php foreach ($res as $bc): ?>
                                    <?php $bc2 = $cmb->query("SELECT * FROM tb_pasien WHERE id_pasien='$bc[id_pasien]'")->fetch_array(); ?>
                                    <?php $bc3 = $cmb->query("SELECT * FROM tb_dokter WHERE id_dokter='$bc[id_dokter]'")->fetch_array(); ?>
                                    <tr>
                                       <td class="text-center fw-normal">
                                          <a href="?aksi=hapus_pendaftaran&no_pendaftaran=<?=$bc['no_pendaftaran']?>"
                                             aria-current="page"
                                             onclick="return confirm('Apakah kamu ingin menghapus data ini ?')"
                                             class="btn btn-sm btn-danger">
                                             <i class="fas fa-fw fa-trash-alt fa-1x"></i>
                                          </a>
                                       </td>
                                       <td class="text-center fw-normal"><?php echo $no; ?></td>
                                       <td class="text-center fw-normal"><?php echo $bc['id_pasien']; ?></td>
                                       <td class="text-center fw-normal">
                                          <?php echo $bc2['nama_pasien'] . "<br>" . $bc2['nik_pasien']; ?>
                                       </td>
                                       <td class="text-center fw-normal"><?php echo $bc3['nama_dokter']; ?></td>
                                       <td class="text-center fw-normal"><?php echo $bc['tgl_periksa']; ?></td>
                                       <td class="text-center fw-normal"><?php echo $bc['waktu_pendaftaran']; ?></td>
                                       <td class="text-center fw-normal">
                                          <?php if ($bc['stts'] == "1"): ?>
                                          <div class="btn btn-primary">
                                             <div class="badge text-bg-secondary">
                                                Dalam Antrian
                                             </div>
                                          </div>
                                          <?php elseif ($bc['stts'] == "2"): ?>
                                          <div class="btn btn-success">
                                             <div class="badge text-bg-secondary">
                                                Telah Diperiksa
                                             </div>
                                          </div>
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