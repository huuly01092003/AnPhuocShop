<?php
session_start();
include("ketnoi.php");
// Initialize variables to store product information
$product_names = [];
$product_prices = [];
$product_quantities = [];
$product_line_totals = [];

// Check if the form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve product information from the form on the Cart page
    if (isset($_POST['products']) && is_array($_POST['products'])) {
        foreach ($_POST['products'] as $product_id => $product_info) {
            // Store product information in arrays
            $product_names[] = $product_info['name'];
            $product_image[] = $product_info['image'];
            $product_size[] = $product_info['size'];
            $product_prices[] = $product_info['price'];
            $product_quantities[] = $product_info['quantity'];
            $product_line_totals[] = $product_info['line_total'];
        }
    }

    // Retrieve customer information from the form
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';

    // Retrieve total price from the form
    $total_price = $_POST['total_price'] ?? '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Checkout</h2>
        <form method="post" action="process_checkout.php">
            <!-- Display product information -->
            <?php if (!empty($product_names)): ?>
                <?php for ($i = 0; $i < count($product_names); $i++): ?>
                    <div class="row mb-2">
                        <div class="col-md-2">
                            <!-- Sử dụng đường dẫn tới hình ảnh của sản phẩm -->
                            <img src="img/<?php echo $product_image[$i] ?>" class="img-fluid" alt="Product Image">
                        </div>
                        <div class="col-md-4">
                            <h5><?php echo $product_names[$i]; ?></h5>
                            <!-- Display other product details if needed -->
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control" value="<?php echo $product_quantities[$i]; ?>" min="1">
                        </div>
                        <div class="col-md-2 text-right">
                            <p>Price: <?php echo $product_size[$i]; ?></p>
                        </div>
                        <div class="col-md-2 text-right">
                            <p>Price: <?php echo $product_prices[$i]; ?> VND</p>
                        </div>
                        <div class="col-md-2 text-right">
                            <p>Total: <?php echo $product_line_totals[$i]; ?> VND</p>
                        </div>
                    </div>
                    <input type="hidden" name="products[<?php echo $i; ?>][name]" value="<?php echo $product_names[$i]; ?>">
                    <input type="hidden" name="products[<?php echo $i; ?>][size]" value="<?php echo $product_size[$i]; ?>">
                    <input type="hidden" name="products[<?php echo $i; ?>][quantity]" value="<?php echo $product_quantities[$i]; ?>">
                    <hr>
                <?php endfor; ?>
            <?php else: ?>
                <p>No products selected.</p>
            <?php endif; ?>

            <!-- Customer information form -->
            <div class="card mb-4">
                <div class="card-header">Customer Information</div>
                <div class="card-body">
                    <!-- Display customer information form fields -->
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="full_name" value="<?php echo $full_name; ?>" placeholder="Enter full name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>" placeholder="Enter phone" required>
                    </div>
                </div>
            </div>
            <!-- Thông tin vận chuyển -->
            <div class="card mb-4">
                <div class="card-header">Thông tin vận chuyển</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" placeholder="Nhập địa chỉ" name="address" required>
                    </div>
                </div>
            </div>

            <!-- Thông tin thanh toán -->
            <div class="card mb-4">
                <div class="card-header">Thông tin thanh toán</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Phương thức thanh toán</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="cod" value="cod" required>
                            <label class="form-check-label" for="cod">Thanh toán khi giao hàng</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="online" value="online" required>
                            <label class="form-check-label" for="online">Thanh toán online</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thêm trường input ẩn để chứa tổng giá trị -->
            <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">

            <!-- Total price -->
            <div class="card mb-4">
                <div class="card-header">Total Price</div>
                <div class="card-body">
                    <p>Total: <?php echo $total_price; ?> VND</p>
                </div>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block">Place Order</button>
            
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
