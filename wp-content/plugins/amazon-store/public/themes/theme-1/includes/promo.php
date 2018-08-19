<?php
$bannerImg = get_option(AS_OPTION_PREFIX .'bannerImage');
$bannerVisibility = get_option(AS_OPTION_PREFIX .'bannerVisibility');
if ($bannerVisibility == 'enabled' && $bannerImg) {
    echo '<style>';
        echo '#promo-area {background-image: url("'. $bannerImg .'")}';
    echo '</style>';
}
?>
<section id="promo-area"></section>