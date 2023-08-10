<?php

$host = "localhost";
$username = "root";
$password = "";
$db = "waq";

$koneksi = mysqli_connect($host, $username, $password, $db) or die("GAGAL");

$base_url = "http://localhost/wablast/";
date_default_timezone_set('Asia/Jakarta');
