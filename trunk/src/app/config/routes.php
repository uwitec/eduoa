<?php

	$Route->connect('/', array('controller' => 'members', 'action' => 'login'));
	$Route->connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	$Route->connect('/tests', array('controller' => 'tests', 'action' => 'index'));
	$Route->connect('/csv/:controller/:action/*', array('webservices' => 'Csv')); 
?>