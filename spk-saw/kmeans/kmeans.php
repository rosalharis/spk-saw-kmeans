<?php
include 'koneksi.php'; // Include the database connection file

// Fetch clustering results from the hasil_kmeans table
$query = "SELECT h.id_alternatif, a.nama, h.cluster 
          FROM hasil_kmeans h 
          JOIN tbl_alternatif a ON h.id_alternatif = a.id_alternatif
          ORDER BY h.cluster ASC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/your/bootstrap.css"> <!-- Include your Bootstrap CSS path -->
    <title>Hasil K-Means Clustering</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Hasil K-Means Clustering</h2>
        <a href="kmeans/aksi_kmeans.php" class="btn btn-primary mb-3">Perbarui</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Cluster</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['cluster']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    

    <?php 
    // Tampilkan pusat cluster 0 dan 1
    if (isset($_SESSION['centroid_0']) && isset($_SESSION['centroid_1'])) {
        echo "<h3>Pusat Cluster</h3>";
        echo "<p>Cluster Pusat 0: [".implode(", ", $_SESSION['centroid_0'])."]</p>";
        echo "<p>Cluster Pusat 1: [".implode(", ", $_SESSION['centroid_1'])."]</p>";
    }
    ?>

</div>
</body>
</html>
