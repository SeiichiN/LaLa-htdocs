--
-- SQLインジェクションのためのサンプルデータベース
--

--
-- ユーザー
--
CREATE USER IF NOT EXISTS 'junbiuser'@'localhost'
  IDENTIFIED BY 'junbiuser';

GRANT ALL ON junbi.* TO 'junbiuser'@'localhost';

--
-- データベース
--
CREATE DATABASE IF NOT EXISTS junbi;
USE junbi;

--
-- サンプルテーブル
--
DROP TABLE IF EXISTS account;

CREATE TABLE account (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50),
  password VARCHAR(50)
);

INSERT INTO account (name, password) VALUES
('浦島太郎', '1111'),
('乙姫', '2222');

SELECT * FROM account;


--
-- 修正時刻: Sun 2023/10/08 13:15:47
--

