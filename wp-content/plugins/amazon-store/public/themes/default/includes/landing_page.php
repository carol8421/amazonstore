<?php $promoAreaVideoCssClass = get_option('bbil_landbgusebgvideo') ? 'videoEnabled' : ''; ?>
<section id="promo-area" class="<?php echo $promoAreaVideoCssClass; ?>">
    <?php 
    $useLandbgusebgvideoorimage = get_option('bbil_useLandbgusebgvideoorimage');
    $ndbgusebgvideoorimage = get_option('bbil_landbgusebgvideoorimage');
    if ($ndbgusebgvideoorimage && $useLandbgusebgvideoorimage) {
        echo '<div class="landbgusebgvideoorimage"  style="background-image: url('.AS_PLUGIN_DIR.'images/patterns/'.$ndbgusebgvideoorimage.'.png;)"></div>';
    }

    // video background
    echo '<div class="video-background">';
    if ($promoAreaVideoCssClass) {
	    echo '<div class="video-foreground">';
	    echo '<iframe id="ytplayer" width="540" height="500" src="https://www.youtube.com/embed/'. get_option('bbil_landbgyoutubevideo') .'?controls=0&showinfo=0&rel=0&version=3&enablejsapi=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
	    echo '</div>';
	    echo ' 
        <script>
            var player;
            var timeInterval = '. get_option("bbil_landbgvideoPlayTime", 10) .' * 1000;
            
            // 2. This code loads the IFrame Player API code asynchronously.
            var tag = document.createElement("script");
    
            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName("script")[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    
            function onYouTubeIframeAPIReady() {
                var iframe = document.getElementById("ytplayer");
                player = new YT.Player(iframe, {
                    events: {
                        "onReady": onPlayerReady,
                        "onStateChange": onPlayerStateChange
                    }
                });
            }
            function onPlayerReady() {
                player.playVideo();
            }
            function onPlayerStateChange(event) {
                if (player.getPlayerState() == 0) {
                    setTimeout(onPlayerReady, timeInterval);
                }
            }
        </script>';
    }
    echo '</div>';
    ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xs-12 text-center" id="landingpage_content">

                <?php 
                if (OPTIONS_SAVED) {
                    if (get_option('bbil_enableheadertext')) {
                        echo '<h1> '. get_option('bbil_landheadertextusa') .'</h1>';
                    }
                } else { echo '<h1>Welcome!!</h1>'; } 
                if (get_option('bbil_landsubheadertextusa')) { echo '<h2>'. get_option('bbil_landsubheadertextusa') .'</h2>'; } ?>
                <?php $landdiscountbartextusa = get_option('bbil_landdiscountbartextusa');
                $landdiscountbartextusa = $landdiscountbartextusa ? $landdiscountbartextusa : 'Discount';
                echo '<div id="discount-rate">'. $landdiscountbartextusa .': <span>'. AS_OFFER .'</span>%</div>';

                // jquery ui slider START
                echo '<div id="discountSliderWrapper">';
                echo '<p class="slider-range">';
                echo '<span class="pull-left">0%</span>';
                echo '<span class="pull-right">100%</span>';
                echo '</p>';
                echo '<div id="slider"> <div id="custom-handle" class="ui-slider-handle"></div> </div>';
                echo '</div>';

                $landssbplaceholdertxtusa = get_option('bbil_landssbplaceholdertxtusa');
                $landssbplaceholdertxtusa = $landssbplaceholdertxtusa ? $landssbplaceholdertxtusa : 'Search for...';
                $landbuttontextusa = get_option('bbil_landbuttontextusa');
                $landbuttontextusa = $landbuttontextusa ? $landbuttontextusa : 'Find';
                ?>
                <form action="" method="POST" role="form">
                    <div class="input-group" id="searchbar">
                        <input id="searchKeywords" type="text" class="form-control" placeholder="<?php echo $landssbplaceholdertxtusa; ?>">
                        <span class="input-group-btn">
                            <button id="searchForm" class="btn" type="submit"><?php echo $landbuttontextusa; ?></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>