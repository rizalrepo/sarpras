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
                <h5 class="modal-title" id="custom-width-modalLabel"><i class="fas fa-toolbox me-2"></i>Detail Data Perbaikan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $q = $con->query("SELECT * FROM baik bk LEFT JOIN rusak r ON bk.id_rusak = r.id_rusak LEFT JOIN sarpras a ON r.id_sarpras = a.id_sarpras LEFT JOIN kategori b ON a.id_kategori = b.id_kategori LEFT JOIN lokasi c ON a.id_lokasi = c.id_lokasi WHERE bk.id_baik = '$id'");
            $d = $q->fetch_array();
            ?>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="card-body text-start">
                            <dl class="row">
                                <dt class="col-sm-3">Tanggal Perbaikan</dt>
                                <dd class="col-sm-9">: <?= tgl($d['tgl_baik']) ?></dd>
                                <dt class="col-sm-3">Tanggal Kerusakan</dt>
                                <dd class="col-sm-9">: <?= tgl($d['tgl_rusak']) ?></dd>
                                <dt class="col-sm-3">Kode sarpras</dt>
                                <dd class="col-sm-9">: <?= $d['kode'] ?></dd>
                                <dt class="col-sm-3">Nama sarpras</dt>
                                <dd class="col-sm-9">: <?= $d['nm_sarpras'] ?></dd>
                                <dt class="col-sm-3">Kategori</dt>
                                <dd class="col-sm-9">: <?= $d['nm_kategori'] ?></dd>
                                <dt class="col-sm-3">Satuan</dt>
                                <dd class="col-sm-9">: <?= $d['satuan'] ?></dd>
                                <dt class="col-sm-3">Tanggal Perolehan</dt>
                                <dd class="col-sm-9">: <?= tgl($d['tgl_sarpras']) ?></dd>
                                <dt class="col-sm-3">Penempatan</dt>
                                <dd class="col-sm-9">: <?= $d['nm_lokasi'] ?></dd>
                                <dt class="col-sm-3">Bukti Kerusakan</dt>
                                <dd class="col-sm-9">:
                                    <a href="<?= base_url('storage/rusak/' . $d['foto_rusak']) ?>" target="_blank" class="btn btn-xs btn-primary"><i class="fas fa-camera me-1"></i>Lihat Bukti</a>
                                </dd>
                                <dt class="col-sm-3">Keterangan Kerusakan</dt>
                                <dd class="col-sm-9">: <?= $d['ket_rusak'] ?></dd>
                                <dt class="col-sm-3">Diperbaiki Oleh</dt>
                                <dd class="col-sm-9">: <?= $d['diperbaiki'] ?></dd>
                                <dt class="col-sm-3">Biaya Perbaikan</dt>
                                <dd class="col-sm-9">: <?= rupiah($d['biaya']) ?></dd>
                                <dt class="col-sm-3">Bukti Perbaikan</dt>
                                <dd class="col-sm-9">:
                                    <a href="<?= base_url('storage/baik/' . $d['foto_baik']) ?>" target="_blank" class="btn btn-xs btn-primary"><i class="fas fa-camera me-1"></i>Lihat Bukti</a>
                                </dd>
                                <dt class="col-sm-3">Keterangan Perbaikan</dt>
                                <dd class="col-sm-9">: <?= $d['ket_baik'] ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->