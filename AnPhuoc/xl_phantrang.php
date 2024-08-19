 <?php
		include("ketnoi.php");
		$sql="select*from sanpham";
		$sta=$con->query($sql);
	if($sta->rowcount()>0)
	{
		$mon_an=$sta->fetchAll(PDO::FETCH_OBJ);
	}
	?>
	<?php 
		$page_url="http://localhost:8080//C3/PDO/3_Index1.php";
		$display = 9;  // Number of items per page
$num_links = 5;  // Number of page links to display

$records = $con->query($sql);
$total_rows = $records->rowCount();
$total_pages = ceil($total_rows / $display);

$curr_page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$position = (($curr_page - 1) * $display);

$start = $curr_page - ($num_links - 1);
if ($start < 1) {
    $start = 1;
}

$end = $curr_page + $num_links;
if ($end > $total_pages) {
    $end = $total_pages;
}

// Get the relevant records for the current page
$sql .= " LIMIT $position, $display";
$sta = $con->query($sql);
$SanPham = $sta->fetchAll(PDO::FETCH_OBJ);
?>