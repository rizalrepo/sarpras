<?php
require '../../../app/config.php';
include_once '../../layout/topbar.php';
include_once '../../layout/footer.php';

$id = $_GET['id'];

$query = $con->query(" DELETE FROM user WHERE id_user = '$id' ");
if ($query) {
    $_SESSION['pesan'] = "Data Berhasil di Hapus";
    echo "<meta http-equiv='refresh' content='0; url=index'>";
} else {
    echo "Data anda gagal dihapus. Ulangi sekali lagi";
    echo "<meta http-equiv='refresh' content='0; url=index'>";
}
