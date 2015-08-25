<?php

include_once '../db/koneksi.php';

class Transaksi {

    private $kodeTransaksi;
    private $kodePembeli;
    private $namaPembeli;
    private $tanggalTransaksi;
    private $waktuTransaksi;
    private $diskon;
    private $biayaPengiriman;
    private $totalAkhir;

    public function getKodeTransaksi() {
        return $this->kodeTransaksi;
    }

    public function getKodePembeli() {
        return $this->kodePembeli;
    }

    public function getNamaPembeli() {
        return $this->namaPembeli;
    }

    public function getTanggalTransaksi() {
        return $this->tanggalTransaksi;
    }

    public function getWaktuTransaksi() {
        return $this->waktuTransaksi;
    }

    public function getDiskon() {
        return $this->diskon;
    }

    public function getBiayaPengiriman() {
        return $this->biayaPengiriman;
    }

    public function getTotalAkhir() {
        return $this->totalAkhir;
    }

    public function setKodeTransaksi($kodeTransaksi) {
        $this->kodeTransaksi = $kodeTransaksi;
    }

    public function setKodePembeli($kodePembeli) {
        $this->kodePembeli = $kodePembeli;
    }

    public function setNamaPembeli($namaPembeli) {
        $this->namaPembeli = $namaPembeli;
    }

    public function setTanggalTransaksi($tanggalTransaksi) {
        $this->tanggalTransaksi = $tanggalTransaksi;
    }

    public function setWaktuTransaksi($waktuTransaksi) {
        $this->waktuTransaksi = $waktuTransaksi;
    }

    public function setDiskon($diskon) {
        $this->diskon = $diskon;
    }

    public function setBiayaPengiriman($biayaPengiriman) {
        $this->biayaPengiriman = $biayaPengiriman;
    }

    public function setTotalAkhir($totalAkhir) {
        $this->totalAkhir = $totalAkhir;
    }

}

class TransaksiDetail {

    private $kodeTransaksiDetail;
    private $kodeTransaksi;
    private $kodeProduk;
    private $namaProduk;
    private $jumlahBeli;
    private $subTotal;

    public function getKodeTransaksiDetail() {
        return $this->kodeTransaksiDetail;
    }

    public function getKodeTransaksi() {
        return $this->kodeTransaksi;
    }

    public function getKodeProduk() {
        return $this->kodeProduk;
    }

    public function getNamaProduk() {
        return $this->namaProduk;
    }

    public function getJumlahBeli() {
        return $this->jumlahBeli;
    }

    public function getSubTotal() {
        return $this->subTotal;
    }

    public function setKodeTransaksiDetail($kodeTransaksiDetail) {
        $this->kodeTransaksiDetail = $kodeTransaksiDetail;
    }

    public function setKodeTransaksi($kodeTransaksi) {
        $this->kodeTransaksi = $kodeTransaksi;
    }

    public function setKodeProduk($kodeProduk) {
        $this->kodeProduk = $kodeProduk;
    }

    public function setNamaProduk($namaProduk) {
        $this->namaProduk = $namaProduk;
    }

    public function setJumlahBeli($jumlahBeli) {
        $this->jumlahBeli = $jumlahBeli;
    }

    public function setSubTotal($subTotal) {
        $this->subTotal = $subTotal;
    }

}

interface TransaksiDao {

    public function save($kodeTransaksi, $kodePembeli, $diskon, $biayaPengiriman, $totalAkhir);

    public function findOne($kodeTransaksi);

    public function findByPembeli($kodePembeli);

    public function findByPembeliOne($kodePembeli);

    public function findByTanggal($startDay, $endDay);

    public function findByDay($now);

    public function findAll();

    public function findByLimit($start, $batch);

    public function jumlahTransaksi();

    public function jumlahPendapatanPerhari($now);

    public function jumlahPendapatanPerPeriode($star, $end);
    
    public function jumlahDiskonPerhari($now);
    
    public function jumlahDiskonPerPeriode($star, $end);
}

interface TransaksiDetailDao {

    public function save($kodeTransaksi, $kodeProduk, $jumlahBeli, $subTotal);

    public function findByTransaksi($kodeTransaksi);

    public function findAll();
}

// Kelas implementasi
class TransaksiDaoImpl implements TransaksiDao {

    private $con;

    public function __construct() {
        $this->con = Koneksi::connect();
    }

    public function findAll() {
        $hasil = array();
        $query = "SELECT kode_transaksi, kode_pembeli_on_transaksi,nama_member, tanggal_transaksi, waktu_transaksi, diskon, biaya_pengiriman, total_akhir FROM transaksi,member WHERE transaksi.kode_pembeli_on_transaksi=member.kode_member";
        $sql = $this->con->query($query);
        while ($res = $sql->fetch_array()) {
            $t = new Transaksi();
            $t->setKodeTransaksi($res[0]);
            $t->setKodePembeli($res[1]);
            $t->setNamaPembeli($res[2]);
            $t->setTanggalTransaksi($res[3]);
            $t->setWaktuTransaksi($res[4]);
            $t->setDiskon($res[5]);
            $t->setBiayaPengiriman($res[6]);
            $t->setTotalAkhir($res[7]);
            $hasil[] = $t;
        }
        $sql->free();
        $this->con->close();
        return $hasil;
    }

    public function findByLimit($start, $batch) {
        $hasil = array();
        $query = "SELECT kode_transaksi, kode_pembeli_on_transaksi,nama_member, tanggal_transaksi, waktu_transaksi, diskon, biaya_pengiriman, total_akhir FROM transaksi,member WHERE transaksi.kode_pembeli_on_transaksi=member.kode_member ORDER BY waktu_transaksi DESC LIMIT ?,?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('ii', $start, $batch);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d, $e, $f, $g, $h);
        while ($prep->fetch()) {
            $t = new Transaksi();
            $t->setKodeTransaksi($a);
            $t->setKodePembeli($b);
            $t->setNamaPembeli($c);
            $t->setTanggalTransaksi($d);
            $t->setWaktuTransaksi($e);
            $t->setDiskon($f);
            $t->setBiayaPengiriman($g);
            $t->setTotalAkhir($h);
            $hasil[] = $t;
        }
        $prep->close();
        $this->con->close();
        return $hasil;
    }

    public function findByPembeli($kodePembeli) {
        $hasil = array();
        $query = "SELECT kode_transaksi, kode_pembeli_on_transaksi,nama_member, tanggal_transaksi, waktu_transaksi, diskon,biaya_pengiriman, total_akhir FROM transaksi,member WHERE transaksi.kode_pembeli_on_transaksi=member.kode_member AND kode_pembeli_on_transaksi = ? ORDER BY transaksi.waktu_transaksi DESC";
        $prep = $this->con->prepare($query);
        $prep->bind_param('s', $kodePembeli);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d, $e, $f, $g, $h);
        while ($prep->fetch()) {
            $t = new Transaksi();
            $t->setKodeTransaksi($a);
            $t->setKodePembeli($b);
            $t->setNamaPembeli($c);
            $t->setTanggalTransaksi($d);
            $t->setWaktuTransaksi($e);
            $t->setDiskon($f);
            $t->setBiayaPengiriman($g);
            $t->setTotalAkhir($h);
            $hasil[] = $t;
        }
        $prep->close();
        $this->con->close();
        return $hasil;
    }

    public function findOne($kodeTransaksi) {
        $t = new Transaksi();
        $query = "SELECT kode_transaksi, kode_pembeli_on_transaksi,nama_member, tanggal_transaksi, waktu_transaksi, diskon, biaya_pengiriman, total_akhir FROM transaksi,member WHERE transaksi.kode_pembeli_on_transaksi=member.kode_member AND kode_transaksi = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('s', $kodeTransaksi);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d, $e, $f, $g, $h);
        if ($prep->fetch()) {
            $t = new Transaksi();
            $t->setKodeTransaksi($a);
            $t->setKodePembeli($b);
            $t->setNamaPembeli($c);
            $t->setTanggalTransaksi($d);
            $t->setWaktuTransaksi($e);
            $t->setDiskon($f);
            $t->setBiayaPengiriman($h);
            $t->setTotalAkhir($h);
        }
        $prep->close();
        $this->con->close();
        return $t;
    }

    public function save($kodeTransaksi, $kodePembeli, $diskon, $biayaPengiriman, $totalAkhir) {
        $query = "INSERT INTO transaksi(kode_transaksi, kode_pembeli_on_transaksi, tanggal_transaksi, waktu_transaksi, diskon, biaya_pengiriman, total_akhir) VALUES(?,?,now(),now(),?,?,?)";
        $prep = $this->con->prepare($query);
        $prep->bind_param('ssddd', $kodeTransaksi, $kodePembeli, $diskon, $biayaPengiriman, $totalAkhir);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function jumlahTransaksi() {
        $jumlah = 0;
        $query = "SELECT COUNT(kode_transaksi) AS JUMLAH FROM transaksi";
        $sql = $this->con->query($query);
        while ($res = $sql->fetch_assoc()) {
            $jumlah = $res['JUMLAH'];
        }
        $sql->free();
        $this->con->close();
        return $jumlah;
    }

    public function findByTanggal($startDay, $endDay) {
        $hasil = array();
        $query = "SELECT kode_transaksi, kode_pembeli_on_transaksi,nama_member, tanggal_transaksi, waktu_transaksi, diskon, biaya_pengiriman, total_akhir FROM transaksi,member WHERE transaksi.kode_pembeli_on_transaksi=member.kode_member AND tanggal_transaksi BETWEEN ? AND ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('ss', $startDay, $endDay);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d, $e, $f, $g, $h);
        while ($prep->fetch()) {
            $t = new Transaksi();
            $t->setKodeTransaksi($a);
            $t->setKodePembeli($b);
            $t->setNamaPembeli($c);
            $t->setTanggalTransaksi($d);
            $t->setWaktuTransaksi($e);
            $t->setDiskon($f);
            $t->setBiayaPengiriman($g);
            $t->setTotalAkhir($h);
            $hasil[] = $t;
        }
        $prep->close();
        $this->con->close();
        return $hasil;
    }

    public function findByDay($now) {
        $hasil = array();
        $query = "SELECT kode_transaksi, kode_pembeli_on_transaksi,nama_member, tanggal_transaksi, waktu_transaksi, diskon, biaya_pengiriman, total_akhir FROM transaksi,member WHERE transaksi.kode_pembeli_on_transaksi=member.kode_member AND tanggal_transaksi = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('s', $now);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d, $e, $f, $g, $h);
        while ($prep->fetch()) {
            $t = new Transaksi();
            $t->setKodeTransaksi($a);
            $t->setKodePembeli($b);
            $t->setNamaPembeli($c);
            $t->setTanggalTransaksi($d);
            $t->setWaktuTransaksi($e);
            $t->setDiskon($f);
            $t->setBiayaPengiriman($g);
            $t->setTotalAkhir($h);
            $hasil[] = $t;
        }
        $prep->close();
        $this->con->close();
        return $hasil;
    }

    public function findByPembeliOne($kodePembeli) {
        $t = new Transaksi();
        $query = "SELECT kode_transaksi, kode_pembeli_on_transaksi,nama_member, tanggal_transaksi, waktu_transaksi, diskon,biaya_pengiriman, total_akhir FROM transaksi,member WHERE transaksi.kode_pembeli_on_transaksi=member.kode_member AND kode_pembeli_on_transaksi = ? ORDER BY waktu_transaksi DESC LIMIT 0,1";
        $prep = $this->con->prepare($query);
        $prep->bind_param('s', $kodePembeli);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d, $e, $f, $g, $h);
        if ($prep->fetch()) {
            $t->setKodeTransaksi($a);
            $t->setKodePembeli($b);
            $t->setNamaPembeli($c);
            $t->setTanggalTransaksi($d);
            $t->setWaktuTransaksi($e);
            $t->setDiskon($f);
            $t->setBiayaPengiriman($g);
            $t->setTotalAkhir($h);
        }
        $prep->close();
        $this->con->close();
        return $t;
    }

    public function jumlahPendapatanPerhari($now) {
        $hasil = 0.0;
        $query = "SELECT SUM(total_akhir) AS JUMLAH FROM transaksi WHERE tanggal_transaksi = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param("s", $now);
        $prep->execute();
        $prep->bind_result($a);
        while ($prep->fetch()) {
            $hasil = $a;
        }
        $prep->close();
        $this->con->close();
        return $hasil;
    }

    public function jumlahPendapatanPerPeriode($star, $end) {
        $hasil = 0.0;
        $query = "SELECT SUM(total_akhir) AS JUMLAH FROM transaksi WHERE tanggal_transaksi BETWEEN ? AND ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param("ss", $star, $end);
        $prep->execute();
        $prep->bind_result($a);
        while ($prep->fetch()) {
            $hasil = $a;
        }
        $prep->close();
        $this->con->close();
        return $hasil;
    }

    public function jumlahDiskonPerPeriode($star, $end) {
        $hasil = 0.0;
        $query = "SELECT SUM(diskon) AS JUMLAH FROM transaksi WHERE tanggal_transaksi BETWEEN ? AND ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param("ss", $star, $end);
        $prep->execute();
        $prep->bind_result($a);
        while ($prep->fetch()) {
            $hasil = $a;
        }
        $prep->close();
        $this->con->close();
        return $hasil;
    }

    public function jumlahDiskonPerhari($now) {
        $hasil = 0.0;
        $query = "SELECT SUM(diskon) AS JUMLAH FROM transaksi WHERE tanggal_transaksi = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param("s", $now);
        $prep->execute();
        $prep->bind_result($a);
        while ($prep->fetch()) {
            $hasil = $a;
        }
        $prep->close();
        $this->con->close();
        return $hasil;
    }

}

class TransaksiDetailDaoImpl implements TransaksiDetailDao {

    private $con;

    public function __construct() {
        $this->con = Koneksi::connect();
    }

    public function findAll() {
        $hasil = array();
        $query = "SELECT kode_transaksi_detail, kode_transaksi, kode_produk_transaksi, jumlah_beli, sub_total FROM transaksi_detail";
        $sql = $this->con->query($query);
        while ($res = $sql->fetch_array()) {
            $t = new TransaksiDetail();
            $t->setKodeTransaksiDetail($res[0]);
            $t->setKodeTransaksi($res[1]);
            $t->setKodeProduk($res[2]);
            $t->setJumlahBeli($res[3]);
            $t->setSubTotal($res[4]);
            $hasil[] = $t;
        }
        $sql->free();
        $this->con->close();
        return $hasil;
    }

    public function findByTransaksi($kodeTransaksi) {
        $hasil = array();
        $query = "SELECT kode_transaksi_detail, kode_transaksi, kode_produk_transaksi, nama_produk, jumlah_beli, sub_total FROM transaksi_detail, produk WHERE  transaksi_detail.kode_produk_transaksi = produk.kode_produk AND kode_transaksi = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('s', $kodeTransaksi);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d, $e, $f);
        while ($prep->fetch()) {
            $t = new TransaksiDetail();
            $t->setKodeTransaksiDetail($a);
            $t->setKodeTransaksi($b);
            $t->setKodeProduk($c);
            $t->setNamaProduk($d);
            $t->setJumlahBeli($e);
            $t->setSubTotal($f);
            $hasil[] = $t;
        }
        $prep->close();
        $this->con->close();
        return $hasil;
    }

    public function save($kodeTransaksi, $kodeProduk, $jumlahBeli, $subTotal) {
        $query = "INSERT INTO transaksi_detail (kode_transaksi, kode_produk_transaksi, jumlah_beli, sub_total) VALUES (?,?,?,?)";
        $prep = $this->con->prepare($query);
        $prep->bind_param('ssid', $kodeTransaksi, $kodeProduk, $jumlahBeli, $subTotal);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

}
