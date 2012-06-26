<?php

use lithium\action\Dispatcher;
use lithium\action\Response;
use lithium\security\Auth;
use lithium\security\Password;
use lithium\util\collection\Filters;
use lithium\analysis\Logger;
use lithium\data\Connections;

use ali3\storage\Session;

/**
 * improved authentication using filters
 * http://lithify.me/docs/manual/lithium-basics/filters.wiki
 */
//TODO: Redirect to last page after login using sessions
Dispatcher::applyFilter('_callable', function($self, $params, $chain) {
	
    $ctrl = $chain->next($self, $params, $chain);
    
    //If public action, don't check
    if (isset($ctrl->publicActions) && in_array($params['request']->action, $ctrl->publicActions)) {
        return $ctrl;
    }
    
    //Check if user is logged in
    if ($user = Auth::check('default')) {
        //Check if activated
        if ($user['active'] == "active") {
            //Check if logged in user has access
            if ($user['access'] == "admin"){
                return $ctrl;
            }
            //Start controller/action based rules
            $controller = $params['params']['controller'];
            $action = $params['params']['action'];
            //var_dump($params);

            return $ctrl;
        }
    }
	
    //If nothing makes it through, login
    return function() {
		Session::write('message', 'Please Login');
        return new Response(array('location' => '/login'));
    };
	
});

?>