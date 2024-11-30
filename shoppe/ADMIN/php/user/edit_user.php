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

// Kiểm tra và lấy ID từ URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Lấy thông tin người dùng
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        header("Location: index_user.php?message=user_not_found");
        exit();
    }
} else {
    header("Location: index_user.php?message=invalid_id");
    exit();
}

// Xử lý cập nhật thông tin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql_update = "UPDATE user SET email = ?, password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("ssi", $email, $password, $id);

    if ($stmt->execute()) {
        header("Location: index_user.php?message=update_success");
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
    <title>Sửa người dùng</title>
    <link rel="stylesheet" href="edit_user.css">
</head>

<body>
    <div class="form-edit">
        <h1>Sửa người dùng</h1>

        <!-- Hiển thị thông báo lỗi nếu có -->
        <?php if (isset($error_message)): ?>
            <p class="error"><?= htmlspecialchars($error_message) ?></p>
        <?php endif; ?>

        <form action="edit_user.php?id=<?= htmlspecialchars($id) ?>" method="post" class="form-edit__title">
            <div class="form-edit__info">
                <label for="email">Email Người Dùng:</label>
                <input type="email" id="email" name="email"
                    value="<?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?>" required><br>

                <label for="password">Mật Khẩu Người Dùng:</label>
                <input type="text" id="password" name="password"
                    value="<?= htmlspecialchars($user['password'], ENT_QUOTES, 'UTF-8') ?>" required><br>

            </div>

            <div class="form-edit__detail">
                <div class="form-actions">
                    <button type="submit">Cập Nhật</button>
                    <a href="index_user.php"><button type="button" style="display:inline-block;" ;>Quay Lại</button></a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>