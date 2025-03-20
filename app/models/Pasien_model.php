<?php

namespace model;

use core\Database;

class Pasien_model
{
   protected $tabel = "tb_pasien"; # database in website phpmyadmin
   protected $dbh;

   public function __construct()
   {
      $this->dbh = new Database;
   }

   public function getByPasien()
   {
      $sql = "SELECT * FROM tb_pasien WHERE stts = '1' ORDER BY id_pasien desc";
      $result = $this->dbh->query($sql);
      return $result;
   }

   public function tambah_pasien($nik_pasien, $nama_pasien, $umur, $jk, $tgl_lahir, $alamat_pasien)
   {
      if (empty($_POST['nik_pasien']) || empty($_POST['nama_pasien']) || empty($_POST['umur']) || empty($_POST['jk']) || empty($_POST['tgl_lahir']) || empty($_POST['alamat_pasien'])) {
         header("Location:" . URL_BASE . "admin/ui/header.php?aksi=tambah-pasien");
         exit(0);
      } else {
         $nik_pasien = htmlspecialchars($_POST['nik_pasien']);
         $nama_pasien = htmlspecialchars($_POST['nama_pasien']);
         $umur = htmlspecialchars($_POST['umur']);
         $jk = htmlspecialchars($_POST['jk']);
         $tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
         $alamat_pasien = htmlspecialchars($_POST['alamat_pasien']);
         $tgl_daftar = date('Y-m-d');
         # database
         $res = $this->dbh->SELECT_WHERE("tb_pasien", "nik_pasien", $nik_pasien);
         if (mysqli_num_rows($res) > 0) {
            header("Location:" . URL_BASE . "admin/ui/header.php?aksi=tambah-pasien");
            exit(0);
         } else {
            $sql = "INSERT INTO $this->tabel (id_pasien, nik_pasien, nama_pasien, umur, jk, tgl_lahir, alamat_pasien, tgl_daftar, stts) 
            VALUES ('', '$nik_pasien', '$nama_pasien', '$umur', '$jk', '$tgl_lahir', '$alamat_pasien', '$tgl_daftar', '1')";
            $result = $this->dbh->query($sql);
            if ($result != "") {
               if ($result) {
                  echo "<script>alert('Data Berhasil Disimpan');</script>";
                  json_encode(["nik_pasien" => $nik_pasien, "nama_pasien" => $nama_pasien, "umur" => $umur, "jk" => $jk, "tgl_lahir" => $tgl_lahir, "alamat_pasien" => $alamat_pasien, "tgl_daftar" => $tgl_daftar]);
                  return true;
               }
            } else {
               echo "<script>alert('Data Gagal Disimpan');</script>";
               json_encode(["code error " => mysqli_connect_errno()]);
               return false;
            }
         }
      }
   }

   public function hapus_pasien($id_pasien)
   {
      $id_pasien = htmlspecialchars($_GET['id_pasien']);
      $res = $this->dbh->delete($this->tabel, "id_pasien", $id_pasien);
      if ($res != "") {
         if ($res) {
            echo "<script>alert('Data Berhasil Dihapus');</script>";
            json_encode(["id_pasien" => $id_pasien]);
            return true;
         }
      } else {
         echo "<script>alert('Data Gagal Dihapus');</script>";
         json_encode(["code error " => mysqli_connect_errno()]);
         return false;
      }
   }

   public function ubah_pasien($nik_pasien, $nama_pasien, $umur, $jk, $tgl_lahir, $alamat_pasien, $tgl_daftar, $stts, $id_pasien)
   {
      $nik_pasien = htmlspecialchars($_POST['nik_pasien']);
      $nama_pasien = htmlspecialchars($_POST['nama_pasien']);
      $umur = htmlspecialchars($_POST['umur']);
      $jk = htmlspecialchars($_POST['jk']);
      $tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
      $alamat_pasien = htmlspecialchars($_POST['alamat_pasien']);
      $tgl_daftar = htmlspecialchars($_POST['tgl_daftar']);
      $stts = htmlspecialchars($_POST['stts']);
      $id_pasien = htmlspecialchars($_POST['id_pasien']);
      $sql = "UPDATE $this->tabel SET nik_pasien = '$nik_pasien', nama_pasien = '$nama_pasien', umur = '$umur', jk = '$jk', tgl_lahir = '$tgl_lahir', 
      alamat_pasien = '$alamat_pasien', tgl_daftar = '$tgl_daftar', stts = '$stts' WHERE id_pasien = '$id_pasien'";
      $result = $this->dbh->query($sql);
      if ($result != "") {
         if ($result) {
            echo "<script>alert('Data Berhasil Dirubah');</script>";
            json_encode([
               "nik_pasien" => $nik_pasien,
               "nama_pasien" => $nama_pasien,
               "umur" => $umur,
               "jk" => $jk,
               "tgl_lahir" => $tgl_lahir,
               "alamat_pasien" => $alamat_pasien,
               "tgl_daftar" => $tgl_daftar,
               "stts" => $stts,
               "id_pasien" => $id_pasien
            ]);
            return true;
         }
      } else {
         echo "<script>alert('Data Gagal Dirubah');</script>";
         json_encode(["code error " => mysqli_connect_errno()]);
         return false;
      }
   }
}
