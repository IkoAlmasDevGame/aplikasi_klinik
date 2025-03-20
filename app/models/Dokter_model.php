<?php

namespace model;

use core\Database;

class Dokter_model
{
   protected $tabel = "tb_dokter"; # database in website phpmyadmin
   protected $dbh;

   public function __construct()
   {
      $this->dbh = new Database;
   }

   public function getByDocter()
   {
      $result = $this->dbh->query("SELECT * FROM tb_dokter JOIN tb_user ON tb_dokter.id_dokter = tb_user.id_dokter order by tb_dokter.id_dokter asc");
      return $result;
   }

   public function tambah_Docter($nama_dokter, $alamat_dokter, $umur)
   {
      if (empty($_POST['nama_dokter']) || empty($_POST['alamat_dokter']) || empty($_POST['umur'])):
         header("Location:" . URL_BASE . "admin/ui/header.php?aksi=tambah-dokter");
         exit(0);
      else:
         $nama_dokter = htmlspecialchars($_POST['nama_dokter']);
         $alamat_dokter = htmlspecialchars($_POST['alamat_dokter']);
         $umur = htmlspecialchars($_POST['umur']);
         $jk_dokter = htmlspecialchars($_POST['jk_dokter']);
         $stts = "1";
         $result = $this->dbh->query("INSERT INTO $this->tabel SET nama_dokter = '$nama_dokter', jk_dokter = '$jk_dokter', alamat_dokter = '$alamat_dokter', umur = '$umur', stts = '$stts'");
         if ($result != "") {
            if ($result) {
               $res = $this->dbh->SELECTMAXLIMIT($this->tabel, "id_dokter", "id_dokter");
               $id_dokter = $res['id_dokter'];
               $pengguna = htmlspecialchars($_POST['pengguna']);
               $sandi = md5($_POST['sandi'], false);
               $this->dbh->query("INSERT INTO tb_user (id_pengguna, id_dokter, pengguna, sandi, hak_akses) VALUES ('', '$id_dokter', '$pengguna', '$sandi', 'dokter')");
               echo json_encode(["id_dokter" => $id_dokter, "pengguna" => $_POST['pengguna'], "sandi" => $sandi, "hak_akses" => "dokter"]);
               return true;
            }
         } else {
            echo json_encode(["error code" => mysqli_connect_errno()]);
            return false;
         }
      endif;
   }

   public function edit_Docter($nama_dokter, $alamat_dokter, $umur, $jk_dokter, $id_dokter)
   {
      $nama_dokter = htmlspecialchars($_POST['nama_dokter']);
      $alamat_dokter = htmlspecialchars($_POST['alamat_dokter']);
      $umur = htmlspecialchars($_POST['umur']);
      $jk_dokter = htmlspecialchars($_POST['jk_dokter']);
      $id_dokter = htmlspecialchars($_POST['id_dokter']);
      $result = $this->dbh->query("UPDATE $this->tabel SET nama_dokter = '$nama_dokter', jk_dokter = '$jk_dokter', alamat_dokter = '$alamat_dokter', umur = '$umur' WHERE id_dokter = '$id_dokter'");
      if ($result != "") {
         if ($result) {
            $pengguna = htmlspecialchars($_POST['pengguna']);
            $sandi = md5($_POST['sandi'], false);
            $this->dbh->query("UPDATE tb_user SET pengguna = '$pengguna', sandi = '$sandi' WHERE id_dokter = '$id_dokter'");
            echo json_encode(["nama_dokter" => $nama_dokter, "alamat_dokter" => $alamat_dokter, "umur" => $umur, "jk_dokter" => $jk_dokter, "id_dokter" => $id_dokter]);
            return true;
         }
      } else {
         echo json_encode(["error code" => mysqli_connect_errno()]);
         return false;
      }
   }

   public function hapus_Docter($id_dokter)
   {
      $id_dokter = htmlspecialchars($_GET['id_dokter']);
      $res = $this->dbh->delete($this->tabel, "id_dokter", $id_dokter);
      if ($res != "") {
         if ($res) {
            $this->dbh->delete("tb_user", "id_dokter", $id_dokter);
            echo json_encode(["id_dokter" => $id_dokter]);
            return true;
         }
      } else {
         echo json_encode(["code error " => mysqli_connect_errno()]);
         return false;
      }
   }
}
