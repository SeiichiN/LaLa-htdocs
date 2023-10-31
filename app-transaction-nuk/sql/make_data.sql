
--
-- データベース: `inventory`
--
CREATE DATABASE IF NOT EXISTS `inventory`;

USE `inventory`;

-- --------------------------------------------------------

DROP TABLE IF EXISTS `stock`;
DROP TABLE IF EXISTS `goods`;
DROP TABLE IF EXISTS `brand`;

--
-- テーブルの構造 `brand`
--

CREATE TABLE `brand` (
  `id` varchar(10) NOT NULL,
  `name` varchar(40) NOT NULL,
  `country` varchar(20) DEFAULT NULL
);

--
-- テーブルのデータのダンプ `brand`
--

INSERT INTO `brand` (`id`, `name`, `country`) VALUES
('ADD', 'アドデス', 'ドイツ'),
('FIS', 'ファインスカイ', '日本'),
('UDN', 'ウディナ', 'イタリア'),
('UTG', 'ウルトラゲート', 'アメリカ');

-- --------------------------------------------------------

--
-- テーブルの構造 `goods`
--

CREATE TABLE `goods` (
  `id` varchar(10) NOT NULL,
  `name` varchar(40) NOT NULL,
  `size` varchar(20) NOT NULL,
  `brand` varchar(10) NOT NULL
);

--
-- テーブルのデータのダンプ `goods`
--

INSERT INTO `goods` (`id`, `name`, `size`, `brand`) VALUES
('A12', 'ドライソックス', 'S', 'FIS'),
('A13', 'ドライソックス', 'M', 'FIS'),
('A301', '速乾タオル', 'F(40x80)', 'FIS'),
('B21', 'ボディボトル', '500ml', 'UDN'),
('B33', 'FastZack20', 'S/M', 'ADD'),
('D05', 'トレイルスパッツUT', 'M', 'UTG');

-- --------------------------------------------------------

--
-- テーブルの構造 `stock`
--

CREATE TABLE `stock` (
  `goods_id` varchar(10) NOT NULL,
  `quantity` int(4) NOT NULL DEFAULT 0
);

--
-- テーブルのデータのダンプ `stock`
--

INSERT INTO `stock` (`goods_id`, `quantity`) VALUES
('A12', 12),
('A13', 10),
('A301', 16),
('B21', 18),
('B33', 0),
('D05', 4);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand`);

--
-- テーブルのインデックス `stock`
--
ALTER TABLE `stock`
  ADD UNIQUE KEY `goods_id_index` (`goods_id`);

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `goods`
--
ALTER TABLE `goods`
  ADD CONSTRAINT `brand_id` 
  FOREIGN KEY (`brand`) 
  REFERENCES `brand` (`id`);

--
-- テーブルの制約 `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `goods_id` 
  FOREIGN KEY (`goods_id`) 
  REFERENCES `goods` (`id`);

-- inventoryユーザー

CREATE USER IF NOT EXISTS 'inventoryuser'@'localhost'
IDENTIFIED BY 'inventoryuser';

GRANT ALL ON inventory.* TO 'inventoryuser'@'localhost';
