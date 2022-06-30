-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 30, 2022 lúc 11:00 AM
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
(2, 'PHP', 5000000, '1656575422_e1c42691ef8d1ec67f25.jpg', 'Lập Trình Web', 'Sử dụng thành thạo ngôn ngữ JavaScript và PHP để giải quyết bài toán về lập trình Làm chủ được các kỹ thuật lập trình Hướng đối tượng bằng JavaScript và PHP Sử dụng các cấu trúc dữ liệu phù hợp trong các tình huống thông dụng Hiểu và phát triển website tr');

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
(1, 2, 'Lập Trình Web Android', 'Font Awesome 5 là một trong những icon font phổ biến nhất hiện nay, tại thời điểm viết bài 28/10/2020 với phiên bản 5.15.1 hỗ trợ trên 1600 icon miễn phí, rất dễ dàng để tích hợp vào website, công việc của bạn bây giờ là lựa chọn icon và copy paste. Font Awesome có bản miễn phí và bản trả phí, tuy nhiên bạn chỉ cần dùng bản miễn phí là đủ để làm đẹp cho website của mình.'),
(2, 2, 'Lập Trình Android', 'Font Awesome 5 là một trong những icon font phổ biến nhất hiện nay, tại thời điểm viết bài 28/10/2020 với phiên bản 5.15.1 hỗ trợ trên 1600 icon miễn phí, rất dễ dàng để tích hợp vào website, công việc của bạn bây giờ là lựa chọn icon và copy paste. Font Awesome có bản miễn phí và bản trả phí, tuy nhiên bạn chỉ cần dùng bản miễn phí là đủ để làm đẹp cho website của mình.'),
(5, 2, 'Lập Trình Game', 'Font Awesome 5 là một trong những icon font phổ biến nhất hiện nay, tại thời điểm viết bài 28/10/2020 với phiên bản 5.15.1 hỗ trợ trên 1600 icon miễn phí, rất dễ dàng để tích hợp vào website, công việc của bạn bây giờ là lựa chọn icon và copy paste. Font Awesome có bản miễn phí và bản trả phí, tuy nhiên bạn chỉ cần dùng bản miễn phí là đủ để làm đẹp cho website của mình.');

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
(4, 2, 1, 1),
(6, 2, 7, 0);

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
(1, 'Phạm Thanh Quân', 'quanpt.bhsoft@gmail.com', '1656579614_608bf6b09acaf20eda83.jpg', 'e67c10a4c8fbfc0c400e047bb9a056a1', 1),
(7, 'Nguyễn Hồng Ngọc', 'ngocnth.bhsoft@gmail.com', '1656578981_97e145fc3af3cefb2245.jpg', 'e67c10a4c8fbfc0c400e047bb9a056a1', 0),
(9, 'phamthanhquan2411@gmail.com', 'phamthanhquan2411@gmail.com', '1656575410_235adf7b94868e3f7216.jpg', 'e67c10a4c8fbfc0c400e047bb9a056a1', 0);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `lesson`
--
ALTER TABLE `lesson`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
