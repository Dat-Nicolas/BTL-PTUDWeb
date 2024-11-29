<?php
// Kết nối với cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Xử lý form khi người dùng nhấn nút "Thêm Sản Phẩm"
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $email = $_POST['email'];
    $password = $_POST['password'];
   

    // Chèn sản phẩm mới vào cơ sở dữ liệu
    $sql = "INSERT INTO user (email, password)
            VALUES ('$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Sản phẩm mới đã được thêm thành công!";
        header("Location: index_user.php");
        exit();
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Người Dùng Mới</title>
    <link rel="stylesheet" href="add_user.css">
</head>
<body>
    <header>
        <h1>Thêm Người Dùng Mới</h1>
    </header>
    <main>
        <div class="form-container">
            <form action="add_user.php" method="POST">
                <div class="form-field">
                    <label for="email">Email Người Dùng</label>
                    <input type="text" id="email" name="email" required>
                </div>

                <div class="form-field">
                    <label for="password">Password</label>
                    <input type="text" id="password" name="password" required>
                </div>
                <div class="form-actions" >
                    <button type="submit" style="margin-top: 10px;">Thêm Người Dùng</button>
                    <a href="index_user.php"><button type="button" style="margin-top: 10px;">Quay Lại</button></a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
