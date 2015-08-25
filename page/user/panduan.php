
<div class="ui-content" data-role="main">
    <div style="text-align: center">
        <h3>Panduan</h3>
    </div>
    <div style="text-align: left">
        <?php
        include_once '../model/panduan_belanja_model.php';

        $pdao = new PanduanBelanjaDaoImpl();
        $listPanduan = $pdao->findAll();
        $no = 1;
        for ($i = 0; $i < count($listPanduan); $i++) {
            $p = $listPanduan[$i];
            $id = $p->getId();
            $panduan = $p->getPanduan();
            ?>
            <p><?php echo $no.". ".$panduan;?></p>
            <?php
            $no++;
        }
        ?>
    </div>
</div>

