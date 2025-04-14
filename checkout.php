<?php
require_once 'config.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$total_price = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $_SESSION['cart']));
$total_count = array_sum(array_map(fn($item) => $item['quantity'], $_SESSION['cart']));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EatNow | Delicious</title>
    <link rel="icon" href="img/logo.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div class="cart">
        <div class="top_cart">
            <h3>Cart Items : <span class="Count_item_cart"><?php echo $total_count; ?></span></h3>
            <span onclick="open_close_cart()" class="close_cart"><i class="fa-regular fa-circle-xmark"></i></span>
        </div>
        <div class="items_in_cart" id="cart_items"></div>
        <div class="bottom_cart">
            <div class="total">
                <p>subtotal</p>
                <p class="price_cart_toral">$<?php echo number_format($total_price, 2); ?></p>
            </div>
            <div class="button_cart">
                <a href="#" class="btn_cart btn">Checkout</a>
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
                        <span class="count count_item_header"><?php echo $total_count; ?></span>
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
                        <li class="active"><a href="index.php">Home</a></li>
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

    <section class="checkout">
        <form id="form_contact" method="post" action="process_order.php">
            <input type="hidden" id="items" name="items" value="<?php echo htmlspecialchars(implode("\n", array_map(fn($item) => "{$item['name']} --- price: {$item['price'] * $item['quantity']} --- count: {$item['quantity']}", $_SESSION['cart']))); ?>">
            <input type="hidden" id="total_Price" name="total_Price" value="<?php echo $total_price; ?>">
            <input type="hidden" id="count_Items" name="count_Items" value="<?php echo $total_count; ?>">
            <div class="container">
                <div class="ordersummary">
                    <h1>Order Summary</h1>
                    <div class="items" id="checkout_items">
                        <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                            <div class="item_cart">
                                <div class="image_name">
                                    <img src="<?php echo htmlspecialchars($item['img']); ?>" alt="">
                                    <div class="content">
                                        <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                                        <p class="price_cart">$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></p>
                                        <div class="quantity_control">
                                            <button type="button" class="decrease_quantity" data-index="<?php echo $index; ?>">-</button>
                                            <span class="quantity"><?php echo $item['quantity']; ?></span>
                                            <button type="button" class="Increase_quantity" data-index="<?php echo $index; ?>">+</button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="delete_item" data-inex="<?php echo $index; ?>"><i class="fa-solid fa-trash-can"></i></button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="bottom_summary">
                        <div class="shop_table">
                            <p>total :</p>
                            <span class="total_checkout">$<?php echo number_format($total_price, 2); ?></span>
                        </div>
                        <div class="button_div">
                            <button type="submit">Place order</button>
                        </div>
                    </div>
                </div>
                <div class="input_info">
                    <div class="address">
                        <h2>Delivery Address</h2>
                        <div class="inputs">
                            <label for="">Email</label>
                            <input type="email" placeholder="Enter your email" name="Email" required>
                            <label for="">Name</label>
                            <input type="text" placeholder="enter your name" name="Name" required>
                            <label for="">Address</label>
                            <input type="text" placeholder="enter your address" name="Address" required>
                            <label for="">Phone</label>
                            <input type="number" placeholder="enter your phone" name="Phone" required>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

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

    <script src="JS/main.js"></script>
    <script src="JS/submit_checkout.js"></script>
</body>
</html>
