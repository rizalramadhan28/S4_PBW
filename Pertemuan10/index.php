<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Data Buku</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; }
        .btn-add { background-color: #4CAF50; color: white; }
        .btn-edit { background-color: #2196F3; color: white; }
        .btn-delete { background-color: #f44336; color: white; }
    </style>
</head>
<body>
    <h2>Daftar Buku</h2>
    <a href="tambah.php" class="btn btn-add">+ Tambah Buku Baru</a>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun Terbit</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php
        $query = "SELECT * FROM buku ORDER BY ID DESC";
        $result = mysqli_query($conn, $query);
        $no = 1;

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . htmlspecialchars($row['Judul']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Penulis']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Tahun_Terbit']) . "</td>";
            echo "<td>Rp " . number_format($row['Harga'], 2, ',', '.') . "</td>";
            echo "<td>" . htmlspecialchars($row['Stok']) . "</td>";
            echo "<td>
                    <a href='edit.php?id=" . $row['ID'] . "' class='btn btn-edit'>Edit</a> 
                    <a href='hapus.php?id=" . $row['ID'] . "' class='btn btn-delete' onclick='return confirm(\"Yakin ingin menghapus buku ini?\")'>Hapus</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>