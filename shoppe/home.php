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
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/Grid.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="stylesheet" href="./assets/css/list-product.css">

    <!-- <link rel="stylesheet" href="./css/reset.css"> -->
    <link rel="stylesheet" href=".assets/fonts/fontawesome-free-6.6.0-web/css/fontawesome.min.css">
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
                            <li class="header__navbar-item header__navbar-item--strong header__navbar-item--separate"
                                onclick="showRegisterForm()">
                                <a class="header__navbar-item-link">Đăng ký</a>
                            </li>
                            <li class="header__navbar-item header__navbar-item--strong" onclick="showLoginForm()">
                                <a class="header__navbar-item-link">Đăng nhập</a>
                            </li>
                            <li class="header__navbar-item header__navbar-user">
                                <img src="./assets/img/product2.jpg" alt="" class="header__navbar-user-img">
                                <span class="header__navbar-user-name"> Nguyễn Nhân Đạt</span>

                                <ul class="header__navbar-user-menu">
                                    <li class="header__navbar-user-item">
                                        <a href="">Tài khoản của tôi</a>
                                    </li>
                                    <li class="header__navbar-user-item">
                                        <a href="">Địa chỉ của tôi </a>
                                    </li>
                                    <li class="header__navbar-user-item">
                                        <a href="">Đơn mua</a>
                                    </li>
                                    <li class="header__navbar-user-item header__navbar-user-item--separate">
                                        <a href="">Đăng xuất</a>
                                    </li>
                                </ul>
                            </li>

                            <div class="modal" id="modal" style="display: none;">
                                <div class="modal__overlay" onclick="closeModal()"></div>
                                <div class="modal__body">
                                    <div class="modal__inner">
                                        <!-- ------------- register-form ------------------>
                                        <div class="auth-form" id="registerModal" style="display: none;">
                                            <div class="auth-form__container">
                                                <div class="auth-form__header">
                                                    <h3 class="auth-form__heading">Đăng ký</h3>
                                                    <!-- Đã thêm id "switchToLogin" -->
                                                    <span class="auth-form__switch-btn" id="switchToLogin">Đăng
                                                        nhập</span>
                                                </div>
                                                <div class="auth-form__form">
                                                    <div class="auth-form__group">
                                                        <input type="text" class="auth-form__input"
                                                            placeholder="Nhập Email">
                                                    </div>
                                                    <div class="auth-form__group">
                                                        <input type="text" class="auth-form__input"
                                                            placeholder="Nhập mật khẩu">
                                                    </div>
                                                    <div class="auth-form__group">
                                                        <input type="text" class="auth-form__input"
                                                            placeholder="Nhập lại mật khẩu">
                                                    </div>
                                                </div>
                                                <div class="auth-form__aside">
                                                    <p class="auth-form__policy-text">
                                                        Bằng việc đăng ký, bạn đã đồng ý với Shoppe về
                                                        <a href="https://help.shopee.vn/portal/4/article/77242"
                                                            class="auth-form__text-link">Điều khoản dịch vụ</a> và
                                                        <a href="https://help.shopee.vn/portal/4/article/77244"
                                                            class="auth-form__text-link">Chính sách bảo mật</a>
                                                    </p>
                                                </div>
                                                <div class="auth-form__controls">
                                                    <button class="btn btn--normal auth-form__controls-back">TRỞ
                                                        LẠI</button>
                                                    <button class="btn btn--primary">ĐĂNG KÝ</button>
                                                </div>
                                            </div>
                                            <div class="auth-form__socials">
                                                <a href="https://www.facebook.com/ShopeeVN"
                                                    class="auth-form__socials-facebook btn btn--size-s btn--with-icon">
                                                    <i class="auth-form__socials-icon fab fa-facebook-square"></i>
                                                    <span class="auth-form__social-title">Kết nối với Facebook</span>
                                                </a>
                                                <a href="https://www.google.com/intl/en_uk/chrome/"
                                                    class="auth-form__socials-google btn btn--size-s btn--with-icon">
                                                    <i class="auth-form__socials-icon fab fa-google"></i>
                                                    <span class="auth-form__social-title">Kết nối với Google</span>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- -------------- login-form ------------------>
                                        <div class="auth-form" id="loginModal" style="display: none;">
                                            <div class="auth-form__container">
                                                <div class="auth-form__header">
                                                    <h3 class="auth-form__heading">Đăng nhập</h3>
                                                    <!-- Đã thêm id "switchToRegister" -->
                                                    <span class="auth-form__switch-btn" id="switchToRegister">Đăng
                                                        ký</span>
                                                </div>
                                                <div class="auth-form__form">
                                                    <div class="auth-form__group">
                                                        <input type="text" class="auth-form__input"
                                                            placeholder="Nhập Email">
                                                    </div>
                                                    <div class="auth-form__group">
                                                        <input type="text" class="auth-form__input"
                                                            placeholder="Nhập mật khẩu">
                                                    </div>
                                                </div>
                                                <div class="auth-form__aside">
                                                    <div class="auth-form__help">
                                                        <a href=""
                                                            class="auth-form__help-link auth-form__help-forgot">Quên mật
                                                            khẩu</a>
                                                        <a href="https://help.shopee.vn/portal/4"
                                                            class="auth-form__help-link">Cần trợ giúp?</a>
                                                    </div>
                                                </div>
                                                <div class="auth-form__controls">
                                                    <button class="btn btn--normal auth-form__controls-back">TRỞ
                                                        LẠI</button>
                                                    <button class="btn btn--primary">ĐĂNG NHẬP</button>
                                                </div>
                                            </div>
                                            <div class="auth-form__socials">
                                                <a href="https://www.facebook.com/ShopeeVN"
                                                    class="auth-form__socials-facebook btn btn--size-s btn--with-icon">
                                                    <i class="auth-form__socials-icon fab fa-facebook-square"></i>
                                                    <span class="auth-form__social-title">Đăng nhập với Facebook</span>
                                                </a>
                                                <a href="https://www.google.com/intl/en_uk/chrome/"
                                                    class="auth-form__socials-google btn btn--size-s btn--with-icon">
                                                    <i class="auth-form__socials-icon fab fa-google"></i>
                                                    <span class="auth-form__social-title">Đăng nhập với Google</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                            <img src="./assets/img/shopee-logo.jpg" alt="">
                        </a>
                    </div>
                    <input type="checkbox" hidden id="mobile-search-checkbox" class="header__search-checkbox">
                    <div class="header__search">
                        <div class="header__search-input-wrap">
                            <input type="text" class="header__search-input" placeholder="Nhập để tìm kiếm sản phẩm">
                            <!-- search history -->
                            <div class="header__search-history">
                                <h3 class="header__search-history-heading">Lịch sử tìm kiếm</h3>
                                <ul class="header__search-history-list">
                                    <li class="header__search-history-item">
                                        <a href="">Đồ Công Nghệ</a>
                                    </li>
                                    <li class="header__search-history-item">
                                        <a href="">Đồ Ăn</a>
                                    </li>
                                    <li class="header__search-history-item">
                                        <a href="">Thời Trang</a>
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
                            <span class="header__cart-notice">0</span>
                            <!-- no cart -->
                            <div class="header__cart-list">
                                <img src="./assets/img/no-product.png" alt="" class="header__cart-no-cart-img">
                                <span class="header__cart-list-no-cart-msg">
                                    Chưa có sản phẩm
                                </span>
                                <h4 class="header__cart-heading">Sản phẩm đã thêm</h4>

                                <!-- has cart item -->
                                <ul class="header__cart-list-item" id="cart-items"></ul>

                                <!-- Phần hiển thị tổng tiền -->
                                <div class="header__cart-total-wrap">
                                    <span class="header__cart-total-left"></span>
                                    <span class="header__cart-total" id="cart-total-left"></span>
                                    <a class="header__cart-buy btn btn--primary">Đặt Hàng</a>
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
                    <!-- <marquee class="message-shopee hide-on-mobile-tablet" behavior="alternate" direction="left" scrollamount="8" hidden>
                        WELCOM TO SHOPEE
                    </marquee> -->
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
                                <li class="category-item" data-category="tech">
                                    <a href="#" class="category-item__link">Đồ Công Nghệ</a>
                                </li>
                                <li class="category-item" data-category="food">
                                    <a href="#" class="category-item__link">Đồ Ăn</a>
                                </li>
                                <li class="category-item" data-category="fashion">
                                    <a href="#" class="category-item__link">Thời Trang</a>
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
                            <div class="home-filter__page">
                                <span class="home-filter__page-num">
                                    <span class="home-filter__page-current">1</span>/14
                                </span>
                                <div class="home-filter__page-control">
                                    <a href="" class="home-filter__page-btn home-filter__page-btn--disable">
                                        <i class="home-filter__page-icon fas fa-angle-left"></i>
                                    </a>
                                    <a href="" class="home-filter__page-btn">
                                        <i class="home-filter__page-icon fas fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- mobile-category -->
                        <nav class="mobile-category ">
                            <ul class="mobile-category__list hide-on-mobile-tablet">
                                <li class="mobile-category__item">
                                    <a href="" class="mobile-category__link">Dụng cụ và thiết bị tiền ích</a>
                                </li>
                                <li class="mobile-category__item">
                                    <a href="" class="mobile-category__link">Dụng cụ và thiết bị tiền ích</a>
                                </li>
                                <li class="mobile-category__item">
                                    <a href="" class="mobile-category__link">Dụng cụ và thiết bị tiền ích</a>
                                </li>
                                <li class="mobile-category__item">
                                    <a href="" class="mobile-category__link">Dụng cụ và thiết bị tiền ích</a>
                                </li>
                                <li class="mobile-category__item">
                                    <a href="" class="mobile-category__link">Dụng cụ và thiết bị tiền ích</a>
                                </li>
                                <li class="mobile-category__item">
                                    <a href="" class="mobile-category__link">Dụng cụ và thiết bị tiền ích</a>
                                </li>
                                <li class="mobile-category__item">
                                    <a href="" class="mobile-category__link">Dụng cụ và thiết bị tiền ích</a>
                                </li>
                                <li class="mobile-category__item">
                                    <a href="" class="mobile-category__link">Dụng cụ và thiết bị tiền ích</a>
                                </li>
                            </ul>
                        </nav>

                        <!-- home-product -->
                        <div class="home-product">
                            <div class="grid__row" id="list-products">
                                <div id="list-view">
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                        <div onclick='showProductModal(<?php echo json_encode($row); ?>)' 
                                            style="cursor: pointer; width: calc(100% / 4 ); border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                            <div style="position: relative;">
                                                <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="product image">
                                                <div class="favorite-badge">Yêu thích</div>
                                                <div class="discount-badge"><?php echo $row['discount']; ?>% Giảm</div>
                                            </div>
                                            <div class="info">
                                                <h3><?php echo $row['name']; ?></h3>
                                                <p><?php echo $row['brand']; ?> - <?php echo $row['origin']; ?></p>
                                                <p class="old-price"><?php echo number_format($row['old_price'], 0, ',', '.'); ?> đ</p>
                                                <p class="current-price"><?php echo number_format($row['current_price'], 0, ',', '.'); ?> đ</p>
                                                <p class="sold"><?php echo $row['sold']; ?> đã bán</p>
                                                <div class="rating">
                                                    <?php for ($i = 0; $i < $row['rating']; $i++) {
                                                        echo '<i class="fas fa-star"></i>';
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>


                        <!-- Modal hiển thị thông tin chi tiết sản phẩm -->
                        <div id="product-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1000;">
                            <div style="width: 400px; margin: 100px auto; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.3);">
                                <div id="modal-content" style="padding: 20px;">
                                    <!-- Nội dung chi tiết sản phẩm sẽ được thêm vào đây -->
                                </div>
                                <button id="close-modal" style="display: block; margin: 0 auto 20px; padding: 10px 20px; background: red; color: white; border: none; border-radius: 5px; cursor: pointer;">Đóng</button>
                            </div>
                        </div>
                    </div>

                    <script>
                        function showProductModal(product) {
                            const modal = document.getElementById('product-modal');
                            const modalContent = document.getElementById('modal-content');

                            modalContent.innerHTML = `
                                    <img src="${product.image}" alt="product image" style="width: 100%; height: 200px; object-fit: cover; border-bottom: 1px solid #ddd;">
                                    <h2 style="margin: 10px 0;">${product.name}</h2>
                                    <p>Thương hiệu: ${product.brand}</p>
                                    <p>Xuất xứ: ${product.origin}</p>
                                    <p>Giá cũ: <span style="text-decoration: line-through; color: gray;">${parseInt(product.old_price).toLocaleString()} đ</span></p>
                                    <p>Giá hiện tại: <span style="color: red; font-size: 20px;">${parseInt(product.current_price).toLocaleString()} đ</span></p>
                                    <p>Đã bán: ${product.sold}</p>
                                    <p>Đánh giá: ${'⭐'.repeat(product.rating)}</p>
                                `;

                            modal.style.display = 'block';
                        }

                        document.getElementById('close-modal').addEventListener('click', () => {
                            document.getElementById('product-modal').style.display = 'none';
                        });

                        // Đóng modal khi nhấn ra ngoài
                        window.addEventListener('click', (event) => {
                            const modal = document.getElementById('product-modal');
                            if (event.target === modal) {
                                modal.style.display = 'none';
                            }
                        });
                    </script>




                    <!-- Thông tin sản phẩm -->
                    <div class="product-modal" id="product-modal">
                        <div class="product-modal__content">
                            <!-- Nút X đóng modal chung -->
                            <button class="close-modal" id="close-modal">X</button>
                            <div class="modal-wraper">
                                <div class="product-modal__img">
                                    <img id="modal-img" src="" alt="">
                                </div>
                                <div class="product-modal__details">
                                    <!-- Nút X đóng tiêu đề -->
                                    <h2 id="modal-title">
                                        Tên sản phẩm
                                        <button class="close-title-btn" id="close-title-btn">X</button>
                                    </h2>
                                    <div class="modal-price">
                                        <span id="modal-old-price"></span>
                                        <span id="modal-current-price"></span>
                                    </div>
                                    <button class="order-btn" id="order-btn">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <!-- pagination -->
            <div class="pagination home-product__pagination">
                <li class="pagination-item">
                    <a href="" class="pagination-item__link">
                        <i class="pagination-item__icon fas fa-angle-left"></i>
                    </a>
                </li>

                <li class="pagination-item pagination-item--active">
                    <a href="" class="pagination-item__link">1</a>
                </li>
                <li class="pagination-item">
                    <a href="" class="pagination-item__link">2</a>
                </li>
                <li class="pagination-item">
                    <a href="" class="pagination-item__link">3</a>
                </li>
                <li class="pagination-item">
                    <a href="" class="pagination-item__link">4</a>
                </li>
                <li class="pagination-item">
                    <a href="" class="pagination-item__link">5</a>
                </li>
                <li class="pagination-item">
                    <a href="" class="pagination-item__link">6</a>
                </li>
                <li class="pagination-item">
                    <a href="" class="pagination-item__link">...</a>
                </li>
                <li class="pagination-item">
                    <a href="" class="pagination-item__link">14</a>
                </li>

                <li class="pagination-item">
                    <a href="" class="pagination-item__link">
                        <i class="pagination-item__icon fas fa-angle-right"></i>
                    </a>
                </li>
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
                        <img src="./assets/img/img1.png" alt="Download QR" class="footer__download-qr">
                        <div class="footer__download-apps">
                            <a href="https://play.google.com/store/search?q=shopee&c=apps&hl=en-US"
                                class="footer__download-app-link">
                                <img src="./assets/img/img3.png" alt="Google play" class="footer__download-app-img">
                            </a>
                            <a href="https://apps.apple.com/vn/app/shopee-mua-s%E1%BA%AFm-online/id959841449"
                                class="footer__download-app-link">
                                <img src="./assets/img/img2.png" alt="App store" class="footer__download-app-img">
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
    <script src="./assets/script.js"></script>
</body>

</html>