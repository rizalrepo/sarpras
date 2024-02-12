<?php
require '../../../app/config.php';
$page = 'musnah';
include_once '../../layout/topbar.php';

$id = $_GET['id'];
$query = $con->query("SELECT * FROM musnah r LEFT JOIN sarpras a ON r.id_sarpras = a.id_sarpras LEFT JOIN kategori b ON a.id_kategori = b.id_kategori LEFT JOIN lokasi c ON a.id_lokasi = c.id_lokasi WHERE r.id_musnah = '$id'");
$row = $query->fetch_array();

$kondisiLama = $row['kondisi_lama'];
$invOld = $row['id_sarpras'];
?>

<div class="page-content">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="fas fa-house-fire me-2"></i>Edit Data Pemusnahan Sarana dan Prasarana</h4>

                <div class="page-title-right">
                    <a href="index" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                </div>
            </div>
            <div class="card card-body border border-info">
                <form class="form-horizontal needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Tanggal Pemusnahan</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tgl_musnah" value="<?= $row['tgl_musnah'] ?>" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Pilih Sarpras</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="hidden" name="id_sarpras" id="id_sarpras" value="<?= $row['id_sarpras'] ?>" required>
                                <input type="text" class="form-control bg-light" id="inv" value="<?= $row['nm_sarpras'] . ' (' . $row['satuan'] . ')' ?>" required readonly>
                                <span class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-sarpras"><i class="fas fa-search"></i></span>
                            </div>
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
                        <label class="col-sm-2 col-form-label">Penempatan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" id="lokasi" value="<?= $row['nm_lokasi'] ?>" readonly required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Kondisi Sebelumnya</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" id="kondisi_lama" name="kondisi_lama" value="<?= $row['kondisi_lama'] ?>" readonly required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="ket_musnah" required><?= $row['ket_musnah'] ?></textarea>
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
                                            <th>Sarpras</th>
                                            <th>Kategori</th>
                                            <th>Tanggal</th>
                                            <th>Penempatan</th>
                                            <th>Kondisi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $con->query("SELECT * FROM sarpras a LEFT JOIN kategori b ON a.id_kategori = b.id_kategori LEFT JOIN lokasi c ON a.id_lokasi = c.id_lokasi WHERE a.kondisi != 'Musnah' OR a.id_sarpras = '$row[id_sarpras]' ORDER BY a.id_sarpras DESC");
                                        while ($row = $data->fetch_array()) {
                                        ?>
                                            <tr>
                                                <td align="center" width="5%"><?= $no++ ?></td>
                                                <td align="center"><?= $row['kode'] ?></td>
                                                <td><?= $row['nm_sarpras'] ?></td>
                                                <td align="center"><?= $row['nm_kategori'] ?></td>
                                                <td align="center"><?= tgl($row['tgl_sarpras']) ?></td>
                                                <td align="center"><?= $row['nm_lokasi'] ?></td>
                                                <td align="center">
                                                    <?php
                                                    if ($row['kondisi'] === 'Baik') {
                                                        echo '<span class="badge bg-success p-1"><i class="fas fa-check-circle me-1"></i>' . $row['kondisi'] . '</span>';
                                                    } else if ($row['kondisi'] === 'Rusak') {
                                                        echo '<span class="badge bg-warning p-1"><i class="fa-solid fa-triangle-exclamation me-1"></i>' . $row['kondisi'] . '</span>';
                                                    } else if ($row['kondisi'] === 'Musnah') {
                                                        echo '<span class="badge bg-danger p-1"><i class="fa-solid fa-times-circle me-1"></i>' . $row['kondisi'] . '</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td align="center" width="12%">
                                                    <span data-bs-toggle="tooltip" title="Pilih sarpras" data-bs-placement="top">
                                                        <span id="select" class="btn btn-success btn-xs text-white" data-id_sarpras="<?= $row['id_sarpras'] ?>" data-kode="<?= $row['kode'] ?>" data-inv="<?= $row['nm_sarpras'] . ' (' . $row['satuan'] . ')' ?>" data-kategori="<?= $row['nm_kategori'] ?>" data-tgl_sarpras="<?= tgl($row['tgl_sarpras']) ?>" data-lokasi="<?= $row['nm_lokasi'] ?>" data-kondisi_lama="<?= $row['kondisi'] ?>"><i class="fa fa-info-circle me-1"></i>Pilih</span>
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
            var lokasi = $(this).data('lokasi');
            var kondisi_lama = $(this).data('kondisi_lama');
            $('#id_sarpras').val(id_sarpras);
            $('#inv').val(inv);
            $('#kode').val(kode);
            $('#kategori').val(kategori);
            $('#tgl_sarpras').val(tgl_sarpras);
            $('#lokasi').val(lokasi);
            $('#kondisi_lama').val(kondisi_lama);
            $('#modal-sarpras').modal('hide');
        });
    });
</script>

<?php
if (isset($_POST['submit'])) {
    $tgl_musnah = $_POST['tgl_musnah'];
    $id_sarpras = $_POST['id_sarpras'];
    $kondisi_lama = $_POST['kondisi_lama'];
    $ket_musnah = $_POST['ket_musnah'];

    $update = $con->query("UPDATE musnah SET 
        tgl_musnah = '$tgl_musnah',
        id_sarpras = '$id_sarpras',
        kondisi_lama = '$kondisi_lama',
        ket_musnah = '$ket_musnah'
        WHERE id_musnah = '$id'
    ");

    if ($update) {

        $con->query("UPDATE sarpras SET kondisi = '$kondisiLama' WHERE id_sarpras = '$invOld' ");
        $con->query("UPDATE sarpras SET kondisi = 'Musnah' WHERE id_sarpras = '$id_sarpras' ");

        $_SESSION['pesan'] = "Data Berhasil di Update";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
    } else {
        echo "Data anda gagal diubah. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=edit?id=$id'>";
    }
}

?>