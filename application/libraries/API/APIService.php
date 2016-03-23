<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * WoW API Service Class
 *
 *
 * @package		WoW
 * @author		Chris O'Brien
 * @category	Libraries
 * @copyright   Copyright (c) 2014, Diobie, LLC
 * @version     1.0.0
 *
 */

require_once(APPPATH . 'libraries/API.php');

class APIService {

    /**
     * @var API
     */
    protected $client;

    /**
     * @param API $client
     */
    public function __construct(API $client) {
        $this->client = $client;
    }

}
// END API Service Class

/* End of file API.php */
/* Location: ./system/application/libraries/APIService.php */