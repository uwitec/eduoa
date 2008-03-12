<?php
	setcookie("osStudentNo",'0');
	session_unregister("osStudentNo");
	
	echo("<script language='JavaScript'>location.replace('index.php');</script>");
?>