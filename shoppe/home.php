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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/Grid.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">

    <!-- <link rel="stylesheet" href="./css/reset.css"> -->
    <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" /> -->
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;&display=swap&subnet=vietnamese"
        rel="stylesheet">

</head>




<body>
    <!-- header -->
    <div class="app">
        <header class="header">
            <div class="grid wide">
                <nav class="header__navbar hide-on-mobile-tablet">
                    <ul class="header__navbar-list">
                        <li class="header__navbar-item header__navbar-item-has-qr header__navbar-item--separate">
                            Vào cửa hàng trên ứng dụng TikID
                            <!-- header-qr-code -->
                            <div class="header__qr">
                                <img src="./assets/img/img1.png" alt="QR code" class="header__qr-img">
                                <div class="header__qr-apps">
                                    <a href="https://play.google.com/store/search?q=shopee&c=apps&hl=en-US"
                                        class="header__qr-link">
                                        <img src="./assets/img/img3.png" alt="Google play"
                                            class="header__qr-download-img">
                                    </a>
                                    <a href="https://apps.apple.com/vn/app/shopee-mua-s%E1%BA%AFm-online/id959841449"
                                        class="header__qr-link">
                                        <img src="./assets/img/img2.png" alt="App store"
                                            class="header__qr-download-img">
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="header__navbar-item">
                            <span class="header__navbar-title--no-pointer">Kết nối</span>
                            <a href="https://www.facebook.com/ShopeeVN" class="header__navbar-icon-link">
                                <i class="header__navbar-icon fab fa-facebook"></i>
                            </a>
                            <a href="https://www.instagram.com/Shopee_VN" class="header__navbar-icon-link">
                                <i class="header__navbar-icon fab fa-instagram"></i>
                            </a>
                        </li>
                    </ul>

                    <div class="header__navbar-icon-link">
                        <ul class="header__navbar-list">
                            <li class="header__navbar-item header__navbar-item-has-notify">
                                <a href="" class="header__navbar-item-link">
                                    <a href="" class="header__navbar-icon-link">
                                        <i class="header__navbar-icon far fa-bell"></i>
                                    </a>
                                    Thông báo
                                    <div class="header__notify">
                                        <header class="header__notify-header">
                                            <h3>Thông báo mới nhận</h3>
                                        </header>
                                        <ul class="header__notify-list">

                                        </ul>
                                        <footer class="header__notify-footer">
                                            <a href="" class="header_notify-footer-btn">Xem tất cả</a>
                                        </footer>
                                    </div>

                            <li class="header__navbar-item">
                                <a href="" class="header__navbar-item-link">
                                    <a href="https://help.shopee.vn/portal/4" class="header__navbar-icon-link">
                                        <i class="header__navbar-icon far fa-question-circle"></i>
                                        Trợ giúp
                                    </a>
                                </a>
                            </li>
                            <li class="header__navbar-item header__navbar-user">
                                <img src="../assets/img/product2.jpg" alt="" class="header__navbar-user-img">
                                <span class="header__navbar-user-name">User</span>

                                <ul class="header__navbar-user-menu">
                                    <li class="header__navbar-user-item">
                                        <a href="">Tài khoản của tôi</a>
                                    </li>
                                    <li class="header__navbar-user-item">
                                        <a href="">Địa chỉ của tôi </a>
                                    </li>
                                    <li class="header__navbar-user-item">
                                        <a href="">Lịch sử đơn hàng</a>
                                    </li>
                                    <li class="header__navbar-user-item header__navbar-user-item--separate">
                                        <a href="http://localhost/BTL-PTUDWeb/login.php">Đăng xuất</a>
                                    </li>
                                </ul>
                            </li>

                            <div class="modal" id="modal" style="display: none;">
                                <div class="modal__overlay" onclick="closeModal()"></div>
                                <div class="modal__body">
                                    <div class="modal__inner">


                                    </div>
                                    </a>
                                    </li>
                        </ul>
                </nav>
                <!-- header with search  -->
                <div class="header-with-search">
                    <label for="mobile-search-checkbox" class="header__mobile-search">
                        <i class="header__mobile-search-icon fas fa-search"></i>
                    </label>
                    <div class="header__logo hide-on-tablet">
                        <a href="#" class="header__logo-link">
                            <img src="../assets/img/shopee-logo.jpg" alt="">
                        </a>
                    </div>
                    <input type="checkbox" hidden id="mobile-search-checkbox" class="header__search-checkbox">
                    <div class="header__search">
                        <div class="header__search-input-wrap">
                            <input type="text" class="header__search-input" placeholder="Nhập để tìm kiếm sản phẩm">

                            <div class="header__search-history">
                                <h3 class="header__search-history-heading">Lịch sử tìm kiếm</h3>
                                <ul class="header__search-history-list">
                                    <li class="header__search-history-item">
                                        <a href="">Đồ Công Nghệ</a>
                                    </li>

                                </ul>
                            </div>

                        </div>
                        <div class="header__search-select">
                            <span class="header__search-select-label">Trong shop</span>
                            <i class="header__search-select-icon fas fa-angle-down"></i>
                            <ul class="header__search-option">
                                <li class="header__search-option-item">
                                    <span>Trong shop</span>
                                    <i class="fas fa-check"></i>
                                </li>
                                <li class="header__search-option-item">
                                    <span>Ngoài shop</span>
                                    <i class="fas fa-check"></i>

                                </li>
                            </ul>
                        </div>
                        <button class="header__search-btn">
                            <i class="header__search-btn-icon fas fa-search"></i>
                        </button>
                    </div>
                    <!-- cart -->
                    <div class="header__cart">
                        <div class="header__cart-wrap">
                            <i class="header__cart-icon fas fa-shopping-cart"></i>
                            <!-- no cart -->
                            <div class="header__cart-list">
                                <h4 class="header__cart-heading">Sản phẩm đã thêm</h4>
                                <ul class="header__cart-list--item">
                                </ul>
                                <div class="header__cart-total-wrap">
                                    <span class="header__cart-total-left"></span>
                                    <span class="header__cart-total" id="cart-total-left"></span>
                                    <a class="header__cart-buy btn btn--primary order-button">Đặt Hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="header__sort-bar">
                <li class="header__sort-item">
                    <a href="" class="header__sort-link">Liên quan</a>
                </li>
                <li class="header__sort-item header__sort-link--active">
                    <a href="" class="header__sort-link">Mới nhất</a>
                </li>
                <li class="header__sort-item">
                    <a href="" class="header__sort-link">Bán chạy</a>
                </li>
                <li class="header__sort-item">
                    <a href="" class="header__sort-link">Giá</a>
                </li>
            </ul>
        </header>
        <!-- container -->
        <div class="app__container">
            <div class="grid wide">
                <div class="grid__row app__content">
                    <div class="grid__column-2">
                        <nav class="category">
                            <h3 class="category__heading hide-on-mobile-tablet">
                                <i class="category__heading-icon fas fa-list"></i>
                                Danh mục
                            </h3>
                            <ul class="category-list">
                                <li class="category-item category-item--active" data-category="all">
                                    <a href="#" class="category-item__link">Tất Cá</a>
                                </li>

                            </ul>
                        </nav>
                    </div>

                    <div class="grid__column-10">
                        <div class="home-filter hide-on-mobile-tablet">
                            <span class="home-filter__label">Sắp xếp theo</span>
                            <button class="home-filter__btn btn">Phổ biến</button>
                            <button class="home-filter__btn btn btn--primary">Mới nhất</button>
                            <button class="home-filter__btn btn">Bán chạy</button>
                            <div class="select-input select-input--separate">
                                <span class="select-input__label">Giá</span>
                                <div class="select-input__list">
                                    <li class="select-input__item" value="thấp đến cao">
                                        <a href="" class="select-input__link">Giá thấp đến cao</a>
                                    </li>
                                    <li class="select-input__item" value="cao đến thấp">
                                        <a href="" class="select-input__link">Giá cao đến thấp</a>
                                    </li>
                                </div>
                                <i class="select-input__icon fas fa-angle-down"></i>
                            </div>
                        </div>

                        <div class="home-product">
                            <div class="grid__row" id="list-products">
                                <?php
                                // Số sản phẩm trên mỗi trang
                                $limit = 8;

                                // Lấy số trang hiện tại từ URL (mặc định là trang 1)
                                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                $offset = ($page - 1) * $limit;

                                // Đếm tổng số sản phẩm
                                $total_query = "SELECT COUNT(*) AS total FROM products";
                                $total_result = $conn->query($total_query);
                                $total_products = $total_result->fetch_assoc()['total'];

                                // Tính tổng số trang
                                $total_pages = ceil($total_products / $limit);

                                // Lấy dữ liệu sản phẩm cho trang hiện tại
                                $sql = "SELECT * FROM products LIMIT $offset, $limit";
                                $result = $conn->query($sql);
                                ?>
                                <div id="list-view" style="display: flex; flex-wrap: wrap; gap: 20px;">
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                        <div id="product" onclick='showProductModal(<?php echo json_encode($row); ?>)'
                                            style="cursor: pointer; width: 230px; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-top: 10px;">
                                            <div style="position: relative;">
                                                <img src="<?php echo htmlspecialchars($row['image']); ?>"
                                                    alt="product image"
                                                    style="width: 100%; height: 180px; object-fit: cover;">
                                                <div
                                                    style="position: absolute; top: 10px; left: 10px; background: red; color: white; padding: 5px; border-radius: 5px; font-size: 12px;">
                                                    Yêu thích</div>
                                                <div
                                                    style="position: absolute; top: 10px; right: 10px; background: orange; color: white; padding: 5px; border-radius: 5px; font-size: 12px;">
                                                    Giảm <?php echo $row['discount']; ?> %
                                                </div>
                                            </div>
                                            <div style="padding: 10px;">
                                                <h3 style="font-size: 16px; margin: 0; color: #333;">
                                                    <?php echo $row['name']; ?>
                                                </h3>
                                                <p style="font-size: 14px; color: gray; margin: 5px 0;">
                                                    <?php echo $row['brand']; ?> - <?php echo $row['origin']; ?>
                                                </p>
                                                <p style="margin: 5px 0; color: #999; text-decoration: line-through;">
                                                    <?php echo number_format($row['old_price'], 0, ',', '.'); ?> đ
                                                </p>
                                                <p style="margin: 5px 0; font-size: 18px; color: red; font-weight: bold;">
                                                    <?php echo number_format($row['current_price'], 0, ',', '.'); ?> đ
                                                </p>
                                                <p style="margin: 5px 0; color: #555;"><?php echo $row['sold']; ?> đã bán
                                                </p>
                                                <div style="color: gold;">
                                                    <?php for ($i = 0; $i < $row['rating']; $i++) {
                                                        echo '<i class="fas fa-star"></i>';
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <div id="product-modal"
                                style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1000;">
                                <div
                                    style="width: 400px; margin: 100px auto; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.3); position: relative;">
                                    <div id="modal-content" style="padding: 20px;">
                                        <!-- Nội dung chi tiết sản phẩm sẽ được thêm vào đây -->
                                    </div>

                                    <button id="close-button"
                                        style="position: absolute; top: 0; right: 0; padding: 5px 10px; background: transparent; border: none; color: black; font-size: 20px; cursor: pointer;">X</button>
                                </div>
                            </div>

                            <script>
                                // Mở modal khi nhấn vào sản phẩm
                                function showProductModal(product) {
                                    const modal = document.getElementById('product-modal');
                                    const modalContent = document.getElementById('modal-content');

                                    modalContent.innerHTML = `
        <img src="${product.image}" alt="product image" style="width: 100%; height: 200px; object-fit: cover; border-bottom: 1px solid #ddd;">
        <h2 style="margin: 10px 0;font-size: 3rem;line-height: 3rem;">${product.name}</h2>
        <p>Thương hiệu: ${product.brand}</p>
        <p>Xuất xứ: ${product.origin}</p>
        <p>Giá cũ: <span style="text-decoration: line-through;font-size: 1rem; color: gray;">${parseInt(product.old_price).toLocaleString()} đ</span></p>
        <p>Giá hiện tại: <span style="font-size: 3rem;color: red;">${parseInt(product.current_price).toLocaleString()} đ</span></p>
        <button id="add-to-cart" style="display: block; margin: 20px auto; padding: 10px 20px; background: red; color: white; border: none; border-radius: 5px; cursor: pointer;">Add to cart</button>
    `;

                                    modal.style.display = 'block';

                                    // Xử lý sự kiện cho nút "Add to cart"
                                    document.getElementById('add-to-cart').addEventListener('click', () => {
                                        const cartList = document.querySelector('.header__cart-list--item');

                                        // Thêm sản phẩm vào giỏ hàng
                                        const li = document.createElement('li');
                                        li.className = 'header__cart-item';
                                        li.innerHTML = `
            <img src="${product.image}" alt="${product.name}" class="header__cart-item-img" style="max-width: 50px;">
            <div class="header__cart-item-info">
                <h5 class="header__cart-item-name">${product.name}</h5>
            </div>
        `;
                                        cartList.appendChild(li);

                                        // Tắt modal sau khi thêm sản phẩm vào giỏ hàng
                                        modal.style.display = 'none';
                                    });
                                }

                                // Đóng modal khi nhấn nút "X"
                                document.getElementById('close-button').addEventListener('click', () => {
                                    document.getElementById('product-modal').style.display = 'none';
                                });

                                // Đóng modal khi nhấn ra ngoài modal
                                window.addEventListener('click', (event) => {
                                    const modal = document.getElementById('product-modal');
                                    if (event.target === modal) {
                                        modal.style.display = 'none';
                                    }
                                });


                                // Hàm sắp xếp sản phẩm theo giá
                                function sortProducts(order) {
                                    // Lấy danh sách các sản phẩm
                                    const productsContainer = document.getElementById('list-products');
                                    const products = Array.from(productsContainer.querySelectorAll('#product'));

                                    // Sắp xếp sản phẩm dựa trên giá
                                    products.sort((a, b) => {
                                        const priceA = parseInt(a.querySelector('p:nth-of-type(3)').textContent.replace(/[^0-9]/g, ''));
                                        const priceB = parseInt(b.querySelector('p:nth-of-type(3)').textContent.replace(/[^0-9]/g, ''));

                                        return order === 'asc' ? priceA - priceB : priceB - priceA;
                                    });

                                    // Xóa các sản phẩm cũ khỏi container
                                    productsContainer.innerHTML = '';

                                    // Thêm sản phẩm đã sắp xếp vào container
                                    products.forEach(product => productsContainer.appendChild(product));
                                }

                                // Gắn sự kiện click cho các nút sắp xếp
                                const sortLowToHigh = document.querySelector('.select-input__item[value="thấp đến cao"]');
                                const sortHighToLow = document.querySelector('.select-input__item[value="cao đến thấp"]');

                                if (sortLowToHigh) {
                                    sortLowToHigh.addEventListener('click', (event) => {
                                        event.preventDefault(); // Ngăn điều hướng liên kết
                                        sortProducts('asc');
                                    });
                                }

                                if (sortHighToLow) {
                                    sortHighToLow.addEventListener('click', (event) => {
                                        event.preventDefault(); // Ngăn điều hướng liên kết
                                        sortProducts('desc');
                                    });
                                }


                                // Xử lý sự kiện đặt hàng
                                const orderButton = document.querySelector('.order-button');
                                const cartList = document.querySelector('.header__cart-list--item');
                                const cartTotalWrap = document.querySelector('.header__cart-total-wrap'); // Lấy phần giỏ hàng để ẩn

                                if (orderButton) {
                                    orderButton.addEventListener('click', () => {
                                        // Kiểm tra xem giỏ hàng có sản phẩm không
                                        if (cartList && cartList.children.length > 0) {
                                            const confirmation = confirm('Bạn có chắc chắn muốn đặt hàng?');
                                            if (confirmation) {
                                                // Xóa toàn bộ sản phẩm trong giỏ hàng
                                                cartList.innerHTML = '';

                                                // Hiển thị thông báo đặt hàng thành công
                                                alert('Đặt hàng thành công!');


                                            }
                                        } else {
                                            alert('Giỏ hàng của bạn đang trống! Vui lòng thêm sản phẩm trước khi đặt hàng.');
                                        }
                                    });
                                }
                            </script>


                            <!-- pagination -->
                            <div class="pagination home-product__pagination">
                                <?php if ($page > 1): ?>
                                    <li class="pagination-item">
                                        <a href="?page=<?php echo $page - 1; ?>" class="pagination-item__link">
                                            <i class="pagination-item__icon fas fa-angle-left"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="pagination-item <?php echo ($i == $page) ? 'pagination-item--active' : ''; ?>">
                                        <a href="?page=<?php echo $i; ?>" class="pagination-item__link"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>

                                <?php if ($page < $total_pages): ?>
                                    <li class="pagination-item">
                                        <a href="?page=<?php echo $page + 1; ?>" class="pagination-item__link">
                                            <i class="pagination-item__icon fas fa-angle-right"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
    <!-- footer -->
    <footer class="footer">
        <div class="grid wide footer__content">
            <div class="grid__row">
                <div class="col l-2-4 m-4 c-6">
                    <h3 class="footer__heading">Chăm sóc khách hàng</h3>
                    <ul class="footer-list">
                        <li class="footer-item">
                            <a href="https://help.shopee.vn/portal/4" class="footer-item__link">Trung tâm trợ
                                giúp</a>
                        </li>
                        <li class="footer-item">
                            <a href="https://shopee.vn/blog/" class="footer-item__link">Shopee Blog</a>
                        </li>
                        <li class="footer-item">
                            <a href="https://help.shopee.vn/portal/4/article/79180-[Th%c3%a0nh-vi%c3%aan-m%e1%bb%9bi]-L%c3%a0m-sao-%c4%91%e1%bb%83-mua-h%c3%a0ng-%2F-%c4%91%e1%ba%b7t-h%c3%a0ng-tr%c3%aan-%e1%bb%a9ng-d%e1%bb%a5ng-Shopee%3F"
                                class="footer-item__link">Hướng dẫn mua hàng</a>
                        </li>
                    </ul>
                </div>
                <div class="col l-2-4 m-4 c-6">
                    <h3 class="footer__heading">Giới thiệu</h3>
                    <ul class="footer-list">
                        </li>
                        <li class="footer-item">
                            <a href="https://careers.shopee.vn/about" class="footer-item__link">Giới thiệu</a>
                        </li>
                        <li class="footer-item">
                            <a href="https://careers.shopee.vn/jobs" class="footer-item__link">Tuyển dụng</a>
                        </li>
                        <li class="footer-item">
                            <a href="https://help.shopee.vn/portal/4/article/77242" class="footer-item__link">Điều
                                khoản</a>
                        </li>
                    </ul>
                </div>
                <div class="col l-2-4 m-4 c-6">
                    <h3 class="footer__heading">Thanh Toán</h3>
                    <ul class="footer-list">
                        <li class="footer-item">
                            <a href="https://www.mbbank.com.vn/registration" class="footer-item__link">Mb Bank</a>
                        </li>
                        <li class="footer-item">
                            <a href="https://techcombank.com/khach-hang-ca-nhan/chi-tieu/tai-khoan"
                                class="footer-item__link">Techcom Bank</a>
                        </li>
                        <li class="footer-item">
                            <a href="https://ebank.bidv.com.vn/DKNHDT/" class="footer-item__link">Bidv</a>
                        </li>
                    </ul>
                </div>
                <div class="col l-2-4 m-4 c-6">
                    <h3 class="footer__heading">Theo dõi</h3>
                    <ul class="footer-list">
                        <li class="footer-item">
                            <a href="https://www.facebook.com/ShopeeVN" class="footer-item__link">
                                <i class="footer-item__icon fab fa-facebook"></i>
                                Facebook</a>
                        </li>
                        <li class="footer-item">
                            <a href="https://www.instagram.com/Shopee_VN" class="footer-item__link">
                                <i class="footer-item__icon fab fa-instagram"></i>
                                Instagram</a>
                        </li>
                        <li class="footer-item">
                            <a href="https://www.linkedin.com/" class="footer-item__link">
                                <i class="footer-item__icon fab fa-linkedin"></i>
                                Linkedin</a>
                        </li>
                    </ul>
                </div>
                <div class="col l-2-4 m-8 c-12">
                    <h3 class="footer__heading">Vào cửa hàng trên ứng dụng</h3>
                    <div class="footer__download">
                        <img src="../assets/img/img1.png" alt="Download QR" class="footer__download-qr">
                        <div class="footer__download-apps">
                            <a href="https://play.google.com/store/search?q=shopee&c=apps&hl=en-US"
                                class="footer__download-app-link">
                                <img src="../assets/img/img3.png" alt="Google play" class="footer__download-app-img">
                            </a>
                            <a href="https://apps.apple.com/vn/app/shopee-mua-s%E1%BA%AFm-online/id959841449"
                                class="footer__download-app-link">
                                <img src="../assets/img/img2.png" alt="App store" class="footer__download-app-img">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer__bottom">
            <div class="grid wide ">
                <p class="footer__text">2024 - Bản quyền thuộc về Công ty My Copany</p>
            </div>
        </div>
    </footer>
    </div>
</body>

</html>