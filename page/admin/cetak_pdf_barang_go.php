<?php

include_once 'cetak_pdf.php';
include_once '../model/produk_model.php';

$pdf = new PDF_MASTER();
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 14);
$pdf->Write(5, 'BUMIAYU CELL');
$pdf->Ln();
$pdf->Ln(5);

$pdf->SetFontSize(10);
$tanggal = date('d M Y');
$pdf->Write(5, 'Laporan Data Produk tanggal : '.$tanggal);
$pdf->Ln();
$pdf->Write(5, 'Bumiayu cell, jalan raya bumiayu no 5');
$pdf->Ln();
$pdf->Ln(5);

$header = array("KODE PRODUK", "PABRIKAN", "NAMA PRODUK", "STOK", "HARGA POKOK Rp.", "HARGA JUAL Rp.");
$pdf->SetFont('Arial', '', 10);
$pdao = new ProdukDaoImpl();
$data = $pdao->findAll();
$pdf->cetakBarang($header, $data);
$pdf->Output();

