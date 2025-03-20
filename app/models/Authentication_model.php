<?php

namespace model;

use core\Database;

class Authentication_model
{
   protected $tabel = "tb_user"; # database in website phpmyadmin
   protected $dbh;

   public function __construct()
   {
      $this->dbh = new Database;
   }

   public function LogOut()
   {
      if (isset($_SESSION['status'])):
         unset($_SESSION['status']);
         $this->dbh->query("UPDATE $this->tabel SET status = 'offline' WHERE id_pengguna = '$_SESSION[admin]'");
         session_unset();
         session_destroy();
      endif;
      echo "<script>alert('Anda Telah Logout');</script>";
      echo "<script>document.location.href = '../../../index.php';</script>";
      die;
   }

   public function LogOut2()
   {
      if (isset($_SESSION['status'])):
         unset($_SESSION['status']);
         $this->dbh->query("UPDATE $this->tabel SET status = 'offline' WHERE id_pengguna = '$_SESSION[id_dokter]'");
         session_unset();
         session_destroy();
      endif;
      echo "<script>alert('Anda Telah Logout');</script>";
      echo "<script>document.location.href = '../../../index.php';</script>";
      die;
   }

   public function LogOut3()
   {
      if (isset($_SESSION['status'])):
         unset($_SESSION['status']);
         $this->dbh->query("UPDATE $this->tabel SET status = 'offline' WHERE id_pengguna = '$_SESSION[kepala]'");
         session_unset();
         session_destroy();
      endif;
      echo "<script>alert('Anda Telah Logout');</script>";
      echo "<script>document.location.href = '../../../index.php';</script>";
      die;
   }

   public function editPassword($id_pengguna, $sandi_baru)
   {
      $sandi_verify = md5($_POST['sandi_verify'], false);
      $sandi_baru = md5($_POST['sandi_baru'], false);
      $id_pengguna = htmlspecialchars($_POST['id_pengguna']);

      # database
      $query = $this->dbh->query("SELECT * FROM $this->tabel WHERE id_pengguna = '$id_pengguna'");
      $array = mysqli_fetch_array($query);
      $sandilama = password_verify(md5($array['sandi'], false), PASSWORD_DEFAULT);
      $cekpassword = array("sandi" => password_verify(md5($_POST['sandi_lama'], false), PASSWORD_DEFAULT));

      if (in_array($sandilama, $cekpassword) === true) {
         echo "<script>alert('Password lama anda sama ...')</script>";
         # Set Update Password
         if ($sandi_baru == $sandi_verify) {
            $data = $this->dbh->query("UPDATE $this->tabel SET sandi = '$sandi_baru' WHERE id_pengguna = '$id_pengguna'");
            if ($data != "") {
               if ($data) {
                  $setUpHalaman = URL_BASE . "admin/ui/header.php?page=edit-profile&id_pengguna=$id_pengguna";
                  echo "<script>location.href = '$setUpHalaman';</script>";
                  json_encode(["sandi" => $sandi_baru, "id_pengguna" => $id_pengguna]);
                  return true;
               }
            } else {
               header("Location:" . URL_BASE . "admin/ui/header.php?page=beranda");
               json_encode(["error" => mysqli_connect_errno()]);
               return false;
            }
         }
      } else {
         echo "<script>alert('Password lama anda tidak sama ...')</script>";
         $setHalaman2 = URL_BASE . "admin/ui/header.php?page=edit-profile&id_pengguna=$id_pengguna";
         echo "<script>location.href = '$setHalaman2';</script>";
         return false;
      }
   }

   public function editPassword2($id_pengguna, $sandi_baru)
   {
      $sandi_verify = md5($_POST['sandi_verify'], false);
      $sandi_baru = md5($_POST['sandi_baru'], false);
      $id_pengguna = htmlspecialchars($_POST['id_pengguna']);

      # database
      $query = $this->dbh->query("SELECT * FROM $this->tabel WHERE id_pengguna = '$id_pengguna'");
      $array = mysqli_fetch_array($query);
      $sandilama = password_verify(md5($array['sandi'], false), PASSWORD_DEFAULT);
      $cekpassword = array("sandi" => password_verify(md5($_POST['sandi_lama'], false), PASSWORD_DEFAULT));

      if (in_array($sandilama, $cekpassword) === true) {
         echo "<script>alert('Password lama anda sama ...')</script>";
         # Set Update Password
         if ($sandi_baru == $sandi_verify) {
            $data = $this->dbh->query("UPDATE $this->tabel SET sandi = '$sandi_baru' WHERE id_pengguna = '$id_pengguna'");
            if ($data != "") {
               if ($data) {
                  $setUpHalaman = URL_BASE . "dokter/ui/header.php?page=edit-profile&id_pengguna=$id_pengguna";
                  echo "<script>location.href = '$setUpHalaman';</script>";
                  json_encode(["sandi" => $sandi_baru, "id_pengguna" => $id_pengguna]);
                  return true;
               }
            } else {
               header("Location:" . URL_BASE . "dokter/ui/header.php?page=beranda");
               json_encode(["error" => mysqli_connect_errno()]);
               return false;
            }
         }
      } else {
         echo "<script>alert('Password lama anda tidak sama ...')</script>";
         $setHalaman2 = URL_BASE . "dokter/ui/header.php?page=edit-profile&id_pengguna=$id_pengguna";
         echo "<script>location.href = '$setHalaman2';</script>";
         return false;
      }
   }

   public function editPassword3($id_pengguna, $sandi_baru)
   {
      $sandi_verify = md5($_POST['sandi_verify'], false);
      $sandi_baru = md5($_POST['sandi_baru'], false);
      $id_pengguna = htmlspecialchars($_POST['id_pengguna']);

      # database
      $query = $this->dbh->query("SELECT * FROM $this->tabel WHERE id_pengguna = '$id_pengguna'");
      $array = mysqli_fetch_array($query);
      $sandilama = password_verify(md5($array['sandi'], false), PASSWORD_DEFAULT);
      $cekpassword = array("sandi" => password_verify(md5($_POST['sandi_lama'], false), PASSWORD_DEFAULT));

      if (in_array($sandilama, $cekpassword) === true) {
         echo "<script>alert('Password lama anda sama ...')</script>";
         # Set Update Password
         if ($sandi_baru == $sandi_verify) {
            $data = $this->dbh->query("UPDATE $this->tabel SET sandi = '$sandi_baru' WHERE id_pengguna = '$id_pengguna'");
            if ($data != "") {
               if ($data) {
                  $setUpHalaman = URL_BASE . "kepalaklinik/ui/header.php?page=edit-profile&id_pengguna=$id_pengguna";
                  echo "<script>location.href = '$setUpHalaman';</script>";
                  json_encode(["sandi" => $sandi_baru, "id_pengguna" => $id_pengguna]);
                  return true;
               }
            } else {
               header("Location:" . URL_BASE . "kepalaklinik/ui/header.php?page=beranda");
               json_encode(["error" => mysqli_connect_errno()]);
               return false;
            }
         }
      } else {
         echo "<script>alert('Password lama anda tidak sama ...')</script>";
         $setHalaman2 = URL_BASE . "kepalaklinik/ui/header.php?page=edit-profile&id_pengguna=$id_pengguna";
         echo "<script>location.href = '$setHalaman2';</script>";
         return false;
      }
   }

   public function LoginAuth($username, $password)
   {
      session_start();
      if (empty($_POST['pengguna']) || empty($_POST['sandi'])) {
         header("Location:" . URL_BASE . "errors/error-msg.php?HttpStatus=403");
         exit(0);
      } else {
         $username = htmlspecialchars($_POST['pengguna']);
         $password = md5($_POST['sandi'], false);
         $akses = htmlspecialchars($_POST['hak_akses']);
         $hasil = $_POST['angka1'] + $_POST['angka2'];
         password_verify($password, PASSWORD_DEFAULT);
         if ($akses == "admin") {
            $sql = "SELECT * FROM $this->tabel WHERE pengguna = '$username' and sandi = '$password' and hak_akses = 'admin'";
            $result = $this->dbh->query($sql);
            if (mysqli_num_rows($result) > 0) {
               $response = array($username, $password);
               $response[$this->tabel] = array($username, $password);
               if ($rowAdmin = $result->fetch_assoc()) {
                  if ($rowAdmin['hak_akses'] == "admin"):
                     $_SESSION['admin'] = $rowAdmin['id_pengguna'];
                     $_SESSION['username'] = $rowAdmin['pengguna'];
                     $_SESSION['hak_akses'] = "admin";
                     if ($hasil == $_POST['hasil']) {
                        $_SESSION['status'] = true;
                        $this->dbh->query("UPDATE $this->tabel SET status = 'online' WHERE id_pengguna = '$_SESSION[admin]'");
                        header("Location:" . URL_BASE . "admin/errors/error-msg.php?HttpStatus=200");
                        exit(0);
                     } else {
                        $_SESSION['status'] = false;
                        $this->dbh->query("UPDATE $this->tabel SET status = 'offline' WHERE id_pengguna = '$_SESSION[admin]'");
                        unset($_POST['hasil']);
                        header("Location:" . URL_BASE . "index.php");
                        exit(0);
                     }
                  endif;
               }
               $_COOKIE['cookies'] = $username;
               $_SERVER['HTTP_ACCEPT'] = "on";
               $HttpStatus = $_SERVER["REDIRECT_STATUS"];
               if ($HttpStatus == 400) {
                  $err400 = URL_BASE . "admin/errors/error-msg.php?HttpStatus=400";
                  echo "<script>document.location.href = '$err400';</script>";
                  die;
               }
               if ($HttpStatus == 403) {
                  $err403 = URL_BASE . "admin/errors/error-msg.php?HttpStatus=403";
                  echo "<script>document.location.href = '$err403';</script>";
                  die;
               }
               if ($HttpStatus == 500) {
                  $err500 = URL_BASE . "admin/errors/error-msg.php?HttpStatus=500";
                  echo "<script>document.location.href = '$err500';</script>";
                  die;
               }
               setcookie($response[$this->tabel], $rowAdmin, time() + (86400 * 30), "/");
               array_push($response[$this->tabel], $rowAdmin);
               exit(0);
            } else {
               unset($_POST['hasil']);
               $_SESSION['status'] = false;
               $_SERVER['HTTP_ACCEPT'] = "off";
               $err401 = URL_BASE . "errors/error-msg.php?HttpStatus=401";
               echo "<script>document.location.href = '$err401';</script>";
               die;
            }
         } elseif ($akses == "dokter") {
            $sql = "SELECT * FROM tb_user JOIN tb_dokter ON tb_user.id_dokter = tb_dokter.id_dokter WHERE tb_user.pengguna = '$username' and tb_user.sandi = '$password' and 
            tb_user.hak_akses = 'dokter' and tb_dokter.stts = '1'";
            $result = $this->dbh->query($sql);
            if (mysqli_num_rows($result) > 0) {
               $response = array($username, $password);
               $response[$this->tabel] = array($username, $password);
               if ($rowDokter = $result->fetch_assoc()) {
                  if ($rowDokter['hak_akses'] == "dokter"):
                     $_SESSION['id_dokter'] = $rowDokter['id_pengguna'];
                     $_SESSION['username'] = $rowDokter['pengguna'];
                     $_SESSION['password'] = password_verify(md5($rowDokter['sandi'], false), PASSWORD_DEFAULT);
                     $_SESSION['dokter'] = $rowDokter['id_dokter'];
                     $_SESSION['hak_akses'] = "dokter";
                     if ($hasil == $_POST['hasil']) {
                        $_SESSION['status'] = true;
                        $this->dbh->query("UPDATE $this->tabel SET status = 'online' WHERE id_pengguna = '$_SESSION[id_dokter]'");
                        header("Location:" . URL_BASE . "dokter/errors/error-msg.php?HttpStatus=200");
                        exit(0);
                     } else {
                        $_SESSION['status'] = false;
                        $this->dbh->query("UPDATE $this->tabel SET status = 'offline' WHERE id_pengguna = '$_SESSION[id_dokter]'");
                        unset($_POST['hasil']);
                        header("Location:" . URL_BASE . "index.php");
                        exit(0);
                     }
                  endif;
               }
               $_COOKIE['cookies'] = $username;
               $_SERVER['HTTP_ACCEPT'] = "on";
               $HttpStatus = $_SERVER["REDIRECT_STATUS"];
               if ($HttpStatus == 400) {
                  $err400 = URL_BASE . "dokter/errors/error-msg.php?HttpStatus=400";
                  echo "<script>document.location.href = '$err400';</script>";
                  die;
               }
               if ($HttpStatus == 403) {
                  $err403 = URL_BASE . "dokter/errors/error-msg.php?HttpStatus=403";
                  echo "<script>document.location.href = '$err403';</script>";
                  die;
               }
               if ($HttpStatus == 500) {
                  $err500 = URL_BASE . "dokter/errors/error-msg.php?HttpStatus=500";
                  echo "<script>document.location.href = '$err500';</script>";
                  die;
               }
               setcookie($response[$this->tabel], $rowDokter, time() + (86400 * 30), "/");
               array_push($response[$this->tabel], $rowDokter);
               exit(0);
            } else {
               unset($_POST['hasil']);
               $_SESSION['status'] = false;
               $_SERVER['HTTP_ACCEPT'] = "off";
               $err401 = URL_BASE . "errors/error-msg.php?HttpStatus=401";
               echo "<script>document.location.href = '$err401';</script>";
               die;
            }
         } elseif ($akses == "kepala_klinik") {
            $sql = "SELECT * FROM $this->tabel WHERE pengguna = '$username' and sandi = '$password' and hak_akses = 'kepala_klinik'";
            $result = $this->dbh->query($sql);
            if (mysqli_num_rows($result) > 0) {
               $response = array($username, $password);
               $response[$this->tabel] = array($username, $password);
               if ($rowKepala = $result->fetch_assoc()) {
                  if ($rowKepala['hak_akses'] == "kepala_klinik"):
                     $_SESSION['kepala'] = $rowKepala['id_pengguna'];
                     $_SESSION['username'] = $rowKepala['pengguna'];
                     $_SESSION['hak_akses'] = "kepala_klinik";
                     if ($hasil == $_POST['hasil']) {
                        $_SESSION['status'] = true;
                        $this->dbh->query("UPDATE $this->tabel SET status = 'online' WHERE id_pengguna = '$_SESSION[kepala]'");
                        header("Location:" . URL_BASE . "kepalaklinik/errors/error-msg.php?HttpStatus=200");
                        exit(0);
                     } else {
                        $_SESSION['status'] = false;
                        $this->dbh->query("UPDATE $this->tabel SET status = 'offline' WHERE id_pengguna = '$_SESSION[kepala]'");
                        unset($_POST['hasil']);
                        header("Location:" . URL_BASE . "index.php");
                        exit(0);
                     }
                  endif;
               }
               $_COOKIE['cookies'] = $username;
               $_SERVER['HTTP_ACCEPT'] = "on";
               $HttpStatus = $_SERVER["REDIRECT_STATUS"];
               if ($HttpStatus == 400) {
                  $err400 = URL_BASE . "kepalaklinik/errors/error-msg.php?HttpStatus=400";
                  echo "<script>document.location.href = '$err400';</script>";
                  die;
               }
               if ($HttpStatus == 403) {
                  $err403 = URL_BASE . "kepalaklinik/errors/error-msg.php?HttpStatus=403";
                  echo "<script>document.location.href = '$err403';</script>";
                  die;
               }
               if ($HttpStatus == 500) {
                  $err500 = URL_BASE . "kepalaklinik/errors/error-msg.php?HttpStatus=500";
                  echo "<script>document.location.href = '$err500';</script>";
                  die;
               }
               setcookie($response[$this->tabel], $rowKepala, time() + (86400 * 30), "/");
               array_push($response[$this->tabel], $rowKepala);
               exit(0);
            } else {
               unset($_POST['hasil']);
               $_SESSION['status'] = false;
               $_SERVER['HTTP_ACCEPT'] = "off";
               $err401 = URL_BASE . "errors/error-msg.php?HttpStatus=401";
               echo "<script>document.location.href = '$err401';</script>";
               die;
            }
         }
      }
   }
}
