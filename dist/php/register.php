<?php
    header('content-type:text/html;charset="utf-8"');

    //var_dump($_POST);
    
    //定义一个统一的返回格式
    $responseData = array("code" => 0, "message" => "");

    //现将通过post提交的数据全部取出
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $createtime = $_POST['createtime'];

    //对后台接收到的数据进行一个简单的判断
    if(!$username){
        $responseData["code"] = 1;
        $responseData["message"] = "用户名不能为空";
        //将数据按照统一的返回格式返回
        echo json_encode($responseData);
        exit;
    }

    if(!$password){
        $responseData["code"] = 2;
        $responseData["message"] = "密码不能为空";
        //将数据按照统一的返回格式返回
        echo json_encode($responseData);
        exit;
    }

    if($password != $repassword){
        $responseData["code"] = 3;
        $responseData["message"] = "两次密码不一致";
        //将数据按照统一的返回格式返回
        echo json_encode($responseData);
        exit;
    }

    $link = mysql_connect("localhost","root","123456");

     //判断是否连接成功
     if(!$link){
        $responseData['code'] = 4;
        $responseData['message'] = "服务器忙";
        echo json_encode($responseData);
        exit;
    }

    //设置字符集
    mysql_set_charset("utf8");

    //选择数据库
    mysql_select_db("xiaomi");

    //准备sal语句验证是否注册过
    $sql = "select * from users where username='{$username}'";

    //发送sql语句
    $res = mysql_query($sql);

    //var_dump($res);
    //取出一行数据
    $row = mysql_fetch_assoc($res);
    if($row){
        $responseData['code'] = 5;
        $responseData['message'] = "用户名重名";
        echo json_encode($responseData);
        exit;
    }

    //密码加密
    $str = md5(md5(md5($password)."beijing")."zhongguo");

    //可以注册
    $sql2 = "insert into users(username,password,createtime) values('{$username}','{$str}',{$createtime})" ;
    // echo $sql2;

    $res2 = mysql_query($sql2);

    if(!$sql2){
        //插入失败
        $responseData['code'] = 6;
        $responseData['message'] = "注册失败";
        echo json_encode($responseData);
        exit;
    }

    $responseData['message'] = "注册成功";
    echo json_encode($responseData);

    //关闭数据
    mysql_close($link);

?>