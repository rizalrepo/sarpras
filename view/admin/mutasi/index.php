<?php
require '../../../app/config.php';
$page = 'mutasi';
include_once '../../layout/topbar.php';
?>
<div class="page-content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="fas fa-building-circle-arrow-right me-2"></i>Data Mutasi Sarana dan Prasarana</h4>

                <?php if ($_SESSION['level'] != 3) { ?>
                    <div class="page-title-right">
                        <a href="tambah" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Tambah Data</a>
                    </div>
                <?php } ?>
            </div>

            <div class="card card-body border border-info">

                <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') { ?>
                    <div id="notif" class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <div>
                            <b><?= $_SESSION['pesan'] ?></b>
                        </div>
                    </div>
                <?php $_SESSION['pesan'] = '';
                } ?>

                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover table-striped dataTable">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Tanggal Mutasi</th>
                                <th>Kode</th>
                                <th>Sarpras</th>
                                <th>Mutasi</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            $data = $con->query("SELECT * FROM mutasi a LEFT JOIN lokasi r ON a.id_lokasi = r.id_lokasi LEFT JOIN sarpras b ON a.id_sarpras = b.id_sarpras LEFT JOIN lokasi c ON b.id_lokasi = c.id_lokasi ORDER BY a.id_mutasi DESC");
                            while ($row = $data->fetch_array()) {
                            ?>
                                <tr>
                                    <td align="center" width="5%"><?= $no++ ?></td>
                                    <td align="center"><?= tgl($row['tgl_mutasi']) ?></td>
                                    <td align="center"><?= $row['kode'] ?></td>
                                    <td><?= $row['nm_sarpras'] ?></td>
                                    <td align="center">
                                        <?php
                                        $dt = $con->query("SELECT * FROM lokasi WHERE id_lokasi = '$row[id_lokasi_lama]' ")->fetch_array();
                                        echo $dt['nm_lokasi'];
                                        ?>
                                        <i class="fas fa-right-long ms-1 me-1"></i>
                                        <?= $row['nm_lokasi'] ?>
                                    </td>
                                    <td><?= $row['ket_mutasi'] ?></td>
                                    <td align="center" width="8%">
                                        <a href="edit?id=<?= $row[0] ?>" class="btn btn-info btn-xs text-white" title="Edit" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fa fa-edit"></i></a>
                                        <a href="hapus?id=<?= $row[0] ?>" class="btn btn-danger btn-xs alert-hapus" title="Hapus" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fa fa-trash"></i></a>
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

<?php include_once '../../layout/footer.php'; ?>
<script src="<?= base_url() ?>/app/js/app.js"></script>