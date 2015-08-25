<?php

include_once '../db/koneksi.php';

class Kabupaten {

    private $kodeKabupaten;
    private $kodePropinsi;
    private $namaPropinsi;
    private $namaKabupaten;

    //method atau fungsi untuk merubah dan mengambil nilai
    public function getKodeKabupaten() {
        return $this->kodeKabupaten;
    }

    public function getKodePropinsi() {
        return $this->kodePropinsi;
    }

    public function getNamaPropinsi() {
        return $this->namaPropinsi;
    }

    public function getNamaKabupaten() {
        return $this->namaKabupaten;
    }

    public function setKodeKabupaten($kodeKabupaten) {
        $this->kodeKabupaten = $kodeKabupaten;
    }

    public function setKodePropinsi($kodePropinsi) {
        $this->kodePropinsi = $kodePropinsi;
    }

    public function setNamaPropinsi($namaPropinsi) {
        $this->namaPropinsi = $namaPropinsi;
    }

    public function setNamaKabupaten($namaKabupaten) {
        $this->namaKabupaten = $namaKabupaten;
    }

}

interface KabupatenDao {

    public function save($kodeKabupaten, $kodePropinsi, $namaKabupaten);

    public function update($kodeKabupaten, $kodePropinsi, $namaKabupaten);

    public function delete($kodeKabupaten);

    public function findOne($kodeKabupaten);
    
    public function findByName($nama);

    public function findByPropinsi($kodePropinsi);

    public function findAll();

    public function findAllLimit($start, $batch);
    
    public function jumlah();
}

//Kelas dao, kelas ini mengurusi logika bisnis pada database, seperti insert, update, delete
class KabupatenDaoImpl implements KabupatenDao {

    private $con;

    public function __construct() {
        $this->con = Koneksi::connect();
    }

    public function delete($kodeKabupaten) {
        $query = "DELETE FROM kabupaten WHERE kode_kabupaten = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param("s", $kodeKabupaten);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function findAll() {
        $hasil = array();
        $query = "SELECT kode_kabupaten, kode_propinsi_on_kabupaten, nama_propinsi, nama_kabupaten FROM kabupaten, propinsi WHERE kabupaten.kode_propinsi_on_kabupaten = propinsi.kode_propinsi ORDER BY nama_kabupaten ASC";
        $sql = $this->con->query($query);
        while ($res = $sql->fetch_array()) {
            $k = new Kabupaten();
            $k->setKodeKabupaten($res[0]);
            $k->setKodePropinsi($res[1]);
            $k->setNamaPropinsi($res[2]);
            $k->setNamaKabupaten($res[3]);
            $hasil[] = $k;
        }
        $sql->free();
        $this->con->close();
        return $hasil;
    }

    public function findByPropinsi($kodePropinsi) {
        $hasil = array();
        $query = "SELECT kode_kabupaten, kode_propinsi_on_kabupaten, nama_propinsi, nama_kabupaten FROM kabupaten, propinsi WHERE kabupaten.kode_propinsi_on_kabupaten = propinsi.kode_propinsi AND kode_propinsi_on_kabupaten = ? ORDER BY nama_kabupaten ASC ";
        $prep = $this->con->prepare($query);
        $prep->bind_param("s", $kodePropinsi);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d);
        while ($prep->fetch()) {
            $k = new Kabupaten();
            $k->setKodeKabupaten($a);
            $k->setKodePropinsi($b);
            $k->setNamaPropinsi($c);
            $k->setNamaKabupaten($d);
            $hasil[] = $k;
        }
        $prep->close();
        $this->con->close();
        return $hasil;
    }

    public function findOne($kodeKabupaten) {
        $k = new Kabupaten();
        $query = "SELECT kode_kabupaten, kode_propinsi_on_kabupaten, nama_propinsi, nama_kabupaten FROM kabupaten, propinsi WHERE kabupaten.kode_propinsi_on_kabupaten = propinsi.kode_propinsi AND kode_kabupaten = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param("s", $kodeKabupaten);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d);
        if ($prep->fetch()) {
            $k->setKodeKabupaten($a);
            $k->setKodePropinsi($b);
            $k->setNamaPropinsi($c);
            $k->setNamaKabupaten($d);
        }
        $prep->close();
        $this->con->close();
        return $k;
    }

    public function save($kodeKabupaten, $kodePropinsi, $namaKabupaten) {
        $query = "INSERT INTO kabupaten(kode_kabupaten, kode_propinsi_on_kabupaten,nama_kabupaten)VALUES(?,?,?)";
        $prep = $this->con->prepare($query);
        $prep->bind_param("sss", $kodeKabupaten, $kodePropinsi, $namaKabupaten);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function update($kodeKabupaten, $kodePropinsi, $namaKabupaten) {
        $query = "UPDATE kabupaten SET kode_propinsi_on_kabupaten = ?,nama_kabupaten = ? WHERE kode_kabupaten = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param("sss", $kodePropinsi, $namaKabupaten, $kodeKabupaten);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function findAllLimit($start, $batch) {
        $hasil = array();
        $query = "SELECT kode_kabupaten, kode_propinsi_on_kabupaten, nama_propinsi, nama_kabupaten FROM kabupaten, propinsi WHERE kabupaten.kode_propinsi_on_kabupaten = propinsi.kode_propinsi ORDER BY nama_kabupaten ASC LIMIT ?,?";
        $prep = $this->con->prepare($query);
        $prep->bind_param("ii", $start, $batch);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d);
        while ($prep->fetch()) {
            $k = new Kabupaten();
            $k->setKodeKabupaten($a);
            $k->setKodePropinsi($b);
            $k->setNamaPropinsi($c);
            $k->setNamaKabupaten($d);
            $hasil[] = $k;
        }
        $prep->close();
        $this->con->close();
        return $hasil;
    }

    public function jumlah() {
        $jml = 0;
        $query = "SELECT COUNT(kode_kabupaten) AS JUMLAH FROM kabupaten";
        $sql = $this->con->query($query);
        while ($res = $sql->fetch_array()){
            $jml = $res[0];
        }
        $sql->free();
        $this->con->close();
        return $jml;
    }

    public function findByName($nama) {
        $hasil = array();
        $query = "SELECT kode_kabupaten, kode_propinsi_on_kabupaten, nama_propinsi, nama_kabupaten FROM kabupaten, propinsi WHERE kabupaten.kode_propinsi_on_kabupaten = propinsi.kode_propinsi AND nama_kabupaten LIKE ? ORDER BY nama_kabupaten ASC ";
        $prep = $this->con->prepare($query);
        $prep->bind_param("s", $nama);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d);
        while ($prep->fetch()) {
            $k = new Kabupaten();
            $k->setKodeKabupaten($a);
            $k->setKodePropinsi($b);
            $k->setNamaPropinsi($c);
            $k->setNamaKabupaten($d);
            $hasil[] = $k;
        }
        $prep->close();
        $this->con->close();
        return $hasil;
    }

}
