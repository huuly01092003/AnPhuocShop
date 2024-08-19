-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 27, 2024 lúc 06:43 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `an_phuoc`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateTotalPrice` ()   BEGIN
    UPDATE donhang AS d
    SET d.tongtien = (
        SELECT SUM(s.giaban * c.soluong)
        FROM chitietdonhang AS c
        INNER JOIN sanpham AS s ON c.masp = s.masp
        WHERE c.madon = d.madon
    );
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `adminname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`adminname`, `email`, `password`) VALUES
('admin1', 'admin1@example.com', 'adminpass1'),
('admin2', 'admin2@example.com', 'adminpass2');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `mactdh` int(11) NOT NULL,
  `madon` int(11) NOT NULL,
  `masp` int(11) NOT NULL,
  `soluong` int(11) DEFAULT NULL,
  `size_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`mactdh`, `madon`, `masp`, `soluong`, `size_id`) VALUES
(50, 50, 2, 3, 2),
(51, 50, 3, 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietsize`
--

CREATE TABLE `chitietsize` (
  `masp` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `soluong` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietsize`
--

INSERT INTO `chitietsize` (`masp`, `size_id`, `soluong`) VALUES
(2, 1, 30),
(2, 2, 25),
(2, 3, 20),
(3, 1, 50),
(3, 2, 45),
(3, 3, 40),
(5, 1, 20),
(5, 2, 30),
(5, 3, 25),
(6, 1, 40),
(6, 2, 35),
(6, 3, 30),
(30, 1, 3),
(30, 2, 2),
(30, 3, 7),
(30, 4, 4),
(31, 1, 1),
(31, 2, 1),
(31, 3, 1),
(31, 4, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `masp` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `madon` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `ngaydat` date DEFAULT NULL,
  `tongtien` decimal(18,0) DEFAULT NULL,
  `trangthai` varchar(50) DEFAULT NULL,
  `phuongthucthanhtoan` varchar(50) DEFAULT NULL,
  `diachi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`madon`, `username`, `ngaydat`, `tongtien`, `trangthai`, `phuongthucthanhtoan`, `diachi`) VALUES
(50, 'user1', '2024-05-27', 1296000, 'Chờ xử lý', 'cod', 'Tp.HCM');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai`
--

CREATE TABLE `loai` (
  `maloai` int(11) NOT NULL,
  `tenloai` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loai`
--

INSERT INTO `loai` (`maloai`, `tenloai`) VALUES
(2, 'Quần'),
(3, 'Phụ kiện');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `reset_password_request`
--

INSERT INTO `reset_password_request` (`id`, `username`, `code`, `created_at`) VALUES
(1, 'user1', '850888', '2024-05-27 04:10:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `masp` int(11) NOT NULL,
  `tensp` varchar(255) DEFAULT NULL,
  `maloai` int(11) DEFAULT NULL,
  `giaban` decimal(10,2) DEFAULT NULL,
  `trangthai` varchar(50) DEFAULT NULL,
  `anh` varchar(255) DEFAULT NULL,
  `listanh` text DEFAULT NULL,
  `mota` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`masp`, `tensp`, `maloai`, `giaban`, `trangthai`, `anh`, `listanh`, `mota`) VALUES
(2, 'Quần jeans', 2, 399000.00, 'Còn hàng', '2.jpg', '1.jpg;2.jpg', 'Quần jeans thời trang'),
(3, 'Cà vạt', 3, 99000.00, 'Còn hàng', '3.jpg', '1.jpg;2.jpg', 'Cà vạt đẹp'),
(5, 'Quần kaki', 2, 349000.00, 'Còn hàng', '5.jpg', '3.jpg;4.jpg', 'Quần kaki thời trang'),
(6, 'Mũ lưỡi trai', 3, 79000.00, 'Còn hàng', '6.jpg', '5.jpg;6.jpg', 'Mũ lưỡi trai cá tính'),
(8, 'Quần short', 2, 259000.00, 'Còn hàng', '8.jpg', '7.jpg;4.jpg', 'Quần short thoải mái'),
(9, 'Thắt lưng', 3, 129000.00, 'Còn hàng', '9.jpg', '2.jpg;5.jpg', 'Thắt lưng da thật'),
(11, 'Quần tây', 2, 399000.00, 'Còn hàng', '6.jpg', '4.jpg;2.jpg', 'Quần tây công sở'),
(12, 'Khăn quàng', 3, 149000.00, 'Còn hàng', '7.jpg', '6.jpg;8.jpg', 'Khăn quàng cổ ấm áp'),
(14, 'Quần jogger', 2, 329000.00, 'Còn hàng', '3.jpg', '9.jpg;10.jpg', 'Quần jogger thể thao'),
(15, 'Mũ bảo hiểm', 3, 199000.00, 'Còn hàng', '8.jpg', '10.jpg;3.jpg', 'Mũ bảo hiểm an toàn'),
(17, 'Quần legging', 2, 199000.00, 'Còn hàng', '5.jpg', '1.jpg;9.jpg', 'Quần legging thoải mái'),
(18, 'Nơ cổ', 3, 69000.00, 'Còn hàng', '6.jpg', '6.jpg;9.jpg', 'Nơ cổ lịch sự'),
(20, 'Quần thể thao', 2, 299000.00, 'Còn hàng', '2.jpg', '3.jpg;2.jpg', 'Quần thể thao năng động'),
(21, 'Găng tay', 3, 99000.00, 'Còn hàng', '8.jpg', '7.jpg;3.jpg', 'Găng tay da'),
(30, 'CCXX', 2, 400000.00, 'Còn hàng', '3.jpg', '3.jpg;4.jpg;5..jpg', 'rrrrrrrrrrrrr'),
(31, 'GAAA', 2, 400000.00, 'Còn hàng', '5.jpg', '6.jpg;7.jpg;9.jpg;10.jpg', 'sdd');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `size`
--

CREATE TABLE `size` (
  `size_id` int(11) NOT NULL,
  `size` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `size`
--

INSERT INTO `size` (`size_id`, `size`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `hoten` varchar(255) DEFAULT NULL,
  `sdt` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`username`, `pass`, `hoten`, `sdt`, `email`) VALUES
('user1', '$2y$10$FQty1hY66Zwu.aHa4fG6W.9I84Lwjmzuo7nNy9A847u', 'Nguyễn Văn A', '0909123456', 'huuly1357@gmail.com');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminname`),
  ADD UNIQUE KEY `adminname` (`adminname`);

--
-- Chỉ mục cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`mactdh`),
  ADD KEY `FK_ChiTietDonHang_SanPham` (`masp`),
  ADD KEY `FK_ChiTietDonHang_Size` (`size_id`),
  ADD KEY `FK_ChiTietDonHang_DonHang` (`madon`);

--
-- Chỉ mục cho bảng `chitietsize`
--
ALTER TABLE `chitietsize`
  ADD PRIMARY KEY (`masp`,`size_id`),
  ADD KEY `FK_ChiTietSize_Size` (`size_id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `FK_Comment_SanPham` (`masp`),
  ADD KEY `FK_Comment_Users` (`username`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`madon`),
  ADD KEY `FK_DonHang_Users` (`username`);

--
-- Chỉ mục cho bảng `loai`
--
ALTER TABLE `loai`
  ADD PRIMARY KEY (`maloai`);

--
-- Chỉ mục cho bảng `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ResetPasswordRequest_Users` (`username`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`masp`),
  ADD KEY `FK_SanPham_Loai` (`maloai`);

--
-- Chỉ mục cho bảng `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`size_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `mactdh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `madon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `masp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `size`
--
ALTER TABLE `size`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `FK_ChiTietDonHang_DonHang` FOREIGN KEY (`madon`) REFERENCES `donhang` (`madon`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_ChiTietDonHang_SanPham` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_ChiTietDonHang_Size` FOREIGN KEY (`size_id`) REFERENCES `size` (`size_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `chitietsize`
--
ALTER TABLE `chitietsize`
  ADD CONSTRAINT `FK_ChiTietSize_SanPham` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_ChiTietSize_Size` FOREIGN KEY (`size_id`) REFERENCES `size` (`size_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_Comment_SanPham` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Comment_Users` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `FK_DonHang_Users` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_ResetPasswordRequest_Users` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `FK_SanPham_Loai` FOREIGN KEY (`maloai`) REFERENCES `loai` (`maloai`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
