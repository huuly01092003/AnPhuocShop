<?php
    session_start();

    // Kiểm tra xem người dùng đã chọn phạm vi giá hay không
    if(isset($_GET['price_range'])) {
        // Nếu có, lấy giá trị phạm vi giá từ tham số trong URL
        $price_range = $_GET['price_range'];
        // Chuyển hướng người dùng đến trang này để lọc sản phẩm
        header("Location: filter_price_result.php?price_range=$price_range");
        exit(); // Dừng kịch bản
    } else {
        // Nếu không có phạm vi giá được chọn, chuyển hướng người dùng đến trang chính
        header("Location: HomePage.php");
        exit(); // Dừng kịch bản
    }
?>
