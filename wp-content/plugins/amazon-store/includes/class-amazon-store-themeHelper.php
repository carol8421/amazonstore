<?php
/*
 * Theme Helper class
 * */
class TH {
	static function getDirectoryFiles($dirUrl='') {
		$dirUrl = AS_UPLOAD_DIR;
		$files = array_map("htmlspecialchars", scandir($dirUrl));
		unset($files[0]);
		unset($files[1]);
		return $files;
	}
	static function getRlativeUrl($fullUrl) {
		return str_replace(site_url(''), '..', $fullUrl);
	}
	static function templateTitle ($template, $isPrint=true) {
		$title = str_replace('_', ' ', $template);
		if ($isPrint) echo $title;
		else return $title;
	}
	static function isValidTemplate($template) {
		$dirUrl = AS_UPLOAD_DIR .'/'. $template;
		$files = @array_map("htmlspecialchars", scandir($dirUrl));
		$files = @array_flip($files);
		if (
			isset($files['functions.php']) &&
			isset($files['search_products.php']) &&
			isset($files['single_product.php'])
		) return true;
		else return false;
	}
	static function templateAvatar($template, $isPrint=true) {
		$dirUrl = AS_UPLOAD_DIR .'/'. $template;
		$files = array_map("htmlspecialchars", scandir($dirUrl));
		$files = array_flip($files);
		if (isset($files['screenshot.jpg'])) $avatar = '<img class="img-responsive" src="'. AS_TEMPLATE_DIR .$template.'/screenshot.jpg">';
		else $avatar = '<img class="img-responsive" src="http://via.placeholder.com/223x138?text=NO IMAGE">';

		if ($isPrint) echo $avatar;
		else return $avatar;
	}
	static function templateName($template, $isPrint=true){
		$template = ucfirst(str_replace('-', ' ', $template));
		if ($isPrint) echo $template;
		else return $template;
	}
	static function headerMenu ($obj){
		if (!$obj) return false;

		$menuItems = [];
		$html = '';

		$menuItems[2619526011]  = ['Appliances', 'Appliances'];
		$menuItems[165797011]   = ['Baby', 'Baby'];
		$menuItems[7141124011]  = ['Fashion', 'Clothing, Shoes & Jewelry'];
		$menuItems[3375301]     = ['SportingGoods', 'Sports & Outdoors'];
		$menuItems[468240]      = ['Tools', 'Tools & Home Improvement'];

		$html .= '<ul class="nav navbar-nav headerTopMenu">';
		foreach ($menuItems as $key => $menuItem) {
			$subCats = self::subCategories($menuItem[0]);
			$html .= '<li class="dropdown">';
			$html .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'. $menuItem[1] .'</a>';
			$html .= '<ul class="dropdown-menu">';
			foreach ($subCats as $subCat) {
				$html .= '<li><a class="topMenuItem" nodeId="'. $subCat['BrowseNodeId'] .'" href="'. $menuItem[0] .'">'. $subCat['Name'] .'</a></li>';
			}
			//$html .= '<li>'. print_r($subCats, true) .'</li>';
			$html .= '</ul>';
			$html .= '</li>';
		}
		$html .= '</ul>';

		return $html;
	}
	static function mainMenuItems() {
		$menu = [];
		$menu['Appliances'] = 'Appliances';
		$menu['Baby'] = [
			'ApparelAndAccessories'         => 'Apparel & Accessories',
			'Toys'                          => 'Baby & Toddler Toys',
			'BabyStationery'                => 'Baby Stationery',
			'BathingAndSkinCare'            => 'Bathing & Skin Care',
			'CarSeatsAndAccessories'        => 'Car Seats & Accessories',
			'Diapering'                     => 'Diapering',
			'Feeding'                       => 'Feeding',
			'Gear'                          => 'Gear',
			'Gifts'                         => 'Gifts',
			'HealthAndBabyCare'             => 'Health & Baby Care',
			'Nursery'                       => 'Nursery',
			'PottyTraining'                 => 'Potty Training',
			'PregnancyAndMaternity'         => 'Pregnancy & Maternity',
			'Safety'                        => 'Safety',
			'StrollersAndAccessories'       => 'Strollers & Accessories',
		];
		$menu['Clothing, Shoes & Jewelry'] = [
			// 'Fashion'                    => 'Fashion',
			'FashionBaby'                   => 'Baby',
			'FashionBoys'                   => 'Boys',
			'FashionGirls'                  => 'Girls',
			'FashionMen'                    => 'Men',
			'FashionWomen'                  => 'Women',
		];
		$menu['Sports & Outdoors'] = [
			'AthleticClothing'              => 'Athletic Clothing',
			'ExerciseAndFitness'            => 'Exercise & Fitness',
			'HuntingAndFishing'             => 'Hunting & Fishing',
			'TeamSports'                    => 'Team Sports',
			'FanShop'                       => 'Fan Shop',
			'Golf'                          => 'Golf',
			'LeisureSportsAndGameRoom'      => 'Leisure Sports & Game Room',
			'SportsCollectibles'            => 'Sports Collectibles',
			'AllSportsAndFitness'           => 'All Sports & Fitness',
			'CampingAndHiking'              => 'Camping & Hiking',
			'Cycling'                       => 'Cycling',
			'OutdoorClothing'               => 'Outdoor Clothing',
			'ScootersSkateboardsAndSkates'  => 'Scooters, Skateboards & Skates',
			'WaterSports'                   => 'Water Sports',
			'WinterSports'                  => 'Winter Sports',
			'Climbing'                      => 'Climbing',
			'Accessories'                   => 'Accessories',
			'AllOutdoorRecreation'          => 'All Outdoor Recreation',
		];
		$menu['Tools & Home Improvement'] = [
			'HomeImprovement'               => 'Home Improvement',
			'PowerAndHandTools'             => 'Power & Hand Tools',
			'LampsAndLightFixtures'         => 'Lamps & Light Fixtures',
			'KitchenAndBathFixtures'        => 'Kitchen & Bath Fixtures',
			'Hardware'                      => 'Hardware',
			'SmartHome'                     => 'Smart Home',
		];
		return $menu;
	}

	static function subCategories($catName) {
		$subCategories['Appliances'] = [
			['BrowseNodeId' => 3737671, 'Name' => 'Air Conditioners' ],
			['BrowseNodeId' => 267554011, 'Name' => 'Air Purifiers' ],
			['BrowseNodeId' => 2632820011, 'Name' => 'Appliance Services' ],
			['BrowseNodeId' => 2242350011, 'Name' => 'Appliance Warranties' ],
			['BrowseNodeId' => 2686378011, 'Name' => 'Beer Keg Refrigerators' ],
			['BrowseNodeId' => 2686328011, 'Name' => 'Beverage Refrigerators' ],
			['BrowseNodeId' => 495362, 'Name' => 'Ceiling Fans & Accessories' ],
			['BrowseNodeId' => 678542011, 'Name' => 'Compact Refrigerators' ],
			['BrowseNodeId' => 3741261, 'Name' => 'Cooktops' ],
			['BrowseNodeId' => 267557011, 'Name' => 'Dehumidifiers' ],
			['BrowseNodeId' => 3741271, 'Name' => 'Dishwashers' ],
			['BrowseNodeId' => 3737601, 'Name' => 'Fans' ],
			['BrowseNodeId' => 3741331, 'Name' => 'Freezers' ],
			['BrowseNodeId' => 680343011, 'Name' => 'Garbage Disposals' ],
			['BrowseNodeId' => 267555011, 'Name' => 'Humidifiers' ],
			['BrowseNodeId' => 2399939011, 'Name' => 'Ice Makers' ],
			['BrowseNodeId' => 510240, 'Name' => 'Irons, Steamers & Accessories' ],
			['BrowseNodeId' => 289935, 'Name' => 'Microwave Ovens' ],
			['BrowseNodeId' => 3741181, 'Name' => 'Parts & Accessories' ],
			['BrowseNodeId' => 3741441, 'Name' => 'Range Hoods' ],
			['BrowseNodeId' => 3741411, 'Name' => 'Ranges' ],
			['BrowseNodeId' => 3741361, 'Name' => 'Refrigerators' ],
			['BrowseNodeId' => 289913, 'Name' => 'Small Appliances' ],
			['BrowseNodeId' => 510182, 'Name' => 'Space Heaters' ],
			['BrowseNodeId' => 3741451, 'Name' => 'Trash Compactors' ],
			['BrowseNodeId' => 510106, 'Name' => 'Vacuums & Floor Care' ],
			['BrowseNodeId' => 3741481, 'Name' => 'Wall Ovens' ],
			['BrowseNodeId' => 2399955011, 'Name' => 'Warming Drawers' ],
			['BrowseNodeId' => 2383576011, 'Name' => 'Washers & Dryers' ],
			['BrowseNodeId' => 3741521, 'Name' => 'Wine Cellars' ],
		];
		$subCategories['Baby'] = [
			['BrowseNodeId' => 7147444011, 'Name' => 'Apparel & Accessories' ],
			['BrowseNodeId' => 196601011, 'Name' => 'Baby & Toddler Toys' ],
			['BrowseNodeId' => 405369011, 'Name' => 'Baby Stationery' ],
			['BrowseNodeId' => 166736011, 'Name' => 'Bathing & Skin Care' ],
			['BrowseNodeId' => 166835011, 'Name' => 'Car Seats & Accessories' ],
			['BrowseNodeId' => 166764011, 'Name' => 'Diapering' ],
			['BrowseNodeId' => 166777011, 'Name' => 'Feeding' ],
			['BrowseNodeId' => 166828011, 'Name' => 'Gear' ],
			['BrowseNodeId' => 239226011, 'Name' => 'Gifts' ],
			['BrowseNodeId' => 166856011, 'Name' => 'Health & Baby Care' ],
			['BrowseNodeId' => 695338011, 'Name' => 'Nursery' ],
			['BrowseNodeId' => 166887011, 'Name' => 'Potty Training' ],
			['BrowseNodeId' => 166804011, 'Name' => 'Pregnancy & Maternity' ],
			['BrowseNodeId' => 166863011, 'Name' => 'Safety' ],
			['BrowseNodeId' => 8446318011, 'Name' => 'Strollers & Accessories'],
		];
		$subCategories['Fashion'] = [
			['BrowseNodeId' => 7147440011, 'Name' => 'Women' ],
			['BrowseNodeId' => 7147441011, 'Name' => 'Men' ],
			['BrowseNodeId' => 7147442011, 'Name' => 'Girls' ],
			['BrowseNodeId' => 7147443011, 'Name' => 'Boys' ],
			['BrowseNodeId' => 7147444011, 'Name' => 'Baby' ],
			['BrowseNodeId' => 7147445011, 'Name' => 'Novelty & More' ],
			['BrowseNodeId' => 9479199011, 'Name' => 'Luggage & Travel Gear' ],
			['BrowseNodeId' => 7586144011, 'Name' => 'Uniforms, Work & Safety' ],
			['BrowseNodeId' => 7586165011, 'Name' => 'Costumes & Accessories' ],
			['BrowseNodeId' => 7586146011, 'Name' => 'Shoe, Jewelry & Watch Accessories' ],
			['BrowseNodeId' => 7586166011, 'Name' => 'Traditional & Cultural Wear' ],
		];
		$subCategories['SportingGoods'] = [
			['BrowseNodeId' => 706814011, 'Name' => 'Outdoor Recreation' ],
			['BrowseNodeId' => 10971181011, 'Name' => 'Sports & Fitness' ],
			['BrowseNodeId' => 3386071, 'Name' => 'Fan Shop' ],
		];
		$subCategories['Tools'] = [
			['BrowseNodeId' => 13397451, 'Name' => 'Appliances' ],
			['BrowseNodeId' => 551240, 'Name' => 'Building Supplies' ],
			['BrowseNodeId' => 495266, 'Name' => 'Electrical' ],
			['BrowseNodeId' => 511228, 'Name' => 'Hardware' ],
			['BrowseNodeId' => 3754161, 'Name' => 'Kitchen & Bath Fixtures' ],
			['BrowseNodeId' => 322525011, 'Name' => 'Light Bulbs' ],
			['BrowseNodeId' => 495224, 'Name' => 'Lighting & Ceiling Fans' ],
			['BrowseNodeId' => 553244, 'Name' => 'Measuring & Layout Tools' ],
			['BrowseNodeId' => 228899, 'Name' => 'Painting Supplies & Wall Treatments' ],
			['BrowseNodeId' => 328182011, 'Name' => 'Power & Hand Tools' ],
			['BrowseNodeId' => 13749581, 'Name' => 'Rough Plumbing' ],
			['BrowseNodeId' => 3180231, 'Name' => 'Safety & Security' ],
			['BrowseNodeId' => 13400631, 'Name' => 'Storage & Home Organization' ],
			['BrowseNodeId' => 8106310011, 'Name' => 'Welding & Soldering' ],
		];
		if ($catName) return $subCategories[$catName];
		else return false;
	}
}

function generate_custom_title() {
	if (isset($_SESSION['bbil_SearchIndex']) && !empty($_SESSION['bbil_SearchIndex'])) {
		$pageTitle = $_SESSION['bbil_SearchIndex'];
	} elseif (isset($_SESSION['bbil_Keywords']) && !empty($_SESSION['bbil_Keywords'])) {
		$pageTitle = $_SESSION['bbil_Keywords'];
	} else {
		$pageTitle = get_option('bbil_store_keyword');
	}

	return $pageTitle .' < '. get_option('blogdescription');
}
function generate_single_title() {
	if (isset($_SESSION['singleTitle']) && !empty($_SESSION['singleTitle'])) {
		$pageTitle = $_SESSION['singleTitle'];
		unset($_SESSION['singleTitle']);
	} else {
		$pageTitle = 'Single Product';
	}
	return $pageTitle .' < '. get_option('blogdescription');

}