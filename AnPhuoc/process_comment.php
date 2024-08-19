<?php 
    // Kết nối đến cơ sở dữ liệu (đảm bảo bạn đã có kết nối tới cơ sở dữ liệu ở trước đó)
    include("ketnoi.php");

    // Kiểm tra xem người dùng đã nhấn nút đăng bình luận chưa
    if (isset($_POST['submit'])) {
        // Lấy dữ liệu từ form
        $username = $_POST['username'];
        $masp = $_POST['masp'];
        $comment = $_POST['comment'];
        $created_at = date('Y-m-d H:i:s'); // Lấy thời gian hiện tại

        // Chuẩn bị câu lệnh SQL để chèn bình luận vào bảng comment
        $sql = "INSERT INTO comment (masp, username, comment, created_at) VALUES (?, ?, ?, ?)";

        try {
            // Prepare statement
            $stmt = $con->prepare($sql);
            // Bind parameters
            $stmt->bindParam(1, $masp);
            $stmt->bindParam(2, $username);
            $stmt->bindParam(3, $comment);
            $stmt->bindParam(4, $created_at);
            // Execute statement
            $stmt->execute();
            // Nếu thêm bình luận thành công, hiển thị cảnh báo
            echo '<script>alert("Bình luận của bạn đã được đăng thành công!");</script>';
            header("Location: HomePage.php");
            exit();

        } catch(PDOException $e) {
            // Nếu có lỗi, hiển thị thông báo lỗi
            echo "Đã xảy ra lỗi khi đăng bình luận: " . $e->getMessage();
        }
    }
?>
