<?php

include_once '../db/koneksi.php';

class Propinsi {

    private $kodePropinsi;
    private $namaPropinsi;

    public function getKodePropinsi() {
        return $this->kodePropinsi;
    }

    public function getNamaPropinsi() {
        return $this->namaPropinsi;
    }

    public function setKodePropinsi($kodePropinsi) {
        $this->kodePropinsi = $kodePropinsi;
    }

    public function setNamaPropinsi($namaPropinsi) {
        $this->namaPropinsi = $namaPropinsi;
    }

}

interface PropinsiDao {

    public function save($kodePropinsi, $namaPropinsi);

    public function update($kodePropinsi, $namaPropinsi);

    public function delete($kodePropinsi);

    public function findOne($kodePropinsi);
    
    public function findAllLimit($start, $batch);

    public function jumlah();

    public function findByName($nama);

    public function findAll();
}


class PropinsiDaoImpl implements PropinsiDao{
    
    private $con;
    
    public function __construct() {
        $this->con = Koneksi::connect();
    }
    
    public function delete($kodePropinsi) {
        $query = "DELETE FROM propinsi WHERE kode_propinsi = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param("s", $kodePropinsi);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function findAll() {
        $hasil = array();
        $query = "SELECT kode_propinsi, nama_propinsi FROM propinsi";
        $sql = $this->con->query($query);
        while ($res = $sql->fetch_array()){
            $p = new Propinsi();
            $p->setKodePropinsi($res[0]);
            $p->setNamaPropinsi($res[1]);
            $hasil[] = $p;
        }
        $sql->free();
        $this->con->close();
        return $hasil;
    }

    public function findOne($kodePropinsi) {
        $p = new Propinsi();
        $query = "SELECT kode_propinsi, nama_propinsi FROM propinsi WHERE kode_propinsi = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param("s", $kodePropinsi);
        $prep->execute();
        $prep->bind_result($a, $b);
        if($prep->fetch()){
            $p->setKodePropinsi($a);
            $p->setNamaPropinsi($b);
        }
        $prep->close();
        $this->con->close();
        return $p;
    }

    public function save($kodePropinsi, $namaPropinsi) {
        $query = "INSERT INTO propinsi (kode_propinsi, nama_propinsi)VALUES(?,?)";
        $prep = $this->con->prepare($query);
        $prep->bind_param("ss", $kodePropinsi, $namaPropinsi);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function update($kodePropinsi, $namaPropinsi) {
        $query = "UPDATE propinsi SET nama_propinsi = ? WHERE kode_propinsi = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param("ss", $namaPropinsi, $kodePropinsi);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function findByName($nama) {
        $hasil = array();
        $query = "SELECT kode_propinsi, nama_propinsi FROM propinsi WHERE nama_propinsi LIKE ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param("s", $nama);
        $prep->execute();
        $prep->bind_result($a, $b);
        while ($prep->fetch()){
            $p = new Propinsi();
            $p->setKodePropinsi($a);
            $p->setNamaPropinsi($b);
            $hasil[] = $p;
        }
        $prep->close();
        $this->con->close();
        return $hasil;
    }

    public function findAllLimit($start, $batch) {
        $hasil = array();
        $query = "SELECT kode_propinsi, nama_propinsi FROM propinsi LIMIT ?,?";
        $prep = $this->con->prepare($query);
        $prep->bind_param("ii", $start, $batch);
        $prep->execute();
        $prep->bind_result($a, $b);
        while ($prep->fetch()){
            $p = new Propinsi();
            $p->setKodePropinsi($a);
            $p->setNamaPropinsi($b);
            $hasil[] = $p;
        }
        $prep->close();
        $this->con->close();
        return $hasil;
    }

    public function jumlah() {
        $jumlah = 0;
        $query = "SELECT COUNT(kode_propinsi) AS JUMLAH FROM propinsi";
        $sql = $this->con->query($query);
        while($res = $sql->fetch_array()){
            $jumlah = $res[0];
        }
        $sql->free();
        $this->con->close();
        return $jumlah;
    }

}