<?php

namespace controllers;

use model\Dokter_model;

class Dokter
{
   protected $konfig;
   public function __construct()
   {
      $this->konfig = new Dokter_model();
   }

   public function dokter_tambah()
   {
      if (isset($_POST['simpan'])):
         $nama_dokter = htmlspecialchars($_POST['nama_dokter']);
         $alamat_dokter = htmlspecialchars($_POST['alamat_dokter']);
         $umur = htmlspecialchars($_POST['umur']);
         $data = $this->konfig->tambah_Docter($nama_dokter, $alamat_dokter, $umur);
         if ($data == true):
            header("Location:" . URL_BASE . "admin/ui/header.php?page=dokter");
            exit(0);
         else:
            header("Location:" . URL_BASE . "admin/ui/header.php?aksi=tambah-dokter");
            exit(0);
         endif;
      endif;
   }

   public function dokter_edit()
   {
      if (isset($_POST['simpan'])):
         $nama_dokter = htmlspecialchars($_POST['nama_dokter']);
         $alamat_dokter = htmlspecialchars($_POST['alamat_dokter']);
         $umur = htmlspecialchars($_POST['umur']);
         $jk_dokter = htmlspecialchars($_POST['jk_dokter']);
         $id_dokter = htmlspecialchars($_POST['id_dokter']);
         $data = $this->konfig->edit_Docter($nama_dokter, $alamat_dokter, $umur, $jk_dokter, $id_dokter);
         if ($data == true):
            header("Location:" . URL_BASE . "admin/ui/header.php?page=dokter");
            exit(0);
         else:
            header("Location:" . URL_BASE . "admin/ui/header.php?aksi=edit-dokter&id_dokter=$id_dokter");
            exit(0);
         endif;
      endif;
   }

   public function dokter_hapus()
   {
      $id_dokter = htmlspecialchars($_GET['id_dokter']);
      $data = $this->konfig->hapus_Docter($id_dokter);
      if ($data == true):
         header("Location:" . URL_BASE . "admin/ui/header.php?page=dokter");
         exit(0);
      else:
         header("Location:" . URL_BASE . "admin/ui/header.php?page=dokter");
         exit(0);
      endif;
   }
}
