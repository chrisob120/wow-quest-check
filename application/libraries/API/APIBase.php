<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * WoW API Base Class
 *
 * This class accesses the base API class
 *
 * @package		WoW
 * @author		Chris O'Brien
 * @category	Libraries
 * @copyright   Copyright (c) 2014, Diobie, LLC
 * @version     1.0.0
 *
 */
class APIBase {

    const API_BASE_URL = 'http://us.battle.net/api/wow/';

    /**
     * Server the character is on
     *
     * @var	string
     */
    public $server;

    /**
     * Character name
     *
     * @var	string
     */
    public $name;

    /**
     * Complete service url
     *
     * @var	string
     */
    public $url;

    /**
     * Curl object
     *
     * @var	string
     */
    public $curl_obj;

    /**
     * Error check
     *
     * @var	bool
     */
    public $error = false;

    /**
     * Error message
     *
     * @var	string
     */
    public $errorMsg = '';

    /**
     * Hold the API data
     *
     * @var	array
     */
    public $data = array();

    /**
     * Constructor
     *
     * @access	public
     */
    public function __construct() {
    }

    /**
     * Request
     *
     * Do the API request
     *
     * @param   string $url The rest of the URL
     * @access  public
     * @return  array
     */
    public function request($url) {
        $this->curl_obj = curl_init();

        $this->complete_url($url);

        curl_setopt($this->curl_obj, CURLOPT_URL, $this->url);
        curl_setopt($this->curl_obj, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($this->curl_obj);

        if ($response === false) {
            $info = curl_getinfo($this->curl_obj);
            curl_close($this->curl_obj);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
        }

        curl_close($this->curl_obj);

        $this->parse_response($response);
    }

    /**
     * Complete URL
     *
     * Create the final API URL
     *
     * @param   string $url The rest of the URL
     * @access	protected
     * @return  void
     */
    protected function complete_url($url) {
        $this->url = self::API_BASE_URL;
        $this->url .= $url;
    }

    /**
     * Parse the response
     *
     * Formats the final service URL for output to the curl object.
     *
     * @param   array   $response The API response
     * @return  object
     */
    protected function parse_response($response) {
        $decoded = json_decode($response);

        // if there is an error
        if (isset($decoded->status)) {
            $this->error = true;
            $this->errorMsg = $decoded->reason;
        } else {
            $this->data = $decoded;

            return $this->data;
        }
    }



}
// END API Base Class

/* End of file APIBase.php */
/* Location: ./system/application/libraries/APIBase.php */