<?php 
/**
* Amazon search
*/
class AmazonSearch extends Amazon {
	public $parsed_xml;

	function __construct($ACCESS_KEY,$SECRET_KEY,$ASSOCIATED_TAG) {
		parent::__construct($ACCESS_KEY,$SECRET_KEY,$ASSOCIATED_TAG);
		$this->setArgsFromSession();
	}
	public function setArgsFromSession() {
		if (!session_id()) @session_start();

		if ($_SESSION['bbil_MinPercentageOff']) {
			$this->MinPercentageOff = $_SESSION['bbil_MinPercentageOff'];
			unset($_SESSION['bbil_MinPercentageOff']);
		} else { $this->MinPercentageOff = AS_OFFER; }

		if ($_SESSION['bbil_Keywords']) {
			if ((int) $_SESSION['bbil_Keywords']) $this->args['BrowseNode'] = $_SESSION['bbil_Keywords'];
			else $this->args['Keywords'] = $_SESSION['bbil_Keywords'];
			unset($_SESSION['bbil_Keywords']);
		} else { $this->args['Keywords'] = AS_KEYWORD; }

		if ($_SESSION['bbil_SearchIndex']) {
			$this->args['SearchIndex'] = $_SESSION['bbil_SearchIndex'];
			unset($_SESSION['bbil_SearchIndex']);
		} else {
			if (AS_CATEGORY == 'All') { $lastKey = 'All'; }
			else if (AS_CATEGORY) {
				$cat = explode(':', stripcslashes(AS_CATEGORY));
				$lastKey = str_replace('"', '', $cat[0]);
			} else { $lastKey = 'All'; }
			$this->args['SearchIndex'] = $lastKey;
		}
	}
	public function get_search_form($value='') {
		include 'search-form.php';
	}
	public function getProductsAttributes() {
	    $items = [];
	    $counter = 0;
	    if ($this->parsed_xml['Items']['Item']) {
		    foreach ($this->parsed_xml['Items']['Item'] as $value) {
		        if ($counter == 0) $data['product'] = $value;
		        $items[$counter]['ASIN'] 		= @$value['ASIN'];
		        $items[$counter]['Image'] 		= @$value['MediumImage']['URL']; // LargeImage
		        $items[$counter]['Title'] 		= @$value['ItemAttributes']['Title'];
		        $items[$counter]['Artist'] 		= @$value['ItemAttributes']['Artist'];
		        $items[$counter]['Binding'] 	= @$value['ItemAttributes']['Binding'];
		        $items[$counter]['Brand'] 		= @$value['ItemAttributes']['Brand'];
		        $items[$counter]['Studio'] 		= @$value['ItemAttributes']['Studio'];
		        $items[$counter]['OldPrice'] 	= @$value['ItemAttributes']['ListPrice']['FormattedPrice'];
		        $items[$counter]['Language'] 	= @$value['ItemAttributes']['Languages']['Language'][0]['Name'];
		        $items[$counter]['NewPrice'] 	= @$value['OfferSummary']['LowestNewPrice']['FormattedPrice'];
		        $items[$counter]['NewPrice'] 	= @$value['OfferSummary']['LowestNewPrice']['FormattedPrice'];
		        $counter++;
		    }
		    $data['items'] = $items;
		    // echo "<pre>". print_r($items, true) ."</pre><hr><hr>";
		    return $data;
	    }
	    return false;
	}
	/**
	 * Get attributes of single product
	 *
	 * @return array
	 */
	public function getProductArray() {
	    $items = [];
	    $counter = 0;
	    $item = $this->parsed_xml['Items']['Item'];
	    
	    $items[$counter]['ASIN'] 		= $item['ASIN'];
	    $items[$counter]['Image'] 		= @$item['LargeImage']['URL'];
	    $items[$counter]['Title'] 		= @$item['ItemAttributes']['Title'];
	    $items[$counter]['Binding'] 	= @$item['ItemAttributes']['Binding'];
	    $items[$counter]['Studio'] 		= @$item['ItemAttributes']['Studio'];
	    $items[$counter]['OldPrice'] 	= @$item['ItemAttributes']['ListPrice']['FormattedPrice'];
	    $items[$counter]['Language'] 	= @$item['ItemAttributes']['Language']['Name'];
	    $items[$counter]['NewPrice'] 	= @$item['OfferSummary']['LowestNewPrice']['FormattedPrice'];
	    // echo "<pre>". print_r($items, true) ."</pre><hr><hr>";
	    
	    $data['items'] = $items;
	    return $data;
	}

	// Render data
	public function getProductHtmlOld($products='') {
		$html= '';
	    if ($products) {
	        foreach ($products as $product) {
	            $html .= '<div id="'. $product['ASIN'] .'" class="grid-item">
			            <div class="product-item">
			                <div class="author_logo"><img class="img-responsive" src="'.plugin_dir_url(__FILE__).'../../public/images/amazon.png">
			                </div>

			                <div class="product-img"> <img class="img-responsive" src="'. $product['Image'] .'"> </div>

			                <div class="product-info">
			                    <div class="product-description"> 
			                    <p><a href="'. site_url('/single-product/?id='.$product['ASIN']) .'">'. $product['Title'] .'</a></p> </div>';
			                    $html .= '<div class="product-price">
			                        <div> <p><b>List Price</b></p> <p class="line-through">'. $product['OldPrice'] .'</p> </div>
			                        <div> <p><b>Your Price</b></p> <p>'. $product['NewPrice'] .'</p> </div>
			                    </div>';

			                    if ($product['Binding'])  	$html .= '<p> <b>Binding: </b> <span>'. $product['Binding'] .'</span> </p>';
			                    if ($product['Studio'])  	$html .= '<p> <b>Studio: </b> <span>'. $product['Studio'] .'</span> </p>';
			                    if ($product['Brand'])  	$html .= '<p> <b>Brand: </b> <span>'. $product['Brand'] .'</span> </p>';
			                    if ($product['Language'])  	$html .= '<p> <b>Language: </b> <span>'. $product['Language'] .'</span> </p>';
			                    if ($product['Studio'])  	$html .= '<p> <b>Studio: </b> <span>'. $product['Studio'] .'</span> </p>';

			                    $html .= '<div class="cart-btn-list">
			                        <button class="btn btn-dark btn-cart">
			                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
			                            Add to cart
			                        </button>

			                        <button class="btn btn-dark">
			                            <i class="fa fa-facebook" aria-hidden="true"></i>
			                        </button>
			                        <button class="btn btn-dark">
			                            <i class="fa fa-twitter" aria-hidden="true"></i>
			                        </button>
			                        <button class="btn btn-dark">
			                            <i class="fa fa-google-plus" aria-hidden="true"></i>
			                        </button>
			                    </div>
			                </div>
			            </div>
			        </div>';
	        }
	    }
	    return $html;
	}
	public function getProductHtml($products='') {
		$html= '';
		if ($products) {
			foreach ($products as $product) {
				if (AS_SINGLE == 'popup') $detailsOpenStyle = 'href="javascript:;" data-toggle="modal" data-target="#detailsModal"';
				else $detailsOpenStyle = 'target="_blank" href="'. site_url('/single-product/?id='.$product['ASIN']) .'"';

				$item = $this->addToCartItemData($product);
				$html .= '<div id="'. $product['ASIN'] .'" class="col-lg-3 col-sm-6 col-xs-12">';
	                $html .= '<div class="product-item">';
	                    $html .= '<div class="product-img">';
							$html .= '<a '. $detailsOpenStyle .'> <div class="item-hover"><i class="fa fa-eye" aria-hidden="true"></i></div></a>';
	                        $html .= '<img class="img-responsive" src="'. $product['Image'] .'">';
	                    $html .= '</div>';

	                    $html .= '<div class="product-info">';
							$html .= '<div class="product-description"> <a '. $detailsOpenStyle .'>'. $product['Title'] .'</a></div>';
							$html .= '<div class="product-price"><p><span class="line-through">'. $product['OldPrice'] .'</span><span class="actual-rate">'. $product['NewPrice'] .'</span></p></div>';

	                        $html .= '<div class="rateYo"></div>';

	                        $html .= '<div class="cart-btn-list"><button class="btn btn-dark btn-cart addToCart" item="'. $item .'"><img src="'. AS_THEME_DIR .'/images/icons/shopping-cart-empty-side-view.png"></button></div>';
	                    $html .= '</div>';
	                $html .= '</div>';
	            $html .= '</div>';
	        }
	    }
	    return $html;
	}
	public function addToCartItemData($product) {
		$shareTitle = str_replace ( "\"", "&quot;", $product['Title']);
		$shareImage = str_replace ( "\"", "&quot;", $product['Image']);
		return $product['ASIN'].'_#_'.$shareTitle.'_#_'.$shareImage.'_#_'.ltrim($product['NewPrice'], '$');
	}
	public function getProducts($args, $is_single=false) {
		$results = $this->requestAPI($args);
		$this->parsed_xml = json_decode(json_encode((array) simplexml_load_string($results)), 1);
		if ( $is_single ) { return $this->parsed_xml; }
		else { $attributes = $this->getProductsAttributes(); }
		return $this->getProductHtml($attributes['items']);
	}
	public function render() {
		$html= '';
		$productItems =  $this->getProducts($this->args);

	    if ($productItems) {
		    $html .= '<div id="productWrapper" class="row" data_SearchIndex="All" data_MinPercentageOff="'. $this->MinPercentageOff .'" data_Keywords="'. $this->args['Keywords'] .'" data_maxPages="'. $this->get_total_pages() .'" data_ItemPage="2">';
		        $html .= $productItems;
		    $html .= '</div>';
		    $html .= $this->getLoader();
		}

		echo $html;
	}
	public function loadMoreProducts($args) {
		$this->args = $args;
		return $this->getProducts($this->args);
	}

	/* ====================================================================
	** ================== ItemLookup (single item) ========================
	** ====================================================================
	**
	** Given an Item identifier, the ItemLookup operation returns some or all of the item attributes, depending on the response group 
	** specified in the request. By default, ItemLookup returns an item’s ASIN, Manufacturer, ProductGroup, and Title of the item. 
	**
	** To look up more than one item at a time, separate the item identifiers by commas.
	**
	** http://docs.aws.amazon.com/AWSECommerceService/latest/DG/ItemLookup.html
	*/
	public function get_single_product($ItemId, $IdType='ASIN') {
		$this->args = [
			'Operation' => 'ItemLookup', 
			'ItemId' => $ItemId, 
			'IdType' => $IdType, 
			'Condition' => 'All'
		];
		return $this->getProducts($this->args, true);
	}

	public function getLoader() {
		$html = '';
		$html .= '<div class="clearfix" style="clear:both;"></div>';
		$html .= '<div class="spinnerWrapper hidden">';
		$html .= '<div class="spinner"> <div></div> <div></div> <div></div> <div></div> </div>';
		$html .= '</div>';

		return $html;
	}
	public function get_total_pages() {
	    if ($this->parsed_xml) return $this->parsed_xml['Items']['TotalPages'];
	    return false;
	}
	public function get_current_page() {
	    if ($this->parsed_xml) {
	        $currentPageNumber = @$this->parsed_xml['Items']['Request']['ItemSearchRequest']['ItemPage'];
	        return $currentPageNumber ? $currentPageNumber : 1;
	    }
	    return false;
	}
	public function is_valid_request() {
	    if ($this->parsed_xml) return $this->parsed_xml['Items']['Request']['IsValid'];
	    return false;
	}
	public function getCategories() {
		$args = ['SearchIndex' => 'Book', 'Title' => 'superman'];
		$results = $this->requestAPI($args);
		$this->parsed_xml = json_decode(json_encode((array) simplexml_load_string($results)), 1);
		$this->parsed_xml = $this->parsed_xml['Items']['Request']['Errors']['Error']['Message'];
		// $replaceStr = [
		// 	'The value you specified for SearchIndex is invalid. Valid values include [' => '',
		// 	'].' => '',
		// 	"'"  => ''
		// ];
		// $this->parsed_xml = strstr($this->parsed_xml, $replaceStr);
		$replaceStr = 'The value you specified for SearchIndex is invalid. Valid values include [';
		$this->parsed_xml = str_replace($replaceStr, '', $this->parsed_xml);
		$this->parsed_xml = str_replace('].', '', $this->parsed_xml);
		$this->parsed_xml = str_replace("'", '', $this->parsed_xml);
		$this->parsed_xml = explode(',', $this->parsed_xml);

		return array_filter($this->parsed_xml);
	}
}