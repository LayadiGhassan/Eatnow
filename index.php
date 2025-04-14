<?ph
require_once 'config.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$algerian = array_filter($products, fn($p) => $p['category'] === 'Algerian');
$syrian = array_filter($products, fn($p) => $p['category'] === 'Syrian');
$chinese = array_filter($products, fn($p) => $p['category'] === 'Chinese');
$sale = array_filter($products, fn($p) => !is_null($p['old_price']));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EatNow | Delicious</title>
    <link rel="icon" href="img/logo.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div class="cart">
        <div class="top_cart">
            <h3>Cart Items : <span class="Count_item_cart"><?php echo count($_SESSION['cart']); ?></span></h3>
            <span onclick="open_close_cart()" class="close_cart"><i class="fa-regular fa-circle-xmark"></i></span>
        </div>
        <div class="items_in_cart" id="cart_items"></div>
        <div class="bottom_cart">
            <div class="total">
                <p>subtotal</p>
                <p class="price_cart_toral">$<?php echo number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $_SESSION['cart'])), 2); ?></p>
            </div>
            <div class="button_cart">
                <a href="checkout.php" class="btn_cart btn">Checkout</a>
                <span onclick="open_close_cart()" class="btn_cart trans_bg btn">Shop More</span>
            </div>
        </div>
    </div>

    <header>
        <div class="top_header">
            <div class="container">
                <a href="#" class="logo"> <img src="img/logo.png" alt=""></a>
                <form action="" class="search_box">
                    <div class="select_box">
                        <select id="type_food" name="type_food">
                            <option value="All types">All types</option>
                            <option value="Algerian Food">Algerian Food</option>
                            <option value="Syrian Food">Syrian Food</option>
                        </select>
                    </div>
                    <input type="text" name="search" id="search" placeholder="Search..." required>
                    <button type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
                <div class="header_icons">
                    <div class="icon">
                        <a href="#">
                            <i class="fa-regular fa-heart"></i>
                            <span class="count count_favourite">0</span>
                        </a>
                    </div>
                    <div onclick="open_close_cart()" class="icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="count count_item_header"><?php echo count($_SESSION['cart']); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom_header">
            <div class="container">
                <nav class="nav">
                    <span onclick="open_Menu()" class="open_menu"><i class="fa-solid fa-bars"></i></span>
                    <div class="type_nav">
                        <div onclick="Open_type_list()" class="type_btn">
                            <i class="fa-solid fa-bars"></i>
                            <p>Browse types</p>
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                        <div class="type_nav_list">
                            <a href="#">Algerian Food</a>
                            <a href="#">Syrian Food</a>
                        </div>
                    </div>
                    <ul class="nav_links">
                        <span onclick="open_Menu()" class="close_menu"><i class="fa-regular fa-circle-xmark"></i></span>
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                    </ul>
                </nav>
                <div class="login_signup btns">
                    <a href="#" class="btn">Login <i class="fa-solid fa-right-to-bracket"></i></a>
                    <a href="#" class="btn">Sign UP <i class="fa-solid fa-user-plus"></i></a>
                </div>
            </div>
        </div>
    </header>

    <div class="slider">
        <div class="container">
            <div class="slide-swp mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="#"><img src="img/b1.png" alt=""></a>
                    </div>
                    <div class="swiper-slide">
                        <a href="#"><img src="img/b2.png" alt=""></a>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="banner_2">
                <a href="#"><img src="img/tall.png" alt=""></a>
            </div>
        </div>
    </div>

    <div class="banners_4">
        <div class="container">
            <div class="box">
                <a href="#" class="link_btn"></a>
                <img src="img/1.png" alt="">
                <div class="text">
                    <h5>Best Offers</h5>
                    <h5>Don't miss It</h5>
                    <div class="sale">
                        <p>Up <br> To</p>
                        <span>70%</span>
                    </div>
                    <h6>Order Now</h6>
                </div>
            </div>
            <div class="box">
                <a href="#" class="link_btn"></a>
                <img src="img/2.png" alt="">
                <div class="text">
                    <h5>Best Offers</h5>
                    <h5>don't miss it</h5>
                    <div class="sale">
                        <p>Up <br> To</p>
                        <span>70%</span>
                    </div>
                    <h6>Oder Now</h6>
                </div>
            </div>
            <div class="box">
                <a href="#" class="link_btn"></a>
                <img src="img/3.png" alt="">
                <div class="text">
                    <h5>Best Offers</h5>
                    <h5>Don't miss it</h5>
                    <div class="sale">
                        <p>Up <br> To</p>
                        <span>70%</span>
                    </div>
                    <h6>Oder Now</h6>
                </div>
            </div>
            <div class="box">
                <a href="#" class="link_btn"></a>
                <img src="img/4.png" alt="">
                <div class="text">
                    <h5>Best Offers</h5>
                    <h5>Don't miss it</h5>
                    <div class="sale">
                        <p>Up <br> To</p>
                        <span>70%</span>
                    </div>
                    <h6>Order Now</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="slider_products slide">
        <div class="container">
            <div class="slide_product mySwiper">
                <div class="top_slide">
                    <h2><i class="fa-solid fa-tags"></i> Great Opportunities</h2>
                </div>
                <div class="products swiper-wrapper" id="swiper_items_sale">
                    <?php foreach ($sale as $product): ?>
                        <?php
                        $percent_disc = $product['old_price'] ? floor(($product['old_price'] - $product['price']) / $product['old_price'] * 100) : 0;
                        $isInCart = array_key_exists($product['id'], $_SESSION['cart']);
                        ?>
                        <div class="swiper-slide product">
                            <span class="sale_present">%<?php echo $percent_disc; ?></span>
                            <div class="img_product">
                                <a href="#"><img src="<?php echo htmlspecialchars($product['img']); ?>" alt=""></a>
                            </div>
                            <div class="stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="name_product"><a href="#"><?php echo htmlspecialchars($product['name']); ?></a></p>
                            <div class="price">
                                <p><span>$<?php echo number_format($product['price'], 2); ?></span></p>
                                <p class="old_price">$<?php echo number_format($product['old_price'], 2); ?></p>
                            </div>
                            <div class="icons">
                                <span class="btn_add_cart <?php echo $isInCart ? 'active' : ''; ?>" data-id="<?php echo $product['id']; ?>">
                                    <i class="fa-solid fa-cart-shopping"></i> <?php echo $isInCart ? 'Item in cart' : 'add to cart'; ?>
                                </span>
                                <span class="icon_product"><i class="fa-regular fa-heart"></i></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next btn_Swip"></div>
                <div class="swiper-button-prev btn_Swip"></div>
            </div>
        </div>
    </div>

    <div class="slider_products slide">
        <div class="container">
            <div class="slide_product mySwiper">
                <div class="top_slide">
                    <h2><i class="fa-solid fa-tags"></i> Algerian</h2>
                </div>
                <div class="products swiper-wrapper" id="swiper_Algerian">
                    <?php foreach ($algerian as $product): ?>
                        <?php
                        $percent_disc = $dropping['old_price'] ? floor(($product['old_price'] - $product['price']) / $product['old_price'] * 100) : 0;
                        $isInCart = array_key_exists($product['id'], $_SESSION['cart']);
                        ?>
                        <div class="swiper-slide product">
                            <?php if ($percent_disc): ?>
                                <span class="sale_present">%<?php echo $percent_disc; ?></span>
                            <?php endif; ?>
                            <div class="img_product">
                                <a href="#"><img src="<?php echo htmlspecialchars($product['img']); ?>" alt=""></a>
                            </div>
                            <div class="stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="name_product"><a href="#"><?php echo htmlspecialchars($product['name']); ?></a></p>
                            <div class="price">
                                <p><span>$<?php echo number_format($product['price'], 2); ?></span></p>
                                <?php if ($product['old_price']): ?>
                                    <p class="old_price">$<?php echo number_format($product['old_price'], 2); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="icons">
                                <span class="btn_add_cart <?php echo $isInCart ? 'active' : ''; ?>" data-id="<?php echo $product['id']; ?>">
                                    <i class="fa-solid fa-cart-shopping"></i> <?php echo $isInCart ? 'Item in cart' : 'add to cart'; ?>
                                </span>
                                <span class="icon_product"><i class="fa-regular fa-heart"></i></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next btn_Swip"></div>
                <div class="swiper-button-prev btn_Swip"></div>
            </div>
        </div>
    </div>

    <div class="slider_products slide">
        <div class="container">
            <div class="slide_product mySwiper">
                <div class="top_slide">
                    <h2><i class="fa-solid fa-tags"></i> Syrian</h2>
                </div>
                <div class="products swiper-wrapper" id="swiper_Syrian">
                    <?php foreach ($syrian as $product): ?>
                        <?php
                        $percent_disc = $product['old_price'] ? floor(($product['old_price'] - $product['price']) / $product['old_price'] * 100) : 0;
                        $isInCart = array_key_exists($product['id'], $_SESSION['cart']);
                        ?>
                        <div class="swiper-slide product">
                            <?php if ($percent_disc): ?>
                                <span class="sale_present">%<?php echo $percent_disc; ?></span>
                            <?php endif; ?>
                            <div class="img_product">
                                <a href="#"><img src="<?php echo htmlspecialchars($product['img']); ?>" alt=""></a>
                            </div>
                            <div class="stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="name_product"><a href="#"><?php echo htmlspecialchars($product['name']); ?></a></p>
                            <div class="price">
                                <p><span>$<?php echo number_format($product['price'], 2); ?></span></p>
                                <?php if ($product['old_price']): ?>
                                    <p class="old_price">$<?php echo number_format($product['old_price'], 2); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="icons">
                                <span class="btn_add_cart <?php echo $isInCart ? 'active' : ''; ?>" data-id="<?php echo $product['id']; ?>">
                                    <i class="fa-solid fa-cart-shopping"></i> <?php echo $isInCart ? 'Item in cart' : 'add to cart'; ?>
                                </span>
                                <span class="icon_product"><i class="fa-regular fa-heart"></i></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next btn_Swip"></div>
                <div class="swiper-button-prev btn_Swip"></div>
            </div>
        </div>
    </div>

    <div class="slider_products slide">
        <div class="container">
            <div class="slide_product mySwiper">
                <div class="top_slide">
                    <h2><i class="fa-solid fa-tags"></i> Chinese</h2>
                </div>
                <div class="products swiper-wrapper" id="swiper_Chinese">
                    <?php foreach ($chinese as $product): ?>
                        <?php
                        $percent_disc = $product['old_price'] ? floor(($product['old_price'] - $product['price']) / $product['old_price'] * 100) : 0;
                        $isInCart = array_key_exists($product['id'], $_SESSION['cart']);
                        ?>
                        <div class="swiper-slide product">
                            <?php if ($percent_disc): ?>
                                <span class="sale_present">%<?php echo $percent_disc; ?></span>
                            <?php endif; ?>
                            <div class="img_product">
                                <a href="#"><img src="<?php echo htmlspecialchars($product['img']); ?>" alt=""></a>
                            </div>
                            <div class="stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="name_product"><a href="#"><?php echo htmlspecialchars($product['name']); ?></a></p>
                            <div class="price">
                                <p><span>$<?php echo number_format($product['price'], 2); ?></span></p>
                                <?php if ($product['old_price']): ?>
                                    <p class="old_price">$<?php echo number_format($product['old_price'], 2); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="icons">
                                <span class="btn_add_cart <?php echo $isInCart ? 'active' : ''; ?>" data-id="<?php echo $product['id']; ?>">
                                    <i class="fa-solid fa-cart-shopping"></i> <?php echo $isInCart ? 'Item in cart' : 'add to cart'; ?>
                                </span>
                                <span class="icon_product"><i class="fa-regular fa-heart"></i></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next btn_Swip"></div>
                <div class="swiper-button-prev btn_Swip"></div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="big_row">
                <img class="logo_footer" src="img/logo.png" alt="">
                <p>New good well so go eat but jfvj nkfkmmfmmmlml fbnhf jcnk</p>
                <div class="icons_footer">
                    <a href="#"><i class="fa-solid fa-phone"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                </div>
            </div>
            <div class="row">
                <h4>Help Center</h4>
                <div class="links">
                    <a href="#"><i class="fa-solid fa-caret-right"></i> Issues</a>
                    <a href="#"><i class="fa-solid fa-caret-right"></i> Contact us</a>
                    <a href="#"><i class="fa-solid fa-caret-right"></i> Questions</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="JS/swiper.js"></script>
    <script src="JS/main.js"></script>
</body>
</html>
