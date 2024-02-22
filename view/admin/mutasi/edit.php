<?php
require '../../../app/config.php';
$page = 'mutasi';
include_once '../../layout/topbar.php';

$id = $_GET['id'];
$query = $con->query("SELECT * FROM mutasi r LEFT JOIN sarpras a ON r.id_sarpras = a.id_sarpras LEFT JOIN kategori b ON a.id_kategori = b.id_kategori LEFT JOIN lokasi c ON a.id_lokasi = c.id_lokasi WHERE r.id_mutasi = '$id'");
$row = $query->fetch_array();


$lama = $con->query("SELECT * FROM lokasi WHERE id_lokasi = '$row[id_lokasi_lama]' ")->fetch_array();

$lokasiOld = $row['id_lokasi_lama'];
$invOld = $row['id_sarpras'];
?>

<div class="page-content">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="fas fa-building-circle-arrow-right me-2"></i>Edit Data Mutasi Sarana dan Prasarana</h4>

                <div class="page-title-right">
                    <a href="index" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                </div>
            </div>
            <div class="card card-body border border-info">
                <form class="form-horizontal needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Tanggal Mutasi</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tgl_mutasi" value="<?= $row['tgl_mutasi'] ?>" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Sarpras</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" id="inv" value="<?= $row['nm_sarpras'] . ' (' . $row['satuan'] . ')' ?>" readonly required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Kode Sarpras</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" id="kode" value="<?= $row['kode'] ?>" readonly required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Kategori Sarpras</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" id="kategori" value="<?= $row['nm_kategori'] ?>" readonly required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Tanggal Diperoleh</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" id="tgl_sarpras" value="<?= tgl($row['tgl_sarpras']) ?>" readonly required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Penempatan Lama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" id="lokasi" value="<?= $lama['nm_lokasi'] ?>" readonly required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Tujuan Penempatan</label>
                        <div class="col-sm-10">
                            <select name="id_lokasi" class="form-control select2" style="width: 100%;" required>
                                <option value="">-- Pilih --</option>
                                <?php $data = $con->query("SELECT * FROM lokasi ORDER BY id_lokasi ASC"); ?>
                                <?php foreach ($data as $d) :
                                    if ($d['id_lokasi'] == $row['id_lokasi']) { ?>
                                        <option value="<?= $d['id_lokasi']; ?>" selected="<?= $d['id_lokasi']; ?>"><?= $d['nm_lokasi'] ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $d['id_lokasi'] ?>"><?= $d['nm_lokasi'] ?></option>
                                <?php }
                                endforeach ?>
                            </select>
                            <div class="invalid-feedback">Kolom harus di pilih !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="ket_mutasi" required><?= $row['ket_mutasi'] ?></textarea>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mt-4 text-end">
                        <div class="col-sm-12">
                            <button type="reset" class="btn btn-sm btn-danger float-right mr-2"><i class="fa fa-times-circle"></i> Batal</button>
                            <button type="submit" name="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Update</button>
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
    $tgl_mutasi = $_POST['tgl_mutasi'];
    $id_lokasi = $_POST['id_lokasi'];
    $ket_mutasi = $_POST['ket_mutasi'];

    $update = $con->query("UPDATE mutasi SET 
        tgl_mutasi = '$tgl_mutasi',
        id_lokasi = '$id_lokasi',
        ket_mutasi = '$ket_mutasi'
        WHERE id_mutasi = '$id'
    ");

    if ($update) {

        $con->query("UPDATE sarpras SET id_lokasi = '$lokasiOld' WHERE id_sarpras = '$invOld' ");
        $con->query("UPDATE sarpras SET id_lokasi = '$id_lokasi' WHERE id_sarpras = '$invOld' ");

        $_SESSION['pesan'] = "Data Berhasil di Update";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
    } else {
        echo "Data anda gagal diubah. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=edit?id=$id'>";
    }
}

?>