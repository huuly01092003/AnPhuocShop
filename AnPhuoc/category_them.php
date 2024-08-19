<?php
// Kết nối cơ sở dữ liệu (đảm bảo ketnoi.php cùng thư mục)
include("ketnoi.php");

// Kiểm tra xem người dùng đã gửi dữ liệu POST chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $tenloai = $_POST['tenloai'];
    $maloai = $_POST['maloai'];

    // Chuẩn bị câu lệnh SQL để thêm sản phẩm vào CSDL
    $sql = "INSERT INTO loai VALUES (:maloai, :tenloai)";
    
    // Chuẩn bị và thực thi truy vấn
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':maloai', $maloai);
    $stmt->bindParam(':tenloai', $tenloai);

    // Thực thi truy vấn và kiểm tra kết quả
    if ($stmt->execute()) {
        echo "Thêm thành công.";
		header("Location: /AnPhuoc/product_type.php");
    } else {
        echo "Có lỗi xảy ra khi thêm.";
    }
}
?>

