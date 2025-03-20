<?php

namespace controllers;

use model\Pasien_model;

class Pasien
{
   protected $konfig;
   public function __construct()
   {
      $this->konfig = new Pasien_model();
   }

   public function pasien_tambah()
   {
      if (isset($_POST['simpan'])) {
         $nik_pasien = htmlspecialchars($_POST['nik_pasien']);
         $nama_pasien = htmlspecialchars($_POST['nama_pasien']);
         $umur = htmlspecialchars($_POST['umur']);
         $jk = htmlspecialchars($_POST['jk']);
         $tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
         $alamat_pasien = htmlspecialchars($_POST['alamat_pasien']);
         $result = $this->konfig->tambah_pasien($nik_pasien, $nama_pasien, $umur, $jk, $tgl_lahir, $alamat_pasien);
         if ($result === true):
            header("Location:" . URL_BASE . "admin/ui/header.php?page=pasien");
            return true;
         else:
            header("Location:" . URL_BASE . "admin/ui/header.php?aksi=tambah-pasien");
            return false;
         endif;
      }
   }

   public function pasien_hapus()
   {
      $id_pasien = htmlspecialchars($_GET['id_pasien']);
      $res = $this->konfig->hapus_pasien($id_pasien);
      if ($res === true):
         header("Location:" . URL_BASE . "admin/ui/header.php?page=pasien");
         return true;
      else:
         header("Location:" . URL_BASE . "admin/ui/header.php?page=pasien");
         return false;
      endif;
   }

   public function pasien_edit()
   {
      if (isset($_POST['simpan'])) {
         $nik_pasien = htmlspecialchars($_POST['nik_pasien']);
         $nama_pasien = htmlspecialchars($_POST['nama_pasien']);
         $umur = htmlspecialchars($_POST['umur']);
         $jk = htmlspecialchars($_POST['jk']);
         $tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
         $alamat_pasien = htmlspecialchars($_POST['alamat_pasien']);
         $tgl_daftar = htmlspecialchars($_POST['tgl_daftar']);
         $stts = htmlspecialchars($_POST['stts']);
         $id_pasien = htmlspecialchars($_POST['id_pasien']);
         $result = $this->konfig->ubah_pasien($nik_pasien, $nama_pasien, $umur, $jk, $tgl_lahir, $alamat_pasien, $tgl_daftar, $stts, $id_pasien);
         if ($result === true):
            header("Location:" . URL_BASE . "admin/ui/header.php?page=pasien");
            return true;
         else:
            header("Location:" . URL_BASE . "admin/ui/header.php?aksi=edit-pasien&id_pasien=$id_pasien");
            return false;
         endif;
      }
   }
}
