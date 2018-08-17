<?php @session_start();
if (isset($_GET['BrowseNode']) && !empty(trim($_GET['BrowseNode']))) {
	$_SESSION['bbil_Keywords'] = trim($_GET['BrowseNode']);
}
if (isset($_GET['keywords']) && !empty(trim($_GET['keywords']))) {
	$_SESSION['bbil_Keywords'] = trim($_GET['keywords']);
}
if (isset($_GET['offer']) && !empty(trim($_GET['offer']))) {
	$_SESSION['bbil_MinPercentageOff'] = trim($_GET['offer']);
}
if (isset($_GET['category']) && !empty(trim($_GET['category']))) {
	$_SESSION['bbil_SearchIndex'] = trim($_GET['category']);
}

// Header
$metaTitle = get_option('bbil_seoHomeTitle');
$metaDescription = get_option('bbil_seoHomeDescription');
$metaKeywords = get_option('bbil_seoHomeKeywords');
$facebookPixelCode = get_option('bbil_landingPageFacebookPixelCode');
$facebookPixelCode = get_option('bbil_landingPageFacebookPixelEnable') && $facebookPixelCode ? $facebookPixelCode : '';
add_filter( 'pre_get_document_title', 'generate_custom_title', 10 );
include 'includes/header.php';

// Navbar
$landingPageCenterLogo = get_option('bbil_landingPageCenterLogo');
if (get_option('bbil_landlogouseuploadimage') && $landingPageCenterLogo) $landingPageCenterLogo = $landingPageCenterLogo ? $landingPageCenterLogo : plugin_dir_url(__FILE__).'../images/your-logo.png';
else $landingPageCenterLogo = AS_PLUGIN_DIR .'images/your-logo.png';
$headerLogoImageOrText = '<a class="navbar-brand" href="'. home_url('/') .'"><img class="logo" src="'. $landingPageCenterLogo .'"> </a>';
include 'includes/navbar.php';

// Banner or advertisement
include 'includes/banner.php';

// Modal button
include 'includes/cart_modal_btn.php';

// Landing page
if (get_option('bbil_enableOnePageLandingPage') || get_option('bbil_enableLandingPage')) {
	include 'includes/landing_page.php';
}

if (get_option('bbil_enableOnePageLandingPage')) {
	$AMAZON_PRODUCT = new amazon_search(AS_ACCESS_KEY, AS_SECRET_KEY, AS_ASSOCIATE);
	echo '<section id="product-list">';
	echo '<div class="container">';
	echo '<div class="row">';
	echo '<div class="col-lg-9 col-sm-6"> ';
	$AMAZON_PRODUCT->render();
	//$AMAZON_PRODUCT->getLoader();
	echo '</div>';
	$categories = $AMAZON_PRODUCT->getCategories();

	// Sidebar
	if (get_option('bbil_showSidebar')) { include 'includes/sidebar.php'; }
	echo '</div>';
	echo '</div>';
	echo '</section>';
}

// Footer
include 'includes/footer.php';

include 'includes/cart.php'; // cart modal

include 'includes/404.php'; // No product found
?>

<script>
    jQuery(function ($) {
        var ajaxurl             = "<?php echo admin_url('admin-ajax.php'); ?>";
        var initiate_new_load   = true;
        var SearchIndex         = '';
        var ItemPage            = '';
        var maxPages            = '';
        var Keywords            = '';
        var MinPercentageOff    = '';
        var productAttrChanged  = false;

        //Pre loader
        function preloader(){
            HoldOn.open({theme:'sk-rect', backgroundColor:"#fff", textColor:"white"});
        }
        function changeHeaderSearchDiscountRate(discountRate) {
            $('#searchbar_top_discount').html('Disc %'+ discountRate);
            $('#headerSearchSubmit').attr('discount', discountRate);
        }
        function resetSidebarSliderFormValues(discountRate) {
            $('#sidebar-discount-rate span').html(discountRate);
            $('#sidebar-slider > #custom-handle').css('left', discountRate+'%');
            $('#sidebar-slider > .ui-slider-range').css('width', discountRate+'%');
            $('#sidebarSearchKeywords').val('');
        }
        function resetLandingSliderFormValues(discountRate) {
            $('#discount-rate span').html(discountRate);
            $('#slider > #custom-handle').css('left', discountRate+'%');
            $('#slider > .ui-slider-range').css('width', discountRate+'%');
            $('#searchKeywords').val('');
        }
        function changeProductWrapperAttr() {
            var productAttr = {};
            productAttr.category = "<?php echo $_GET['category']; ?>";
            productAttr.offer = "<?php echo $_GET['offer']; ?>";
            productAttr.keywords = "<?php echo $_GET['keywords']; ?>";
            productAttr.BrowseNode = "<?php echo $_GET['BrowseNode']; ?>";
            var productWrapper = jQuery('#productWrapper');
            if (productAttr.offer) productWrapper.attr('data_minpercentageoff', productAttr.offer);
            if (productAttr.BrowseNode) {
                if (productAttr.category) productWrapper.attr('data_searchindex', productAttr.category);
                productWrapper.attr('data_keywords', productAttr.BrowseNode);
            } else {
                if (productAttr.category) productWrapper.attr('data_searchindex', productAttr.category);
                if (productAttr.keywords) productWrapper.attr('data_keywords', productAttr.keywords);
            }
            return true;
        }

        function changePageTitle(newTitle) {
            var titleTxt = $('title').text();
            var splitedTitle = titleTxt.split('<');
            splitedTitle[0] = newTitle;
            $('title').text(splitedTitle.join(' <'));
        }

        // search products
        $(document).on( 'click', '#searchForm, #sidebarSearchForm, #headerSearchSubmit', function(event) {
            event.preventDefault();
            if ($(this).attr('id') == 'searchForm') {
                // reset sidebar form values
                MinPercentageOff   = $('#discount-rate span').html();
                Keywords    = $('#searchKeywords').val();
                resetSidebarSliderFormValues(MinPercentageOff);
                changeHeaderSearchDiscountRate(MinPercentageOff);
            } else if ($(this).attr('id') == 'sidebarSearchForm') {
                // reset landing page form values
                MinPercentageOff   = $('#sidebar-discount-rate span').html();
                Keywords    = $('#sidebarSearchKeywords').val();
                resetLandingSliderFormValues(MinPercentageOff);
                changeHeaderSearchDiscountRate(MinPercentageOff);
            } else {
                // reset all form values
                MinPercentageOff   = $('#headerSearchSubmit').attr('discount');
                Keywords    = $('#headerSearchKeywords').val();
                resetLandingSliderFormValues(MinPercentageOff);
                resetSidebarSliderFormValues(MinPercentageOff);
            }
            if (Keywords) {
                initiate_new_load = true;
                $.ajax({
                    url : ajaxurl, // AJAX handler
                    data    : {
                        'action'            : 'searchProduct',
                        'MinPercentageOff'  : MinPercentageOff,
                        'Keywords'          : Keywords
                    },
                    method  : 'POST',
                    beforeSend  : function() {
                        preloader();
                        $('#productWrapper').html('');
                    },
                    success     : function(data) {
                        var dataObj = JSON.parse(data);
                        if (dataObj.products) {
                            $('#productWrapper').html(dataObj.products);
                            $('#productWrapper').attr('data_SearchIndex', 'All');
                            $('#productWrapper').attr('data_maxPages', dataObj.maxPages);
                            $('#productWrapper').attr('data_Keywords', dataObj.Keywords);
                            $('#productWrapper').attr('data_MinPercentageOff', dataObj.MinPercentageOff);
                            $('#productWrapper').attr('data_itempage', 2);
                            $('.spinnerWrapper').addClass('hidden');

                            var urlPath = '?keywords='+ dataObj.Keywords +'&offer='+ dataObj.MinPercentageOff;
                            window.history.pushState(null,null, urlPath);
                        } else {
                            $('#productWrapper').html('<div class="clearfix"><br><br></div><h1 class="text-center text-danger"> Nothing found </h1>');
                            $('#404').modal('show');
                            initiate_new_load = false;
                        }
                        changePageTitle(Keywords);
                        HoldOn.close();
                    },
                    error       : function() {
                        HoldOn.close();
                        $('.spinnerWrapper').addClass('hidden');
                        console.log(e);
                    }
                });
            } else {
                alert('Name should not be empty.');
            }
        });

        // search products by category
        $(document).on( 'click', '#sidebarCategories li a, .topMenuItem', function(event) {
            event.preventDefault();
            var nodeid = $(this).attr('nodeid');
            if ($(this).is('.topMenuItem') && nodeid) {
                SearchIndex = $(this).attr('href');
                Keywords    = nodeid;
            } else {
                SearchIndex = $(this).attr('href');
                Keywords = 'all';
            }
            MinPercentageOff = $('#productWrapper').attr('data_MinPercentageOff');
            if (Keywords) {
                $.ajax({
                    url : ajaxurl, // AJAX handler
                    data    : {
                        'action'            : 'searchProductByCategory',
                        'MinPercentageOff'  : MinPercentageOff,
                        'Keywords'          : Keywords,
                        'SearchIndex'       : SearchIndex
                    },
                    method  : 'post',
                    beforeSend  : function() {
                        preloader();
                        $('#productWrapper').html(''); preloader();
                    },
                    success     : function(data){
                        var dataObj = JSON.parse(data);
                        if (dataObj.products.length > 0) {
                            $('#productWrapper').html(dataObj.products);
                            $('#productWrapper').attr('data_SearchIndex', dataObj.SearchIndex);
                            $('#productWrapper').attr('data_maxPages', dataObj.maxPages);
                            $('#productWrapper').attr('data_Keywords', dataObj.Keywords);
                            $('#productWrapper').attr('data_MinPercentageOff', dataObj.MinPercentageOff);
                            $('#productWrapper').attr('data_itempage', 2);
                            $('.spinnerWrapper').addClass('hidden');

                            var urlPath = '?category='+ SearchIndex;
                            if (parseInt(Keywords)) urlPath += '&BrowseNode='+ dataObj.Keywords;
                            //alert(urlPath);
                            window.history.pushState(null,null, urlPath);
                        } else {
                            $('#productWrapper').html('<div class="clearfix"><br><br></div><h1 class="text-center text-danger"> Nothing found </h1>');
                            $('#404').modal('show');
                            initiate_new_load = false;
                        }
                        changePageTitle(SearchIndex);
                        HoldOn.close();
                    },
                    error       : function() {
                        HoldOn.close();
                        console.log(e);
                    }
                });
            } else {
                alert('Name should not be empty.');
            }
        });

        productAttrChanged = changeProductWrapperAttr();
        // infinite loading
        if (productAttrChanged){
            $(window).scroll(function() {
                if (ItemPage <= maxPages && initiate_new_load ) {
                    if($(window).scrollTop() + $(window).height() > $(document).height() - 2000 ) {
                        SearchIndex     = $('#productWrapper').attr('data_SearchIndex');
                        ItemPage        = parseInt($('#productWrapper').attr('data_ItemPage'));
                        maxPages        = $('#productWrapper').attr('data_maxPages');
                        Keywords        = $('#productWrapper').attr('data_Keywords');
                        MinPercentageOff= $('#productWrapper').attr('data_MinPercentageOff');
                        //console.log('MinPercentageOff : '+ MinPercentageOff + ' === Keywords:'+ Keywords + ' === SearchIndex : '+ SearchIndex); return false;
                        $.ajax({
                            url : ajaxurl, // AJAX handler
                            data : {
                                'action': 'loadMoreProducts',
                                'SearchIndex': SearchIndex,
                                'Keywords': Keywords,
                                'ItemPage' : ItemPage,
                                'MinPercentageOff' : MinPercentageOff
                            },
                            type : 'POST',
                            beforeSend : function ( xhr ) {
                                jQuery('.spinnerWrapper').removeClass('hidden');
                                initiate_new_load = false;
                            },
                            success : function( data ) {
                                if (data.length > 0) {
                                    jQuery('#productWrapper').append(data);
                                    jQuery('.spinnerWrapper').addClass('hidden');
                                    $('#productWrapper').attr('data_itempage', ItemPage + 1);
                                    initiate_new_load = true;
                                }
                            },
                            error: function(e) {
                                jQuery('.spinnerWrapper').addClass('hidden');
                                //alert(e);
                            }
                        });
                    }
                }
            });
        }

        // Discount slider range
        var handle = $( "#custom-handle" );
        var change_text = $( "#discount-rate>span" );
        var discountValue = <?php echo SEARCH_OFFER; ?>;
        $( "#slider, #sidebar-slider" ).slider({
            //value: 60,
            orientation: "horizontal",
            range: "min",
            value: discountValue,
            animate: true,
            create: function() {
                change_text.text( $( this ).slider( "value" ) );
            },
            slide: function( event, ui ) {
                change_text.text( ui.value );
            },
            stop: function() {
                //preloader();
            }
        });

        var sidebar_change_text = $( "#sidebar-discount-rate>span" );
        $( "#sidebar-slider" ).slider({
            orientation: "horizontal",
            range: "min",
            animate: true,
            create: function() {
                sidebar_change_text.text( $( this ).slider( "value" ) );
            },
            slide: function( event, ui ) {
                //handle.text( ui.value );
                sidebar_change_text.text( ui.value );
            },
            stop: function() {
                //preloader();
            }
        });

    }); // Document ready end

</script>