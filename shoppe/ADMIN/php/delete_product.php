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

// Kiểm tra nếu có id sản phẩm
if (isset($product_id)) {
    // Bắt đầu giao dịch (transaction)
    $conn->begin_transaction();

    try {
        // Bước 1: Xóa sản phẩm khỏi cơ sở dữ liệu
        $sql_delete = "DELETE FROM products WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $product_id);
        $stmt_delete->execute();



        // Bước 3: Cập nhật lại AUTO_INCREMENT (đảm bảo ID tiếp theo sẽ đúng)
        $reset_auto_increment = "ALTER TABLE products AUTO_INCREMENT = 1";
        $conn->query($reset_auto_increment);

        // Bước 4: Commit giao dịch (nếu không có lỗi)
        $conn->commit();
    } catch (Exception $e) {
        // Nếu có lỗi, rollback giao dịch
        $conn->rollback();
        echo "Lỗi: " . $e->getMessage();
    }
} else {
    echo "Không có id sản phẩm để xóa.";
}

$conn->close();

// Chuyển hướng về trang danh sách sản phẩm sau 3 giây
header("Refresh: 1; url=index.php");
exit;
