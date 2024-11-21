// Lấy danh sách sản phẩm và container
const container = document.querySelector("#list-products");

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


  // Sắp xếp mảng sản phẩm theo thứ tự
  productArray.sort((a, b) => (order === "asc" ? a.price - b.price : b.price - a.price));

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





// Hiển thị form đăng ký
function showRegisterForm() {
  const modal = document.getElementById('modal');
  const registerModal = document.getElementById('registerModal');
  const loginModal = document.getElementById('loginModal');
  
  // Hiển thị modal và form đăng ký, ẩn form đăng nhập
  modal.style.display = 'block';
  registerModal.style.display = 'block';
  loginModal.style.display = 'none';
}

// Hiển thị form đăng nhập
function showLoginForm() {
  const modal = document.getElementById('modal');
  const registerModal = document.getElementById('registerModal');
  const loginModal = document.getElementById('loginModal');
  
  // Hiển thị modal và form đăng nhập, ẩn form đăng ký
  modal.style.display = 'block';
  loginModal.style.display = 'block';
  registerModal.style.display = 'none';
}

// Đóng modal và ẩn tất cả form
function closeModal() {
  const modal = document.getElementById('modal');
  const registerModal = document.getElementById('registerModal');
  const loginModal = document.getElementById('loginModal');
  
  modal.style.display = 'none';
  registerModal.style.display = 'none';
  loginModal.style.display = 'none';
}

// Lắng nghe sự kiện chuyển từ form đăng ký sang đăng nhập
const switchToLogin = document.getElementById('switchToLogin');
if (switchToLogin) {
  switchToLogin.addEventListener("click", function() {
    const registerModal = document.getElementById('registerModal');
    const loginModal = document.getElementById('loginModal');
    
    registerModal.style.display = 'none'; 
    loginModal.style.display = 'block'; 
  });
}

// Lắng nghe sự kiện chuyển từ form đăng nhập sang đăng ký
const switchToRegister = document.getElementById('switchToRegister');
if (switchToRegister) {
  switchToRegister.addEventListener("click", function() {
    const registerModal = document.getElementById('registerModal');
    const loginModal = document.getElementById('loginModal');
    
    registerModal.style.display = 'block'; 
    loginModal.style.display = 'none'; 
  });
}



document.addEventListener("DOMContentLoaded", function() {
  const categoryItems = document.querySelectorAll('.category-item');
  const productItems = document.querySelectorAll('.product-item');

  // Lọc sản phẩm khi click vào danh mục
  categoryItems.forEach(item => {
      item.addEventListener('click', function(event) {
          // Ngừng sự kiện mặc định
          event.preventDefault();

          // Lấy loại danh mục
          const category = item.getAttribute('data-category');

          // Cập nhật active cho danh mục
          categoryItems.forEach(i => i.classList.remove('category-item--active'));
          item.classList.add('category-item--active');

          // Hiển thị/ẩn các sản phẩm dựa trên loại
          productItems.forEach(product => {
              if (category === 'all') {
                  product.style.display = 'block'; 
              } else {
                  if (product.classList.contains(category)) {
                      product.style.display = 'block'; 
                  } else {
                      product.style.display = 'none'; 
                  }
              }
          });
      });
  });
});



// Hàm thay đổi màu trái tim khi click vào
function toggleLike(element) {
  element.classList.toggle('liked');
}




window.addEventListener('DOMContentLoaded', () => {
  // Mở modal khi người dùng click vào sản phẩm
  const productItems = document.querySelectorAll('.home-product-item');

  productItems.forEach(item => {
    item.addEventListener('click', (e) => {
      const modal = document.getElementById('product-modal');
      const imgSrc = item.querySelector('.home-product-item__img').style.backgroundImage.slice(5, -2); // Extract image URL
      const title = item.querySelector('.home-product-item__name').innerText;
      const oldPrice = item.querySelector('.home-product-item__price-old') ? item.querySelector('.home-product-item__price-old').innerText : '';
      const currentPrice = item.querySelector('.home-product-item__price-current').innerText;

      // Populate the modal with data
      document.getElementById('modal-img').src = imgSrc;
      document.getElementById('modal-title').innerText = title;
      document.getElementById('modal-old-price').innerText = oldPrice;
      document.getElementById('modal-current-price').innerText = currentPrice;

      // Show the modal
      modal.style.display = 'flex';
    });
  });

  // Đóng modal khi bấm vào nút đóng (X)
  document.getElementById('close-modal').addEventListener('click', () => {
    document.getElementById('product-modal').style.display = 'none';
  });

  // Đóng modal khi bấm ra ngoài vùng nội dung của modal (phần nền tối)
  document.getElementById('product-modal').addEventListener('click', (e) => {
    // Kiểm tra xem người dùng có click vào phần nền ngoài modal không (phần đen bên ngoài modal)
    if (e.target === document.getElementById('product-modal')) {
      document.getElementById('product-modal').style.display = 'none';
    }
  });
});
