<?php
   
   include("ketnoi.php");
    if(isset($_POST['madon']) && isset($_POST['masp'])) {
        $madon = $_POST['madon'];
        $masp = $_POST['masp'];

        // Xóa chi tiết đơn hàng từ bảng chitietdonhang
        $sql_delete_chitiet = "DELETE FROM chitietdonhang WHERE madon = :madon AND masp = :masp";
        $stmt_delete_chitiet = $con->prepare($sql_delete_chitiet);
        $stmt_delete_chitiet->bindParam(':madon', $madon);
        $stmt_delete_chitiet->bindParam(':masp', $masp);
        $stmt_delete_chitiet->execute();

        // Chuyển hướng người dùng sau khi xóa thành công
        header("Location: order.php");
        exit();
    }
?>
