<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('copywrite_date')) {
	function copywrite_date($start, $overwrite = false) {
		$current = date('Y');

		// if default date check is overwritten, return start date
		if ($overwrite) {
			return $start;
		}

		return ($start - $current == 0) ? $start : $start. ' - '. $current;
	}
}


/* End of file misc_helper.php */
/* Location: ./application/helpers/misc_helper.php */