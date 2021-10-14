import { WebpackOptionsDefaulter } from "webpack";

//初始化
function initCart() {
    return getCart();
}

//獲取Cart的cookie (Cookies.get)
function getCart() {
    var cart = Cookies.get("cart");
    //JSON字串轉回原始JS型態
    return !cart ? {} : JSON.parse(cart);
    // if (!cart) {
    //     cart = {};
    // } else {
    //     cart = JSON.parse(cart);
    // }
    // return cart;
}

//保存Cart的cookie (Cookies.set)
function saveCart(cart) {
    //由於Cookies只能存字串 cart是一個物件,但物件的內容並非是字串
    //我們可以轉為json字串
    Cookies.set("cart", JSON.stringify(cart));
}

//加入產品的數量到購物車
function addProductToCart(productId, qty) {
    var cart = getCart();
    var currentQty = parseInt(cart[productId]) || 0; //若是undefined或是null就給0
    var addQty = parseInt(qty) || 0; //若是undefined或是null就給0
    var newQty = currentQty + addQty;
    updateProductToCart(productId, newQty);
}

//保存資料
function updateProductToCart(productId, newQty) {
    var cart = getCart();
    cart[productId] = newQty;
    saveCart(cart);
}

//alert提示
function alertProductQty(productId) {
    var cart = getCart();
    var qty = parseInt(cart[productId]) || 0; //若是undefined或是null就給0
    alert(qty);
}

// 按鈕提交function
function initAddtoCart(productId) {
    var addToCartBtn = document.querySelector("#addToCart");

    if (addToCartBtn) {
        addToCartBtn.addEventListener("click", function () {
            var qtyInput = document.querySelector('input[name="qty"]');
            if (qtyInput) {
                addProductToCart(productId, qtyInput.value);
                alertProductQty(productId);
            }
        });
    }
}

function initCartDeleteButton(actionUrl) {
    var cartDeleteBtns = document.querySelectorAll(".cartDeleteBtn");

    cartDeleteBtns.forEach((element) => {
        var cartDeleteBtn = element;
        cartDeleteBtn.addEventListener("click", function (e) {
            var btn = e.target;
            var dataId = btn.getAttribute("data-id");
            var formData = new FormData();
            formData.append("_method", "DELETE");
            var csrfTokenMeta = document.querySelector(
                'meta[name="csrf-token"]'
            );
            var csrfToken = csrfTokenMeta.content;
            formData.append("_token", csrfToken);
            formData.append("id", dataId);
            var request = new XMLHttpRequest();
            request.open("POST", actionUrl);
            console.log(request.readyState);
            request.onreadystatechange = function () {
                if (
                    request.readyState === XMLHttpRequest.DONE &&
                    request.status === 200 &&
                    request.responseText === "success"
                ) {
                    window.location.reload();
                }
            };
            request.send(formData);
        });
    });
}

export { initAddtoCart, initCartDeleteButton };
