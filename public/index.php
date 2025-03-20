<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php require_once("../app/init.php"); ?>
      <?php $input = new core\Database(); ?>
      <?php $data = new model\Setting_model(); ?>
      <?php $login = new controllers\Authentication(); ?>
      <?php $row = $data->getBySetting(); ?>
      <?php
   if (!isset($_GET['aksi'])):
   else:
      switch ($_GET['aksi']) {
         case 'akses-login':
            $login->Login();
            break;

         default:
            new controllers\Authentication();
            break;
      }
   endif;
   ?>
      <title><?php echo $row['nama_website'] ?></title>
      <!-- stylesheet -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
      <link rel="shortcut icon" href="<?= BASE_URL ?>assets/icon/<?= $row['foto_icon'] ?>" type="image/x-icon">
      <!-- javascript -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   </head>

   <body class="bg-info">
      <section class="pt-5 mt-5">
         <div class="d-flex justify-content-center align-items-center flex-wrap">
            <div class="col-sm-4 col-md-4">
               <div class="card shadow mb-4">
                  <div class="text-center">
                     <img src="<?= BASE_URL ?>assets/icon/<?= $row['foto_icon'] ?>" alt="" class="col-sm-4 col-md-4">
                  </div>
                  <div class="card-header py-1">
                     <h4 class="card-title text-center text-dark">
                        <?php echo "Login - " . $row['nama_website']; ?>
                        <div class="my-1"></div>
                        <?php echo $row['alamat'] ?>
                     </h4>
                  </div>
                  <div class="card-body my-1">
                     <div class="form-horizontal">
                        <form action="?aksi=akses-login" class="form-group" method="post">
                           <div class="form-inline my-1">
                              <div class="row justify-content-center align-items-center flex-wrap">
                                 <div class="form-label col-sm-4">
                                    <label for="username" class="control-label">username / pengguna</label>
                                 </div>
                                 <div class="col-sm-6">
                                    <?php echo $input->form_input("text", "", "", "form-control", "pengguna", "masukkan username anda disini ...", "username", ""); ?>
                                 </div>
                              </div>
                           </div>
                           <div class="form-inline my-1">
                              <div class="row justify-content-center align-items-center flex-wrap">
                                 <div class="form-label col-sm-4">
                                    <label for="password" class="control-label">password / sandi</label>
                                 </div>
                                 <div class="col-sm-6">
                                    <?php echo $input->form_input("password", "", "", "form-control", "sandi", "masukkan password anda disini ...", "password", ""); ?>
                                 </div>
                              </div>
                           </div>
                           <div class="form-inline my-1">
                              <div class="row justify-content-center align-items-center flex-wrap">
                                 <div class="form-label col-sm-4">
                                    <label for="hak_akses" class="control-label">Hak Akses</label>
                                 </div>
                                 <div class="col-sm-6">
                                    <select name="hak_akses" class="form-select" id="hak_akses">
                                       <option value="">==== Pilih Hak Akses ====</option>
                                       <option value="admin">Admin</option>
                                       <option value="dokter">Dokter</option>
                                       <option value="kepala_klinik">Kepala Klinik</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="form-inline my-1">
                              <div class="row justify-content-center align-items-start flex-wrap">
                                 <div class="form-label col-sm-4 col-md-4">
                                    <input type="hidden" name="angka1" value="<?= $angka1 ?>">
                                    <input type="hidden" name="angka2" value="<?= $angka2 ?>">
                                    <label for="" class="label label-default">
                                       <?php echo $angka1 . " + " . $angka2; ?> = ?</label>
                                 </div>
                                 <div class="col-sm-6">
                                    <input type="number" class="form-control" aria-required="TRUE" name="hasil"
                                       placeholder="Capthca" required>
                                 </div>
                              </div>
                           </div>
                           <div class="my-2">
                              <div class="text-center">
                                 <div class="card-footer my-4">
                                    <button type="submit" name="submit" class="btn btn-primary">
                                       <i class="fa fa-sign-in-alt fa-1x fa-fw"></i>
                                       <span>Log In</span>
                                    </button>
                                    <button type="reset" name="" class="btn btn-danger">
                                       <i class="fa fa-eraser fa-1x fa-fw"></i>
                                       <span>Cancel</span>
                                    </button>
                                 </div>
                                 <?php echo "&copy; " . $row['nama_developer'] . ", " . date('Y'); ?>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </body>

</html>