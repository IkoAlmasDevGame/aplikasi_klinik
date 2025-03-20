<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php if ($_SESSION['hak_akses'] == "dokter"): ?>
      <?php require_once("../ui/header.php"); ?>
      <title><?php echo $judul ?></title>
      <?php $cmb = new core\Database; ?>
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

      .form-center {
         justify-content: center;
         align-items: center;
         flex-wrap: wrap;
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
                                          class="rounded rounded-1 border p-2 m-1 col-md-3" value="">
                                       <input type="submit" name="cari" class="btn btn-primary" value="CARI">
                                    </form>
                                 </td>
                              </tr>
                           </table>
                           <div class="table-responsive">
                              <table class="table table-striped-columns table-layout" id="datatable1">
                                 <thead>
                                    <tr>
                                       <th class="text-center fw-normal">Opsional</th>
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
                                       <td class="text-center fw-normal">
                                          <a href="?aksi=editRekamMedis&no=<?= $bc['id'] ?>" aria-current="page"
                                             class="btn btn-sm btn-danger">
                                             <i class="fas fa-pencil fa-fw fa-1x"></i>
                                          </a>
                                       </td>
                                       <td class="text-center fw-normal"><?php echo $no; ?></td>
                                       <td class="text-center fw-normal"><?php echo $bc['id_pasien'] ?></td>
                                       <td class="text-center fw-normal">
                                          <a href="" aria-current="page" data-bs-toggle="modal"
                                             data-bs-target="#exampleModal<?= $bc['id_pasien'] ?>"
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
                                    <div class="modal fade" id="exampleModal<?= $bc['id_pasien'] ?>" tabindex="-1"
                                       aria-labelledby="exampleModalLabel" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-scrollable">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h4 class="modal-title"><?php echo $bc2['nama_pasien'] ?></h4>
                                                <button type='button' class='btn-close'
                                                   data-bs-dismiss='modal'></button>
                                             </div>
                                             <div class="modal-body">
                                                <?php $pasien = $cmb->query("SELECT * FROM tb_pasien WHERE id_pasien = '$bc[id_pasien]'")->fetch_array(); ?>
                                                <?php json_encode([
                                                      "id pasien" => $pasien['id_pasien'],
                                                      "nama pasien" => $pasien['nama_pasien'],
                                                      "nik pasien" => $pasien['nik_pasien'],
                                                      "umur" => $pasien['umur'],
                                                      "jenis kelamin" => $pasien['jk'],
                                                      "tanggal lahir" => $pasien['tgl_lahir'],
                                                      "alamat pasien" => $pasien['alamat_pasien']
                                                   ], JSON_OBJECT_AS_ARRAY, 512); ?>
                                                <div class="form-inline my-2">
                                                   <div class="row form-center">
                                                      <div class="form-label col-sm-5">
                                                         <label for="" class="control-label">id pasien</label>
                                                      </div>
                                                      <div class="col-sm-1">:</div>
                                                      <div class="col-sm-5"><?php echo $pasien['id_pasien'] ?></div>
                                                   </div>
                                                </div>
                                                <div class="form-inline my-2">
                                                   <div class="row form-center">
                                                      <div class="form-label col-sm-5">
                                                         <label for="" class="control-label">nama pasien</label>
                                                      </div>
                                                      <div class="col-sm-1">:</div>
                                                      <div class="col-sm-5"><?php echo $pasien['nama_pasien'] ?></div>
                                                   </div>
                                                </div>
                                                <div class="form-inline my-2">
                                                   <div class="row form-center">
                                                      <div class="form-label col-sm-5">
                                                         <label for="" class="control-label">nik pasien</label>
                                                      </div>
                                                      <div class="col-sm-1">:</div>
                                                      <div class="col-sm-5">
                                                         <?php echo $pasien['nik_pasien'] ?></div>
                                                   </div>
                                                </div>
                                                <div class="form-inline my-2">
                                                   <div class="row form-center">
                                                      <div class="form-label col-sm-5">
                                                         <label for="" class="control-label">umur pasien</label>
                                                      </div>
                                                      <div class="col-sm-1">:</div>
                                                      <div class="col-sm-5">
                                                         <?php echo $pasien['umur'] . " tahun" ?></div>
                                                   </div>
                                                </div>
                                                <div class="form-inline my-2">
                                                   <div class="row form-center">
                                                      <div class="form-label col-sm-5">
                                                         <label for="" class="control-label">jenis kelamin</label>
                                                      </div>
                                                      <div class="col-sm-1">:</div>
                                                      <div class="col-sm-5">
                                                         <?php echo $pasien['jk'] ?></div>
                                                   </div>
                                                </div>
                                                <div class="form-inline my-2">
                                                   <div class="row form-center">
                                                      <div class="form-label col-sm-5">
                                                         <label for="" class="control-label">tanggal lahir</label>
                                                      </div>
                                                      <div class="col-sm-1">:</div>
                                                      <div class="col-sm-5">
                                                         <?php $data = explode("-", $pasien['tgl_lahir']);
                                                            echo $data[2] . ", " . $data[1] . " - " . $data[0] ?>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="form-inline my-2">
                                                   <div class="row form-center">
                                                      <div class="form-label col-sm-5">
                                                         <label for="" class="control-label">alamat pasien</label>
                                                      </div>
                                                      <div class="col-sm-1">:</div>
                                                      <div class="col-sm-5">
                                                         <?php echo $pasien['alamat_pasien'] ?>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <?php endforeach; ?>
                                 </tbody>
                                 <?php else: ?>
                                 <tbody>
                                    <?php $result = $rekammedis->getByRekamMedis2(); ?>
                                    <?php foreach ($result as $bc): ?>
                                    <?php $bc2 = $cmb->query("SELECT * FROM tb_pasien WHERE id_pasien='$bc[id_pasien]'")->fetch_array(); ?>
                                    <?php $bc3 = $cmb->query("SELECT * FROM tb_dokter WHERE id_dokter='$bc[id_dokter]'")->fetch_array(); ?>
                                    <tr>
                                       <td class="text-center fw-normal">
                                          <a href="?aksi=editRekamMedis&no=<?= $bc['id'] ?>" aria-current="page"
                                             class="btn btn-sm btn-danger">
                                             <i class="fas fa-pencil fa-fw fa-1x"></i>
                                          </a>
                                       </td>
                                       <td class="text-center fw-normal"><?php echo $no; ?></td>
                                       <td class="text-center fw-normal"><?php echo $bc['id_pasien'] ?></td>
                                       <td class="text-center fw-normal">
                                          <a href="" aria-current="page" data-bs-toggle="modal"
                                             data-bs-target="#exampleModal<?= $bc['id_pasien'] ?>"
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
                                    <div class="modal fade" id="exampleModal<?= $bc['id_pasien'] ?>" tabindex="-1"
                                       aria-labelledby="exampleModalLabel" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-scrollable">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h4 class="modal-title"><?php echo $bc2['nama_pasien'] ?></h4>
                                                <button type='button' class='btn-close'
                                                   data-bs-dismiss='modal'></button>
                                             </div>
                                             <div class="modal-body">
                                                <?php $pasien = $cmb->query("SELECT * FROM tb_pasien WHERE id_pasien = '$bc[id_pasien]'")->fetch_array(); ?>
                                                <?php json_encode([
                                                      "id pasien" => $pasien['id_pasien'],
                                                      "nama pasien" => $pasien['nama_pasien'],
                                                      "nik pasien" => $pasien['nik_pasien'],
                                                      "umur" => $pasien['umur'],
                                                      "jenis kelamin" => $pasien['jk'],
                                                      "tanggal lahir" => $pasien['tgl_lahir'],
                                                      "alamat pasien" => $pasien['alamat_pasien']
                                                   ], JSON_OBJECT_AS_ARRAY, 512); ?>
                                                <div class="form-inline my-2">
                                                   <div class="row form-center">
                                                      <div class="form-label col-sm-5">
                                                         <label for="" class="control-label">id pasien</label>
                                                      </div>
                                                      <div class="col-sm-1">:</div>
                                                      <div class="col-sm-5"><?php echo $pasien['id_pasien'] ?></div>
                                                   </div>
                                                </div>
                                                <div class="form-inline my-2">
                                                   <div class="row form-center">
                                                      <div class="form-label col-sm-5">
                                                         <label for="" class="control-label">nama pasien</label>
                                                      </div>
                                                      <div class="col-sm-1">:</div>
                                                      <div class="col-sm-5"><?php echo $pasien['nama_pasien'] ?></div>
                                                   </div>
                                                </div>
                                                <div class="form-inline my-2">
                                                   <div class="row form-center">
                                                      <div class="form-label col-sm-5">
                                                         <label for="" class="control-label">nik pasien</label>
                                                      </div>
                                                      <div class="col-sm-1">:</div>
                                                      <div class="col-sm-5">
                                                         <?php echo $pasien['nik_pasien'] ?></div>
                                                   </div>
                                                </div>
                                                <div class="form-inline my-2">
                                                   <div class="row form-center">
                                                      <div class="form-label col-sm-5">
                                                         <label for="" class="control-label">umur pasien</label>
                                                      </div>
                                                      <div class="col-sm-1">:</div>
                                                      <div class="col-sm-5">
                                                         <?php echo $pasien['umur'] . " tahun" ?></div>
                                                   </div>
                                                </div>
                                                <div class="form-inline my-2">
                                                   <div class="row form-center">
                                                      <div class="form-label col-sm-5">
                                                         <label for="" class="control-label">jenis kelamin</label>
                                                      </div>
                                                      <div class="col-sm-1">:</div>
                                                      <div class="col-sm-5">
                                                         <?php echo $pasien['jk'] ?></div>
                                                   </div>
                                                </div>
                                                <div class="form-inline my-2">
                                                   <div class="row form-center">
                                                      <div class="form-label col-sm-5">
                                                         <label for="" class="control-label">tanggal lahir</label>
                                                      </div>
                                                      <div class="col-sm-1">:</div>
                                                      <div class="col-sm-5">
                                                         <?php $data = explode("-", $pasien['tgl_lahir']);
                                                            echo $data[2] . ", " . $data[1] . " - " . $data[0] ?>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="form-inline my-2">
                                                   <div class="row form-center">
                                                      <div class="form-label col-sm-5">
                                                         <label for="" class="control-label">alamat pasien</label>
                                                      </div>
                                                      <div class="col-sm-1">:</div>
                                                      <div class="col-sm-5">
                                                         <?php echo $pasien['alamat_pasien'] ?>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
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