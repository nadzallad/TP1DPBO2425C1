<?php
require_once 'Electronic.php';
session_start();

if (!isset($_GET['id'])) {
    header("Location: Main.php");
    exit;
}

$id = $_GET['id'];
$indexToEdit = -1;

// Cari produk berdasarkan ID
foreach ($_SESSION['products'] as $index => $product) {
    if ($product->getId() === $id) {
        $indexToEdit = $index;
    }
}

// Jika ID tidak ditemukan, tampilkan error
if ($indexToEdit === -1) {
    echo "<p>❌ Produk dengan ID $id tidak ditemukan.</p>";
    echo "<a href='Main.php'>Kembali</a>";
    exit;
}

// Ambil data produk yang akan diedit
$product = $_SESSION['products'][$indexToEdit];

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $category = $_POST['category'] ?? '';
    $price = (int) ($_POST['price'] ?? 0);

    // Update nilai produk
    $product->setProductName($name);
    $product->setCategory($category);
    $product->setPrice($price);

    $_SESSION['products'][$indexToEdit] = $product;

    // Redirect kembali ke halaman utama
    header("Location: Main.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <style>
        input[type="text"], input[type="number"] {
            width: 300px;
            padding: 6px;
            margin-bottom: 10px;
        }

        button, a.button {
            padding: 6px 12px;
            margin-top: 10px;
            display: inline-block;
            text-decoration: none;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 3px;
        }

        .back-btn {
            background-color: #aaa;
        }
    </style>
</head>
<body>
    <h1>✏️ Edit Produk</h1>

    <form method="post">
       a> <label>ID Produk (tidak bisa diubah):</label><br>
        <input type="text" name="id" value="<?= htmlspecialchars($product->getId()); ?>" readonly><br>

        <label>Nama Produk:</label><br>
        <input type="text" name="name" value="<?= htmlspecialchars($product->getProductName()); ?>" required><br>

        <label>Kategori:</label><br>
        <input type="text" name="category" value="<?= htmlspecialchars($product->getCategory()); ?>" required><br>

        <label>Harga:</label><br>
        <input type="number" name="price" value="<?= htmlspecialchars($product->getPrice()); ?>" required><br>

        <button type="submit">Simpan Perubahan</button>
        <a href="index.php" class="button back-btn">Batal</
    </form>
</body>
</html>
