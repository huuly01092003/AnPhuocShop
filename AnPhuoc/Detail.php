    <?php
    session_start();

    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';


    // Tiếp tục hiển thị nội dung của trang Detail.php

    include("ketnoi.php");


    // Kiểm tra xem ID sản phẩm có được cung cấp trong URL không
    if(isset($_GET['id'])) {
        $product_id = $_GET['id'];

        // Truy vấn để lấy thông tin chi tiết của sản phẩm dựa trên ID sản phẩm
        $product_sql = "SELECT * FROM sanpham WHERE masp = :product_id";
        $product_stmt = $con->prepare($product_sql);
        $product_stmt->bindParam(':product_id', $product_id);
        $product_stmt->execute();

        // Lấy thông tin chi tiết của sản phẩm
        $product = $product_stmt->fetch(PDO::FETCH_ASSOC);

        // Truy vấn để lấy kích thước cho sản phẩm
        $size_sql = "SELECT s.size FROM chitietsize cts JOIN size s ON cts.size_id = s.size_id WHERE cts.masp = :product_id";
        $size_stmt = $con->prepare($size_sql);
        $size_stmt->bindParam(':product_id', $product_id);
        $size_stmt->execute();
        $sizes = $size_stmt->fetchAll(PDO::FETCH_COLUMN);

        // Truy vấn để lấy các đánh giá của sản phẩm
        $comment_sql = "SELECT * FROM comment WHERE masp = :product_id";
        $comment_stmt = $con->prepare($comment_sql);
        $comment_stmt->bindParam(':product_id', $product_id);
        $comment_stmt->execute();
        $comments = $comment_stmt->fetchAll(PDO::FETCH_ASSOC);

        // Hiển thị thông tin chi tiết của sản phẩm
        if($product) {
    ?>
    <!doctype html>
    <html>
    <head>
    <meta charset="utf-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Untitled Document</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z9K1W0fF5V8+6zXnBgIDkh5+orC2QnXpwG62rB" crossorigin="anonymous">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

        <!-- Css Styles -->
        <link rel="stylesheet" href="Style_2/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="Style_2/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="Style_2/css/elegant-icons.css" type="text/css">
        <link rel="stylesheet" href="Style_2/css/jquery-ui.min.css" type="text/css">
        <link rel="stylesheet" href="Style_2/css/magnific-popup.css" type="text/css">
        <link rel="stylesheet" href="Style_2/css/owl.carousel.min.css" type="text/css">
        <link rel="stylesheet" href="Style_2/css/slicknav.min.css" type="text/css">
        <link rel="stylesheet" href="Style_2/css/style.css" type="text/css">
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
                <img src="img/phone_icon.png" alt="phone_icon" style="appearance: none;display: block;background-position: 50%;background-repeat: no-repeat;width: 25px;height: 20px; padding-left: 5px; padding-right: 7px; align-self: center">	
                <span>1800 888 618</span>
                <img src="img/location_icon.png" alt="phone_icon" style="appearance: none;display: block;background-position: 50%;background-repeat: no-repeat;width: 50px;height: 20px; padding-left: 20px; padding-right: 7px; align-self: center">
                <span>Tìm cửa hàng</span>
                <img src="img/anPhuoc_logo.png" alt="phone_icon" style="appearance: none;display: block;background-position: 50%;background-repeat: no-repeat;width: 220px;height: 70px; padding-left: 60px; padding-right: 60px; align-self: center">
                <img src="img/user_icon.png" alt="phone_icon" style="appearance: none;display: block;background-position: 50%;background-repeat: no-repeat;width: 30px;height: 20px; padding-left: 5px; padding-right: 7px; align-self: center">
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
			<img src="img/search_icon.png" alt="phone_icon" style="appearance: none;display: block;background-position: 50%;background-repeat: no-repeat;width: 20px;height: 20px; padding-left: 30px; padding-right: 30px; align-self: center">
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
    
  <div>
  <script>
    // Function to check if a size is selected
    function validateSizeSelection() {
        // Lấy tất cả các phần tử input radio trong nhóm 'size'
        var sizeInputs = document.querySelectorAll('input[name="size"]');
        var sizeSelected = false;

        // Lặp qua từng phần tử để kiểm tra xem có kích thước nào được chọn hay không
        sizeInputs.forEach(function(input) {
            if (input.checked) {
                sizeSelected = true;
            }
        });

        // Nếu không có kích thước nào được chọn, hiển thị cảnh báo và ngăn form submit
        if (!sizeSelected) {
            alert('Vui lòng chọn kích thước trước khi thêm vào giỏ hàng.');
            return false; // Ngăn form submit
        }

        return true; // Cho phép form submit
    }
</script>


    <form action="Cart.php" method="post" onsubmit="return validateSizeSelection()">
        <section class="product-details spad">
            <div class="container-sm">
                <div class="row">
                    <!-- Hiển thị hình ảnh sản phẩm -->
                    <div class="col-lg-6">
                        <div class="product__details__pic">
                            <div class="product__details__pic__left product__thumb nice-scroll">
                                <?php
                                // Tách chuỗi listanh thành mảng các ảnh
                                $images = explode(';', $product['listanh']);

                                // Hiển thị mỗi ảnh trong danh sách
                                foreach ($images as $index => $image) {
                                    $activeClass = ($index === 0) ? 'active' : ''; // Thêm lớp active cho ảnh đầu tiên
                                    echo "<a class='pt $activeClass' href='#product-" . ($index + 1) . "'>
                                            <img src='img/$image' alt='$product[tensp]'>
                                          </a>";
                                }
                                ?>
                            </div>
                            <div class="product__details__slider__content">
                                <div class="product__details__pic__slider owl-carousel">
                                    <?php
                                    // Hiển thị mỗi ảnh trong danh sách
                                    foreach ($images as $index => $image) {
                                        $hash = "product-" . ($index + 1);
                                        echo "<img data-hash='$hash' class='product__big__img' src='img/$image' alt='$product[tensp]'>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Hiển thị thông tin và chọn kích thước sản phẩm -->
                    <div class="col-lg-6">
                        <div class="product__details__text">
                            <h3><?php echo $product['tensp']; ?><span></span></h3>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__details__price"><?php echo $product['giaban']; ?>VNĐ</div>
                            <p>Quý khách nhận được hàng nếu có thắc mắc vui lòng inbox lại shop trước khi đánh giá sản phẩm ạ.<br> Cửa hàng quần áo AN Phước</p>
                            <div class="product__details__button">
                                <!-- Các trường ẩn chứa thông tin sản phẩm -->
                                <input type="hidden" name="product_id" value="<?php echo $product['masp']; ?>">
                                <input type="hidden" name="product_name" value="<?php echo $product['tensp']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $product['giaban']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $product['anh']; ?>">
                                <div class="quantity">
                                    <span>Số lượng :</span>
                                    <div class="pro-qty">
                                        <input type="number" name="quantity" value="1" min="1" value="<?php echo $quantity; ?>">
                                    </div>
                                </div>
                                <!-- Nút submit -->
                                <button type="submit" name="add_to_cart" class="cart-btn"><span class="icon_bag_alt"></span> Thêm vào giỏ hàng</button>
                            </div>
                            <div class="product__details__widget">
                                <ul>
                                    <li>
                                        <span>Trạng thái :</span>
                                        <div class="stock__checkbox">
                                            <label for="stockin"><?php echo $product['trangthai']; ?></label>
                                        </div>
                                    </li>
                                    <li>
                                        <span>Kích thước :</span>
                                        <div class="size__btn">
                                            <?php
                                            foreach ($sizes as $size) {
                                                echo "<label class='size'><input type='radio' name='size' value='$size'> $size</label>";
                                            }
                                            ?>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </form>
        <!-- Phần đánh giá sản phẩm -->
        <section class="product-review">
            <div class="container-sm">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">MÔ TẢ SẢN PHẨM</a>
                                </li>
                                <li
                                class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">THÔNG TIN SHOP</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">REVIEW</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                    <h6>MÔ TẢ SẢN PHẨM</h6>
                                    <?php echo $product['mota']; ?>
                                </div>
                                <div class="tab-pane" id="tabs-2" role="tabpanel">
                                    <h6>THÔNG TIN SHOP</h6>
                                    <p>✅ An Phước - Shop quần áo - Chuyên bán sỉ và lẻ thời trang , VNXK cập nhật liên tục mẫu theo hottrend.
                                        <br> ✅ Shop BAO CHẤT LIỆU thân thiện da bé
                                        <br> ✔️Cam kết giao hàng y hình, đúng yêu cầu.
                                        <br> ✔️Cam kết 1 đổi 1 nếu không vừa size.
                                        <br> ✅ Nhân viên shop chuyên nghiệp Tận Tâm trên từng đơn hàng - Thân Thiện trong phong cách phục vụ</p>
                                    <p>Chúc quý khách có những trải nghiệm tuyệt vời nhất khi mua hàng của Shop.
                                        <br> Theo dõi vào đánh giá 5 sao cho shop nhé ❤️❤️❤️</p>
                                </div>
                                <div class="tab-pane" id="tabs-3" role="tabpanel">
                                    <h6>REVIEW</h6>
                                    <?php
                                    if (!empty($comments)) {
                                        foreach ($comments as $comment) {
                                            echo '<p>'.$comment['username'] .': "'. $comment['comment'] . '"</p>';
                                        }
                                    } else {
                                        echo '<p>Không có đánh giá nào cho sản phẩm này.</p>';
                                    }
                                    ?>
                                     <!-- Form để nhập bình luận mới -->
                                     <?php if(isset($_SESSION['username'])): ?>
                                        <form method="post" action="process_comment.php">
                                            <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
                                            <input type="hidden" name="masp" value="<?php echo $product['masp']; ?>">
                                            <textarea name="comment" placeholder="Nhập bình luận của bạn" style="width: 1040px;"></textarea>
                                            <input class="btn" type="submit" name="submit" value="Đăng bình luận">  
                                        </form>
                                    <?php else: ?>
                                        <p>Bạn cần đăng nhập để có thể đăng bình luận.</p>
                                    <?php endif; ?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php
    } else {
        echo "Không tìm thấy sản phẩm.";
    }
} else {
    echo "Không có mã sản phẩm được cung cấp.";
}
?>

    <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="related__title">
                        <h5>Gợi ý cho bạn</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="img/2.jpg" style="background-image: url(&quot;img/product/product-2.jpg&quot;);">
                            
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Áo thun nam </a></h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">799.000đ</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="img/4.jpg" style="background-image: url(&quot;img/product/product-4.jpg&quot;);">
                         
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Áo Polo nam</a></h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">359.000đ</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="img/8.jpg" style="background-image: url(&quot;img/product/product-5.jpg&quot;);">
                           
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Áo sơ mi tay dài nam</a></h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">399.000đ</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="img/6.jpg" style="background-image: url(&quot;img/product/product-7.jpg&quot;);">
                           
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Áo vest </a></h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">590.000đ</div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-qGi/tjl0JG8QPAV4+nYec9gEMGy1vjzj2Ll33T/BQvR8ssw0KmwsLT/yFgFvfktD" crossorigin="anonymous"></script>
    <div class="footer">
		<div class="container1">
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

<!-- Js Plugins -->
<script src="Style_2/js/jquery-3.3.1.min.js"></script>
    <script src="Style_2/js/bootstrap.min.js"></script>
    <script src="Style_2/js/jquery.magnific-popup.min.js"></script>
    <script src="Style_2/js/jquery-ui.min.js"></script>
    <script src="Style_2/js/mixitup.min.js"></script>
    <script src="Style_2/js/jquery.countdown.min.js"></script>
    <script src="Style_2/js/jquery.slicknav.js"></script>
    <script src="Style_2/js/owl.carousel.min.js"></script>
    <script src="Style_2/js/jquery.nicescroll.min.js"></script>
    <script src="Style_2/js/main.js"></script>
</html>

