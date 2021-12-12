<?php

ob_start ();
$connection;
$namaserver = "localhost";
$username = "root";
$password = "";
$namadb = "wp";

$connection = mysqli_connect($namaserver, $username, $password, $namadb);
if(!$connection) {
  die ("Koneksi gagal!: ".mysqli_connect_error ());
}
?>