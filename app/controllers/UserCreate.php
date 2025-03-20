<?php

namespace controllers;

use model\UserCreate_model;

class UserCreate
{
   protected $konfig;
   public function __construct()
   {
      $this->konfig = new UserCreate_model();
   }

   public function users_tambah()
   {
      if (isset($_POST['simpan'])):
         $pengguna = htmlspecialchars($_POST['pengguna']);
         $sandi = md5($_POST['sandi'], false);
         $hak_akses = htmlspecialchars($_POST['hak_akses']);
         $res = $this->konfig->tambah_users($pengguna, $sandi, $hak_akses);
         if ($res === true):
            header("Location:" . URL_BASE . "admin/ui/header.php?page=users");
            exit(0);
         else:
            header("Location:" . URL_BASE . "admin/ui/header.php?aksi=tambah-users");
            exit(0);
         endif;
      endif;
   }

   public function users_hapus()
   {
      $id = htmlspecialchars($_GET['id_pengguna']);
      $res = $this->konfig->hapus_users($id);
      if ($res === true):
         header("Location:" . URL_BASE . "admin/ui/header.php?page=users");
         exit(0);
      else:
         header("Location:" . URL_BASE . "admin/ui/header.php?page=users");
         exit(0);
      endif;
   }

   public function users_edit()
   {
      if (isset($_POST['simpan'])):
         $pengguna = htmlspecialchars($_POST['pengguna']);
         $hak_akses = htmlspecialchars($_POST['hak_akses']);
         $id = htmlspecialchars($_POST['id_pengguna']);
         $res = $this->konfig->edit_users($pengguna, $hak_akses, $id);
         if ($res === true):
            header("Location:" . URL_BASE . "admin/ui/header.php?page=users");
            exit(0);
         else:
            header("Location:" . URL_BASE . "admin/ui/header.php?aksi=edit-users&id_pengguna=$id");
            exit(0);
         endif;
      endif;
   }
}