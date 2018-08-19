<?php
/**
 * Amazon cart
 */
class AmazonCart extends amazon {
	public $parsed_xml;
	function __construct($ACCESS_KEY,$SECRET_KEY,$ASSOCIATED_TAG) {
		parent::__construct($ACCESS_KEY,$SECRET_KEY,$ASSOCIATED_TAG);
	}
	protected function requestAPI($params=[]) {
		$requestURI = 'http://webservices.amazon.com/onca/xml?';

		$defaults = array(
			'Service' => 'AWSECommerceService',
			'AWSAccessKeyId' => $this->AWS_ACCESS_KEY,
			'AssociateTag' => $this->ASSOCIATED_TAG,
			'Timestamp' => gmdate('Y-m-d\TH:i:s\Z'),
			'Version' => '2013-08-01',

			// Configurable items
			'Operation' => 'CartCreate'
		);

		$params = array_merge($defaults, $params);
		$params['Signature'] = $this->sign($requestURI, $params);

		$url = $requestURI . $this->http_build_query_rfc3986($params);

		$result = $this->request($url, true);
		return $result;
	}
	/* ====================================================================
	** ========================= CartCreate ===============================
	** ====================================================================
	*
	** The CartCreate operation enables you to create a remote shopping cart.
	**
	** https://docs.aws.amazon.com/AWSECommerceService/latest/DG/CartCreate.html
	**
	** Params
	** ['Item.1.ASIN'=>'B004LWZWGK', 'Item.1.Quantity'=>2, 'Item.2.ASIN'=>'B00HFWETQW', 'Item.2.Quantity'=>1 ]
	*/
	public function createCart($params='') {
		$results = $this->requestAPI($params);
		$results = json_decode(json_encode((array) simplexml_load_string($results)), 1);
		if ($results['Cart']['Request']['IsValid']) {
			$data['CartId'] = $results['Cart']['CartId'];
			$data['PurchaseURL'] = $results['Cart']['PurchaseURL'];
			return $data;
		}
		return false;
	}
}