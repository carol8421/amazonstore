<!--Details modal START-->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Product Details</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div id="details-carousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#details-carousel" data-slide-to="0" class="active"></li>
                                <li data-target="#details-carousel" data-slide-to="1"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <img src="https://images-na.ssl-images-amazon.com/images/I/51JVp8YV3ZL._SX404_BO1,204,203,200_.jpg" alt="...">
                                </div>
                                <div class="item">
                                    <img src="http://www.kristianhammerstad.com/render/w768-h768-c0-q95/1.illustration/74.nyt-retraining/1.nyt-retraining.jpg" alt="...">
                                </div>
                            </div>

                            <!-- Controls -->
                            <a class="left carousel-control" href="#details-carousel" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#details-carousel" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="product-details">
                            <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit</h2>
                            <div class="rateYo"></div>

                            <div class="product-price">
                                <p>
                                    <span class="line-through">$17.00</span>
                                    <span class="actual-rate">$14.00</span>
                                </p>
                            </div>

                            <div class="product_add">
                                <div class="btn-minus"><span class="glyphicon glyphicon-minus"></span></div>
                                <input value="1">
                                <div class="btn-plus"><span class="glyphicon glyphicon-plus"></span></div>
                            </div>

                            <div class="details-cart">
                                <button id="add_to_cart_btn" class="btn btn-success">
                                            <span>
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            </span>
                                    Add to cart
                                </button>

                                <button id="buy_now_btn" class="btn btn-success clearfix">
                                            <span>
                                                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                            </span>
                                    Buy Now
                                </button>
                            </div>

                            <div class="details-social">
                                <ul class="single_socials">
                                    <li>
                                        <a href="">
                                            <img src="<?php echo AS_THEME_DIR; ?>/images/icons/facebook.png">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <img src="<?php echo AS_THEME_DIR; ?>/images/icons/twitter.png">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <img src="<?php echo AS_THEME_DIR; ?>/images/icons/google-plus.png">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="details-info">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#Description" aria-controls="Description" role="tab" data-toggle="tab">Description</a></li>
                                <li role="presentation"><a href="#Specification" aria-controls="Specification" role="tab" data-toggle="tab">Specification</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="Description">
                                    <ul class="list-unstyled">
                                        <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus corporis debitis, reiciendis ut autem nostrum incidunt recusandae quam vitae in!</li>
                                        <li><b>Media Type:</b> CD</li>
                                        <li><b>Artist:</b> lorem</li>
                                        <li><b>Title:</b> ipsum</li>
                                        <li><b>Street Release Date:</b> 01/17/2017</li>
                                        <li><b>Genre:</b> <span class="text-uppercase">consectetur adipisicing</span></li>
                                    </ul>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="Specification">
                                    <div class="table-responsive">
                                        <table class="table table-bordered product_spec_table">
                                            <tbody>
                                            <tr>
                                                <td class="text-right font-bold">Item Dimension</td>
                                                <td>
                                                    <ul>
                                                        <li>100 Lorem ipsum.</li>
                                                        <li>200 Lorem ipsum.</li>
                                                        <li>95 Lorem ipsum.</li>
                                                        <li>11Lorem ipsum.</li>
                                                    </ul>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-right font-bold">Label</td>
                                                <td>
                                                    World Disney Records
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-right font-bold">Language</td>
                                                <td>
                                                    <ul>
                                                        <li>Englist</li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Details modal END-->