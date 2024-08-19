<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="css/Style_1.css" type="text/css">


</head>

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
			<span>Giỏ hàng</span>
			</div>
			<div style="padding-right: 20px"></div>
		</div>
		<div class="bottom-header">
			<div style="width: 100px"></div>
			<div class="section"><a href="HomePage.php">an phuoc</a></div>
			<div class="section"><a href="">an phuoc ladies</a></div>
			<div class="section"><a href="">bộ sưu tập</a></div>
			<div class="section"><a href="">anamai</a></div>
			<div class="section"><a href="">bonjour</a></div>
			<div class="section"><a href="">promotion</a></div>
			<div style="width: 100px"></div>
		</div>
	</div>
	
	<form action="Register.php" method="post" id="registrationForm">
		<div class="register">
		<div class="register_main">
			<span style="text-transform: uppercase; font-size: 30px; line-height: 36px; font-weight: 400; align-self: center; padding-bottom: 10px">đăng ký tài khoản</span>
			<div class="info">
				<label for="username">Tên tài khoản</label>
				<input type="text" maxlength="50" id="username" name="username">
			</div>
			<div class="info">
				<label for="email">Email</label>
				<input type="text" maxlength="50" id="email" name="email">
			</div>
			<div class="info">
				<label for="password">Mật khẩu</label>
				<input type="password" maxlength="50" id="password" name="password">
			</div>
			<div class="info">
				<label for="confirmPassword">Xác nhận mật khẩu</label>
				<input type="password" maxlength="50" id="confirmPassword" name="confirmPassword">
			</div>
			<div class="info">
				<label for="name">Họ tên</label>
				<input type="text" maxlength="50" id="name" name="name">
			</div>
			<div class="info">
				<label for="phone">Điện thoại</label>
				<input type="text" maxlength="50" id="phone" name="phone">
			</div>
			<input type="submit" value="tạo tài khoản" class="submit" name="submit"  id="submitButton">
		</div>
	</div>
	</form>
	
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
<?php
	try{
		$conn = new PDO("mysql:host=localhost;dbname=an_phuoc", 'root', '');
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if (isset($_POST["submit"])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hoten = $_POST['name'];
        $sdt = $_POST['phone'];
        $email = $_POST['email'];
        // Kiểm tra xem tài khoản đã tồn tại hay chưa
		$stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo '<script type="text/javascript">
       window.onload = function () { alert("Tài khoản đã tồn tại"); } 
</script>'; 
        } else {
            // Tiến hành lưu tài khoản vào cơ sở dữ liệu
			$sql = "INSERT INTO users (username, pass, hoten, sdt, email) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username, $password, $hoten, $sdt, $email]);
			echo "<script>window.location.href = 'login.php';</script>";
        }
    }
	}catch(PDOException $e){
		echo "kết nối thất bại: ". $e->getMessage();
	}
$conn = null;
?>	
	
<script>
	function validateForm() {
  // Lấy giá trị từ các trường nhập liệu
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirmPassword').value;
  const email = document.getElementById('email').value;
  const name = document.getElementById('name').value;
  const phone = document.getElementById('phone').value;

  // Biến để lưu trữ thông báo lỗi
  let errorMessages = '';

  // Validation tên đăng nhập
  if (username.trim() === '') {
    errorMessages += 'Tên đăng nhập không được để trống.\n';
  } else if (username.length < 6 || username.length > 20) {
    errorMessages += 'Tên đăng nhập phải có độ dài từ 6 đến 20 ký tự.\n';
  } else if (!/^[a-zA-Z0-9_]+$/.test(username)) {
    errorMessages += 'Tên đăng nhập chỉ được chứa chữ cái, số và gạch dưới.\n';
  }

  // Validation mật khẩu
  if (password.trim() === '') {
    errorMessages += 'Mật khẩu không được để trống.\n';
  } else if (password.length < 8) {
    errorMessages += 'Mật khẩu phải có ít nhất 8 ký tự.\n';
  } else if (!/[a-zA-Z0-9!@#$%^&*]+/.test(password)) {
    errorMessages += 'Mật khẩu phải chứa ít nhất một chữ cái, một số và một ký tự đặc biệt.\n';
  }

  // Validation xác nhận mật khẩu
  if (confirmPassword.trim() === '') {
    errorMessages += 'Xác nhận mật khẩu không được để trống.\n';
  } else if (confirmPassword !== password) {
    errorMessages += 'Xác nhận mật khẩu không khớp với mật khẩu.\n';
  }

  // Validation email
  if (email.trim() === '') {
    errorMessages += 'Email không được để trống.\n';
  } else if (!/^[\w-.]+@([\w-]+\.)+[a-zA-Z]{2,}$/.test(email)) {
    errorMessages += 'Email không hợp lệ.\n';
  }

  // Validation tên
  if (name.trim() === '') {
    errorMessages += 'Tên không được để trống.\n';
  } else if (!/^[a-zA-Z]+$/.test(name)) {
    errorMessages += 'Tên chỉ được chứa chữ cái.\n';
  }

  // Validation số điện thoại (tùy chỉnh định dạng theo yêu cầu)
  if (phone.trim() === '') {
    errorMessages += 'Số điện thoại không được để trống.\n';
  } else if (!/^\d{10}$/.test(phone)) {
    errorMessages += 'Số điện thoại không hợp lệ (phải có 10 chữ số).';
  }

  // Hiển thị thông báo lỗi
  if (errorMessages) {
    alert(errorMessages);
    return false; // Ngăn chặn submit form
  } else {
	// Lưu trữ thông tin đăng nhập vào localStorage
	localStorage.setItem('loggedInUser', username);

    return true;
  }
}

// Thêm sự kiện click vào nút submit form
const submitButton = document.getElementById('submitButton');
submitButton.addEventListener('click', validateForm);

</script>

</html>