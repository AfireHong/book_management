<?php
include_once 'conn.php';
if (empty($_SESSION['access'])) {
    die(json_encode(array('code' => -1, 'msg' => '无权限')));
}
$op = $_GET['s'];
$responseData = array("code" => 0, "msg" => "", "count" => 0, "data" => "");
switch ($op) {
    case 'getBookinfo':     //查询图书
        $book_name = $_GET['book_name'];
        $cate_id = $_GET['cate'];
        if ($book_name&&!$cate_id) {
            $sqlCount = "SELECT * FROM book where book_name like '%{$book_name}%'";
        } else if($book_name && $cate_id){
            $sqlCount = "SELECT * FROM book where book_name like '%{$book_name}%' AND cate_id='{$cate_id}'";
        } else if (!$book_name && $cate_id) {
            $sqlCount = "SELECT * FROM book where cate_id='{$cate_id}'";
        }else {
            $sqlCount = "SELECT * FROM book";
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
        if ($_SESSION['access'] == 1) { //如果是管理员
            if ($book_name&&!$cate_id) {
                $sql = "SELECT * FROM book left join cate USING(cate_id) where book_name like '%{$book_name}%' LIMIT {$page},{$limit}";
            } else if(!$book_name && $cate_id){
                $sql = "SELECT * FROM book left join cate USING(cate_id) where cate_id='{$cate_id}' LIMIT {$page},{$limit}";
            } else if ($book_name && $cate_id) {
                $sql = "SELECT * FROM book left join cate USING(cate_id) where book_name like '%{$book_name}%' AND cate_id='{$cate_id}' LIMIT {$page},{$limit}";
            } else {
                $sql = "SELECT * FROM book left join cate USING(cate_id) LIMIT {$page},{$limit}";
            }
        } else {
            if ($book_name && !$cate_id) {
                $sql = "SELECT isbn,call_num,book_name,book_author,publisher,cate_id,price,quantity,brrow_nums,cate_name FROM book left join cate USING(cate_id) where book_name like '%{$book_name}%' AND book_status = 0 LIMIT {$page},{$limit}";
            } else if (!$book_name && $cate_id) {
                $sql = "SELECT isbn,call_num,book_name,book_author,publisher,cate_id,price,quantity,brrow_nums,cate_name FROM book left join cate USING(cate_id) where cate_id='{$cate_id}' AND book_status = 0 LIMIT {$page},{$limit}";
            } else if ($book_name && $cate_id) {
                $sql = "SELECT isbn,call_num,book_name,book_author,publisher,cate_id,price,quantity,brrow_nums,cate_name FROM book left join cate USING(cate_id) where book_name like '%{$book_name}%' AND cate_id='{$cate_id}' AND book_status = 0 LIMIT {$page},{$limit}";
            } else {
                $sql = "SELECT isbn,call_num,book_name,book_author,publisher,cate_id,price,quantity,brrow_nums,cate_name FROM book left join cate USING(cate_id) where book_status = 0 LIMIT {$page},{$limit}";
            }
        }
        $res = $mySQLi->query($sql);
        $res_arr = $res->fetch_all(MYSQLI_ASSOC);
        $responseData["data"] = $res_arr;
        echo json_encode($responseData);
        break;

    case 'addBook':     //添加图书
        if ($_SESSION['access'] != 1) {
            die(json_encode(array('code' => -1, 'msg' => '无权限')));
        }
        $book_data = file_get_contents("php://input");
        $book_data = json_decode($book_data);
        //查询是否存在该图书，如果存在，则直接将数量加一
        $sql_c = "SELECT * FROM book WHERE isbn = '{$book_data->isbn}'";
        $result = $mySQLi->query($sql_c);
        if ($result->num_rows) {
            $sql_c = "UPDATE book SET quantity=quantity+1 WHERE isbn = '{$book_data->isbn}'";
            if ($mySQLi->query($sql_c)) {
                $responseData['msg'] = '已存在该书，系统自动将数量加一';
                echo json_encode($responseData);
            } else {
                $responseData['code'] = 1;
                $responseData['msg'] = '添加失败';
                echo json_encode($responseData);
            }
        } else {
            //不存在
            $sql = 'INSERT INTO book(isbn, book_name, book_author, call_num, publisher, cate_id, price, quantity) VALUES (?,?,?,?,?,?,?,?)';
            $stmt = $mySQLi->init();
            $stmt = $mySQLi->prepare($sql);
            $stmt->bind_param('sssssidi', $book_data->isbn, $book_data->call_num, $book_data->book_name, $book_data->book_author, $book_data->publisher, $book_data->cate, $book_data->price, $book_data->quantity);
            if ($stmt->execute()) {
                $responseData['msg'] = '添加成功';
                echo json_encode($responseData);
            } else {
                $responseData['code'] = 1;
                $responseData['msg'] = '添加失败';
                echo json_encode($responseData);
            }
        }
        break;
    case 'updateBook':
        if ($_SESSION['access'] != 1) {
            die(json_encode(array('code' => -1, 'msg' => '无权限')));
        }
        $book_data = file_get_contents("php://input");
        $book_data = json_decode($book_data);
        $sql = "UPDATE book SET book_name = '{$book_data->book_name}',
                                book_author = '{$book_data->book_author}',
                                publisher = '{$book_data->publisher}',
                                call_num = '{$book_data->call_num}',
                                cate_id = '{$book_data->cate}',
                                price = '{$book_data->price}',
                                quantity = '{$book_data->quantity}'
                            WHERE isbn = '{$book_data->isbn}'";
        if ($mySQLi->query($sql)) {
            $responseData['msg'] = '修改图书信息成功';
            echo json_encode($responseData);
        } else {
            $responseData['code'] = 1;
            $responseData['msg'] = '修改图书信息失败';
            echo json_encode($responseData);
        }
        break;
    case 'updateStatus':
        if ($_SESSION['access'] != 1) {
            die(json_encode(array('code' => -1, 'msg' => '无权限')));
        }
        $isbn = $_GET['isbn'];
        $status = $_GET['status'];
        function switchStatus($mySQLi, $status, $isbn)
        {
            $sql = 'UPDATE book SET book_status = ? WHERE isbn = ?';
            $stmt = $mySQLi->init();
            if ($status) {
                $statusCode = 0;
                $stmt = $mySQLi->prepare($sql);
                $stmt->bind_param('is', $statusCode, $isbn);
                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                $statusCode = 1;
                $stmt = $mySQLi->prepare($sql);
                $stmt->bind_param('is', $statusCode, $isbn);
                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        if (switchStatus($mySQLi, $status, $isbn)) {
            $responseData['msg'] = '修改状态成功';
            echo json_encode($responseData);
        } else {
            $responseData['code'] = 1;
            $responseData['msg'] = '修改状态失败';
            echo json_encode($responseData);
        }
    default:
        # code...
        break;
}
