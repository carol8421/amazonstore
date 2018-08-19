<!-- Cart pop START -->
<div class="modal fade" id="cartModalWrapper" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body cartModalContainer"></div>
			<div class="modal-footer cart-modal-footer">
				<button type="button" class="btn btn-default text-uppercase pull-left" data-dismiss="modal">Close</button>

				<button type="button" class="btn btn-default text-uppercase cartCheckoutBtn">Checkout</button>
			</div>
		</div>
	</div>
</div>
<!-- Cart pop END -->
<script>
    jQuery(function($) {
        "use strict";
        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        // Add to cart
        $(document).on('click', '.addToCart', function (event) {
            event.preventDefault();
            var itemTotal = $('.single_product_add input').val();
            if (!itemTotal) { itemTotal = 1; }
            var item = $(this).attr('item');
            addItemToCart(ajaxurl,item, itemTotal);
        });
        $(document).on( 'click', '.cartCheckoutBtn', function (event) {
            event.preventDefault();
            var items = [];
            var ASIN='', ASIN_number ='', number=0;
            $('#cart_table .cartItemContainer').each(function(index) {
                ASIN = $(this).attr('id');
                number = parseInt($(this).find('.cartProductCount').val());
                ASIN_number = ASIN +':'+ number;
                items.push(ASIN_number);
            });
            orderOnAmazon(ajaxurl,items.join('_#_'));
        });
        //remove cart item
        $(document).on('click', '.remove_cart_item',function(){
            var item = $(this).attr('item');
            removeItemRowFromCart(ajaxurl,item);
            updateDomAfterRemovingItemFormCart($(this));
        });

        // add item button
        $(document).on('click', ".btn-plus", function(event) {
            var item_count = $(this).parent(".product_add").children("input");
            var now = $(item_count).val();
            if ($.isNumeric(now)){
                $(item_count).val(parseInt(now)+1);
                if ($(this).is('.cartPlus')) {
                    var itemID = $(this).parents('tr').attr('id');
                    var ajaxData = {'action': 'increaseCartItems', 'item': itemID };
                    increaseOrDecreaseCartItems(ajaxurl, ajaxData);
                    cartUpdateSubtotalAndTotal($(this));
                }
            }else{
                $(item_count).val("1");
            }

        });
        //-- Click on QUANTITY
        $(document).on('click', ".btn-minus", function(event) {
            var item_count = $(this).parent(".product_add").children("input");
            var now = $(item_count).val();
            if ($.isNumeric(now)){
                if (parseInt(now) -1 > 0){ now--;}
                $(item_count).val(now);
                if ($(this).is('.cartMinus')) {
                    var itemID = $(this).parents('tr').attr('id');
                    var ajaxData = {'action': 'decreaseCartItems', 'item': itemID };
                    increaseOrDecreaseCartItems(ajaxurl, ajaxData);
                    cartUpdateSubtotalAndTotal($(this));
                }
            }else{
                $(item_count).val("1");
            }
        })

        $(document).on('change', '#cart_table .cartProductCount', function(event) {
            cartUpdateSubtotalAndTotal($(this));
        });

        function addItemToCart(ajaxurl,item, total) {
            $.ajax({
                url : ajaxurl,
                data : {
                    'action': 'addItemToCart',
                    'total': total,
                    'item': item
                },
                type : 'post',
                beforeSend : function ( xhr ) {},
                success : function( data ) {
                    // alert(data);
                    var products = JSON.parse(data);
                    console.log(products);
                    if (products.TotalItems) $('.cartItemTotal').text(products.TotalItems);
                },
                error: function(e){ alert(e); }
            });
        }
        function orderOnAmazon(ajaxurl,items) {
            $.ajax({
                url : ajaxurl,
                data : {
                    'action': 'orderOnAmazon',
                    'items': items,
                },
                type : 'post',
                beforeSend : function ( xhr ) {},
                success : function( data ) { window.location.href = data; },
                error: function(e){ console.log('Error with `orderOnAmazon`'); }
            });
        }
        function removeItemRowFromCart(ajaxurl,item) {
            $.ajax({
                url : ajaxurl,
                data : {
                    'action': 'removeItemRowFromCart',
                    'item': item,
                },
                type : 'post',
                beforeSend : function ( xhr ) {},
                success : function( data ) {
                    $('.cartItemTotal').text(data);
                },
                error: function(e){ alert(e); }
            });
        }
        function updateDomAfterRemovingItemFormCart(element) {
            //remove cart item
            var cartTotal = 0, cartSubTotal = 0;
            cartTotal = $('.cartTotalPrice span').text();
            cartSubTotal = element.parents('tr').find('.cartSubTotalPrice span').text();
            cartTotal = (cartTotal - cartSubTotal).toFixed(2);
            $('.cartTotalPrice span').text(cartTotal);
            element.parents('tr').remove();
        }
        function cartUpdateTotal() {
            var cartTotal = 0;
            $('#cart_table .cartSubTotalPrice').each(function () {
                cartTotal = cartTotal + parseFloat($(this).find('span').text());
            });
            $('#cart_table .cartTotalPrice span').text(cartTotal.toFixed(2));
        }
        function cartUpdateSubtotalAndTotal(element) {
            var itemPrice = element.parents('tr').find('.cartItemPrice span').text();
            var noOfItems = element.parents('tr').find('.cartProductCount').val();
            var itemSubTotal = (itemPrice * noOfItems).toFixed(2);
            element.parents('tr').find('.cartSubTotalPrice span').text(itemSubTotal);
            cartUpdateTotal();
        }
        function increaseOrDecreaseCartItems(ajaxurl, ajaxData) {
            $.ajax({
                url : ajaxurl,
                data : ajaxData,
                type : 'post',
                beforeSend : function ( xhr ) {},
                success : function( data ) {
                    $('.cartItemTotal').text(data);
                },
                error: function(e){ alert(e); }
            });
        }
    });
</script>