<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>金色校园</title>
<link href="css.css" rel="stylesheet" type="text/css" />
</head>
<?php
	require_once('./includes/conn.php');

	$sql = "select title,content,subhead from documents where id =".$_GET["id"];
	$stmt = mysql_query($sql);
	$arr = mysql_fetch_array($stmt);
?>
<body>
<?php	include("top.php");?>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top" class="hotfoodtd" height="30"><?=$arr[0]?></td>
  </tr>
  <tr>
    <td valign="top" class="hotfoodtd"  height="200"><?=$arr[1]?></td>
  </tr>
  <tr>
    <td valign="top" class="hotfoodtd" align="right">
		<?php
			if($arr[2]){
				echo("<a href='$arr[2]'>点击下载附件</a>");
			}
		?>
	</td>
  </tr>
</table>
<?php	include('bottom.php');?>
</body>
</html>
