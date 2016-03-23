<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Input extends CI_Input {
    public function __construct() {
        parent::__construct();
    }

    // assign xxs_clean = true by default for post and turn off in config
    public function post($index = null, $xss_clean = true) {
        return parent::post($index, $xss_clean);
    }

    // assign xxs_clean = true by default for get and turn off in config
    public function get($index = null, $xss_clean = true) {
        return parent::get($index, $xss_clean);
    }
}


/* End of file MY_Input.php */
/* Location: ./application/core/MY_Input.php */