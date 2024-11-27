<?php
// Kết nối với cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $image = $_POST['image'];
    $old_price = $_POST['old_price'];
    $current_price = $_POST['current_price'];
    $sold = $_POST['sold'];
    $brand = $_POST['brand'];
    $origin = $_POST['origin'];
    $discount = $_POST['discount'];
    $rating = $_POST['rating'];

    // Insert the new product into the database
    $sql = "INSERT INTO products (name, image, old_price, current_price, sold, brand, origin, discount, rating)
            VALUES ('$name', '$image', '$old_price', '$current_price', '$sold', '$brand', '$origin', '$discount', '$rating')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully!";
        // Redirect back to the products page or list page after adding the product.
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm Mới</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Thêm Sản Phẩm Mới</h1>
    </header>
    <main>
        <div class="form-container">
            <form action="add_product.php" method="POST">
                <div class="form-field">
                    <label for="name">Tên Sản Phẩm</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-field">
                    <label for="image">URL Hình Ảnh</label>
                    <input type="text" id="image" name="image" required>
                </div>

                <div class="form-field">
                    <label for="old_price">Giá Cũ</label>
                    <input type="number" id="old_price" name="old_price" required>
                </div>

                <div class="form-field">
                    <label for="current_price">Giá Mới</label>
                    <input type="number" id="current_price" name="current_price" required>
                </div>

                <div class="form-field">
                    <label for="sold">Số Lượng Đã Bán</label>
                    <input type="number" id="sold" name="sold" required>
                </div>

                <div class="form-field">
                    <label for="brand">Thương Hiệu</label>
                    <input type="text" id="brand" name="brand" required>
                </div>

                <div class="form-field">
                    <label for="origin">Nguồn Gốc</label>
                    <input type="text" id="origin" name="origin" required>
                </div>

                <div class="form-field">
                    <label for="discount">Giảm Giá (%)</label>
                    <input type="number" id="discount" name="discount" required>
                </div>

                <div class="form-field">
                    <label for="rating">Đánh Giá</label>
                    <input type="number" id="rating" name="rating" min="1" max="5" required>
                </div>

                <div class="form-actions">
                    <button type="submit">Thêm Sản Phẩm</button>
                    <a href="index.php"><button type="button">Quay Lại</button></a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
