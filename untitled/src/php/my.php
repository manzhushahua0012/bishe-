<?php
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['limit'])){
    header("Location:login.html");
    exit();
}
//包含数据库连接文件
include('con.php');
$limit = $_SESSION['limit'];
$account = $_SESSION['account'];
$user_query = mysql_query("select * from user where limit = '$limit' limit 1");
$row = mysql_fetch_array($user_query);
echo '用户信息：<br />';
echo '用户ID：',$limit,'<br />';
echo '用户名：',$account,'<br />';
echo '<a href="login.php?action=logout">注销</a> 登录<br />';
?>