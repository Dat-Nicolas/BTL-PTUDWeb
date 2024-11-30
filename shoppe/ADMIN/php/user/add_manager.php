<?php
// Kết nối với cơ sở dữ liệu
$servername = "localhost";
$managername = "root";
$password = "";
$dbname = "inventory_system";

$conn = new mysqli($servername, $managername, $password, $dbname);

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
    $sql = "INSERT INTO manager (email, password)
            VALUES ('$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Sản phẩm mới đã được thêm thành công!";
        header("Location: index_manager.php");
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
    <title>Thêm ADMIN</title>
    <link rel="stylesheet" href="add_manager.css">
</head>
<body>
    <header>
        <h1>Thêm ADMIN Mới</h1>
    </header>
    <main>
        <div class="form-container">
            <form action="add_manager.php" method="POST">
                <div class="form-field">
                    <label for="email">Email ADMIN</label>
                    <input type="text" id="email" name="email" required>
                </div>

                <div class="form-field">
                    <label for="password">Password</label>
                    <input type="text" id="password" name="password" required>
                </div>
                <div class="form-actions" >
                    <button type="submit" style="margin-top: 10px;">Thêm ADMIN</button>
                    <a href="index_manager.php"><button type="button" style="margin-top: 10px;">Quay Lại</button></a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
