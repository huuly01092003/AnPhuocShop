<?php
session_start();
include("ketnoi.php");

// Kiểm tra xem dữ liệu form đã được gửi qua phương thức POST chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Lấy thông tin sản phẩm từ mảng $_POST['products']
    if (isset($_POST['products']) && is_array($_POST['products'])) {
        foreach ($_POST['products'] as $product_info) {
            $product_name = $product_info['name'];
            $product_size = $product_info['size'];
            $product_quantity = $product_info['quantity'];

        }
    }

    // Lấy thông tin khách hàng từ form
    $full_name = htmlspecialchars($_POST['full_name'] ?? ''); // Chống XSS
    $email = htmlspecialchars($_POST['email'] ?? ''); // Chống XSS
    $phone = htmlspecialchars($_POST['phone'] ?? ''); // Chống XSS
    $address = htmlspecialchars($_POST['address'] ?? ''); // Chống XSS
    $total_price = $_POST['total_price'] ?? '';
    $payment_method = $_POST['paymentMethod'] ?? '';

    // Lấy tên người dùng từ session
    $username = $_SESSION['username'] ?? '';

    // Chuyển đổi dữ liệu đầu vào từ chuỗi sang số thực và định dạng lại dữ liệu số thực
    $total_price = floatval(str_replace(',', '', $total_price));
    $total_price_formatted = number_format($total_price, 2, '.', '');

    try {
        // Bắt đầu một giao dịch
        $con->beginTransaction();

        // Chèn thông tin đơn hàng vào bảng donhang
        $sql_insert_order = "INSERT INTO donhang (username, ngaydat, tongtien, diachi, trangthai, phuongthucthanhtoan) VALUES (?, NOW(), ?, ?, 'Chờ xử lý', ?)";
        $stmt_insert_order = $con->prepare($sql_insert_order);
        $stmt_insert_order->execute([$username, $total_price_formatted, $address, $payment_method]);
        $order_id = $con->lastInsertId(); // Lấy ID đơn hàng tự tăng

        // Chèn chi tiết đơn hàng vào bảng chitietdonhang
        foreach ($_POST['products'] as $product_info) {
            $product_name = $product_info['name'];
            $product_quantity = $product_info['quantity'];
            $product_size = $product_info['size'];

            // Lấy mã sản phẩm từ tên sản phẩm
            $sql_get_product_id = "SELECT masp FROM sanpham WHERE tensp = ?";
            $stmt_get_product_id = $con->prepare($sql_get_product_id);
            $stmt_get_product_id->execute([$product_name]);
            $product_id = $stmt_get_product_id->fetchColumn();

            $sql_get_size_id = "SELECT size_id FROM size WHERE size = ?";
            $stmt_get_size_id = $con->prepare($sql_get_size_id);
            $stmt_get_size_id->execute([$product_size]);
            $size_id = $stmt_get_size_id->fetchColumn();

            // Chèn chi tiết đơn hàng vào bảng chitietdonhang
            $sql_insert_order_detail = "INSERT INTO chitietdonhang (madon, masp, soluong,size_id) VALUES (?, ?, ?,?)";
            $stmt_insert_order_detail = $con->prepare($sql_insert_order_detail);
            $stmt_insert_order_detail->execute([$order_id, $product_id, $product_quantity,$size_id]);
        }

        // Commit giao dịch nếu mọi thứ diễn ra suôn sẻ
        $con->commit();

        // Chuyển hướng đến trang thành công hoặc hiển thị thông báo thành công
        header("Location: success.php");
        exit;
    } catch (PDOException $e) {
        // Nếu xảy ra lỗi, rollback giao dịch
        $con->rollback();
        // Chuyển hướng đến trang lỗi hoặc hiển thị thông báo lỗi
        header("Location: error.php?message=" . urlencode($e->getMessage()));
        exit;
    }
}
?>
