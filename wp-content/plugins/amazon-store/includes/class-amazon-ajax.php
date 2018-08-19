<?php

class amazonAjax {
	function __construct() {

		// Save setup data
		add_action('wp_ajax_bbilas_setup', array( $this, 'bbilas_setup'));
		add_action('wp_ajax_nopriv_bbilas_setup', array( $this, 'bbilas_setup'));

		// Save theme
		add_action('wp_ajax_saveSettings', array( $this, 'bbilas_save_settings'));
		add_action('wp_ajax_nopriv_saveSettings', array( $this, 'bbilas_save_settings'));

		// Load sub categories
		add_action('wp_ajax_bbilas_loadSubCategories', array( $this, 'bbilas_loadSubCategories'));
		add_action('wp_ajax_nopriv_bbilas_loadSubCategories', array( $this, 'bbilas_loadSubCategories'));

		// Load sub categories
		add_action('wp_ajax_loadMoreProducts', array( $this, 'bbilas_loadMoreProducts'));
		add_action('wp_ajax_nopriv_loadMoreProducts', array( $this, 'bbilas_loadMoreProducts'));

		// Search products
		add_action('wp_ajax_searchProduct', array( $this, 'bbilas_searchProduct' ));
		add_action('wp_ajax_nopriv_searchProduct', array( $this, 'bbilas_searchProduct' ));

		// Add to cart
		add_action('wp_ajax_addItemToCart', array( $this, 'bbilas_addItemToCart' ));
		add_action('wp_ajax_nopriv_addItemToCart', array( $this, 'bbilas_addItemToCart' ));

		// Show the cart
		add_action('wp_ajax_showCartModal', array( $this, 'bbilas_showCartModal' ));
		add_action('wp_ajax_nopriv_showCartModal', array( $this, 'bbilas_showCartModal' ));

		// Show the cart
		add_action('wp_ajax_removeItemRowFromCart', array( $this, 'bbilas_removeItemRowFromCart' ));
		add_action('wp_ajax_nopriv_removeItemRowFromCart', array( $this, 'bbilas_removeItemRowFromCart' ));

		// Increase corresponding item at cart
		add_action('wp_ajax_increaseCartItems', array( $this, 'bbilas_increaseCartItems'));
		add_action('wp_ajax_nopriv_increaseCartItems', array( $this, 'bbilas_increaseCartItems'));

		// Decrese corresponding item at cart
		add_action('wp_ajax_decreaseCartItems', array( $this, 'bbilas_decreaseCartItems'));
		add_action('wp_ajax_nopriv_decreaseCartItems', array( $this, 'bbilas_decreaseCartItems'));

		// Order on amazon
		add_action('wp_ajax_orderOnAmazon', array( $this, 'bbilas_orderOnAmazon' ));
		add_action('wp_ajax_nopriv_orderOnAmazon', array( $this, 'bbilas_orderOnAmazon' ));
	}

	/**
	 * Save setup data
	 *
	 * @return json response
	 */
	function bbilas_setup() {
		// posted data
		$step          = (int) Helper::getPostField($_POST['step']);
		$data = [];
		if ($step == 1) {
			$data['accessKey']          = Helper::getPostField($_POST['accessKey']);
			$data['secretKey']          = Helper::getPostField($_POST['secretKey']);
			$data['associate']          = Helper::getPostField($_POST['associate']);
		}

		if ($step == 2) {
			$data['storeKeyword']       = Helper::getPostField($_POST['storeKeyword']);
			$data['defaultDiscount']    = Helper::getPostField($_POST['defaultDiscount']);
			$data['category']           = Helper::getPostField($_POST['category'], 'All');
		}

		if ($step == 3) {
			$data['theme']              = Helper::getPostField($_POST['theme']);
			$data['settingsSaved']      = 1;
		}

		// validation
		if ($data && !array_search('', $data)!==false) {
			// save data
			try {
				foreach ($data as $key => $value) {
					Helper::saveOnOptionTable('bbilas_'.$key, $value);
				}
				$response['status']     = 200;
				$response['message']    = 'Successfully saved.';
			} catch (Exception $exception) {
				// saving error
				$response['status']     = 402;
				$response['message']    = 'Something went wrong.';
			}
		} else {
			// All fields are not present
			$response['status']         = 401;
			$response['message']        = 'All fields are required.';
		}

		// response
		wp_die(json_encode($response));
	}

	/**
	 * Save theme
	 *
	 * @return json response
	 */
	function bbilas_save_settings() {
		// posted data
		$data['theme']              = Helper::getPostField($_POST['theme']);
		$data['detailsOpenStyle']   = Helper::getPostField($_POST['detailsOpenStyle']);
		$data['bannerImage']        = Helper::getPostField($_POST['bannerImage']);
		$data['bannerVisibility']   = Helper::getPostField($_POST['bannerVisibility'], 0);

		// validation
		if ($data && !array_search('', $data)!==false) {
			// save data
			try {
				foreach ($data as $key => $value) {
					Helper::saveOnOptionTable(AS_OPTION_PREFIX . $key, $value);
				}
				$response['status']     = 200;
				$response['message']    = 'Successfully saved.';
			} catch (Exception $exception) {
				// saving error
				$response['status']     = 402;
				$response['message']    = 'Something went wrong.';
			}
		} else {
			// All fields are not present
			$response['status']         = 401;
			$response['message']        = 'All fields are required.';
		}

		// response
		wp_die(json_encode($response));
	}

	function bbilas_loadSubCategories() {
		$parent = isset($_POST['parent']) && !empty(trim($_POST['parent'])) ? (int) $_POST['parent'] : false;
		$accessKey = get_option('bbilas_accessKey');
		$secretKey = get_option('bbilas_secretKey');
		$associate = get_option('bbilas_associate');

		if ($accessKey && $secretKey && $associate && $parent && $parent != 'All') {
			$AMAZON = new AmazonCats($accessKey, $secretKey, $associate);
			$response['status'] = 200;
			$response['value'] = json_encode($AMAZON->getSubCategories($parent));
		} else {
			$response['status'] = 401;
			$response['message'] = 'No parent category selected.';
		}

		echo json_encode($response);
		wp_die();
	}

	function bbilas_loadMoreProducts() {
		$args = [];
		$args['SearchIndex'] = isset($_POST['SearchIndex']) ? $_POST['SearchIndex'] : 'All';
		$args['Keywords'] = isset($_POST['Keywords']) ? $_POST['Keywords'] : '';
		if ((int) $args['Keywords']) {
			$args['BrowseNode'] = (int) $args['Keywords'];
			unset($args['Keywords']);
		}
		//$args['ItemPage'] = isset($_POST['ItemPage']) ? $_POST['ItemPage'] : 2; // $args['ItemPage'] = 9;
		$args['ItemPage'] = 1; // $args['ItemPage'] = 9;
		$args['MinPercentageOff'] = isset($_POST['MinPercentageOff']) ? $_POST['MinPercentageOff'] : 0;

		//echo " == BrowseNode : 166764011 === SearchIndex : Baby<br> ".json_encode($args); wp_die();
		if ($args['SearchIndex']) {
			$AMAZON_PRODUCT = new AmazonSearch(AS_ACCESS_KEY, AS_SECRET_KEY, AS_ASSOCIATE);
			echo $AMAZON_PRODUCT->loadMoreProducts($args);
		}
		wp_die();
	}

	function bbilas_searchProduct(){
		$data = [];
		$args = [];
		$args['SearchIndex'] = isset($_POST['SearchIndex']) ? $_POST['SearchIndex'] : 'All';
		$args['Keywords'] = isset($_POST['Keywords']) ? $_POST['Keywords'] : 'all';
		if  ( (int) $args['Keywords'] ) {
			$args['BrowseNode'] = $args['Keywords'];
			unset($args['Keywords']);
		}
		$args['MinPercentageOff'] = isset($_POST['MinPercentageOff']) ? $_POST['MinPercentageOff'] : '0';

		$args['ItemPage'] = 1; // load first page
		if ($args['SearchIndex']) {
			$AMAZON_PRODUCT = new AmazonSearch(AS_ACCESS_KEY, AS_SECRET_KEY, AS_ASSOCIATE);
			$data['products'] = $AMAZON_PRODUCT->loadMoreProducts($args);
			// if (!$data['products']) { $data['products'] = '<br><h1 class="text-center text-danger"> Nothing found </h1>'; }
			$data['SearchIndex'] = $args['SearchIndex'];
			if (isset($args['Keywords'])) $data['Keywords'] = $args['Keywords'];
			else $data['Keywords'] = $args['BrowseNode'];
			$data['MinPercentageOff'] = $args['MinPercentageOff'];
			$data['maxPages'] = $AMAZON_PRODUCT->get_total_pages();

			echo json_encode($data);
		} else { echo "name empty"; }

		wp_die();
	}

	function bbilas_addItemToCart() {
		$item = isset($_POST['item']) && !empty(trim($_POST['item'])) ? $_POST['item'] : '';
		$total = isset($_POST['total']) && !empty(trim($_POST['total'])) ? $_POST['total'] : 1;
		if (!session_id()) session_start();
		// unset($_SESSION['products']); // Reset
		$item = explode('_#_', $item);
		if (!isset($_SESSION['products']['TotalItems'])) $_SESSION['products']['TotalItems'] = 0;

		if (in_array($item[0], $_SESSION['products'][$item[0]])) {
			$_SESSION['products'][$item[0]]['Total'] = $_SESSION['products'][$item[0]]['Total'] + $total;
			$_SESSION['products']['TotalItems'] = $_SESSION['products']['TotalItems'] + $total;
		} else {
			$_SESSION['products']['TotalItems'] = $_SESSION['products']['TotalItems'] + $total;
			$_SESSION['products'][$item[0]]['Total'] = 1;
			$_SESSION['products'][$item[0]]['Id'] = $item[0];
			$_SESSION['products'][$item[0]]['Title'] = $item[1];
			$_SESSION['products'][$item[0]]['Image'] = $item[2];
			$_SESSION['products'][$item[0]]['Price'] = $item[3];
		}
		echo json_encode($_SESSION['products']);
		wp_die();
	}

	function bbilas_showCartModal() {
		if (!session_id()) @session_start();
		$html = '';
		$cartItems = [];
		 //unset($_SESSION['products']);
		if ($_SESSION['products']) {
			$products = $_SESSION['products'];
			unset($products['TotalItems']);
			if ($products) {
				$cartTotalPrice = 0;
				$html .= '<div class="table-responsive">';
				$html .= '<table class="table" id="cart_table">';
				// Table head
				$html .= '<thead>';
				$html .= '<tr>';
				$html .= '<th></th>';
				$html .= '<th class="w40">Name</th>';
				$html .= '<th class="text-center w10">Price</th>';
				$html .= '<th class="text-center w10">Qty</th>';
				$html .= '<th class="text-center w10">SubTotal</th>';
				$html .= '<th class="w10"></th>';
				$html .= '</tr>';
				$html .= '</thead>';
				// Table body
				$html .= '<tbody>';
				foreach ($products as $product) {
					$html .= '<tr id="'. $product['Id'] .'" class="cartItemContainer">';
					$html .= '<td> <img class="cartPopUpImage" style="width:auto;height:50px;" src="'. stripcslashes($product['Image']) .'"> </td>';
					$html .= '<td>'. stripcslashes($product['Title']) .'</td>';
					//$html .= '<td>'. json_encode($product) .'</td>';
					$html .= '<td class="text-center cartItemPrice"><b>$<span>'. $product['Price'] .'</span></b></td>';

					$html .= '<td class="text-center">';
					$html .= '<div class="product_add cartProductNumber">';
					$html .= '<div class="btn-minus cartMinus"><span class="glyphicon glyphicon-minus"></span></div>';
					$html .= '<input class="cartProductCount" value="'. $product['Total'] .'" disabled>';
					$html .= '<div class="btn-plus cartPlus"><span class="glyphicon glyphicon-plus"></span></div>';
					$html .= '</div>';
					$html .= '</td>';

					$subTotal = $product['Price'] * $product['Total'];
					$cartTotalPrice += $subTotal;
					$html .= '<td class="text-center cartSubTotalPrice"><b>$<span>'. $subTotal .'</span></b></td>';
					$html .= '<td class="text-center"> <button class="btn remove_cart_item" item="'. $product['Id'] .'">Remove</button> </td>';
					$html .= '</tr>';
				}
				$html .= '<tr>';
				$html .= '<td></td>';
				$html .= '<td colspan="3"><b>Total</b></td>';
				$html .= '<td class="text-center cartTotalPrice"><b>$<span>'. $cartTotalPrice .'</span></b></td>';
				$html .= '<td></td>';
				$html .= '</tr>';
				$html .= '<tbody>';

				$html .= '</table>';
				$html .= '</div>';
			} else {
				$html .= '<h4 class="text-center text-danger">Cart is empty</h4>';
			}
		} else { $html .= '<h4 class="text-center text-danger">Cart is empty</h4>';}
		echo $html;
		wp_die();
	}
	function bbilas_increaseCartItems() {
		$item = isset($_POST['item']) && !empty(trim($_POST['item'])) ? $_POST['item'] : '';
		if (!session_id()) @session_start();
		$_SESSION['products']['TotalItems'] += 1;
		$_SESSION['products'][$item]['Total'] += 1;
		echo $_SESSION['products']['TotalItems'];
		wp_die();
	}

	function bbilas_decreaseCartItems() {
		$item = isset($_POST['item']) && !empty(trim($_POST['item'])) ? $_POST['item'] : '';
		if (!session_id()) @session_start();
		$_SESSION['products']['TotalItems'] -= 1;
		$_SESSION['products'][$item]['Total'] -= 1;
		echo $_SESSION['products']['TotalItems'];
		wp_die();
	}

	function bbilas_removeItemRowFromCart() {
		$item = isset($_POST['item']) && !empty(trim($_POST['item'])) ? $_POST['item'] : '';
		if (!session_id()) @session_start();
		$_SESSION['products']['TotalItems'] = $_SESSION['products']['TotalItems'] - $_SESSION['products'][$item]['Total'];
		unset($_SESSION['products'][$item]);
		echo $_SESSION['products']['TotalItems'];
		wp_die();
	}

	function bbilas_orderOnAmazon() {
		if (!session_id()) session_start();
		unset($_SESSION['products']); // Reset
		$params = [];
		$counter = 1;

		$items = isset($_POST['items']) && !empty(trim($_POST['items'])) ? $_POST['items'] : '';

		$items = explode('_#_', $items);
		if ($items) {
			foreach ($items as $item) {
				$item = explode(':', $item);
				if ($item) {
					$params['Item.'. $counter .'.ASIN'] = $item[0];
					$params['Item.'. $counter .'.Quantity'] = $item[1];
					$counter++;
				}
			}
		}

		$amazonCart = new AmazonCart(AS_ACCESS_KEY, AS_SECRET_KEY, AS_ASSOCIATE);
		$createCartRes = $amazonCart->createCart($params);
		echo $createCartRes['PurchaseURL'];
		wp_die();
	}
}
new amazonAjax();