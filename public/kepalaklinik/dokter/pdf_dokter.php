<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php if ($_SESSION['hak_akses'] == "kepala_klinik") { ?>
      <title><?php echo "Laporan Dokter"; ?></title>
      <?php require_once("../ui/header.php"); ?>
      <?php } else { ?>
      <?php header("Location:" . URL_BASE . "admin/ui/header.php?page=beranda"); ?>
      <?php exit(0); ?>
      <?php } ?>
   </head>

   <body>
      <?php
   require_once("../../../dist/library/pdf/fpdf.php");
   // Membuat instance dari FPDF
   $pdf = new FPDF("L", "cm", "A4");
   $pdf->SetMargins(2, 1, 1);
   $pdf->AliasNbPages();
   $pdf->AddPage();

   // Menambahkan logo dan informasi rumah sakit
   $pdf->SetFont('Times', 'B', 11);
   $pdf->Image('../../../assets/icon/logo_icon.png', 1.5, 0.7, 2, 2);
   $pdf->SetX(4);
   $pdf->MultiCell(19.5, 0.5, 'Rumah Sakit (Rekam Medis)', 0, 'L');
   $pdf->SetX(4);
   $pdf->MultiCell(19.5, 0.5, 'Telp : +62 021-123456789', 0, 'L');
   $pdf->SetFont('Arial', 'B', 10);
   $pdf->SetX(4);
   $pdf->MultiCell(19.5, 0.5, 'Website : www.rs_rekam_medis.com', 0, 'L');
   $pdf->SetX(4);
   $pdf->MultiCell(26.5, 0.5, 'Email : info@rs_rekam_medis.com', 0, 'L');

   // Menambahkan garis pemisah
   $pdf->Line(1, 3.1, 28.5, 3.1);
   $pdf->SetLineWidth(0.1);
   $pdf->Line(1, 3.2, 28.5, 3.2);
   $pdf->SetLineWidth(0);
   $pdf->ln(1);

   // Judul laporan
   $pdf->SetFont('Arial', 'B', 14);
   $pdf->Cell(25.5, 0.7, "Laporan Dokter", 0, 10, 'C');
   $pdf->ln(1);

   // Tanggal Cetak
   $pdf->SetFont('Arial', 'B', 10);
   $pdf->Cell(5, 0.7, "Di cetak pada : " . date("D-d/m/Y"), 0, 0, 'C');
   $pdf->ln(1);

   // Header Tabel
   $pdf->SetFont('Arial', 'B', 10);
   $pdf->Cell(1.5, 0.8, 'Nomor', 1, 0, 'C');
   $pdf->Cell(3, 0.8, 'Id Dokter', 1, 0, 'C');
   $pdf->Cell(5, 0.8, 'Nama Dokter', 1, 0, 'C');
   $pdf->Cell(3, 0.8, 'Jenis Kelamin', 1, 0, 'C');
   $pdf->Cell(3, 0.8, 'Umur', 1, 0, 'C');
   $pdf->Cell(5, 0.8, 'Alamat', 1, 0, 'C');
   $pdf->Cell(3.5, 0.8, 'Username', 1, 0, 'C');
   $pdf->Ln(1);

   // Menampilkan data ke dalam tabel
   $no = 1;
   $res = $dokter->getByDocter(); // Pastikan $jaringan sudah didefinisikan
   foreach ($res as $j) {
      $pdf->Cell(1.5, 0.8, $no, 1, 0, 'C');
      $pdf->Cell(3, 0.8, $j['id_dokter'], 1, 0, 'C');
      $pdf->Cell(5, 0.8, $j['nama_dokter'], 1, 0, 'C');
      $pdf->Cell(3, 0.8, $j['jk_dokter'], 1, 0, 'C');
      $pdf->Cell(3, 0.8, $j['umur'] . " tahun", 1, 0, 'C');
      $pdf->Cell(5, 0.8, $j['alamat_dokter'], 1, 0, 'C');
      $pdf->Cell(3.5, 0.8, $j['pengguna'], 1, 0, 'C');
      $pdf->ln(1);
      $no++;
   }
   // Menghasilkan PDF
   $pdf->Output('../../../assets/pdf/laporan_dokter.pdf', 'F'); // Simpan PDF ke file
   header("Location:" . URL_BASE . "kepalaklinik/ui/header.php?page=laporan-dokter");
   ?>