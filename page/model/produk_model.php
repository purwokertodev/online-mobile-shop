<?php

include_once '../db/koneksi.php';

class Produk {

    private $kodeProduk;
    private $kodePabrikanProduk;
    private $namaPabrikan;
    private $namaProduk;
    private $stok;
    private $hargaPokok;
    private $hargaJual;
    private $spesifikasi;
    private $namaGambar;
    private $lokasiGambar;
    private $beratBarang;

    public function getKodeProduk() {
        return $this->kodeProduk;
    }

    public function getKodePabrikanProduk() {
        return $this->kodePabrikanProduk;
    }

    public function getNamaPabrikan() {
        return $this->namaPabrikan;
    }

    public function getNamaProduk() {
        return $this->namaProduk;
    }

    public function getStok() {
        return $this->stok;
    }

    public function getHargaPokok() {
        return $this->hargaPokok;
    }

    public function getHargaJual() {
        return $this->hargaJual;
    }

    public function getSpesifikasi() {
        return $this->spesifikasi;
    }

    public function getNamaGambar() {
        return $this->namaGambar;
    }

    public function getLokasiGambar() {
        return $this->lokasiGambar;
    }
    
    public function getBeratBarang(){
        return $this->beratBarang;
    }

    public function setKodeProduk($kodeProduk) {
        $this->kodeProduk = $kodeProduk;
    }

    public function setKodePabrikanProduk($kodePabrikanProduk) {
        $this->kodePabrikanProduk = $kodePabrikanProduk;
    }

    public function setNamaPabrikan($namaPabrikan) {
        $this->namaPabrikan = $namaPabrikan;
    }

    public function setNamaProduk($namaProduk) {
        $this->namaProduk = $namaProduk;
    }

    public function setStok($stok) {
        $this->stok = $stok;
    }

    public function setHargaPokok($hargaPokok) {
        $this->hargaPokok = $hargaPokok;
    }

    public function setHargaJual($hargaJual) {
        $this->hargaJual = $hargaJual;
    }

    public function setSpesifikasi($spesifikasi) {
        $this->spesifikasi = $spesifikasi;
    }

    public function setNamaGambar($namaGambar) {
        $this->namaGambar = $namaGambar;
    }

    public function setLokasiGambar($lokasiGambar) {
        $this->lokasiGambar = $lokasiGambar;
    }
    
    public function setBeratBarang($beratBarang){
        $this->beratBarang = $beratBarang;
    }

}

interface ProdukDao {

    public function save($kodeProduk, $kodePabrikanProduk, $namaProduk, $stok, $hargaPokok, $hargaJual, $spesifikasi, $namaGambar, $lokasiGambar, $beratBarang);

    public function update($kodeProduk, $kodePabrikanProduk, $namaProduk, $stok, $hargaPokok, $hargaJual, $spesifikasi, $namaGambar, $lokasiGambar, $beratBarang);

    public function delete($kodeProduk);

    public function findOne($kodeProduk);

    public function findByPabrikan($kodePabrikan);

    public function findAll();

    public function findAllLimit($start, $batch);

    public function findByName($namaProduk);
    
    public function jumlahProduk();
    
    public function jumlahProdukByVendor($kodePabrikan);
}

class ProdukDaoImpl implements ProdukDao {

    private $con;

    public function __construct() {
        $this->con = Koneksi::connect();
    }

    public function delete($kodeProduk) {
        $query = "DELETE FROM produk WHERE kode_produk = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('s', $kodeProduk);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function findAll() {
        $hasil = array();
        $query = "SELECT kode_produk, kode_pabrikan_produk, nama_pabrikan, nama_produk, stok, harga_pokok, harga_jual, spesifikasi, nama_gambar, lokasi_gambar, berat_barang FROM produk, pabrikan_ponsel WHERE produk.kode_pabrikan_produk=pabrikan_ponsel.kode_pabrikan";
        $sql = $this->con->query($query);
        while ($res = $sql->fetch_assoc()) {
            $p = new Produk();
            $p->setKodeProduk($res['kode_produk']);
            $p->setKodePabrikanProduk($res['kode_pabrikan_produk']);
            $p->setNamaPabrikan($res['nama_pabrikan']);
            $p->setNamaProduk($res['nama_produk']);
            $p->setStok($res['stok']);
            $p->setHargaPokok($res['harga_pokok']);
            $p->setHargaJual($res['harga_jual']);
            $p->setSpesifikasi($res['spesifikasi']);
            $p->setNamaGambar($res['nama_gambar']);
            $p->setLokasiGambar($res['lokasi_gambar']);
            $p->setBeratBarang($res['berat_barang']);
            $hasil[] = $p;
        }
        $sql->free();
        $this->con->close();
        return $hasil;
    }

    public function findByName($namaProduk) {
        $hasil = array();
        $query = "SELECT kode_produk, kode_pabrikan_produk, nama_pabrikan, nama_produk, stok, harga_pokok, harga_jual, spesifikasi, nama_gambar, lokasi_gambar, berat_barang FROM produk, pabrikan_ponsel WHERE produk.kode_pabrikan_produk=pabrikan_ponsel.kode_pabrikan AND nama_produk LIKE ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('s', $namaProduk);
        $prep->execute();
        $prep->bind_result($kode_produk_res, $kode_pabrikan_res, $nama_pabrikan_res, $nama_produk_res, $stok_res, $harga_pokok_res, $harga_jual_res, $spesifikasi_res, $nama_gambar_res, $lokasi_gambar_res, $berat_barang_res);
        while ($prep->fetch()) {
            $p = new Produk();
            $p->setKodeProduk($kode_produk_res);
            $p->setKodePabrikanProduk($kode_pabrikan_res);
            $p->setNamaPabrikan($nama_pabrikan_res);
            $p->setNamaProduk($nama_produk_res);
            $p->setStok($stok_res);
            $p->setHargaPokok($harga_pokok_res);
            $p->setHargaJual($harga_jual_res);
            $p->setSpesifikasi($spesifikasi_res);
            $p->setNamaGambar($nama_gambar_res);
            $p->setLokasiGambar($lokasi_gambar_res);
            $p->setBeratBarang($berat_barang_res);
            $hasil[] = $p;
        }
        $prep->close();
        $this->con->close();
        return $hasil;
    }

    public function findByPabrikan($kodePabrikan) {
        $hasil = array();
        $query = "SELECT kode_produk, kode_pabrikan_produk, nama_pabrikan, nama_produk, stok, harga_pokok, harga_jual, spesifikasi, nama_gambar, lokasi_gambar, berat_barang FROM produk, pabrikan_ponsel WHERE produk.kode_pabrikan_produk=pabrikan_ponsel.kode_pabrikan AND kode_pabrikan_produk = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('s', $kodePabrikan);
        $prep->execute();
        $prep->bind_result($kode_produk_res, $kode_pabrikan_res, $nama_pabrikan_res, $nama_produk_res, $stok_res, $harga_pokok_res, $harga_jual_res, $spesifikasi_res, $nama_gambar_res, $lokasi_gambar_res, $berat_barang_res);
        while ($prep->fetch()) {
            $p = new Produk();
            $p->setKodeProduk($kode_produk_res);
            $p->setKodePabrikanProduk($kode_pabrikan_res);
            $p->setNamaPabrikan($nama_pabrikan_res);
            $p->setNamaProduk($nama_produk_res);
            $p->setStok($stok_res);
            $p->setHargaPokok($harga_pokok_res);
            $p->setHargaJual($harga_jual_res);
            $p->setSpesifikasi($spesifikasi_res);
            $p->setNamaGambar($nama_gambar_res);
            $p->setLokasiGambar($lokasi_gambar_res);
            $p->setBeratBarang($berat_barang_res);
            $hasil[] = $p;
        }
        $prep->close();
        $this->con->close();
        return $hasil;
    }

    public function findOne($kodeProduk) {
        $p = new Produk();
        $query = "SELECT kode_produk, kode_pabrikan_produk, nama_pabrikan, nama_produk, stok, harga_pokok, harga_jual, spesifikasi, nama_gambar, lokasi_gambar, berat_barang FROM produk, pabrikan_ponsel WHERE produk.kode_pabrikan_produk=pabrikan_ponsel.kode_pabrikan AND kode_produk = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('s', $kodeProduk);
        $prep->execute();
        $prep->bind_result($kode_produk_res, $kode_pabrikan_res, $nama_pabrikan_res, $nama_produk_res, $stok_res, $harga_pokok_res, $harga_jual_res, $spesifikasi_res, $nama_gambar_res, $lokasi_gambar_res, $berat_barang_res);
        if ($prep->fetch()) {
            $p->setKodeProduk($kode_produk_res);
            $p->setKodePabrikanProduk($kode_pabrikan_res);
            $p->setNamaPabrikan($nama_pabrikan_res);
            $p->setNamaProduk($nama_produk_res);
            $p->setStok($stok_res);
            $p->setHargaPokok($harga_pokok_res);
            $p->setHargaJual($harga_jual_res);
            $p->setSpesifikasi($spesifikasi_res);
            $p->setNamaGambar($nama_gambar_res);
            $p->setLokasiGambar($lokasi_gambar_res);
            $p->setBeratBarang($berat_barang_res);
        }
        $prep->close();
        $this->con->close();
        return $p;
    }

    public function save($kodeProduk, $kodePabrikanProduk, $namaProduk, $stok, $hargaPokok, $hargaJual, $spesifikasi, $namaGambar, $lokasiGambar, $beratBarang) {
        $query = "INSERT INTO produk(kode_produk, kode_pabrikan_produk, nama_produk, stok, harga_pokok, harga_jual, spesifikasi, nama_gambar, lokasi_gambar, berat_barang)VALUES(?,?,?,?,?,?,?,?,?,?)";
        $prep = $this->con->prepare($query);
        $prep->bind_param('sssiddsssd', $kodeProduk, $kodePabrikanProduk, $namaProduk, $stok, $hargaPokok, $hargaJual, $spesifikasi, $namaGambar, $lokasiGambar, $beratBarang);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function update($kodeProduk, $kodePabrikanProduk, $namaProduk, $stok, $hargaPokok, $hargaJual, $spesifikasi, $namaGambar, $lokasiGambar, $beratBarang) {
        $query = "UPDATE produk SET kode_pabrikan_produk = ?, nama_produk = ?, stok = ?, harga_pokok = ?, harga_jual = ?, spesifikasi = ?, nama_gambar = ?, lokasi_gambar = ?, berat_barang = ? WHERE kode_produk = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('ssiddsssds', $kodePabrikanProduk, $namaProduk, $stok, $hargaPokok, $hargaJual, $spesifikasi, $namaGambar, $lokasiGambar, $beratBarang, $kodeProduk);
        $prep->execute();
        $prep->close();
        $this->con->close();
    }

    public function findAllLimit($start, $batch) {
        $hasil = array();
        $query = "SELECT kode_produk, kode_pabrikan_produk, nama_pabrikan, nama_produk, stok, harga_pokok, harga_jual, spesifikasi, nama_gambar, lokasi_gambar, berat_barang FROM produk, pabrikan_ponsel WHERE produk.kode_pabrikan_produk=pabrikan_ponsel.kode_pabrikan LIMIT ?,?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('ii', $start, $batch);
        $prep->execute();
        $prep->bind_result($a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k);
        while ($prep->fetch()) {
            $p = new Produk();
            $p->setKodeProduk($a);
            $p->setKodePabrikanProduk($b);
            $p->setNamaPabrikan($c);
            $p->setNamaProduk($d);
            $p->setStok($e);
            $p->setHargaPokok($f);
            $p->setHargaJual($g);
            $p->setSpesifikasi($h);
            $p->setNamaGambar($i);
            $p->setLokasiGambar($j);
            $p->setBeratBarang($k);
            $hasil[] = $p;
        }
        $prep->close();
        $this->con->close();
        return $hasil;
    }

    public function jumlahProduk() {
        $jumlah = 0;
        $query = "SELECT COUNT(kode_produk) AS JUMLAH FROM produk";
        $sql = $this->con->query($query);
        while ($res = $sql->fetch_assoc()){
            $jumlah = $res['JUMLAH'];
        }
        $sql->free();
        $this->con->close();
        return $jumlah;
    }

    public function jumlahProdukByVendor($kodePabrikan) {
        $jumlah = 0;
        $query = "SELECT COUNT(kode_produk) AS JUMLAH FROM produk WHERE kode_pabrikan_produk = ?";
        $prep = $this->con->prepare($query);
        $prep->bind_param('s', $kodePabrikan);
        $prep->execute();
        $prep->bind_result($jumlah_res);
        while($prep->fetch()){
            $jumlah = $jumlah_res;
        }
        $prep->close();
        $this->con->close();
        return $jumlah;
    }

}
