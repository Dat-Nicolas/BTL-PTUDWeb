<?php
// Kết nối với cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Xử lý form khi người dùng nhấn nút "Thêm Sản Phẩm"
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $image = $_POST['image'];
    $old_price = $_POST['old_price'];
    $current_price = $_POST['current_price'];
    $sold = $_POST['sold'];
    $brand = $_POST['brand'];
    $origin = $_POST['origin'];
    $rating = $_POST['rating'];

    // Tính phần trăm giảm giá
    if ($old_price > 0 && $old_price > $current_price && $current_price >0 ) {
        $discount = (($old_price - $current_price) / $old_price) * 100;
        $discount = round($discount, 2); 
    }
    else {
        $discount = 0; 
    }

    // Chèn sản phẩm mới vào cơ sở dữ liệu
    $sql = "INSERT INTO products (name, image, old_price, current_price, sold, brand, origin, discount, rating)
            VALUES ('$name', '$image', '$old_price', '$current_price', '$sold', '$brand', '$origin', '$discount', '$rating')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Sản phẩm mới đã được thêm thành công!";
        header("Location: index.php");
        exit();
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
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
    <link rel="stylesheet" href="add_product.css">
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
                    <label for="rating">Đánh Giá</label>
                    <input type="number" id="rating" name="rating" min="1" max="5" required>
                </div>

                <div class="form-actions">
                    <button type="submit" style="margin-top:10px;">Thêm Sản Phẩm</button>
                    <a href="index.php"><button type="button" style="margin-top:10px; display:inline-block;">Quay Lại</button></a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
