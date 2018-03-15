<?php

class amazonAjax {
	function __construct() {

		// Save setup data
		add_action('wp_ajax_bbilas_setup', array( $this, 'bbilas_setup'));
		add_action('wp_ajax_nopriv_bbilas_setup', array( $this, 'bbilas_setup'));

	}

	function bbilas_setup() {
		// posted data
		$data['accessKey']          = Helper::getPostField($_POST['accessKey']);
		$data['secretKey']          = Helper::getPostField($_POST['secretKey']);
		$data['associate']          = Helper::getPostField($_POST['associate']);
		$data['storeKeyword']       = Helper::getPostField($_POST['storeKeyword']);
		$data['defaultDiscount']    = Helper::getPostField($_POST['defaultDiscount']);
		$data['category']           = Helper::getPostField($_POST['category']);
		$data['theme']              = Helper::getPostField($_POST['theme']);
		$data['settingsSaved']      = 1;

		// validation
		if (!array_search('', $data)!==false) {
			// save data
			try {
				foreach ($data as $key => $value) {
					Helper::saveOnOptionTable('bbilas_'.$key, $value);
				}
				$response['code'] = 200;
				$response['message'] = 'Successfully saved.';
			} catch (Exception $exception) {
				// saving error
				$response['code'] = 402;
				$response['message'] = 'Something went wrong.';
			}
		} else {
			// All fields are not present
			$response['code'] = 401;
			$response['message'] = 'All fields are required.';
		}

		// response
		wp_die(json_encode($response));
	}
}
new amazonAjax();