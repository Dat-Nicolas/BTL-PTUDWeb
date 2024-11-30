<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu có id người dùng trong URL và id hợp lệ
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = (int)$_GET['id'];

    // Bắt đầu giao dịch
    $conn->begin_transaction();

    try {
        // Xóa người dùng khỏi cơ sở dữ liệu
        $sql_delete = "DELETE FROM user WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $user_id);

        if ($stmt_delete->execute()) {
            if ($stmt_delete->affected_rows > 0) {
                $conn->commit();
                header("Location: index_user.php?message=delete_success");
                exit();
            } else {
                $conn->rollback();
                echo "Không có người dùng nào bị xóa. ID không tồn tại.";
            }
        } else {
            $conn->rollback();
            echo "Lỗi khi thực hiện truy vấn: " . $stmt_delete->error;
        }
    } catch (Exception $e) {
        $conn->rollback();
        echo "Lỗi xảy ra: " . $e->getMessage();
    }
} else {
    echo "ID không hợp lệ.";
    exit();
}

$conn->close();
