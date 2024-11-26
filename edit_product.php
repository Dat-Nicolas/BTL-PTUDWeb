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

// Lấy id sản phẩm từ URL
$product_id = $_GET['id'];

// Lấy thông tin sản phẩm từ cơ sở dữ liệu
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    echo "Sản phẩm không tồn tại.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    // Cập nhật thông tin sản phẩm
    $sql_update = "UPDATE products SET name = ?, category = ?, price = ?, quantity = ?, description = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssdiis", $name, $category, $price, $quantity, $description, $product_id);

    if ($stmt_update->execute()) {
        echo "Cập nhật sản phẩm thành công.";
        header("Location: index.php"); // Quay lại trang danh sách sản phẩm sau khi sửa
        exit;
    } else {
        echo "Lỗi: " . $stmt_update->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Sản Phẩm</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Sửa Sản Phẩm</h2>
    <form action="edit_product.php?id=<?php echo $product_id; ?>" method="POST">
        <label for="name">Tên Sản Phẩm:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required><br><br>

        <label for="category">Danh Mục:</label>
        <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($product['category']); ?>" required><br><br>

        <label for="price">Giá:</label>
        <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" required><br><br>

        <label for="quantity">Số Lượng:</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>" required><br><br>

        <label for="description">Mô Tả:</label>
        <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($product['description']); ?></textarea><br><br>

        <input type="submit" value="Cập nhật sản phẩm">
    </form>
</body>
</html>
