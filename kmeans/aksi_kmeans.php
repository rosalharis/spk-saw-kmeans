<?php
include '../koneksi.php';

function kmeans($data, $k, $maxIterations = 100) {
    $centroids = [];
    $clusters = [];

    $dataCount = count($data);
    if ($dataCount < $k) {
        throw new Exception("Jumlah data tidak cukup untuk membentuk $k cluster.");
    }

    $randomIndexes = array_rand($data, $k);
    foreach ($randomIndexes as $index) {
        $centroids[] = $data[$index]['attributes'];
    }

    for ($iteration = 0; $iteration < $maxIterations; $iteration++) {

        $clusters = array_fill(0, $k, []);

        foreach ($data as $item) {
            $distances = [];
            foreach ($centroids as $centroid) {
                $distances[] = euclideanDistance($item['attributes'], $centroid);
            }
            $closestCentroid = array_keys($distances, min($distances))[0];
            $clusters[$closestCentroid][] = $item;
        }

        $newCentroids = [];
        foreach ($clusters as $cluster) {
            if (count($cluster) > 0) {
                $newCentroids[] = calculateMean($cluster);
            } else {
                $newCentroids[] = $centroids[array_rand($centroids)];
            }
        }

        if ($centroids === $newCentroids) {
            break;
        }

        $centroids = $newCentroids;
    }

    return $clusters;
}

function euclideanDistance($point1, $point2) {
    $sum = 0;
    for ($i = 0; $i < count($point1); $i++) {
        $sum += pow($point1[$i] - $point2[$i], 2);
    }
    return sqrt($sum);
}

function calculateMean($cluster) {
    $mean = array_fill(0, count($cluster[0]['attributes']), 0);
    foreach ($cluster as $item) {
        for ($i = 0; $i < count($item['attributes']); $i++) {
            $mean[$i] += $item['attributes'][$i];
        }
    }
    foreach ($mean as &$value) {
        $value /= count($cluster);
    }
    return $mean;
}

$data = [];
$query = "SELECT * FROM tbl_nilai";
$result = mysqli_query($koneksi, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        'id' => $row['id_alternatif'],
        'attributes' => [$row['c1'], $row['c2'], $row['c3'], $row['c4']] // Attributes used for clustering
    ];
}

$k = 2; 

try {

    mysqli_query($koneksi, "TRUNCATE TABLE hasil_kmeans");

    $clusters = kmeans($data, $k);

    foreach ($clusters as $cluster_id => $cluster_data) {
        foreach ($cluster_data as $item) {
            $query = "INSERT INTO hasil_kmeans (id_alternatif, cluster) VALUES ('".$item['id']."', '".$cluster_id."')";
            mysqli_query($koneksi, $query);
        }
    }

    $centroids = [];
    foreach ($clusters as $cluster) {
        $centroids[] = calculateMean($cluster); 
    }

    session_start();
    $_SESSION['centroid_0'] = $centroids[0];
    $_SESSION['centroid_1'] = $centroids[1];

    header("location:../index.php?halaman=kmeans");
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
