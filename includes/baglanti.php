<?php

$host='localhost';
$kullanici='root';
$parola='yusuf205587';
$vt='hedefgelisim';

$baglanti = mysqli_connect($host, $kullanici, $parola, $vt);
mysqli_set_charset($baglanti, "UTF-8");

?>