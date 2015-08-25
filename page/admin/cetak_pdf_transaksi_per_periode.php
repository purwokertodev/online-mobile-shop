<?php

include_once 'cetak_pdf.php';
include_once '../model/transaksi_model.php';


if (isset($_POST['cetak'])) {
    $tanggalAwal = filter_input(INPUT_POST, 'tanggal_awal');
    $tanggalAkhir = filter_input(INPUT_POST, 'tanggal_akhir');
    $pdf = new PDF_MASTER();
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 14);
    $pdf->Write(5, 'BUMIAYU CELL');
    $pdf->Ln();
    $pdf->Ln(5);

    $pdf->SetFontSize(10);
    $tanggal = date('d M Y');
    $pdf->Write(5, 'Laporan Transaksi Peroide : ' . $tanggalAwal . ' Sampai ' . $tanggalAkhir);
    $pdf->Ln();
    $pdf->Write(5, 'Bumiayu cell, jalan raya bumiayu no 5');
    $pdf->Ln();
    $pdf->Ln(5);

    $header = array("KODE TRANSAKSI", "NAMA MEMBER", "WAKTU TRANSAKSI", "DISKON Rp.", "TOTAL AKHIR Rp.");
    $pdf->SetFont('Arial', '', 10);
    $tdao = new TransaksiDaoImpl();
    $tdaoJum = new TransaksiDaoImpl();
    $tdaoDiskon = new TransaksiDaoImpl();

    $jumlah = $tdaoJum->jumlahPendapatanPerPeriode($tanggalAwal, $tanggalAkhir);
    $jumlahFormat = number_format($jumlah, 2, ',', '.'); //....

    $diskon = $tdaoDiskon->jumlahDiskonPerPeriode($tanggalAwal, $tanggalAkhir);
    $diskonFormat = number_format($diskon, 2, ',', '.'); //....

    $data = $tdao->findByTanggal($tanggalAwal, $tanggalAkhir);
    $pdf->cetakTransaksi($header, $data);
    $pdf->Ln();
    $pdf->Write(5, "Total Pendapatan : Rp." . $jumlahFormat); //...
    $pdf->Ln();
    $pdf->Write(5, "Total Diskon : Rp." . $diskonFormat); //...
    $pdf->Output();
}