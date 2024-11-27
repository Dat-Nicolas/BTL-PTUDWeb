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

// Lấy giá trị từ ô tìm kiếm (query)
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Truy vấn tìm kiếm sản phẩm trong cơ sở dữ liệu
$sql = "SELECT * FROM products WHERE name LIKE ? OR brand LIKE ? OR origin LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = "%" . $query . "%";
$stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm); // Gán tham số vào câu lệnh SQL

$stmt->execute();
$result = $stmt->get_result();

// Hiển thị kết quả tìm kiếm
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='product-item'>";
        echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "' />";
        echo "<h4>" . $row['name'] . "</h4>";
        echo "<p>" . number_format($row['current_price'], 0, ',', '.') . " VND</p>";
        echo "</div>";
    }
} else {
    echo "Không tìm thấy sản phẩm nào.";
}

$conn->close();
?>
