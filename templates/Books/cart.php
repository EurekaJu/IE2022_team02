<!doctype html>
<head>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<style>
    input[type=number]::-webkit-inner-spin-button {
    opacity: 1
}
</style>
    <body>
        <!-- shopping-cart-area start -->
        <div class="cart-main-area pt-30 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h1 class="cart-heading">Shopping Cart</h1>
                        
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Remove</th>
                                            <th>Image</th>
                                            <th>Book</th>
                                            <th>Status</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($_SESSION['cart'])){
                                            foreach($_SESSION['cart'] as $s) {
                                                if(isset($s['pID'])) {
                                                    foreach($books as $b) {
                                                        if($b->id == $s['pID']) { ?>
                                                        <tr >
                                                            <!-- have a form to remove from cart -->
                                                            <td class="product-remove">
                                                                <?= $this->Form->create(null, array('type' => 'get')); ?>
                                                                    <input type="hidden" name="RemovepID" value="<?php echo $s['pricetype']?>" id="<?php echo $s['pricetype']?>">
                                                                <input type='submit' value='X' style="text-align: center;font-size:100%">
<!--                                                                <input type='image' class="remove" src="../webroot/img/xbutton.png">-->
                                                                <?= $this->Form->end(); ?>

                                                            </td>
                                                            <td class="product-thumbnail" style="transform: scale(0.6)">
                                                            <?= $this->Html->image("$b->thumbnail_img", ['url' => ['controller' => 'Books', 'action' => 'view', $b->id]]);?>
                                                            </td>
                                                            <td class="product-name"><a ><?= $b->name?> <br> <?= $s['booktype'] ?> <br> (Volume: <?= $s['volume'] ?>)</a></td>
                                                            <!-- status pre-order check -->
                                                            <?php if($b->status == 'Pre-Order') { ?>
                                                                <td class="product-name"><a ><?= $b->status?> <br> (<?= number_format((float) $s['deposit'], 2, '.', '') ?>% Deposit = $<?=number_format((float) $s['finalPrice'], 2, '.', '')?>) </a></td>
                                                            <?php }
                                                            else { ?>
                                                                <td class="product-name"><a ><?= $b->status?> <br> ($<?=number_format((float) $s['finalPrice'], 2, '.', '')?>) </a></td>
                                                            <?php }?>
                                                            <td class="product-price-cart"><span class="amount">$<?= number_format((float) $s['price'], 2, '.', '')?></span></td>
                                                            <td class="product-quantity">
                                                                <!-- have a form to update product qty -->
                                                                <?= $this->Form->create(null, array('type' => 'get')); ?>
                                                                    <input id="qty" name="qty" value=<?= $s['quan']?> type="number" min=1>
                                                                    <input type="hidden" id="pricetype" name="pricetype" value="<?= $s['pricetype']?>">
                                                                        <input type='submit' value='Update' style="text-align: center;font-size:100%"></input>
                                                                <?= $this->Form->end(); ?>
                                                            </td>
                                                            <td class="product-subtotal">$<?= number_format((float) $s['quan'] * $s['finalPrice'], 2, '.', '')?></td>
                                                        </tr>
                                                <?php }
                                                }
                                            }
                                        }
                                    }?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-5 ms-auto">
                                    <div class="cart-page-total">
                                        <h2>Cart totals</h2>
                                        <ul>
                                        <!-- <?php if(isset($_SESSION['cart'])) { ?> -->
                                            <!-- <li>Subtotal<span>100.00</span></li> -->
                                            <li>Total<span>$<?= number_format((float) $sum, 2, '.', '') ?></span></li>
                                            <!-- <?php } ?> -->
                                        </ul>
                                        <?php if(isset($_SESSION['cart'])) {
                                            if(count($_SESSION['cart']) > 0) {?>
                                                <div class="button-box">
                                                    <button class="default-btn floatright" id="checkout-button">
                                                        Checkout
                                                    </button>
                                                    <script>
                                                        var stripe = Stripe('pk_test_51LclOqK2XRplstJPeHtJQdBAyVPcVCBriph3n4qOQ0GfFbB9bnzM3IcbKFiynmPuF6x88drlXxMSC9XJQorFSY8U00lsLPY2kG'); //create an instance of stripe (client side)
                                                        const btn = document.getElementById("checkout-button")
                                                        btn.addEventListener('click', function (e) { //add this so that the stripe checkout doesnt display immediately.event listener
                                                            e.preventDefault();
                                                            stripe.redirectToCheckout({ //redirect to stripe checkout
                                                                sessionId: "<?php echo $session->id; ?>"
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                        <?php }
                                        }
                                        else { ?>
                                        <br><h5><strong>Your cart is empty.</strong></h5>
                                         <?php  } ?>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- shopping-cart-area end -->
		</body>
</html>
