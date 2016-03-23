<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * WoW API Class
 *
 * This class accesses the WoW API
 *
 * @package		WoW
 * @author		Chris O'Brien
 * @category	Libraries
 * @copyright   Copyright (c) 2014, Diobie, LLC
 * @version     1.0.0
 *
 */

require_once(APPPATH . 'libraries/API/APIBase.php');
require_once(APPPATH . 'libraries/API/services/Character.php');
require_once(APPPATH . 'libraries/API/services/Realm.php');

class API extends APIBase {

    /**
     * @var Character
     */
    public $character;

    /**
     * @var Realm
     */
    public $realm;

    /**
     * Initialize sub services
     *
     * @param array $params The server and character params
     */
    public function __construct($params = null) {
        if (isset($params['server'])) $this->server = $params['server'];
        if (isset($params['name'])) $this->name = $params['name'];

        $this->character = new Character($this);
        $this->realm = new Realm($this);
    }

}
// END API Class

/* End of file API.php */
/* Location: ./system/application/libraries/API.php */