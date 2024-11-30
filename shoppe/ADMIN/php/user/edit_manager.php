<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$managername = "root";
$password = "";
$dbname = "inventory_system";

$conn = new mysqli($servername, $managername, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Kiểm tra và lấy ID từ URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Lấy thông tin người dùng
    $sql = "SELECT * FROM manager WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $manager = $result->fetch_assoc();

    if (!$manager) {
        header("Location: index_manager.php?message=manager_not_found");
        exit();
    }
} else {
    header("Location: index_manager.php?message=invalid_id");
    exit();
}

// Xử lý cập nhật thông tin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

   
    $sql_update = "UPDATE manager SET email = ?, password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("ssi", $email, $password, $id);

    if ($stmt->execute()) {
        header("Location: index_manager.php?message=update_success");
        exit();
    } else {
        $error_message = "Lỗi cập nhật người dùng.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" href="edit_manager.css">
</head>
<body>
    <div class="form-edit">
        <h1>Sửa ADMIN</h1>

        <!-- Hiển thị thông báo lỗi nếu có -->
        <?php if (isset($error_message)): ?>
            <p class="error"><?= htmlspecialchars($error_message) ?></p>
        <?php endif; ?>

        <form action="edit_manager.php?id=<?= htmlspecialchars($id) ?>" method="post" class="form-edit__title">
            <div class="form-edit__info">
                <label for="email">Email ADMIN:</label>
                <input type="email" id="email" name="email" 
                       value="<?= htmlspecialchars($manager['email'], ENT_QUOTES, 'UTF-8') ?>" required><br>

                <label for="password">Mật Khẩu ADMIN:</label>
                <input type="text" id="password" name="password" 
                        value="<?= htmlspecialchars($manager['password'], ENT_QUOTES, 'UTF-8') ?>" required><br>

            </div>

            <div class="form-edit__detail">
                <div class="form-actions">
                    <button type="submit">Cập Nhật</button>
                    <a href="index_manager.php"><button type="button" style="display:inline-block;" ; >Quay Lại</button></a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
