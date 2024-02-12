<?php
require '../../../app/config.php';
include_once '../../layout/topbar.php';
include_once '../../layout/footer.php';

$id = $_GET['id'];
$data  = $con->query("SELECT * FROM rusak WHERE id_rusak = '$id'")->fetch_array();
$query = $con->query(" DELETE FROM rusak WHERE id_rusak = '$id' ");
if ($query) {
    $con->query("UPDATE sarpras SET kondisi = 'Baik' WHERE id_sarpras = '$data[id_sarpras]' ");

    $file = $data['foto_rusak'];
    if ($file != null) {
        unlink('../../../storage/rusak/' . $file);
    }
    $_SESSION['pesan'] = "Data Berhasil di Hapus";
    echo "<meta http-equiv='refresh' content='0; url=index'>";
} else {
    echo "Data anda gagal dihapus. Ulangi sekali lagi";
    echo "<meta http-equiv='refresh' content='0; url=index'>";
}
