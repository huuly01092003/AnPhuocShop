<?php
session_start();

// Hàm tính tổng giá của các mặt hàng trong giỏ hàng
function calculateTotal() {
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['don_gia'] * $item['quantity'];
    }
    return $total;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    $_SESSION['cart'][$product_id]['quantity'] = $quantity;

    // Tính lại tổng thành tiền và thành tiền cho sản phẩm đã được cập nhật
    $lineTotal = $_SESSION['cart'][$product_id]['don_gia'] * $_SESSION['cart'][$product_id]['quantity'];
    $total = calculateTotal();

    // Trả về dữ liệu JSON chứa các giá trị đã cập nhật
    echo json_encode(['success' => true, 'lineTotal' => $lineTotal, 'total' => $total]);
} else {
    echo json_encode(['success' => false]);
}
?>
