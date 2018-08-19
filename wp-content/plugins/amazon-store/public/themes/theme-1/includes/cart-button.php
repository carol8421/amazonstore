<?php
if (!session_id()) @session_start();
$cartItemTotal = isset($_SESSION['products']['TotalItems']) ? $_SESSION['products']['TotalItems'] : 0;
?>
<div id="cartModalBtn" class="header_cart pull-right">
	<div class="cart-item"> <span class="cartItemTotal"><?php echo $cartItemTotal; ?></span> </div>
	<a href="javascript:;"> <i class="fa fa-shopping-bag" aria-hidden="true"></i> </a>
</div>

<script>
    jQuery(function ($) {
        "use strict";
        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        function showCartModal(ajaxurl) {
            $.ajax({
                url : ajaxurl,
                data : { 'action': 'showCartModal' },
                type : 'post',
                beforeSend : function ( xhr ) { /* preloader(); */ },
                success : function( data ) {
                    $('.cartModalContainer').html(data);
                    $('#cartModalWrapper').modal('show');
                },
                error: function(e){ alert(e); }
            });
        }
        // cart modal
        $(document).on('click', '#cartModalBtn', function (event) {
            event.preventDefault();
            showCartModal(ajaxurl);
        });
    });
</script>