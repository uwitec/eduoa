<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>金色校园教育管理软件系统</title>
<?php header("content-type:text/html;charset=UTF-8");?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<frameset rows="62,27,*,20" cols="*" frameborder="no" border="0" framespacing="0" id="frame1">
  <frame src="/frames/top" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" /></frame><!--//顶部页面  -->
  <frame src="/frames/head" name="headFrame" scrolling="No" noresize="noresize" id="headFrame" /></frame><!--//顶部下页面  -->
  <frameset rows="*" cols="7,190,5,9,*,0" framespacing="0" frameborder="no" border="0" id="frame2">
    <frame src="/pages/blank" name="menu_leftbar" scrolling="No" noresize="noresize" id="menu_leftbar" /></frame><!- //菜单左边条 -->
	<frame src="modules/left" name="function_panel_index" scrolling="Auto" noresize="noresize" id="function_panel_index" /></frame><!--//左边的菜单页 -->
    <frame src="/pages/blank" name="menu_rightbar" scrolling="No" noresize="noresize" id="menu_rightbar" /></frame><!-//菜单右边条 -->
	<frame src="/pages/control" name="controlmenu" frameborder="0" scrolling="No" noresize="noresize" id="controlmenu" /></frame> <!--//中间页，控制左边菜单的显隐 --> 
	<frame src="/demo.php" name="table_index" frameborder="0" scrolling="Auto" noresize="noresize" id="table_index" /></frame><!--//右边的内容页面，显示菜单点击页面 -->
	<frame src="modules/left" name="table_right" frameborder="0" scrolling="No" noresize="noresize" id="table_right" /></frame><!-- //右边条 -->      
  </frameset>
  <frame src="/frames/status_bar" name="status_bar" scrolling="No" noresize="noresize" id="status_bar" /></frame><!--//底部的状态页面 -->
</frameset>

<noframes>您的浏览器不支持框架页面，请使用IE6.0以上的浏览器！</noframes>
</html>