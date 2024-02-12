<?php
include '../../app/config.php';

$no = 1;

$lokasi = $_GET['lokasi'];
$kondisi = $_GET['kondisi'];

$ceklokasi = isset($lokasi);
$cekkondisi = isset($kondisi);

if ($lokasi == $ceklokasi && $kondisi == null) {
    $sql = $con->query("SELECT * FROM sarpras a LEFT JOIN lokasi b ON a.id_lokasi = b.id_lokasi LEFT JOIN kategori c ON a.id_kategori = c.id_kategori WHERE a.id_lokasi = '$lokasi' ORDER BY id_sarpras DESC");

    $dt = $con->query("SELECT * FROM lokasi WHERE id_lokasi = '$lokasi'")->fetch_array();
    $label = 'LAPORAN SARANA DAN PRASARANA <br> Lokasi Penempatan : ' . $dt['nm_lokasi'];
} else if ($kondisi == $cekkondisi && $lokasi == null) {
    $sql = $con->query("SELECT * FROM sarpras a LEFT JOIN lokasi b ON a.id_lokasi = b.id_lokasi LEFT JOIN kategori c ON a.id_kategori = c.id_kategori WHERE a.kondisi = '$kondisi' ORDER BY id_sarpras DESC");

    $label = 'LAPORAN SARANA DAN PRASARANA <br> Kondisi Sarana dan Prasarana : ' . $kondisi;
} else if ($lokasi == $ceklokasi && $kondisi == $cekkondisi) {
    $sql = $con->query("SELECT * FROM sarpras a LEFT JOIN lokasi b ON a.id_lokasi = b.id_lokasi LEFT JOIN kategori c ON a.id_kategori = c.id_kategori WHERE a.id_lokasi = '$lokasi' AND a.kondisi = '$kondisi' ORDER BY id_sarpras DESC");

    $dt1 = $con->query("SELECT * FROM lokasi WHERE id_lokasi = '$lokasi'")->fetch_array();
    $label = 'LAPORAN SARANA DAN PRASARANA <br> Lokasi Penempatan : ' . $dt1['nm_lokasi'] . '<br> Kondisi sarpras : ' . $kondisi;
} else {
    $sql = $con->query("SELECT * FROM sarpras a LEFT JOIN lokasi b ON a.id_lokasi = b.id_lokasi LEFT JOIN kategori c ON a.id_kategori = c.id_kategori ORDER BY id_sarpras DESC");
    $label = 'LAPORAN SARANA DAN PRASARANA';
}

require_once '../../assets/libs/mpdf/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [380, 215]]);
ob_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Sarana dan Prasarana</title>
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
                            <th>Kode</th>
                            <th>Sarpras</th>
                            <th>Satuan</th>
                            <th>Kategori</th>
                            <th>Tanggal Perolehan</th>
                            <th>Penempatan</th>
                            <th>Kondisi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) { ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td align="center"><?= $data['kode'] ?></td>
                                <td><?= $data['nm_sarpras'] ?></td>
                                <td align="center"><?= $data['satuan'] ?></td>
                                <td align="center"><?= $data['nm_kategori'] ?></td>
                                <td align="center"><?= tgl($data['tgl_sarpras']) ?></td>
                                <td align="center"><?= $data['nm_lokasi'] ?></td>
                                <td align="center"><?= $data['kondisi'] ?></td>
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