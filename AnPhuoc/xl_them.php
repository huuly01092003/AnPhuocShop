<?php
// Kết nối cơ sở dữ liệu (đảm bảo ketnoi.php cùng thư mục)
include("ketnoi.php");

// Kiểm tra xem người dùng đã gửi dữ liệu POST chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $masp = $_POST['masp'];
    $tensp = $_POST['tensp'];
    $maloai = $_POST['maloai'];
    $size1 = $_POST['size1'];
	$size2 = $_POST['size2'];
	$size3 = $_POST['size3'];
	$size4 = $_POST['size4'];
    $giaban = $_POST['giaban'];
    $trangthai = $_POST['trangthai'];
    $anh = $_POST['anh'];
	$listanh = $_POST['listanh'];
	$mota = $_POST['mota'];

    // Chuẩn bị câu lệnh SQL để thêm sản phẩm vào CSDL
    $sql = "INSERT INTO sanpham (masp, tensp, maloai, giaban, trangthai, anh, listanh, mota) VALUES (:masp, :tensp, :maloai, :giaban, :trangthai, :anh, :listanh, :mota)";
    
    // Chuẩn bị và thực thi truy vấn
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':masp', $masp);
    $stmt->bindParam(':tensp', $tensp);
    $stmt->bindParam(':maloai', $maloai);
    $stmt->bindParam(':giaban', $giaban);
    $stmt->bindParam(':trangthai', $trangthai);
    $stmt->bindParam(':anh', $anh);
    $stmt->bindParam(':listanh', $listanh);
    $stmt->bindParam(':mota', $mota);

	$sql_size1 = "INSERT INTO chitietsize (masp, size_id, soLuong) VALUES (:masp, 1, :soluong)";
	$stmt_size1 = $con->prepare($sql_size1);
    $stmt_size1->bindParam(':masp', $masp);
    $stmt_size1->bindParam(':soluong', $size1);
	
	$sql_size2 = "INSERT INTO chitietsize (masp, size_id, soLuong) VALUES (:masp, 2, :soluong)";
	$stmt_size2 = $con->prepare($sql_size2);
    $stmt_size2->bindParam(':masp', $masp);
    $stmt_size2->bindParam(':soluong', $size2);
	
	$sql_size3 = "INSERT INTO chitietsize (masp, size_id, soLuong) VALUES (:masp, 3, :soluong)";
	$stmt_size3 = $con->prepare($sql_size3);
    $stmt_size3->bindParam(':masp', $masp);
    $stmt_size3->bindParam(':soluong', $size3);
	
	$sql_size4 = "INSERT INTO chitietsize (masp, size_id, soLuong) VALUES (:masp, 4, :soluong)";
	$stmt_size4 = $con->prepare($sql_size4);
    $stmt_size4->bindParam(':masp', $masp);
    $stmt_size4->bindParam(':soluong', $size4);
    // Thực thi truy vấn và kiểm tra kết quả
    if ($stmt->execute() && $stmt_size1->execute() && $stmt_size2->execute() && $stmt_size3->execute() && $stmt_size4->execute()) {
        echo '<script>alert("Thêm sản phẩm thành công."); window.location.href="admin.php";</script>';
        exit; // Dừng thực thi của mã PHP sau khi chuyển hướng
    } else {
        echo "Có lỗi xảy ra khi thêm sản phẩm.";
    }
}
?>
