<?php
require '../../../app/config.php';
$page = 'mutasi';
include_once '../../layout/topbar.php';
?>

<div class="page-content">
    <div class="row">

        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="fas fa-building-circle-arrow-right me-2"></i>Tambah Data Mutasi Sarana dan Prasarana</h4>

                <div class="page-title-right">
                    <a href="index" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                </div>
            </div>

            <div class="card card-body border border-info">
                <form class="form-horizontal needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Tanggal Mutasi</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tgl_mutasi" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Pilih Sarpras</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="hidden" name="id_sarpras" id="id_sarpras" required>
                                <input type="text" class="form-control bg-light" id="inv" required readonly>
                                <span class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-sarpras"><i class="fas fa-search"></i></span>
                            </div>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Kode Sarpras</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" id="kode" readonly required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Kategori Sarpras</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" id="kategori" readonly required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Tanggal Diperoleh</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" id="tgl_sarpras" readonly required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Penempatan Lama</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="id_lokasi_lama" id="id_lokasi_lama" required>
                            <input type="text" class="form-control bg-light" id="lokasi" readonly required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Tujuan Penempatan</label>
                        <div class="col-sm-10">
                            <select name="id_lokasi" class="form-select select2" style="width: 100%;" required>
                                <option value="">-- Pilih --</option>
                                <?php $data = $con->query("SELECT * FROM lokasi ORDER BY id_lokasi DESC"); ?>
                                <?php foreach ($data as $row) : ?>
                                    <option value="<?= $row['id_lokasi'] ?>"><?= $row['nm_lokasi'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">Kolom harus di pilih !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="ket_mutasi" required></textarea>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mt-4 text-end">
                        <div class="col-sm-12">
                            <button type="reset" class="btn btn-sm btn-danger float-right mr-2"><i class="fa fa-times-circle"></i> Batal</button>
                            <button type="submit" name="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- row  -->
</div>

<div id="modal-sarpras" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="custom-width-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="custom-width-modalLabel"><i class="fas fa-building-circle-check me-2"></i>Data Sarana dan Prasarana</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="card-body text-start">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-hover table-striped dataTable">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>sarpras</th>
                                            <th>Kategori</th>
                                            <th>Tanggal</th>
                                            <th>Penempatan Lama</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $con->query("SELECT * FROM sarpras a LEFT JOIN kategori b ON a.id_kategori = b.id_kategori LEFT JOIN lokasi c ON a.id_lokasi = c.id_lokasi WHERE a.kondisi != 'Musnah' ORDER BY a.id_sarpras DESC");
                                        while ($row = $data->fetch_array()) {
                                        ?>
                                            <tr>
                                                <td align="center" width="5%"><?= $no++ ?></td>
                                                <td align="center"><?= $row['kode'] ?></td>
                                                <td><?= $row['nm_sarpras'] ?></td>
                                                <td align="center"><?= $row['nm_kategori'] ?></td>
                                                <td align="center"><?= tgl($row['tgl_sarpras']) ?></td>
                                                <td align="center"><?= $row['nm_lokasi'] ?></td>
                                                <td align="center" width="12%">
                                                    <span data-bs-toggle="tooltip" title="Pilih Sarpras" data-bs-placement="top">
                                                        <span id="select" class="btn btn-success btn-xs text-white" data-id_sarpras="<?= $row['id_sarpras'] ?>" data-id_lokasi_lama="<?= $row['id_lokasi'] ?>" data-kode="<?= $row['kode'] ?>" data-inv="<?= $row['nm_sarpras'] . ' (' . $row['satuan'] . ')' ?>" data-kategori="<?= $row['nm_kategori'] ?>" data-tgl_sarpras="<?= tgl($row['tgl_sarpras']) ?>" data-lokasi="<?= $row['nm_lokasi'] ?>"><i class="fa fa-info-circle me-1"></i>Pilih</span>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php
include_once '../../layout/footer.php';
?>
<script src="<?= base_url() ?>/app/js/app.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '#select', function() {
            var id_sarpras = $(this).data('id_sarpras');
            var inv = $(this).data('inv');
            var kode = $(this).data('kode');
            var kategori = $(this).data('kategori');
            var tgl_sarpras = $(this).data('tgl_sarpras');
            var id_lokasi_lama = $(this).data('id_lokasi_lama');
            var lokasi = $(this).data('lokasi');
            $('#id_sarpras').val(id_sarpras);
            $('#inv').val(inv);
            $('#kode').val(kode);
            $('#kategori').val(kategori);
            $('#tgl_sarpras').val(tgl_sarpras);
            $('#id_lokasi_lama').val(id_lokasi_lama);
            $('#lokasi').val(lokasi);
            $('#modal-sarpras').modal('hide');
        });
    });
</script>
<?php

if (isset($_POST['submit'])) {

    $tgl_mutasi = $_POST['tgl_mutasi'];
    $id_sarpras = $_POST['id_sarpras'];
    $id_lokasi_lama = $_POST['id_lokasi_lama'];
    $id_lokasi = $_POST['id_lokasi'];
    $ket_mutasi = $_POST['ket_mutasi'];

    $tambah = $con->query("INSERT INTO mutasi VALUES (
        default, 
        '$tgl_mutasi', 
        '$id_sarpras', 
        '$id_lokasi_lama', 
        '$id_lokasi', 
        '$ket_mutasi'
    )");

    if ($tambah) {

        $con->query("UPDATE sarpras SET id_lokasi = '$id_lokasi' WHERE id_sarpras = '$id_sarpras' ");

        $_SESSION['pesan'] = "Data Berhasil di Simpan";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
    } else {
        echo "Data anda gagal disimpan. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=tambah'>";
    }
}

?>