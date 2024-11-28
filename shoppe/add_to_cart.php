<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Tạo bảng `cart` nếu chưa tồn tại
$createTableSQL = "CREATE TABLE IF NOT EXISTS cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    quantity INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($createTableSQL) !== TRUE) {
    die("Lỗi khi tạo bảng `cart`: " . $conn->error);
}

// Nhận dữ liệu từ AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['product_id']);

    // Kiểm tra dữ liệu
    if ($product_id > 0) {
        // Thêm sản phẩm vào bảng `cart`
        $sql = "INSERT INTO cart (product_id, quantity) VALUES ($product_id, 1)";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['status' => 'success', 'message' => 'Sản phẩm đã được thêm vào giỏ hàng.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Thêm sản phẩm thất bại: ' . $conn->error]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Dữ liệu không hợp lệ.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Phương thức không hợp lệ.']);
}

// Đóng kết nối
$conn->close();
?>
