<?php

namespace app\extensions\helper;

use ali3\storage\Config;

/*
 * Configuration helper
 */
class ConfigHelper extends \lithium\template\Helper {

    public function read($name) {
        return Config::read('default', $name);
    }
    
}


?>
