<?php 
/**
* Amazon product api base class
*/
class Amazon {
	public $locales = ['co.uk', 'com', 'ca', 'com.br', 'de', 'es', 'fr', 'in', 'it', 'co.jp', 'com.mx'];
	public $accessKey;
	public $serectKey;
	public $associateTag;

	/* ====================================================================
	** ================== Adding Items to a Cart ==========================
	** ====================================================================
	*
	Often a customer, after creating a shopping cart, wants to keep shopping and add additional items to an existing shopping cart. You can facilitate this activity using the Product Advertising API operations CartAdd and CartModify.

	If the item being added is already in the cart, you have to use the CartModify operation to change the quantity of the items already in the cart. You cannot use CartAdd to add items that are already in a cart. In the following example, the quantity of the specified item is changed to 10. 
	**
	** http://docs.aws.amazon.com/AWSECommerceService/latest/DG/AddingItemstoaCart.html
	*/

	/* ====================================================================
	** ========================= Operations ===============================
	** ====================================================================
	**
	** The following operations are available in the Product Advertising API. 
	**
	** http://docs.aws.amazon.com/AWSECommerceService/latest/DG/CHAP_OperationListAlphabetical.html
	*/
	public $Operation = 'ItemSearch';

	/* ====================================================================
	** ==================== Request Parameters ============================
	** ====================================================================
	**
	** The following are common parameters used with ItemSearch. 
	**
	** http://docs.aws.amazon.com/AWSECommerceService/latest/DG/ItemSearch.html 
	*/
	public $SearchIndex;
	public $Keywords;
	public $args = [];

	/* ====================================================================
	** ======================= Response Groups ============================
	** ====================================================================
	*
	** Response groups help filter the product information you want returned. Each operation can only ** use some of the available response groups. Each section includes the following:
	**
	** http://docs.aws.amazon.com/AWSECommerceService/latest/DG/CHAP_ResponseGroupsList.html
	**
	** The following table describes the elements returned by "ItemAttributes".
	** https://docs.aws.amazon.com/AWSECommerceService/latest/DG/RG_ItemAttributes.html
	*/
	public $ResponseGroup = 'ItemAttributes,Offers,Images,Tracks,BrowseNodes';

	public $MinPercentageOff;

	function __construct($access,$serect,$associate) {
		$this->accessKey = $access;
		$this->serectKey = $serect;
		$this->associateTag = $associate;

		$this->MinPercentageOff = AS_OFFER;
		$this->args = ['SearchIndex' => AS_CATEGORY, 'Keywords' => AS_KEYWORD];

		// echo $this->render();
	}

	protected function sign($url, $params) {
	    $parsed_url = parse_url($url);
	    $query = $this->http_build_query_rfc3986($params);

	    $request = array(
	        'GET',
	        $parsed_url['host'],
	        $parsed_url['path'],
	        $query
	    );
	    $signature = base64_encode(hash_hmac('sha256', implode("\n", $request), serectKey, true));
	    return $signature;
	}

	/* ====================================================================
	** ==================== Response Elements ============================
	** ====================================================================
	*
	** This chapter provides a description of all response elements. In the Ancestry paragraphs, the 
	** elements on the left side of a slash mark are the parents of the elements on the right side of 
	** the slash mark.
	** 
	** http://docs.aws.amazon.com/AWSECommerceService/latest/DG/CHAP_response_elements.html 
	*/
	protected function requestAPI($params=[]) {
	    $requestURI = 'http://webservices.amazon.com/onca/xml?';

	    $defaults = array(
	        'Service' => 'AWSECommerceService',
	        'AWSAccessKeyId' => $this->accessKey,
	        'AssociateTag' => $this->associateTag,
	        'Timestamp' => gmdate('Y-m-d\TH:i:s\Z'),
	        'Version' => '2013-08-01',

	        'Operation' => $this->Operation,
	        'ResponseGroup' => $this->ResponseGroup,
	        'MinPercentageOff' => $this->MinPercentageOff
	    );

	    $params = array_merge($defaults, $params);
	    $params['Signature'] = $this->sign($requestURI, $params);

	    $url = $requestURI . $this->http_build_query_rfc3986($params);

	    $result = $this->request($url, true);
	    return $result;
	}

	protected function http_build_query_rfc3986($params) {
	    ksort($params);
	    $query = http_build_query($params);
	    $query = strtr($query, array('%7E' => '~', '+' => '%20'));
	    return $query;
	}

	protected function request($url, $force = false, $opts = array()) {
	    global $http_response_header;
	    $headers = array(
	        'http' => array(
	            'method' => 'GET',
	            'user_agent' => "Mozilla/5.0 (X11; Linux i686 on x86_64; rv:5.0) Gecko/20100101 Firefox/5.0",
	            'timeout' => 60.0,
	            'ignore_errors' => false,
	        )
	    );

	    $context = stream_context_create(array_merge($headers, $opts));
	    $result = @file_get_contents($url, false, $context);

	    if($force || strpos($http_response_header[0], '200') !== false) {
	        return $result;
	    }
	    return false;
	}
}