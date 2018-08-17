<?php if (get_option('bbil_bannersUseImageAndLink')) {
	$bannerLink = get_option('bbil_bannerLink');
	$bannerImage = get_option('bbil_bannerImage');
	$bannerLink = $bannerLink ? $bannerLink : 'javascript:;';
	$bannerImage = $bannerImage ? $bannerImage : 'http://via.placeholder.com/730x90';
	echo '<section id="banner">';
	echo '<a href="'. $bannerLink .'">';
	echo '<img src="'. $bannerImage .'">';
	echo '</a>';
	echo '</section>';
}
if (get_option('bbil_bannerUseCode')) {
	$bannerTheCode = get_option('bbil_bannerTheCode');
	echo '<section id="banner">';
	echo $bannerTheCode ? $bannerTheCode : 'No code found';
	echo '</section>';
}