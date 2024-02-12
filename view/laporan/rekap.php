<?php
include '../../app/config.php';

$no = 1;

$sql = $con->query("SELECT c.id_kategori, c.nm_kategori, COUNT(a.id_sarpras) AS jumlah_sarpras FROM sarpras a LEFT JOIN kategori c ON a.id_kategori = c.id_kategori GROUP BY c.id_kategori ORDER BY c.id_kategori");


$label = 'REKAPITULASI SARANA DAN PRASARANA';

require_once '../../assets/libs/mpdf/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [380, 215]]);
ob_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Rekapitulasi Sarana dan Prasarana</title>
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

    <?php while ($row = $sql->fetch_array()) { ?>
        <table border="1" cellspacing="0" cellpadding="6" width="100%">
            <tr bgcolor="#F9C734">
                <td colspan="8">
                    <h5>Rekapitulasi Sarana dan Prasarana Kategori <?= $row['nm_kategori'] ?> : <b><?= $row['jumlah_sarpras'] ?></b> Data</h5>
                </td>
            </tr>
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
                <?php
                $qry = $con->query("SELECT * FROM sarpras a LEFT JOIN lokasi b ON a.id_lokasi = b.id_lokasi LEFT JOIN kategori c ON a.id_kategori = c.id_kategori WHERE a.id_kategori = '$row[id_kategori]' ORDER BY id_sarpras DESC");
                while ($data = $qry->fetch_array()) {
                ?>
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
                <?php $no = 1; ?>
            </tbody>
        </table>
        <br>
        <br>
    <?php } ?>

    <br>
    <br>

    <br>
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
</body>

</html>
<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output();
?>