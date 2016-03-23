<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_config extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	// get site config settings from db
	public function get_config($global = false) {
		$qry = $this->db->select()
			->from('config')
			->get();
		
		$results = $qry->result();
		$returnArray = array();
		
		foreach ($results as $row) {
			$returnArray[$row->setting] = $row->value;
		}
		
		return $returnArray;
	}
}


/* End of file model_config.php */
/* Location: ./application/models/model_config.php */