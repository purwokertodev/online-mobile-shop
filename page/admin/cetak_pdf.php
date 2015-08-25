<?php

include_once '../../plugin/fpdf17/fpdf.php';

class PDF_MASTER extends FPDF {

    function cetakBarang($header, $data) {
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('Arial', '', 10);

        $w = array(30, 25, 45, 15, 35, 35);

        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();

        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        $fill = 0;

        for ($i = 0; $i < count($data); $i++) {
            $p = $data[$i];
            $this->Cell($w[0], 6, $p->getKodeProduk(), 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $p->getNamaPabrikan(), 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $p->getNamaProduk(), 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $p->getStok(), 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, number_format($p->getHargaPokok(), 2, ',', '.'), 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 6, number_format($p->getHargaJual(), 2, ',', '.'), 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill != $fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    function cetakTransaksi($header, $data) {
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('Arial', '', 10);

        $w = array(35, 35, 35, 35, 35);

        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();

        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        $fill = 0;

        for ($i = 0; $i < count($data); $i++) {
            $p = $data[$i];
            $this->Cell($w[0], 6, $p->getKodeTransaksi(), 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $p->getNamaPembeli(), 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $p->getWaktuTransaksi(), 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, number_format($p->getDiskon(), 2, ',', '.'), 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, number_format($p->getTotalAkhir(), 2, ',', '.'), 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill != $fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }

}
