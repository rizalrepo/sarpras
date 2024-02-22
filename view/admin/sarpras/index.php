<?php
require '../../../app/config.php';
$page = 'sarpras';
include_once '../../layout/topbar.php';
?>
<div class="page-content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="fas fa-building-circle-check me-2"></i>Data Sarana Dan Prasarana</h4>

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
                                <th>Kode</th>
                                <th>Sarana Dan Prasarana</th>
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
                            $data = $con->query("SELECT * FROM sarpras a LEFT JOIN kategori b ON a.id_kategori = b.id_kategori LEFT JOIN lokasi c ON a.id_lokasi = c.id_lokasi ORDER BY a.id_sarpras DESC");
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
                                        <span data-bs-toggle="tooltip" title="Detail" data-bs-placement="top">
                                            <span data-bs-target="#id<?= $row[0]; ?>" data-bs-toggle="modal" class="btn btn-success btn-xs text-white" title="Detail"><i class="fa fa-info-circle"></i></span>
                                        </span>
                                        <?php if ($row['kondisi'] !== 'Musnah') {  ?>
                                            <a href="edit?id=<?= $row[0] ?>" class="btn btn-info btn-xs text-white" title="Edit" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fa fa-edit"></i></a>
                                            <a href="hapus?id=<?= $row[0] ?>" class="btn btn-danger btn-xs alert-hapus" title="Hapus" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fa fa-trash"></i></a>
                                        <?php } ?>
                                        <?php include('../../detail/sarpras.php'); ?>
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