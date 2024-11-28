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

// Lấy thông tin sản phẩm trong giỏ hàng
$sql = "SELECT c.quantity, p.name, p.image, p.current_price 
        FROM cart c
        INNER JOIN products p ON c.product_id = p.id";

$result = $conn->query($sql);

$cart_items = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cart_items[] = $row;
    }
}

// Trả về dữ liệu dưới dạng JSON
echo json_encode($cart_items);

// Đóng kết nối
$conn->close();
?>
