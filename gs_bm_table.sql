-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-07-13 17:19:24
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_db2`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bm_table`
--

CREATE TABLE `gs_bm_table` (
  `id` int(11) NOT NULL,
  `tempo_no` varchar(5) NOT NULL,
  `tempo_name` text NOT NULL,
  `postcode` varchar(8) NOT NULL,
  `address` text NOT NULL,
  `phone_no` varchar(13) NOT NULL,
  `open_date` date NOT NULL,
  `close_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `gs_bm_table`
--

INSERT INTO `gs_bm_table` (`id`, `tempo_no`, `tempo_name`, `postcode`, `address`, `phone_no`, `open_date`, `close_date`) VALUES
(18, '639', 'ツルハドラッグ新宿落合店', '161-0034', '東京都新宿区上落合3-8-25', '03-5338-7410', '2023-07-12', '9999-12-31'),
(19, '1096', 'ツルハドラッグ早稲田店', '162-0042', '東京都新宿区早稲田町67-4 リヴィラージュ早稲田', '03-3209-2451', '2023-07-01', '9999-12-31'),
(20, '1084', 'ツルハドラッグ戸越公園店', '142-0041', '東京都品川区戸越6-8-20', '03-5702-7321', '2023-06-28', '9999-12-31'),
(21, '1089', 'ツルハドラッグ練馬北町店', '179-0081', '東京都練馬区北町1-45-6', '03-5921-3451', '2023-07-11', '9999-12-31'),
(22, '1080', 'ツルハドラッグ神田神保町店', '101-0051', '東京都千代田区神田神保町1-3-5 冨山房ビル1階', '03-5282-8770', '2023-06-26', '0000-00-00'),
(23, '1054', 'ツルハドラッグ小竹向原店', '', '東京都板橋区向原3丁目10-6 NEM.BLD(エヌ・イー・エム ビルディング)1階', '03-5986-0855', '2023-06-26', '9999-12-31');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
