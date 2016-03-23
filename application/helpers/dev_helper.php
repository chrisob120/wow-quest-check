<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('print_rci')) {
	function print_rci($array) {
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}
}

if (!function_exists('format_money')) {
	function format_money($amount) {
		$num = number_format($amount, 2, '.', '');
		$num = '$' .$num;
		
		return $num;
	}
}


/* End of file dev_helper.php */
/* Location: ./application/helpers/dev_helper.php */