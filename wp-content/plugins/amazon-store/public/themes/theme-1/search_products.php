<!--detailsOpenStyle-->
<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php //include 'includes/promo.php'; ?>
<?php include 'includes/search-form.php'; ?>
<?php include 'includes/search-results.php'; ?>
<?php include 'includes/cart-modal.php'; ?>
<?php include 'includes/modal-details.php'; ?>
<?php include 'includes/footer.php'; ?>
<script>
    jQuery(function ($) {
        var ajaxurl             = "<?php echo admin_url('admin-ajax.php'); ?>";
        var initiate_new_load   = true;
        var SearchIndex         = '';
        var ItemPage            = '';
        var maxPages            = '';
        var category            = '';
        var discount            = '';
        var keywords            = '';
        var MinPercentageOff    = '';
        var productAttrChanged  = false;

        $(document).on('submit', '#searchForm', function (event) {
            event.preventDefault();
            var message = $('.messageContainer');
            keywords    = $('#keywords').val();
            discount    = $('#discount').val();
            category    = $('#category').val();

            if (keywords) {
                initiate_new_load = true;
                $.ajax({
                    url : ajaxurl, // AJAX handler
                    data    : {
                        'action'            : 'searchProduct',
                        'MinPercentageOff'  : discount,
                        'Keywords'          : keywords
                    },
                    method  : 'POST',
                    beforeSend  : function() {
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

                    },
                    error       : function() {
                        console.log(e);
                    }
                });
            } else {
                message.html('<p class="text-danger">All fields are required.</p>');
                setTimeout(function () {
                    message.html('');
                }, 2000);
            }
            //console.log('category : '+ category +' == discount : '+ discount +' == keywords : '+ keywords); return false;
        });

        // Unlimited Scroll
        productAttrChanged = changeProductWrapperAttr();
        if (productAttrChanged) {
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
    });
</script>