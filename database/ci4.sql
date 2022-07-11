-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 11, 2022 lúc 07:44 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ci4`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `course`
--

CREATE TABLE `course` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Price` int(11) NOT NULL,
  `Avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Describe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `course`
--

INSERT INTO `course` (`ID`, `Name`, `Price`, `Avatar`, `Title`, `Describe`) VALUES
(2, 'PHP', 5000000, '1657099332_6c24961b30921fb45e99.jpg', 'Lập Trình Web', 'Sử dụng thành thạo ngôn ngữ JavaScript và PHP để giải quyết bài toán về lập trình Làm chủ được các kỹ thuật lập trình Hướng đối tượng bằng JavaScript và PHP Sử dụng các cấu trúc dữ liệu phù hợp trong các tình huống thông dụng Hiểu và phát triển website tr'),
(13, 'C++', 5000000, '1657509625_f97e77b5abf052b09a12.jpg', 'f7gy3rfbgklmvlchy89udn', '1618gy3ifbevdffhuiv');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lesson`
--

CREATE TABLE `lesson` (
  `ID` int(11) NOT NULL,
  `idcourse` int(11) NOT NULL,
  `Title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Content` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lesson`
--

INSERT INTO `lesson` (`ID`, `idcourse`, `Title`, `Content`) VALUES
(1, 2, 'Lập Trình Web', 'Font Awesome 5 là một trong những icon font phổ biến nhất hiện nay, tại thời điểm viết bài 28/10/2020 với phiên bản 5.15.1 hỗ trợ trên 1600 icon miễn phí, rất dễ dàng để tích hợp vào website, công việc của bạn bây giờ là lựa chọn icon và copy paste. Font Awesome có bản miễn phí và bản trả phí, tuy nhiên bạn chỉ cần dùng bản miễn phí là đủ để làm đẹp cho website của mình.'),
(2, 2, 'Lập Trình IOS', 'Font Awesome 5 là một trong những icon font phổ biến nhất hiện nay, tại thời điểm viết bài 28/10/2020 với phiên bản 5.15.1 hỗ trợ trên 1600 icon miễn phí, rất dễ dàng để tích hợp vào website, công việc của bạn bây giờ là lựa chọn icon và copy paste. Font Awesome có bản miễn phí và bản trả phí, tuy nhiên bạn chỉ cần dùng bản miễn phí là đủ để làm đẹp cho website của mình.'),
(6, 2, 'Lập Trình AI', 'CodeIgniter là bộ công cụ dành cho những người xây dựng ứng dụng web bằng PHP. Mục tiêu của nó là cho phép bạn phát triển các dự án nhanh hơn nhiều so với khả năng của bạn nếu bạn đang viết mã từ đầu, bằng cách cung cấp một bộ thư viện phong phú cho các tác vụ thường cần, cũng như giao diện đơn giản và cấu trúc logic để truy cập các thư viện này. CodeIgniter cho phép bạn tập trung sáng tạo vào dự án của mình bằng cách giảm thiểu số lượng mã cần thiết cho một nhiệm vụ nhất định.'),
(7, 9, 'cbgdet6e34895rgtjibmkv cnbdgeyrf', 'frtfw7egyrfvinogk vlm,bgevtruifnkj');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `ID` int(11) NOT NULL,
  `idcourse` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`ID`, `idcourse`, `iduser`, `status`) VALUES
(3, 2, 7, 1),
(6, 2, 7, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`ID`, `Name`, `Email`, `Avatar`, `Password`, `Status`) VALUES
(1, 'Phạm Thanh Quân', 'quanpt.bhsoft@gmail.com', '1657100856_20ee33503ca48db27e3c.jpg', 'e67c10a4c8fbfc0c400e047bb9a056a1', 1),
(7, 'Nguyễn Hồng Ngọc', 'ngocnth.bhsoft@gmail.com', '1657179343_af88ce96ede055739452.jpg', 'e67c10a4c8fbfc0c400e047bb9a056a1', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `course`
--
ALTER TABLE `course`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `lesson`
--
ALTER TABLE `lesson`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
