<?php

use lithium\action\Dispatcher;
use lithium\action\Response;
use lithium\security\Auth;
use lithium\security\Password;
use lithium\util\collection\Filters;
use lithium\analysis\Logger;
use lithium\data\Connections;

use ali3\storage\Session;
//use app\controllers\ConfigsController;
use li3_access\security\Access;

/**
 * improved authentication using filters
 * http://lithify.me/docs/manual/lithium-basics/filters.wiki
 */
//TODO: Redirect to last page after login using sessions
//TODO: Users should be able to edit their own details - How?
Dispatcher::applyFilter('_callable', function($self, $params, $chain) {
    
    $ctrl = $chain->next($self, $params, $chain);
    
    //If public action, don't check
    if (isset($ctrl->publicActions) && in_array($params['request']->action, $ctrl->publicActions)) {
        return $ctrl;
    }
    
    //admin is god
//    if ($user = Auth::check('admin')) {
//        return $ctrl;
//    }
	
    //If nothing makes it through, login
    return function() {
		Session::write('message', 'Please Login');
        return new Response(array('location' => '/login'));
    };
	
});

?>