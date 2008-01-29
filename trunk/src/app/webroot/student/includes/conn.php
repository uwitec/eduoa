<?php

	$db_host="localhost";
	$db_user="root";
	$db_password="root";
	$db_name="eduoa";
	$link=mysql_connect($db_host,$db_user,$db_password);
	mysql_query("SET NAMES 'utf8'",$link);
	$db=mysql_select_db($db_name,$link);

?>