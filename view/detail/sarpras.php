<?php
require '../../../app/configtables.php';
$con = mysqli_connect($con['host'], $con['user'], $con['pass'], $con['db']);
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
}
?>

<div id="id<?= $id = $row[0]; ?>" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="custom-width-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="custom-width-modalLabel"><i class="fas fa-building-circle-check me-2"></i>Detail Data Sarana Dan Prasarana</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $q = $con->query("SELECT * FROM sarpras a LEFT JOIN kategori b ON a.id_kategori = b.id_kategori LEFT JOIN lokasi c ON a.id_lokasi = c.id_lokasi WHERE a.id_sarpras = '$id'");
            $d = $q->fetch_array();
            ?>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="card-body text-start">
                            <dl class="row">
                                <dt class="col-sm-3">Kode</dt>
                                <dd class="col-sm-9">: <?= $d['kode'] ?></dd>
                                <dt class="col-sm-3">Nama Sarpras</dt>
                                <dd class="col-sm-9">: <?= $d['nm_sarpras'] ?></dd>
                                <dt class="col-sm-3">Kategori</dt>
                                <dd class="col-sm-9">: <?= $d['nm_kategori'] ?></dd>
                                <dt class="col-sm-3">Satuan</dt>
                                <dd class="col-sm-9">: <?= $d['satuan'] ?></dd>
                                <dt class="col-sm-3">Tanggal Perolehan</dt>
                                <dd class="col-sm-9">: <?= tgl($d['tgl_sarpras']) ?></dd>
                                <dt class="col-sm-3">Lokas Penempatan</dt>
                                <dd class="col-sm-9">: <?= $d['nm_lokasi'] ?></dd>
                                <dt class="col-sm-3">Kondisi</dt>
                                <dd class="col-sm-9">:
                                    <?php
                                    if ($d['kondisi'] === 'Baik') {
                                        echo '<span class="badge bg-success p-1"><i class="fas fa-check-circle me-1"></i>' . $d['kondisi'] . '</span>';
                                    } else if ($d['kondisi'] === 'Rusak') {
                                        echo '<span class="badge bg-warning p-1"><i class="fa-solid fa-triangle-exclamation me-1"></i>' . $d['kondisi'] . '</span>';
                                    } else if ($d['kondisi'] === 'Musnah') {
                                        echo '<span class="badge bg-danger p-1"><i class="fa-solid fa-times-circle me-1"></i>' . $d['kondisi'] . '</span>';
                                    }
                                    ?>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->