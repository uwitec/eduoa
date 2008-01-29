<?php
	if(empty($osStudentNo) || $osStudentNo < 1) {
		echo("<script language='JavaScript'>alert('请先登录学生系统！');location.replace('index.php');</script>");
	}
?>