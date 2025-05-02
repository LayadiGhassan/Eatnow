fetch('get_products.php')
.then(response => response.json())
.then(data => {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const swiper_items_sale = document.getElementById("swiper_items_sale");
    const swiper_Algerian = document.getElementById("swiper_Algerian");
    const swiper_Syrian = document.getElementById("swiper_Syrian");
    const swiper_Chinese = document.getElementById("swiper_Chinese");

    data.forEach(product => {
        if (product.old_price) {
            const isInCart = cart.some(cartItem => cartItem.id === product.id);
            const percent_disc = Math.floor((product.old_price - product.price) / product.old_price * 100);
            
            swiper_items_sale.innerHTML += `
                <div class="swiper-slide product">
                    <span class="sale_present">%${percent_disc}</span>
                    <div class="img_product">
                        <a href="#"><img src="${product.img}" alt=""></a>
                    </div>
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <p class="name_product"><a href="#">${product.name}</a></p>
                    <div class="price">
                        <p><span>$${product.price}</span></p>
                        <p class="old_price">$${product.old_price}</p>
                    </div>
                    <div class="icons">
                        <span class="btn_add_cart ${isInCart ? 'active' : ''}" data-id="${product.id}">
                            <i class="fa-solid fa-cart-shopping"></i> ${isInCart ? 'Item in cart' : 'add to cart'}
                        </span>
                        <span class="icon_product"><i class="fa-regular fa-heart"></i></span>
                    </div>
                </div>
            `;
        }
    });

    data.forEach(product => {
        if (product.catetory == "Algerian") {
            const isInCart = cart.some(cartItem => cartItem.id === product.id);
            const old_price_Pargrahp = product.old_price ? `<p class="old_price">$${product.old_price}</p>` : "";
            const percent_disc_div = product.old_price ? `<span class="sale_present">%${Math.floor((product.old_price - product.price) / product.old_price * 100)}</span>` : "";

            swiper_Algerian.innerHTML += `
                <div class="swiper-slide product">
                    ${percent_disc_div}
                    <div class="img_product">
                        <a href="#"><img src="${product.img}" alt=""></a>
                    </div>
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <p class="name_product"><a href="#">${product.name}</a></p>
                    <div class="price">
                        <p><span>$${product.price}</span></p>
                        ${old_price_Pargrahp}
                    </div>
                    <div class="icons">
                        <span class="btn_add_cart ${isInCart ? 'active' : ''}" data-id="${product.id}">
                            <i class="fa-solid fa-cart-shopping"></i> ${isInCart ? 'Item in cart' : 'add to cart'}
                        </span>
                        <span class="icon_product"><i class="fa-regular fa-heart"></i></span>
                    </div>
                </div>
            `;
        }
    });

    data.forEach(product => {
        if (product.catetory == "Syrian") {
            const isInCart = cart.some(cartItem => cartItem.id === product.id);
            const old_price_Pargrahp = product.old_price ? `<p class="old_price">$${product.old_price}</p>` : "";
            const percent_disc_div = product.old_price ? `<span class="sale_present">%${Math.floor((product.old_price - product.price) / product.old_price * 100)}</span>` : "";

            swiper_Syrian.innerHTML += `
                <div class="swiper-slide product">
                    ${percent_disc_div}
                    <div class="img_product">
                        <a href="#"><img src="${product.img}" alt=""></a>
                    </div>
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <p class="name_product"><a href="#">${product.name}</a></p>
                    <div class="price">
                        <p><span>$${product.price}</span></p>
                        ${old_price_Pargrahp}
                    </div>
                    <div class="icons">
                        <span class="btn_add_cart ${isInCart ? 'active' : ''}" data-id="${product.id}">
                            <i class="fa-solid fa-cart-shopping"></i> ${isInCart ? 'Item in cart' : 'add to cart'}
                        </span>
                        <span class="icon_product"><i class="fa-regular fa-heart"></i></span>
                    </div>
                </div>
            `;
        }
    });

    data.forEach(product => {
        if (product.catetory == "Chinese") {
            const isInCart = cart.some(cartItem => cartItem.id === product.id);
            const old_price_Pargrahp = product.old_price ? `<p class="old_price">$${product.old_price}</p>` : "";
            const percent_disc_div = product.old_price ? `<span class="sale_present">%${Math.floor((product.old_price - product.price) / product.old_price * 100)}</span>` : "";

            swiper_Chinese.innerHTML += `
                <div class="swiper-slide product">
                    ${percent_disc_div}
                    <div class="img_product">
                        <a href="#"><img src="${product.img}" alt=""></a>
                    </div>
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <p class="name_product"><a href="#">${product.name}</a></p>
                    <div class="price">
                        <p><span>$${product.price}</span></p>
                        ${old_price_Pargrahp}
                    </div>
                    <div class="icons">
                        <span class="btn_add_cart ${isInCart ? 'active' : ''}" data-id="${product.id}">
                            <i class="fa-solid fa-cart-shopping"></i> ${isInCart ? 'Item in cart' : 'add to cart'}
                        </span>
                        <span class="icon_product"><i class="fa-regular fa-heart"></i></span>
                    </div>
                </div>
            `;
        }
    });
})
.catch(error => console.error("Error fetching products:", error));