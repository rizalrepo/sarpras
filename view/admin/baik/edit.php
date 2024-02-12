<?php
require '../../../app/config.php';
$page = 'baik';
include_once '../../layout/topbar.php';

$id = $_GET['id'];
$query = $con->query("SELECT * FROM baik bk LEFT JOIN rusak r ON bk.id_rusak = r.id_rusak LEFT JOIN sarpras a ON r.id_sarpras = a.id_sarpras LEFT JOIN kategori b ON a.id_kategori = b.id_kategori LEFT JOIN lokasi c ON a.id_lokasi = c.id_lokasi WHERE bk.id_baik = '$id'");
$row = $query->fetch_array();

$fotoOld = $row['foto_baik'];
$rusakOld = $row['id_rusak'];
?>

<div class="page-content">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="fas fa-toolbox me-2"></i>Edit Data Perbaikan Sarana dan Prasarana</h4>

                <div class="page-title-right">
                    <a href="index" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                </div>
            </div>
            <div class="card card-body border border-info">
                <form class="form-horizontal needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Tanggal Perbaikan</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tgl_baik" value="<?= $row['tgl_baik'] ?>" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Pilih Sarpras</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="hidden" name="id_rusak" id="id_rusak" value="<?= $row['id_rusak'] ?>" required>
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
                        <label class="col-sm-2 col-form-label">Diperbaiki Oleh</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="diperbaiki" value="<?= $row['diperbaiki'] ?>" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Biaya Perbaikan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control rupiah" name="biaya" value="<?= rupiah($row['biaya']) ?>" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Bukti Perbaikan</label>
                        <div class="col-sm-10">
                            <input type="file" accept="image/*" class="form-control" name="foto_baik">
                            <label style='color: red; font-style: italic; font-size: 12px;'>* Kosongkan jika tidak ingin mengubah foto .* File harus berupa Gambar dan Ukuran file maksimal 2MB</label>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="ket_baik" required><?= $row['ket_baik'] ?></textarea>
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
                                            <th>Tanggal Kerusakan</th>
                                            <th>Kode</th>
                                            <th>Sarpras</th>
                                            <th>Kategori</th>
                                            <th>Penempatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $con->query("SELECT * FROM rusak r LEFT JOIN sarpras a ON r.id_sarpras = a.id_sarpras LEFT JOIN kategori b ON a.id_kategori = b.id_kategori LEFT JOIN lokasi c ON a.id_lokasi = c.id_lokasi WHERE a.kondisi = 'Rusak' OR a.id_sarpras = '$row[id_sarpras]' ORDER BY r.id_rusak DESC");
                                        while ($row = $data->fetch_array()) {
                                        ?>
                                            <tr>
                                                <td align="center" width="5%"><?= $no++ ?></td>
                                                <td align="center"><?= tgl($row['tgl_rusak']) ?></td>
                                                <td align="center"><?= $row['kode'] ?></td>
                                                <td><?= $row['nm_sarpras'] ?></td>
                                                <td align="center"><?= $row['nm_kategori'] ?></td>
                                                <td align="center"><?= $row['nm_lokasi'] ?></td>
                                                <td align="center" width="12%">
                                                    <span data-bs-toggle="tooltip" title="Pilih sarpras" data-bs-placement="top">
                                                        <span id="select" class="btn btn-success btn-xs text-white" data-id_rusak="<?= $row['id_rusak'] ?>" data-kode="<?= $row['kode'] ?>" data-inv="<?= $row['nm_sarpras'] . ' (' . $row['satuan'] . ')' ?>" data-kategori="<?= $row['nm_kategori'] ?>" data-tgl_sarpras="<?= tgl($row['tgl_sarpras']) ?>" data-lokasi="<?= $row['nm_lokasi'] ?>"><i class="fa fa-info-circle me-1"></i>Pilih</span>
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
            var id_rusak = $(this).data('id_rusak');
            var inv = $(this).data('inv');
            var kode = $(this).data('kode');
            var kategori = $(this).data('kategori');
            var tgl_sarpras = $(this).data('tgl_sarpras');
            var lokasi = $(this).data('lokasi');
            $('#id_rusak').val(id_rusak);
            $('#inv').val(inv);
            $('#kode').val(kode);
            $('#kategori').val(kategori);
            $('#tgl_sarpras').val(tgl_sarpras);
            $('#lokasi').val(lokasi);
            $('#modal-sarpras').modal('hide');
        });
    });
</script>

<?php
if (isset($_POST['submit'])) {
    $tgl_baik = $_POST['tgl_baik'];
    $id_rusak = $_POST['id_rusak'];
    $diperbaiki = $_POST['diperbaiki'];
    $biaya = preg_replace("/[^0-9]/", '', $_POST['biaya']);
    $ket_baik = $_POST['ket_baik'];

    $f_foto_baik = "";

    if (!empty($_FILES['foto_baik']['name'])) {
        // UPLOAD FILE 
        $file      = $_FILES['foto_baik']['name'];
        $x_file    = explode('.', $file);
        $ext_file  = end($x_file);
        $foto_baik = rand(1, 99999) . '.' . $ext_file;
        $size_file = $_FILES['foto_baik']['size'];
        $tmp_file  = $_FILES['foto_baik']['tmp_name'];
        $dir_file  = '../../../storage/baik/';
        $allow_ext        = array('jpg', 'jpeg', 'png', 'webp', 'gif');
        $allow_size       = 2097152;
        // var_dump($foto_baik); die();

        if (in_array($ext_file, $allow_ext) === true) {
            if ($size_file <= $allow_size) {
                move_uploaded_file($tmp_file, $dir_file . $foto_baik);
                if (file_exists($dir_file . $fotoOld)) {
                    unlink($dir_file . $fotoOld);
                }
                $f_foto_baik .= "Upload Success";
            } else {
                echo "
                <script type='text/javascript'>
                    setTimeout(function () {    
                        Swal.fire({
                            title: '',
                            text:  'Ukuran File Terlalu Besar, Maksimal 2 Mb',
                            icon: 'error',
                            timer: 3000,
                            showConfirmButton: true
                        });     
                    },10);   
                    window.setTimeout(function(){ 
                        window.location.replace('edit?id=$id');
                    } ,2000); 
                </script>";
            }
        } else {
            echo "
            <script type='text/javascript'>
                setTimeout(function () {    
                    Swal.fire({
                        title: 'Format File Tidak Didukung',
                        text:  'File Harus Berupa Gambar',
                        icon: 'error',
                        timer: 3000,
                        showConfirmButton: true
                    });     
                },10);  
                window.setTimeout(function(){ 
                    window.location.replace('edit?id=$id');
                } ,2000);  
            </script>";
        }
    } else {
        $foto_baik = $fotoOld;
        $f_foto_baik .= "Upload Success!";
    }

    if (!empty($f_foto_baik)) {
        $update = $con->query("UPDATE baik SET 
            tgl_baik = '$tgl_baik',
            id_rusak = '$id_rusak',
            diperbaiki = '$diperbaiki',
            biaya = '$biaya',
            foto_baik = '$foto_baik',
            ket_baik = '$ket_baik'
            WHERE id_baik = '$id'
        ");

        if ($update) {

            $data = $con->query("SELECT * FROM rusak WHERE id_rusak = '$rusakOld'")->fetch_array();
            $con->query("UPDATE sarpras SET kondisi = 'Rusak' WHERE id_sarpras = '$data[id_sarpras]' ");

            $dt = $con->query("SELECT * FROM rusak WHERE id_rusak = '$id_rusak'")->fetch_array();
            $con->query("UPDATE sarpras SET kondisi = 'Baik' WHERE id_sarpras = '$dt[id_sarpras]' ");

            $_SESSION['pesan'] = "Data Berhasil di Update";
            echo "<meta http-equiv='refresh' content='0; url=index'>";
        } else {
            echo "Data anda gagal diubah. Ulangi sekali lagi";
            echo "<meta http-equiv='refresh' content='0; url=edit?id=$id'>";
        }
    }
}

?>