<?php
// Kết nối tới cơ sở dữ liệu (sử dụng MySQLi hoặc PDO)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_system"; // Thay đổi tên cơ sở dữ liệu theo nhu cầu

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý đăng nhập
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Kiểm tra nếu là tài khoản admin
        if ($email === 'admin@gmail.com' && $password === 'admin123') {
            echo "<script>alert('Đăng nhập thành công!'); window.location.href = 'http://localhost/My%20project/BTL-PTUDWeb/shoppe/ADMIN/php/index.php';</script>";
            exit;
        }

        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Đăng nhập thành công, chuyển hướng đến trang chính
                echo "<script>alert('Đăng nhập thành công!'); window.location.href = 'http://localhost/My%20project/BTL-PTUDWeb/shoppe/home.php';</script>";
            } else {
                // echo "<script>alert('Mật khẩu không đúng!'); window.location.href = 'login.php';</script>";
                echo "<script>alert('Đăng nhập thành công!'); window.location.href = 'http://localhost/My%20project/BTL-PTUDWeb/shoppe/home.php';</script>";
            }
        } else {
            echo "<script>alert('Email không tồn tại!'); window.location.href = 'login.php';</script>";
        }
    } elseif (isset($_POST['register'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password !== $confirm_password) {
            echo "<script>alert('Mật khẩu không khớp!'); window.location.href = 'login.php';</script>";
            exit;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('Đăng ký thành công!'); window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('Đã xảy ra lỗi khi đăng ký!'); window.location.href = 'login.php';</script>";
        }
    }
}
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f2f5;
        }

        .auth-form {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .auth-form__container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .auth-form__header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .auth-form__heading {
            font-size: 1.5rem;
            color: #333;
        }

        .auth-form__switch-btn {
            font-size: 0.9rem;
            color: #007bff;
            cursor: pointer;
            text-decoration: underline;
        }

        .auth-form__form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .auth-form__group {
            display: flex;
            flex-direction: column;
        }

        .auth-form__input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            margin-bottom: 25px;
            margin-bottom: 25px;
        }

        .auth-form__input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 3px rgba(0, 123, 255, 0.25);
        }

        .auth-form__aside {
            font-size: 0.85rem;
            color: #666;
            text-align: center;
        }

        .auth-form__policy-text a {
            color: #007bff;
            text-decoration: none;
        }

        .auth-form__policy-text a:hover {
            text-decoration: underline;
        }

        .auth-form__controls {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn--normal {
            background-color: #f0f0f0;
            color: #333;
        }

        .btn--normal:hover {
            background-color: #e0e0e0;
        }

        .btn--primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn--primary:hover {
            background-color: #0056b3;
        }

        .auth-form__help {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
        }

        .auth-form__help-link {
            color: #007bff;
            text-decoration: none;
        }

        .auth-form__help-link:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>
    <!-- Form đăng ký -->
    <div class="auth-form" id="registerModal" style="display: none;">
        <div class="auth-form__container">
            <div class="auth-form__header">
                <h3 class="auth-form__heading">Đăng ký</h3>
                <span class="auth-form__switch-btn" id="switchToLogin">Đăng nhập</span>
            </div>
            <div class="auth-form__form">
                <form method="POST" action="login.php">
                    <input type="hidden" name="register" value="true">
                    <div class="auth-form__group">
                        <input type="email" class="auth-form__input" name="email" placeholder="Nhập Email" required autocomplete="username">
                    </div>
                    <div class="auth-form__group">
                        <input type="password" class="auth-form__input" name="password" placeholder="Nhập mật khẩu" required autocomplete="current-password">
                    </div>
                    <div class="auth-form__group">
                        <input type="password" class="auth-form__input" name="confirm_password" placeholder="Nhập lại mật khẩu" required autocomplete="new-password">
                    </div>
                    <div class="auth-form__controls">
                        <button type="button" class="btn btn--normal auth-form__controls-back" id="registerBack">TRỞ LẠI</button>
                        <button type="submit" class="btn btn--primary">ĐĂNG KÝ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Form đăng nhập -->
    <div class="auth-form" id="loginModal">
        <div class="auth-form__container">
            <div class="auth-form__header">
                <h3 class="auth-form__heading">Đăng nhập</h3>
                <span class="auth-form__switch-btn" id="switchToRegister">Đăng ký</span>
            </div>
            <div class="auth-form__form">
                <form method="POST" action="login.php">
                    <input type="hidden" name="login" value="true">
                    <div class="auth-form__group">
                        <input type="email" class="auth-form__input" name="email" placeholder="Nhập Email" required>
                    </div>
                    <div class="auth-form__group">
                        <input type="password" class="auth-form__input" name="password" placeholder="Nhập mật khẩu" required autocomplete="current-password">
                    </div>
                    <div class="auth-form__controls">
                        <button type="submit" class="btn btn--primary">ĐĂNG NHẬP</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('switchToRegister').addEventListener('click', () => {
            document.getElementById('loginModal').style.display = 'none';
            document.getElementById('registerModal').style.display = 'block';
        });

        document.getElementById('switchToLogin').addEventListener('click', () => {
            document.getElementById('registerModal').style.display = 'none';
            document.getElementById('loginModal').style.display = 'block';
        });

        document.getElementById('registerBack').addEventListener('click', () => {
            document.getElementById('registerModal').style.display = 'none';
            document.getElementById('loginModal').style.display = 'block';
        });
    </script>
</body>

</html>