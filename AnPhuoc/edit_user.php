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
	
	$sql = "SELECT * FROM sanpham";
	$sta = $con->query($sql);
	
	if($sta->rowCount() > 0) {
		$SanPham = $sta->fetchAll(PDO::FETCH_OBJ);
	}
    $stmt = $con->prepare("SELECT * FROM loai");
    $stmt->execute();
    $loai_sanpham = $stmt->fetchAll(PDO::FETCH_ASSOC);
    include("user_sua.php");

    $sql_loai = "SELECT * FROM loai";
	$sta_loai = $con->query($sql_loai);
	if($sta_loai->rowCount() > 0) {
		$Loai = $sta_loai->fetchAll(PDO::FETCH_OBJ);
	}

    $stmt = $con->prepare("SELECT * FROM loai");
    $stmt->execute();
    $loai_sanpham = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
	<div class="header">
		<div class="top-header">
			<a href="#" style="align-self: center"><em class="fab fa-facebook-f"></em></a>
			<a href="#" style="align-self: center"><img src="img/zalo_icon.png" alt="zalo-_icon" style="height: 20px; width: 20px; padding-top: 2px"></a>
			<a href="#" style="align-self: center"><em class="fab fa-youtube"></em></a>
			<a href="#" style="align-self: center"><em class="fab fa-instagram"></em></a>
			<a href="#" style="align-self: center"><em class="fab fa-linkedin-in"></em></a>
			<img src="img/phone_icon.png" alt="phone_icon" style="appearance: none;display: block;background-position: 50%;background-repeat: no-repeat;width: 20px;height: 20px; padding-left: 5px; padding-right: 7px; align-self: center">	
			<span>1800 888 618</span>
			<img src="img/location_icon.png" alt="phone_icon" style="appearance: none;display: block;background-position: 50%;background-repeat: no-repeat;width: 20px;height: 20px; padding-left: 20px; padding-right: 7px; align-self: center">
			<span>Tìm cửa hàng</span>
			<img src="img/anPhuoc_logo.png" alt="phone_icon" style="appearance: none;display: block;background-position: 50%;background-repeat: no-repeat;width: 100px;height: 70px; padding-left: 60px; padding-right: 60px; align-self: center">
			<img src="img/user_icon.png" alt="phone_icon" style="appearance: none;display: block;background-position: 50%;background-repeat: no-repeat;width: 20px;height: 20px; padding-left: 5px; padding-right: 7px; align-self: center">
			<a href="Login.php" style="padding: 0; padding-bottom: 5px; padding-left:5px; padding-right: 5px"><span>Đăng nhập</span></a>
			<span>/</span>
			<a href="Register.php" style="padding: 0; padding-bottom: 5px; padding-left:5px; padding-right: 5px"><span>Đăng ký</span></a>
			<img src="img/search_icon.png" alt="phone_icon" style="appearance: none;display: block;background-position: 50%;background-repeat: no-repeat;width: 20px;height: 20px; padding-left: 30px; padding-right: 30px; align-self: center">
			<div style="border: 1px solid #ffffff; border-radius: 5px; width: 133px;height: 38;display: flex; flex-direction: row; align-self: center; align-content: center; padding-right: 5px">
			<img src="img/cart_icon.png" alt="phone_icon" style="appearance: none;display: block;background-position: 50%;background-repeat: no-repeat;width: 20px;height: 20px; padding-left: 20px; padding-right: 20px; align-self: center; padding-bottom: 10px; padding-top: 10px">
			<a href="./cart.php"><span>Giỏ hàng</span>
			</div>
			<div style="padding-right: 20px"></div>
		</div>
		<div class="bottom-header">
			<div style="width: 100px"></div>
			<div class="section"><a href="HomePage.php">an phuoc</a></div>
			<div class="section"><a href="">product</a></div>
			<div class="section"><a href="">category</a></div>
			<div class="section"><a href="">user</a></div>
			<div class="section"><a href="">cart</a></div>
		
			<div style="width: 100px"></div>
		</div>
	</div>
	<div class="content">
		
		<div class="main">
        
     

<?php
// Check if product code is provided
if (isset($_GET['username'])) {
  $username = $_GET['username'];
  
    $stmt = $con->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Display product information in the form
    echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?username=' . $username . '" method="post" style="max-width: 600px; margin: 0 auto; padding: 20px;">';
    echo '<h1 class="text-center py-3">Sửa Thông Tin Sản Phẩm</h1>';

    echo '<div style="margin-bottom: 15px;">';
    echo '<label for="pass" style="font-weight: bold;">Mật khẩu:</label>';
    echo '<input type="password" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" id="pass" name="pass" value="' . $user['pass'] . '" required>';
    echo '</div>';

    echo '<div style="margin-bottom: 15px;">';
    echo '<label for="hoten" style="font-weight: bold;">Họ tên:</label>';
    echo '<input type="text" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" id="hoten" name="hoten" value="' . $user['hoten'] . '" required>';
    echo '</div>';

    echo '<div style="margin-bottom: 15px;">';
    echo '<label for="sdt" style="font-weight: bold;">Số điện thoại:</label>';
    echo '<input type="text" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" id="sdt" name="sdt" value="' . $user['sdt'] . '" required>';
    echo '</div>';
	
	echo '<div style="margin-bottom: 15px;">';
    echo '<label for="email" style="font-weight: bold;">Email:</label>';
    echo '<input type="text" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" id="email" name="email" value="' . $user['email'] . '" required>';
    echo '</div>';

    echo '<div style="margin-bottom: 15px;">';
    echo '<button type="submit" style="padding: 10px 20px; border: none; border-radius: 5px; background-color: #007bff; color: #fff; cursor: pointer;">Lưu Thay Đổi</button>';
    echo '<a href="admin.php" style="text-decoration: none;"><button type="button" style="padding: 10px 20px; border: none; border-radius: 5px; background-color: #343a40; color: #fff; cursor: pointer;">Quay Lại</button></a>';
    echo '</div>';
    echo '</form>';
}

    ?>


    </div>
    </div>                 
	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="row-cols">
					<div class="title"><a href="#"><span style="color: #ff0000; font-size: 18px">An Phước Group</span></a></div>
						<p><span>100/11-12 An Dương Vương, P.9, Q.5, TP. Hồ Chí Minh, Việt Nam</span></p>
							<ul>
								<li><span style="font-size: 15px;">GPKD Số: 0301241545</span></li>
								<li><span style="font-size: 15px;">Ngày cấp: 26/04/1993GPKD Số: 0301241545</span></li>
								<li><span style="font-size: 15px;"><a href="tel:1800 888 618">Tư vấn mua hàng: 1800 888 618</a></span></li>
								<li><span style="font-size: 15px;">Văn phòng: +84.28.3835.0059</span></li>
								<li><span style="font-size: 15px;">CSKH: 1800 888 618</span></li>
								<li><span style="font-size: 15px;">Fax: +84.28.3835.0058</span></li>
								<li><span style="font-size: 15px;">Email: cskh@anphuoc.com.vn</span></li>
							</ul>

				</div>
				<div class="row-cols">
					<div class="title-toggle-footer"><span>Chăm sóc khách hàng</span><em class="lnr lnr-chevron-down"></em></div>
						<ol>
						  <li><a target="_self" href="#" title="Hướng dẫn mua hàng">Hướng dẫn mua hàng</a></li>
						  <li><a target="_self" href="#" title="Hướng dẫn thanh toán">Hướng dẫn thanh toán</a></li>
						  <li><a target="_self" href="#" title="Hướng dẫn chọn kích cỡ An Phước - Pierre Cardin">Hướng dẫn chọn kích cỡ An Phước - Pierre Cardin</a></li>
						  <li><a target="_self" href="#" title="Hướng dẫn chọn kích cỡ Anamai - Bonjour">Hướng dẫn chọn kích cỡ Anamai - Bonjour</a></li>
						  <li><a target="_self" href="#" title="Thời gian giao hàng">Thời gian giao hàng</a></li>
						  <li><a target="_self" href="#" title="Chính sách bảo mật">Chính sách bảo mật</a></li>
						  <li><a target="_self" href="#" title="Chính sách đổi hàng">Chính sách đổi hàng</a></li>
						  <li><a target="_self" href="#" title="Hỏi đáp">Hỏi đáp</a></li>
						  <li><a target="_self" href="#" title="Cam kết chất lượng">Cam kết chất lượng</a></li>
						</ol>
				</div>
				<div class="row-cols">
					<div class="title-toggle-footer"><span>Liên kết nhanh</span><em class="lnr lnr-chevron-down"></em></div>
						<ol>
						  <li><a target="_self" href="#" title="Bộ sưu tập">Bộ sưu tập</a></li>
						  <li><a target="_self" href="#" title="Tin khuyến mãi">Tin khuyến mãi</a></li>
						  <li><a target="_self" href="#" title="Tin thời trang">Tin thời trang</a></li>
						  <li><a target="_self" href="#" title="Tin tức - Sự kiện">Tin tức - Sự kiện</a></li>
						  <li><a target="_self" href="#" title="Hệ thống cửa hàng An Phước - Pierre Cardin">Hệ thống cửa hàng An Phước - Pierre Cardin</a></li>
						  <li><a target="_self" href="#" title="Hệ thống cửa hàng Anamai - Bonjour">Hệ thống cửa hàng Anamai - Bonjour</a></li>
						  <li><a target="_self" href="#" title="Liên hệ">Liên hệ</a></li>
						  <li><a target="_self" href="#" title="Tuyển dụng">Tuyển dụng</a></li>
						  <li><a target="_self" href="#" title="Cảnh giác giả mạo An Phước - Pierre Cardin">Cảnh giác giả mạo An Phước - Pierre Cardin</a></li>
						</ol>
				</div>
				<div class="row-cols">
					<div class="title-toggle-footer" style="position: relative; top: 3px; text-align: left;">KẾT NỐI VỚI CHÚNG TÔI</div>
						<div class="icon-social">
							<a href="#"><em class="fab fa-facebook-f"></em></a>
							<a href="#"><img src="img/zalo_icon.png" alt="zalo-_icon" style="height: 20px; width: 20px;padding-top: 2px"></a>
							<a href="#"><em class="fab fa-youtube"></em></a>
							<a href="#"><em class="fab fa-instagram"></em></a>
							<a href="#"><em class="fab fa-linkedin-in"></em></a>
						</div>
						<div class="verify-logo">
							<div style="position:relative; left:10px;"> <a href="http://online.gov.vn/Home/WebDetails/983"><img alt="" src="https://www.anphuoc.com.vn/Data/Sites/1/media/footerbanner/logosalenoti.png" style="width: 180px; height: 70px;" /></a></div>
						</div>
				</div>
			</div>
		</div>
		<div style="background: #444444; height: 2px; width: 100%"></div>
		<div style="background: #202020; color: #ffffff; display: flex;height: 50px ; align-items: center;font-size: 14px; font-weight: 400; flex-direction: row ; padding: 5px ;justify-content:space-between;font-family: Tahoma, "sans-serif";">
			<span style="padding-left: 16%">Copyright © 2020 - 2023 An Phước.</span>
			<div style="padding-right: 16%;">
				<a href="#" style="text-decoration: none; color: #ffffff; padding-right: 3px;">Đầu trang</a>
				<i class="fa-solid fa-chevron-up"></i>
			</div>
		</div>
	</div>
</body>
</html>