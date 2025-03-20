<?php

namespace controllers;

use model\RekamMedis_model;

class RekamMedis
{
   protected $konfig;
   public function __construct()
   {
      $this->konfig = new RekamMedis_model();
   }

   public function input_rekammedis()
   {
      if (isset($_POST['simpan'])):
         $id_pasien = htmlspecialchars($_POST['id_pasien']);
         $id_dokter = htmlspecialchars($_POST['id_dokter']);
         $tgl_periksa = date("H:i:s d-m-Y");
         $umur = htmlspecialchars($_POST['umur']);
         $terapi = htmlspecialchars($_POST['terapi']);
         $diagnosa = htmlspecialchars($_POST['diagnosa']);
         $res = $this->konfig->tambah_rekammedis($id_pasien, $id_dokter, $tgl_periksa, $umur, $terapi, $diagnosa);
         if ($res === true):
            return true;
         else:
            return false;
         endif;
      endif;
   }

   public function ubah_rekammedis()
   {
      if (isset($_POST['simpan'])):
         $id = htmlspecialchars($_POST['id']);
         $umur = htmlspecialchars($_POST['umur']);
         $terapi = htmlspecialchars($_POST['terapi']);
         $diagnosa = htmlspecialchars($_POST['diagnosa']);
         $res = $this->konfig->edit_rekammedis($umur, $terapi, $diagnosa, $id);
         if ($res === true):
            return true;
         else:
            return false;
         endif;
      endif;
   }
}
