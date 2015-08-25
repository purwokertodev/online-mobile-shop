<?php

include_once '../model/kabupaten_model.php';

$kabDao = new KabupatenDaoImpl();
$serverResponse = array();
$listKab = $kabDao->findAll();
$serverResponse["data_kabupaten"] = array();
if(is_array($listKab)){
$serverResponse["sukses"] = 1;
	for($i=0;$i<count($listKab);$i++){
		$k = $listKab[$i];
		array_push($serverResponse["data_kabupaten"], array('kode_kab'=>$k->getKodeKabupaten(), 'kode_prop'=>$k->getKodePropinsi(), 'nama_kabupaten'=>$k->getNamaKabupaten(), 'kode_pos'=>$k->getKodePos(), 'biaya'=>$k->getBiayaPengiriman()));
		
	}
	echo json_encode($serverResponse);
}