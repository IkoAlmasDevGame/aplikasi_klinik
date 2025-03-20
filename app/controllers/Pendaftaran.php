<?php

namespace controllers;

use model\Pendaftaran_model;

class Pendaftaran
{
   protected $konfig;
   public function __construct()
   {
      $this->konfig = new Pendaftaran_model();
   }

   public function daftar_tambah()
   {
      if (isset($_POST['simpan'])):
         $pasien = htmlspecialchars($_POST['id_pasien']);
         $dokter = htmlspecialchars($_POST['id_dokter']);
         $result = $this->konfig->tambah_pendaftaran($pasien, $dokter);
         if ($result === true):
            header("Location:" . URL_BASE . "admin/ui/header.php?page=pendaftaran");
         else:
            header("Location:" . URL_BASE . "admin/ui/header.php?aksi=tambah-pendaftaran");
         endif;
      endif;
   }

   public function hapus()
   {
      $no_pendaftaran = htmlspecialchars($_GET['no_pendaftaran']);
      $res = $this->konfig->hapus_pendaftaran($no_pendaftaran);
      if ($res === true):
         header("Location:" . URL_BASE . "admin/ui/header.php?page=pendaftaran");
      else:
         header("Location:" . URL_BASE . "admin/ui/header.php?page=pendaftaran");
      endif;
   }
}
