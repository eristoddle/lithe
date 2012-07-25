<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use ali3\storage\Config;

Config::config(array(
    'default' => array(
        'adapter' => 'Db',
        'model' => 'Configs',
        'fields' => array('name', 'value'),
        'cache' => array(
            'name' => 'default'
        ),
    ),
));

?>
