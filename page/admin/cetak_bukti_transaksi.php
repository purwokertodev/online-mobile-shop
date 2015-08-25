
<?php
session_start();

include_once '../validasi/kelas_validasi.php';
include_once '../model/petugas_model.php';

if (!isset($_SESSION['username_login_admin']) && !isset($_SESSION['password_login_admin'])) {
    Validasi::harusLogin();
} else {
    $username = $_SESSION['username_login_admin'];
    $password = $_SESSION['password_login_admin'];
    $pdao = new PetugasDaoImpl();
    $p = $pdao->login($username, $password);
    $namaPetugas = $p->getNamaPetugas();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta charset="UTF-8">
            <title>Bumiayu Cell</title>
    </head>
    <body>
        <?php
        include_once '../model/konfirmasi_model.php';
        include_once '../model/member_model.php';
        include_once '../model/transaksi_model.php';
        include_once '../model/kecamatan_model.php';

        $kodeTransaksi = filter_input(INPUT_GET, 'kode_transaksi');
        $kdao = new KonfirmasiDaoImpl();
        $mdao = new MemberDaoImpl();
        $tdao = new TransaksiDaoImpl();
        $tdetailDao = new TransaksiDetailDaoImpl();

        $k = $kdao->findOne($kodeTransaksi);
        $lokasiGambar = $k->getLokasiGambar();

        $transaksi = $tdao->findOne($kodeTransaksi);
        $kodeMember = $transaksi->getKodePembeli();
        $waktu = $transaksi->getWaktuTransaksi();
        $diskon = $transaksi->getDiskon();
        $total = $transaksi->getTotalAkhir();

        $m = $mdao->findOne($kodeMember);
        $namaMember = $m->getNamaMember();
        $namaTujuanPengiriman = $m->getNamaTujuanPengiriman();
        $jenisKelamin = $m->getJenisKelamin();
        $noTelpon = $m->getNoTelpon();
        $alamat = $m->getAlamat();
        $kecamatan = $m->getKecamatan();
        $alamatPengiriman = $m->getAlamatPengiriman();
        $kecamatanPengiriman = $m->getKecamatanPengiriman();
        
        $kecDao = new KecamatanDaoImpl();
        $kec = $kecDao->findOne($kecamatan);
        $namaPropinsi = $kec->getNamaProvinsi();
        $namaKabupaten = $kec->getNamaKabupaten();
        $namaKecamatan = $kec->getNamaKecamatan();
        
        $kecDaoP = new KecamatanDaoImpl();
        $kecP = $kecDaoP->findOne($kecamatanPengiriman);
        $namaPropinsiP = $kecP->getNamaProvinsi();
        $namaKabupatenP = $kecP->getNamaKabupaten();
        $namaKecamatanP = $kecP->getNamaKecamatan();
        ?>
        <h2>Bumiayu Cell</h2>
        <h3>Dari Bumiayu Cell</h3>
        <h3>Alamat : Jalan Raya Bumiayu no 10.</h3>
        <h3>Kode Transaksi : <?php echo $kodeTransaksi;?></h3>
        <table border="0">
            <tr>
                <td>Tanggal transaksi</td>
                <td>:</td>
                <td><?php echo $waktu?></td>
            </tr>
            <tr>
                <td>Total Rp.</td>
                <td>:</td>
                <td><?php echo number_format($total, 2, ',', '.');?></td>
            </tr>
        </table>
        <h4>Pembeli</h4>
        <table border="0">
            <tr>
                <td>Nama Pembeli</td>
                <td>:</td>
                <td><?php echo $namaMember;?></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><?php echo $jenisKelamin;?></td>
            </tr>
            <tr>
                <td>No Telpon</td>
                <td>:</td>
                <td><?php echo $noTelpon;?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?php echo $alamat;?></td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>:</td>
                <td><?php echo $namaKecamatan.', '.$namaKabupaten.', '.$namaPropinsi;?></td>
            </tr>
            <tr>
                <td>Nama Tujuan Pengiriman</td>
                <td>:</td>
                <td><?php echo $namaTujuanPengiriman;?></td>
            </tr>
            <tr>
                <td>Alamat Pengiriman</td>
                <td>:</td>
                <td><?php echo $alamatPengiriman;?></td>
            </tr>
            <tr>
                <td>Kecamatan Pengiriman</td>
                <td>:</td>
                <td><?php echo $namaKecamatanP.', '.$namaKabupatenP.', '.$namaPropinsiP;?></td>
            </tr>
        </table>
        <h4>Produk Yang DiBeli</h4>
        <table border="1">
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Jumlah Beli</th>
                <th>Sub Total Rp.</th>
            </tr>
            <?php
            $tdetail = $tdetailDao->findByTransaksi($kodeTransaksi);
            $no = 1;
            for ($i = 0; $i < count($tdetail); $i++) {
                $td = $tdetail[$i];
                $namaProduk = $td->getNamaProduk();
                $jumlahBeli = $td->getJumlahBeli();
                $subTotal = $td->getSubTotal();
                ?>
                <tr>
                    <td><?php echo $no;?></td>
                    <td><?php echo $namaProduk;?></td>
                    <td><?php echo $jumlahBeli;?></td>
                    <td><?php echo number_format($subTotal, 2, ',', '.');?></td>
                </tr>
                <?php
                $no++;
            }
            ?>
        </table>
    </body>
</html>

<?php
$fileName = "bukti-" . $kodeTransaksi ."-". date("d-M-Y").".pdf";
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">' . nl2br($content) . '</page>';
require_once('../../plugin/html2pdf/html2pdf.class.php');
try {
    $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'UTF-8', array(30, 0, 20, 0));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($fileName);
} catch (HTML2PDF_exception $e) {
    echo $e;
}
?>