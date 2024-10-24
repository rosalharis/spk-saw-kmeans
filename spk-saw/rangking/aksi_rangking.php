<?php
include "../koneksi.php";

$sql = "SELECT max(c1) as max_c1, max(c2) as max_c2, max(c3) as max_c3, max(c4) as max_c4 FROM tbl_nilai";
$hasil = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_array($hasil);
$max_c1 = $row['max_c1'];
$max_c2 = $row['max_c2'];
$max_c3 = $row['max_c3'];
$max_c4 = $row['max_c4'];

$sql = "SELECT * FROM tbl_bobot";
$hasil = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_array($hasil);
$w1 = $row['w1'];
$w2 = $row['w2'];
$w3 = $row['w3'];
$w4 = $row['w4'];

$sql = "SELECT * FROM hasil_kmeans";
$hasil = mysqli_query($koneksi, $sql);

$skor = [];
$id_nilai = [];

while ($row = mysqli_fetch_array($hasil)) {
    $id_nilai[] = $row['id_alternatif'];
    
    $sql_nilai = "SELECT * FROM tbl_nilai WHERE id_nilai='" . $row['id_alternatif'] . "'";
    $hasil_nilai = mysqli_query($koneksi, $sql_nilai);
    $data_nilai = mysqli_fetch_array($hasil_nilai);

    $c1_normalisasi = round(($data_nilai['c1'] / $max_c1), 2);
    $c2_normalisasi = round(($data_nilai['c2'] / $max_c2), 2);
    $c3_normalisasi = round(($data_nilai['c3'] / $max_c3), 2);
    $c4_normalisasi = round(($data_nilai['c4'] / $max_c4), 2);

    $cluster_id = $row['cluster']; 
    $skor_tambahan = ($cluster_id == 0) ? 1.5 : 1.0; 

    $skor_sementara = (($w1 * $c1_normalisasi) + ($w2 * $c2_normalisasi) + 
                       ($w3 * $c3_normalisasi) + ($w4 * $c4_normalisasi)) * 
                       $skor_tambahan;

    $skor[$row['id_alternatif']] = round($skor_sementara, 3);
}

$max_skor = max($skor);

foreach ($skor as $id => $value) {
    $skor[$id] = round($value / $max_skor, 3);

    $sql = "UPDATE tbl_nilai SET skor='$skor[$id]' WHERE id_nilai='$id'";
    mysqli_query($koneksi, $sql);
    echo "$sql<br>";
}

header("location:../index.php?halaman=rangking");
?>
