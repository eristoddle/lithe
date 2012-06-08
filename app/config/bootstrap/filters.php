<?php

use app\models\Users;

use lithium\action\Dispatcher;
use lithium\action\Response;
use lithium\security\Auth;
use lithium\security\Password;
use lithium\util\collection\Filters;
use lithium\analysis\Logger;
use lithium\data\Connections;

#This is not working here
Users::applyFilter('save', function($self, $params, $chain) {

    if ($params['data']) {
        $params['entity']->set($params['data']);
        $params['data'] = array();
    }
    
    if(!empty($params['entity']->password)) {
        $params['entity']->password = Password::hash($params['entity']->password);
    }
    
    return $chain->next($self, $params, $chain);
	
});

/**
 * improved authentication using filters
 * http://lithify.me/docs/manual/lithium-basics/filters.wiki
 */
Dispatcher::applyFilter('_callable', function($self, $params, $chain) {
    $ctrl = $chain->next($self, $params, $chain);

    if (Auth::check('default')) {
        return $ctrl;
    }
    if (isset($ctrl->publicActions) && in_array($params['request']->action, $ctrl->publicActions)) {
        return $ctrl;
    }
    return function() {
        return new Response(array('location' => '/users/login'));
    };
});

?>