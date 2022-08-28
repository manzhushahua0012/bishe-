<?php
header("Content-Type: text/html;charset=utf-8");
//声明变量
$account = isset($_POST['account']) ? $_POST['account'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
//判断用户名和密码不为空
if (!empty($account) && !empty($password)) {
    $ini= parse_ini_file("con.ini");
    $conn =new mysqli($ini["servername"],$ini["username"],$ini["password"],$ini["dbname"]) or die("连接失败<br/>");
    mysqli_set_charset($conn,"utf8");
    $sql_select = "SELECT account,password FROM user WHERE account = '$account' and password = '$password' "; //执行SQL语句
    $ret = mysqli_query($conn, $sql_select);
    $row = mysqli_fetch_array($ret);
    //判断用户名和密码是否正确
    if ($account == $row['account'] && $password == $row['password']) {
        echo "<script>setTimeout(function(){window.location.href='../web/html/index/index.html';},1000);</script>";
    }else{
        //如果错误，则跳转到登录失败页面
        echo "<script>alert('登录失败！');history.go(-1);</script>";
        echo "<script>setTimeout(function(){window.location.href='../web/html/login/login.html';},1000);</script>";
    }
}else{
    //如果用户名或密码为空，则跳转到登录失败页面
    echo "<script>alert('登录失败！');history.go(-1);</script>";
    echo "<script>setTimeout(function(){window.location.href='../web/html/login/login.html';},1000);</script>";
}
