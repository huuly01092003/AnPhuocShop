<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="css/Style_1.css" type="text/css">

</head>
<style>
	/* CSS */
#searchForm {
    display: none;
    position: absolute;
    top: 50px; /* điều chỉnh vị trí khung tìm kiếm */
    right: 0;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* thêm hiệu ứng bóng đổ */
    z-index: 999; /* đảm bảo khung tìm kiếm hiển thị trên các phần tử khác */
}

#searchForm input[type="text"] {
    width: 200px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none; /* loại bỏ viền xung quanh input khi được focus */
}

#searchForm button {
    padding: 8px 15px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    outline: none;
}

#searchForm button:hover {
    background-color: #0056b3; /* màu nền khi hover */
}

 /* CSS cho bộ lọc */
 .price-filter {
        margin-top: 10px;
    }

    .price-filter label {
        display: block;
        margin-bottom: 5px;
        cursor: pointer;
        font-size: 14px;
    }

    .price-filter input[type="radio"] {
    }

    
    .price-filter input[type="radio"]:checked + label:before {
        background-color: #007bff;
    }

    .price-filter label span {
        vertical-align: middle;
    }

    .price-filter button {
        margin-top: 10px;
        padding: 8px 15px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }

    .price-filter button:hover {
        background-color: #0056b3;
    }

</style>
<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
// Kiểm tra xem yêu cầu tìm kiếm đã được gửi đi hay chưa
if(isset($_GET['query']) && !empty($_GET['query'])) {
    // Lấy từ khóa tìm kiếm từ biến $_GET
    $search_query = $_GET['query'];
    
    // Kết nối đến cơ sở dữ liệu (giả sử bạn đã có kết nối trong file ketnoi.php)
    include("ketnoi.php");

    // Tính số sản phẩm trên mỗi trang
    $per_page = 10;

    // Lấy trang hiện tại từ tham số URL, mặc định là trang 1
    $curr_page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Tính vị trí bắt đầu của sản phẩm trong truy vấn SQL
    $start = ($curr_page - 1) * $per_page;

    $sql_loai = "SELECT * FROM loai";
	$sta_loai = $con->query($sql_loai);
	if($sta_loai->rowCount() > 0) {
		$Loai = $sta_loai->fetchAll(PDO::FETCH_OBJ);
	}

    // Truy vấn SQL để tìm kiếm sản phẩm theo tên
    $sql_search = "SELECT * FROM sanpham WHERE tensp LIKE :search_query LIMIT :start, :per_page";
    $stmt_search = $con->prepare($sql_search);
    $stmt_search->bindValue(':search_query', '%' . $search_query . '%', PDO::PARAM_STR);
    $stmt_search->bindValue(':start', $start, PDO::PARAM_INT);
    $stmt_search->bindValue(':per_page', $per_page, PDO::PARAM_INT);
    $stmt_search->execute();

    // Tính tổng số sản phẩm từ truy vấn SQL
    $total_rows = $stmt_search->rowCount();

    // Tính tổng số trang dựa trên tổng số sản phẩm và số sản phẩm trên mỗi trang
    $total_pages = ceil($total_rows / $per_page);

    // Kiểm tra xem có kết quả nào được trả về hay không
    if($stmt_search->rowCount() > 0) {
        // Duyệt qua các kết quả và hiển thị thông tin sản phẩm
        $SanPham_search = $stmt_search->fetchAll(PDO::FETCH_OBJ);

    }

    // Đóng kết nối đến cơ sở dữ liệu
    $con = null;
} else {
    // Nếu không có từ khóa tìm kiếm được cung cấp, hiển thị thông báo
    echo "<p>Vui lòng nhập từ khóa tìm kiếm.</p>";
}
        
?>
    <body>
	<div class="header">
		<div class="top-header">
		<!-- Các liên kết xã hội -->
		<a href="#" style="align-self: center"><em class="fab fa-facebook-f"></em></a>
		<a href="#" style="align-self: center"><img src="img/zalo_icon.png" alt="zalo-_icon" style="height: 20px; width: 20px; padding-top: 2px"></a>
		<a href="#" style="align-self: center"><em class="fab fa-youtube"></em></a>
		<a href="#" style="align-self: center"><em class="fab fa-instagram"></em></a>
		<a href="#" style="align-self: center"><em class="fab fa-linkedin-in"></em></a>
		
		<!-- Số điện thoại và tìm cửa hàng -->
		<img src="img/phone_icon.png" alt="phone_icon" style="appearance: none;display: block;background-position: 50%;background-repeat: no-repeat;width: 20px;height: 20px; padding-left: 5px; padding-right: 7px; align-self: center">    
		<span>1800 888 618</span>
		<img src="img/location_icon.png" alt="phone_icon" style="appearance: none;display: block;background-position: 50%;background-repeat: no-repeat;width: 20px;height: 20px; padding-left: 20px; padding-right: 7px; align-self: center">
		<span>Tìm cửa hàng</span>
		
		<!-- Logo -->
		<img src="img/anPhuoc_logo.png" alt="phone_icon" style="appearance: none;display: block;background-position: 50%;background-repeat: no-repeat;width: 100px;height: 70px; padding-left: 60px; padding-right: 60px; align-self: center">
		
		<!-- Đăng nhập hoặc tên người dùng -->
		<?php if(isset($_SESSION['username'])): ?>
			    <span><?php echo $_SESSION['username']; ?></span>
			    <a href="?logout" style="padding: 0; padding-bottom: 5px; padding-left:5px; padding-right: 5px"><span>Đăng xuất</span></a>
			<?php else: ?>
			    <a href="Login.php" style="padding: 0; padding-bottom: 5px; padding-left:5px; padding-right: 5px"><span>Đăng nhập</span></a>
			    <span>/</span>
			    <a href="Register.php" style="padding: 0; padding-bottom: 5px; padding-left:5px; padding-right: 5px"><span>Đăng ký</span></a>
			<?php endif; ?>

			<?php
				// Xử lý đăng xuất khi người dùng click vào nút đăng xuất
				if(isset($_GET['logout'])) {
					// Xóa session
					session_unset();
					session_destroy();
					// Chuyển hướng đến trang đăng nhập
					header("Location: HomePage.php");
					exit(); // Dừng kịch bản
				}
				?>
		
		<!-- Giỏ hàng và tìm kiếm -->
		<!-- HTML -->
		<!-- HTML -->
		<img id="searchIcon" src="img/search_icon.png" alt="phone_icon" style="appearance: none;display: block;background-position: 50%;background-repeat: no-repeat;width: 20px;height: 20px; padding-left: 30px; padding-right: 30px; align-self: center; cursor: pointer;">
		<form id="searchForm" action="search.php" method="GET" style="display: none;">
			<input type="text" name="query" placeholder="Nhập từ khóa tìm kiếm...">
			<button type="submit">Tìm kiếm</button>
		</form>
		<script>
			// JavaScript
			document.getElementById('searchIcon').addEventListener('click', function() {
				var searchForm = document.getElementById('searchForm');
				if (searchForm.style.display === 'none') {
					searchForm.style.display = 'block';
				} else {
					searchForm.style.display = 'none';
				}
			});
		</script>

		<div style="border: 1px solid #ffffff; border-radius: 5px; width: 133px;height: 38;display: flex; flex-direction: row; align-self: center; align-content: center; padding-right: 5px">
			<img src="img/cart_icon.png" alt="phone_icon" style="appearance: none;display: block;background-position: 50%;background-repeat: no-repeat;width: 20px;height: 20px; padding-left: 20px; padding-right: 20px; align-self: center; padding-bottom: 10px; padding-top: 10px">
			<a href="./cart.php"><span>Giỏ hàng</span></a>
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
	<div class="content">
		<div class="left-content">
			<span class="left-content-title" style="padding-bottom: 10px;">an phuoc</span>
			<div style="height: 2px; width: 100%; background: linear-gradient(to right, #333, #333 20%, #eee 100%, #333 75%);"></div>
			<?php 
				foreach($Loai as $l) { ?>
					<div class="side-section">
						<div class="side-in">
							<a href="filter_product.php?category=<?php echo $l->maloai; ?>">
								<span><?php echo $l->tenloai ?></span>
							</a>
							<h1 class="price"></h1>
							<i class="fa-solid fa-chevron-down"></i>
						</div>
						<div style="height: 2px; width: 100%; background: linear-gradient(to right, #333, #333 20%, #eee 100%, #333 75%);"></div>
					</div>
				<?php } ?>

				<!-- HTML cho bộ lọc -->
				<form action="filter_price.php" method="GET">
					<div class="price-filter">
						<span class="left-content-title">Bộ lọc</span>
						<label><input type="radio" name="price_range" value="under_100000"> <span>Dưới 100.000</span></label>
						<label><input type="radio" name="price_range" value="100000_300000"> <span>100.000 - 300.000</span></label>
						<label><input type="radio" name="price_range" value="300000_500000"> <span>300.000 - 500.000</span></label>
						<label><input type="radio" name="price_range" value="500000_1000000"> <span>500.000 - 1.000.000</span></label>
						<label><input type="radio" name="price_range" value="over_1000000"> <span>Trên 1.000.000</span></label>
						<button type="submit">Lọc</button>
					</div>
				</form>

				<form action="sort.php" method="GET">
					<div class="price-filter">		
						
						<!-- Sort Options -->
						<span class="left-content-title">Sắp xếp</span>
						<label><input type="radio" name="sort_by" value="az"> <span>A-Z</span></label>
						<label><input type="radio" name="sort_by" value="za"> <span>Z-A</span></label>
						<label><input type="radio" name="sort_by" value="high_low"> <span>Giá cao - Giá thấp</span></label>
						<label><input type="radio" name="sort_by" value="low_high"> <span>Giá thấp - Giá cao</span></label>
						
						<button type="submit">Sắp xếp</button>
					</div>
					</form>
			
		</div>
		<div class="main">
    <?php
    // Kiểm tra xem biến $SanPham_search có tồn tại không
    if(isset($SanPham_search)) {
        foreach($SanPham_search as $sp) { ?>
            <div class="card">
                <figure>
                    <img src="img/<?php echo $sp->anh;?>" alt="t-shirt">
                </figure>
                <section class="details">
                    <div class="min-details">
                        <h1><?php echo $sp->tensp ?><span>azul</span></h1>
                        <h1 class="price"><?php echo $sp->giaban ?></h1>
                    </div>
                    <a href="./detail.php?id=<?php echo $sp->masp; ?>" class="btn">Thêm vào giỏ hàng</a>
                </section>
            </div>
        <?php } 
    } else {
        // Hiển thị thông báo nếu không có kết quả tìm kiếm
        echo "<p>Không có kết quả tìm kiếm phù hợp.</p>";
    }
    ?>
</div>

		
	</div>
    <div class="pagination justify-content-center">
    <ul class="pagination">
        <?php if ($curr_page > 1): ?>
            <li class="page-item"><a class="page-link" href="?query=<?php echo urlencode($search_query); ?>&page=<?php echo ($curr_page - 1); ?>">Previous</a></li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <?php if ($i == $curr_page): ?>
                <li class="page-item active"><a class="page-link" href="#"><?php echo $i; ?></a></li>
            <?php else: ?>
                <li class="page-item"><a class="page-link" href="?query=<?php echo urlencode($search_query); ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($curr_page < $total_pages): ?>
            <li class="page-item"><a class="page-link" href="?query=<?php echo urlencode($search_query); ?>&page=<?php echo ($curr_page + 1); ?>">Next</a></li>
        <?php endif; ?>
    </ul>
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