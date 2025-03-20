<?php

namespace model;

use core\Database;

class RekamMedis_model
{
   protected $tabel = "tb_rekam_medis"; # database in website phpmyadmin
   protected $dbh;

   public function __construct()
   {
      $this->dbh = new Database;
   }

   public function getByRekamMedis()
   {
      $sql = "SELECT * FROM tb_rekam_medis ORDER BY id desc";
      $res = $this->dbh->query($sql);
      return $res;
   }

   public function getByRekamMedis2()
   {
      $sql = "SELECT * FROM tb_pasien WHERE nik_pasien = '$_POST[pencarian]' OR nama_pasien = '$_POST[pencarian]'";
      $res = $this->dbh->query($sql);
      $bc4 = mysqli_fetch_array($res);
      $result = $this->dbh->query("SELECT * FROM tb_rekam_medis WHERE id_pasien = '$bc4[id_pasien]' ORDER BY id desc");
      return $result;
   }

   public function tambah_rekammedis($id_pasien, $id_dokter, $tgl_periksa, $umur, $terapi, $diagnosa)
   {
      $no_pendaftaran = htmlspecialchars($_POST['no_pendaftaran']);
      $id_pasien = htmlspecialchars($_POST['id_pasien']);
      $id_dokter = htmlspecialchars($_POST['id_dokter']);
      $tgl_periksa = date("H:i:s d-m-Y");
      $umur = htmlspecialchars($_POST['umur']);
      $terapi = htmlspecialchars($_POST['terapi']);
      $diagnosa = htmlspecialchars($_POST['diagnosa']);
      # database
      $res = $this->dbh->query("SELECT * FROM $this->tabel WHERE id_pasien = '$id_pasien'");
      if (mysqli_num_rows($res) > 0) {
         $setHalaman = URL_BASE . "admin/ui/header.php?aksi=inputRekamMedis&no=$no_pendaftaran";
         echo '<script language="javascript">alert ("Nama Sudah Ada");</script>';
         echo "<script language='javascript'>location.href = '$setHalaman';</script>";
      } else {
         $sql = "INSERT INTO $this->tabel SET id_pasien='$id_pasien', id_dokter='$id_dokter', tgl_periksa = '$tgl_periksa', umur = '$umur', terapi = '$terapi', diagnosa = '$diagnosa'";
         $result = $this->dbh->query($sql);
         if ($result != "") {
            if ($result) {
               $Halaman = URL_BASE . "admin/ui/header.php?page=antrian";
               echo "<script language='javascript'>location.href = '$Halaman';</script>";
               $this->dbh->query("UPDATE tb_pendaftaran SET tgl_periksa='$tgl_periksa', stts='2' WHERE no_pendaftaran = '$no_pendaftaran'");
               return true;
            }
         } else {
            $setHalaman = URL_BASE . "admin/ui/header.php?aksi=inputRekamMedis&no=$no_pendaftaran";
            echo "<script language='javascript'>location.href = '$setHalaman';</script>";
            return false;
         }
      }
   }

   public function edit_rekammedis($umur, $terapi, $diagnosa, $id)
   {
      $id = htmlspecialchars($_POST['id']);
      $umur = htmlspecialchars($_POST['umur']);
      $terapi = htmlspecialchars($_POST['terapi']);
      $diagnosa = htmlspecialchars($_POST['diagnosa']);
      $sql = "UPDATE tb_rekam_medis SET umur = '$umur', terapi = '$terapi', diagnosa = '$diagnosa' WHERE id = '$id'";
      $result = $this->dbh->query($sql);
      if ($result != "") {
         if ($result) {
            $Halaman = URL_BASE . "admin/ui/header.php?page=rekam_medis";
            echo "<script language='javascript'>location.href = '$Halaman';</script>";
            return true;
         }
      } else {
         $setHalaman = URL_BASE . "admin/ui/header.php?aksi=editRekamMedis&no=$id";
         echo "<script language='javascript'>location.href = '$setHalaman';</script>";
         return false;
      }
   }
}
