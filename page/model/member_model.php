<?php

include_once '../db/koneksi.php';

class Member {

    private $kodeMember;
    private $namaMember;
    private $namaTujuanPengiriman;
    private $jenisKelamin;
    private $username;
    private $password;
    private $noTelpon;
    private $alamat;
    private $alamatPengiriman;
    private $kecamatan;
    private $kecamatanPengiriman;
    private $tanggalBergabung;

    public function getKodeMember() {
        return $this->kodeMember;
    }

    public function getNamaMember() {
        return $this->namaMember;
    }
    
    public function getNamaTujuanPengiriman() {
        return $this->namaTujuanPengiriman;
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

    public function getAlamatPengiriman() {
        return $this->alamatPengiriman;
    }

    public function getKecamatan() {
        return $this->kecamatan;
    }

    public function getKecamatanPengiriman() {
        return $this->kecamatanPengiriman;
    }

    public function getTanggalBergabung() {
        return $this->tanggalBergabung;
    }

    public function setKodeMember($kodeMember) {
        $this->kodeMember = $kodeMember;
    }

    public function setNamaMember($namaMember) {
        $this->namaMember = $namaMember;
    }
    
    public function setNamaTujuanPengiriman($namaTujuanPengiriman) {
        $this->namaTujuanPengiriman = $namaTujuanPengiriman;
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

    public function setAlamatPengiriman($alamatPengiriman) {
        $this->alamatPengiriman = $alamatPengiriman;
    }

    public function setKecamatan($kecamatan) {
        $this->kecamatan = $kecamatan;
    }

    public function setKecamatanPengiriman($kecamatanPengiriman) {
        $this->kecamatanPengiriman = $kecamatanPengiriman;
    }

    public function setTanggalBergabung($tanggalBergabung) {
        $this->tanggalBergabung = $tanggalBergabung;
    }

}

interface MemberDao {

    public function save($kodeMember, $namaMember, $namaTujuanPengiriman, $jenisKelamin, $username, $password, $noTelpon, $alamat, $alamatPengiriman, $kecamatan, $kecamatanPengiriman);

    public function delete($kodeMember);

    public function findOne($kodeMember);

    public function login($username, $password);

    public function findByName($namaMember);

    public function findAll();

    public function findAllLimit($start, $batch);

    public function jumlahMember();
    
    public function ubahAlamatPengiriman($kodeMember, $kecamatanPengiriman, $alamatPengiriman, $namaTujuanPengiriman);
}

class MemberDaoImpl implements MemberDao {

    private $con;

    public function __construct() {
        $this->con = Koneksi::connect();
    }

    public function delete($kodeMember) {
        $query = "DELETE FROM member WHERE kode_member = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('s', $kodeMember);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function findAll() {
        $hasil = array();
        $query = "SELECT kode_member, nama_member, jenis_kelamin, username, password, no_telpon, alamat,alamat_pengiriman, kode_kecamatan, kode_kecamatan_pengiriman, tanggal_bergabung, nama_tujuan_pengiriman FROM member ORDER BY tanggal_bergabung DESC";
        $sql = $this->con->query($query);
        while ($res = $sql->fetch_array()) {
            $m = new Member();
            $m->setKodeMember($res[0]);
            $m->setNamaMember($res[1]);
            $m->setJenisKelamin($res[2]);
            $m->setUsername($res[3]);
            $m->setPassword($res[4]);
            $m->setNoTelpon($res[5]);
            $m->setAlamat($res[6]);
            $m->setAlamatPengiriman($res[7]);
            $m->setKecamatan($res[8]);
            $m->setKecamatanPengiriman($res[9]);
            $m->setTanggalBergabung($res[10]);
            $m->setNamaTujuanPengiriman($res[11]);
            $hasil[] = $m;
        }
        $sql->free();
        $this->con->close();
        return $hasil;
    }

    public function findByName($namaMember) {
        $hasil = array();
        $query = "SELECT kode_member, nama_member, jenis_kelamin, username, password, no_telpon, alamat, alamat_pengiriman, kode_kecamatan, kode_kecamatan_pengiriman, tanggal_bergabung, nama_tujuan_pengiriman FROM member WHERE nama_member LIKE ? OR jenis_kelamin LIKE ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('ss', $namaMember, $namaMember);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k, $l);
        while ($prep->fetch()) {
            $m = new Member();
            $m->setKodeMember($a);
            $m->setNamaMember($b);
            $m->setJenisKelamin($c);
            $m->setUsername($d);
            $m->setPassword($e);
            $m->setNoTelpon($f);
            $m->setAlamat($g);
            $m->setAlamatPengiriman($h);
            $m->setKecamatan($i);
            $m->setKecamatanPengiriman($j);
            $m->setTanggalBergabung($k);
            $m->setNamaTujuanPengiriman($l);
            $hasil[] = $m;
        }
        $prep->close();
        $this->con->close();
        return $hasil;
    }

    public function findOne($kodeMember) {
        $m = new Member();
        $query = "SELECT kode_member, nama_member, jenis_kelamin, username, password, no_telpon, alamat, alamat_pengiriman, kode_kecamatan, kode_kecamatan_pengiriman, tanggal_bergabung, nama_tujuan_pengiriman FROM member WHERE kode_member = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('s', $kodeMember);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k, $l);
        if ($prep->fetch()) {
            $m->setKodeMember($a);
            $m->setNamaMember($b);
            $m->setJenisKelamin($c);
            $m->setUsername($d);
            $m->setPassword($e);
            $m->setNoTelpon($f);
            $m->setAlamat($g);
            $m->setAlamatPengiriman($h);
            $m->setKecamatan($i);
            $m->setKecamatanPengiriman($j);
            $m->setTanggalBergabung($k);
            $m->setNamaTujuanPengiriman($l);
        }
        $prep->close();
        $this->con->close();
        return $m;
    }

    public function save($kodeMember, $namaMember, $namaTujuanPengiriman, $jenisKelamin, $username, $password, $noTelpon, $alamat, $alamatPengiriman, $kecamatan, $kecamatanPengiriman) {
        $query = "INSERT INTO member(kode_member, nama_member, nama_tujuan_pengiriman, jenis_kelamin, username, password, no_telpon, alamat, alamat_pengiriman, kode_kecamatan, kode_kecamatan_pengiriman, tanggal_bergabung)VALUES(?,?,?,?,?,?,?,?,?,?,?, now())";
        $prep = $this->con->prepare($query);
        $prep->bind_param('sssssssssss', $kodeMember, $namaMember, $namaTujuanPengiriman, $jenisKelamin, $username, $password, $noTelpon, $alamat, $alamatPengiriman, $kecamatan, $kecamatanPengiriman);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function findAllLimit($start, $batch) {
        $hasil = array();
        $query = "SELECT kode_member, nama_member, jenis_kelamin, username, password, no_telpon, alamat, alamat_pengiriman, kode_kecamatan, kode_kecamatan_pengiriman, tanggal_bergabung, nama_tujuan_pengiriman FROM member ORDER BY tanggal_bergabung DESC LIMIT ?,?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('ii', $start, $batch);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k, $l);
        while ($prep->fetch()) {
            $m = new Member();
            $m->setKodeMember($a);
            $m->setNamaMember($b);
            $m->setJenisKelamin($c);
            $m->setUsername($d);
            $m->setPassword($e);
            $m->setNoTelpon($f);
            $m->setAlamat($g);
            $m->setAlamatPengiriman($h);
            $m->setKecamatan($i);
            $m->setKecamatanPengiriman($j);
            $m->setTanggalBergabung($k);
            $m->setNamaTujuanPengiriman($l);
            $hasil[] = $m;
        }
        $prep->close();
        $this->con->close();
        return $hasil;
    }

    public function jumlahMember() {
        $jumlah = 0;
        $query = "SELECT COUNT(kode_member) AS JUMLAH FROM member";
        $sql = $this->con->query($query);
        while ($res = $sql->fetch_assoc()) {
            $jumlah = $res['JUMLAH'];
        }
        $sql->free();
        $this->con->close();
        return $jumlah;
    }

    public function login($username, $password) {
        $m = new Member();
        $query = "SELECT kode_member, nama_member, jenis_kelamin, username, password, no_telpon, alamat, alamat_pengiriman, kode_kecamatan, kode_kecamatan_pengiriman, tanggal_bergabung, nama_tujuan_pengiriman FROM member WHERE username = ? AND password = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('ss', $username, $password);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k, $l);
        if ($prep->fetch()) {
            $m->setKodeMember($a);
            $m->setNamaMember($b);
            $m->setJenisKelamin($c);
            $m->setUsername($d);
            $m->setPassword($e);
            $m->setNoTelpon($f);
            $m->setAlamat($g);
            $m->setAlamatPengiriman($h);
            $m->setKecamatan($i);
            $m->setKecamatanPengiriman($j);
            $m->setTanggalBergabung($k);
            $m->setNamaTujuanPengiriman($l);
        }
        $prep->close();
        $this->con->close();
        return $m;
    }

    public function ubahAlamatPengiriman($kodeMember, $kecamatanPengiriman, $alamatPengiriman, $namaTujuanPengiriman) {
        $query = "UPDATE member SET nama_tujuan_pengiriman = ?, alamat_pengiriman = ?, kode_kecamatan_pengiriman = ? WHERE kode_member = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param("ssss", $namaTujuanPengiriman, $alamatPengiriman, $kecamatanPengiriman, $kodeMember);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

}
