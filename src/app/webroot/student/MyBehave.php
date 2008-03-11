<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>金色校园</title>
<link href="css.css" rel="stylesheet" type="text/css" />
</head>
<?php
	session_start();
	require_once('./includes/checkLogin.php');
	require_once('./includes/conn.php');

	$sql = " select type_name,id from grow_file_types ";
	$stmt = mysql_query($sql);
?>
<body>
<?php	include("top.php");?>
<table width="809" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="190" rowspan="2" valign="top">
		<?php	include("left.php");?>
	</td>
    <td width="10" rowspan="2" valign="top">&nbsp;</td>
    <td width="609" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td bgcolor="F89F13"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="82" height="30" align="right" valign="bottom" background="images/huang_1_1.gif"><table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center"><img src="images/22.png" width="24" height="23" /></td>
                <td class="hotfoodfont">我的表现</td>
              </tr>
            </table></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="7" background="images/zuo_1.gif"><img src="images/zuo_1.gif" width="7" height="8" /></td>
            <td bgcolor="FFF4E8">
			 <table width="100%" border="0" cellspacing="0" cellpadding="0">
			 <?php	
				while($row = mysql_fetch_array($stmt)) {
					$sql2 = " select b.type_name,a.title,a.description,a.created from student_grow_files a,grow_file_types b where a.grow_file_type_id = b.id and b.id =".$row[1]." and a.student_id =".$osStudentID;
					$stmt2 = mysql_query($sql2);
			?>
              <tr>
                <td width="13%"><?=$row[0]?></td>
                <td width="87%" valign="top">
					<?php
						$ii = 0;
						while($row2 = mysql_fetch_array($stmt2)) {
							echo $row[1]."==>".$row[2];
							if($ii > 0) {
								echo("<br>");
							}
							$ii++;
						}
					?>
				</td>
              </tr>
			 <?php	}?>
            </table>
			</td>
            <td width="7" background="images/you_2.gif"><img src="images/you_2.gif" width="7" height="8" /></td>
          </tr>
          <tr>
            <td><img src="images/xia_1.gif" width="7" height="8" /></td>
            <td background="images/xia_bg.gif"><img src="images/1_1.gif" width="1" height="1" /></td>
            <td><img src="images/xia_2.gif" width="7" height="8" /></td>
          </tr>
        </table></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" class="hotfoodtd">&nbsp;</td>
  </tr>
</table>
<?php	include('bottom.php');?>
</body>
</html>
