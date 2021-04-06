<?php
    header('content-type:text/html;charset="utf-8"');

    //var_dump($_POST);
    
    //定义一个统一的返回格式
    $responseData = array("code" => 0, "message" => "");

    //现将通过post提交的数据全部取出
    $username = $_POST['username'];
    $password = $_POST['password'];

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


    $link = mysql_connect("localhost","root","123456");

     //判断是否连接成功
     if(!$link){
        $responseData['code'] = 3;
        $responseData['message'] = "服务器忙";
        echo json_encode($responseData);
        exit;
    }

    //设置字符集
    mysql_set_charset("utf8");

    //选择数据库
    mysql_select_db("xiaomi");

    //准备sql语句进行登录
    //密码要加密
    $str = md5(md5(md5($password)."beijing")."zhongguo");

    $sql = "select * from users where username='{$username}' and password='{$str}'";

    $res = mysql_query($sql);

    //取出一行数据
    $row = mysql_fetch_assoc($res);

    if(!$row){
        $responseData['code'] = 4;
        $responseData['message'] = "用户名或密码错误";
        echo json_encode($responseData);
        exit;
    }else{
        $responseData['message'] = "登录成功";
        echo json_encode($responseData);
    }

    mysql_close($link);


?>