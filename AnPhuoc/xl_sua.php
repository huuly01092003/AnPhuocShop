<?php
// Include connection file
include("ketnoi.php");

// Check for product code
if (isset($_GET['masp'])) {
  $masp = $_GET['masp'];
  try {
    $stmt = $con->prepare("SELECT * FROM sanpham WHERE masp = ?");
    $stmt->execute([$masp]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Get product types
    $stmt_loai = $con->prepare("SELECT * FROM loai");
    $stmt_loai->execute();
    $loai_sanpham = $stmt_loai->fetchAll(PDO::FETCH_ASSOC);

    // Update product if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Process and validate form data
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

      try {
        $stmt = $con->prepare("UPDATE sanpham SET tensp=?, maloai=?, giaban=?, trangthai=?, anh=?, listanh=?, mota=? WHERE masp=?");
        $stmt->execute([$tensp, $maloai, $giaban, $trangthai, $anh, $listanh,$mota, $masp]);
		$stmt1 = $con->prepare("UPDATE chitietsize SET soluong = ? WHERE chitietsize.masp=? and size_id = 1");
        $stmt1->execute([$size1, $masp]);
		$stmt2 = $con->prepare("UPDATE chitietsize SET soluong = ? WHERE chitietsize.masp=? and size_id = 2");
        $stmt2->execute([$size2, $masp]);
		$stmt3 = $con->prepare("UPDATE chitietsize SET soluong = ? WHERE chitietsize.masp=? and size_id = 3");
        $stmt3->execute([$size3, $masp]);
		$stmt4 = $con->prepare("UPDATE chitietsize SET soluong = ? WHERE chitietsize.masp=? and size_id = 4");
        $stmt4->execute([$size4, $masp]);
        header("Location: admin.php");
        exit();
      } catch (PDOException $e) {
        echo "Lỗi khi cập nhật thông tin sản phẩm: " . $e->getMessage();
      }
    }
  } catch (PDOException $e) {
    echo "Lỗi khi lấy thông tin sản phẩm: " . $e->getMessage();
    die(); // Exit after displaying error
  }
} else {
  echo "Không có mã sản phẩm được chỉ định";
  die(); // Exit after displaying error
}
?>
