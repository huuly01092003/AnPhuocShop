<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Product Management</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="css/Style_1.css" type="text/css">
</head>
<body>
<?php
include("ketnoi.php");

// Handle product deletion request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $sql = "DELETE FROM sanpham WHERE masp = :masp";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':masp', $delete_id);
    if ($stmt->execute()) {
        echo "<script>alert('Xoá sản phẩm thành công');</script>";
    } else {
        echo "<script>alert('Xoá sản phẩm thất bại');</script>";
    }
}

// Fetch product data
$sql = "SELECT s.masp, s.tensp, s.maloai, s.giaban, s.trangthai, s.anh, 
        GROUP_CONCAT(sz.size SEPARATOR ', ') AS size_list,
        GROUP_CONCAT(cs.soluong SEPARATOR ', ') AS size_sl 
        FROM sanpham s 
        INNER JOIN chitietsize cs ON s.masp = cs.masp 
        INNER JOIN size sz ON cs.size_id = sz.size_id 
        GROUP BY s.masp, s.tensp, s.maloai, s.giaban, s.trangthai, s.anh";
$stmt = $con->prepare($sql);
$stmt->execute();
$SanPham1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch categories
$sql_loai = "SELECT * FROM loai";
$sta_loai = $con->query($sql_loai);
if ($sta_loai->rowCount() > 0) {
    $Loai = $sta_loai->fetchAll(PDO::FETCH_OBJ);
}

include("xl_phantrang.php");
?>
<div class="header">
    <div class="top-header">
        <img src="img/anPhuoc_logo.png" alt="Logo" style="display: block; width: 100px; height: 70px; padding: 0 60px;">
        <div style="display: flex; align-items: center; border: 1px solid #ffffff; border-radius: 5px; padding: 0 5px; margin-left: 20px;">
            <img src="img/user_icon.png" alt="User Icon" style="width: 20px; height: 20px; padding: 10px;">
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

<div class="content" style="width: auto!important;">
    <div class="main1" style="margin-left: 300px;">
        <div style="height: 20px"></div>
        <table>
            <caption><h1>THÔNG TIN SẢN PHẨM</h1></caption>
            <a href="add_product.php" class="btn-add1">Thêm sản phẩm</a>
            <tr bgcolor="#999999" align="center">
                <td><strong>Mã sản phẩm</strong></td>
                <td><strong>Tên sản phẩm</strong></td>
                <td><strong>Mã loại</strong></td>
                <td><strong>Size</strong></td>
                <td><strong>Giá bán</strong></td>
                <td><strong>Trạng thái</strong></td>
                <td><strong>Ảnh</strong></td>
                <td><strong>CRUD</strong></td>
            </tr>
            <?php
            if ($SanPham1) {
                foreach ($SanPham1 as $sp) { ?>
                    <tr align="center">
                        <td><?php echo htmlspecialchars($sp['masp']); ?></td>
                        <td><?php echo htmlspecialchars($sp['tensp']); ?></td>
                        <td><?php echo htmlspecialchars($sp['maloai']); ?></td>
                        <td>
                            <?php echo htmlspecialchars($sp['size_list']); ?><br>
                            <?php echo htmlspecialchars($sp['size_sl']); ?>
                        </td>
                        <td><?php echo htmlspecialchars($sp['giaban']); ?></td>
                        <td><?php echo htmlspecialchars($sp['trangthai']); ?></td>
                        <td><img src="img/<?php echo htmlspecialchars($sp['anh']); ?>" width="150px" height="150px" /></td>
                        <td>
                            <form method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xoá sản phẩm này không?');">
                                <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($sp['masp']); ?>">
                                <button type="submit" class="btn1" style="margin-bottom: 10px; background-color: #f44336;">Xoá</button>
                            </form>
                            <a href="edit_product.php?masp=<?php echo htmlspecialchars($sp['masp']); ?>"><button type="button" class="btn1">Sửa</button></a>
                        </td>
                    </tr>
                <?php }
            } else {
                echo "<tr><td colspan='8'>Không tìm thấy sản phẩm nào.</td></tr>";
            }
            $con = null; ?>
        </table>
    </div>
</div>

<div class="pagination justify-content-center">
    <ul class="pagination">
        <?php if ($curr_page > 1) { ?>
            <li class="page-item"><a class="page-link" href="?page=<?php echo ($curr_page - 1); ?>">Previous</a></li>
        <?php } ?>
        <?php for ($i = $start; $i <= $end; $i++) { ?>
            <li class="page-item <?php echo $i == $curr_page ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php } ?>
        <?php if ($curr_page < $total_pages) { ?>
            <li class="page-item"><a class="page-link" href="?page=<?php echo ($curr_page + 1); ?>">Next</a></li>
        <?php } ?>
    </ul>
</div>
</body>
</html>
