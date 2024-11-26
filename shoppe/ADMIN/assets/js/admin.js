//do sidebar open and close
const menuIconButton = document.querySelector(".menu-icon-btn");
const sidebar = document.querySelector(".sidebar");
menuIconButton.addEventListener("click", () => {
  sidebar.classList.toggle("open");
});

// Lấy danh sách các sidebar và các section
const sidebars = document.querySelectorAll(".sidebar-list-item.tab-content");
const sections = document.querySelectorAll(".section");

// Gán sự kiện cho các sidebar và kết nối với sections tương ứng
sidebars.forEach((sidebar, index) => {
  sidebar.addEventListener("click", () => {
    // Loại bỏ class 'active' khỏi phần tử hiện tại
    document
      .querySelector(".sidebar-list-item.active")
      ?.classList.remove("active");
    document.querySelector(".section.active")?.classList.remove("active");

    // Thêm class 'active' vào phần tử được chọn
    sidebar.classList.add("active");

    // Đảm bảo rằng index không vượt quá số lượng sections
    if (sections[index]) {
      sections[index].classList.add("active");
    } else {
      console.warn(
        `Không tìm thấy section tương ứng với sidebar tại index ${index}.`
      );
    }
  });
});

// Get total product
function getAmoumtProduct() {
  let products = localStorage.getItem("products")
    ? JSON.parse(localStorage.getItem("products"))
    : [];
  return products.length;
}

// Get total user
function getAmoumtUser() {
  let accounts = localStorage.getItem("accounts")
    ? JSON.parse(localStorage.getItem("accounts"))
    : [];
  return accounts.filter((item) => item.userType == 0).length;
}

// Get total money
function getMoney() {
  let tongtien = 0;
  let orders = localStorage.getItem("order")
    ? JSON.parse(localStorage.getItem("order"))
    : [];
  orders.forEach((item) => {
    tongtien += item.tongtien;
  });
  return tongtien;
}

document.getElementById("amount-user").innerHTML = getAmoumtUser();
document.getElementById("amount-product").innerHTML = getAmoumtProduct();
document.getElementById("doanh-thu").innerHTML = vnd(getMoney());

// Doi sang dinh dang tien VND
function vnd(price) {
  return price.toLocaleString("vi-VN", { style: "currency", currency: "VND" });
}

// Phân trang ( chia số lương sản phẩm trong 1 trang và số trang)
let perPage = 5;
let currentPage = 1;
let totalPage = 0;
let perProducts = [];

function displayList(productAll, perPage, currentPage) {
  let start = (currentPage - 1) * perPage;
  let end = (currentPage - 1) * perPage + perPage;
  let productShow = productAll.slice(start, end);
  showProductArr(productShow);
}

function setupPagination(productAll, perPage) {
  document.querySelector(".page-nav-list").innerHTML = "";
  let page_count = Math.ceil(productAll.length / perPage);
  for (let i = 1; i <= page_count; i++) {
    let li = paginationChange(i, productAll, currentPage);
    document.querySelector(".page-nav-list").appendChild(li);
  }
}

function paginationChange(page, productAll, currentPage) {
  let node = document.createElement(`li`);
  node.classList.add("page-nav-item");
  node.innerHTML = `<a href="#">${page}</a>`;
  if (currentPage == page) node.classList.add("active");
  node.addEventListener("click", function () {
    currentPage = page;
    displayList(productAll, perPage, currentPage);
    let t = document.querySelectorAll(".page-nav-item.active");
    for (let i = 0; i < t.length; i++) {
      t[i].classList.remove("active");
    }
    node.classList.add("active");
  });
  return node;
}

// Hiển thị danh sách sản phẩm
function showProductArr(arr) {
  let productHtml = "";
  if (arr.length == 0) {
    productHtml = `<div class="no-result"><div class="no-result-i"><i class="fa-light fa-face-sad-cry"></i></div><div class="no-result-h">Không có sản phẩm để hiển thị</div></div>`;
  } else {
    arr.forEach((product) => {
      let btnCtl =
        product.status == 1
          ? `<button class="btn-delete" onclick="deleteProduct(${product.id})"><i class="fa-regular fa-trash"></i></button>`
          : `<button class="btn-delete" onclick="changeStatusProduct(${product.id})"><i class="fa-regular fa-eye"></i></button>`;
      productHtml += `
            <div class="list">
                    <div class="list-left">
                    <img src="${product.img}" alt="">
                    <div class="list-info">
                        <h4>${product.title}</h4>
                        <p class="list-note">${product.desc}</p>
                        <span class="list-category">${product.category}</span>
                    </div>
                </div>
                <div class="list-right">
                    <div class="list-price">
                    <span class="list-current-price">${vnd(
                      product.price
                    )}</span>                   
                    </div>
                    <div class="list-control">
                    <div class="list-tool">
                        <button class="btn-edit" onclick="editProduct(${
                          product.id
                        })"><i class="fa-light fa-pen-to-square"></i></button>
                        ${btnCtl}
                    </div>                       
                </div>
                </div> 
            </div>`;
    });
  }
  document.getElementById("show-product").innerHTML = productHtml;
}

function showProduct() {
  let selectOp = document.getElementById("the-loai").value;
  let valeSearchInput = document.getElementById("form-search-product").value;
  let products = localStorage.getItem("products")
    ? JSON.parse(localStorage.getItem("products"))
    : [];

  if (selectOp == "Tất cả") {
    result = products.filter((item) => item.status == 1);
  } else if (selectOp == "Đã xóa") {
    result = products.filter((item) => item.status == 0);
  } else {
    result = products.filter((item) => item.category == selectOp);
  }

  result =
    valeSearchInput == ""
      ? result
      : result.filter((item) => {
          return item.title
            .toString()
            .toUpperCase()
            .includes(valeSearchInput.toString().toUpperCase());
        });

  displayList(result, perPage, currentPage);
  setupPagination(result, perPage, currentPage);
}

function cancelSearchProduct() {
  let products = localStorage.getItem("products")
    ? JSON.parse(localStorage.getItem("products")).filter(
        (item) => item.status == 1
      )
    : [];
  document.getElementById("the-loai").value = "Tất cả";
  document.getElementById("form-search-product").value = "";
  displayList(products, perPage, currentPage);
  setupPagination(products, perPage, currentPage);
}

window.onload = showProduct();

function createId(arr) {
  let id = arr.length;
  let check = arr.find((item) => item.id == id);
  while (check != null) {
    id++;
    check = arr.find((item) => item.id == id);
  }
  return id;
}

// Xóa sản phẩm
function deleteProduct(id) {
  let products = JSON.parse(localStorage.getItem("products"));
  let index = products.findIndex((item) => {
    return item.id == id;
  });
  if (confirm("Bạn có chắc muốn xóa?") == true) {
    products[index].status = 0;
    toast({
      title: "Success",
      message: "Xóa sản phẩm thành công !",
      type: "success",
      duration: 3000,
    });
  }
  localStorage.setItem("products", JSON.stringify(products));
  showProduct();
}

// Lấy đối tượng modal và nút thêm món mới
const addProductModal = document.getElementById("addProductModal");
const btnAddProduct = document.getElementById("btn-add-product");
const btnCloseModal = document.querySelector(".modal-close");

// Hiển thị modal khi nhấn vào nút "Thêm món mới"
btnAddProduct.addEventListener("click", function () {
  addProductModal.style.display = "block";
});

// Đóng modal khi nhấn vào nút đóng (x)
btnCloseModal.addEventListener("click", function () {
  addProductModal.style.display = "none";
});

// Đóng modal khi nhấn vào bên ngoài modal (nếu muốn)
window.addEventListener("click", function (event) {
  if (event.target === addProductModal) {
    addProductModal.style.display = "none";
  }
});

// Hàm kiểm tra tính hợp lệ của thông tin trước khi thêm món
function validateForm() {
  let isValid = true;

  const name = document.getElementById("ten-mon");
  const price = document.getElementById("gia-moi");
  const description = document.getElementById("mo-ta");
  const imageInput = document.getElementById("up-hinh-anh");

  // Kiểm tra tên món
  if (name.value.trim() === "") {
    showError(name, "Tên món không được để trống");
    isValid = false;
  } else {
    hideError(name);
  }

  // Kiểm tra giá bán
  if (price.value.trim() === "" || isNaN(price.value)) {
    showError(price, "Giá bán phải là số");
    isValid = false;
  } else {
    hideError(price);
  }

  // Kiểm tra mô tả
  if (description.value.trim() === "") {
    showError(description, "Mô tả không được để trống");
    isValid = false;
  } else {
    hideError(description);
  }

  // Kiểm tra chọn hình ảnh
  if (!imageInput.files.length) {
    showError(imageInput, "Vui lòng chọn hình ảnh");
    isValid = false;
  } else {
    hideError(imageInput);
  }

  return isValid;
}

// Hàm hiển thị thông báo lỗi
function showError(input, message) {
  const formGroup = input.closest(".form-group");
  const errorMessage = formGroup.querySelector(".form-message");

  if (errorMessage) {
    errorMessage.textContent = message;
    formGroup.classList.add("error");
  }
}

// Hàm ẩn thông báo lỗi
function hideError(input) {
  const formGroup = input.closest(".form-group");
  const errorMessage = formGroup.querySelector(".form-message");

  if (errorMessage) {
    errorMessage.textContent = "";
    formGroup.classList.remove("error");
  }
}

// Lắng nghe sự kiện input để ẩn lỗi khi người dùng nhập đúng
document.querySelectorAll(".form-control").forEach((input) => {
  input.addEventListener("input", function () {
    // Kiểm tra lại từng trường ngay khi người dùng nhập
    if (input.id === "ten-mon") {
      if (input.value.trim() !== "") hideError(input);
    }
    if (input.id === "gia-moi") {
      if (input.value.trim() !== "" && !isNaN(input.value)) hideError(input);
    }
    if (input.id === "mo-ta") {
      if (input.value.trim() !== "") hideError(input);
    }
    if (input.id === "up-hinh-anh" && input.files.length) {
      hideError(input);
    }
  });
});

// Hàm xử lý sự kiện khi thêm món
document
  .getElementById("add-product-button")
  .addEventListener("click", function (event) {
    event.preventDefault();

    if (validateForm()) {
      // Nếu thông tin hợp lệ, thực hiện thêm món và upload ảnh
      alert("Món đã được thêm!");

      // Thực hiện đóng modal sau khi thêm món thành công
      closeModal();

      // Xóa hết dữ liệu trong form và ẩn ảnh xem trước
      resetForm();
    } else {
      alert("Vui lòng điền đầy đủ và đúng thông tin!");
    }
  });

// Hàm reset form
function resetForm() {
  const form = document.querySelector(".add-product-form");
  form.reset();

  // Xóa ảnh xem trước
  const preview = document.querySelector(".upload-image-preview");
  preview.src = "./assets/img/blank-image.png";

  // Xóa các thông báo lỗi (nếu có)
  const errorMessages = document.querySelectorAll(".form-message");
  errorMessages.forEach(function (message) {
    message.textContent = "";
  });

  // Xóa class lỗi của các input
  const formGroups = document.querySelectorAll(".form-group");
  formGroups.forEach(function (group) {
    group.classList.remove("error");
  });
}

// Hàm đóng modal
function closeModal() {
  const modal = document.getElementById("addProductModal");
  modal.style.display = "none";
}

// Hàm xử lý xem trước ảnh
function previewImage(input) {
  const file = input.files[0];
  const preview = document.querySelector(".upload-image-preview");

  if (file && file.type.startsWith("image/")) {
    const reader = new FileReader();

    reader.onload = function (e) {
      preview.src = e.target.result;
      preview.style.display = "block";
    };

    reader.readAsDataURL(file);
  } else {
    preview.src = "./assets/img/blank-image.png";
    preview.style.display = "none";
  }
}
