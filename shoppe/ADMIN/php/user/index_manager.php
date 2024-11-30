<?php
// Kết nối với cơ sở dữ liệu
$servername = "localhost";
$managername = "root";
$password = "";
$dbname = "inventory_system";

$conn = new mysqli($servername, $managername, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Xử lý tìm kiếm
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : "";
$sql = "SELECT * FROM manager";
if (!empty($search)) {
    $sql .= " WHERE email LIKE '%$search%'";
}
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý ADMIN</title>
    <link rel="stylesheet" href="styles4.css">
</head>

<body>
    <header>
        <h1>Quản Lý ADMIN</h1>
    </header>
    <main>
        <div class="search-container" style="display: flex;">
            <form method="GET">
                <input style="margin: 20px 30px;" type="text" name="search" placeholder="Tìm kiếm ADMIN..." value="<?php echo htmlspecialchars($search); ?>">
            </form>
            <button onclick="location.href='add_manager.php'">Thêm ADMIN</button>
            <button onclick="location.href='http://localhost/My%20project/BTL-PTUDWeb/shoppe/ADMIN/php/index.php'"> Quản lý sản phẩm</button>
            <button onclick="location.href='http://localhost/My%20project/BTL-PTUDWeb/shoppe/ADMIN/php/manager/index_manager.php'"> Quản lý người dùng</button>
        </div>
        <table id="manager-table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>password</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['password']); ?></td>
                            <td>
                                <a href="edit_manager.php?id=<?php echo $row['id']; ?>">Sửa</a> |
                                <a href="delete_manager.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">Không có dữ liệu.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>

</html>
<?php $conn->close(); ?>