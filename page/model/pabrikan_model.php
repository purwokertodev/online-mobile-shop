<?php

include_once '../db/koneksi.php';

class Pabrikan {

    private $kodePabrikan;
    private $namaPabrikan;
    private $keterangan;

    public function getKodePabrikan() {
        return $this->kodePabrikan;
    }

    public function getNamaPabrikan() {
        return $this->namaPabrikan;
    }

    public function getKeterangan() {
        return $this->keterangan;
    }

    public function setKodePabrikan($kodePabrikan) {
        $this->kodePabrikan = $kodePabrikan;
    }

    public function setNamaPabrikan($namaPabrikan) {
        $this->namaPabrikan = $namaPabrikan;
    }

    public function setKeterangan($keterangan) {
        $this->keterangan = $keterangan;
    }

}

interface PabrikanDao {

    public function save($kodePabrikan, $namaPabrikan, $keterangan);

    public function update($kodePabrikan, $namaPabrikan, $keterangan);

    public function delete($kodePabrikan);

    public function findOne($kodePabrikan);

    public function findAll();
}

class PabrikanDaoImpl implements PabrikanDao {
    
    private $con;
    
    public function __construct() {
        $this->con = Koneksi::connect();
    }

    public function delete($kodePabrikan) {
        $query = "DELETE FROM pabrikan_ponsel WHERE kode_pabrikan = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('s', $kodePabrikan);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function findAll() {
        $hasil = array();
        $query = "SELECT kode_pabrikan, nama_pabrikan, keterangan FROM pabrikan_ponsel ORDER BY nama_pabrikan ASC";
        $sql = $this->con->query($query);
        while($res = $sql->fetch_array()){
            $p = new Pabrikan();
            $p->setKodePabrikan($res[0]);
            $p->setNamaPabrikan($res[1]);
            $p->setKeterangan($res[2]);
            $hasil[] = $p;
        }
        $sql->free();
        $this->con->close();
        return $hasil;
    }

    public function findOne($kodePabrikan) {
        $p = new Pabrikan();
        $query = "SELECT kode_pabrikan, nama_pabrikan, keterangan FROM pabrikan_ponsel WHERE kode_pabrikan = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('s', $kodePabrikan);
        $prep->execute();
        $prep->bind_result($kodePabrikanRes, $namaPabrikanRes, $keteranganRes);
        if($prep->fetch()){
            $p->setKodePabrikan($kodePabrikanRes);
            $p->setNamaPabrikan($namaPabrikanRes);
            $p->setKeterangan($keteranganRes);
        }
        $prep->close();
        $this->con->close();
        return $p;
    }

    public function save($kodePabrikan, $namaPabrikan, $keterangan) {
        $query = "INSERT INTO pabrikan_ponsel(kode_pabrikan, nama_pabrikan, keterangan)VALUES(?,?,?)";
        $prep = $this->con->prepare($query);
        $prep->bind_param('sss', $kodePabrikan, $namaPabrikan, $keterangan);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function update($kodePabrikan, $namaPabrikan, $keterangan) {
        $query = "UPDATE pabrikan_ponsel SET nama_pabrikan = ?, keterangan = ? WHERE kode_pabrikan = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('sss', $namaPabrikan, $keterangan, $kodePabrikan);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

}
