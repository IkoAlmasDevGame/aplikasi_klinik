<?php require_once "../ui/header.php"; ?>
<?php require_once "../ui/sidebar.php"; ?>
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
         <h1 class="display-4 fs-1">Beranda</h1>
         <div class="col-md-12 text-center">
            <img src="<?= BASE_URL ?>assets/icon/<?= $row['foto_icon'] ?>" height="300px" width="300px" id="welcome"
               class="img-responsive">
            <h2 class="text-center">Selamat Datang di Klinik</h2>
         </div>
      </div>
   </div>
</div>
<?php require_once "../ui/footer.php"; ?>