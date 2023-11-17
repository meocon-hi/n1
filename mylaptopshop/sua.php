<?php
    include 'helper.php';

    // Kiểm tra nếu có ID sản phẩm được truyền từ URL
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        // Kết nối đến cơ sở dữ liệu
        db_connect();

        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $sql = "SELECT * FROM laptops WHERE id = ?";
        $params = array($id);
        $laptops = db_get_row($sql, $params);

        // Đóng kết nối cơ sở dữ liệu
        db_disconnect();

        // Kiểm tra nếu sản phẩm tồn tại
        if($laptops) {
            // Xử lý sửa thông tin sản phẩm
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = $_POST['product_name'];
                $price = $_POST['price'];

                // Kết nối đến cơ sở dữ liệu
                db_connect();

                // Cập nhật thông tin sản phẩm trong cơ sở dữ liệu
                $sql = "UPDATE laptops SET product_name = ?, price = ? WHERE id = ?";
                $params = array($name, $price, $id);
                db_execute($sql, $params);

                // Đóng kết nối cơ sở dữ liệu
                db_disconnect();

                // Chuyển hướng về trang chủ
                header('Location: index.php');
                exit();
            }
        } else {
            echo "Không tìm thấy sản phẩm.";
        }
    } else {
        echo "Thiếu ID sản phẩm.";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sửa thông tin sản phẩm</title>
</head>
<body>
    <h1>Sửa thông tin sản phẩm</h1>

    <form method="POST" action="">
        <label for="name">Tên sản phẩm:</label>
        <input type="text" name="product_name" value="<?php echo $laptops['product_name']; ?>"><br>

        <label for="price">Giá sản phẩm:</label>
        <input type="text" name="price" value="<?php echo $laptops['price']; ?>"><br>

        <input type="submit" value="Lưu">
    </form>
</body>
</html>