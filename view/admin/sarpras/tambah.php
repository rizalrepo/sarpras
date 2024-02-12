<?php
require '../../../app/config.php';
$page = 'sarpras';
include_once '../../layout/topbar.php';

$cek_result = $con->query("SELECT max(kode) AS kode FROM sarpras");

if ($cek_result) {
    $cek = $cek_result->fetch_array();

    if ($cek['kode'] !== null) {
        $nourut = (int) substr($cek['kode'], 5, 6);
        $nourut++;
    } else {
        $nourut = 1;
    }

    $a = "SRP";
    $num = $a . sprintf('%06s', $nourut);
} else {
    echo "Error executing query: " . $con->error;
}
?>

<div class="page-content">
    <div class="row">

        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="fas fa-building-circle-check me-2"></i>Tambah Data Sarana Dan Prasarana</h4>

                <div class="page-title-right">
                    <a href="index" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                </div>
            </div>

            <div class="card card-body border border-info">
                <form class="form-horizontal needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Kode Sarpras</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" value="<?= $num ?>" readonly>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Sarpras</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nm_sarpras" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Kategori Sarpras</label>
                        <div class="col-sm-10">
                            <select name="id_kategori" class="form-select select2" style="width: 100%;" required>
                                <option value="">-- Pilih --</option>
                                <?php $data = $con->query("SELECT * FROM kategori ORDER BY id_kategori DESC"); ?>
                                <?php foreach ($data as $row) : ?>
                                    <option value="<?= $row['id_kategori'] ?>"><?= $row['nm_kategori'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">Kolom harus di pilih !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Satuan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="satuan" required placeholder="Unit / Set / Pcs dll">
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Tanggal Perolehan</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tgl_sarpras" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Lokasi Penempatan</label>
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
                        <label class="col-sm-2 col-form-label">Kondisi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" value="Baik" readonly>
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


<?php
include_once '../../layout/footer.php';
?>
<script src="<?= base_url() ?>/app/js/app.js"></script>
<?php

if (isset($_POST['submit'])) {
    $nm_sarpras = $_POST['nm_sarpras'];
    $id_kategori = $_POST['id_kategori'];
    $satuan = $_POST['satuan'];
    $tgl_sarpras = $_POST['tgl_sarpras'];
    $id_lokasi = $_POST['id_lokasi'];

    $tambah = $con->query("INSERT INTO sarpras VALUES (
        default, 
        '$num', 
        '$nm_sarpras', 
        '$id_kategori', 
        '$satuan', 
        '$tgl_sarpras', 
        '$id_lokasi',
        'Baik'
    )");

    if ($tambah) {
        $_SESSION['pesan'] = "Data Berhasil di Simpan";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
    } else {
        echo "Data anda gagal disimpan. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=tambah'>";
    }
}

?>