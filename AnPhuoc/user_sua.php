<?php
// Include connection file
include("ketnoi.php");

// Check for product code
if (isset($_GET['username'])) {
  $username = $_GET['username'];
  try {
    $stmt = $con->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Get product types
    $stmt_loai = $con->prepare("SELECT * FROM loai");
    $stmt_loai->execute();
    $loai_sanpham = $stmt_loai->fetchAll(PDO::FETCH_ASSOC);

    // Update product if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Process and validate form data
      $pass = $_POST['pass'];
      $hoten = $_POST['hoten'];
      $email = $_POST['email'];
      $diachi = $_POST['diachi'];
	  $sdt = $_POST['sdt'];

      try {
        $stmt = $con->prepare("UPDATE users SET pass=?, hoten=?, sdt=?, diachi=?, email=? WHERE username=?");
        $stmt->execute([$pass, $hoten, $email, $diachi, $sdt, $username]);
        header("Location: /AnPhuoc/admin_user.php");
        exit();
      } catch (PDOException $e) {
        echo "Lỗi khi cập nhật thông tin khách hàng: " . $e->getMessage();
      }
    }
  } catch (PDOException $e) {
    echo "Lỗi khi lấy thông tin khách hàng: " . $e->getMessage();
    die(); // Exit after displaying error
  }
} else {
  echo "Không có mã khách hàng được chỉ định";
  die(); // Exit after displaying error
}
?>
