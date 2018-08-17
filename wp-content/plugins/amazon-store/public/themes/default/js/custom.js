jQuery( function($) {

    var handle = $( "#custom-handle" );
    var change_text = $( "#discount-rate>span" );
    var sidebar_change_text = $( "#sidebar-discount-rate>span" );
    $( "#slider, #sidebar-slider" ).slider({
    	value: 10,
	    orientation: "horizontal",
	    range: "min",
	    animate: true,
      	create: function() {
        	//change_text.text( $( this ).slider( "value" ) );
      	},
      	slide: function( event, ui ) {
            change_text.text( ui.value );
        },
        stop: function() {
            //preloader();
        }
    });
    
    // $( "#sidebar-slider" ).slider({
	 //    orientation: "horizontal",
	 //    range: "min",
	 //    animate: true,
    //   	create: function() {
    //     	sidebar_change_text.text( $( this ).slider( "value" ) );
    //   	},
    //   	slide: function( event, ui ) {
    //     	//handle.text( ui.value );
    //     	sidebar_change_text.text( ui.value );
    //   	}
    // });
    
});

jQuery('.dropdown-toggle').dropdown();

// Bootstrap nav hover dropdown
jQuery('.dropdown').hover(
    function() {
        jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn();
    },
    function() {
        jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut();
    }
);

jQuery('.dropdown-menu').hover(
    function() {
        jQuery(this).stop(true, true);
    },
    function() {
        jQuery(this).stop(true, true).delay(200).fadeOut();
    }
);
// social share
function share_on_facebook(title, url){
    window.open(
            'http://www.facebook.com/sharer.php?s=100&p[title]=title&p[summary]=article summery&p[url]='+url+'&p[images][0]=',
            'facebook-share-dialog',
            'width=626,height=436');
}
function share_on_twitter(url){
    window.open("https://twitter.com/share?url="+url);
}
function share_on_gplus(url){
    window.open("https://plus.google.com/share?url="+url);
}
function share_on_linkedin(url, base_url){
    window.open("https://www.linkedin.com/shareArticle?mini=true&url="+url+"&submitted-image-url="+url+"&title={{ $article->title }}&summary={{ substr($article->description, 0, 50) }}&source="+base_url);
}