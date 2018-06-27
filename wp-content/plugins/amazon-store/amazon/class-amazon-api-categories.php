<?php 
/**
* Amazon categories
*/
class AmazonCats extends Amazon {
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
			'Operation' => $this->Operation
		);

		$params = array_merge($defaults, $params);
		$params['Signature'] = $this->sign($requestURI, $params);

		$url = $requestURI . $this->http_build_query_rfc3986($params);

		$result = $this->request($url, true);
		return $result;
	}

	public function getCategories($local='usa') {
		return getCategoriesByLocal($local);
	}

	/**
	 * get sub categories for a parent category
	 *
	 * @param int $nodeID
	 * @param bool $includeAllCats
	 *
	 * @return array|bool
	 */
	public function getSubCategories($nodeID, $includeAllCats=true) {
		$args = [
			'Operation' => 'BrowseNodeLookup',
			'BrowseNodeId' => $nodeID,
			'ResponseGroup' => ''
		];
		$results = $this->requestAPI($args);
		$this->parsed_xml = json_decode(json_encode((array) simplexml_load_string($results)), 1);

		if (@$this->parsed_xml['BrowseNodes']['Request']['IsValid']) {
			$browserNodes = $this->parsed_xml['BrowseNodes']['BrowseNode']['Children']['BrowseNode'];
			if ($browserNodes) {
				if ($includeAllCats) {
					$cats[] = [
						'BrowseNodeId' => $this->parsed_xml['BrowseNodes']['Request']['BrowseNodeLookupRequest']['BrowseNodeId'],
						'Name' => 'All'
					];
				} else { $cats = []; }


				// check if single sub category found
				if (count($browserNodes) == count($browserNodes, COUNT_RECURSIVE))  $subCategories[] = $browserNodes;
				else $subCategories = $browserNodes;

				return @array_merge($cats, $subCategories);
			} else return false;
		} else return false;
	}

	// get all sub categories
	public function getAllSubCategories($nodeID) {
		$args = [
			'Operation' => 'BrowseNodeLookup',
			'BrowseNodeId' => $nodeID,
			'ResponseGroup' => ''
		];
		$results = $this->requestAPI($args);
		$this->parsed_xml = json_decode(json_encode((array) simplexml_load_string($results)), 1);

		if (@$this->parsed_xml['BrowseNodes']['Request']['IsValid']) {
			$cats[] = [
				'BrowseNodeId' => $this->parsed_xml['BrowseNodes']['Request']['BrowseNodeLookupRequest']['BrowseNodeId'],
				'Name' => 'All'
			];
			return array_merge($cats, $this->parsed_xml['BrowseNodes']['BrowseNode']['Children']['BrowseNode']);
		} else return false;
	}
}