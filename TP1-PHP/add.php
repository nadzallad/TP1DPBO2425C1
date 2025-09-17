<?php
//impor kelas elektronik
require_once 'Electronic.php';

//memulai sesi untuk meyimpan data prduk 
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //ambil data dari form
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $category = $_POST['category'] ?? '';
    $price = (int)($_POST['price'] ?? 0);

    // Proses gambar
    $imageName = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/'; //direktori gambar
        $originalName = basename($_FILES['image']['name']);//ambil naam asli file
        $targetPath = $uploadDir . $originalName;//path tujuan upload

        // Pastikan folder uploads/ ada
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Pindahkan file dari tmp ke uploads
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $imageName = $originalName;
        } else {
            $error = "❌ Gagal mengunggah gambar.";
        }
    } else {
        $error = "⚠️ Harap unggah gambar produk.";
    }

    // Validasi ID
    $idExists = false;
    foreach ($_SESSION['products'] as $prod) {
        if ($prod->getId() === $id) {
            $idExists = true;
            break;
        }
    }

    //mengecek id, id tidak boleh sama 
    if ($idExists) {
        $error = "⚠️ ID sudah ada. Gunakan ID lain.";
    } elseif (empty($error)) {
        // Tambahkan produk baru
        $newProduct = new Electronic($id, $name, $category, $price, $imageName);
        $_SESSION['products'][] = $newProduct;
        //setelah selesai kembali ke halaman utama
        header("Location: Main.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <style>
        /* Style latar dan font */
        body {
            background-color: #fbf9d1;
            font-family: Arial, sans-serif;
        }

         /* Form berada di tengah */
        form {
            max-width: 400px;
            margin: auto;
        }

         /* Style label */
        label {
            display: block;
            margin-top: 10px;
        }

         /* Input field style */
        input[type="text"], input[type="number"], input[type="file"] {
            width: 100%;
            padding: 6px;
            margin-top: 4px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

         /* Tombol */
        button, a.button {
            padding: 6px 12px;
            margin-top: 15px;
            display: inline-block;
            text-decoration: none;
            background-color: #5D688A;
            color: white;
            border: none;
            border-radius: 3px;
        }

        /* Tombol kembali */    
        .back-btn {
            background-color: #aaa;
        }

        /* Error Message */
        .error {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">➕ Tambah Produk Baru</h1>

    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <!-- Form input produk -->
    <form method="post" enctype="multipart/form-data">
        <label>ID Produk:</label>
        <input type="text" name="id" required>

        <label>Nama Produk:</label>
        <input type="text" name="name" required>

        <label>Kategori:</label>
        <input type="text" name="category" required>

        <label>Harga:</label>
        <input type="number" name="price" required>

        <label>Gambar Produk:</label>
        <input type="file" name="image" accept="image/*" required>

        <button type="submit">💾 Simpan Produk</button>
        <a href="Main.php" class="button back-btn">Kembali</a>
    </form>
</body>
</html>
