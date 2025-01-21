let xhr = new XMLHttpRequest();
let categoryList = document.getElementById('categoryList'); // Use consistent ID
let cartList = document.getElementById('cartlist');
let cartTotalElement = document.getElementById('cartTotal'); 

getCategory();

function getCategory() {
    xhr.open('GET', '../../controller/home/getCategories.php');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Parse the JSON response
            console.log(xhr.response);
            let categories = JSON.parse(xhr.response);
            categoryList.innerHTML = "";
            categories.forEach((category) => {
                categoryList.innerHTML += `<li><a href="#" onclick="getproducts(${category.id})"  data-id="${category.id}" class="text-decoration-none">${category.name}</a></li>`;
            });

        } else if (xhr.readyState == 4) {
            console.log("fail");
        }
    };
    xhr.send();
}

getproducts();
function getproducts(category_id=0) {
    let xhr = new XMLHttpRequest();
if(category_id == 0){
    xhr.open('GET', '../../controller/home/getProducts.php');
}else{
    xhr.open('GET', '../../controller/home/getProducts.php?id=' + category_id);
}  
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Parse the JSON response
            let products = JSON.parse(xhr.response);
            console.log(products);
           let productsList = document.getElementById('productsList');
            productsList.innerHTML = "";
            products.forEach( (product) => {
              productsList.innerHTML+=` <div class="col-md-6">
                    <div class="card menu-item">
                        <img src="../../${product.image}" class="card-img-top" alt="Item 1">   
                        <div class="card-body text-center">
                            <h6 class="card-title">${product.name}</h6>
                            <p class="card-text">${product.price}</p>
                            <button class="btn btn-primary product-choose add-to-cart" data-id="${product.id} data-image="${product.image}" data-name="${product.name}" data-price="${product.price}">Choose</button>
                        </div>
                    </div>
                </div>`
            });
        } else if (xhr.readyState == 4) {
            console.log("fail");
        }
    };
    xhr.send();
}



function getproducts(category_id = 0) {
    let xhr = new XMLHttpRequest();
    if (category_id === 0) {
        xhr.open('GET', '../../controller/home/getProducts.php');
    } else {
        xhr.open('GET', `../../controller/home/getProducts.php?id=${category_id}`);
    }
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let products = JSON.parse(xhr.response);
            productslist(products);
            bindAddToCartEvents();
        } else if (xhr.readyState == 4) {
            console.log("fail");
        }
    };
    xhr.send();
}


let searchForm=document.getElementById('searchForm');
searchForm.addEventListener('submit',function(e){
    e.preventDefault();
    getproductsbysearch();
})
function getproductsbysearch() {
    let search=document.getElementById('search').value;

    let xhr = new XMLHttpRequest();
    console.log("search:",search );
    if (search !="") {
        xhr.open('GET', `../../controller/home/getProducts.php?key=${search}`);
    } else {
        xhr.open('GET', `../../controller/home/getProducts.php`);
    }
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let products = JSON.parse(xhr.response);
            productslist(products);
            bindAddToCartEvents();
        } else if (xhr.readyState == 4) {
            console.log("fail") ;
        }
    };
    xhr.send();
}

function productslist(products){
   
    let productsList = document.getElementById('productsList');
    productsList.innerHTML = "";
    products.forEach((product) => {
        productsList.innerHTML += `
            <div class="col-md-6">
                <div class="card menu-item">
                    <img src="../../${product.image}" class="card-img-top" alt="Item 1">
                    <div class="card-body text-center">
                        <h6 class="card-title">${product.name}</h6>
                        <p class="card-text">$${product.price}</p>
                        <button class="btn btn-primary add-to-cart" data-id="${product.id}" data-image="${product.image}" data-name="${product.name}" data-price="${product.price}">Choose</button>
                    </div>
                </div>
            </div>`;
    });
}

function bindAddToCartEvents() {
    let product_choose = document.querySelectorAll('.add-to-cart');
    product_choose.forEach((product) => {
        product.addEventListener('click', function () {
            let id = product.getAttribute('data-id');
            let image = product.getAttribute('data-image');
            let name = product.getAttribute('data-name');
            let price = parseFloat(product.getAttribute('data-price'));

            let cart = JSON.parse(sessionStorage.getItem("cart")) || [];
            let existingProduct = cart.find(p => p.id === id);
            if (existingProduct) {
                existingProduct.quantity += 1;
            } else {
                cart.push({
                    id: id,
                    name: name,
                    price: price,
                    image: image,
                    quantity: 1
                });
            }

            sessionStorage.setItem("cart", JSON.stringify(cart));
            loadCart();
        });
    });
}

function update_qty(id, type) {
    let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    let existingProduct = cart.find(product => product.id === id);

    if (existingProduct) {
        if (type === 'minus') {
            if (existingProduct.quantity > 1) {
                existingProduct.quantity -= 1;
            } else {
                cart = cart.filter(product => product.id !== id);
            }
        } else if (type === 'plus') {
            existingProduct.quantity += 1;
        }

        sessionStorage.setItem('cart', JSON.stringify(cart));
        loadCart();
    }
}

function loadCart() {
    let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    let totalCartValue = 0;
    let cartproductlist=document.createElement('ul');
    cartList.innerHTML = '';
    cart.forEach(product => {
        let totalProductPrice = product.price * product.quantity;
        totalCartValue += totalProductPrice;
       
        cartproductlist.style=['overflow-y:auto;min-height:100px;max-height:300px'];

       

    
        cartproductlist.innerHTML += `
            <li class="row border-bottom py-2">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <img src="../../${product.image}" alt="" class="cart-item-image" style="width:60px; height:60px">
                    <i class="btn btn-danger fa fa-trash" onclick="removeFromCart('${product.id}')"></i>
                </div>
                <div class="col-12 d-flex justify-content-between">
                    <div class="cart-item-title">${product.name}</div>
                    <div class="cart-item-price">$<span>${totalProductPrice.toFixed(2)}</span></div>
                </div>
                <div class="col-12 card-item-actions mt-08 d-flex justify-content-start gap-1">
                    <i class="btn btn-secondary fa fa-minus" onclick="update_qty('${product.id}', 'minus')"></i>
                    <span class="px-2 quantity">${product.quantity}</span>
                    <i class="btn btn-secondary fa fa-plus" onclick="update_qty('${product.id}', 'plus')"></i>
                </div>
            </li>`;
    });

    cartTotalElement.innerText = `${totalCartValue.toFixed(2)}`;
    cartList.appendChild(cartproductlist);
}

function removeFromCart(id) {
    let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    cart = cart.filter(product => product.id !== id);

    sessionStorage.setItem('cart', JSON.stringify(cart));
    loadCart();
}

// Initialize cart on page load
document.addEventListener('DOMContentLoaded', loadCart);



// send to save 






function sendToSave() {
    let xhr = new XMLHttpRequest();
    let user = document.getElementById("user");
    let room = document.getElementById("room");
 
    let cart = JSON.parse(sessionStorage.getItem('cart')) || [];

    if (cart.length === 0) {
        toastr.error("Cart is empty");
        return;
    }

    let userId = user ? user.value: "";
    let roomId = room.value || "";

    if (!roomId) {
        toastr.error("Please select a room");
        return;
    }

    xhr.open('POST', `../../controller/home/createOrder.php`);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                let response = JSON.parse(xhr.responseText);
                if (response.success) {
                    cartList.innerHTML = "";
                    cartTotalElement.innerText = "0.00";
                    sessionStorage.removeItem("cart");
                    toastr.success("Order placed successfully");
                } else {
                    toastr.error("response.error");
                 
                }
            } else {
                toastr.error("Request failed with status: " + xhr.status);
            }
        }
    };

    let data = {
        cart: cart,
        user: userId,
        room: roomId
    };

    xhr.send(JSON.stringify(data));
}