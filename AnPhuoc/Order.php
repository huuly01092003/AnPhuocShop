<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Order Management</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="css/Style_1.css" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<style>
    /* Select Styles */
    select {
        width: 150px;
        padding: 8px;
        margin: 4px 2px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: white;
        font-size: 14px;
        cursor: pointer;
    }

    select:hover {
        border-color: #4CAF50;
    }

    select:focus {
        outline: none;
        border-color: #4CAF50;
        box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
    }
</style>
<?php 
    include("ketnoi.php");
    
    // Lấy thông tin các đơn hàng cùng với số điện thoại từ bảng users
    $sql_donhang = "SELECT donhang.*, users.sdt FROM donhang INNER JOIN users ON donhang.username = users.username";
    $sta_donhang = $con->query($sql_donhang);
    
    // Kiểm tra có dữ liệu hay không
    if($sta_donhang->rowCount() > 0) {
        $DonHang = $sta_donhang->fetchAll(PDO::FETCH_OBJ);
    }

    // Lấy thông tin chi tiết đơn hàng cho mỗi đơn hàng
    foreach ($DonHang as $dh) {
        $sql_chitiet = "SELECT chitietdonhang.*, sanpham.tensp, sanpham.giaban FROM chitietdonhang INNER JOIN sanpham ON chitietdonhang.masp = sanpham.masp WHERE chitietdonhang.madon = :madon";
        $stmt_chitiet = $con->prepare($sql_chitiet);
        $stmt_chitiet->bindParam(':madon', $dh->madon);
        $stmt_chitiet->execute();
        $ChiTietDonHang[$dh->madon] = $stmt_chitiet->fetchAll(PDO::FETCH_OBJ);
    }

    // Xử lý khi nút "Cập nhật trạng thái" được nhấn
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
        $madon = $_POST['madon'];
        $new_status = $_POST['trangthai'];

        // Cập nhật trạng thái đơn hàng trong cơ sở dữ liệu
        $sql_update_status = "UPDATE donhang SET trangthai = :trangthai WHERE madon = :madon";
        $stmt_update = $con->prepare($sql_update_status);
        $stmt_update->bindParam(':trangthai', $new_status);
        $stmt_update->bindParam(':madon', $madon);

        if ($stmt_update->execute()) {
            echo "<script>alert('Cập nhật trạng thái thành công!'); window.location.href='order.php';</script>";
        } else {
            echo "<script>alert('Cập nhật trạng thái thất bại');</script>";
        }
    }

?>  

<body>
    <div class="header">
        <div class="top-header">
            <img src="img/anPhuoc_logo.png" alt="phone_icon" style="appearance: none;display: block;background-position: 50%;background-repeat: no-repeat;width: 100px;height: 70px; padding-left: 60px; padding-right: 60px; align-self: center">
            <div style="border: 1px solid #ffffff; border-radius: 5px; width: 133px;height: 38;display: flex; flex-direction: row; align-self: center; align-content: center; padding-right: 5px;margin-left:20px">
                <img src="img/user_icon.png" alt="phone_icon" style="appearance: none;display: block;background-position: 50%;background-repeat: no-repeat;width: 20px;height: 20px; padding-left: 20px; padding-right: 20px; align-self: center; padding-bottom: 10px; padding-top: 10px">
                <a href="./cart.php"><span>ADMIN</span></a>
            </div>
            <div style="padding-right: 20px"></div>
        </div>
        <div class="bottom-header">
            <div style="width: 100px"></div>
            <div class="section"><a href="HomePage.php">an phuoc</a></div>
            <div class="section"><a href="admin.php">product</a></div>
            <div class="section"><a href="product_type.php">category</a></div>
            <div class="section"><a href="admin_user.php">user</a></div>
            <div class="section"><a href="Order.php">order</a></div>
            <div style="width: 100px"></div>
        </div>
    </div>
    <div class="content">
        <div class="main">
            <table width="1000px" align="center">
                <tbody>
                    <caption><h1>THÔNG TIN ĐƠN HÀNG</h1></caption>
                  
                    <tr bgcolor="#999999" align="center">
                        <td><strong>Mã đơn hàng</strong></td>
                        <td><strong>Người đặt</strong></td>
                        <td><strong>Số điện thoại</strong></td> <!-- Thêm cột số điện thoại -->
                        <td><strong>Ngày đặt</strong></td>
                        <td><strong>Tổng tiền</strong></td>
                        <td><strong>Trạng thái</strong></td>
                        <td><strong>Phương thức thanh toán</strong></td>
                        <td><strong>Địa chỉ</strong></td>
                        <td><strong>CRUD</strong></td>
                    </tr>
                    <?php foreach($DonHang as $dh){ ?>
                    <tr align="center">
                        <td><?php echo $dh->madon ?></td>
                        <td><?php echo $dh->username ?></td>
                        <td><?php echo $dh->sdt ?></td> <!-- Hiển thị số điện thoại -->
                        <td><?php echo $dh->ngaydat ?></td>
                        <td><?php echo $dh->tongtien ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="madon" value="<?php echo $dh->madon ?>">
                                <select name="trangthai">
                                    <option value="Chưa xác nhận" <?php if($dh->trangthai == "Chưa xác nhận") echo "selected"; ?>>Chưa xác nhận</option>
                                    <option value="Đã xác nhận" <?php if($dh->trangthai == "Đã xác nhận") echo "selected"; ?>>Đã xác nhận</option>
                                    <option value="Đang giao" <?php if($dh->trangthai == "Đang giao") echo "selected"; ?>>Đang giao</option>
                                    <option value="Đã giao" <?php if($dh->trangthai == "Đã giao") echo "selected"; ?>>Đã giao</option>
                                    <option value="Hủy" <?php if($dh->trangthai == "Hủy") echo "selected"; ?>>Hủy</option>
                                </select>
                                <button type="submit" name="update_status" class="btn1">Up</button>
                            </form>
                        </td>
                        <td><?php echo $dh->phuongthucthanhtoan ?></td>
                        <td><?php echo $dh->diachi ?></td>
                        <td>
                            <form method="POST" action="xoa_donhang.php">
                                <input type="hidden" name="madon" value="<?php echo $dh->madon; ?>">
                                <button type="submit" class="btn1" style="margin-bottom: 10px;">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9">
                            <table width="100%" align="center">
                                <tr bgcolor="#CCCCCC" align="center">
                                    <td><strong>Mã sản phẩm</strong></td>
                                    <td><strong>Tên sản phẩm</strong></td>
                                    <td><strong>Số lượng</strong></td>
                                    <td><strong>Giá bán</strong></td>
                                    <td><strong>Thành tiền</strong></td>
                                    <td><strong>CRUD</strong></td>
                                </tr>
                                <?php if(isset($ChiTietDonHang[$dh->madon])) { // Kiểm tra xem $ChiTietDonHang có được khởi tạo không ?>
                                    <?php foreach($ChiTietDonHang[$dh->madon] as $ct){ ?>
                                    <tr align="center">
                                        <td><?php echo $ct->masp ?></td>
                                        <td><?php echo $ct->tensp ?></td>
                                        <td><?php echo $ct->soluong ?></td>
                                        <td><?php echo $ct->giaban ?></td>
                                        <td><?php echo $ct->soluong * $ct->giaban ?></td> <!-- Tính thành tiền -->
                                        <td>
                                            <form method="POST" action="xoa_chitiet.php">
                                                <input type="hidden" name="madon" value="<?php echo $dh->madon; ?>">
                                                <input type="hidden" name="masp" value="<?php echo $ct->masp; ?>">
                                                <button type="submit" class="btn1" style="margin-bottom: 10px;">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="6">Không có chi tiết đơn hàng.</td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php $con=null; ?>
    </div>  
</body>
</html>
