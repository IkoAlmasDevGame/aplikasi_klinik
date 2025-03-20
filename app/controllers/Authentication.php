<?php

namespace controllers;

use model\Authentication_model;

class Authentication
{
   protected $konfig;
   public function __construct()
   {
      $this->konfig = new Authentication_model();
   }

   public function ubahPassword()
   {
      if (isset($_POST['simpan'])):
         $sandi_baru = md5($_POST['sandi_baru'], false);
         $id_pengguna = htmlspecialchars($_POST['id_pengguna']);
         $res = $this->konfig->editPassword($id_pengguna, $sandi_baru);
         if ($res === true):
            return true;
         else:
            return false;
         endif;
      endif;
   }

   public function ubahPassword2()
   {
      if (isset($_POST['simpan'])):
         $sandi_baru = md5($_POST['sandi_baru'], false);
         $id_pengguna = htmlspecialchars($_POST['id_pengguna']);
         $res = $this->konfig->editPassword2($id_pengguna, $sandi_baru);
         if ($res === true):
            return true;
         else:
            return false;
         endif;
      endif;
   }

   public function ubahPassword3()
   {
      if (isset($_POST['simpan'])):
         $sandi_baru = md5($_POST['sandi_baru'], false);
         $id_pengguna = htmlspecialchars($_POST['id_pengguna']);
         $res = $this->konfig->editPassword3($id_pengguna, $sandi_baru);
         if ($res === true):
            return true;
         else:
            return false;
         endif;
      endif;
   }

   public function Login()
   {
      if (isset($_POST['submit'])) {
         $username = htmlspecialchars($_POST['pengguna']);
         $password = md5($_POST['sandi'], false);
         $data = $this->konfig->LoginAuth($username, $password);
         if ($data === true):
            return true;
         else:
            return false;
         endif;
      }
   }
}
