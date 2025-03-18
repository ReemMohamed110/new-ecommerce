<?php
require_once __DIR__ .'\..\..\app\Cart_class.php';
$cart = new Cart();
$user_id = 1; 
$cartItems = $cart->read($user_id);
$total = 0;
?>
<div class="shopping_cart_area mt-60">
    <div class="container">
        <form action="update_cart.php" method="post">
            <div class="row">
                <div class="col-12">
                    <div class="table_desc">
                        <div class="cart_page table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product_thumb"> image</th>
                                        <th class="product_name">product</th>
                                        <th class="product-price">price</th>
                                        <th class="product_quantity">quantity</th>
                                        <th class="product_total">total</th>
                                        <th class="product_remove">remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($cartItems) && is_array($cartItems)) : ?>
                                        <?php foreach ($cartItems as $item) :
                                            $itemTotal = $item['price'] * $item['quantity'];
                                            $total += $itemTotal;
                                        ?>
                                            <tr>
                                                <td class="product_thumb"><img src="uploads/products/<?= htmlspecialchars($item['image']) ?>" alt=""></td>
                                                <td class="product_name"><?= htmlspecialchars($item['name']) ?></td>
                                                <td class="product-price"><?= number_format($item['price'], 2) ?></td>
                                                <td class="product_quantity"><input type="number" name="quantity[<?= $item['product_id'] ?>]" min="1" value="<?= $item['quantity'] ?>"></td>
                                                <td class="product_total"><?= number_format($itemTotal, 2) ?></td>
                                                <td class="product_remove"><a href="remove_from_cart.php?product_id=<?= $item['product_id'] ?>">إزالة</a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="6">cart empty</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="cart_submit">
                            <button type="submit">update cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="coupon_area">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="coupon_code left">
                            <h3>coupon</h3>
                            <input placeholder=" " type="text">
                            <button type="submit">upplay</button>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="coupon_code right">
                            <h3> cart total</h3>
                            <p>Total: <?= number_format($total, 2) ?></p>
                            <div class="checkout_btn">
                                <a href="checkout.php"> checkout </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
