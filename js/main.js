let type_nav_list = document.querySelector(".type_nav_list");

function Open_type_list() {
    type_nav_list.classList.toggle("active");
}

let nav_links = document.querySelector(".nav_links");

function open_Menu() {
    nav_links.classList.toggle("active");
}

var cart = document.querySelector('.cart');

function open_close_cart() {
    cart.classList.toggle("active");
}

fetch('get_products.php')
    .then(response => response.json())
    .then(data => {
        const addToCartButtons = document.querySelectorAll(".btn_add_cart");

        addToCartButtons.forEach(button => {
            button.addEventListener("click", (event) => {
                const productId = event.target.getAttribute('data-id');
                const selectedProduct = data.find(product => product.id == productId);

                addToCart(selectedProduct);

                const allMatchingButtons = document.querySelectorAll(`.btn_add_cart[data-id="${productId}"]`);

                allMatchingButtons.forEach(btn => {
                    btn.classList.add("active");
                    btn.innerHTML = `<i class="fa-solid fa-cart-shopping"></i> Item in cart`;
                });
            });
        });
    })
    .catch(error => console.error("Error fetching products:", error));

function addToCart(product) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.push({ ...product, quantity: 1 });
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCart();
}

function updateCart() {
    const cartItemsContainer = document.getElementById("cart_items");
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const checkout_items = document.getElementById("checkout_items");
    let items_input = document.getElementById("items");
    let total_Price_input = document.getElementById("total_Price");
    let count_Items_input = document.getElementById("count_Items");

    if (checkout_items) {
        checkout_items.innerHTML = "";
        items_input.value = "";
        total_Price_input.value = "";
        count_Items_input.value = "";
    }

    var total_Price = 0;
    var total_count = 0;

    cartItemsContainer.innerHTML = "";
    cart.forEach((item, index) => {
        let total_Price_item = item.price * item.quantity;
        total_Price += total_Price_item;
        total_count += item.quantity;

        if (checkout_items) {
            items_input.value += item.name + "   ---    " + "price : " + total_Price_item + "   ---   " + "count : " + item.quantity + "\n";
            total_Price_input.value = total_Price;
            count_Items_input.value = total_count;
        }

        cartItemsContainer.innerHTML += `
            <div class="item_cart">
                <img src="${item.img}" alt="">
                <div class="content">
                    <h4>${item.name}</h4>
                    <p class="price_cart">$${total_Price_item}</p>
                    <div class="quantity_control">
                        <button class="decrease_quantity" data-index=${index}>-</button>
                        <span class="quantity">${item.quantity}</span>
                        <button class="Increase_quantity" data-index=${index}>+</button>
                    </div>
                </div>
                <button class="delete_item" data-inex="${index}"><i class="fa-solid fa-trash-can"></i></button>
            </div>
        `;

        if (checkout_items) {
            checkout_items.innerHTML += `
                <div class="item_cart">
                    <div class="image_name">
                        <img src="${item.img}" alt="">
                        <div class="content">
                            <h4>${item.name}</h4>
                            <p class="price_cart">$${total_Price_item}</p>
                            <div class="quantity_control">
                                <button class="decrease_quantity" data-index=${index}>-</button>
                                <span class="quantity">${item.quantity}</span>
                                <button class="Increase_quantity" data-index=${index}>+</button>
                            </div>
                        </div>
                    </div>
                    <button class="delete_item" data-inex="${index}"><i class="fa-solid fa-trash-can"></i></button>
                </div>
            `;
        }
    });

    const price_cart_total = document.querySelector('.price_cart_toral');
    const count_item_cart = document.querySelector('.Count_item_cart');
    const count_item_header = document.querySelector('.count_item_header');
    
    price_cart_total.innerHTML = `$ ${total_Price}`;
    count_item_cart.innerHTML = total_count;
    count_item_header.innerHTML = total_count;

    if (checkout_items) {
        const total_checkout = document.querySelector(".total_checkout");
        total_checkout.innerHTML = `$ ${total_Price}`;
    }

    const increaseButtons = document.querySelectorAll(".Increase_quantity");
    const decreaseButtons = document.querySelectorAll(".decrease_quantity");

    increaseButtons.forEach(button => {
        button.addEventListener("click", (event) => {
            const itemIndex = event.target.getAttribute("data-index");
            increaseQuantity(itemIndex);
        });
    });

    decreaseButtons.forEach(button => {
        button.addEventListener("click", (event) => {
            const itemIndex = event.target.getAttribute("data-index");
            decreaseQuantity(itemIndex);
        });
    });

    const deleteButtons = document.querySelectorAll('.delete_item');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const itemIndex = event.target.closest('button').getAttribute('data-inex');
            removeFromCart(itemIndex);
        });
    });
}

function increaseQuantity(index) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart[index].quantity += 1;
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCart();
}

function decreaseQuantity(index) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    if (cart[index].quantity > 1) {
        cart[index].quantity -= 1;
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCart();
}

function removeFromCart(index) {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const removedProduct = cart.splice(index, 1)[0];
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCart();
    updateButtonsState(removedProduct.id);
}

function updateButtonsState(productId) {
    const allMatchingButtons = document.querySelectorAll(`.btn_add_cart[data-id="${productId}"]`);
    allMatchingButtons.forEach(button => {
        button.classList.remove('active');
        button.innerHTML = `<i class="fa-solid fa-cart-shopping"></i> add to cart`;
    });
}

// Handle checkout form submission
const form = document.getElementById("form_contact");
if (form) {
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        fetch('submit_order.php', {
            method: "POST",
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.result === 'success') {
                setTimeout(() => {
                    localStorage.removeItem("cart");
                    window.location.reload();
                }, 3000);
            } else {
                console.error("Error:", data.error);
            }
        })
        .catch(error => console.error("Error submitting order:", error));
    });
}

updateCart();