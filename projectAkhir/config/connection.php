<?php
    $host = "LAPTOP-83QPKDTF\SQLEXPRESS"; //nama server\nama_instance
    $connInfo = array("Database" => "sistemprestasi", "UID" => "", "PWD" => "");
    $conn = sqlsrv_connect($host, $connInfo);

    if ($conn) {
    } else {
        echo "Koneksi Gagal";
        die(print_r(sqlsrv_errors(), true));
    }
?>
