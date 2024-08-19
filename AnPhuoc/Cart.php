<?php
session_start();
include("ketnoi.php");

// Kiểm tra xem session 'username' đã tồn tại không
if (!isset($_SESSION['username'])) {
    // Nếu không, chuyển hướng người dùng đến trang đăng nhập
    header("Location: Login.php");
    exit(); // Dừng kịch bản
}

// Truy vấn SQL để lấy thông tin hoten, email, sdt dựa trên username
$stmt = $con->prepare("SELECT hoten, email, sdt FROM users WHERE username = :username");
$stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
$stmt->execute();

// Lấy kết quả
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Kiểm tra kết quả và gán giá trị vào biến tương ứng
if ($result) {
    $hoten = $result['hoten'];
    $email = $result['email'];
    $sdt = $result['sdt'];
} else {
    // Không tìm thấy thông tin người dùng
    echo "Không tìm thấy thông tin người dùng.";
    exit(); // Dừng kịch bản
}

// Hàm tính tổng giá của các mặt hàng trong giỏ hàng
function calculateTotal() {
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['don_gia'] * $item['quantity'];
    }
    return $total;
}

// Xử lý thêm sản phẩm vào giỏ hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $quantity = $_POST['quantity'];
    $size = $_POST['size'];

    // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
    $product_exists = false;
    foreach ($_SESSION['cart'] as $id => $item) {
        if ($id == $product_id . '_' . $size) {
            // Cộng số lượng lại nếu sản phẩm đã tồn tại
            $_SESSION['cart'][$id]['quantity'] += $quantity;
            $product_exists = true;
            break;
        }
    }

    // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm mới vào
    if (!$product_exists) {
        $_SESSION['cart'][$product_id . '_' . $size] = array(
            'ten_mon' => $product_name,
            'don_gia' => $product_price,
            'hinh' => $product_image,
            'quantity' => $quantity,
            'size' => $size
        );
    }

    // Chuyển hướng người dùng sang trang cart.php
    header('Location: cart.php');
    exit;
}

// Xử lý xoá sản phẩm khỏi giỏ hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_from_cart'])) {
    $product_id = $_POST['product_id'];
    // Sử dụng unset() để xóa mặt hàng khỏi giỏ hàng
    unset($_SESSION['cart'][$product_id]);
    // Chuyển hướng người dùng sang trang cart.php sau khi xoá
    header('Location: cart.php');
    exit;
}

?>


<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CART | Children Fashion</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Css Styles -->
    <link rel="stylesheet" href="Style_2/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="Style_2/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="Style_2/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="Style_2/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="Style_2/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="Style_2/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="Style_2/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="Style_2/css/style.css" type="text/css">
</head>
<body>
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./HomePage.php"><i class="fa fa-home"></i> Home</a>
                        <span>Shopping cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table" style="width: 1400px;">
                        <table>
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Size</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($_SESSION['cart'])): ?>
                                    <?php foreach ($_SESSION['cart'] as $product_id => $item): ?>
                                        <?php $lineTotal = number_format($item['don_gia'] * $item['quantity']); ?>
                                        
                                            <td class="cart__product__item">
                                                <img src="img/<?php echo $item['hinh']; ?>" alt="" width="90px" height="90px">
                                                <div class="cart__product__item__title">
                                                    <h6><?php echo $item['ten_mon']; ?></h6>
                                                </div>
                                            </td>
                                            <td class="cart__price"><?php echo number_format($item['don_gia']); ?>đ</td>
                                            <td class="cart__quantity">
                                                <div class="pro-qty">
                                                    <input type="number" value="<?php echo $item['quantity']; ?>" class="quantity-input" data-id="<?php echo $product_id; ?>" min="1">
                                                </div>
                                            </td>
                                            <td>
                                            <div class="cart__product__item__title">
                                                    <h6><?php echo $item['size']; ?></h6>
                                                </div>
                                            </td>
                                            
                                            <td class="cart__total"><?php echo $lineTotal ?>đ</td>
                                            <td class="cart__close"> 
                                                <form method="post">
                                                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                                    <button type="submit" class="btn btn-danger" name="remove_from_cart">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5">Giỏ hàng trống</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="./homepage.php">Quay về Trang chủ</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6" >
                    <div class="cart__btn update__btn" >
                        <span class="icon_loading" style="margin-right: 10px;"></span><button class="btn btn-primary">Reload Card</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-lg-4 offset-lg-2">
                    <div class="cart__total__procced">
                        <h6>Thanh toán</h6>
                        <ul>
                            <li>VAT <span>0%</span></li>
                            <li>Tổng thanh toán <span id="total-price"><?php echo number_format(calculateTotal()); ?>đ</span></li>
                        </ul>
                        <!--<a href="./Checkout.php" class="primary-btn">Xử lí thanh toán</a> -->
                        
                        <form method="post" action="Checkout.php">
                            <!-- Các trường thông tin sản phẩm trong giỏ hàng -->
                            <?php foreach ($_SESSION['cart'] as $product_id => $item): ?>
                                <input type="hidden" name="products[<?php echo $product_id; ?>][image]" value="<?php echo $item['hinh']; ?>">
                                <input type="hidden" name="products[<?php echo $product_id; ?>][size]" value="<?php echo $item['size']; ?>">
                                <input type="hidden" name="products[<?php echo $product_id; ?>][name]" value="<?php echo $item['ten_mon']; ?>">
                                <input type="hidden" name="products[<?php echo $product_id; ?>][price]" value="<?php echo $item['don_gia']; ?>">
                                <input type="hidden" name="products[<?php echo $product_id; ?>][quantity]" value="<?php echo $item['quantity']; ?>">
                                <input type="hidden" name="products[<?php echo $product_id; ?>][line_total]" value="<?php echo $item['don_gia'] * $item['quantity']; ?>">
                                <!-- Thêm các trường thông tin khác của sản phẩm nếu cần -->
                            <?php endforeach; ?>

                            <!-- Các trường thông tin người mua hàng -->
                            <input type="hidden" name="full_name" value="<?php echo isset($hoten) ? $hoten : ''; ?>">
                            <input type="hidden" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
                            <input type="hidden" name="phone" value="<?php echo isset($sdt) ? $sdt : ''; ?>">

                            <!-- Tổng thành tiền -->
                            <input type="hidden" name="total_price" value="<?php echo number_format(calculateTotal()); ?>">

                            <!-- Nút thanh toán -->
                            <button type="submit" class="btn btn-primary">Xử lý thanh toán</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Cart Section End -->
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
    <!-- Custom Javascript -->
    <script>
        $(document).ready(function(){
            $('.quantity-input').change(function(){
                var productId = $(this).data('id');
                var quantity = $(this).val();
                $.ajax({
                    url: 'update_cart.php',
                    method: 'POST',
                    data: {product_id: productId, quantity: quantity},
                    success: function(response){
                        var data = JSON.parse(response);
                        if(data.success){
                            $('.cart__total').each(function(){
                                if($(this).closest('tr').find('.quantity-input').data('id') == productId){
                                    $(this).text(data.lineTotal + 'đ');
                                }
                            });
                            $('#total-price').text(data.total + 'đ');
                        } else {
                            alert('Có lỗi xảy ra, vui lòng thử lại sau.');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>

