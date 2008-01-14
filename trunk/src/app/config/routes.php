<?php

	$Route->connect('/', array('controller' => 'members', 'action' => 'login'));
	$Route->connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	$Route->connect('/admin_index', array('controller' => 'pages', 'action' => 'admin_index', 'admin_index'));
	$Route->connect('/tests', array('controller' => 'tests', 'action' => 'index'));
?>