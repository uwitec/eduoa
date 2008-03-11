<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	require_once("./includes/conn.php");
	if($_POST["action"] == "login") {
		$sql = "select a.student_no,a.student_name,b.class_name,a.id,b.id from students a,banjis b where a.student_no='".$_POST["username"]."' and a.password='".md5($_POST["password"])."' and a.banji_id = b.id ";
		$stmt = mysql_query($sql);
		while($arr = mysql_fetch_array($stmt)) {
			$student_no = $arr[0];
			$student_name = $arr[1];
			$student_class = $arr[2];
			$student_id = $arr[3];
			$class_id = $arr[4];

			setcookie("osStudentNo",$student_no);
			setcookie("osStudentName",$student_name);
			setcookie("osStudentClass",$student_class);
			setcookie("osStudentID",$student_id);
			setcookie("osClassID",$class_id);
		}


		if(empty($student_no)) {
			echo("<script language='JavaScript'>alert('学号或密码错误！');</script>");
		}else {
			echo("<script language='JavaScript'>location.replace('index.php');</script>");
		}
	}
?>