<?php

namespace controllers;

use model\Setting_model;

class Setting
{
   protected $konfig;
   public function __construct()
   {
      $this->konfig = new Setting_model();
   }

   public function ubah_perusahaan()
   {
      if (isset($_POST['simpan'])):
         $nama_developer = htmlspecialchars($_POST['nama_developer']);
         $nama_website = htmlspecialchars($_POST['nama_website']);
         $alamat = htmlspecialchars($_POST['alamat']);
         $id = htmlspecialchars($_POST['id_setting']);
         $result = $this->konfig->edit_perusahaan($nama_developer, $nama_website, $alamat, $id);
         if ($result === true):
            $setHalaman = URL_BASE . "admin/ui/header.php?page=edit-perusahaan&id_setting=$id";
            echo "<script>location.href = '$setHalaman'; alert('Data berhasil Di Update');</script>";
            die;
         else:
            $setHalaman2 = URL_BASE . "admin/ui/header.php?page=edit-perusahaan&id_setting=$id";
            echo "<script>location.href = '$setHalaman2'; alert('Data Gagal Di Update');</script>";
         endif;
      endif;
   }
}
