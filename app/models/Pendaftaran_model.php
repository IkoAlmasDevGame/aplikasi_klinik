<?php

namespace model;

use core\Database;

class Pendaftaran_model
{
   protected $tabel = "tb_pendaftaran"; # database in website phpmyadmin
   protected $dbh;

   public function __construct()
   {
      $this->dbh = new Database;
   }

   public function getByPendaftaran()
   {
      $sql = "SELECT * FROM tb_pendaftaran WHERE stts ='1' ORDER BY no_pendaftaran desc";
      $result = $this->dbh->query($sql);
      return $result;
   }

   public function getByPendaftaranPeriksa()
   {
      $sql = "SELECT * FROM tb_pendaftaran WHERE stts ='2' ORDER BY no_pendaftaran desc";
      $result = $this->dbh->query($sql);
      return $result;
   }

   public function hapus_semua()
   {
      $res = $this->dbh->query("DELETE FROM $this->tabel");
      if ($res === true):
         header("Location:" . URL_BASE . "admin/ui/header.php?page=pendaftaran");
         exit(0);
         return true;
      else:
         header("Location:" . URL_BASE . "admin/ui/header.php?page=pendaftaran");
         exit(0);
         return false;
      endif;
   }

   public function hapus_pendaftaran($no_pendaftaran)
   {
      $no_pendaftaran = htmlspecialchars($_GET['no_pendaftaran']);
      $res = $this->dbh->delete($this->tabel, "no_pendaftaran", $no_pendaftaran);
      if ($res != "") {
         if ($res) {
            echo "<script>alert('Data Berhasil Dihapus');</script>";
            json_encode(["no_pendaftaran" => $no_pendaftaran]);
            return true;
         }
      } else {
         echo "<script>alert('Data Gagal Dihapus');</script>";
         json_encode(["code error " => mysqli_connect_errno()]);
         return false;
      }
   }

   public function edit_pendaftaran() {}

   public function tambah_pendaftaran($pasien, $dokter)
   {
      $pasien = htmlspecialchars($_POST['id_pasien']);
      $dokter = htmlspecialchars($_POST['id_dokter']);
      $tgl_periksa = "";
      $waktu_pendaftaran = date("H:i:s d-m-Y");
      # database
      $sql = "INSERT INTO $this->tabel SET id_pasien = '$pasien', id_dokter = '$dokter', tgl_periksa = '$tgl_periksa', waktu_pendaftaran = '$waktu_pendaftaran', stts = '1'";
      $result = $this->dbh->query($sql);
      if ($result != "") {
         if ($result) {
            json_encode(["id_pasien" => $pasien, "id_dokter" => $dokter, "waktu_pendaftaran" => $waktu_pendaftaran]);
            return true;
         }
      } else {
         json_encode(["code error " => mysqli_connect_errno()]);
         return false;
      }
   }
}