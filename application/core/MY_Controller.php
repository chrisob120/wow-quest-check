<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	/**
	 * Global config data pulled from DB
	 * @var $configData
	 */
	public $configData;

	/**
	 * Public form errors global array
	 * @var $formErrors
	 */
	public $formErrors = array();

	/**
	 * Data array passed to view
	 *
	 * @var $_data
	 */
	protected $_data = array();
	
	public function __construct() {
		parent::__construct();
		$this->load->model('model_config');

		// load global values from database
		$this->configData = $this->model_config->get_config($global = true);
		$this->load->vars(array('config' => $this->configData));

		// load manual vars

			// set global count for whenever a count variablbe starting at 0 is needed
			$this->load->vars(array(
				'globalCnt' => 0
			));
	}
	
	
}


/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */