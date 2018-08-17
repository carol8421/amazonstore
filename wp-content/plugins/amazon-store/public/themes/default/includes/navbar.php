<?php
$flagImageUrl = AS_PLUGIN_DIR .'images/usa.png';
$AMAZON_PRODUCT = new AmazonCats(AS_ACCESS_KEY, AS_SECRET_KEY, AS_ASSOCIATE);

$Appliances = $AMAZON_PRODUCT->getSubCategories(468240, false); // SportingGoods
//echo '<br><pre>'. print_r($Appliances, true) .'</pre>'; exit();
?>

<nav class="navbar navbar-secondery no-margin">
  	<div class="container-fluid">
  		<div class="navbar-header">
            <?php
            // enable xs menu button
            echo '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header_top_nav_bar" aria-expanded="false">';
            echo '<span class="sr-only">Toggle navigation</span>';
            echo '<span class="icon-bar"></span>';
            echo '<span class="icon-bar"></span>';
            echo '<span class="icon-bar"></span>';
            echo '</button>';

            // XS flag
            echo '<div id="xs-flag" class="hidden-md hidden-lg">';
            echo '<img src="'. $flagImageUrl .'">';
            echo '</div>';

            // XS logo
            echo $headerLogoImageOrText;
            ?>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="header_top_nav_bar">
            
            <?php echo TH::headerMenu($AMAZON_PRODUCT); ?>
			
			<div class="navbar no-margin pull-right header_form details_top_searchbar">
				<?php
				echo '<div id="flag" class="hidden-xs hidden-sm">';
				echo '<img src="'. $flagImageUrl .'">';
				echo '</div>';

                include 'header_search_form.php'; ?>
	      	</div>
	    </div>
  	</div>
</nav>