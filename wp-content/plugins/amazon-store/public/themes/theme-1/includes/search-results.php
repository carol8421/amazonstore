<?php
$AMAZON_PRODUCT = new AmazonSearch(AS_ACCESS_KEY, AS_SECRET_KEY, AS_ASSOCIATE);
echo '<section id="product-list">';
echo '<div class="container">';
$AMAZON_PRODUCT->render();
echo '</div>';
echo '</section>';