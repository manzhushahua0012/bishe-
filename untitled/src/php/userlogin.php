<?php
header("Content-Type: text/html;charset=utf-8");
// $Id:$ //声明变量
$account = isset($_POST['account']) ? $_POST['account'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
//判定用户名和密码是否为空
if (!empty($account) && !empty($password)) {
    //建立连接
    $ini= parse_ini_file("con.ini");
    $conn =new mysqli($ini["servername"],$ini["account"],$ini["password"],$ini["dbname"]) or die("连接失败<br/>");
//准备SQL语句
    $sql_select = "SELECT account,password FROM user WHERE account = '$account'";
    //执行SQL语句
    $ret = mysqli_query($conn, $sql_select);
    $row = mysqli_fetch_array($ret);
    //判断用户名和密码是否一样
    if ($account == $row['account'] && $password == $row['password']) {
        //用户名和密码一样
        echo "登录成功！";
        header("Location:../web/html/Personalprofile/Personalprofile.html");
    } else {
        //弹窗提示用户名或密码错误
        echo "<script>alert('输入的信息有误！请重新尝试登录');</script>";
        header("refresh:0;url=../web/html/userlogin/userlogin.html");
    }
} else {
    //弹窗提示用户名或密码错误
    echo "<script>alert('输入的信息有误！请重新尝试登录');</script>";
    header("refresh:0;url=../web/html/userlogin/userlogin.html");
}



