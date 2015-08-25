<?php

include_once '../db/koneksi.php';

class Kecamatan {

    private $kodeKecamatan;
    private $kodeProvinsi;
    private $namaProvinsi;
    private $kodeKabupaten;
    private $namaKabupaten;
    private $namaKecamatan;
    private $biayaPengiriman;

    public function getKodeKecamatan() {
        return $this->kodeKecamatan;
    }

    public function getKodeProvinsi() {
        return $this->kodeProvinsi;
    }

    public function getNamaProvinsi() {
        return $this->namaProvinsi;
    }

    public function getKodeKabupaten() {
        return $this->kodeKabupaten;
    }

    public function getNamaKabupaten() {
        return $this->namaKabupaten;
    }

    public function getNamaKecamatan() {
        return $this->namaKecamatan;
    }

    public function getBiayaPengiriman() {
        return $this->biayaPengiriman;
    }

    public function setKodeKecamatan($kodeKecamatan) {
        $this->kodeKecamatan = $kodeKecamatan;
    }

    public function setKodeProvinsi($kodeProvinsi) {
        $this->kodeProvinsi = $kodeProvinsi;
    }

    public function setNamaProvinsi($namaProvinsi) {
        $this->namaProvinsi = $namaProvinsi;
    }

    public function setKodeKabupaten($kodeKabupaten) {
        $this->kodeKabupaten = $kodeKabupaten;
    }

    public function setNamaKabupaten($namaKabupaten) {
        $this->namaKabupaten = $namaKabupaten;
    }

    public function setNamaKecamatan($namaKecamatan) {
        $this->namaKecamatan = $namaKecamatan;
    }

    public function setBiayaPengiriman($biayaPengiriman) {
        $this->biayaPengiriman = $biayaPengiriman;
    }

}

interface KecamatanDao {

    public function save($kodeKecamatan, $kodeKabupaten, $namaKecamatan, $biayaPengiriman);

    public function update($kodeKecamatan, $kodeKabupaten, $namaKecamatan, $biayaPengiriman);

    public function delete($kodeKecamatan);

    public function findOne($kodeKecamatan);
    
    public function findByName($nama);

    public function findAll();

    public function findAllLimit($start, $batch);

    public function jumlah();
}

class KecamatanDaoImpl implements KecamatanDao{
    
    private $con;
    
    public function __construct() {
        $this->con = Koneksi::connect();
    }
    
    public function delete($kodeKecamatan) {
        $query = "DELETE FROM kecamatan WHERE kode_kecamatan = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param("s", $kodeKecamatan);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function findAll() {
        $hasil = array();
        $query = "SELECT kode_kecamatan, kode_propinsi, nama_propinsi, kode_kabupaten, nama_kabupaten, nama_kecamatan, biaya_pengiriman "
                . "FROM propinsi, kabupaten, kecamatan WHERE kecamatan.kode_kabupaten_on_kecamatan = kabupaten.kode_kabupaten AND kabupaten.kode_propinsi_on_kabupaten = propinsi.kode_propinsi ORDER BY nama_kecamatan ASC";
        $sql = $this->con->query($query);
        while($res = $sql->fetch_array()){
            $k = new Kecamatan();
            $k->setKodeKecamatan($res[0]);
            $k->setKodeProvinsi($res[1]);
            $k->setNamaProvinsi($res[2]);
            $k->setKodeKabupaten($res[3]);
            $k->setNamaKabupaten($res[4]);
            $k->setNamaKecamatan($res[5]);
            $k->setBiayaPengiriman($res[6]);
            $hasil[] = $k;
        }
        $sql->free();
        $this->con->close();
        return $hasil;
    }

    public function findAllLimit($start, $batch) {
        $hasil = array();
        $query = "SELECT kode_kecamatan, kode_propinsi, nama_propinsi, kode_kabupaten, nama_kabupaten, nama_kecamatan, biaya_pengiriman "
                . "FROM propinsi, kabupaten, kecamatan WHERE kecamatan.kode_kabupaten_on_kecamatan = kabupaten.kode_kabupaten AND kabupaten.kode_propinsi_on_kabupaten = propinsi.kode_propinsi ORDER BY nama_kecamatan ASC LIMIT ?,?";
        $prep = $this->con->prepare($query);
        $prep->bind_param("ii", $start, $batch);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d, $e, $f, $g);
        while ($prep->fetch()){
            $k = new Kecamatan();
            $k->setKodeKecamatan($a);
            $k->setKodeProvinsi($b);
            $k->setNamaProvinsi($c);
            $k->setKodeKabupaten($d);
            $k->setNamaKabupaten($e);
            $k->setNamaKecamatan($f);
            $k->setBiayaPengiriman($g);
            $hasil[] = $k;
        }
        return $hasil;
    }

    public function findOne($kodeKecamatan) {
        $k = new Kecamatan();
        $query = "SELECT kode_kecamatan, kode_propinsi, nama_propinsi, kode_kabupaten, nama_kabupaten, nama_kecamatan, biaya_pengiriman "
                . "FROM propinsi, kabupaten, kecamatan WHERE kecamatan.kode_kabupaten_on_kecamatan = kabupaten.kode_kabupaten AND kabupaten.kode_propinsi_on_kabupaten = propinsi.kode_propinsi AND kode_kecamatan = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param("s", $kodeKecamatan);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d, $e, $f, $g);
        if ($prep->fetch()){
            $k->setKodeKecamatan($a);
            $k->setKodeProvinsi($b);
            $k->setNamaProvinsi($c);
            $k->setKodeKabupaten($d);
            $k->setNamaKabupaten($e);
            $k->setNamaKecamatan($f);
            $k->setBiayaPengiriman($g);
        }
        return $k;
    }

    public function jumlah() {
        $jumlah = 0;
        $query = "SELECT COUNT(kode_kecamatan) AS jumlah FROM kecamatan";
        $sql = $this->con->query($query);
        while($res = $sql->fetch_assoc()){
            $jumlah = $res['jumlah'];
        }
        $sql->free();
        $this->con->close();
        return $jumlah;
    }

    public function save($kodeKecamatan, $kodeKabupaten, $namaKecamatan, $biayaPengiriman) {
        $query = "INSERT INTO kecamatan(kode_kecamatan, kode_kabupaten_on_kecamatan, nama_kecamatan, biaya_pengiriman)VALUES(?,?,?,?)";
        $prep = $this->con->prepare($query);
        $prep->bind_param("sssd", $kodeKecamatan, $kodeKabupaten, $namaKecamatan, $biayaPengiriman);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function update($kodeKecamatan, $kodeKabupaten, $namaKecamatan, $biayaPengiriman) {
        $query = "UPDATE kecamatan SET kode_kabupaten_on_kecamatan = ?, nama_kecamatan = ?, biaya_pengiriman = ? WHERE kode_kecamatan = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param("ssds", $kodeKabupaten, $namaKecamatan, $biayaPengiriman, $kodeKecamatan);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function findByName($nama) {
        $hasil = array();
        $query = "SELECT kode_kecamatan, kode_propinsi, nama_propinsi, kode_kabupaten, nama_kabupaten, nama_kecamatan, biaya_pengiriman "
                . "FROM propinsi, kabupaten, kecamatan WHERE kecamatan.kode_kabupaten_on_kecamatan = kabupaten.kode_kabupaten AND kabupaten.kode_propinsi_on_kabupaten = propinsi.kode_propinsi AND nama_kecamatan LIKE ? ORDER BY nama_kecamatan ASC";
        $prep = $this->con->prepare($query);
        $prep->bind_param("s", $nama);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d, $e, $f, $g);
        while ($prep->fetch()){
            $k = new Kecamatan();
            $k->setKodeKecamatan($a);
            $k->setKodeProvinsi($b);
            $k->setNamaProvinsi($c);
            $k->setKodeKabupaten($d);
            $k->setNamaKabupaten($e);
            $k->setNamaKecamatan($f);
            $k->setBiayaPengiriman($g);
            $hasil[] = $k;
        }
        return $hasil;
    }

}