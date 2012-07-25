<?php
use lithium\security\Auth;

use app\models\Users;
/**
 * Uncomment the lines below to enable forms-based authentication. This configuration will attempt
 * to authenticate users against a `Users` model. In a controller, run
 * `Auth::check('default', $this->request)` to authenticate a user. This will check the POST data of
 * the request (`lithium\action\Request::$data`) to see if the fields match the `'fields'` key of
 * the configuration below. If successful, it will write the data returned from `Users::first()` to
 * the session using the default session configuration.
 *
 * Once the session data is written, you can call `Auth::check('default')` to check authentication
 * status or retrieve the user's data from the session. Call `Auth::clear('default')` to remove the
 * user's authentication details from the session. This effectively logs a user out of the system.
 * To modify the form input that the adapter accepts, or how the configured model is queried, or how
 * the data is stored in the session, see the `Form` adapter API or the `Auth` API, respectively.
 *
 * @see lithium\security\auth\adapter\Form
 * @see lithium\action\Request::$data
 * @see lithium\security\Auth
 */

//SEE https://github.com/pointlessjon/sphere/

Auth::config(array(
    'default' => array(
        'adapter' => 'Form',
        'model' => 'Users',
        'fields' => array('username', 'password'),
        'scope' => array('active' => 'active')
	),
    'admin' => array(
        'adapter' => 'Form',
        'model' => 'Users',
        'fields' => array('username', 'password'),
        'scope' => array('active' => 'active','access' => 'admin')
	),
    'editor' => array(
        'adapter' => 'Form',
        'model' => 'Users',
        'fields' => array('username', 'password'),
        'scope' => array('active' => 'active','access' => 'editor')
	),
    'contributor' => array(
        'adapter' => 'Form',
        'model' => 'Users',
        'fields' => array('username', 'password'),
        'scope' => array('active' => 'active','access' => 'contributor')
	),
));

?>
