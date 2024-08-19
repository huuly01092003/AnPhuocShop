	<?php 
		try {
			$con = new PDO("mysql:host=localhost;dbname=an_phuoc",'root','');
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$con->query("set names utf8");
		} catch(PDOException $e) {
			echo "Kết nối thất bại: ".$e->getMessage();
		}
	?>