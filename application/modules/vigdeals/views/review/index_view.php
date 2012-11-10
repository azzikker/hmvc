<script type="text/javascript" src="assets/vigattin_deals/js/reviewcart.js"></script>  
<form method="post" action="payment">
    <div id="rpc-h">
        <div id="rpc-h-div">
            <img src="assets/vigattin_deals/images/cart.png" style="position: absolute; width: 65px; left: 23px; top: 10px;" alt="">
            <span>YOUR CART</span>
        </div>
    </div>
    <div id="rpc">
        <div id="rpc-t">
        <?php //CART VIEW ?>
        <?php echo $my_cart_view; ?>
        </div>
        <div id="rpc-td">Total Due:&nbsp;&nbsp;&nbsp;&nbsp;P <span>0</span></div>
    </div>
    <div id="rpc-btn">
        <a href="<?php echo base_url() ?>">
            <div id="rpc-btn-b">Continue Shopping</div>
        </a>
        <input type="submit" value="Next Step" id="rpc-btn-ns">
    </div>
</form>
