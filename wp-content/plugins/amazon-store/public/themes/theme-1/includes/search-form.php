<?php

?>
<div id="product-search">
	<div class="container">
		<div class="row">
            <form id="searchForm" action="">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		            <?php Helper::printRootCategoriesHtmlForSearch(); ?>
                </div>

                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                    <div class="input-group">
                        <input id="discount" type="text" class="form-control plugin-form-control" value="<?php echo AS_OFFER; ?>">
                        <span id="discount-percent" class="input-group-addon plugin-form-control">%</span>
                    </div>
                </div>

                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                    <div class="input-group">
                        <input id="keywords" type="text" class="form-control plugin-form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn reverse-btn plugin-form-control" type="submit">Search...</button>
                        </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </form>

			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
				<?php include 'cart-button.php'; ?>
			</div>
		</div>
        <div class="row"><div class="messageContainer text-center"></div></div>
	</div>
</div>