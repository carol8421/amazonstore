<div class="clearfix"></div>
<footer>
    <div class="bs-docs-footer hidden">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <p class="footer-title">About Us</p>
                    <ul>
                        <li>
                            <a href="#">About</a>
                        </li>
                        <li>
                            <a href="#">Terms and Conditions</a>
                        </li>
                        <li>
                            <a href="#">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#">Careers</a>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-3">
                    <p class="footer-title">CUSTOMER SERVICE</p>
                    <ul>
                        <li>
                            <a href="#">Help Center</a>
                        </li>
                        <li>
                            <a href="#">How to Shop</a>
                        </li>
                        <li>
                            <a href="#">Track your Order</a>
                        </li>
                        <li>
                            <a href="#">Returns & Refunds</a>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-3">
                    <p class="footer-title">Payment Products</p>
                    <ul>
                        <li>
                            <a href="#">Visa Signature Cards</a>
                        </li>
                        <li>
                            <a href="#">Corporate Credit Line</a>
                        </li>
                        <li>
                            <a href="#">Shop with Points</a>
                        </li>
                        <li>
                            <a href="#">Currency Converter</a>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-3">
                    <p class="footer-title">Let Us Help You</p>
                    <ul>
                        <li>
                            <a href="#">Your Account</a>
                        </li>
                        <li>
                            <a href="#">Shipping Rates & Policies</a>
                        </li>
                        <li>
                            <a href="#">Your Content and Devices</a>
                        </li>
                        <li>
                            <a href="#">Help</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
        <?php if (AS_SETTINGS_SAVED) {
            if (get_option('bbil_landfootershow')) {
               echo '<div id="footer-text"><p>'. get_option('bbil_landfootertextusa') .'</p></div>';
            }
        } else { echo '<div id="footer-text"><p>copyright@<a href="#">footertext.com</a></p></div>'; } ?>
</footer>

<?php wp_footer(); ?>

</body>
</html>