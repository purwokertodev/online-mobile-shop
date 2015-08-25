
<div class="ui-content">
    <div style="text-align: center">
        <h3>Konfirmasi Pembayaran</h3>
        <?php
            session_start();
            
            include_once '../model/transaksi_model.php';
            
            if(isset($_SESSION['pembeli_login'])){
                $kodePembeli = $_SESSION['pembeli_login']['kode_pembeli'];
                $tdao = new TransaksiDaoImpl();
                $data_trans = $tdao->findByPembeli($kodePembeli);
                echo '<h4>Kode Transaksi Telah Anda Lakukan</h4>';
                echo "<ul data-role='listview' data-inset='true'>";
                for($i=0;$i<count($data_trans);$i++){
                    $t = $data_trans[$i];
                    $kodeTrans = $t->getKodeTransaksi();
                    $token = md5(md5($kodeTrans).md5("kata diacak"));
                    echo "<li><a href='index.php?user=detail_transaksi&kode_transaksi=$kodeTrans&token=$token'>$kodeTrans</a></li>";
                }
                echo "</ul>";
            }  else {
                echo '<h4>Jika anda lupa kode transaksi anda, silahkan login terlebih dahulu.</h4>';
            }
        ?>
        <form action="index.php?user=konfirmasi_pembayaran_finish" method="post" data-ajax="false" enctype="multipart/form-data" id="form-konfirmasi">
            <div class="ui-field-contain">
                <label for="kode_transaksi">Kode transaksi anda :</label>
                <input type="text" name="kode_transaksi" data-clear-btn="true" id="kode_transaksi" placeholder="Kode Transaksi Anda" class="required"/>
            </div>
            <div class="ui-field-contain">
                <label for="gambar_bukti">Foto bukti pembayaran :</label>
                <input type="file" name="gambar_bukti" id="gambar_bukti"/>
            </div>
            <button type="submit" class="ui-shadow ui-btn ui-corner-all ui-icon-check ui-btn-icon-left ui-btn-inline ui-mini" name="konfirmasi">Kirim</button>
        </form>
    </div>
    <script type="text/javascript">
        $('#form-konfirmasi').validate({
            messages: {
                kode_transaksi: {
                    required: "Kode konfirmasi harus diisi !!"
                }
            }
        });
    </script>
</div>