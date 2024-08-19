<?php
// Include connection file
include("ketnoi.php");

// Check for product code
if (isset($_GET['maloai'])) {
  $maloai = $_GET['maloai'];
  try {
    $stmt = $con->prepare("SELECT * FROM loai WHERE maloai = ?");
    $stmt->execute([$maloai]);
    $product_type = $stmt->fetch(PDO::FETCH_ASSOC);

    // Get product types
    $stmt_loai = $con->prepare("SELECT * FROM loai");
    $stmt_loai->execute();
    $loai_sanpham = $stmt_loai->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Process and validate form data
      $tenloai = $_POST['tenloai'];

      try {
        $stmt = $con->prepare("UPDATE loai SET tenloai=? WHERE maloai=?");
        $stmt->execute([$tenloai, $maloai]);
        header("Location: product_type.php");
        exit();
      } catch (PDOException $e) {
        echo "Lỗi khi cập nhật thông tin loại sản phẩm: " . $e->getMessage();
      }
    }
  } catch (PDOException $e) {
    echo "Lỗi khi lấy thông tin loại sản phẩm: " . $e->getMessage();
    die(); // Exit after displaying error
  }
} else {
  echo "Không có mã loại được chỉ định";
  die(); // Exit after displaying error
}
?>
