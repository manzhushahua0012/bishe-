<?php
header("Content-Type: text/html;charset=utf-8");
//声明变量用
$account = isset($_POST['account']) ? $_POST['account'] : "";
$phone = isset($_POST['phone']) ? $_POST['phone'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$password1 = isset($_POST['password1']) ? $_POST['password1'] : "";
//判定用户名和email是否为空
if (!empty($account) && !empty($phone)) {
    //建立连接
    $ini= parse_ini_file("con.ini");
    $conn =new mysqli($ini["servername"],$ini["username"],$ini["password"],$ini["dbname"]) or die("连接失败<br/>");
    //设置字符集
    $conn->query("set names utf8");
    //查询数据库
    $sql = "select * from user where account='$account' and phone='$phone'";
    $result = $conn->query($sql);
    //判定是否存在该用户
    if ($result->num_rows > 0) {
        //在判断传输过来的密码是否与数据库中的密码一致
        $row = $result->fetch_assoc();
        if ($password == $row['password']) {
            //设置session
            session_start();
            $_SESSION['account'] = $account;
            $_SESSION['phone'] = $phone;
            $_SESSION['password'] = $password;
            //如果一样提示密码重复
            echo "<script>alert('密码重复，请前往登录');location.href='../web/html/login/login.html';</script>";
        } else {
            //如果不一样就把新密码更新到原来的的用户名的密码
            $sql = "update user set password='$password' where account='$account'";
            $result = $conn->query($sql);
            if ($result) {
                //如果更新成功就提示密码更新成功
                echo "<script>alert('密码更新成功，请前往登录');location.href='../web/html/login/login.html';</script>";
            } else {
                //如果更新失败就提示密码更新失败
                echo "<script>alert('密码更新失败，请重新尝试');location.href='../web/html/find/find.html';</script>";
            }
        }
    } else {
        //如果不存在该用户就提示用户不存在
        echo "<script>alert('用户不存在，请前往注册');location.href='../web/html/register/register.html';</script>";
    }
}else{
    //如果用户名和email为空就提示用户名和email不能为空
    echo "<script>alert('用户名和手机号不能为空');location.href='../web/html/find/find.html';</script>";
}


