<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * WoW Realm class
 *
 * This class accesses the realm methods for the API.
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

class Realm extends APIService {

    /**
     * @var Character
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
        $this->urlAppend = '/realm';
    }

    /**
     * Get all realms
     *
     * @return array<APIRealm>
     */
    public function getRealms() {
        $returnObj = new stdClass();
        $cnt = 0;

        $this->urlAppend .= "/status";
        $this->client->request($this->urlAppend);

        foreach ($this->client->data->realms as $key => $val) {
            $returnObj->$cnt = new stdClass();
            $returnObj->$cnt->name = $val->name;
            $returnObj->$cnt->slug = $val->slug;
            $cnt++;
        }

        return $returnObj;
    }

}

// END Realm Class

/* End of file Realm.php */
/* Location: ./system/application/libraries/services/Realm.php */