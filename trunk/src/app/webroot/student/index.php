<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>金色校园</title>
<link href="css.css" rel="stylesheet" type="text/css" />
</head>
<?php
	require_once('./includes/conn.php');
?>
<body>
<?php	include("top.php");?>
<table width="809" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="190" rowspan="2" valign="top">
		<?php	include("left.php");?>	</td>
    <td width="10" rowspan="2" valign="top">&nbsp;</td>
    <td width="609" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" bgcolor="F89F13"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="82" height="30" align="right" valign="bottom" background="images/huang_1_1.gif"><table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center"><img src="images/22.png" width="24" height="23" /></td>
                <td class="hotfoodfont">班级公告</td>
              </tr>
            </table></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        <td bgcolor="F89F13"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="82" height="30" align="center" valign="bottom"><table width="95%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center"><img src="images/33.png" width="24" height="23" /></td>
                <td class="hotfoodfont">我的作业</td>
              </tr>
            </table></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="7" background="images/zuo_1.gif"><img src="images/zuo_1.gif" width="7" height="8" /></td>
            <td bgcolor="FFF4E8"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="4">
                  <tr>
                    <td valign="top">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<?php
					if($osStudentNo) {
						
						$sql_bjgg = "
								select 
									a.title,DATE_FORMAT(a.created,'%Y-%m-%d'),a.id 
								from 
									documents a,students b,doc_class_receiving_logs c
								where 
									a.document_type_id = 1 and a.id = c.document_id 
									and b.banji_id = c.banji_id and  b.student_no = $osStudentNo		
								order by a.created desc
								limit 4
						";
						$stmt_bjgg = mysql_query($sql_bjgg);
						while($arr_bjgg = mysql_fetch_array($stmt_bjgg)) {
					?>
                      <tr>
                        <td width="7%" align="center"><img src="images/items.gif" width="16" height="14" /></td>
                        <td width="93%" height="25"><a href="view.php?id=<?=$arr_bjgg[2]?>" target="_blank"><?=$arr_bjgg[0]?></a> [<?=$arr_bjgg[1]?>]</td>
                      </tr>
					<?php
						}
					}else {
					?>
                      <tr>
                        <td width="7%" align="center"><img src="images/items.gif" width="16" height="14" /></td>
                        <td width="93%" height="25">请先登录学生系统！</td>
                      </tr>
					<?php
					}
					?>
                    </table>					</td>
                    </tr>
                </table></td>
                <td width="50%"  valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="4">
                  <tr>
                    <td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<?php
					if($osStudentNo) {
						
						$sql_wdzy = "
								select 
									a.title,DATE_FORMAT(a.created,'%Y-%m-%d'),a.id 
								from 
									documents a,students b,doc_class_receiving_logs c
								where 
									a.document_type_id = 2 and a.id = c.document_id 
									and b.banji_id = c.banji_id and  b.student_no = $osStudentNo		
								order by a.created desc
								limit 4
						";
						$stmt_wdzy = mysql_query($sql_wdzy);
						while($arr_wdzy = mysql_fetch_array($stmt_wdzy)) {
					?>
                      <tr>
                        <td width="7%" align="center"><img src="images/items.gif" width="16" height="14" /></td>
                        <td width="93%" height="25"><a href="view.php?id=<?=$arr_wdzy[2]?>" target="_blank"><?=$arr_wdzy[0]?></a> [<?=$arr_wdzy[1]?>]</td>
                      </tr>
					<?php
						}
					}else {
					?>
                      <tr>
                        <td width="7%" align="center"><img src="images/items.gif" width="16" height="14" /></td>
                        <td width="93%" height="25">请先登录学生系统！</td>
                      </tr>
					<?php
					}
					?>
                    </table>					</td>
                  </tr>
                </table>				</td>
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
    <td width="609" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="50%" bgcolor="F89F13"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="82" height="30" align="right" valign="bottom" background="images/huang_1_1.gif"><table width="90%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="center"><img src="images/44.png" alt="1" width="24" height="23" /></td>
                      <td class="hotfoodfont">同步练习</td>
                    </tr>
                </table></td>
                <td>&nbsp;</td>
              </tr>
          </table></td>
          <td bgcolor="F89F13"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="82" height="30" align="center" valign="bottom"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="center"><img src="images/55.png" alt="1" width="24" height="23" /></td>
                      <td class="hotfoodfont">教辅下载</td>
                    </tr>
                </table></td>
                <td>&nbsp;</td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="7" background="images/zuo_1.gif"><img src="images/zuo_1.gif" alt="1" width="7" height="8" /></td>
                <td bgcolor="FFF4E8"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="4">
                          <tr>
                            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                   <?php
					if($osStudentNo) {
						
						$sql_tblx = "
								select 
									a.title,DATE_FORMAT(a.created,'%Y-%m-%d'),a.id 
								from 
									documents a,students b,doc_class_receiving_logs c
								where 
									a.document_type_id = 4 and a.id = c.document_id 
									and b.banji_id = c.banji_id and  b.student_no = $osStudentNo		
								order by a.created desc
								limit 4
						";
						$stmt_tblx = mysql_query($sql_tblx);
						while($arr_tblx = mysql_fetch_array($stmt_tblx)) {
					?>
                                <tr>
                                  <td width="7%" align="center"><img src="images/items.gif" alt="1" width="16" height="14" /></td>
                                  <td width="93%" height="25"><a href="view.php?id=<?=$arr_tblx[2]?>" target="_blank"><?=$arr_tblx[0]?></a> [<?=$arr_tblx[1]?>]</td>
                                </tr>
                                <?php
						}
					}else {
					?>
                      <tr>
                        <td width="7%" align="center"><img src="images/items.gif" width="16" height="14" /></td>
                        <td width="93%" height="25">请先登录学生系统！</td>
                      </tr>
					<?php
					}
					?>
                            </table></td>
                          </tr>
                      </table></td>
                      <td width="50%"  valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="4">
                          <tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <?php
					if($osStudentNo) {
						
						$sql_jfxz = "
								select 
									a.title,DATE_FORMAT(a.created,'%Y-%m-%d'),a.id 
								from 
									documents a,students b,doc_class_receiving_logs c
								where 
									a.document_type_id = 3 and a.id = c.document_id 
									and b.banji_id = c.banji_id and  b.student_no = $osStudentNo		
								order by a.created desc
								limit 4
						";
						$stmt_jfxz = mysql_query($sql_jfxz);
						while($arr_jfxz = mysql_fetch_array($stmt_jfxz)) {
					?>
                                <tr>
                                  <td width="7%" align="center"><img src="images/items.gif" alt="1" width="16" height="14" /></td>
                                  <td width="93%" height="25"><a href="view.php?id=<?=$arr_jfxz[2]?>" target="_blank"><?=$arr_jfxz[0]?></a> [<?=$arr_jfxz[1]?>]</td>
                                </tr>
                                <?php
						}
					}else {
					?>
                      <tr>
                        <td width="7%" align="center"><img src="images/items.gif" width="16" height="14" /></td>
                        <td width="93%" height="25">请先登录学生系统！</td>
                      </tr>
					<?php
					}
					?>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
                <td width="7" background="images/you_2.gif"><img src="images/you_2.gif" alt="1" width="7" height="8" /></td>
              </tr>
              <tr>
                <td><img src="images/xia_1.gif" alt="1" width="7" height="8" /></td>
                <td background="images/xia_bg.gif"><img src="images/1_1.gif" alt="1" width="1" height="1" /></td>
                <td><img src="images/xia_2.gif" alt="1" width="7" height="8" /></td>
              </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
</table>

<?php	include('bottom.php');?>

</body>
</html>
