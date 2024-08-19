<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="css/Style_1.css" type="text/css">

</head>
<?php 
	include("ketnoi.php");
	
	$sql = "SELECT * FROM users";
	$sta = $con->query($sql);
	
	if($sta->rowCount() > 0) {
		$Users = $sta->fetchAll(PDO::FETCH_OBJ);
	}
    // Xử lý yêu cầu xoá sản phẩm
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
        $delete_id = $_POST['delete_id'];
        // Thực hiện xóa sản phẩm từ CSDL
        $sql = "DELETE FROM users WHERE username = :username";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':username', $delete_id);
        if ($stmt->execute()) {
            echo "<script>alert('Xoá khách hàng thành công');</script>";
        } else {
            echo "<script>alert('Xoá khách hàng thất bại');</script>";
        }
    }

    $sql_loai = "SELECT * FROM loai";
	$sta_loai = $con->query($sql_loai);
	if($sta_loai->rowCount() > 0) {
		$Loai = $sta_loai->fetchAll(PDO::FETCH_OBJ);
	}
?>
<body>
	<div class="header">
	<div class="top-header">
		
		<img src="img/anPhuoc_logo.png" alt="phone_icon" style="appearance: none;display: block;background-position: 50%;background-repeat: no-repeat;width: 100px;height: 70px; padding-left: 60px; padding-right: 60px; align-self: center">
		<div style="border: 1px solid #ffffff; border-radius: 5px; width: 133px;height: 38;display: flex; flex-direction: row; align-self: center; align-content: center; padding-right: 5px;margin-left:20px">
		<img src="img/user_icon.png" alt="phone_icon" style="appearance: none;display: block;background-position: 50%;background-repeat: no-repeat;width: 20px;height: 20px; padding-left: 20px; padding-right: 20px; align-self: center; padding-bottom: 10px; padding-top: 10px">
		<a href="./cart.php"><span>ADMIN</span>
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
		<table width="1000px" height="1000px" align="center">
        <tbody>
		<caption><h1>THÔNG TIN KHÁCH HÀNG</h1></caption>
		<tr bgcolor="#999999" align="center">
			<td><strong>Tên tài khoản</strong></td>
			<td><strong>Tên khách hàng</strong></td>
			<td><strong>Số điện thoại</strong></td>
			<td><strong>Email</strong></td>
			<td><strong>CRUD</strong></td>
		</tr>
		<?php foreach($Users as $sp){ ?>
		<tr align="center">
			<td><?php echo $sp->username ?></td>
			<td><?php echo $sp->hoten ?></td>
            <td><?php echo $sp->sdt ?></td>
            <td><?php echo $sp->email ?></td>
            <td>
            <form method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xoá khách hàng này không?');">
                        <input type="hidden" name="delete_id" value="<?php echo $sp->username ?>">
                        <button type="submit" class="btn1" style="margin-bottom: 10px;background-color: red">Xoá</button>
                        
                    </form>
                    <a href="edit_user.php?username=<?php echo $sp->username; ?>"><button type="button" class="btn1">Sửa</button></a>
            </td>
		</tr>
		<?php } $con=null; ?>
        </tbody>
	</table>
        </div>
	</div>

</body>
</html>