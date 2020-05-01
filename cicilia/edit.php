<!DOCTYPE html>
<a href="index.php">Lihat Semua Mata Pelajaran</a>
<br/>
<h3>Edit Data</h3>

<?php
include "koneksi.php" ;
$id = $_GET ['id'];
$query_mysql = mysql_query