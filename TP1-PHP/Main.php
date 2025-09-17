<?php
require_once 'Electronic.php';
session_start();

// Data default
$defaultProducts = [
    new Electronic("E001", "Laptop Asus", "Laptop", 8500000, "Laptop ASUS.jpg"),
    new Electronic("E002", "HP Samsung Galaxy", "Smartphone", 3500000, "Hp Samsung.jpg"),
    new Electronic("E003", "Smart TV LG", "Televisi", 5200000, "Smart Tv.jpg")
];

// Inisialisasi array session jika belum ada
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

// Menambahkan data default hanya jika belum ada di session
foreach ($defaultProducts as $dp) {
    $exists = false;
    foreach ($_SESSION['products'] as $sp) {
        if ($sp->getId() === $dp->getId()) {
            $exists = true;
            break;
        }
    }
    if (!$exists) {
        $_SESSION['products'][] = $dp;
    }
}

// Menghapus produk berdasarkan ID jika ada parameter `delete` di URL
if (isset($_GET['delete'])) {
    $idToDelete = $_GET['delete'];
    foreach ($_SESSION['products'] as $index => $product) {
        if ($product->getId() === $idToDelete) {
            unset($_SESSION['products'][$index]);
            $_SESSION['products'] = array_values($_SESSION['products']);
            break;
        }
    }
    header("Location: Main.php");
    exit;
}

// Proses pencarian produk
$searchKeyword = isset($_GET['search']) ? trim($_GET['search']) : '';
$filteredProducts = [];

if ($searchKeyword !== '') {
    foreach ($_SESSION['products'] as $product) {
        if (
            stripos($product->getId(), $searchKeyword) !== false ||
            stripos($product->getProductName(), $searchKeyword) !== false ||
            stripos($product->getCategory(), $searchKeyword) !== false
        ) {
            $filteredProducts[] = $product;
        }
    }
} else {
    //menapilkan semua produk 
    $filteredProducts = $_SESSION['products'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Electronics Store</title>
    <style>
        body {
            background-color: #fbf9d1;
            font-family: Arial, sans-serif;
        }

        table {
            text-align: center;
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table, th, td {
            border: 1px solid #000000ff;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #91ADC8;
        }

        button, a.button {
            padding: 6px 10px;
            text-decoration: none;
            text-align: center;
            color: white;
            border: none;
            border-radius: 3px;
        }

        .add-btn {
            background: #5D688A;
            margin-bottom: 20px;
            display: inline-block;
        }

        .delete-btn {
            background-color: #f40404ff;
        }

        .edit-btn {
            background-color: #043cf4ff;
        }

        .search-form input[type="text"] {
            padding: 8px;
            width: 300px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .search-form button {
            padding: 8px 12px;
            margin-left: 8px;
            background-color: #5D688A;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-form button:hover {
            background-color: #49576a;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Electronics Store</h1>
    
     <!-- Tombol tambah produk -->
    <a class="button add-btn" href="add.php">➕ Tambah Produk</a>
    
    <!-- Form pencarian -->
    <form method="get" class="search-form" action="Main.php">
        <input type="text" name="search" placeholder="Cari nama produk atau kategori..." value="<?= htmlspecialchars($searchKeyword); ?>">
        <button type="submit">🔍 Cari</button>
    </form>

    <h2>📋 Daftar Produk</h2>
    <?php if (empty($filteredProducts)): ?>
        
    <!-- Tampilkan jika tidak ada produk -->
        <p><em>Tidak ada produk tersedia.</em></p>
    <?php else: ?>
        <!-- Tampilkan tabel produk -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Foto Produk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filteredProducts as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product->getId()); ?></td>
                        <td><?= htmlspecialchars($product->getProductName()); ?></td>
                        <td><?= htmlspecialchars($product->getCategory()); ?></td>
                        <td>Rp <?= number_format($product->getPrice(), 0, ',', '.'); ?></td>
                        <td><img src="uploads/<?= htmlspecialchars($product->getImageFileName()); ?>" width="100" alt="Foto Produk"></td>
                        <td>
                             <!-- Tombol hapus -->
                            <form method="get" onsubmit="return confirm('Hapus produk ini?');">
                                <input type="hidden" name="delete" value="<?= htmlspecialchars($product->getId()); ?>">
                                <button type="submit" class="button delete-btn">🗑️ Hapus</button>
                            </form>
                             <!-- Tombol edit -->
                            <a href="edit.php?id=<?= htmlspecialchars($product->getId()); ?>" class="button edit-btn">✏️ Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
