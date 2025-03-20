<?php
require_once "../../../app/init.php";
if (isset($_SESSION['status'])) {
   if (isset($_SESSION['admin'])) {
      if (isset($_SESSION['username'])) {
         if (isset($_SESSION['hak_akses'])) {
            if (isset($_SERVER["REDIRECT_STATUS"])) {
               if (isset($_SERVER['HTTP_ACCEPT'])) {
                  if (isset($_COOKIE['cookies'])) {
                  }
               }
            }
         }
      }
   }
} else {
   echo "<script lang='javascript'>
    window.setTimeout(() => {
        alert('Maaf anda gagal masuk ke halaman utama ...'),
        document.location.href='../../index.php'
    }, 3000);
    </script>";
   die;
   exit(0);
}
# Files Controllers and Files Models
# Files Models
$cmb = new core\Database();
$setting = new model\Setting_model();
$login = new model\Authentication_model();
$dokter = new model\Dokter_model();
$pasien = new model\Pasien_model();
$pendaftaran = new model\Pendaftaran_model();
$rekammedis = new model\RekamMedis_model();
$userCreate = new model\UserCreate_model();
# Files Controllers
$pengaturan = new controllers\Setting();
$signin = new controllers\Authentication();
$docter = new controllers\Dokter();
$pacient = new controllers\Pasien();
$newpacient = new controllers\Pendaftaran();
$medis = new controllers\RekamMedis();
$users = new controllers\UserCreate();

# errors code files controllers and models
# $Example = new model\Example_model();
# $exampling = new controllers\Example();
#
$row = $setting->getBySetting();

# Page Headers
if (!isset($_GET['page'])) {
} else {
   switch ($_GET['page']) {
      case 'beranda':
         $judul = $row['nama_website'] . " - Beranda";
         require_once("../dashboard/beranda.php");
         break;

      # Halaman Laporan
      case 'laporan-pasien':
         $judul = $row['nama_website'] . " - Laporan Pasien";
         require_once("../Laporan/laporan_pasien.php");
         break;
      # Pasien
      case 'print_pasien':
         $judul = $row['nama_website'] . " - Print Laporan Pasien";
         require_once("../pasien/print.php");
         break;
      case 'pdf_pasien':
         require_once("../pasien/pdf_pasien.php");
         break;
      # Pasien

      case 'laporan-dokter':
         $judul = $row['nama_website'] . " - Laporan Dokter";
         require_once("../Laporan/laporan_dokter.php");
         break;
      # Dokter
      case 'print_dokter':
         $judul = $row['nama_website'] . " - Print Laporan Dokter";
         require_once("../dokter/print.php");
         break;
      case 'pdf_dokter':
         require_once("../dokter/pdf_dokter.php");
         break;
      # Dokter

      case 'laporan-pendaftaran':
         $judul = $row['nama_website'] . " - Laporan Pendaftaran";
         require_once("../Laporan/laporan_pendaftaran.php");
         break;
      # Pendaftaran
      case 'print_pendaftaran':
         $judul = $row['nama_website'] . " - Print Laporan Dokter";
         require_once("../pendaftaran/print.php");
         break;
      case 'pdf_pendaftaran':
         require_once("../pendaftaran/pdf_pendaftaran.php");
         break;
      # Pendaftaran

      case 'laporan-rekam_medis':
         $judul = $row['nama_website'] . " - Laporan Rekam Medis";
         require_once("../Laporan/laporan_rekam_medis.php");
         break;
      # rekam medis
      case 'print_rekam_medis':
         $judul = $row['nama_website'] . " - Print Laporan Dokter";
         require_once("../rekam_medis/print.php");
         break;
      case 'pdf_rekam_medis':
         require_once("../rekam_medis/pdf_rekam_medis.php");
         break;
      # rekam medis

      case 'laporan-users':
         $judul = $row['nama_website'] . " - Laporan Users";
         require_once("../Laporan/laporan_user.php");
         break;
      # users
      case 'print_users':
         $judul = $row['nama_website'] . " - Print Laporan Users";
         require_once("../users/print.php");
         break;
      case 'pdf_users':
         require_once("../users/pdf_users.php");
         break;
      # users
      # Halaman Laporan

      # Halaman Setting
      case 'edit-perusahaan':
         $judul = $row['nama_website'] . " - Edit Perusahaan";
         require_once("../settings/edit.php");
         break;
      # Halaman Setting

      case 'logout':
         $login->LogOut3();
         break;

      # Halaman Edit Profile
      case 'edit-profile':
         $judul = $row['nama_website'] . " - Edit Profile";
         require_once("../profile/edit.php");
         break;
      # Halaman Edit Profile

      default:
         # code...
         break;
   }
}
#
# Action Headers
if (!isset($_GET['aksi'])) {
} else {
   switch ($_GET['aksi']) {
      case 'edit_perusahaan':
         $pengaturan->ubah_perusahaan();
         break;

      case 'edit_profile':
         $signin->ubahPassword3();
         break;

      default:
         # code...
         break;
   }
}
