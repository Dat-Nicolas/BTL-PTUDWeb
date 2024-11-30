// Lấy danh sách sản phẩm và container
const container = document.querySelector("#list-products");

// Hàm chuyển giá từ chuỗi sang số
function convertPrice(price) {
  return parseInt(price.replace(/[^0-9]/g, ""), 10);
}

// Hàm sắp xếp sản phẩm theo giá
function sortProducts(order) {
  // Tạo mảng các sản phẩm với thông tin giá
  const productArray = Array.from(
    container.querySelectorAll(".product-item")
  ).map((product) => ({
    element: product,
    price: convertPrice(
      product.querySelector(".home-product-item__price-current").innerText
    ),
  }));

  // Sắp xếp mảng sản phẩm theo thứ tự
  productArray.sort((a, b) =>
    order === "asc" ? a.price - b.price : b.price - a.price
  );

  // Xóa các sản phẩm hiện tại chỉ trong container và thêm lại
  productArray.forEach((item) => {
    container.appendChild(item.element);
  });
}

// Lắng nghe sự kiện nhấp chuột vào các tùy chọn
document.querySelectorAll(".select-input__link").forEach((link) => {
  link.addEventListener("click", (event) => {
    event.preventDefault();

    // Xác định thứ tự sắp xếp dựa trên giá trị của tùy chọn
    const sortOrder =
      event.target.innerText === "Giá thấp đến cao" ? "asc" : "desc";
    sortProducts(sortOrder);
  });
});

const cartWrap = document.querySelector(".header__cart-wrap");

// Thêm sự kiện click để bật/tắt hiển thị giỏ hàng
cartWrap.addEventListener("click", function (event) {
  event.stopPropagation(); // Ngăn chặn sự kiện click lan truyền
  cartWrap.classList.toggle("active");
});

// Đóng giỏ hàng khi click bên ngoài
document.addEventListener("click", function (event) {
  if (!cartWrap.contains(event.target)) {
    cartWrap.classList.remove("active");
  }
});

// Hiển thị form đăng ký
function showRegisterForm() {
  const modal = document.getElementById("modal");
  const registerModal = document.getElementById("registerModal");
  const loginModal = document.getElementById("loginModal");

  // Hiển thị modal và form đăng ký, ẩn form đăng nhập
  modal.style.display = "block";
  registerModal.style.display = "block";
  loginModal.style.display = "none";
}

// Hiển thị form đăng nhập
function showLoginForm() {
  const modal = document.getElementById("modal");
  const registerModal = document.getElementById("registerModal");
  const loginModal = document.getElementById("loginModal");

  // Hiển thị modal và form đăng nhập, ẩn form đăng ký
  modal.style.display = "block";
  loginModal.style.display = "block";
  registerModal.style.display = "none";
}

// Đóng modal và ẩn tất cả form
function closeModal() {
  const modal = document.getElementById("modal");
  const registerModal = document.getElementById("registerModal");
  const loginModal = document.getElementById("loginModal");

  modal.style.display = "none";
  registerModal.style.display = "none";
  loginModal.style.display = "none";
}

// Lắng nghe sự kiện chuyển từ form đăng ký sang đăng nhập
const switchToLogin = document.getElementById("switchToLogin");
if (switchToLogin) {
  switchToLogin.addEventListener("click", function () {
    const registerModal = document.getElementById("registerModal");
    const loginModal = document.getElementById("loginModal");

    registerModal.style.display = "none";
    loginModal.style.display = "block";
  });
}

// Lắng nghe sự kiện chuyển từ form đăng nhập sang đăng ký
const switchToRegister = document.getElementById("switchToRegister");
if (switchToRegister) {
  switchToRegister.addEventListener("click", function () {
    const registerModal = document.getElementById("registerModal");
    const loginModal = document.getElementById("loginModal");

    registerModal.style.display = "block";
    loginModal.style.display = "none";
  });
}

document.addEventListener("DOMContentLoaded", function () {
  const categoryItems = document.querySelectorAll(".category-item");
  const productItems = document.querySelectorAll(".product-item");

  // Lọc sản phẩm khi click vào danh mục
  categoryItems.forEach((item) => {
    item.addEventListener("click", function (event) {
      // Ngừng sự kiện mặc định
      event.preventDefault();

      // Lấy loại danh mục
      const category = item.getAttribute("data-category");

      // Cập nhật active cho danh mục
      categoryItems.forEach((i) => i.classList.remove("category-item--active"));
      item.classList.add("category-item--active");

      // Hiển thị/ẩn các sản phẩm dựa trên loại
      productItems.forEach((product) => {
        if (category === "all") {
          product.style.display = "block";
        } else {
          if (product.classList.contains(category)) {
            product.style.display = "block";
          } else {
            product.style.display = "none";
          }
        }
      });
    });
  });
});

// Hàm thay đổi màu trái tim khi click vào
function toggleLike(element) {
  element.classList.toggle("liked");
}

window.addEventListener("DOMContentLoaded", () => {
  // Mở modal khi người dùng click vào ảnh sản phẩm
  const productImages = document.querySelectorAll(".home-product-item__img");

  productImages.forEach((img) => {
    img.addEventListener("click", (e) => {
      const modal = document.getElementById("product-modal");
      const imgSrc = img.style.backgroundImage.slice(5, -2); // Extract image URL
      const item = img.closest(".home-product-item"); // Lấy phần tử sản phẩm chứa ảnh
      const title = item.querySelector(".home-product-item__name").innerText;
      const oldPrice = item.querySelector(".home-product-item__price-old")
        ? item.querySelector(".home-product-item__price-old").innerText
        : "";
      const currentPrice = item.querySelector(
        ".home-product-item__price-current"
      ).innerText;

      // Populate the modal with data
      document.getElementById("modal-img").src = imgSrc;
      document.getElementById("modal-title").innerText = title;
      document.getElementById("modal-old-price").innerText = oldPrice;
      document.getElementById("modal-current-price").innerText = currentPrice;

      // Show the modal
      modal.style.display = "flex";
    });
  });

  // Đóng modal khi bấm vào nút đóng (X)
  document.getElementById("close-modal").addEventListener("click", () => {
    document.getElementById("product-modal").style.display = "none";
  });

  // Đóng modal khi bấm ra ngoài vùng nội dung của modal (phần nền tối)
  document.getElementById("product-modal").addEventListener("click", (e) => {
    // Kiểm tra xem người dùng có click vào phần nền ngoài modal không (phần đen bên ngoài modal)
    if (e.target === document.getElementById("product-modal")) {
      document.getElementById("product-modal").style.display = "none";
    }
  });
});

// Lấy các phần tử cần thiết
const orderBtn = document.getElementById("order-btn");
const modal = document.getElementById("product-modal");
const modalImg = document.getElementById("modal-img");
const modalTitle = document.getElementById("modal-title");
const notifyList = document.querySelector(".header__notify-list");
const bellIcon = document.querySelector(".header__navbar-icon.far.fa-bell");
const cartTotal = document.querySelector(".header__cart-total");

// Xử lý sự kiện click "Add to Cart"
orderBtn.addEventListener("click", function () {
  const imgSrc = modalImg.src; // Lấy src của ảnh sản phẩm
  const title = modalTitle.textContent; // Lấy tiêu đề sản phẩm

  // Tạo phần tử thông báo mới
  const notifyItem = document.createElement("li");
  notifyItem.classList.add(
    "header__notify-item",
    "header__navbar-item--viewed"
  );

  notifyItem.innerHTML = `
        <a href="" class="header__notify-link">
            <img src="${imgSrc}" alt="" class="header__notify-img">
            <div class="header__notify-info">
                <span class="header__notify-name">${title}</span>
                <span class="header__notify-description">Đã thêm vào giỏ hàng</span>
            </div>
        </a>
    `;

  // Thêm phần tử vào danh sách thông báo
  notifyList.prepend(notifyItem);

  // Ẩn cả modal và overlay
  modal.style.display = "none";

  // Thêm hiệu ứng nhấp nháy vào biểu tượng chuông
  bellIcon.classList.add("blink");

  // Xóa hiệu ứng sau 2 giây
  setTimeout(() => {
    bellIcon.classList.remove("blink");
  }, 2000);

  // Thêm sản phẩm vào giỏ hàng
  const productName = modalTitle.innerText;
  const productPrice = document.getElementById("modal-current-price").innerText;
  const productImage = modalImg.src;
  const productCategory = orderBtn.classList.contains("tech")
    ? "Đồ công nghệ"
    : orderBtn.classList.contains("food")
    ? "Đồ ăn"
    : orderBtn.classList.contains("fashion")
    ? "Thời trang"
    : "Chưa xác định"; // Lấy loại sản phẩm từ class
  const quantity = 1;

  addToCart(productName, productPrice, productImage, productCategory, quantity);
});

// Thêm sản phẩm vào giỏ hàng
function addToCart(name, price, image, category, quantity) {
  // Tạo phần tử sản phẩm trong giỏ hàng
  const cartItem = document.createElement("li");
  cartItem.classList.add("header__cart-item");

  cartItem.innerHTML = `
      <img src="${image}" alt="" class="header__cart-img">
      <div class="header__cart-item-info">
          <div class="header__cart-item-head">
              <h5 class="header__cart-item-name">${name}</h5>
              <div class="header__cart-item-price-wrap">
                  <span class="header__cart-item-price">${price}</span>
                  <span class="header__cart-item-multiply">x</span>
                  <span class="header__cart-item-quantity">${quantity}</span>
              </div>
          </div>
          <div class="header__cart-item-body">
              <!-- Chuyển các nút Cộng và Trừ lên trên nút Xóa -->
              <button class="header__cart-item-decrease">-</button>
              <button class="header__cart-item-increase">+</button>
              <span class="header__cart-item-remove">Xóa</span>
          </div>
      </div>
  `;

  // Thêm sản phẩm vào giỏ hàng
  document.getElementById("cart-items").appendChild(cartItem);

  // Gán sự kiện "Xóa" cho nút xóa của sản phẩm trong giỏ hàng
  cartItem
    .querySelector(".header__cart-item-remove")
    .addEventListener("click", function () {
      // Xóa sản phẩm khỏi giỏ hàng
      cartItem.remove();

      // Cập nhật lại số lượng sản phẩm trong biểu tượng giỏ hàng
      updateCartNotice();
      updateCartTotal();
    });

  // Gán sự kiện "Cộng" cho nút cộng số lượng
  cartItem
    .querySelector(".header__cart-item-increase")
    .addEventListener("click", function () {
      const quantityElem = cartItem.querySelector(
        ".header__cart-item-quantity"
      );
      let quantity = parseInt(quantityElem.innerText);
      quantity++;

      // Cập nhật lại số lượng và tính lại tổng tiền
      quantityElem.innerText = quantity;
      updateCartTotal();
    });

  // Gán sự kiện "Trừ" cho nút trừ số lượng
  cartItem
    .querySelector(".header__cart-item-decrease")
    .addEventListener("click", function () {
      const quantityElem = cartItem.querySelector(
        ".header__cart-item-quantity"
      );
      let quantity = parseInt(quantityElem.innerText);
      if (quantity > 1) {
        quantity--;
        quantityElem.innerText = quantity;
        updateCartTotal();
      }
    });

  // Cập nhật số lượng sản phẩm trong biểu tượng giỏ hàng
  updateCartNotice();

  // Cập nhật lại tổng tiền giỏ hàng
  updateCartTotal();
}

// Cập nhật số lượng sản phẩm trong giỏ hàng
function updateCartNotice() {
  const cartItems = document.querySelectorAll(".header__cart-item");
  const cartNotice = document.querySelector(".header__cart-notice");
  cartNotice.innerText = cartItems.length; // Cập nhật số sản phẩm trong giỏ
}

function updateCartTotal() {
  const cartItems = document.querySelectorAll(".header__cart-item");
  let total = 0;

  cartItems.forEach((item) => {
    const priceText = item.querySelector(".header__cart-item-price").innerText; // Lấy giá sản phẩm
    // Chuyển giá thành số nguyên, loại bỏ dấu phẩy phân tách hàng nghìn
    const price = parseInt(priceText.replace(/[^0-9]/g, "")); // Loại bỏ dấu phẩy và ký tự không phải số
    const quantity = parseInt(
      item.querySelector(".header__cart-item-quantity").innerText
    ); // Lấy số lượng sản phẩm
    total += price * quantity; // Tính tổng tiền
  });

  // Cập nhật tổng tiền vào giao diện theo định dạng số có dấu phẩy phân tách hàng nghìn
  cartTotal.innerText = `Tổng tiền: ${total.toLocaleString()}`; // Giữ dấu phẩy phân cách hàng nghìn và thêm "VND"
}

// Lấy các phần tử
const closeModalBtn = document.getElementById("close-modal"); // Nút đóng modal chung
const closeTitleBtn = document.getElementById("close-title-btn"); // Nút đóng tiêu đề modal

// Sự kiện đóng modal chung (Nút X trên góc)
closeModalBtn.addEventListener("click", function () {
  modal.style.display = "none"; // Ẩn modal
});

// Sự kiện đóng modal khi bấm vào nút "X" trên tiêu đề
closeTitleBtn.addEventListener("click", function () {
  modal.style.display = "none"; // Ẩn modal
});

// Function hiển thị thông báo
function showToastMessage(message) {
  const toast = document.createElement("div");
  toast.className = "toast-message";
  toast.innerText = message;

  // Thêm vào DOM
  document.body.appendChild(toast);

  // Thêm hiệu ứng
  toast.style.animation = "fadeInOut 3s forwards";

  // Xóa thông báo sau khi hiện xong
  setTimeout(() => {
    document.body.removeChild(toast);
  }, 3000);
}




// Xử lý khi bấm vào nút "Đặt Hàng"
document.querySelector(".header__cart-buy").addEventListener("click", () => {
  // Hiển thị hộp thoại xác nhận
  const userConfirmed = confirm("Bạn có chắc chắn muốn đặt hàng?");
  if (userConfirmed) {
    // Xóa tất cả sản phẩm khỏi giỏ hàng
    const cartItems = document.getElementById("cart-items");
    const cartNotice = document.querySelector(".header__cart-notice");
    const cartTotal = document.getElementById("cart-total-left");

    cartItems.innerHTML = ""; // Xóa nội dung danh sách sản phẩm
    cartNotice.textContent = "0"; // Cập nhật số lượng sản phẩm về 0
    cartTotal.textContent = ""; // Xóa tổng tiền

    // Hiển thị thông báo
    showToastMessage("Đặt hàng thành công!");
  } else {
    // Nếu người dùng không xác nhận
    showToastMessage("Đặt hàng đã bị hủy.");
  }
});
















