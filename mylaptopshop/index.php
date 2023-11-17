<?php
    include 'helper.php';

    // Kết nối đến cơ sở dữ liệu
    db_connect();

   // Lấy danh sách sản phẩm từ cơ sở dữ liệu
   $sql = "SELECT * FROM laptops";
   $laptops = db_get_list($sql);

    // Đóng kết nối cơ sở dữ liệu
    db_disconnect();

    // Kiểm tra nếu có từ khóa tìm kiếm được gửi từ biểu mẫu
    if(isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];

        // Kết nối đến cơ sở dữ liệu
        db_connect();

        // Tìm kiếm sản phẩm dựa trên từ khóa
        $sql = "SELECT * FROM laptops WHERE name LIKE ?";
        $params = array('%' . $keyword . '%');
        $searchResults = db_get_list_condition($sql, $params);

        // Đóng kết nối cơ sở dữ liệu
        db_disconnect();
    } else {
        $searchResults = array(); // Khởi tạo mảng rỗng nếu không có từ khóa tìm kiếm
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Danh sách sản phẩm</title>
    <style>
        /* Reset CSS */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body styles */
body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f1f1f1;
    padding: 20px;
}

/* Header styles */
h1 {
    color: #333;
    font-size: 28px;
    margin-bottom: 20px;
}

/* Form styles */
form {
    margin-bottom: 20px;
}

label {
    /* display: block; */
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"] {
    width: 300px;
    padding: 5px;
    font-size: 14px;
}

input[type="submit"] {
    padding: 5px 10px;
    font-size: 14px;
    background-color: #333;
    color: #fff;
    border: none;
    cursor: pointer;
}

/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 8px;
    border: 1px solid #ccc;
}

th {
    background-color: #f2f2f2;
    font-weight: bold;
}

td {
    background-color: #fff;
}

/* Message styles */
p {
    color: #333;
    margin-bottom: 10px;
}

/* Link styles */
a {
    color: #333;
    text-decoration: none;
    margin-right: 10px;
    font-size: 14px;
}

a:hover {
    text-decoration: underline;
}
    </style>
</head>
<body>
    
<table>
    <tr><h1>Danh sách sản phẩm</h1></tr>
    <tr> 
    <form method="GET" action="timkiem.php" style="margin-left: 50%;">
    <label for="keyword">Từ khóa:</label>
    <input type="text" name="keyword" value="<?php echo isset($keyword) ? $keyword : ''; ?>">
    <input type="submit" value="Tìm kiếm">
</form>




    </tr>
</table>
    <table>
        <tr>
            <th>Tên danh mục</th>
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Giá sản phẩm</th>
            <th>Thao tác</th>
        </tr>
        <?php foreach($laptops as $laptop): ?>
        <tr>
            <td><?php echo $laptop['category']; ?></td>
            <td><?php echo $laptop['product_code']; ?></td>
            <td><?php echo $laptop['product_name']; ?></td>
            <td><?php echo $laptop['price']; ?></td>
            <td>
                <a href="sua.php?id=<?php echo $laptop['id']; ?>">Sửa</a>
                <a href="xoa.php?id=<?php echo $laptop['id']; ?>">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="them.php">Thêm sản phẩm</a>
</form>

    

    
   

   
</body>
</html>