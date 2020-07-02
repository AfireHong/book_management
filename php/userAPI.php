<?php
/*
 * @Author: your name
 * @Date: 2020-06-21 19:32:54
 * @LastEditTime: 2020-07-02 23:10:05
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: \books_management\php\userAPI.php
 */ 
include_once 'conn.php';
if (empty($_SESSION['access'])||$_SESSION['access']!=1) {
    die(json_encode(array('code' => -1, 'msg' => '无权限')));
}
$op = $_GET['s'];
$responseData = array("code" => 0, "msg" => "", "count" => 0, "data" => "");

switch ($op) {
    case 'getUserInfo':
        $tel = $_GET['tel'];
        if ($tel) {
            $sqlCount = "SELECT * FROM user where tel like '%{$tel}%' AND access_id = 2";
        }else {
            $sqlCount = "SELECT * FROM user WHERE access_id = 2";
        }
        $resCount = $mySQLi->query($sqlCount);
        //$resCount = $resCount->fetch_all();
        $responseData["count"] = $resCount->num_rows;

        if ($_GET['limit']) {
            $limit = $_GET['limit'];
        } else {
            $limit = 20;
        }
        if ($_GET['page']) {
            $page = ($_GET['page'] - 1) * $limit;
        } else {
            $page = 0;
        }
        if($tel){
            $sql = "SELECT user_id,user_name,tel,email,user_status,borrow_times,access_id,overdue_times FROM user WHERE tel like '%{$tel}%' AND access_id = 2 LIMIT {$page}, {$limit}";
        }else{
            $sql = "SELECT user_id,user_name,tel,email,user_status,borrow_times,access_id,overdue_times FROM user WHERE access_id = 2 LIMIT {$page}, {$limit}";
        }
        if($res = $mySQLi->query($sql)){
            $res_arr = $res->fetch_all(MYSQLI_ASSOC);
            $responseData['data'] = $res_arr;
            echo json_encode($responseData);
        }else{
            $responseData['code']=-1;
            $responseData['msg'] = '请求失败';
            echo $mySQLi->error;
            echo json_encode($responseData);
        }
        
        
        # code...
        break;
    case 'updateUser':
        if ($_SESSION['access'] != 1) {
            die(json_encode(array('code' => -1, 'msg' => '无权限')));
        }
        $user_data = file_get_contents("php://input");
        $user_data = json_decode($user_data);
        $sql = "UPDATE user SET user_name = '{$user_data->user_name}',tel = '{$user_data->tel}',email = '{$user_data->email}'
                            WHERE user_id = {$user_data->user_id}";
        if ($mySQLi->query($sql)) {
            $responseData['msg'] = '修改信息成功';
            echo json_encode($responseData);
        } else {
            // echo $sql;
            // echo $mySQLi->error;
            $responseData['code'] = 1;
            $responseData['msg'] = '修改信息失败';
            echo json_encode($responseData);
        }
        break;
    case 'addUser':
        if ($_SESSION['access'] != 1) {
            die(json_encode(array('code' => -1, 'msg' => '无权限')));
        }
        $user_data = file_get_contents("php://input");
        $user_data = json_decode($user_data);
        //默认密码
        $pwd = '8888';
        $repwd = md5($pwd);
        $sql = "INSERT INTO user(user_name,tel,email,password) VALUES ('{$user_data->user_name}', '{$user_data->tel}', '{$user_data->email}', '{$repwd}')";
        if($mySQLi->query($sql)){
            $responseData['msg'] = '添加用户成功，用户名为：'. $user_data->user_name.'。默认密码为：'.$pwd.'。请登陆后修改密码！';
            echo json_encode($responseData);
        }else{
            $responseData['code'] = 1;
            $responseData['msg'] = '添加用户失败，请检查格式是否正确';
            echo json_encode($responseData);
            //echo $mySQLi->error;
        }
        break;
    case 'updateStatus':
        if ($_SESSION['access'] != 1) {
            die(json_encode(array('code' => -1, 'msg' => '无权限')));
        }
        $user_id = $_GET['user_id'];
        $status = $_GET['status'];
        function switchStatus($mySQLi, $status, $user_id)
        {
            $sql = 'UPDATE user SET user_status = ? WHERE user_id = ?';
            $stmt = $mySQLi->init();
            if ($status) {
                $statusCode = 0;
                $stmt = $mySQLi->prepare($sql);
                $stmt->bind_param('ii', $statusCode, $user_id);
                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                $statusCode = 1;
                $stmt = $mySQLi->prepare($sql);
                $stmt->bind_param('ii', $statusCode, $user_id);
                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        if (switchStatus($mySQLi, $status, $user_id)) {
            $responseData['msg'] = '修改状态成功';
            //echo $sql;
            echo json_encode($responseData);
        } else {
            $responseData['code'] = 1;
            $responseData['msg'] = '修改状态失败';
            echo json_encode($responseData);
        }
        break;
    case 'resetPwd':
        $user_id = $_POST['user_id'];
        $repwd = $_POST['password'];
        $pwd = md5($repwd);
        $sql = "UPDATE user SET password = '{$pwd}' WHERE user_id = '{$user_id}'";
        if($mySQLi->query($sql)){
            $responseData['msg'] = '重置成功';
            echo json_encode($responseData);
        }else{
            $responseData['code'] = 1;
            $responseData['msg'] = '重置失败';
            echo json_encode($responseData);
        }
        break;
    
    default:
        # code...
        break;
}
?>
