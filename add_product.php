<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    $conn = new mysqli('localhost', 'root', '', 'inventory_system');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO products (name, category, price, quantity, description) 
            VALUES ('$name', '$category', '$price', '$quantity', '$description')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>
</head>
<body>
    <h1>Thêm Sản Phẩm Mới</h1>
    <form method="POST">
        <label for="name">Tên Sản Phẩm:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="category">Loại:</label>
        <input type="text" id="category" name="category"><br>

        <label for="price">Giá:</label>
        <input type="number" id="price" name="price" step="0.01" required><br>

        <label for="quantity">Số Lượng:</label>
        <input type="number" id="quantity" name="quantity" required><br>

        <label for="description">Mô Tả:</label>
        <textarea id="description" name="description"></textarea><br>

        <button type="submit">Thêm Sản Phẩm</button>
    </form>
</body>
</html>
