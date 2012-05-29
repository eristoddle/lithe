<?php
//Enable session support
use lithium\storage\Session;
//Enable auth support
use lithium\security\Auth;

//Configure sessions
Session::config(array(
    'default' => array('adapter' => 'Php')
));

//Configure auth
Auth::config(array(
    'member' => array(
        'adapter' => 'Form', //Specify we're using form authentication method
        'model'   => 'Users', //Specify what model is used for auth
        'fields'  => array('username', 'password') //Specify which fields are used
    )
));
?>