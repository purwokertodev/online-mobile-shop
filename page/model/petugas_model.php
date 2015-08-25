<?php

include_once '../db/koneksi.php';

class Petugas {

    private $kodePetugas;
    private $namaPetugas;
    private $jenisKelamin;
    private $username;
    private $password;
    private $noTelpon;
    private $alamat;

    public function getKodePetugas() {
        return $this->kodePetugas;
    }

    public function getNamaPetugas() {
        return $this->namaPetugas;
    }

    public function getJenisKelamin() {
        return $this->jenisKelamin;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getNoTelpon() {
        return $this->noTelpon;
    }

    public function getAlamat() {
        return $this->alamat;
    }

    public function setKodePetugas($kodePetugas) {
        $this->kodePetugas = $kodePetugas;
    }

    public function setNamaPetugas($namaPetugas) {
        $this->namaPetugas = $namaPetugas;
    }

    public function setJenisKelamin($jenisKelamin) {
        $this->jenisKelamin = $jenisKelamin;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setNoTelpon($noTelpon) {
        $this->noTelpon = $noTelpon;
    }

    public function setAlamat($alamat) {
        $this->alamat = $alamat;
    }

}

class LogPetugas {

    private $id;
    private $kodePetugas;
    private $status;
    private $waktu;

    public function getId() {
        return $this->id;
    }

    public function getKodePetugas() {
        return $this->kodePetugas;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getWaktu() {
        return $this->waktu;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setKodePetugas($kodePetugas) {
        $this->kodePetugas = $kodePetugas;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setWaktu($waktu) {
        $this->waktu = $waktu;
    }

}

interface PetugasDao {

    public function save($kodePetugas, $namaPetugas, $jenisKelamin, $username, $password, $noTelpon, $alamat);

    public function update($kodePetugas,$username, $password);

    public function delete($kodePetugas);

    public function login($username, $password);

    public function findOne($kodePetugas);

    public function findAll();
}

interface LogPetugasDao {

    public function save($id, $kodePetugas, $status);

    public function findByPetugas($kodePetugas);

    public function findAll();
}

class PetugasDaoImpl implements PetugasDao {

    private $con;

    public function __construct() {
        $this->con = Koneksi::connect();
    }

    public function delete($kodePetugas) {
        $query = "DELETE FROM petugas WHERE kode_petugas = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('s', $kodePetugas);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function findAll() {
        $hasil = array();
        $query = "SELECT kode_petugas, nama_petugas, jenis_kelamin, username, password, no_telpon, alamat FROM petugas";
        $sql = $this->con->query($query);
        while ($res = $sql->fetch_array()) {
            $p = new Petugas();
            $p->setKodePetugas($res[0]);
            $p->setNamaPetugas($res[1]);
            $p->setJenisKelamin($res[2]);
            $p->setUsername($res[3]);
            $p->setPassword($res[4]);
            $p->setNoTelpon($res[5]);
            $p->setAlamat($res[6]);
            $hasil[] = $p;
        }
        $sql->free();
        $this->con->close();
        return $hasil;
    }

    public function findOne($kodePetugas) {
        $p = new Petugas();
        $query = "SELECT kode_petugas, nama_petugas, jenis_kelamin, username, password, no_telpon, alamat FROM petugas WHERE kode_petugas = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('s', $kodePetugas);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d, $e, $f, $g);
        if ($prep->fetch()) {
            $p->setKodePetugas($a);
            $p->setNamaPetugas($b);
            $p->setJenisKelamin($c);
            $p->setUsername($d);
            $p->setPassword($e);
            $p->setNoTelpon($f);
            $p->setAlamat($g);
        }
        $prep->close();
        $this->con->close();
        return $p;
    }

    public function login($username, $password) {
        $p = new Petugas();
        $query = "SELECT kode_petugas, nama_petugas, jenis_kelamin, username, password, no_telpon, alamat FROM petugas WHERE username = ? AND password = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('ss', $username, $password);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d, $e, $f, $g);
        if ($prep->fetch()) {
            $p->setKodePetugas($a);
            $p->setNamaPetugas($b);
            $p->setJenisKelamin($c);
            $p->setUsername($d);
            $p->setPassword($e);
            $p->setNoTelpon($f);
            $p->setAlamat($g);
        }
        $prep->close();
        $this->con->close();
        return $p;
    }

    public function save($kodePetugas, $namaPetugas, $jenisKelamin, $username, $password, $noTelpon, $alamat) {
        $query = "INSERT INTO petugas(kode_petugas, nama_petugas, jenis_kelamin, username, password, no_telpon, alamat)VALUES(?,?,?,?,?,?,?)";
        $prep = $this->con->prepare($query);
        $prep->bind_param('sssssss', $kodePetugas, $namaPetugas, $jenisKelamin, $username, $password, $noTelpon, $alamat);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function update($kodePetugas,$username, $password) {
        $query = "UPDATE petugas SET username = ?, password = ? WHERE kode_petugas = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('sss', $username, $password,$kodePetugas);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

}

class LogPetugasDaoImpl implements LogPetugasDao {

    private $con;

    public function __construct() {
        $this->con = Koneksi::connect();
    }

    public function findAll() {
        $hasil = array();
        $query = "SELECT id, kode_petugas, status, waktu FROM log_petugas";
        $sql = $this->con->query($query);
        while ($res = $sql->fetch_array()) {
            $l = new LogPetugas();
            $l->setId($res[0]);
            $l->setKodePetugas($res[1]);
            $l->setStatus($res[2]);
            $l->setWaktu($res[3]);
            $hasil[] = $l;
        }
        $sql->free();
        $this->con->close();
        return $hasil;
    }

    public function findByPetugas($kodePetugas) {
        $hasil = array();
        $query = "SELECT id, kode_petugas, status, waktu FROM log_petugas WHERE kode_petugas = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('s', $kodePetugas);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d);
        while ($prep->fetch()) {
            $l = new LogPetugas();
            $l->setId($a);
            $l->setKodePetugas($b);
            $l->setStatus($c);
            $l->setWaktu($d);
            $hasil[] = $l;
        }
        $prep->close();
        $this->con->close();
        return $hasil;
    }

    public function save($id, $kodePetugas, $status) {
        $query = "INSERT INTO log_petugas(id, kode_petugas, status, waktu)VALUES(?,?,?,now())";
        $prep = $this->con->prepare($query);
        $prep->bind_param('sss', $id, $kodePetugas, $status);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

}
