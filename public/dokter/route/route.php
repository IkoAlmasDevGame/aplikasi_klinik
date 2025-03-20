<?php
require_once "../../../app/init.php";
if (isset($_SESSION['status'])) {
   if (isset($_SESSION['id_dokter'])) {
      if (isset($_SESSION['username'])) {
         if (isset($_SESSION['hak_akses'])) {
            if (isset($_SESSION['dokter'])) {
               if (isset($_SERVER["REDIRECT_STATUS"])) {
                  if (isset($_SERVER['HTTP_ACCEPT'])) {
                     if (isset($_COOKIE['cookies'])) {
                        if (isset($_SESSION['password'])) {
                        }
                     }
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
        document.location.href='../index.php'
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

      case 'antrian':
         $judul = $row['nama_website'] . " - Data Master Periksa";
         require_once("../antrian/antrian.php");
         break;

      case 'rekam_medis':
         $judul = $row['nama_website'] . " - Data Rekam Medis";
         require_once("../rekam_medis/rekam_medis.php");
         break;

      # Halaman Edit Profile
      case 'edit-profile':
         $judul = $row['nama_website'] . " - Edit Profile";
         require_once("../profile/edit.php");
         break;
      # Halaman Edit Profile

      case 'logout':
         $login->LogOut2();
         break;

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
      case 'inputRekamMedis':
         $judul = $row['nama_website'] . " - Antrian Periksa Pasien";
         require_once("../antrian/tambah.php");
         break;
      case 'editRekamMedis':
         $judul = $row['nama_website'] . " - Edit Antrian Periksa Pasien";
         require_once("../rekam_medis/edit.php");
         break;
      case 'tambah_input':
         $medis->input_rekammedis();
         break;
      case 'edit_input':
         $medis->ubah_rekammedis();
         break;
      case 'edit_profile':
         $signin->ubahPassword2();
         break;

      default:
         # code...
         break;
   }
}
