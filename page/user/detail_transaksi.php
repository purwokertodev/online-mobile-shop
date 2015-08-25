<div class="ui-content" data-role="main">
    <div style="text-align: center">
        <h3>Data Pembelian</h3>
    </div>
    <ul data-role='listview' data-inset='true'>
    <?php
    include_once '../model/transaksi_model.php';

    if (isset($_GET['kode_transaksi'])) {
        $kodeTransaksi = filter_input(INPUT_GET, 'kode_transaksi');
        $token = filter_input(INPUT_GET, 'token');

        $cek = md5(md5($kodeTransaksi) . md5("kata diacak"));
        if ($cek == $token) {
            $tdao = new TransaksiDaoImpl();
            $t = $tdao->findOne($kodeTransaksi);
            $totalPembayaran = $t->getTotalAkhir();

            $tdaoDetail = new TransaksiDetailDaoImpl();
            $data_detail = $tdaoDetail->findByTransaksi($kodeTransaksi);
            for ($i = 0; $i < count($data_detail); $i++) {
                $td = $data_detail[$i];
                $kodeProduk = $td->getKodeProduk();
                $namaProduk = $td->getNamaProduk();
                $jumlahBeli = $td->getJumlahBeli();
                $subTotal = $td->getSubTotal();
                ?>
                <li>
                    <h3><?php echo $namaProduk; ?></h3> Sub Total : Rp. <?php echo number_format($subTotal, 2, ',', '.'); ?> <span class="ui-li-count">Jumlah Beli : <?php echo $jumlahBeli; ?> item</span>
                </li>
                <?php
            }
            echo "</ul>";
            echo "<div class='ui-field-contain'><legend>Total :</legend><strong>Rp." . number_format($totalPembayaran, 2, ',', '.') . "</strong></div>";
            
        } else {
            echo 'SQL injeksi terdeteksi !!';
        }
    }
    ?>
</div>