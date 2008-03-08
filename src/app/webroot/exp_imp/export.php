<?php

	$db_host="localhost";
	$db_user="root";
	$db_password="root";
	$db_name="eduoa";
	$link=mysql_connect($db_host,$db_user,$db_password);
	mysql_query("SET NAMES 'utf8'",$link);
	$db=mysql_select_db($db_name,$link);


    Header("Content-type: text/x-csv");

	$banji_id = $_GET['banji'];
	$course = $_GET['course'];

	$sql_banji = " select class_name from banjis where id =".$banji_id;
	$stmt_banji = mysql_query($sql_banji);
	while($row_banji = mysql_fetch_array($stmt_banji)) {
		$banji_name = $row_banji[0];
	}

	$sql_course = " select course_name from courses where id =".$course;
	$stmt_course = mysql_query($sql_course);
	while($row_course = mysql_fetch_array($stmt_course)) {
		$course_name = $row_course[0];
	}

	$csv_file_name = $banji_name."--".$course.".csv";
	$csv_file_name = iconv('UTF-8','gb2312',$banji_name)."__".iconv('UTF-8','gb2312',$course_name).".csv";

	//由于中文名字导入有问题，暂直接用英文名字
	$csv_file_name = "exam_result.csv";

	header("Content-Disposition: attachment; filename=".$csv_file_name);

	$content = "内部编号, 姓名, 成绩\n";


	$sql = "SELECT id,student_name from students where banji_id = $banji_id ";
	$stmt = mysql_query($sql);
	while($row= mysql_fetch_array($stmt)){
		$content .= $row[0].','.iconv('UTF-8','gb2312',$row[1]).','."\n";
	}

	echo($content);
?>