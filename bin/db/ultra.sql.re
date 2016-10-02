SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `drm`;
CREATE TABLE IF NOT EXISTS `drm` (
  `drm0` varchar(32) NOT NULL,
  `drm1` varchar(16) NOT NULL,
  `drm2` varchar(16) NOT NULL,
  `drm3` varchar(32) NOT NULL,
  `drm4` varchar(32) NOT NULL,
  `drm5` varchar(256) NOT NULL,
  `drm6` varchar(256) NOT NULL,
  `drm7` varchar(16) NOT NULL,
  `drm8` varchar(40) NOT NULL,
  `drm9` varchar(14) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='DRM';

INSERT INTO `drm` (`drm0`, `drm1`, `drm2`, `drm3`, `drm4`, `drm5`, `drm6`, `drm7`, `drm8`, `drm9`) VALUES
('00000000-0000-0000-0000-00000000', '0000000000000000', '1111111111111111', '11111111111111111111111111111111', 'admin', '56a0edb0eb5f1c9d17889e16610ce5dc01225de8683312ecdb9eb4c90006a910', '56a0edb0eb5f1c9d17889e16610ce5dc01225de8683312ecdb9eb4c90006a910', '/', '/', '20110101');

DROP TABLE IF EXISTS `udr`;
CREATE TABLE IF NOT EXISTS `udr` (
  `udr0` varchar(16) NOT NULL,
  `udr1` varchar(64) NOT NULL,
  `udr2` varchar(64) NOT NULL,
  `udr3` varchar(32) NOT NULL,
  `udr4` varchar(32) NOT NULL,
  `udr5` varchar(16) NOT NULL,
  `udr6` varchar(40) NOT NULL,
  `udr7` varchar(14) NOT NULL,
  `udr8` varchar(8) NOT NULL,
  `udr9` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='UDR';

INSERT INTO `udr` (`udr0`, `udr1`, `udr2`, `udr3`, `udr4`, `udr5`, `udr6`, `udr7`, `udr8`, `udr9`) VALUES
('0000000000000000', 'info@ultrablock.net', 'info@ultrablock.net', '00000000000', '00000000000', '/', '/', '20150101', '1985', '1');

DROP TABLE IF EXISTS `uhr`;
CREATE TABLE IF NOT EXISTS `uhr` (
  `uhr0` varchar(16) NOT NULL,
  `uhr1` varchar(256) NOT NULL,
  `uhr2` varchar(40) NOT NULL,
  `uhr3` varchar(256) NOT NULL,
  `uhr4` varchar(40) NOT NULL,
  `uhr5` int(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `uhr` (`uhr0`, `uhr1`, `uhr2`, `uhr3`, `uhr4`, `uhr5`) VALUES
('0000000000000000', 'wwJLPb8fwWm8ddOYRiUHHp4IiVBIL8VmXs7czn5tzzVMOdul2f9Y1ieM2ccMC3ZQ0fS09lhNUAUIlrqXHdMHW6OqqBk8sKDyyoFfht6Qc8FomByzNeeRmGWrZiAq9bzta5eE3Lw4UgoS3Q8kcCFaYhK8nyk4p56LnANA4gRjzvq6C4wvjbAYWKxCFbxKKvsg9i7AyFlTevha9kQyI05aUecWjyCcFHVD7ITEt4TSch2hSUfoddGR8hY9koP250C2', '/', 'wwJLPb8fwWm8ddOYRiUHHp4IiVBIL8VmXs7czn5tzzVMOdul2f9Y1ieM2ccMC3ZQ0fS09lhNUAUIlrqXHdMHW6OqqBk8sKDyyoFfht6Qc8FomByzNeeRmGWrZiAq9bzta5eE3Lw4UgoS3Q8kcCFaYhK8nyk4p56LnANA4gRjzvq6C4wvjbAYWKxCFbxKKvsg9i7AyFlTevha9kQyI05aUecWjyCcFHVD7ITEt4TSch2hSUfoddGR8hY9koP250C2', '/', 999998);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
