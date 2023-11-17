<?php
    include 'helper.php';

    // Kiểm tra nếu có ID sản phẩm được truyền từ URL
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        // Kết nối đến cơ sở dữ liệu
        db_connect();

        // Xóa sản phẩm từ cơ sở dữ liệu
        $sql = "DELETE FROM laptops WHERE id = ?";
        $params = array($id);
        db_execute($sql, $params);

        // Đóng kết nối cơ sở dữ liệu
        db_disconnect();

        // Chuyển hướng về trang chủ
        redirect('index.php');
      
    }
?>