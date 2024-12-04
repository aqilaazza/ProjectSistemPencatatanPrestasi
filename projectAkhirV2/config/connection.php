<?php

    function connection() : PDO{
        $host = "LAPTOP-DNQL6UUE"; //nama server\nama_instance
        $database = "sistemprestasi1";

        $dsn = "sqlsrv:Server=$host;Database=$database";
        $uid = "";
        $pwd = "";
        $conn = new PDO($dsn,$uid, $pwd);    
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
?>