<?php
echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
echo '<meta name="title" content="'. $metaTitle .'">';
echo '<meta name="keywords" content="'. $metaKeywords .'">';
echo '<meta name="description" content="'. $metaDescription .'">';
if ($facebookPixelCode) echo '<script>'. $facebookPixelCode .'</script>';
wp_head();
echo '<style type="text/css">';
echo '#promo-area {background-image: url('. AS_THEME_DIR .'images/promo-bg.jpg);}';
if (get_option('bbil_themeOptionsSaved')) {
 echo get_option('bbil_themeStyle_'. AS_THEME_NAME);
}
echo '</style>';
echo '</head>';
echo '<body class="'. implode(' ', get_body_class()) .'">';
?>