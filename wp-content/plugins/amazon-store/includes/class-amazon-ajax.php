<?php

class amazonAjax {
	function __construct() {

		// Save setup data
		add_action('wp_ajax_bbilas_setup', array( $this, 'bbilas_setup'));
		add_action('wp_ajax_nopriv_bbilas_setup', array( $this, 'bbilas_setup'));

		// Load sub categories
		add_action('wp_ajax_bbilas_loadSubCategories', array( $this, 'bbilas_loadSubCategories'));
		add_action('wp_ajax_nopriv_bbilas_loadSubCategories', array( $this, 'bbilas_loadSubCategories'));

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
}
new amazonAjax();