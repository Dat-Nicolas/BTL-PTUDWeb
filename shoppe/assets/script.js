// // Lấy danh sách sản phẩm và container
// const container = document.querySelector("#list-products");
// console.log(container);


// // Hàm chuyển giá từ chuỗi sang số
// function convertPrice(price) {
//   return parseInt(price.replace(/[^0-9]/g, ""));
// }

// // Hàm sắp xếp sản phẩm theo giá
// function sortProducts(order) {
//   // Tạo mảng các sản phẩm với thông tin giá
//   let productArray = Array.from(
//     container.querySelectorAll(".product-item")
//   ).map((product) => {
//     return {
//       element: product,
//       price: convertPrice(
//         product.querySelector(".home-product-item__price-current").innerText
//       ),
//     };
//   });
  
// console.log(productArray);

//   // Sắp xếp mảng sản phẩm theo thứ tự
//   productArray = productArray.sort((a, b) =>
//     order === "asc" ? a.price - b.price : b.price - a.price
//   );
// console.log(productArray);

  
//   // Xóa các sản phẩm hiện tại chỉ trong container và thêm lại
//   productArray.forEach((item, index) => {
//     container.appendChild(item.element);
//   });
  
// }

// // Lắng nghe sự kiện nhấp chuột vào các tùy chọn
// document
//   .querySelector(".select-input__list")
//   .addEventListener("click", (event) => {
//     event.preventDefault();

//     // if (event.target.closest('.select-input__link')) {
//     const sortOrder = event.target.value == "thấp đến cao" ? "asc" : "desc";
//     sortProducts(sortOrder);
//     // }
//   });



// Lấy danh sách sản phẩm và container
const container = document.querySelector("#list-products");
console.log(container);

// Hàm chuyển giá từ chuỗi sang số
function convertPrice(price) {
  return parseInt(price.replace(/[^0-9]/g, ""), 10);
}

// Hàm sắp xếp sản phẩm theo giá
function sortProducts(order) {
  // Tạo mảng các sản phẩm với thông tin giá
  const productArray = Array.from(container.querySelectorAll(".product-item")).map((product) => ({
    element: product,
    price: convertPrice(product.querySelector(".home-product-item__price-current").innerText),
  }));

  console.log(productArray);

  // Sắp xếp mảng sản phẩm theo thứ tự
  productArray.sort((a, b) => (order === "asc" ? a.price - b.price : b.price - a.price));
  console.log(productArray);

  // Xóa các sản phẩm hiện tại chỉ trong container và thêm lại
  productArray.forEach(item => {
    container.appendChild(item.element);
  });
}

// Lắng nghe sự kiện nhấp chuột vào các tùy chọn
document.querySelectorAll(".select-input__link").forEach(link => {
  link.addEventListener("click", (event) => {
    event.preventDefault();

    // Xác định thứ tự sắp xếp dựa trên giá trị của tùy chọn
    const sortOrder = event.target.innerText === "Giá thấp đến cao" ? "asc" : "desc";
    sortProducts(sortOrder);
  });
});



const cartWrap = document.querySelector('.header__cart-wrap');

// Thêm sự kiện click để bật/tắt hiển thị giỏ hàng
cartWrap.addEventListener('click', function(event) {
    event.stopPropagation(); // Ngăn chặn sự kiện click lan truyền
    cartWrap.classList.toggle('active');
});

// Đóng giỏ hàng khi click bên ngoài
document.addEventListener('click', function(event) {
    if (!cartWrap.contains(event.target)) {
        cartWrap.classList.remove('active');
    }
});








////////////////////////////////

// function showRegisterForm() {
//   document.getElementById("registerModal").classList.add("active");
//   document.getElementById("registerModal").classList.remove("active");
// }

// function showLoginForm() {
//   document.getElementById("loginModal").classList.add("active");
//   document.getElementById("loginModal").classList.remove("active");
// }

// // Đóng modal khi nhấn bên ngoài
// document.addEventListener("click", function (event) {
//   if (event.target.classList.contains("modal__overlay")) {
//       document.getElementById("registerModal").classList.add("active");
//       document.getElementById("loginModal").classList.add("active");
//   }
// });

// Hiển thị form đăng ký và ẩn form đăng nhập
function showRegisterForm() {
  document.getElementById("registerModal").classList.add("active");
  document.getElementById("loginModal").classList.remove("active");
}

// Hiển thị form đăng nhập và ẩn form đăng ký
function showLoginForm() {
  document.getElementById("loginModal").classList.add("active");
  document.getElementById("registerModal").classList.remove("active");
}

// Đổi modal khi nhấn nút "Đăng ký" trong form đăng nhập
document.querySelector("#loginModal .auth-form__switch-btn").addEventListener("click", showRegisterForm);

// Đổi modal khi nhấn nút "Đăng nhập" trong form đăng ký
document.querySelector("#registerModal .auth-form__switch-btn").addEventListener("click", showLoginForm);



