<?php
// Kết nối với cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Quản Lý Sản Phẩm</h1>
    </header>
    <main>
    <div class="search-container">
        <input type="text" id="search" placeholder="Tìm kiếm sản phẩm..." onkeyup="searchProduct()">
        <button onclick="location.href='add_product.php'">Thêm Sản Phẩm</button>
        <button onclick="location.href='http://localhost/My%20project/BTL-PTUDWeb/shoppe/ADMIN/php/user/index_user.php'"> Quản lý người dùng</button>
    </div>
    <table id="product-table">
        <thead>
            <tr>
                <th>Tên Sản Phẩm</th>
                <th>Hình Ảnh</th>
                <th>Giá Cũ</th>
                <th>Giá Mới</th>
                <th>Đã Bán</th>
                <th>Thương Hiệu</th>
                <th>Xuất Xứ</th>
                <th>Giảm Giá (%)</th>
                <th>Đánh Giá</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td> <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="product image" style="width: 100px; height: auto;"> </td>
                    <td><?php echo number_format($row['old_price'], 0, ',', '.'); ?>₫</td>
                    <td><?php echo number_format($row['current_price'], 0, ',', '.'); ?>₫</td>
                    <td><?php echo $row['sold']; ?></td>
                    <td><?php echo $row['brand']; ?></td>
                    <td><?php echo $row['origin']; ?></td>
                    <td><?php echo $row['discount']; ?>%</td>
                    <td>
                        <?php
                        // Hiển thị sao cho đánh giá
                        for ($i = 0; $i < $row['rating']; $i++) {
                            echo '<i class="fas fa-star"></i>';
                        }
                        ?>
                    </td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $row['id']; ?>">Sửa</a> |
                        <a href="delete_product.php?id=<?php echo $row['id']; ?>">Xóa</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>
<script>

function searchProduct() {
    var input = document.getElementById("search").value.toLowerCase(); 
    var table = document.getElementById("product-table"); 
    var rows = table.getElementsByTagName("tr"); 

    
    for (var i = 1; i < rows.length; i++) { 
        var cells = rows[i].getElementsByTagName("td");


        var productName = cells[0].textContent || cells[0].innerText; 
        if (productName.toLowerCase().indexOf(input) > -1) {
            rows[i].style.display = ""; 
        } else {
            rows[i].style.display = "none"; 
        }
    }
}
</script>

</body>
</html>

<?php $conn->close(); ?>
