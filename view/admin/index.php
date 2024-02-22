<?php
require '../../app/config.php';
$page = 'dashboard';
include_once '../layout/topbar.php';

$a = $con->query("SELECT COUNT(*) AS total FROM sarpras WHERE kondisi != 'Musnah' ")->fetch_array();
$b = $con->query("SELECT COUNT(*) AS total FROM rusak")->fetch_array();
$c = $con->query("SELECT COUNT(*) AS total FROM baik")->fetch_array();
$d = $con->query("SELECT COUNT(*) AS total FROM musnah")->fetch_array();
$e = $con->query("SELECT COUNT(*) AS total FROM mutasi")->fetch_array();
?>
<div class="page-content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="mdi mdi-airplay me-2"></i>Dashboard</h4>

                <div class="page-title-right">
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="col-12">
        <div class="card">
            <div class="card-body text-center">
                <img src="<?= base_url('/assets/images/bg.png') ?>" alt="dashboard" width="60%">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start my-2">
                        <div class="me-3 align-self-center">
                            <div class="avatar-sm font-size-20">
                                <span class="avatar-title bg-soft-info text-info rounded">
                                    <i class="fas fa-building-circle-check"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <h5 class="font-size-16 mb-1">Data Sarana dan Prasarana</h5>
                            <div class="d-flex mt-2">
                                <p class="text-truncate mb-0 me-2"><?= $a['total'] ?> Data</p>
                                <a href="<?= base_url() ?>/view/admin/sarpras/" class="btn btn-xs rounded-3 btn-primary fw-bold"><i class="fas fa-link me-1"></i>Lihat Data</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start my-2">
                        <div class="me-3 align-self-center">
                            <div class="avatar-sm font-size-20">
                                <span class="avatar-title bg-soft-info text-info rounded">
                                    <i class="fas fa-burst"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <h5 class="font-size-16 mb-1">Data Kerusakan Sarana dan Prasarana</h5>
                            <div class="d-flex mt-2">
                                <p class="text-truncate mb-0 me-2"><?= $b['total'] ?> Data</p>
                                <a href="<?= base_url() ?>/view/admin/rusak/" class="btn btn-xs rounded-3 btn-primary fw-bold"><i class="fas fa-link me-1"></i>Lihat Data</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start my-2">
                        <div class="me-3 align-self-center">
                            <div class="avatar-sm font-size-20">
                                <span class="avatar-title bg-soft-info text-info rounded">
                                    <i class="fas fa-toolbox"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <h5 class="font-size-16 mb-1">Data Perbaikan Sarana dan Prasarana</h5>
                            <div class="d-flex mt-2">
                                <p class="text-truncate mb-0 me-2"><?= $c['total'] ?> Data</p>
                                <a href="<?= base_url() ?>/view/admin/baik/" class="btn btn-xs rounded-3 btn-primary fw-bold"><i class="fas fa-link me-1"></i>Lihat Data</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start my-2">
                        <div class="me-3 align-self-center">
                            <div class="avatar-sm font-size-20">
                                <span class="avatar-title bg-soft-info text-info rounded">
                                    <i class="fas fa-house-fire"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <h5 class="font-size-16 mb-1">Data Mutasi Sarana dan Prasarana</h5>
                            <div class="d-flex mt-2">
                                <p class="text-truncate mb-0 me-2"><?= $e['total'] ?> Data</p>
                                <a href="<?= base_url() ?>/view/admin/mutasi/" class="btn btn-xs rounded-3 btn-primary fw-bold"><i class="fas fa-link me-1"></i>Lihat Data</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start my-2">
                        <div class="me-3 align-self-center">
                            <div class="avatar-sm font-size-20">
                                <span class="avatar-title bg-soft-info text-info rounded">
                                    <i class="fas fa-house-fire"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <h5 class="font-size-16 mb-1">Data Pemusnahan Sarana dan Prasarana</h5>
                            <div class="d-flex mt-2">
                                <p class="text-truncate mb-0 me-2"><?= $d['total'] ?> Data</p>
                                <a href="<?= base_url() ?>/view/admin/musnah/" class="btn btn-xs rounded-3 btn-primary fw-bold"><i class="fas fa-link me-1"></i>Lihat Data</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
</div>
<!-- End Page-content -->

<?php include_once '../layout/footer.php'; ?>
<script src="<?= base_url() ?>/app/js/app2.js"></script>