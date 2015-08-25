<?php

include_once '../model/transaksi_model.php';

$tdao = new TransaksiDetailDaoImpl();
$data = $tdao->findByTransaksi("1436497751");
for($i=0;$i<count($data);$i++){
    $t = $data[$i];
    $namaProduk = $t->getNamaProduk();
    echo $namaProduk;
}