<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Kiểm tra xem có id sản phẩm nào trong URL không
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin sản phẩm từ cơ sở dữ liệu
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();

    if (!$product) {
        echo "Sản phẩm không tồn tại.";
        exit();
    }
}

// Cập nhật thông tin sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $image = $product['image']; // Giữ ảnh cũ mặc định
    $old_price = $_POST['old_price'];
    $current_price = $_POST['current_price'];
    $sold = $_POST['sold'];
    $brand = $_POST['brand'];
    $origin = $_POST['origin'];
    $discount = $_POST['discount'];
    $rating = $_POST['rating'];

    // Xử lý link ảnh
    if (!empty($_POST['image_url'])) {
        // Kiểm tra link ảnh
        $image_url = filter_var($_POST['image_url'], FILTER_VALIDATE_URL);
        if ($image_url === false) {
            die("Link ảnh không hợp lệ.");
        }
        $image = $image_url;
    }

    // Cập nhật thông tin sản phẩm
    $sql_update = "UPDATE products SET 
                   name = ?, 
                   image = ?, 
                   old_price = ?, 
                   current_price = ?, 
                   sold = ?, 
                   brand = ?, 
                   origin = ?, 
                   discount = ?, 
                   rating = ? 
                   WHERE id = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("ssiiisssii", $name, $image, $old_price, $current_price, $sold, $brand, $origin, $discount, $rating, $id);

    if ($stmt->execute()) {
        header('Location: index.php'); // Quay lại trang quản lý sản phẩm
        exit();
    } else {
        echo "Lỗi cập nhật sản phẩm.";
    }
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Sản Phẩm</title>
    <link rel="stylesheet" href="edit_product.css">
</head>

<body>
    <div class="form-edit">
        <h1>Sửa Sản Phẩm</h1>

        <form action="edit_product.php?id=<?= $product['id'] ?>" method="post" class="form-edit__title">
            <div class="form-edit__info">
                <label for="name">Tên Sản Phẩm:</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>" required><br>

                <label for="image_url">Link Hình Ảnh:</label>
                <input type="text" id="image_url" name="image_url" value="<?= htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8') ?>" required><br>
                <?php if (!empty($product['image'])): ?>
                    <img src="<?= htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8') ?>" alt="image" width="100"><br>
                <?php endif; ?>
            </div>
    
            <!-- Hiển thị ảnh hiện tại -->
            <div class="form-edit__detail">

                <label for="old_price">Giá Cũ:</label>
                <input type="number" id="old_price" name="old_price" value="<?= $product['old_price'] ?>" required><br>

                <label for="current_price">Giá Hiện Tại:</label>
                <input type="number" id="current_price" name="current_price" value="<?= $product['current_price'] ?>" required><br>

                <label for="sold">Số Lượng Đã Bán:</label>
                <input type="number" id="sold" name="sold" value="<?= $product['sold'] ?>" required><br>

                <label for="brand">Thương Hiệu:</label>
                <input type="text" id="brand" name="brand" value="<?= htmlspecialchars($product['brand'], ENT_QUOTES, 'UTF-8') ?>" required><br>

                <label for="origin">Nguồn Gốc:</label>
                <input type="text" id="origin" name="origin" value="<?= htmlspecialchars($product['origin'], ENT_QUOTES, 'UTF-8') ?>" required><br>

                <label for="discount">Giảm Giá (%):</label>
                <input type="number" id="discount" name="discount" value="<?= $product['discount'] ?>" required><br>

                <label for="rating">Đánh Giá:</label>
                <input type="number" id="rating" name="rating" value="<?= $product['rating'] ?>" required><br>

                <div class="form-actions">
                    <button type="submit">Cập Nhật</button>
                    <a href="index.php"><button type="button">Quay Lại</button></a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>