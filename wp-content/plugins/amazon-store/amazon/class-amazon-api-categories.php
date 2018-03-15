<?php 
/**
* Amazon categories
*/
class AmazonCats extends Amazon {
	public $parsed_xml;

	function __construct($accessKey,$serectKey,$associateTag) {
		parent::__construct($accessKey,$serectKey,$associateTag);
	}
    protected function requestAPI($params=[]) {
        $requestURI = 'http://webservices.amazon.com/onca/xml?';

        $defaults = array(
            'Service' => 'AWSECommerceService',
            'AWSAccessKeyId' => $this->accessKey,
            'AssociateTag' => $this->associateTag,
            'Timestamp' => gmdate('Y-m-d\TH:i:s\Z'),
            'Version' => '2013-08-01',
            'Operation' => $this->Operation
        );

        $params = array_merge($defaults, $params);
        $params['Signature'] = $this->sign($requestURI, $params);

        $url = $requestURI . $this->http_build_query_rfc3986($params);

        $result = $this->request($url, true);
        return $result;
    }

    public function getCategories($local='usa') {
        switch ($local) {
            case 'uk': {
                $rootCategories = [
                    'All' => '',
                    'Appliances' => 2619526011,
                    'ArtsAndCrafts' => 2617942011,
                    'Baby' => 165797011,
                    'Beauty' => 11055981,
                    'Blended' => 11055981,
                    'Books' => 1000,
                    'Collectibles' => 4991426011,
                    'Electronics' => 493964,
                    'Fashion' => 7141124011,
                    'FashionBaby' => 7147444011,
                    'FashionBoys' => 7147443011,
                    'FashionGirls' => 7147442011,
                    'FashionMen' => 7147441011,
                    'FashionWomen' => 7147440011,
                    'GiftCards' => 2864120011,
                    'Grocery' => 16310211,
                    'Handmade' => 11260433011,
                    'HealthPersonalCare' => 3760931,
                    'HomeGarden' => 1063498,
                    'Industrial' => 16310161,
                    'KindleStore' => 133141011,
                    'LawnAndGarden' => 3238155011,
                    'Luggage' => 9479199011,
                    'Magazines' => 599872,
                    'Marketplace' => 599872,
                    'MobileApps' => 2350150011,
                    'Movies' => 2625374011,
                    'MP3Downloads' => 624868011,
                    'Music' => 301668,
                    'MusicalInstruments' => 11965861,
                    'OfficeProducts' => 1084128,
                    'PCHardware' => 541966,
                    'PetSupplies' => 2619534011,
                    'Software' => 409488,
                    'SportingGoods' => 3375301,
                    'Tools' => 468240,
                    'Toys' => 165795011,
                    'UnboxVideo' => 2858778011,
                    'Vehicles' => 10677470011,
                    'VideoGames' => 11846801,
                    'Wine' => 2983386011,
                    'Wireless' => 2335753011
                ];
                break;
            }
            case 'usa': {
                $rootCategories = [
                    'All' => '',
                    'Appliances' => 2619526011,
                    'ArtsAndCrafts' => 2617942011,
                    'Baby' => 165797011,
                    'Beauty' => 11055981,
                    'Blended' => 11055981,
                    'Books' => 1000,
                    'Collectibles' => 4991426011,
                    'Electronics' => 493964,
                    'Fashion' => 7141124011,
                    'FashionBaby' => 7147444011,
                    'FashionBoys' => 7147443011,
                    'FashionGirls' => 7147442011,
                    'FashionMen' => 7147441011,
                    'FashionWomen' => 7147440011,
                    'GiftCards' => 2864120011,
                    'Grocery' => 16310211,
                    'Handmade' => 11260433011,
                    'HealthPersonalCare' => 3760931,
                    'HomeGarden' => 1063498,
                    'Industrial' => 16310161,
                    'KindleStore' => 133141011,
                    'LawnAndGarden' => 3238155011,
                    'Luggage' => 9479199011,
                    'Magazines' => 599872,
                    'Marketplace' => 599872,
                    'MobileApps' => 2350150011,
                    'Movies' => 2625374011,
                    'MP3Downloads' => 624868011,
                    'Music' => 301668,
                    'MusicalInstruments' => 11965861,
                    'OfficeProducts' => 1084128,
                    'PCHardware' => 541966,
                    'PetSupplies' => 2619534011,
                    'Software' => 409488,
                    'SportingGoods' => 3375301,
                    'Tools' => 468240,
                    'Toys' => 165795011,
                    'UnboxVideo' => 2858778011,
                    'Vehicles' => 10677470011,
                    'VideoGames' => 11846801,
                    'Wine' => 2983386011,
                    'Wireless' => 2335753011
                ];
                break;
            }
            case 'japan': {
                $rootCategories = [
                    'All' => '',
                    'Appliances' => 2619526011,
                    'ArtsAndCrafts' => 2617942011,
                    'Baby' => 165797011,
                    'Beauty' => 11055981,
                    'Blended' => 11055981,
                    'Books' => 1000,
                    'Collectibles' => 4991426011,
                    'Electronics' => 493964,
                    'Fashion' => 7141124011,
                    'FashionBaby' => 7147444011,
                    'FashionBoys' => 7147443011,
                    'FashionGirls' => 7147442011,
                    'FashionMen' => 7147441011,
                    'FashionWomen' => 7147440011,
                    'GiftCards' => 2864120011,
                    'Grocery' => 16310211,
                    'Handmade' => 11260433011,
                    'HealthPersonalCare' => 3760931,
                    'HomeGarden' => 1063498,
                    'Industrial' => 16310161,
                    'KindleStore' => 133141011,
                    'LawnAndGarden' => 3238155011,
                    'Luggage' => 9479199011,
                    'Magazines' => 599872,
                    'Marketplace' => 599872,
                    'MobileApps' => 2350150011,
                    'Movies' => 2625374011,
                    'MP3Downloads' => 624868011,
                    'Music' => 301668,
                    'MusicalInstruments' => 11965861,
                    'OfficeProducts' => 1084128,
                    'PCHardware' => 541966,
                    'PetSupplies' => 2619534011,
                    'Software' => 409488,
                    'SportingGoods' => 3375301,
                    'Tools' => 468240,
                    'Toys' => 165795011,
                    'UnboxVideo' => 2858778011,
                    'Vehicles' => 10677470011,
                    'VideoGames' => 11846801,
                    'Wine' => 2983386011,
                    'Wireless' => 2335753011
                ];
                break;
            }
            case 'india': {
                $rootCategories = [
                    'All' => '',
                    'Appliances' => 2619526011,
                    'ArtsAndCrafts' => 2617942011,
                    'Baby' => 165797011,
                    'Beauty' => 11055981,
                    'Blended' => 11055981,
                    'Books' => 1000,
                    'Collectibles' => 4991426011,
                    'Electronics' => 493964,
                    'Fashion' => 7141124011,
                    'FashionBaby' => 7147444011,
                    'FashionBoys' => 7147443011,
                    'FashionGirls' => 7147442011,
                    'FashionMen' => 7147441011,
                    'FashionWomen' => 7147440011,
                    'GiftCards' => 2864120011,
                    'Grocery' => 16310211,
                    'Handmade' => 11260433011,
                    'HealthPersonalCare' => 3760931,
                    'HomeGarden' => 1063498,
                    'Industrial' => 16310161,
                    'KindleStore' => 133141011,
                    'LawnAndGarden' => 3238155011,
                    'Luggage' => 9479199011,
                    'Magazines' => 599872,
                    'Marketplace' => 599872,
                    'MobileApps' => 2350150011,
                    'Movies' => 2625374011,
                    'MP3Downloads' => 624868011,
                    'Music' => 301668,
                    'MusicalInstruments' => 11965861,
                    'OfficeProducts' => 1084128,
                    'PCHardware' => 541966,
                    'PetSupplies' => 2619534011,
                    'Software' => 409488,
                    'SportingGoods' => 3375301,
                    'Tools' => 468240,
                    'Toys' => 165795011,
                    'UnboxVideo' => 2858778011,
                    'Vehicles' => 10677470011,
                    'VideoGames' => 11846801,
                    'Wine' => 2983386011,
                    'Wireless' => 2335753011
                ];
                break;
            }
            default : {
                $rootCategories = [
                    'All' => '',
                    'Apparel' => 0,
                    'Appliances' => 2619526011,
                    'ArtsAndCrafts' => 2617942011,
                    'Automotive' => 0,
                    'Baby' => 165797011,
                    'Beauty' => 11055981,
                    'Blended' => 11055981,
                    'Books' => 1000,
                    'Classical' => 0,
                    'Collectibles' => 4991426011,
                    'DVD' => 0,
                    'DigitalMusic' => 0,
                    'Electronics' => 493964,
                    'Fashion' => 7141124011,
                    'FashionBaby' => 7147444011,
                    'FashionBoys' => 7147443011,
                    'FashionGirls' => 7147442011,
                    'FashionMen' => 7147441011,
                    'FashionWomen' => 7147440011,
                    'GiftCards' => 2864120011,
                    'GourmetFood' => 0,
                    'Grocery' => 16310211,
                    'Handmade' => 11260433011,
                    'HealthPersonalCare' => 3760931,
                    'HomeAndBusinessServices' => 0,
                    'HomeGarden' => 1063498,
                    'Industrial' => 16310161,
                    'Jewelry' => 0,
                    'KindleStore' => 133141011,
                    'Kitchen' => 0,
                    'LawnAndGarden' => 3238155011,
                    'Luggage' => 9479199011,
                    'Magazines' => 599872,
                    'Marketplace' => 599872,
                    'Miscellaneous' => 0,
                    'MobileApps' => 2350150011,
                    'Movies' => 2625374011,
                    'MP3Downloads' => 624868011,
                    'Music' => 301668,
                    'MusicTracks' => 0,
                    'MusicalInstruments' => 11965861,
                    'OfficeProducts' => 1084128,
                    'OutdoorLiving' => 0,
                    'Pantry' => 0,
                    'PCHardware' => 541966,
                    'PetSupplies' => 2619534011,
                    'Photo' => 0,
                    'Shoes' => 0,
                    'Software' => 409488,
                    'SportingGoods' => 3375301,
                    'Tools' => 468240,
                    'Toys' => 165795011,
                    'UnboxVideo' => 2858778011,
                    'Vehicles' => 10677470011,
                    'VHS' => 0,
                    'Video' => 0,
                    'VideoGames' => 11846801,
                    'Watches' => 0,
                    'Wine' => 2983386011,
                    'Wireless' => 2335753011,
                    'WirelessAccessories' => 0
                ];
                $rootCategories = 'invalid local';
                break;
            }
        }

        //$rootCategories = $usRootCats;
        return $rootCategories;
    }

    // get all categories
    public function getSubCategories($nodeID) {
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
            return @array_merge($cats, $this->parsed_xml['BrowseNodes']['BrowseNode']['Children']['BrowseNode']);
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