<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('asset_url')) {
	function asset_url() {
		$CI =& get_instance();
		
		// return the asset_url
		return base_url() . $CI->config->item('asset_path'). '/';
	}
}

if (!function_exists('current_page')) {
	function current_page() {
		$page = basename($_SERVER['PHP_SELF']);
		$page = explode('/', $page);
		$cnt = count($page) - 1;
		$curPage = $page[$cnt];
		
		if ($curPage == 'index.php') {
			$curPage = 'home';
		}
		
		return $curPage;
	}
}

if (!function_exists('current_controller')) {
	function current_controller() {
		$CI =& get_instance();
	
		$controller = $CI->uri->segment(1);
		return ($controller == '' || $controller == 'account') ? 'home' : $controller;
	}
}

if (!function_exists('current_view')) {
	function current_view($num) {
		$CI =& get_instance();
		
		$view = $CI->uri->segment($num);
		return ($view == '') ? '' : $view;
	}
}

// Get url from processed get
// Leave the possibility to have all array of allowed gets
if (!function_exists('process_url')) {
	function process_url($getArray, $allowedArray = null) {
		$urlArray = array();

		foreach ($getArray as $key => $val) {
			$key = htmlspecialchars($key);
			$val = htmlspecialchars($val);

			if ($key != 'num') {
				$urlArray[$key] = $val;
			}
		}

		return http_build_query($urlArray);
	}
}

// Remove query string from url and return string
if (!function_exists('remove_qry_string')) {
    function remove_qry_string($url) {
        $pUrl = parse_url($url);
        $returnUrl = $pUrl['scheme']. '://' .$pUrl['host'] . $pUrl['path'];

        return $returnUrl;
    }
}


/* End of file path_helper.php */
/* Location: ./application/helpers/path_helper.php */