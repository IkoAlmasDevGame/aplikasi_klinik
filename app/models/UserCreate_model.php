<?php

namespace model;

use core\Database;

class UserCreate_model
{
   protected $tabel = "tb_user"; # database in website phpmyadmin
   protected $dbh;

   public function __construct()
   {
      $this->dbh = new Database;
   }

   public function getByUsers()
   {
      $sql = "SELECT * FROM tb_user group by id_pengguna, status order by id_pengguna asc";
      $result = $this->dbh->query($sql);
      return $result;
   }

   public function tambah_users($pengguna, $sandi, $hak_akses)
   {
      $pengguna = htmlspecialchars($_POST['pengguna']);
      $sandi = md5($_POST['sandi'], false);
      $hak_akses = htmlspecialchars($_POST['hak_akses']);
      $res = $this->dbh->SELECT_WHERE($this->tabel, "pengguna", $pengguna);
      if (mysqli_num_rows($res) > 0) {
         echo "<script>alert('Pengguna sudah ada.');</script>";
      } else {
         if ($hak_akses == "admin") {
            $sql = "INSERT INTO $this->tabel SET id_dokter = '', pengguna = '$pengguna', sandi = '$sandi', hak_akses = 'admin', status = 'offline'";
            $admin = $this->dbh->query($sql);
            if ($admin != "") {
               if ($admin) {
                  return true;
               }
            } else {
               return false;
            }
         } elseif ($hak_akses == "kepala_klinik") {
            $sql = "INSERT INTO $this->tabel SET id_dokter = '', pengguna = '$pengguna', sandi = '$sandi', hak_akses = 'kepala_klinik', status = 'offline'";
            $kepala = $this->dbh->query($sql);
            if ($kepala != "") {
               if ($kepala) {
                  return true;
               }
            } else {
               return false;
            }
         }
      }
   }

   public function hapus_users($id)
   {
      $id = htmlspecialchars($_GET['id_pengguna']);
      $admin = $this->dbh->delete($this->tabel, "id_pengguna", $id);
      if ($admin != "") {
         if ($admin) {
            return true;
         }
      } else {
         return false;
      }
   }

   public function edit_users($pengguna, $hak_akses, $id)
   {
      $pengguna = htmlspecialchars($_POST['pengguna']);
      $hak_akses = htmlspecialchars($_POST['hak_akses']);
      $id = htmlspecialchars($_POST['id_pengguna']);
      $sql = "UPDATE $this->tabel SET pengguna = '$pengguna', hak_akses = '$hak_akses' WHERE id_pengguna = '$id'";
      $admin = $this->dbh->query($sql);
      if ($admin != "") {
         if ($admin) {
            return true;
         }
      } else {
         return false;
      }
   }
}
