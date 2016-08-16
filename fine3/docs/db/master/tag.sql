-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015 年 4 月 10 日 10:07
-- サーバのバージョン： 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fine_v3`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
`tag_id` int(9) unsigned NOT NULL,
  `tag_group_id` int(9) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `ordered` int(9) unsigned NOT NULL,
  `delete_flg` tinyint(1) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_group_id`, `name`, `description`, `ordered`, `delete_flg`) VALUES
(1, 1, '保育園', '施設形態', 1, 0),
(2, 1, '幼稚園', '施設形態', 2, 0),
(3, 1, '学童', '施設形態', 3, 0),
(4, 1, '事業所内保育所', '施設形態', 4, 0),
(5, 1, '院内保育', '施設形態', 5, 0),
(6, 1, 'こども園', '施設形態', 6, 0),
(7, 1, '病後児保育室', '施設形態', 7, 0),
(8, 1, '子育てひろば', '施設形態', 8, 0),
(9, 1, '託児所', '施設形態', 9, 0),
(10, 1, 'ベビーホテル', '施設形態', 10, 0),
(11, 1, 'イベント', '施設形態', 11, 0),
(12, 2, '保育士', '職種', 1, 0),
(13, 2, '幼稚園教諭', '職種', 2, 0),
(14, 2, '栄養士', '職種', 3, 0),
(15, 2, '調理師', '職種', 4, 0),
(16, 2, '看護師', '職種', 5, 0),
(17, 2, '学童', '職種', 6, 0),
(18, 2, 'その他', '職種', 7, 0),
(19, 3, '正社員', '雇用形態', 1, 0),
(20, 3, 'パート・アルバイト', '雇用形態', 2, 0),
(21, 3, '契約社員', '雇用形態', 3, 0),
(22, 3, '派遣', '雇用形態', 4, 0),
(23, 3, '紹介予定派遣', '雇用形態', 5, 0),
(24, 4, '保育士', '資格', 1, 0),
(25, 4, '幼稚園教諭Ⅰ種', '資格', 2, 0),
(26, 4, '幼稚園教諭Ⅱ種', '資格', 3, 0),
(27, 4, '管理栄養士', '資格', 4, 0),
(28, 4, '栄養士', '資格', 5, 0),
(29, 4, '調理師', '資格', 6, 0),
(30, 4, '看護師', '資格', 7, 0),
(31, 4, '准看護師', '資格', 8, 0),
(32, 4, 'チャイルドマインダー', '資格', 9, 0),
(33, 4, 'ベビーシッター', '資格', 10, 0),
(34, 4, '無資格', '資格', 11, 0),
(35, 5, '寮・社宅あり', '求人こだわり条件', 1, 0),
(36, 5, '住宅手当あり', '求人こだわり条件', 2, 0),
(37, 5, '退職金制度あり', '求人こだわり条件', 3, 0),
(38, 5, '交通費支給', '求人こだわり条件', 4, 0),
(39, 5, '社会保険完備', '求人こだわり条件', 5, 0),
(40, 5, '育休・産休あり', '求人こだわり条件', 6, 0),
(41, 5, '研修充実', '求人こだわり条件', 7, 0),
(42, 5, '夜勤手当あり', '求人こだわり条件', 8, 0),
(43, 5, '引越し支援あり', '求人こだわり条件', 9, 0),
(44, 5, '新卒求人', '求人こだわり条件', 10, 0),
(45, 5, 'オープニング求人', '求人こだわり条件', 11, 0),
(46, 5, '園長求人', '求人こだわり条件', 12, 0),
(47, 5, '主任求人', '求人こだわり条件', 13, 0),
(48, 5, '経験者歓迎', '求人こだわり条件', 14, 0),
(49, 5, '未経験者歓迎', '求人こだわり条件', 15, 0),
(50, 5, 'ブランク歓迎', '求人こだわり条件', 16, 0),
(51, 5, '英語話せる人歓迎', '求人こだわり条件', 17, 0),
(52, 5, '年齢不問', '求人こだわり条件', 18, 0),
(53, 5, '無資格ＯＫ', '求人こだわり条件', 19, 0),
(54, 5, '車・バイク通勤ＯＫ', '求人こだわり条件', 20, 0),
(55, 5, '服装・髪型自由', '求人こだわり条件', 21, 0),
(56, 5, '残業なし（少なめ）', '求人こだわり条件', 22, 0),
(57, 5, '土日祝休み', '求人こだわり条件', 23, 0),
(58, 5, '土日祝のみＯＫ', '求人こだわり条件', 24, 0),
(59, 5, '完全週休2日', '求人こだわり条件', 25, 0),
(60, 5, '週2〜3勤務ＯＫ', '求人こだわり条件', 26, 0),
(61, 5, '短時間勤務ＯＫ', '求人こだわり条件', 27, 0),
(62, 5, '固定時間勤務ＯＫ', '求人こだわり条件', 28, 0),
(63, 5, '遅番勤務', '求人こだわり条件', 29, 0),
(64, 5, '早番勤務', '求人こだわり条件', 30, 0),
(65, 5, 'ゴールデンタイム勤務：9-15時', '求人こだわり条件', 31, 0),
(66, 5, '園長募集', '求人こだわり条件', 32, 0),
(67, 5, '主任募集', '求人こだわり条件', 33, 0),
(68, 6, 'ママさん保育士多め', '園こだわり条件', 1, 0),
(69, 6, '男性スタッフ在籍', '園こだわり条件', 2, 0),
(70, 6, 'アットホーム、小規模園', '園こだわり条件', 3, 0),
(71, 6, '駅チカ', '園こだわり条件', 4, 0),
(72, 6, '綺麗な職場', '園こだわり条件', 5, 0),
(73, 6, 'のびのび保育', '園こだわり条件', 6, 0),
(74, 6, '園庭あり', '園こだわり条件', 7, 0),
(75, 6, 'モンテッソーリ教育', '園こだわり条件', 8, 0),
(76, 6, '病後児保育', '園こだわり条件', 9, 0),
(77, 6, 'グローバル', '園こだわり条件', 10, 0),
(78, 6, '家庭的保育', '園こだわり条件', 11, 0),
(79, 6, '産休育休復帰実績有', '園こだわり条件', 12, 0),
(80, 6, '有給消化率高', '園こだわり条件', 13, 0),
(81, 7, '労災保険', '社会保険', 1, 0),
(82, 7, '雇用保険', '社会保険', 2, 0),
(83, 7, '厚生年金', '社会保険', 3, 0),
(84, 7, '健康保険', '社会保険', 4, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
 ADD PRIMARY KEY (`tag_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
MODIFY `tag_id` int(9) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=85;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;