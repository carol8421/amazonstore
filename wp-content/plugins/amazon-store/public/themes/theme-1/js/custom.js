jQuery( function($) {
    var handle = $( "#custom-handle" );
    var change_text = $( "#discount-rate>span" );
    var sidebar_change_text = $( "#sidebar-discount-rate>span" );
    $( "#slider, #sidebar-slider" ).slider({
    	//value: 60,
	    orientation: "horizontal",
	    range: "min",
	    animate: true,
      	create: function() {
        	change_text.text( $( this ).slider( "value" ) );
      	},
      	slide: function( event, ui ) {
            change_text.text( ui.value );
        },
        stop: function() {
            preloader();
        }
    });

    //Search Button click
    $('#searchbarBtn').click(function(){
        preloader();
    });

    //Preloader
    function preloader(){
        HoldOn.open({
            theme:'sk-rect',
            backgroundColor:"#fff",
            textColor:"white"
        });

        setTimeout(function(){
            HoldOn.close();
        },2000);
    };

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
      	}
    });

    //-- Click on QUANTITY
    $(".btn-minus").on("click",function(){
        var item_count = $(this).parent(".product_add").children("input");
        var now = $(item_count).val();
        if ($.isNumeric(now)){
            if (parseInt(now) -1 > 0){ now--;}
            $(item_count).val(now);
        }else{
            $(item_count).val("1");
        }
    })            
    $(".btn-plus").on("click",function(){
        var item_count = $(this).parent(".product_add").children("input");
        var now = $(item_count).val();
        if ($.isNumeric(now)){
            $(item_count).val(parseInt(now)+1);
        }else{
            $(item_count).val("1");
        }
    });  

    //remove cart item
    $(document).on('click','.remove_cart_item',function(){
        $(this).parents('tr').remove();
    });

    //elevate zoom 
    $('#zoom_image').elevateZoom({
        zoomWindowFadeIn: 500,
        zoomWindowFadeOut: 500,
        lensFadeIn: 500,
        lensFadeOut: 500
    });
});

jQuery('.dropdown-toggle').dropdown();

// Bootstrap nav hover dropdown
jQuery('.dropdown').hover(
    function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn();
    },
    function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut();
    }
);

jQuery('.dropdown-menu').hover(
    function() {
        $(this).stop(true, true);
    },
    function() {
        $(this).stop(true, true).delay(200).fadeOut();
    }
);

jQuery(".rateYo").rateYo({
    rating: 3.6,
    readOnly: true,
    starWidth: "15px"
});


