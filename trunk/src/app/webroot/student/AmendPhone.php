<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>金色校园</title>
<link href="css.css" rel="stylesheet" type="text/css" />
</head>
<?php
	require_once('./includes/checkLogin.php');
	require_once('./includes/conn.php');

	$sql = "select father_name,father_unit,father_phone,mother_name,mother_unit,mother_phone from students where student_no =".$osStudentNo;
	$stmt = mysql_query($sql);
	$arr = mysql_fetch_array($stmt);

	if($_POST["action"] == "update") {

		$sql_update = " 
				update 
					students 
				set 
					father_name = '".$_POST["father_name"]."', 
					father_unit = '".$_POST["father_unit"]."', 
					father_phone = '".$_POST["father_phone"]."', 
					mother_name = '".$_POST["mother_name"]."', 
					mother_unit = '".$_POST["mother_unit"]."', 
					mother_phone = '".$_POST["mother_phone"]."'					
				where student_no=".$osStudentNo;
		mysql_query($sql_update);	
		echo("<script language='JavaScript'>alert('修改成功！');location.replace('AmendPhone.php');</script>");
	
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
            <td width="82" height="30" align="right" valign="bottom" background="images/huang_1_1.gif">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center"><img src="images/22.png" width="24" height="23" /></td>
                <td class="hotfoodfont">修改信息</td>
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
					
			<form method=post action="" name="form1">

					<input type="hidden" name="action" value="update">

					<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="right">父亲姓名：</td>
                        <td height="25"><input type="text" name="father_name" value="<?=$arr[0]?>" /></td>
                      </tr>
                      <tr>
                        <td width="27%" align="right">父亲单位：</td>
                        <td width="73%" height="25"><input type="text" name="father_unit" value="<?=$arr[1]?>" /></td>
                        </tr>
                      <tr>
                        <td align="right">父亲电话：</td>
                        <td height="25"><input type="text" name="father_phone" value="<?=$arr[2]?>" /></td>
                      </tr>
                      <tr>
                        <td align="right">母亲姓名：</td>
                        <td height="25"><input type="text" name="mother_name" value="<?=$arr[3]?>" /></td>
                      </tr>
                      <tr>
                        <td align="right">母亲单位：</td>
                        <td height="25"><input type="text" name="mother_unit" value="<?=$arr[4]?>" /></td>
                      </tr>
                      <tr>
                        <td align="right">母亲电话：</td>
                        <td height="25"><input type="text" name="mother_phone" value="<?=$arr[5]?>" /></td>
                      </tr>
                      <tr>
                        <td height="25" colspan="2" align="center">
                            <input type="submit" name="Submit" value="提交资料" />
                            &nbsp;&nbsp;
                            <input type="reset" name="Submit2" value="重新填写" /></td>
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
