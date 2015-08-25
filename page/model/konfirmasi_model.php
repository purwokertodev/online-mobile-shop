<?php

include_once '../db/koneksi.php';

class Konfirmasi {

    private $kodeKonfirmasi;
    private $kodeTransaksi;
    private $tanggalKonfirmasi;
    private $namaGambar;
    private $lokasiGambar;

    public function getKodeKonfirmasi() {
        return $this->kodeKonfirmasi;
    }

    public function getKodeTransaksi() {
        return $this->kodeTransaksi;
    }

    public function getTanggalKonfirmasi() {
        return $this->tanggalKonfirmasi;
    }

    public function getNamaGambar() {
        return $this->namaGambar;
    }

    public function getLokasiGambar() {
        return $this->lokasiGambar;
    }

    public function setKodeKonfirmasi($kodeKonfirmasi) {
        $this->kodeKonfirmasi = $kodeKonfirmasi;
    }

    public function setKodeTransaksi($kodeTransaksi) {
        $this->kodeTransaksi = $kodeTransaksi;
    }

    public function setTanggalKonfirmasi($tanggalKonfirmasi) {
        $this->tanggalKonfirmasi = $tanggalKonfirmasi;
    }

    public function setNamaGambar($namaGambar) {
        $this->namaGambar = $namaGambar;
    }

    public function setLokasiGambar($lokasiGambar) {
        $this->lokasiGambar = $lokasiGambar;
    }

}

interface KonfirmasiDao {

    public function save($kodeKonfirmasi, $kodeTransaksi, $namaGambar, $lokasiGambar);

    public function delete($kodeTransaksi);

    public function findOne($kodeTransaksi);

    public function findAllLimit($start, $batch);

    public function findAll();

    public function jumlah();
}

class KonfirmasiDaoImpl implements KonfirmasiDao {

    private $con;

    public function __construct() {
        $this->con = Koneksi::connect();
    }

    public function delete($kodeTransaksi) {
        $query = "DELETE FROM konfirmasi_transaksi WHERE kode_transaksi = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('s', $kodeTransaksi);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function findAll() {
        $hasil = array();
        $query = "SELECT kode_konfirmasi, kode_transaksi, tanggal_konfirmasi, nama_gambar, lokasi_gambar FROM konfirmasi_transaksi";
        $sql = $this->con->query($query);
        while ($res = $sql->fetch_array()) {
            $k = new Konfirmasi();
            $k->setKodeKonfirmasi($res[0]);
            $k->setKodeTransaksi($res[1]);
            $k->setTanggalKonfirmasi($res[2]);
            $k->setNamaGambar($res[3]);
            $k->setLokasiGambar($res[4]);
            $hasil[] = $k;
        }
        $sql->free();
        $this->con->close();
        return $hasil;
    }

    public function findAllLimit($start, $batch) {
        $hasil = array();
        $query = "SELECT kode_konfirmasi, kode_transaksi, tanggal_konfirmasi, nama_gambar, lokasi_gambar FROM konfirmasi_transaksi ORDER BY tanggal_konfirmasi DESC LIMIT ?,?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('ii', $start, $batch);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d, $e);
        while ($prep->fetch()) {
            $k = new Konfirmasi();
            $k->setKodeKonfirmasi($a);
            $k->setKodeTransaksi($b);
            $k->setTanggalKonfirmasi($c);
            $k->setNamaGambar($d);
            $k->setLokasiGambar($e);
            $hasil[] = $k;
        }
        $prep->close();
        $this->con->close();
        return $hasil;
    }

    public function findOne($kodeTransaksi) {
        $k = new Konfirmasi();
        $query = "SELECT kode_konfirmasi, kode_transaksi, tanggal_konfirmasi, nama_gambar, lokasi_gambar FROM konfirmasi_transaksi WHERE kode_transaksi = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('s', $kodeTransaksi);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d, $e);
        if ($prep->fetch()) {
            $k->setKodeKonfirmasi($a);
            $k->setKodeTransaksi($b);
            $k->setTanggalKonfirmasi($c);
            $k->setNamaGambar($d);
            $k->setLokasiGambar($e);
        }
        $prep->close();
        $this->con->close();
        return $k;
    }

    public function save($kodeKonfirmasi, $kodeTransaksi, $namaGambar, $lokasiGambar) {
        $query = "INSERT INTO konfirmasi_transaksi(kode_konfirmasi, kode_transaksi, tanggal_konfirmasi, nama_gambar, lokasi_gambar) VALUES (?,?,now(),?,?)";
        $prep = $this->con->prepare($query);
        $prep->bind_param('ssss', $kodeKonfirmasi, $kodeTransaksi, $namaGambar, $lokasiGambar);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function jumlah() {
        $jumlah = 0;
        $query = "SELECT COUNT(kode_konfirmasi) AS JUMLAH FROM konfirmasi_transaksi";
        $sql = $this->con->query($query);
        while ($res = $sql->fetch_assoc()) {
            $jumlah = $res['JUMLAH'];
        }
        $sql->free();
        $this->con->close();
        return $jumlah;
    }

}
