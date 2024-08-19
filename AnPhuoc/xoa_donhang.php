<?php
    
    include("ketnoi.php");
    if(isset($_POST['madon'])) {
        $madon = $_POST['madon'];
        
        // Xóa đơn hàng từ bảng donhang
        $sql_delete_donhang = "DELETE FROM donhang WHERE madon = :madon";
        $stmt_delete_donhang = $con->prepare($sql_delete_donhang);
        $stmt_delete_donhang->bindParam(':madon', $madon);
        $stmt_delete_donhang->execute();

        // Xóa chi tiết đơn hàng từ bảng chitietdonhang
        $sql_delete_chitiet = "DELETE FROM chitietdonhang WHERE madon = :madon";
        $stmt_delete_chitiet = $con->prepare($sql_delete_chitiet);
        $stmt_delete_chitiet->bindParam(':madon', $madon);
        $stmt_delete_chitiet->execute();

        // Chuyển hướng người dùng sau khi xóa thành công
        header("Location: order.php");
        exit();
    }
?>
