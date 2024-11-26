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

        // Bước 2: Cập nhật lại ID của các sản phẩm còn lại để dồn lại ID liên tiếp
        $sql_update_ids = "
            SET @count = 0;
            UPDATE products SET id = (@count := @count + 1);
        ";
        $conn->query($sql_update_ids);

        // Bước 3: Cập nhật lại AUTO_INCREMENT (đảm bảo ID tiếp theo sẽ đúng)
        // Cập nhật AUTO_INCREMENT để nó tiếp tục từ ID lớn nhất hiện tại.
        $reset_auto_increment = "ALTER TABLE products AUTO_INCREMENT = 1";
        $conn->query($reset_auto_increment);

        // Bước 4: Commit giao dịch (nếu không có lỗi)
        $conn->commit();

        echo "Sản phẩm đã được xóa và cập nhật lại ID thành công.";
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
header("Refresh: 3; url=index.php");
exit;
?>
