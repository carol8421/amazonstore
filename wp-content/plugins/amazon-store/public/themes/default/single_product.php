<?php if (!session_id()) @session_start();
if (!ENABLE_INDIVIDUAL) { wp_redirect( site_url('/search-products/') ); exit; }

// Get product information
$AMAZON_PRODUCT = new amazon_search(AWS_ACCESS_KEY, AWS_SECRET_KEY, ASSOCIATIVE_ID);
$productID = isset($_GET['id']) && trim($_GET['id']) ? trim($_GET['id']) : 'B01LBHSBUG';
$product = $AMAZON_PRODUCT->get_single_product($productID);
$attributes = $AMAZON_PRODUCT->getProductArray();
$attributes = $attributes['items'][0];

// Header
$metaTitle = $attributes['Title'];
$metaKeywords = $attributes['Title'].', '.$attributes['RootCategory'];
$metaDescription = getMetaDescription($attributes['Feature']);
$facebookPixelCode = get_option('bbil_facebookPixelCode');
$facebookPixelCode = get_option('bbil_facebookPixelCodeEnable') && $facebookPixelCode ? $facebookPixelCode : '';
$_SESSION['singleTitle'] = trim($attributes['Title']) ? $attributes['Title'] : false;
add_filter( 'pre_get_document_title', 'generate_single_title', 10 );
include 'includes/header.php';

// Header Menu
$logoImageOrText = get_option('bbil_logoImageOrText');
if ($logoImageOrText == 'logoTxt') {
    $logoHeaderText = get_option('bbil_logoHeaderText');
    $logoHeaderText = $logoHeaderText ? $logoHeaderText : 'logoHeaderText';
    $headerLogoImageOrText = '<a class="navbar-brand logo_text" href="'. home_url('/') .'">'. $logoHeaderText .'</a>';
} else if ($logoImageOrText == 'logoImage'){
    $logoImageUrl = get_option('bbil_logoImageUrl');
    $logoImageUrl = $logoImageUrl ? $logoImageUrl : BBIL_THEME_DIR .'images/your-logo.png';
    $headerLogoImageOrText = '<a class="navbar-brand" href="'. home_url('/') .'"> <img class="logo common_page_logo" src="'. $logoImageUrl .'"> </a>';
} else {
    $logoImageUrl = BBIL_THEME_DIR .'images/your-logo.png';
    $headerLogoImageOrText = '<a class="navbar-brand" href="'. home_url('/') .'"> <img class="logo common_page_logo" src="'. $logoImageUrl .'"> </a>';
}
include 'includes/navbar.php';

// Modal button
include 'includes/cart_modal_btn.php';

// Single product content
echo '<section id="product-details-wrapper">';
    echo '<div class="container">';
        echo '<div class="row">';
            single_page_content($attributes, $product);
            $categories = $AMAZON_PRODUCT->getCategories();
            if (get_option('bbil_showSidebar')) { include 'includes/sidebar.php'; }
        echo '</div>';
    echo '</div>';
echo '</section>';

// Footer
include 'includes/footer.php';
include 'includes/cart.php'; // cart modal
?>
<script>
jQuery(function($) {
	"use strict";

	//elevate zoom 
    $('#zoom_image').elevateZoom({
        zoomWindowFadeIn: 500,
        zoomWindowFadeOut: 500,
        lensFadeIn: 500,
        lensFadeOut: 500
    });

	var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	var discountValue = <?php echo AS_OFFER; ?>;
	var sidebar_change_text = $( "#sidebar-discount-rate>span" );
	var redirectUrl = "<?php echo esc_url(site_url('/')); ?>";

	function preloader(){
       HoldOn.open({
           theme:'sk-rect',
           backgroundColor:"#fff",
           textColor:"white"
       });
    };
	function singlePageSearch(ajaxurl, formData) {
		formData.action = 'bbil_singlePageSearch';
		$.ajax({
            url : ajaxurl,
            data: formData,
            method: 'post',
            beforeSend  : function(){ preloader(); }, 
            success     : function(data){
                var searchSufix = '?keywords='+formData.Keywords;
                if(formData.MinPercentageOff) searchSufix += '&offer='+formData.MinPercentageOff;

            	window.location.href = redirectUrl+searchSufix;
            },
            error       : function(){
            	HoldOn.close(); 
            	console.log(e); 
            }
        });
	}

    // products by category
    $(document).on( 'click', '#sidebarCategories li a, .topMenuItem', function(event) {
        event.preventDefault();
        var SearchIndex = null, Keywords = null, MinPercentageOff = null, formData = null, nodeid = null, searchSufix = null;

        nodeid = $(this).attr('nodeid');
        if ($(this).is('.topMenuItem') && nodeid) {
            SearchIndex = $(this).attr('href');
            Keywords    = nodeid;
            searchSufix = '?category='+ SearchIndex + '&BrowseNode='+ Keywords;
        } else {
            SearchIndex = $(this).attr('href');
            Keywords = 'all';
            searchSufix = '?category='+SearchIndex;
        }

        //alert(redirectUrl+searchSufix); return false;
        window.location.href = redirectUrl+searchSufix;
    });

    // sidebarSearchForm && headerSearchSubmit form
    $(document).on( 'click', '#headerSearchSubmit, #sidebarSearchForm', function(event) {
        event.preventDefault();
        var MinPercentageOff = null, Keywords = null, searchSufix = null;
        if ($(this).attr('id') == 'sidebarSearchForm') {
            MinPercentageOff= $('#sidebar-discount-rate span').html();
            Keywords    	= $('#sidebarSearchKeywords').val();
        } else {
            Keywords    = $('#headerSearchKeywords').val();
            MinPercentageOff   = $('#headerSearchSubmit').attr('discount');
        }
        searchSufix = '?keywords='+ Keywords + '&offer='+ MinPercentageOff;
        window.location.href = redirectUrl+searchSufix;
    });

    // sidebar slider
    // $( "#sidebar-slider" ).slider({
    //     orientation: "horizontal",
    //     range: "min",
    //     value: discountValue,
    //     animate: true,
    //     create: function() {
    //         sidebar_change_text.text( $( this ).slider( "value" ) );
    //     },
    //     slide: function( event, ui ) {
    //         //handle.text( ui.value );
    //         sidebar_change_text.text( ui.value );
    //     },
    //     stop: function() {
    //         //preloader();
    //     }
    // });
});
</script>