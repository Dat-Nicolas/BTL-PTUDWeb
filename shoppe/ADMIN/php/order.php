<?php
// Kết nối với cơ sở dữ liệu
$conn = new mysqli('localhost', 'root', '', 'inventory_system');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lấy danh sách đơn hàng từ database
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Quản Lý Đơn Hàng</title>
</head>
<body>

    <h1>Danh Sách Đơn Hàng</h1>

    <table>
        <thead>
            <tr>
                <th>Mã Đơn Hàng</th>
                <th>Tên Khách Hàng</th>
                <th>Tổng Tiền</th>
                <th>Tình Trạng</th>
                <th>Ngày Tạo</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo number_format($row['total'], 2); ?> VND</td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo date('d-m-Y H:i:s', strtotime($row['created_at'])); ?></td>
                    <td class="action-buttons">
                        <a href="edit_order.php?id=<?php echo $row['id']; ?>" class="edit">Sửa</a>
                        <a href="delete_order.php?id=<?php echo $row['id']; ?>" class="delete">Xóa</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>

<?php $conn->close(); ?>
