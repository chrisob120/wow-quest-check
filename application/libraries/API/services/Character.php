<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * WoW Character Class
 *
 * This class accesses the character methods for the API.
 *
 * @package		WoW
 * @author		Chris O'Brien
 * @category	Libraries
 * @copyright   Copyright (c) 2014, Diobie, LLC
 * @version     1.0.0
 *
 */

require_once(APPPATH . 'libraries/API.php');
require_once(APPPATH . 'libraries/API/APIService.php');

class Character extends APIService {

    /**
     * @var $characterInfo
     */
    public $characterInfo;

    /**
     * @var $urlAppend
     */
    protected $urlAppend;

    /**
     * Initialize sub services
     *
     * @param API $client
     */
    public function __construct(API $client) {
        parent::__construct($client);

        // append character to all API requests for this class
        $this->urlAppend = 'character';
    }

    /**
     * Get Quests
     *
     * @return void
     */
    public function quests() {
        $server = $this->client->server;
        $name = $this->client->name;

        $this->urlAppend .= "/$server/$name?fields=quests";
        $this->client->request($this->urlAppend);
    }

    /**
     * Return character info
     *
     * @return void
     */
    public function getCharInfo() {
        $server = $this->client->server;
        $name = $this->client->name;

        $this->urlAppend .= "/$server/$name";
        $this->client->request($this->urlAppend);

        $this->characterInfo = $this->client->data;
    }

}

// END Quests Class

/* End of file Quests.php */
/* Location: ./system/application/libraries/services/Quests.php */