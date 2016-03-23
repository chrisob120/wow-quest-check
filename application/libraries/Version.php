<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Version {
	
	private $_CI = null;
	
	public function __construct() {
		$this->_CI = $CI =& get_instance();
	}
	
	public function auto_version($type, $file) {
		$filePath = FCPATH. 'assets/' .$file;
		
		if (!file_exists($filePath)) {
			return asset_url() . $file;
		} else {
			$fileTime = filemtime($filePath);
			
			if ($type == 'css') {
				$version = $this->_CI->configData['cssVersion'];
				
				if ($fileTime > $this->_CI->configData['cssFileTime']) {
					$version += 1;
					$this->_CI->db->where('setting', 'cssVersion')->update('config', array('value' => $version));
					$this->_CI->db->where('setting', 'cssFileTime')->update('config', array('value' => $fileTime));
				}
			} else if ($type == 'js') {
				$version = $this->_CI->configData['jsVersion'];
				
				if ($fileTime > $this->_CI->configData['jsFileTime']) {
					$version += 1;
					$this->_CI->db->where('setting', 'jsVersion')->update('config', array('value' => $version));
					$this->_CI->db->where('setting', 'jsFileTime')->update('config', array('value' => $fileTime));
				}
			} else {
				$version = 'error';
			}
			
			return asset_url() . $file. '?version=' .$version;
		}
	}
	
}


/* End of file Version.php */
/* Location: ./application/libraries/Version.php */