<?php
    // Kết nối đến cơ sở dữ liệu
    include 'helper.php';
    db_connect();

    // Kiểm tra nếu có dữ liệu gửi từ biểu mẫu
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lấy dữ liệu từ biểu mẫu
        $category = $_POST['category'];
        $productCode = $_POST['product_code'];
        $productName = $_POST['product_name'];
        $price = $_POST['price'];

        // Thực hiện truy vấn để thêm sản phẩm vào cơ sở dữ liệu
        $sql = "INSERT INTO laptops (category, product_code, product_name, price) VALUES (?, ?, ?, ?)";
        $params = array($category, $productCode, $productName, $price);
        $result = db_execute($sql, $params);

        if ($result) {
            // Chuyển hướng về trang danh sách sản phẩm sau khi thêm thành công
            header('Location: index.php');
            exit;
        } else {
            // Xử lý lỗi nếu có
            $errorMessage = "Đã xảy ra lỗi khi thêm sản phẩm.";
        }
    }

    // Đóng kết nối cơ sở dữ liệu
    db_disconnect();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm sản phẩm</title>
    <style>
        /* Form styles */
form {
    margin-bottom: 20px;
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 5px;
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

input[type="text"] {
    width: 300px;
    padding: 5px;
    font-size: 14px;
    margin-bottom: 10px;
}

input[type="submit"] {
    padding: 5px 10px;
    font-size: 14px;
    background-color: #333;
    color: #fff;
    border: none;
    cursor: pointer;
}

/* Error message styles */
p.error-message {
    color: red;
    margin-top: 10px;
}

/* Heading styles */
h1 {
    color: #333;
    font-size: 28px;
    margin-bottom: 20px;
}
    </style>
</head>
<body>
    <h1>Thêm sản phẩm</h1>

    <?php if(isset($errorMessage)): ?>
        <p><?php echo $errorMessage; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="category">Danh mục:</label>
        <input type="text" name="category" required>

        <label for="product_code">Mã sản phẩm:</label>
        <input type="text" name="product_code" required>

        <label for="product_name">Tên sản phẩm:</label>
        <input type="text" name="product_name" required>

        <label for="price">Giá sản phẩm:</label>
        <input type="text" name="price" required>

        <input type="submit" value="Thêm">
    </form>
</body>
</html>