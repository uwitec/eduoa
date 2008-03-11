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
		}
	}
?>
<table width="100" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<?php	
		if($student_no > 1 || $osStudentNo > 1) {

	?>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="images/green_top.jpg" width="190" height="11" /></td>
      </tr>
      <tr>
        <td background="images/green_bg_1.jpg"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><div align="center" class="hotfoodfont">学生登录信息</div></td>
          </tr>
          <tr>
            <td height="1" bgcolor="#FFFFFF"><img src="images/1_1.gif" width="1" height="1" /></td>
          </tr>
          <tr>
            <td align="center"><table width="100%" border="0" cellpadding="4" cellspacing="0" class="hotfoodfont">
			<!--
              <tr>
                <td height="22" align="left">帐号类型：正常帐号</td>
              </tr>
			-->
              <tr>
                <td height="22" align="left">学生姓名：<?php echo($osStudentName?$osStudentName:$student_name)?></td>
              </tr>
              <tr>
                <td height="22" align="left">所在班级：<?php echo($osStudentClass?$osStudentClass:$student_class)?></td>
              </tr>
              <tr>
                <td height="22" align="left">学生编号：<?php echo($osStudentNo?$osStudentNo:$student_no)?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="images/green_bottom.jpg" width="190" height="11" /></td>
      </tr>
    </table>	

				<?php	
					if($student_no > 1 && empty($osStudentNo)) {
						echo("<script language='JavaScript'>location.replace('index.php');</script>");
					}
				?>
				

	<?php	}else{?>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td><img src="images/green_top.jpg" alt="a" width="190" height="11" /></td>
	  </tr>
	  <tr>
		<td background="images/green_bg_1.jpg"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
			<td><div align="center" class="hotfoodfont">学生登录</div></td>
		  </tr>
		  <tr>
			<td height="1" bgcolor="#FFFFFF"><img src="images/1_1.gif" alt="a" width="1" height="1" /></td>
		  </tr>
		  <tr>
			<td align="center">
			 <form id="form1" name="form1" method="post" action="">
			 <input type="hidden" name="action" value="login">
			  <table width="100%" border="0" cellpadding="4" cellspacing="0" class="hotfoodfont">
				<tr>
				  <td height="22" align="left">学　号：
					<label>
					<input name="username" type="text" size="10" />
					</label></td>
				</tr>
				<tr>
				  <td height="22" align="left">密　码：
					<label>
					<input name="password" type="password" size="10" />
					</label></td>
				</tr>
				<tr>
				  <td height="22" align="center"><label>
					<input type="submit" name="Submit" value="登录" />
				  </label></td>
				</tr>
			  </table>
			 </form>
			</td>
		  </tr>
		</table>	
		</td>
	  </tr>
	  <tr>
		<td><img src="images/green_bottom.jpg" alt="a" width="190" height="11" /></td>
	  </tr>
	</table>

	<?php	}?>

</td>
  </tr>
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="56" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="5"></td>
          </tr>
          <tr>
            <td height="55" align="center" valign="top"><a href="/blog/" target="_blank"><img src="images/page.gif" width="181" height="50" border="0" /></a></td>
          </tr>
        </table></td>
      </tr>
    </table>	</td>
  </tr>
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="15" background="images/ye_bg.gif"><img src="images/ye_1.gif" width="15" height="26" /></td>
        <td background="images/ye_bg.gif" class="hotfoodfont">插件下载</td>
        <td width="80" background="images/ye_bg.gif"><img src="images/ye_2.gif" width="80" height="26" /></td>
      </tr>
    </table>
	</td>
  </tr>
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="6"><img src="images/y_1.gif" width="6" height="7" /></td>
          <td background="images/y_2.gif"><img src="images/1_1.gif" width="1" height="1" /></td>
          <td width="6"><img src="images/y_3.gif" width="6" height="7" /></td>
        </tr>
        <tr>
          <td background="images/y_8.gif">&nbsp;</td>
          <td bgcolor="FFF4E8"><table width="100%" border="0" cellspacing="0" cellpadding="4">
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="29%" height="33" align="center"><img src="images/dix.gif" width="31" height="30" /></td>
                  <td width="71%"><a href="http://cndns.onlinedown.net/down/directx_nov2007_redist.zip" target="_blank"><font color=black>DirectX9下载</font></a></td>
                </tr>
                <tr>
                  <td height="33" align="center"><img src="images/flash.gif" width="31" height="30" /></td>
                  <td><a href="http://cndns.onlinedown.net/down/install_flash_player_active_x.zip" target="_blank"><font color=black>Flash9.0插件下载</font></a></td>
                </tr>
              </table></td>
            </tr>
            
          </table></td>
          <td background="images/y_4.gif">&nbsp;</td>
        </tr>
        <tr>
          <td><img src="images/y_7.gif" width="6" height="7" /></td>
          <td background="images/y_6.gif"><img src="images/1_1.gif" width="1" height="1" /></td>
          <td><img src="images/y_5.gif" width="6" height="7" /></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="4"><img src="images/1_1.gif" width="1" height="1" /></td>
        </tr>
    </table>
	</td>
  </tr>
</table>
