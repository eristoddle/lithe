<?php

use lithium\security\Auth;

use li3_access\security\Access;

use app\models\Users;

//Rbac
//Access::config(array(
//    'rbac' => array(
//        'adapter' => 'AuthRbac',
//        'roles' => array(
//            array(
//                'match' => array('Posts::add'),
//                //requesters is the auth config
//                'requesters' => array('default'),
//                'message' => 'Log in to add posts.',
//                'redirect' => 'Users::login',
//            ),
//            array(
//                'match' => array('Users::add'),
//                'requesters' => array('admin'),
//                'message' => 'Log in to add users.',
//                'redirect' => 'Users::login',
//            ),
//        )
//    )
//));
//Rules Based
//Access::config(array(
//	'rules' => array(
//		'adapter'  => 'Rules',
//		'default'  => array('isPublic', 'isAuthenticated'),
//		'allowAny' => true,
//		'user'     => function() { return Users::current(); },
//		'rules'    => array(
//			'isPublic' => function($user, $request, array $options) {
//				if ($user || !$request instanceof Controller) {
//					return true;
//				}
//				if (!isset($options['action']) || !isset($request->publicActions)) {
//					return false;
//				}
//				return in_array($options['action'], $request->publicActions);
//			},
//			'isAuthenticated' => function($user, $request, array $options) {
//				return (boolean) $user;
//			},
//			'isAdmin' => function($user, $asset, $options) {
//				if (!isset($options['admin']) || !$options['admin']) {
//					return true;
//				}
//			}
//		)
//	)
//));
?>
