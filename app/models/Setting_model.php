<?php

namespace model;

use core\Database;

class Setting_model
{
   protected $tabel = "tb_setting"; # database in website phpmyadmin
   protected $dbh;

   public function __construct()
   {
      $this->dbh = new Database;
   }

   public function edit_perusahaan($nama_developer, $nama_website, $alamat, $id)
   {
      $nama_developer = htmlspecialchars($_POST['nama_developer']);
      $nama_website = htmlspecialchars($_POST['nama_website']);
      $alamat = htmlspecialchars($_POST['alamat']);
      $id = htmlspecialchars($_POST['id_setting']);
      $ganti = isset($_POST['ganti']);
      $fotolama = $_POST['foto_icon'];

      # Foto 
      $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif');
      $photo_src = htmlentities($_FILES["foto_icon_new"]["name"]) ? htmlspecialchars($_FILES["foto_icon_new"]["name"]) : $_FILES["foto_icon_new"]["name"];
      $x_foto = explode('.', $photo_src);
      $ekstensi_photo_src = strtolower(end($x_foto));
      $ukuran_photo_src = $_FILES['foto_icon_new']['size'];
      $file_tmp_photo_src = $_FILES['foto_icon_new']['tmp_name'];

      # selection Foto
      if (in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true) {
         if ($ukuran_photo_src < 10440070) {
            move_uploaded_file($file_tmp_photo_src, BASE_URL . "assets/icon/" . $photo_src);
         } else {
            echo "Tidak Dapat Ter - Upload Size Gambar\nTidak Dapat Ter-Upload Ke Dalam Database";
            exit(0);
         }
      } else {
         $update = "UPDATE $this->tabel SET nama_developer = '$nama_developer', nama_website = '$nama_website', alamat = '$alamat', foto_icon = '$fotolama' WHERE id_setting = '$id'";
         $querylama = $this->dbh->query($update);
         if ($querylama != "") {
            if ($querylama) {
               return true;
            }
         } else {
            return false;
         }
      }

      # database
      $setting = $this->dbh->SELECT_WHERE($this->tabel, "id_setting", $id);
      $set = mysqli_fetch_array($setting);
      if ($set['id_setting'] > 0) {
         if ($ganti) {
            if ($set['foto_icon'] == "") {
               $update = "UPDATE $this->tabel SET nama_developer = '$nama_developer', nama_website = '$nama_website', alamat = '$alamat', foto_icon = '$photo_src' WHERE id_setting = '$id'";
               $query = $this->dbh->query($update);
               if ($query != "") {
                  if ($query) {
                     return true;
                  }
               } else {
                  return false;
               }
            } elseif ($set['foto_icon'] != "") {
               if ($photo_src != "") {
                  unlink(BASE_URL . "assets/icon/$set[foto_icon]");
                  $update = "UPDATE $this->tabel SET nama_developer = '$nama_developer', nama_website = '$nama_website', alamat = '$alamat', foto_icon = '$photo_src' WHERE id_setting = '$id'";
                  $query = $this->dbh->query($update);
                  if ($query != "") {
                     if ($query) {
                        return true;
                     }
                  } else {
                     return false;
                  }
               }
            }
         }
      }
   }

   public function getBySetting()
   {
      $data = $this->dbh->SELECT($this->tabel);
      $row = mysqli_fetch_array($data, MYSQLI_BOTH);
      return $row;
   }
}
