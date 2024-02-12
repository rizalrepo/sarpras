<?php
include '../../app/config.php';

$no = 1;

$tgl1 = $_GET['tgl1'];
$tgl2 = $_GET['tgl2'];

$cektgl1 = isset($tgl1);
$cektgl2 = isset($tgl2);

if ($tgl1 == $cektgl1 && $tgl2 == $cektgl2) {
    $sql = $con->query("SELECT * FROM rusak r LEFT JOIN sarpras a ON r.id_sarpras = a.id_sarpras LEFT JOIN lokasi b ON a.id_lokasi = b.id_lokasi LEFT JOIN kategori c ON a.id_kategori = c.id_kategori WHERE r.tgl_rusak BETWEEN '$tgl1' AND '$tgl2' ORDER BY r.tgl_rusak ASC");

    $label = 'LAPORAN KERUSAKAN SARANA DAN PRASARANA <br> Tanggal Kerusakan : ' . tgl($tgl1) . ' s/d ' . tgl($tgl2);
} else {
    $sql = $con->query("SELECT * FROM rusak r LEFT JOIN sarpras a ON r.id_sarpras = a.id_sarpras LEFT JOIN lokasi b ON a.id_lokasi = b.id_lokasi LEFT JOIN kategori c ON a.id_kategori = c.id_kategori ORDER BY id_rusak DESC");
    $label = 'LAPORAN KERUSAKAN SARANA DAN PRASARANA';
}

require_once '../../assets/libs/mpdf/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [380, 215]]);
ob_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Kerusakan Sarana dan Prasarana</title>
</head>

<style>
    th {
        color: white;
    }
</style>

<body>
    <div class="table-responsive">
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td align="center">
                    <img src="<?= base_url('assets/images/logo.png') ?>" align="left" width="100">
                </td>
                <td align="center">
                    <h1>INDOMARET A. YANI KM 29</h1>
                    <h6>Jl. A. Yani No.Km.29, Guntung Payung, Kec. Landasan Ulin, Kota Banjarbaru, Kalimantan Selatan 70721</h6>
                </td>
                <td align="center">
                    <img src="<?= base_url('assets/images/pelengkap.png') ?>" align="right" width="100">
                </td>
            </tr>
        </table>
    </div>
    <hr color="black" style="margin-top: -5px;">

    <h4 align="center">
        <?= $label ?><br>
    </h4>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <table border="1" cellspacing="0" cellpadding="6" width="100%">
                    <thead>
                        <tr bgcolor="#0CAADC" align="center">
                            <th>No</th>
                            <th>Tanggal Kerusakan</th>
                            <th>Kode</th>
                            <th>Sarpras</th>
                            <th>Satuan</th>
                            <th>Kategori</th>
                            <th>Tanggal Perolehan</th>
                            <th>Penempatan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) { ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td align="center"><?= tgl($data['tgl_rusak']) ?></td>
                                <td align="center"><?= $data['kode'] ?></td>
                                <td><?= $data['nm_sarpras'] ?></td>
                                <td align="center"><?= $data['satuan'] ?></td>
                                <td align="center"><?= $data['nm_kategori'] ?></td>
                                <td align="center"><?= tgl($data['tgl_sarpras']) ?></td>
                                <td align="center"><?= $data['nm_lokasi'] ?></td>
                                <td><?= $data['ket_rusak'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <br>
    <br>

    <br>
    <div class="table-responsive">
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td align="center" width="80%">
                </td>
                <td align="center">
                    <h6>
                        Banjarbaru, <?= tgl(date('Y-m-d')) ?><br>
                        Kepala Toko
                        <br><br><br><br><br><br><br>
                        <hr style="margin-top: 0; margin-bottom: 0;">
                    </h6>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output();
?>