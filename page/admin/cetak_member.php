<?php
include_once '../model/member_model.php';
include_once '../model/kecamatan_model.php';

$kodeMember = filter_input(INPUT_GET, 'kode_member');
$mdao = new MemberDaoImpl();
$m = $mdao->findOne($kodeMember);
$namaMember = $m->getNamaMember();
$jenisKelamin = $m->getJenisKelamin();
$noTelpon = $m->getNoTelpon();
$alamat = $m->getAlamat();
$kecamatan = $m->getKecamatan();
$tanggalBergabung = $m->getTanggalBergabung();

$kecDao = new KecamatanDaoImpl();
$kec = $kecDao->findOne($kecamatan);
$namaPropinsi = $kec->getNamaProvinsi();
$namaKabupaten = $kec->getNamaKabupaten();
$namaKecamatan = $kec->getNamaKecamatan();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta charset="UTF-8">
            <title>Cetak Data Pembeli</title>
    </head>
    <body>
        <h2>Bumiayu Cell</h2>
        <h3>Data Pembeli Detail</h3>
        <table border="0">
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td><?php echo $namaMember; ?></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><?php echo $jenisKelamin; ?></td>
            </tr>
            <tr>
                <td>No Hp/Telpon</td>
                <td>:</td>
                <td><?php echo $noTelpon; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?php echo $alamat; ?></td>
            </tr>
            <tr>
                <td>Region</td>
                <td>:</td>
                <td><?php echo "Kecamatan : ".$namaKecamatan.'<br>Kabupaten : '.$namaKabupaten.'<br> Propinsi : '.$namaPropinsi;?></td>
            </tr>
        </table>
    </body>
</html>
<?php
$fileName = "pembeli-" . $kodeMember ."-". date("d-M-Y").".pdf";
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