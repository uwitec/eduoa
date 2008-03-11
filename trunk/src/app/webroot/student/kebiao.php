<?php
	require_once('./includes/checkLogin.php');
	require_once('./includes/conn.php');

	echo("<script language='javascript'>location.replace('../eduoa/curriculum_schedules/banji_view_www/".$_COOKIE["osClassID"]."');</script>");
?>

