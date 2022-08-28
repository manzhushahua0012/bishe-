<?php
header("Content-Type: text/html;charset=utf-8");
// $Id:$ //声明变量
$account = isset($_POST['account']) ? $_POST['account'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$authority = isset($_POST['authority']) ? $_POST['authority'] : "";
$depNumber = isset($_POST['depNumber']) ? $_POST['depNumber'] : "";
$username = isset($_POST['username']) ? $_POST['username'] : "";
$phone = isset($_POST['phone']) ? $_POST['phone'] : "";
//如果都不为空，则进行注册
if (!empty($account) && !empty($password) && !empty($depNumber) && !empty($username) && !empty($phone)) {
    $ini= parse_ini_file("con.ini");
    $conn =new mysqli($ini["servername"],$ini["username"],$ini["password"],$ini["dbname"]) or die("连接失败<br/>");
    mysqli_set_charset($conn,"utf8");
    //查询数据库中是否有相同的账号
    $sql_select = "SELECT account FROM user WHERE account = 'account'"; //执行SQL语句
    $ret = mysqli_query($conn, $sql_select);
    $row = mysqli_fetch_array($ret); //判断用户名是否已存在
    if ($account == $row['account']) {
        //如果存在，则提示用户名已存在并且1秒后跳转到注册页面
        echo "<script>alert('用户名已存在！');</script>";
        echo "<script>setTimeout(function(){window.location.href='../web/html/register/register.html';},1000);</script>";
    }else{
        //用户名不存在，插入用户信息
        $sql_insert = "INSERT INTO user (account,password,authority,depNumber,username,phone) VALUES ('$account','$password','0','$depNumber','$username','$phone')";
        $ret = mysqli_query($conn, $sql_insert);
        if ($ret) {
            echo "<script>alert('注册成功！');history.go(-1);</script>";
            echo "<script>setTimeout(function(){window.location.href='../web/html/login/login.html';},1000);</script>";
        } else {
            echo "<script>alert('注册失败！');history.go(-1);</script>";
            echo "<script>setTimeout(function(){window.location.href='../web/html/register/register.html';},1000);</script>";
        }
    }
}else{
    echo "<script>alert('填写信息不能为空！！！');history.go(-1);</script>";
    echo "<script>setTimeout(function(){window.location.href='../web/html/register/register.html';},1000);</script>";
}
