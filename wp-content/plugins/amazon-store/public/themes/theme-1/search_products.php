<!DOCTYPE html>
<html lang="en">
  	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">

	    <title>Theme-2</title>
	      
	    <link rel="stylesheet" href="<?php echo AS_THEME_DIR; ?>/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo AS_THEME_DIR; ?>/css/jquery-ui.min.css">
		<link rel="stylesheet" href="<?php echo AS_THEME_DIR; ?>/css/jquery-ui.theme.min.css">

		<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	    <link href="<?php echo AS_THEME_DIR; ?>/css/common-styles.css" rel="stylesheet">
	    <link href="<?php echo AS_THEME_DIR; ?>/css/HoldOn.min.css" rel="stylesheet">
	    <link href="<?php echo AS_THEME_DIR; ?>/css/jquery.rateyo.css" rel="stylesheet">
	    <link href="<?php echo AS_THEME_DIR; ?>/css/style.css" rel="stylesheet">
		<link href="<?php echo AS_THEME_DIR; ?>/css/mediaquery.css" rel="stylesheet">
  	</head>

  	<body>

		<section id="promo-area">
		</section>
            
        <div id="product-search">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <select class="form-control plugin-form-control">
                            <option>Select Category</option>
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                            <option>Option 4</option>
                            <option>Option 5</option>
                        </select>
                    </div>
                    
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                        <div class="input-group">
                            <input type="text" class="form-control plugin-form-control" placeholder="Discount">
                            <span id="discount-percent" class="input-group-addon plugin-form-control">%</span>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                        <div class="input-group">
                            <input type="text" class="form-control plugin-form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn reverse-btn plugin-form-control" type="button">Search...</button>
                            </span>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <div class="header_cart pull-right" data-toggle="modal" data-target="#cart_pop">
                            <div class="cart-item">
                                <span>2</span>
                            </div>
                            <a href="javascript:;">
                                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

		<section id="product-list">
			<div class="container">
				<div class="row">
					<!--Content START -->
				  	<div class="col-lg-3 col-sm-6 col-xs-12">
				  		<div class="product-item">
					      	<div class="product-img">
                                <a href="javascript:;" data-toggle="modal" data-target="#detailsModal">
                                    <div class="item-hover">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </div>
                                </a>

					      		<img class="img-responsive" src="https://images-na.ssl-images-amazon.com/images/I/51JVp8YV3ZL._SX404_BO1,204,203,200_.jpg">
					      	</div>
							
							<div class="product-info">
                                <div class="product-description">
                                    <a href="javascript:;" data-toggle="modal" data-target="#detailsModal">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, saepe.</a>
                                </div>

                                <div class="product-price">
                                    <p>
                                        <span class="line-through">$17.00</span>
                                        <span class="actual-rate">$14.00</span>
                                    </p>
                                </div>

                                <div class="rateYo"></div>

                                <div class="cart-btn-list">
                                    <button class="btn btn-dark btn-cart">
                                        <img src="<?php echo AS_THEME_DIR; ?>/images/icons/shopping-cart-empty-side-view.png">
                                    </button>
                                </div>
                            </div>
					    </div>
				  	</div>
					
					<div class="col-lg-3 col-sm-6 col-xs-12">
					  	<div class="product-item">
					      	<div class="product-img">
                                <a href="details.html">
                                    <div class="item-hover">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </div>
                                </a>
					      		<img class="img-responsive" src="https://images-na.ssl-images-amazon.com/images/I/51I8pov18EL._SX215_.jpg">
					      	</div>
							
							<div class="product-info">
                                <div class="product-description">
                                    <a href="details.html">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, saepe.</a>
                                </div>

                                <div class="product-price">
                                    <p>
                                        <span class="line-through">$17.00</span>
                                        <span class="actual-rate">$14.00</span>
                                    </p>
                                </div>

                                <div class="rateYo"></div>

                                <div class="cart-btn-list">
                                    <button class="btn btn-dark btn-cart">
                                        <img src="<?php echo AS_THEME_DIR; ?>/images/icons/shopping-cart-empty-side-view.png">
                                    </button>
                                </div>
                            </div>
					    </div>
				    </div>

				    <div class="col-lg-3 col-sm-6 col-xs-12">
						<div class="product-item">
					      	<div class="product-img">
                                <a href="javascript:;" data-toggle="modal" data-target="#detailsModal">
                                <div class="item-hover">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </div>
                                </a>
					      		<img class="img-responsive" src="https://images-na.ssl-images-amazon.com/images/I/51cWYOv2s4L._AC_UL115_.jpg">
					      	</div>
							
							<div class="product-info">
                                <div class="product-description">
                                    <a href="javascript:;" data-toggle="modal" data-target="#detailsModal">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, saepe.</a>
                                </div>

                                <div class="product-price">
                                    <p>
                                        <span class="line-through">$17.00</span>
                                        <span class="actual-rate">$14.00</span>
                                    </p>
                                </div>

                                <div class="rateYo"></div>

                                <div class="cart-btn-list">
                                    <button class="btn btn-dark btn-cart">
                                        <img src="<?php echo AS_THEME_DIR; ?>/images/icons/shopping-cart-empty-side-view.png">
                                    </button>
                                </div>
                            </div>
					    </div>
				    </div>

				    <div class="col-lg-3 col-sm-6 col-xs-12">
						<div class="product-item">
					      	<div class="product-img">
                                <a href="javascript:;" data-toggle="modal" data-target="#detailsModal">
                                <div class="item-hover">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </div>
                                </a>
					      		<img class="img-responsive" src="https://images-na.ssl-images-amazon.com/images/I/81rzpYIhkEL._AC_.jpg">
					      	</div>
							
							<div class="product-info">
                                <div class="product-description">
                                    <a href="javascript:;" data-toggle="modal" data-target="#detailsModal">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, saepe.</a>
                                </div>

                                <div class="product-price">
                                    <p>
                                        <span class="line-through">$17.00</span>
                                        <span class="actual-rate">$14.00</span>
                                    </p>
                                </div>

                                <div class="rateYo"></div>

                                <div class="cart-btn-list">
                                    <button class="btn btn-dark btn-cart">
                                        <img src="<?php echo AS_THEME_DIR; ?>/images/icons/shopping-cart-empty-side-view.png">
                                    </button>
                                </div>
                            </div>
					    </div>
				    </div>

				    <div class="col-lg-3 col-sm-6 col-xs-12">
						<div class="product-item">
					      	<div class="product-img">
                                <a href="javascript:;" data-toggle="modal" data-target="#detailsModal">
                                <div class="item-hover">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </div>
                                </a>
					      		<img class="img-responsive" src="http://www.kristianhammerstad.com/render/w768-h768-c0-q95/1.illustration/74.nyt-retraining/1.nyt-retraining.jpg">
					      	</div>
							
							<div class="product-info">
                                <div class="product-description">
                                    <a href="javascript:;" data-toggle="modal" data-target="#detailsModal">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, saepe.</a>
                                </div>

                                <div class="product-price">
                                    <p>
                                        <span class="line-through">$17.00</span>
                                        <span class="actual-rate">$14.00</span>
                                    </p>
                                </div>

                                <div class="rateYo"></div>

                                <div class="cart-btn-list">
                                    <button class="btn btn-dark btn-cart">
                                        <img src="<?php echo AS_THEME_DIR; ?>/images/icons/shopping-cart-empty-side-view.png">
                                    </button>
                                </div>
                            </div>
					     
					    </div>
				    </div>

				    <div class="col-lg-3 col-sm-6 col-xs-12">
						<div class="product-item">
					      	<div class="product-img">
                                <a href="javascript:;" data-toggle="modal" data-target="#detailsModal">
                                <div class="item-hover">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </div>
                                </a>
					      		<img class="img-responsive" src="https://images-na.ssl-images-amazon.com/images/I/615%2BkIBFS8L._UX522_.jpg">
					      	</div>
							
					      	<div class="product-info">
                                <div class="product-description">
                                    <a href="javascript:;" data-toggle="modal" data-target="#detailsModal">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, saepe.</a>
                                </div>

                                <div class="product-price">
                                    <p>
                                        <span class="line-through">$17.00</span>
                                        <span class="actual-rate">$14.00</span>
                                    </p>
                                </div>

                                <div class="rateYo"></div>

                                <div class="cart-btn-list">
                                    <button class="btn btn-dark btn-cart">
                                        <img src="<?php echo AS_THEME_DIR; ?>/images/icons/shopping-cart-empty-side-view.png">
                                    </button>
                                </div>
                            </div>
					    </div>
				    </div>

				    <div class="col-lg-3 col-sm-6 col-xs-12">
						<div class="product-item">
					      	<div class="product-img">
                                <a href="javascript:;" data-toggle="modal" data-target="#detailsModal">
                                <div class="item-hover">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </div>
                                </a>
					      		<img class="img-responsive" src="https://images-na.ssl-images-amazon.com/images/I/616igPCWfqL._UX425_.jpg">
					      	</div>
							
							<div class="product-info">
						      	<div class="product-description">
						      		<a href="javascript:;" data-toggle="modal" data-target="#detailsModal">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, saepe.</a>
						      	</div>

						      	<div class="product-price">
                                    <p>
                                        <span class="line-through">$17.00</span>
                                        <span class="actual-rate">$14.00</span>
                                    </p>
                                </div>

                                <div class="rateYo"></div>

                                <div class="cart-btn-list">
                                    <button class="btn btn-dark btn-cart">
                                        <img src="<?php echo AS_THEME_DIR; ?>/images/icons/shopping-cart-empty-side-view.png">
                                    </button>
                                </div>
					      	</div>
					    </div>
				    </div>
					<!--Content END -->
				</div>
			</div>
		</section>

		<!-- Cart pop START -->
		<div class="modal fade" id="cart_pop" role="dialog">
		    <div class="modal-dialog modal-lg">
		    
		      	<!-- Modal content-->
		      	<div class="modal-content">
			        <div class="modal-body">
			          	<div class="table-responsive">
			          		<table class="table" id="cart_table">
							    <thead>
							      	<tr>
								        <th></th>
								        <th class="w40">Name</th>
								        <th class="text-center w10">Price</th>
								        <th class="text-center w20">Qty</th>
								        <th class="text-center w12">SubTotal</th>
								        <th class="w10"></th>
							      	</tr>
							    </thead>
							    <tbody>
							      	<tr>
								        <td>
								        	<img src="http://via.placeholder.com/50x50">
								        </td>
								        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, aspernatur.</td>
								        <td class="text-center"><b>35</b></td>
								        <td class="text-center">
								        	<div class="product_add pull-right">
					                            <div class="btn-minus"><span class="glyphicon glyphicon-minus"></span></div>
					                            <input value="1">
					                            <div class="btn-plus"><span class="glyphicon glyphicon-plus"></span></div>
					                        </div>
								        </td>
								        <td class="text-center"><b>$5.00</b></td>
								        <td class="text-center">
								        	<button class="btn remove_cart_item">Remove</button>
								        </td>
							      	</tr>

							      	<tr>
								        <td>
								        	<img src="http://via.placeholder.com/50x50">
								        </td>
								        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, aspernatur.</td>
								        <td class="text-center"><b>35</b></td>
								        <td class="text-center">
								        	<div class="product_add pull-right">
					                            <div class="btn-minus"><span class="glyphicon glyphicon-minus"></span></div>
					                            <input value="1">
					                            <div class="btn-plus"><span class="glyphicon glyphicon-plus"></span></div>
					                        </div>
								        </td>
								        <td class="text-center"><b>$5.00</b></td>
								        <td class="text-center">
								        	<button class="btn remove_cart_item">Remove</button>
								        </td>
							      	</tr>
							    </tbody>
							  </table>
			          	</div>
						<!-- If cart is empty -->
			          	<h4 class="text-center hidden">Cart is empty</h4>
			        </div>
			        <div class="modal-footer cart-modal-footer">
			          	<button type="button" class="btn btn-default text-uppercase pull-left" data-dismiss="modal">Close</button>

			          	<button type="button" class="btn btn-default text-uppercase">Checkout</button>
			        </div>
		      	</div>
		      
		    </div>
		</div>
		<!-- Cart pop END -->

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
	
    <script src="<?php echo AS_THEME_DIR; ?>/js/jquery.min.js"></script>
    <script src="<?php echo AS_THEME_DIR; ?>/js/jquery-ui.min.js"></script>
    <script src="<?php echo AS_THEME_DIR; ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo AS_THEME_DIR; ?>/js/HoldOn.min.js"></script>
    <script src="<?php echo AS_THEME_DIR; ?>/js/elevatezoom.min.js"></script>
    <script src="<?php echo AS_THEME_DIR; ?>/js/jquery.rateyo.js"></script>
    <script src="<?php echo AS_THEME_DIR; ?>/js/custom.js"></script>
	
	<script>
        $(document).ready(function(){
            $('.btn-cart').click(function(){
                $('#cart_pop').modal('show');
            });
        });
	</script>

  </body>
</html>
