<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>金色校园</title>
<link href="css.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">
<!--
	function check() {
		var doc = document.form1;

		if((doc.old_password.value == "") || (doc.new_password.value == "") || (doc.new_password2.value == "")) {
			alert("密码不能为空");
			return false;
		}

		if(doc.new_password.value != doc.new_password2.value) {
			alert("两次录入的密码不一致，请重新录入！");
			return false;
		}
	}
//-->
</script>
</head>
<?php
	require_once('./includes/checkLogin.php');
	require_once('./includes/conn.php');

	if($_POST["action"] == "changePwd") {

		$sql = " select student_no from students where student_no =".$osStudentNo." and password = '".md5($_POST["old_password"])."'";
		$stmt = mysql_query($sql);
		$arr = mysql_fetch_array($stmt);

		if($arr[0] == $osStudentNo) {
			$sql = " update students set password = '".md5($_POST["new_password"])."' where student_no=".$osStudentNo;
			mysql_query($sql);	
			echo("<script language='JavaScript'>alert('密码修改成功！');</script>");
		}else {
			echo("<script language='JavaScript'>alert('旧密码不对！');</script>");
		}		
	}
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
            <td width="82" height="30" align="right" valign="bottom" background="images/huang_1_1.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center"><img src="images/22.png" width="24" height="23" /></td>
                <td class="hotfoodfont">修改密码</td>
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
            <td bgcolor="FFF4E8"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="4">
                  <tr>
                    <td>

			<form method=post action="" name="form1" onSubmit="return check()">

					<input type="hidden" name="action" value="changePwd">

					<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="27%" align="right">旧密码：</td>
                        <td width="73%" height="25">
                            <input type="password" name="old_password" />
                        </td>
                        </tr>
                      <tr>
                        <td align="right">新密码：</td>
                        <td height="25"><input type="password" name="new_password" /></td>
                      </tr>
                      <tr>
                        <td align="right">确认密码：</td>
                        <td height="25"><input type="password" name="new_password2" /></td>
                      </tr>
                      <tr>
                        <td height="25" colspan="2" align="center">
                            <input type="submit" name="Submit" value="提交修改密码" />
                        </td>
                        </tr>
                    </table>					

				</form>

					</td>
                    </tr>
                </table></td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
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
