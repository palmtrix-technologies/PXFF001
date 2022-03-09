-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 09, 2022 at 03:51 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ferryfolks_freightbrid`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `GerUsers`$$
CREATE DEFINER=`ferryfolks`@`localhost` PROCEDURE `GerUsers` ()  Select * From accounts_subledger$$

DROP PROCEDURE IF EXISTS `sp_Accounts_DayBook`$$
CREATE DEFINER=`ferryfolks`@`localhost` PROCEDURE `sp_Accounts_DayBook` (IN `p_fromdate` DATE, IN `p_todate` DATE)  begin
CREATE TEMPORARY TABLE DayBook( Dates date, Particular varchar(200),Debit  decimal(18,2), Credit decimal(18,2), VoucherType varchar(8000), LedgerID int ,Narration varchar(8000) );
INSERT INTO DayBook(Dates , Particular ,Debit  , Credit ,VoucherType ,LedgerID ,Narration )
select Accounts_AccountMaster.TransferDate, Accounts_Ledger.Ledger_Name  AS PARTICULARLS,
Accounts_AccountMaster.Amount,'0.00' as CreditAmount,
Accounts_AccountMaster.VoucherType ,Accounts_Ledger.LedgerID ,Accounts_AccountMaster.Narration
from Accounts_AccountMaster
join Accounts_Ledger on Accounts_AccountMaster.DebitAccount=Accounts_Ledger.LedgerID 
where TransferDate between @fromdate and @todate ;
INSERT INTO DayBook(Dates , Particular ,Debit  , Credit ,VoucherType ,LedgerID ,Narration )
select Accounts_AccountMaster.TransferDate, Accounts_Ledger.Ledger_Name AS PARTICULARLS,'0.00',Accounts_AccountMaster.Amount as CreditAmount,
Accounts_AccountMaster.VoucherType ,Accounts_Ledger.LedgerID ,Accounts_AccountMaster.Narration
from Accounts_AccountMaster
join Accounts_Ledger on 
Accounts_AccountMaster.CreditAccount=Accounts_Ledger.LedgerID 
where TransferDate between @fromdate and @todate ;
select Dates , Particular ,Debit  , Credit ,VoucherType,LedgerID,Narration  from DayBook order by Dates;
end$$

DROP PROCEDURE IF EXISTS `sp_Accounts_TransactionEntry`$$
CREATE DEFINER=`ferryfolks`@`localhost` PROCEDURE `sp_Accounts_TransactionEntry` (IN `p_FromLedgerID` INT, IN `p_ToLedgerID` INT, IN `p_Amount` INT, IN `p_TranscationDate` DATE, IN `p_Narration` INT, IN `p_PayMode` LONGTEXT, IN `p_Cheque_DetailsID` BIGINT)  BEGIN
declare v_AccountMasterID bigint;
	set v_AccountMasterID=(select case when MAX(AccountMasterID) IS null then 1 else MAX(AccountMasterID)+1 end from Accounts_AccountMaster);
	INSERT INTO Accounts_AccountMaster
     VALUES
     (
		 v_AccountMasterID,
		 p_FromLedgerID  ,
		 p_ToLedgerID  ,
		 p_Amount  ,
		 p_TranscationDate  ,
		 p_Narration  ,
		 p_PayMode  ,
		 p_Cheque_DetailsID
     );
END$$

DROP PROCEDURE IF EXISTS `SP_TrailBalance`$$
CREATE DEFINER=`ferryfolks`@`localhost` PROCEDURE `SP_TrailBalance` (INOUT `emailList` VARCHAR(4000))  BEGIN
DECLARE finished INTEGER DEFAULT 0;
    DECLARE outputstring varchar(100) DEFAULT "";
    DEClARE curTrailbalance
        CURSOR FOR 
            SELECT Ledger_Name FROM accounts_ledger;
    -- declare NOT FOUND handler
    DECLARE CONTINUE HANDLER 
        FOR NOT FOUND SET finished = 1;
    OPEN curTrailbalance;
    getTrailbalance:LOOP
        FETCH curTrailbalance INTO outputstring;
        IF finished = 1 THEN 
            LEAVE getTrailbalance;
        END IF;
        -- build email list
        SET emailList = CONCAT(outputstring,";",emailList);
    END LOOP getTrailbalance;
    CLOSE curTrailbalance;
END$$

DROP PROCEDURE IF EXISTS `test`$$
CREATE DEFINER=`ferryfolks`@`localhost` PROCEDURE `test` (INOUT `emailList` VARCHAR(4000))  BEGIN
DECLARE finished INTEGER DEFAULT 0;
    DECLARE emailAddress varchar(100) DEFAULT "";
    DEClARE curEmail 
        CURSOR FOR 
            SELECT AccountMasterID  FROM accounts_accountmaster;
    -- declare NOT FOUND handler
    DECLARE CONTINUE HANDLER 
        FOR NOT FOUND SET finished = 1;
    OPEN curEmail;
    getEmail: LOOP
        FETCH curEmail INTO emailAddress;
        IF finished = 1 THEN 
            LEAVE getEmail;
        END IF;
        -- build email list
        SET emailList = CONCAT(emailAddress,";",emailList);
    END LOOP getEmail;
    CLOSE curEmail;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `accounts_accountmaster`
--

DROP TABLE IF EXISTS `accounts_accountmaster`;
CREATE TABLE IF NOT EXISTS `accounts_accountmaster` (
  `AccountMasterID` int(100) NOT NULL AUTO_INCREMENT,
  `CreditAccount` bigint(20) NOT NULL,
  `DebitAccount` bigint(20) NOT NULL,
  `Amount` decimal(18,2) NOT NULL,
  `TransferDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Narration` longtext DEFAULT NULL,
  `VoucherType` longtext DEFAULT NULL,
  `Cheque_DetailsID` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`AccountMasterID`)
) ENGINE=MyISAM AUTO_INCREMENT=490 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts_accountmaster`
--

INSERT INTO `accounts_accountmaster` (`AccountMasterID`, `CreditAccount`, `DebitAccount`, `Amount`, `TransferDate`, `Narration`, `VoucherType`, `Cheque_DetailsID`) VALUES
(100, 57, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(99, 76, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(98, 75, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(97, 74, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(96, 70, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(95, 69, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(94, 68, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(93, 67, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(92, 66, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(91, 73, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(90, 72, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(89, 65, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(88, 56, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(87, 1, 28, '0.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(86, 1, 27, '0.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(85, 1, 25, '75329.84', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(84, 1, 24, '62688.28', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(83, 1, 23, '3203.95', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(82, 1, 22, '17103.05', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(81, 1, 21, '0.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(80, 1, 20, '0.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(79, 1, 19, '0.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(78, 1, 18, '16322.65', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(77, 1, 17, '71256.76', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(76, 1, 31, '47466.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(75, 1, 29, '6200.20', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(74, 1, 127, '31593.52', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(73, 1, 126, '0.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(72, 1, 55, '0.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(71, 1, 54, '0.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(70, 1, 53, '0.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(69, 1, 52, '61612.99', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(68, 1, 51, '0.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(67, 1, 50, '8177.50', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(66, 1, 49, '0.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(65, 1, 48, '0.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(64, 1, 47, '58885.79', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(63, 1, 45, '0.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(62, 1, 44, '0.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(61, 1, 43, '0.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(60, 1, 42, '84651.79', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(59, 1, 40, '0.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(58, 1, 39, '13843.44', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(57, 1, 38, '9259.75', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(56, 1, 37, '85140.80', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(55, 1, 36, '1308.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(54, 1, 35, '0.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(53, 1, 34, '231416.29', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(52, 1, 33, '0.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(51, 1, 32, '0.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(101, 77, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(102, 79, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(103, 80, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(104, 81, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(105, 82, 1, '16998.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(106, 83, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(107, 84, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(108, 85, 1, '1575.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(109, 86, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(110, 58, 1, '34596.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(111, 87, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(112, 88, 1, '5860.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(113, 89, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(114, 91, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(115, 92, 1, '525.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(116, 93, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(117, 94, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(118, 95, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(119, 96, 1, '2680.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(120, 59, 1, '16808.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(121, 97, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(122, 98, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(123, 99, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(124, 100, 1, '13005.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(125, 101, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(126, 102, 1, '14344.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(127, 103, 1, '1485.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(128, 104, 1, '500.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(129, 128, 1, '30700.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(130, 129, 1, '7159.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(131, 60, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(132, 130, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(133, 131, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(134, 133, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(135, 134, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(136, 135, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(137, 61, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(138, 62, 1, '6861.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(139, 63, 1, '0.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(140, 64, 1, '1339.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(141, 78, 1, '250.00', '2020-10-01 12:29:07', 'Openning Balance', 'transfer', NULL),
(142, 1, 16, '14843.57', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(143, 1, 41, '8320.84', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(144, 1, 15, '214901.50', '2020-10-01 12:43:39', 'Openning Balance', 'Opening Balnce', NULL),
(145, 2, 1, '248730.55', '2020-10-07 12:37:28', 'Openning Balance', 'Opening Balnce', NULL),
(146, 105, 1, '415347.37', '2020-10-01 12:43:39', 'Openning Balance', 'Opening Balnce', NULL),
(147, 106, 1, '415347.36', '2020-10-01 12:43:39', 'Openning Balance', 'Opening Balnce', NULL),
(159, 1, 13, '180.00', '2020-10-04 10:49:01', 'Invoice .1. created for JobNo:.501. ,VAT Amount:.1380.00.', 'VAT', 0),
(158, 1, 24, '1380.00', '2020-10-04 10:09:30', 'Invoice .1. created for JobNo:.501. ,debited Amount:.1380.00.', 'Invoice', 0),
(151, 1, 146, '1380.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(152, 1, 147, '1472.00', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(153, 1, 148, '7900.62', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(154, 151, 1, '18100.64', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(155, 152, 1, '2462.80', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(156, 153, 1, '1454.41', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(157, 1, 154, '126848.03', '2020-10-01 12:28:47', 'Openning Balance', 'transfer', NULL),
(160, 71, 1, '800.00', '2020-10-06 07:07:57', 'Expense .1. created for JobNo:501,Amount:.800.00.', 'Supplier Expense', 0),
(181, 2, 156, '402.50', '2020-10-09 18:30:00', 'JOB 507', 'payment', 0),
(162, 66, 1, '40328.25', '2020-10-04 18:30:00', 'Expense .2. created for JobNo:.2.,Amount:.40328.25.', 'Supplier Expense', 0),
(163, 13, 1, '5850.00', '2020-10-06 12:54:30', 'Expense .2. created for JobNo:.2.,VAT Amount:.40328.25.', 'VAT', 0),
(164, 134, 1, '1000.00', '2020-10-04 18:30:00', 'Expense .4. created for JobNo:.2.,Amount:.1000.00.', 'Supplier Expense', 0),
(180, 25, 2, '25000.00', '2020-10-09 18:30:00', 'MIX JOB ADVANCE', 'receipt', 0),
(166, 71, 1, '5000.00', '2020-10-04 18:30:00', 'Expense .3. created for JobNo:.2.,Amount:.5000.00.', 'Supplier Expense', 0),
(179, 156, 1, '402.50', '2020-10-09 18:30:00', 'Expense .7. created for JobNo:.7.,Amount:.402.50.', 'Supplier Expense', 0),
(168, 71, 1, '473.00', '2020-10-04 18:30:00', 'Expense .5. created for JobNo:.3.,Amount:.473.00.', 'Supplier Expense', 0),
(178, 50, 2, '8177.50', '2020-10-06 18:30:00', 'PAYMENT OPENING BALANCE', 'receipt', 0),
(170, 1, 24, '1230.50', '2020-10-05 18:30:00', 'Invoice .1456. created for JobNo:.3. ,debited Amount:.1230.50.', 'Invoice', 0),
(171, 1, 13, '157.50', '2020-10-05 18:30:00', 'Invoice .1456. created for JobNo:.3. ,VAT Amount:.1230.50.', 'VAT', 0),
(172, 1, 31, '76883.25', '2020-10-05 18:30:00', 'Invoice .1455. created for JobNo:.2. ,debited Amount:.76883.25.', 'Invoice', 0),
(173, 1, 13, '9855.00', '2020-10-05 18:30:00', 'Invoice .1455. created for JobNo:.2. ,VAT Amount:.76883.25.', 'VAT', 0),
(174, 155, 1, '2879.91', '2020-10-05 18:30:00', 'Expense .6. created for JobNo:.4.,Amount:.2879.91.', 'Supplier Expense', 0),
(177, 2, 71, '5000.00', '2020-10-06 18:30:00', 'OPENING BALNCE CLOSED', 'payment', 0),
(182, 2, 71, '473.00', '2020-10-09 18:30:00', 'JOB 503', 'payment', 0),
(183, 2, 71, '800.00', '2020-10-09 18:30:00', 'JOB 501', 'payment', 0),
(184, 2, 66, '6000.00', '2020-10-09 18:30:00', 'ADVANCE', 'payment', 0),
(185, 2, 122, '315.00', '2020-10-09 18:30:00', 'STATIONARY', 'payment', 0),
(186, 42, 15, '35061.00', '2020-10-10 18:30:00', 'JOB 335', 'receipt', 0),
(187, 15, 123, '180.00', '2020-10-10 18:30:00', 'H K AL SADIQ VAT ISSUE ADJUST', 'payment', 0),
(188, 15, 157, '2193.75', '2020-10-11 18:30:00', 'JOB 448', 'payment', 0),
(189, 15, 158, '2321.25', '2020-10-11 18:30:00', 'JOB 445', 'payment', 0),
(190, 71, 1, '800.00', '2020-10-11 18:30:00', 'Expense .9. created for JobNo:.9.,Amount:.800.00.', 'Supplier Expense', 0),
(191, 1, 24, '1380.00', '2020-10-11 18:30:00', 'Invoice .1459. created for JobNo:.9. ,debited Amount:.1380.00.', 'Invoice', 0),
(192, 1, 13, '180.00', '2020-10-11 18:30:00', 'Invoice .1459. created for JobNo:.9. ,VAT Amount:.1380.00.', 'VAT', 0),
(193, 71, 1, '800.00', '2020-10-11 18:30:00', 'Expense .10. created for JobNo:.10.,Amount:.800.00.', 'Supplier Expense', 0),
(194, 1, 24, '1380.00', '2020-10-11 18:30:00', 'Invoice .1460. created for JobNo:.10. ,debited Amount:.1380.00.', 'Invoice', 0),
(195, 1, 13, '180.00', '2020-10-11 18:30:00', 'Invoice .1460. created for JobNo:.10. ,VAT Amount:.1380.00.', 'VAT', 0),
(196, 1, 24, '18405.20', '2020-10-11 18:30:00', 'Invoice .1458. created for JobNo:.8. ,debited Amount:.18405.20.', 'Invoice', 0),
(198, 82, 1, '16874.88', '2020-10-11 18:30:00', 'Expense .8. created for JobNo:.8.,Amount:.16874.88.', 'Supplier Expense', 0),
(199, 71, 1, '800.00', '2020-10-11 18:30:00', 'Expense .11. created for JobNo:.11.,Amount:.800.00.', 'Supplier Expense', 0),
(200, 71, 1, '2600.00', '2020-10-11 18:30:00', 'Expense .12. created for JobNo:.12.,Amount:.2600.00.', 'Supplier Expense', 0),
(201, 157, 1, '2199.60', '2020-10-11 18:30:00', 'Expense .13. created for JobNo:.13.,Amount:.2199.60.', 'Supplier Expense', 0),
(202, 135, 1, '200.00', '2020-10-11 18:30:00', 'Expense .14. created for JobNo:.13.,Amount:.200.00.', 'Supplier Expense', 0),
(203, 1, 24, '1380.00', '2020-10-12 18:30:00', 'Invoice .1464. created for JobNo:.11. ,debited Amount:.1380.00.', 'Invoice', 0),
(204, 1, 13, '180.00', '2020-10-12 18:30:00', 'Invoice .1464. created for JobNo:.11. ,VAT Amount:.1380.00.', 'VAT', 0),
(205, 1, 24, '1380.00', '2020-10-13 18:30:00', 'Invoice .1465. created for JobNo:.15. ,debited Amount:.1380.00.', 'Invoice', 0),
(206, 1, 13, '180.00', '2020-10-13 18:30:00', 'Invoice .1465. created for JobNo:.15. ,VAT Amount:.1380.00.', 'VAT', 0),
(207, 71, 1, '800.00', '2020-10-13 18:30:00', 'Expense .16. created for JobNo:.15.,Amount:.800.00.', 'Supplier Expense', 0),
(208, 1, 38, '1485.20', '2020-10-11 18:30:00', 'Invoice .1463. created for JobNo:.14. ,debited Amount:.1485.20.', 'Invoice', 0),
(350, 1, 41, '1109.20', '2020-10-27 18:30:00', 'Invoice .1490. created for JobNo:.5. ,debited Amount:.1109.20.', 'Invoice', 0),
(210, 1, 19, '2827.52', '2020-10-05 18:30:00', 'Invoice .1457. created for JobNo:.4. ,debited Amount:.2827.52.', 'Invoice', 0),
(211, 1, 13, '0.00', '2020-10-05 18:30:00', 'Invoice .1457. created for JobNo:.4. ,VAT Amount:.2827.52.', 'VAT', 0),
(212, 130, 1, '1068.75', '2020-10-11 18:30:00', 'Expense .15. created for JobNo:.14.,Amount:.1068.75.', 'Supplier Expense', 0),
(213, 1, 29, '2763.60', '2020-10-11 18:30:00', 'Invoice .1462. created for JobNo:.13. ,debited Amount:.2763.60.', 'Invoice', 0),
(349, 13, 1, '82.50', '2020-10-27 18:30:00', 'Expense .55. created for JobNo:.19.,VAT Amount:.921.71.', 'VAT', 0),
(215, 1, 18, '3565.00', '2020-10-11 18:30:00', 'Invoice .1461. created for JobNo:.12. ,debited Amount:.3565.00.', 'Invoice', 0),
(216, 1, 13, '465.00', '2020-10-11 18:30:00', 'Invoice .1461. created for JobNo:.12. ,VAT Amount:.3565.00.', 'VAT', 0),
(217, 1, 24, '1380.00', '2020-10-14 18:30:00', 'Invoice .1466. created for JobNo:.16. ,debited Amount:.1380.00.', 'Invoice', 0),
(218, 1, 13, '180.00', '2020-10-14 18:30:00', 'Invoice .1466. created for JobNo:.16. ,VAT Amount:.1380.00.', 'VAT', 0),
(219, 71, 1, '800.00', '2020-10-14 18:30:00', 'Expense .17. created for JobNo:.16.,Amount:.800.00.', 'Supplier Expense', 0),
(220, 71, 1, '800.00', '2020-10-14 18:30:00', 'Expense .18. created for JobNo:.17.,Amount:.800.00.', 'Supplier Expense', 0),
(221, 1, 24, '1380.00', '2020-10-14 18:30:00', 'Invoice .1467. created for JobNo:.17. ,debited Amount:.1380.00.', 'Invoice', 0),
(222, 1, 13, '180.00', '2020-10-14 18:30:00', 'Invoice .1467. created for JobNo:.17. ,VAT Amount:.1380.00.', 'VAT', 0),
(223, 82, 1, '4342.80', '2020-10-14 18:30:00', 'Expense .19. created for JobNo:.18.,Amount:.4342.80.', 'Supplier Expense', 0),
(224, 39, 15, '11162.44', '2020-10-16 18:30:00', 'JOB 391, 450', 'receipt', 0),
(225, 15, 102, '15643.00', '2020-10-16 18:30:00', 'MIX JOB', 'payment', 0),
(226, 24, 15, '20129.04', '2020-10-16 18:30:00', 'JOB 426   BANK CHARGES PREVIOUS ALSO ADJUSTED 45.00 SAR', 'receipt', 0),
(227, 31, 15, '47466.00', '2020-10-16 18:30:00', 'JOB 343, 342, 394', 'receipt', 0),
(228, 37, 15, '61646.30', '2020-10-16 18:30:00', 'MIX JOB', 'receipt', 0),
(229, 15, 151, '18100.64', '2020-10-16 18:30:00', 'JOB 426', 'payment', 0),
(230, 15, 123, '50.83', '2020-10-16 18:30:00', 'MIX TRANSACTIONS', 'payment', 0),
(231, 18, 2, '14509.35', '2020-10-16 18:30:00', 'JOB 327, 354', 'receipt', 0),
(232, 2, 156, '402.50', '2020-10-16 18:30:00', 'JOB 519', 'payment', 0),
(233, 2, 66, '30000.00', '2020-10-16 18:30:00', 'ADVANCE', 'payment', 0),
(234, 2, 66, '10000.00', '2020-10-16 18:30:00', 'ADVANCE', 'payment', 0),
(235, 2, 68, '1596.32', '2020-10-16 18:30:00', 'JOB 520', 'payment', 0),
(236, 2, 71, '5000.00', '2020-10-16 18:30:00', 'JOB 509, 512', 'payment', 0),
(237, 2, 121, '1070.00', '2020-10-16 18:30:00', 'ANUAL PARTY', 'payment', 0),
(238, 2, 71, '2400.00', '2020-10-16 18:30:00', 'JOB 515, 516, 517', 'payment', 0),
(239, 2, 117, '2070.00', '2020-10-16 18:30:00', 'ZUHIN FAMILY TICKET AND VISA RENEWAL EXP', 'payment', 0),
(240, 156, 1, '402.50', '2020-10-17 18:30:00', 'Expense .20. created for JobNo:.19.,Amount:.402.50.', 'Supplier Expense', 0),
(241, 71, 1, '750.00', '2020-10-17 18:30:00', 'Expense .22. created for JobNo:.21.,Amount:.750.00.', 'Supplier Expense', 0),
(242, 68, 1, '1596.32', '2020-10-17 18:30:00', 'Expense .21. created for JobNo:.20.,Amount:.1596.32.', 'Supplier Expense', 0),
(243, 157, 1, '8530.91', '2020-10-17 18:30:00', 'Expense .23. created for JobNo:.22.,Amount:.8530.91.', 'Supplier Expense', 0),
(244, 77, 1, '1728.00', '2020-10-17 18:30:00', 'Expense .25. created for JobNo:.7.,Amount:.1728.00.', 'Supplier Expense', 0),
(245, 13, 1, '172.50', '2020-10-17 18:30:00', 'Expense .25. created for JobNo:.7.,VAT Amount:.1728.00.', 'VAT', 0),
(246, 62, 1, '1709.36', '2020-10-17 18:30:00', 'Expense .26. created for JobNo:.7.,Amount:.1709.36.', 'Supplier Expense', 0),
(247, 101, 1, '8263.35', '2020-10-18 18:30:00', 'Expense .27. created for JobNo:.28.,Amount:.8263.35.', 'Supplier Expense', 0),
(248, 129, 1, '2500.00', '2020-10-18 18:30:00', 'Expense .28. created for JobNo:.28.,Amount:.2500.00.', 'Supplier Expense', 0),
(249, 13, 1, '375.00', '2020-10-18 18:30:00', 'Expense .28. created for JobNo:.28.,VAT Amount:.2500.00.', 'VAT', 0),
(250, 66, 1, '2554.56', '2020-10-18 18:30:00', 'Expense .29. created for JobNo:.28.,Amount:.2554.56.', 'Supplier Expense', 0),
(251, 13, 1, '82.50', '2020-10-18 18:30:00', 'Expense .29. created for JobNo:.28.,VAT Amount:.2554.56.', 'VAT', 0),
(252, 159, 1, '100.00', '2020-10-17 18:30:00', 'Expense .24. created for JobNo:.23.,Amount:.100.00.', 'Supplier Expense', 0),
(253, 66, 1, '883.80', '2020-10-18 18:30:00', 'Expense .34. created for JobNo:.20.,Amount:.883.80.', 'Supplier Expense', 0),
(254, 13, 1, '82.50', '2020-10-18 18:30:00', 'Expense .34. created for JobNo:.20.,VAT Amount:.883.80.', 'VAT', 0),
(255, 89, 1, '4193.05', '2020-10-18 18:30:00', 'Expense .33. created for JobNo:.20.,Amount:.4193.05.', 'Supplier Expense', 0),
(256, 160, 1, '1915.76', '2020-10-18 18:30:00', 'Expense .35. created for JobNo:.23.,Amount:.1915.76.', 'Supplier Expense', 0),
(257, 82, 1, '750.00', '2020-10-19 18:30:00', 'Expense .37. created for JobNo:.26.,Amount:.750.00.', 'Supplier Expense', 0),
(258, 102, 1, '2158.00', '2020-10-19 18:30:00', 'Expense .38. created for JobNo:.26.,Amount:.2158.00.', 'Supplier Expense', 0),
(259, 13, 1, '90.00', '2020-10-19 18:30:00', 'Expense .38. created for JobNo:.26.,VAT Amount:.2158.00.', 'VAT', 0),
(260, 71, 1, '2000.00', '2020-10-19 18:30:00', 'Expense .39. created for JobNo:.29.,Amount:.2000.00.', 'Supplier Expense', 0),
(261, 88, 1, '23487.28', '2020-10-19 18:30:00', 'Expense .40. created for JobNo:.30.,Amount:.23487.28.', 'Supplier Expense', 0),
(262, 1, 154, '5301.60', '2020-10-14 18:30:00', 'Invoice .1468. created for JobNo:.18. ,debited Amount:.5301.60.', 'Invoice', 0),
(347, 75, 1, '2949.71', '2020-10-27 18:30:00', 'Expense .56. created for JobNo:.19.,Amount:.2949.71.', 'Supplier Expense', 0),
(348, 66, 1, '921.71', '2020-10-27 18:30:00', 'Expense .55. created for JobNo:.19.,Amount:.921.71.', 'Supplier Expense', 0),
(265, 1, 154, '706.88', '2020-10-14 18:30:00', 'Invoice .1. generated for Job No:.18.,deited amount:706.88.', 'Credit Invoice', 0),
(351, 1, 41, '0.00', '2020-10-27 18:30:00', 'Invoice .1490. created for JobNo:.5. ,VAT Amount:.0.00.', 'VAT', 0),
(345, 75, 1, '15812.97', '2020-10-27 18:30:00', 'Expense .53. created for JobNo:.44.,Amount:.15812.97.', 'Supplier Expense', 0),
(346, 103, 1, '200.00', '2020-10-27 18:30:00', 'Expense .54. created for JobNo:.44.,Amount:.200.00.', 'Supplier Expense', 0),
(269, 66, 1, '635.23', '2020-10-18 18:30:00', 'Expense .31. created for JobNo:.27.,Amount:.635.23.', 'Supplier Expense', 0),
(270, 13, 1, '52.50', '2020-10-18 18:30:00', 'Expense .31. created for JobNo:.27.,VAT Amount:.635.23.', 'VAT', 0),
(271, 101, 1, '2151.04', '2020-10-18 18:30:00', 'Expense .30. created for JobNo:.27.,Amount:.2151.04.', 'Supplier Expense', 0),
(272, 1, 42, '10028.43', '2020-10-18 18:30:00', 'Invoice .1472. created for JobNo:.27. ,debited Amount:.10028.43.', 'Invoice', 0),
(273, 129, 1, '2500.00', '2020-10-18 18:30:00', 'Expense .32. created for JobNo:.27.,Amount:.2500.00.', 'Supplier Expense', 0),
(274, 13, 1, '375.00', '2020-10-18 18:30:00', 'Expense .32. created for JobNo:.27.,VAT Amount:.2500.00.', 'VAT', 0),
(343, 1, 162, '402.50', '2020-10-26 18:30:00', 'Invoice .1487. created for JobNo:.43. ,debited Amount:.402.50.', 'Invoice', 0),
(344, 1, 162, '0.00', '2020-10-26 18:30:00', 'Invoice .1487. created for JobNo:.43. ,VAT Amount:.0.00.', 'VAT', 0),
(277, 71, 1, '650.00', '2020-10-21 18:30:00', 'Expense .42. created for JobNo:.34.,Amount:.650.00.', 'Supplier Expense', 0),
(278, 22, 15, '9474.45', '2020-10-23 18:30:00', 'JOB 249', 'receipt', 0),
(279, 15, 2, '100000.00', '2020-10-23 18:30:00', 'BANK TO CASH', 'contra', 0),
(280, 16, 15, '10000.00', '2020-10-23 18:30:00', 'PAYMENT GASHASH TO INMA BANK', 'receipt', 0),
(281, 15, 155, '2879.91', '2020-10-23 18:30:00', 'MIX JOB', 'payment', 0),
(282, 15, 77, '1900.50', '2020-10-23 18:30:00', 'JOB MIX', 'payment', 0),
(283, 15, 82, '17748.00', '2020-10-23 18:30:00', 'JOB MIX OPENING AND ONE NEW JOB', 'payment', 0),
(284, 15, 153, '1454.41', '2020-10-23 18:30:00', 'OPENING BALANCE', 'payment', 0),
(285, 15, 121, '5637.00', '2020-10-23 18:30:00', 'PPL NETWORK', 'payment', 0),
(286, 15, 66, '5000.00', '2020-10-23 18:30:00', 'ADVANCE', 'payment', 0),
(287, 15, 102, '7927.01', '2020-10-23 18:30:00', 'ADVANCE AND OLD INVOICE', 'payment', 0),
(288, 15, 123, '37.10', '2020-10-23 18:30:00', 'MIX TRANSACTIONS', 'payment', 0),
(289, 1, 160, '1915.76', '2020-10-23 18:30:00', 'Payment To supplier,Amount:.1915.76.', 'Payment', 0),
(290, 2, 160, '1915.76', '2020-10-23 18:30:00', 'JOB 523', 'payment', 0),
(291, 2, 107, '533.97', '2020-10-23 18:30:00', 'ZUHIN 305, SHAHBAZ 115 AND TELEPHONE', 'payment', 0),
(292, 2, 134, '1000.00', '2020-10-23 18:30:00', '502', 'payment', 0),
(293, 2, 71, '3400.00', '2020-10-23 18:30:00', 'JOB 530, 527, 521', 'payment', 0),
(294, 2, 68, '2744.32', '2020-10-23 18:30:00', 'JOB 519', 'payment', 0),
(295, 2, 68, '4427.07', '2020-10-23 18:30:00', 'JOB EZDEHAR', 'payment', 0),
(296, 2, 161, '25000.00', '2020-10-23 18:30:00', 'ZUHIN BONUS 2020', 'payment', 0),
(297, 2, 121, '1040.00', '2020-10-23 18:30:00', 'CHARITY C/O ZUHIN', 'payment', 0),
(298, 69, 1, '1308.00', '2020-10-27 08:42:53', 'Expense .45. created for JobNo:.2.,Amount:.1308.00.', 'Supplier Expense', 0),
(299, 71, 1, '750.00', '2020-10-24 18:30:00', 'Expense .44. created for JobNo:.37.,Amount:.750.00.', 'Supplier Expense', 0),
(306, 1, 24, '1380.00', '2020-10-17 18:30:00', 'Invoice .1469. created for JobNo:.21. ,debited Amount:.1380.00.', 'Invoice', 0),
(301, 1, 24, '1380.00', '2020-10-24 18:30:00', 'Invoice .1481. created for JobNo:.37. ,debited Amount:.1380.00.', 'Invoice', 0),
(302, 1, 24, '4324.00', '2020-10-21 18:30:00', 'Invoice .1480. created for JobNo:.35. ,debited Amount:.4324.00.', 'Invoice', 0),
(303, 88, 1, '2736.00', '2020-10-21 18:30:00', 'Expense .43. created for JobNo:.35.,Amount:.2736.00.', 'Supplier Expense', 0),
(304, 1, 24, '1380.00', '2020-10-21 18:30:00', 'Invoice .1479. created for JobNo:.34. ,debited Amount:.1380.00.', 'Invoice', 0),
(305, 71, 1, '750.00', '2020-10-24 18:30:00', 'Expense .44. created for JobNo:.37.,Amount:.750.00.', 'Supplier Expense', 0),
(307, 1, 24, '9243.58', '2020-10-17 18:30:00', 'Invoice .1470. created for JobNo:.22. ,debited Amount:.9243.58.', 'Invoice', 0),
(308, 1, 24, '0.00', '2020-10-17 18:30:00', 'Invoice .1470. created for JobNo:.22. ,VAT Amount:.0.00.', 'VAT', 0),
(313, 1, 24, '1380.00', '2020-10-25 18:30:00', 'Invoice .1482. created for JobNo:.38. ,debited Amount:.1380.00.', 'Invoice', 0),
(314, 1, 24, '180.00', '2020-10-25 18:30:00', 'Invoice .1482. created for JobNo:.38. ,VAT Amount:.180.00.', 'VAT', 0),
(315, 1, 24, '3795.00', '2020-10-25 18:30:00', 'Invoice .1483. created for JobNo:.39. ,debited Amount:.3795.00.', 'Invoice', 0),
(316, 1, 24, '495.00', '2020-10-25 18:30:00', 'Invoice .1483. created for JobNo:.39. ,VAT Amount:.495.00.', 'VAT', 0),
(317, 71, 1, '2300.00', '2020-10-25 18:30:00', 'Expense .47. created for JobNo:.39.,Amount:.2300.00.', 'Supplier Expense', 0),
(318, 103, 1, '200.00', '2020-10-25 18:30:00', 'Expense .48. created for JobNo:.39.,Amount:.200.00.', 'Supplier Expense', 0),
(319, 1, 42, '8283.00', '2020-10-17 18:30:00', 'Invoice .1471. created for JobNo:.7. ,debited Amount:.8283.00.', 'Invoice', 0),
(320, 1, 42, '720.00', '2020-10-17 18:30:00', 'Invoice .1471. created for JobNo:.7. ,VAT Amount:.720.00.', 'VAT', 0),
(321, 1, 42, '8283.00', '2020-10-17 18:30:00', 'Invoice .1471. created for JobNo:.7. ,debited Amount:.8283.00.', 'Invoice', 0),
(322, 1, 42, '720.00', '2020-10-17 18:30:00', 'Invoice .1471. created for JobNo:.7. ,VAT Amount:.720.00.', 'VAT', 0),
(323, 1, 24, '27410.40', '2020-10-19 18:30:00', 'Invoice .1477. created for JobNo:.30. ,debited Amount:.27410.40.', 'Invoice', 0),
(324, 1, 24, '0.00', '2020-10-19 18:30:00', 'Invoice .1477. created for JobNo:.30. ,VAT Amount:.0.00.', 'VAT', 0),
(325, 1, 18, '8628.50', '2020-10-18 18:30:00', 'Invoice .1474. created for JobNo:.20. ,debited Amount:.8628.50.', 'Invoice', 0),
(326, 1, 18, '135.00', '2020-10-18 18:30:00', 'Invoice .1474. created for JobNo:.20. ,VAT Amount:.135.00.', 'VAT', 0),
(327, 1, 42, '23865.97', '2020-10-18 18:30:00', 'Invoice .1473. created for JobNo:.28. ,debited Amount:.23865.97.', 'Invoice', 0),
(328, 1, 42, '1305.00', '2020-10-18 18:30:00', 'Invoice .1473. created for JobNo:.28. ,VAT Amount:.1305.00.', 'VAT', 0),
(329, 1, 37, '4630.00', '2020-10-19 18:30:00', 'Invoice .1475. created for JobNo:.26. ,debited Amount:.4630.00.', 'Invoice', 0),
(330, 1, 37, '180.00', '2020-10-19 18:30:00', 'Invoice .1475. created for JobNo:.26. ,VAT Amount:.180.00.', 'VAT', 0),
(331, 1, 37, '2875.00', '2020-10-19 18:30:00', 'Invoice .1476. created for JobNo:.29. ,debited Amount:.2875.00.', 'Invoice', 0),
(332, 1, 37, '375.00', '2020-10-19 18:30:00', 'Invoice .1476. created for JobNo:.29. ,VAT Amount:.375.00.', 'VAT', 0),
(333, 1, 38, '2632.00', '2020-10-20 18:30:00', 'Invoice .1478. created for JobNo:.33. ,debited Amount:.2632.00.', 'Invoice', 0),
(334, 1, 38, '0.00', '2020-10-20 18:30:00', 'Invoice .1478. created for JobNo:.33. ,VAT Amount:.0.00.', 'VAT', 0),
(335, 1, 24, '10722.77', '2020-10-25 18:30:00', 'Invoice .1484. created for JobNo:.40. ,debited Amount:.10722.77.', 'Invoice', 0),
(336, 1, 24, '0.00', '2020-10-25 18:30:00', 'Invoice .1484. created for JobNo:.40. ,VAT Amount:.0.00.', 'VAT', 0),
(337, 75, 1, '9623.27', '2020-10-25 18:30:00', 'Expense .49. created for JobNo:.40.,Amount:.9623.27.', 'Supplier Expense', 0),
(338, 103, 1, '200.00', '2020-10-25 18:30:00', 'Expense .50. created for JobNo:.40.,Amount:.200.00.', 'Supplier Expense', 0),
(339, 1, 16, '200.00', '2020-10-25 18:30:00', 'Invoice .1485. created for JobNo:.41. ,debited Amount:.200.00.', 'Invoice', 0),
(340, 1, 16, '0.00', '2020-10-25 18:30:00', 'Invoice .1485. created for JobNo:.41. ,VAT Amount:.0.00.', 'VAT', 0),
(341, 1, 162, '540.50', '2020-10-25 18:30:00', 'Invoice .1486. created for JobNo:.43. ,debited Amount:.540.50.', 'Invoice', 0),
(342, 1, 162, '70.50', '2020-10-25 18:30:00', 'Invoice .1486. created for JobNo:.43. ,VAT Amount:.70.50.', 'VAT', 0),
(352, 76, 1, '693.75', '2020-10-27 18:30:00', 'Expense .57. created for JobNo:.5.,Amount:.693.75.', 'Supplier Expense', 0),
(353, 71, 1, '1000.00', '2020-10-28 18:30:00', 'Expense .59. created for JobNo:.45.,Amount:.1000.00.', 'Supplier Expense', 0),
(354, 17, 2, '15537.00', '2020-10-30 18:30:00', 'JOB 304, 325, 326, 340, 346, 347', 'receipt', 0),
(355, 154, 15, '70359.36', '2020-10-30 18:30:00', 'JOB 122, 106, 153, 176, 192, 229, 203, 226, 227, 228, 230, 247, 269, 275, 329, 330, 349', 'receipt', 0),
(356, 24, 15, '4370.00', '2020-10-30 18:30:00', 'JOB 446, 447', 'receipt', 0),
(357, 24, 15, '16288.80', '2020-10-30 18:30:00', 'JOB 419, 420', 'receipt', 0),
(358, 52, 15, '21660.00', '2020-10-30 18:30:00', 'JOB 377', 'receipt', 0),
(359, 38, 15, '9259.75', '2020-10-30 18:30:00', 'JOB 82, 90, 139, 337', 'receipt', 0),
(360, 24, 15, '3317.60', '2020-10-30 18:30:00', 'JOB 430', 'receipt', 0),
(361, 24, 15, '1380.00', '2020-10-30 18:30:00', 'Payment from client, Amount:.1380.00.', 'Payment', 5),
(362, 15, 66, '5000.00', '2020-10-30 18:30:00', 'ADVANCE', 'payment', 0),
(363, 15, 88, '44638.02', '2020-10-30 18:30:00', 'JOB 143, 528, 531, NEW', 'payment', 0),
(364, 15, 123, '146.26', '2020-10-30 18:30:00', 'MIX TRANSACTIONS', 'payment', 0),
(365, 36, 2, '1308.00', '2020-10-30 18:30:00', 'OLD BALANCE CLEARED', 'receipt', 0),
(366, 2, 69, '1308.00', '2020-10-30 18:30:00', 'BARRAK 502', 'payment', 0),
(367, 2, 156, '402.50', '2020-10-30 18:30:00', 'JOB 537', 'payment', 0),
(368, 2, 159, '700.00', '2020-10-30 18:30:00', 'JOB 537 MIX', 'payment', 0),
(369, 2, 71, '4800.00', '2020-10-30 18:30:00', 'JOB  532, 533, 534, 539', 'payment', 0),
(370, 71, 1, '2000.00', '2020-10-31 18:30:00', 'Expense .61. created for JobNo:.47.,Amount:.2000.00.', 'Supplier Expense', 0),
(371, 1, 37, '2875.00', '2020-10-31 18:30:00', 'Invoice .1494. created for JobNo:.47. ,debited Amount:.2875.00.', 'Invoice', 0),
(372, 1, 37, '375.00', '2020-10-31 18:30:00', 'Invoice .1494. created for JobNo:.47. ,VAT Amount:.375.00.', 'VAT', 0),
(373, 1, 24, '1380.00', '2020-10-31 18:30:00', 'Invoice .1495. created for JobNo:.48. ,debited Amount:.1380.00.', 'Invoice', 0),
(374, 1, 24, '180.00', '2020-10-31 18:30:00', 'Invoice .1495. created for JobNo:.48. ,VAT Amount:.180.00.', 'VAT', 0),
(375, 1, 41, '1880.00', '2020-10-28 18:30:00', 'Invoice .1491. created for JobNo:.6. ,debited Amount:.1880.00.', 'Invoice', 0),
(376, 1, 41, '0.00', '2020-10-28 18:30:00', 'Invoice .1491. created for JobNo:.6. ,VAT Amount:.0.00.', 'VAT', 0),
(377, 162, 2, '943.00', '2020-11-04 08:21:25', 'Payment from client, Amount:.943.00.', 'Receipt', 0),
(378, 102, 1, '2710.37', '2020-11-04 18:30:00', 'Expense .63. created for JobNo:.49.,Amount:.2710.37.', 'Supplier Expense', 0),
(379, 13, 1, '135.00', '2020-11-04 18:30:00', 'Expense .63. created for JobNo:.49.,VAT Amount:.2710.37.', 'VAT', 0),
(380, 164, 1, '3850.10', '2020-11-04 18:30:00', 'Expense .65. created for JobNo:.54.,Amount:.3850.10.', 'Supplier Expense', 0),
(381, 13, 1, '135.00', '2020-11-04 18:30:00', 'Expense .65. created for JobNo:.54.,VAT Amount:.3850.10.', 'VAT', 0),
(382, 71, 1, '6852.50', '2020-11-04 18:30:00', 'Expense .66. created for JobNo:.54.,Amount:.6852.50.', 'Supplier Expense', 0),
(383, 34, 15, '51223.00', '2020-11-06 18:30:00', 'JOB 238, 240, 267', 'receipt', 0),
(384, 15, 102, '3000.00', '2020-11-06 18:30:00', 'ADVANCE', 'payment', 0),
(385, 15, 2, '101834.00', '2020-11-06 18:30:00', 'CASH FROM BANK', 'contra', 0),
(386, 17, 2, '10513.00', '2020-11-06 18:30:00', 'JOB 351, 356, 355, 398', 'receipt', 0),
(387, 15, 165, '6378.19', '2020-11-06 18:30:00', 'ADVANCE', 'payment', 0),
(388, 2, 114, '1500.00', '2020-11-06 18:30:00', 'ABDULLA OCT', 'payment', 0),
(389, 2, 71, '2000.00', '2020-11-06 18:30:00', 'JOB 541', 'payment', 0),
(390, 2, 71, '750.00', '2020-11-06 18:30:00', 'JOB 542', 'payment', 0),
(391, 2, 71, '6852.50', '2020-11-06 18:30:00', 'JOB 548', 'payment', 0),
(392, 2, 71, '5402.50', '2020-11-06 18:30:00', 'JOB 549', 'payment', 0),
(393, 2, 164, '6502.61', '2020-11-07 11:51:22', 'Payment To supplier,Amount:.6502.61.', 'Payment', 0),
(394, 2, 108, '77.00', '2020-11-06 18:30:00', 'PETROL AND STATIONARY', 'payment', 0),
(395, 2, 114, '8000.00', '2020-11-06 18:30:00', 'ZUHIN OCT', 'payment', 0),
(396, 2, 114, '4500.00', '2020-11-06 18:30:00', 'SHAHBAZ SALARY OCT', 'payment', 0),
(397, 19, 15, '2827.52', '2020-11-15 18:30:00', 'Payment from client, Amount:.2827.52.', 'Receipt', 6),
(398, 52, 15, '18688.80', '2020-11-15 18:30:00', 'JOB 383', 'receipt', 0),
(399, 127, 15, '31593.52', '2020-11-15 18:30:00', 'JOB 344, 381', 'receipt', 0),
(400, 15, 66, '5000.00', '2020-11-15 18:30:00', 'ADVANCE', 'payment', 0),
(401, 15, 58, '2520.00', '2020-11-15 18:30:00', 'Payment To supplier,Amount:.2520.00.', 'Payment', 7),
(402, 15, 58, '34596.00', '2020-11-15 18:30:00', 'OLD BALANCE', 'payment', 0),
(403, 15, 76, '1553.44', '2020-11-15 18:30:00', 'Payment To supplier,Amount:.1553.44.', 'Payment', 8),
(404, 15, 59, '16808.00', '2020-11-15 18:30:00', 'JOB OLD', 'payment', 0),
(405, 15, 152, '2462.80', '2020-11-15 18:30:00', 'OLD JOB', 'payment', 0),
(406, 15, 101, '16331.89', '2020-11-15 18:30:00', 'Payment To supplier,Amount:.16331.89.', 'Payment', 9),
(407, 2, 108, '157.00', '2020-11-15 18:30:00', 'VEHICLE', 'payment', 0),
(408, 2, 160, '932.75', '2020-11-15 18:30:00', 'Payment To supplier,Amount:.932.75.', 'Payment', 0),
(409, 2, 68, '24219.34', '2020-11-15 18:30:00', 'Payment To supplier,Amount:.24219.34.', 'Payment', 0),
(410, 2, 156, '402.50', '2020-11-15 18:30:00', 'Payment To supplier,Amount:.402.50.', 'Payment', 0),
(411, 2, 103, '1485.00', '2020-11-15 18:30:00', 'OLD GAS/MOHAN', 'payment', 0),
(412, 2, 71, '750.00', '2020-11-15 18:30:00', 'Payment To supplier,Amount:.750.00.', 'Payment', 0),
(413, 2, 121, '10217.00', '2020-11-15 18:30:00', 'ZUHIN IQAMA', 'payment', 0),
(414, 2, 121, '250.00', '2020-11-15 18:30:00', 'CHARITY ', 'payment', 0),
(415, 2, 161, '9000.00', '2020-11-15 18:30:00', 'RAMEEZ, SHAHBAZ, SHAJAHAN, ASMEER, ASHFAQ,AFNAS', 'payment', 0),
(416, 2, 161, '25000.00', '2020-11-15 18:30:00', 'SHARAF', 'payment', 0),
(417, 2, 114, '1500.00', '2020-11-15 18:30:00', 'SHAREEF OCT', 'payment', 0),
(418, 34, 2, '23402.50', '2020-11-18 18:30:00', 'JOB OLD BILLS', 'receipt', 0),
(419, 2, 129, '23402.50', '2020-11-18 18:30:00', 'JOB 525, 526, 543, 544, 545, 546, 552,562, 570 ', 'payment', 0),
(420, 2, 121, '18000.00', '2020-11-20 18:30:00', 'OFFICE RENT UP TO 2021 NOV', 'payment', 0),
(421, 2, 13, '2700.00', '2020-11-20 18:30:00', 'VAT PAID AGAINST OFFICE RENT ', 'payment', 0),
(422, 15, 66, '5000.00', '2020-11-20 18:30:00', 'ADVANCE', 'payment', 0),
(423, 15, 82, '20812.38', '2020-11-20 18:30:00', 'Payment To supplier,Amount:.20812.38.', 'Payment', 10),
(424, 15, 157, '41090.51', '2020-11-20 18:30:00', 'Payment To supplier,Amount:.41090.51.', 'Payment', 11),
(425, 15, 85, '21118.39', '2020-11-20 18:30:00', 'Payment To supplier,Amount:.21118.39.', 'Payment', 12),
(426, 15, 85, '1575.00', '2020-11-20 18:30:00', 'JOB 431', 'payment', 0),
(427, 15, 2, '75000.00', '2020-11-20 18:30:00', 'CASH FROM BANK', 'contra', 0),
(428, 47, 15, '16565.50', '2020-11-20 18:30:00', 'OPENING BALANCE', 'receipt', 0),
(429, 36, 15, '10951.90', '2020-11-20 18:30:00', 'Payment from client, Amount:.10951.90.', 'Receipt', 13),
(430, 23, 15, '3203.95', '2020-11-20 18:30:00', 'OPENING BALANCE', 'receipt', 0),
(431, 15, 77, '1282.00', '2020-11-20 18:30:00', 'JOB 580', 'payment', 0),
(432, 2, 108, '50.00', '2020-11-20 18:30:00', 'VAN', 'payment', 0),
(433, 2, 71, '920.00', '2020-11-20 18:30:00', 'Payment To supplier,Amount:.920.00.', 'Payment', 0),
(434, 162, 2, '24219.34', '2020-11-27 18:30:00', 'Payment from client, Amount:.24219.34.', 'Receipt', 0),
(435, 25, 2, '20000.00', '2020-11-27 18:30:00', 'PAYMENT OLD', 'receipt', 0),
(436, 2, 121, '936.00', '2020-11-27 18:30:00', 'GOSI AUG SEPT OCT', 'payment', 0),
(437, 15, 168, '5487.00', '2020-11-27 18:30:00', 'Payment To supplier,Amount:.5487.00.', 'Payment', 14),
(438, 15, 66, '10000.00', '2020-11-27 18:30:00', 'ADVANCE', 'payment', 0),
(439, 15, 121, '2818.50', '2020-11-27 18:30:00', 'FRESA NEW ERP SYSTEM ADVANCE', 'payment', 0),
(440, 52, 15, '4930.55', '2020-11-27 18:30:00', 'OLD PAYMENT', 'receipt', 0),
(441, 15, 128, '30700.00', '2020-11-27 18:30:00', 'JOB 425, 428, 436, 437', 'payment', 0),
(442, 15, 75, '36478.45', '2020-11-27 18:30:00', 'Payment To supplier,Amount:.36478.45.', 'Payment', 15),
(443, 167, 15, '12987.55', '2020-11-27 18:30:00', 'Payment from client, Amount:.12987.55.', 'Receipt', 16),
(444, 52, 15, '16333.64', '2020-11-27 18:30:00', 'OLD PAYMENT', 'receipt', 0),
(445, 22, 15, '7628.23', '2020-11-27 18:30:00', 'OLD PAYMENT', 'receipt', 0),
(446, 15, 73, '9486.75', '2020-11-27 18:30:00', 'NEW JOB ', 'payment', 0),
(447, 15, 102, '19500.00', '2020-11-27 18:30:00', 'MIX JOB', 'payment', 0),
(448, 2, 159, '100.00', '2020-11-27 18:30:00', 'Payment To supplier,Amount:.100.00.', 'Payment', 0),
(449, 2, 71, '8100.00', '2020-11-27 18:30:00', 'Payment To supplier,Amount:.8100.00.', 'Payment', 0),
(450, 2, 108, '662.00', '2020-11-27 18:30:00', 'PETROL COROLLA', 'payment', 0),
(451, 2, 110, '220.00', '2020-11-27 18:30:00', 'FOOD WITH CLIENT', 'payment', 0),
(452, 2, 13, '9970.50', '2020-10-30 18:30:00', 'VAT PAID TO GOVT OCT', 'payment', 0),
(453, 15, 82, '10733.35', '2020-12-04 18:30:00', 'JOB 506, 518, 529, 585', 'payment', 0),
(454, 15, 169, '1050.00', '2020-12-04 18:30:00', 'JOB 589, 586', 'payment', 0),
(455, 24, 15, '18582.50', '2020-12-04 18:30:00', 'JOB 137, 138, 188, 199, 421', 'receipt', 0),
(456, 162, 15, '41715.98', '2020-12-04 18:30:00', 'JOB 563', 'receipt', 0),
(457, 15, 121, '3750.00', '2020-12-04 18:30:00', 'ZUHIN HOUSING THREE MONTHS TO REAL ESTATE', 'payment', 0),
(458, 29, 15, '19555.26', '2020-12-04 18:30:00', 'JOB 513, 576, 577, 578', 'receipt', 0),
(459, 15, 66, '5000.00', '2020-12-04 18:30:00', 'ADVANCE', 'payment', 0),
(460, 2, 107, '453.39', '2020-12-04 18:30:00', 'ZUHIN, SHAHBAZ MOBILE AND TELEPHONE', 'payment', 0),
(461, 2, 103, '15.00', '2020-12-05 18:30:00', '1500 paid last ', 'payment', 0),
(462, 2, 135, '800.00', '2020-12-06 18:30:00', 'PENDING PAID', 'payment', 0),
(463, 1, 16, '4351.30', '2020-11-11 18:30:00', 'Invoice .1516. created for JobNo:.76. ,debited Amount:.4351.30.', 'Invoice', 0),
(464, 1, 16, '0.00', '2020-11-11 18:30:00', 'Invoice .1516. created for JobNo:.76. ,VAT Amount:.0.00.', 'VAT', 0),
(465, 2, 52, '1500.00', '2021-11-10 18:30:00', 'Ed charge paid ', 'payment', 0),
(466, 16, 2, '200.00', '2022-02-23 18:30:00', 'Payment from client, Amount:.200.00.', 'Receipt', 0),
(467, 16, 2, '0.00', '2022-02-23 18:30:00', 'Payment from client, Amount:.0.00.', 'Receipt', 0),
(468, 16, 15, '4351.30', '2022-02-23 18:30:00', 'Payment from client, Amount:.4351.30.', 'Receipt', 17),
(469, 2, 16, '400.00', '2022-02-23 18:30:00', 'Payment from client, Amount:.400.00.', 'Receipt', 0),
(470, 2, 16, '11531.85', '2022-02-23 18:30:00', 'Payment from client, Amount:.11531.85.', 'Receipt', 0),
(471, 15, 16, '200.00', '2022-02-23 18:30:00', 'Payment from client, Amount:.200.00.', 'Receipt', 18),
(472, 15, 16, '0.00', '2022-02-23 18:30:00', 'Payment from client, Amount:.0.00.', 'Receipt', 19),
(473, 2, 17, '3845.87', '2022-02-23 18:30:00', 'Payment from client, Amount:.3845.87.', 'Receipt', 0),
(474, 2, 17, '8359.60', '2022-02-23 18:30:00', 'Payment from client, Amount:.8359.60.', 'Receipt', 0),
(475, 2, 17, '3411.50', '2022-02-23 18:30:00', 'Payment from client, Amount:.3411.50.', 'Receipt', 0),
(476, 2, 17, '3864.70', '2022-02-23 18:30:00', 'Payment from client, Amount:.3864.70.', 'Receipt', 0),
(477, 2, 17, '39260.14', '2022-02-23 18:30:00', 'Payment from client, Amount:.39260.14.', 'Receipt', 0),
(478, 15, 17, '2362.86', '2022-02-23 18:30:00', 'Payment from client, Amount:.2362.86.', 'Receipt', 20),
(479, 56, 15, '0.00', '2022-02-23 18:30:00', 'Payment To supplier,Amount:.0.00.', 'Payment', 21),
(480, 65, 15, '0.00', '2022-02-23 18:30:00', 'Payment To supplier,Amount:.0.00.', 'Payment', 22),
(481, 2, 17, '5134.14', '2022-02-23 18:30:00', 'Payment from client, Amount:.5134.14.', 'Receipt', 0),
(482, 65, 15, '0.00', '2022-02-23 18:30:00', 'Payment To supplier,Amount:.0.00.', 'Payment', 23),
(483, 58, 15, '0.00', '2022-02-24 18:30:00', 'Payment To supplier,Amount:.0.00.', 'Payment', 24),
(484, 1, 17, '3903.02', '2020-11-25 18:30:00', 'Invoice .1544. created for JobNo:.97. ,debited Amount:.3903.02.', 'Invoice', 0),
(485, 1, 171, '17.00', '0000-00-00 00:00:00', '2020-11-26', 'Invoice .1544. created for JobNo:.97. ,VAT Amount:.265.50.', 0),
(486, 1, 47, '6968.70', '2020-11-24 18:30:00', 'Invoice .1542. created for JobNo:.94. ,debited Amount:.6968.70.', 'Invoice', 0),
(487, 1, 171, '47.00', '0000-00-00 00:00:00', '2020-11-25', 'Invoice .1542. created for JobNo:.94. ,VAT Amount:.195.00.', 0),
(488, 1, 107, '12.12', '2022-03-06 18:30:00', '2022-03-07', 'General Expense', 0),
(489, 56, 2, '22.40', '2022-03-07 18:30:00', 'Payment To supplier,Amount:.22.40.', 'Payment', 0);

-- --------------------------------------------------------

--
-- Table structure for table `accounts_cheque_details`
--

DROP TABLE IF EXISTS `accounts_cheque_details`;
CREATE TABLE IF NOT EXISTS `accounts_cheque_details` (
  `Cheque_DetailsID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Chq_No` longtext DEFAULT NULL,
  `Chq_Date` date DEFAULT NULL,
  `Chq_Bank` longtext DEFAULT NULL,
  PRIMARY KEY (`Cheque_DetailsID`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts_cheque_details`
--

INSERT INTO `accounts_cheque_details` (`Cheque_DetailsID`, `Chq_No`, `Chq_Date`, `Chq_Bank`) VALUES
(1, NULL, NULL, NULL),
(2, NULL, NULL, NULL),
(3, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(4, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(5, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(6, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(7, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(8, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(9, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(10, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(11, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(12, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(13, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(14, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(15, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(16, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(17, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(18, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(19, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(20, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(21, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(22, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(23, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(24, '', '0000-00-00', 'BANK NAME: ALINMA BANK'),
(25, '', '0000-00-00', 'BANK NAME: ALINMA BANK');

-- --------------------------------------------------------

--
-- Table structure for table `accounts_client_ledger`
--

DROP TABLE IF EXISTS `accounts_client_ledger`;
CREATE TABLE IF NOT EXISTS `accounts_client_ledger` (
  `ClientLedgerID` int(11) NOT NULL AUTO_INCREMENT,
  `ClientID` int(11) NOT NULL,
  `LedgerID` int(11) NOT NULL,
  PRIMARY KEY (`ClientLedgerID`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts_client_ledger`
--

INSERT INTO `accounts_client_ledger` (`ClientLedgerID`, `ClientID`, `LedgerID`) VALUES
(1, 1, 16),
(2, 2, 17),
(3, 3, 18),
(4, 4, 19),
(5, 5, 20),
(6, 6, 21),
(7, 7, 22),
(8, 8, 23),
(9, 9, 24),
(10, 10, 25),
(11, 11, 26),
(12, 12, 27),
(13, 13, 28),
(14, 14, 29),
(15, 15, 30),
(16, 16, 31),
(17, 17, 32),
(18, 18, 33),
(19, 19, 34),
(20, 20, 35),
(21, 21, 36),
(22, 22, 37),
(23, 23, 38),
(24, 24, 39),
(25, 25, 40),
(26, 26, 41),
(27, 27, 42),
(28, 28, 43),
(29, 29, 44),
(30, 30, 45),
(31, 31, 46),
(32, 32, 47),
(33, 33, 48),
(34, 34, 49),
(35, 35, 50),
(36, 36, 51),
(37, 37, 52),
(38, 38, 53),
(39, 39, 54),
(40, 40, 55),
(41, 41, 126),
(42, 42, 127),
(43, 43, 137),
(45, 45, 146),
(46, 46, 147),
(47, 47, 148),
(48, 48, 154),
(49, 49, 162),
(50, 50, 166),
(51, 51, 167);

-- --------------------------------------------------------

--
-- Table structure for table `accounts_domainaccountmaster`
--

DROP TABLE IF EXISTS `accounts_domainaccountmaster`;
CREATE TABLE IF NOT EXISTS `accounts_domainaccountmaster` (
  `DomainAccountMasterID` bigint(20) NOT NULL,
  `CreditAccount` bigint(20) DEFAULT NULL,
  `DebitAccount` bigint(20) DEFAULT NULL,
  `Amount` decimal(18,2) DEFAULT NULL,
  `TransferDate` date DEFAULT NULL,
  `Narration` longtext DEFAULT NULL,
  `VoucherType` longtext DEFAULT NULL,
  `Cheque_DetailsID` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`DomainAccountMasterID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `accounts_domainledger`
--

DROP TABLE IF EXISTS `accounts_domainledger`;
CREATE TABLE IF NOT EXISTS `accounts_domainledger` (
  `DomainLedgerID` bigint(20) NOT NULL,
  `LedgerGroupID` bigint(20) DEFAULT NULL,
  `Ledger_Name` varchar(100) DEFAULT NULL,
  `LedgerID` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`DomainLedgerID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `accounts_expence`
--

DROP TABLE IF EXISTS `accounts_expence`;
CREATE TABLE IF NOT EXISTS `accounts_expence` (
  `acc_expense_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_ledger_id` int(11) NOT NULL,
  `to_ledger` int(11) NOT NULL,
  `expense_category` text NOT NULL,
  `expense_date` date NOT NULL,
  `subtotal` float NOT NULL,
  `tax_total` float NOT NULL,
  `total_amount` float NOT NULL,
  `expense_description` text DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payment_mode` text NOT NULL,
  `transaction_id` text NOT NULL,
  `ref_number` text NOT NULL,
  `bank_id` int(11) NOT NULL,
  PRIMARY KEY (`acc_expense_id`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts_expence`
--

INSERT INTO `accounts_expence` (`acc_expense_id`, `from_ledger_id`, `to_ledger`, `expense_category`, `expense_date`, `subtotal`, `tax_total`, `total_amount`, `expense_description`, `created_date`, `payment_mode`, `transaction_id`, `ref_number`, `bank_id`) VALUES
(240, 1, 107, 'Other Expense', '2022-03-07', 12, 0.12, 12.12, '', '2022-03-06 18:30:00', 'credit', '', '125', 1);

--
-- Triggers `accounts_expence`
--
DROP TRIGGER IF EXISTS `Account_entry`;
DELIMITER $$
CREATE TRIGGER `Account_entry` BEFORE INSERT ON `accounts_expence` FOR EACH ROW BEGIN

if(NEW.payment_mode='cash')
THEN
set NEW.from_ledger_id=NEW.from_ledger_id;
ELSEIF (NEW.payment_mode='credit')
THEN
set NEW.from_ledger_id=1;
ELSE
set NEW.from_ledger_id=(select mst_bank.bankledgerid from mst_bank where id=NEW.bank_id);

END IF;

INSERT INTO `accounts_accountmaster`( `CreditAccount`, `DebitAccount`, `Amount`, `TransferDate`, `Narration`, `VoucherType`, `Cheque_DetailsID`) VALUES (
NEW.from_ledger_id,NEW.to_ledger,NEW.total_amount,NEW.expense_date,new.expense_date,'General Expense',0);



END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `accounts_expense_details`
--

DROP TABLE IF EXISTS `accounts_expense_details`;
CREATE TABLE IF NOT EXISTS `accounts_expense_details` (
  `acc_expense_detailsid` int(11) NOT NULL AUTO_INCREMENT,
  `acc_expense_id` int(11) NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `subtotal` float NOT NULL,
  `tax_per` float NOT NULL,
  `tax_amount` float NOT NULL,
  `total_amount` float NOT NULL,
  PRIMARY KEY (`acc_expense_detailsid`)
) ENGINE=InnoDB AUTO_INCREMENT=243 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts_expense_details`
--

INSERT INTO `accounts_expense_details` (`acc_expense_detailsid`, `acc_expense_id`, `site_id`, `vehicle_id`, `employee_id`, `description`, `subtotal`, `tax_per`, `tax_amount`, `total_amount`) VALUES
(242, 240, 146, 0, 0, 'TRANSPORTATION CHARGES ', 12, 0, 0.12, 12.12);

-- --------------------------------------------------------

--
-- Table structure for table `accounts_ledger`
--

DROP TABLE IF EXISTS `accounts_ledger`;
CREATE TABLE IF NOT EXISTS `accounts_ledger` (
  `LedgerID` bigint(20) NOT NULL AUTO_INCREMENT,
  `LedgerGroupID` bigint(20) DEFAULT NULL,
  `Ledger_Name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`LedgerID`)
) ENGINE=MyISAM AUTO_INCREMENT=173 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts_ledger`
--

INSERT INTO `accounts_ledger` (`LedgerID`, `LedgerGroupID`, `Ledger_Name`) VALUES
(1, 2, 'AOT CREDIT ACCOUNT'),
(2, 2, 'Cash'),
(161, 7, 'BONUS ACCOUNT'),
(160, 8, 'SAL : Saudia Cargo Company'),
(159, 8, 'SALIH SABER'),
(158, 8, 'ALLTRANS WORLDWIDE LOGISTICS'),
(157, 8, 'SEKE SHIPPING & AIR CARGO CO., LTD'),
(13, 4, 'vat@15.00'),
(15, 1, 'BANK NAME: ALINMA BANK'),
(16, 6, 'ALI GASHASH AL OMARI TRADING EST'),
(17, 6, 'Energy Supply & Services Company (ESSCO)'),
(18, 6, 'Gulf Petrolic International Est'),
(19, 6, 'Safe Arabia Trading & Contracting Co. Ltd.'),
(20, 6, 'Flow Line Trading W L L'),
(21, 6, 'JFC ARABIA COMPANY LTD'),
(22, 6, 'ALI BIN GASHASH AL UMARI TRADING AND CONTRACTING EST'),
(23, 6, 'BARTEC MIDDLE EAST LLC'),
(24, 6, 'GAS ARABIAN SERVICES CO.LTD'),
(25, 6, 'EZDEHAR INDUSTRIAL SERVICES EST'),
(26, 6, 'ARABIAN POWER ELECTRONICS COMPANY, KHOBAR'),
(27, 6, 'INTERNATIONAL SOLUTIONS FOR INDUSTRIAL SERVICES CO.LTD'),
(28, 6, 'FRONTLINE LOGISTICS-DAMMAM'),
(29, 6, 'AL KAFAA TRADING COMPANY'),
(30, 6, 'GULF ROAD OF CONSTRUCTION TRADING EST'),
(31, 6, 'SAUDI ARABIAN FABRICATED METAL INDUSTRY (SAFAMI)'),
(32, 6, 'ALMEER SAUDI TECHNICAL SERVICES CO.WLL'),
(33, 6, 'ABDULLAH AL BARRAK FACTORY FOR PLASTICS PRODUCTS'),
(34, 6, 'FLEET LANE LOGISTICS LLC'),
(35, 6, 'HUSSAIN ABDULLAH AIAJMI TRADING EST'),
(36, 6, 'ABDULLAH A AL BARRAK AND SONS CO.'),
(37, 6, 'SAUDI ARABIAN ENGINEERING COMPANY'),
(38, 6, 'TAZEZ ADVANCED INDUSTRIAL CO LTD'),
(39, 6, 'Rezayat Protective Coating Co. Ltd.'),
(40, 6, 'SMASH GLOBAL LOGISTICS'),
(41, 6, 'JUBAIL CHEMICAL INDUSTRIES ( JANA ) JUBAIL INDUSTRIAL CITY 31961 SAUDI ARABIA'),
(42, 6, 'HK AL SADIQ SONS contracting Co. Ltd'),
(43, 6, 'Sinsina Industrial Works & Metal Construction Factory '),
(44, 6, 'ARABIAN NEON EST '),
(45, 6, 'AL AMARA INTERNATIONAL TRADING & CONTRACTING COMPANY LTD'),
(46, 6, 'Daxel Italy Srl  Logistics & Solutions'),
(47, 6, 'PEPPERL+FUCHS GULF LLC. AL KHOBAR '),
(48, 6, 'BRIGHT WORLD TRADING EST'),
(49, 6, 'GAS-VECTOR SAUDI ARABIA LTD'),
(50, 6, 'GABAS ALBILAD HOLDING CO'),
(51, 6, 'SAHER AL-FAISALIYAH TRADING EST.'),
(52, 6, 'COSL DRILLING SAUDI LTD'),
(53, 6, 'Al Abar Oilfield Services Est '),
(54, 6, 'MISFER HASAN AHMED AL MALKI TRADING EST.'),
(55, 6, 'MAGA LOGISTICS'),
(56, 8, 'Wadi Al Noor Cargo FZCc'),
(57, 8, 'HWASIN SHIPPING & AIRCARGO CO., LTD (KOREA)'),
(58, 8, 'Etex Logistic S.r.l'),
(59, 8, 'LIT Air & Sea GmbH'),
(60, 8, 'VELOCITY Global Logistics Pvt. Ltd.'),
(61, 8, 'Blue Wing Global Freight Pvt Ltd'),
(62, 8, 'Francesco Parisi Casa di Spedizioni S.p.A'),
(63, 8, 'CHAIN LOGISTICS'),
(64, 8, 'Nordic Shipping Canada Ltd'),
(65, 8, 'Globe Success Internation Transportation (Shenzhen'),
(66, 8, 'AL JAWHRA TRADING'),
(67, 8, 'ASAT CUSTOMS CLEARANCE'),
(68, 8, 'SAUDI CUSTOMS'),
(69, 8, 'EXPEDITING'),
(70, 8, 'ADVANTAGE WORLDWIDE (UK).LTD '),
(71, 8, 'LOCAL SUPPLIER'),
(72, 8, 'KHONAINI CLEARANCE'),
(73, 8, 'TRANSPEED CARGO PTE LTD'),
(74, 8, 'TRANS BUSINESS INTERNATIONAL'),
(75, 8, 'AJ WORLDWIDE SERVICES INC.'),
(76, 8, 'BARKER & HOOD GLOBAL LOGISTICS'),
(77, 8, 'ALOUFI LOGISTICS SERVICES'),
(78, 8, 'ALI GASHASH AL OMARI TRADING EST'),
(79, 8, 'DHL EXPRESS'),
(80, 8, 'GLOBE SKY LOGISTICS COMPANY LIMITED'),
(81, 8, 'AIR CARGO.NL'),
(82, 8, 'IMPO FREIGHT PVT LTD'),
(83, 8, 'EMBASSY FREIGHT'),
(84, 8, 'CARGO SERVICES PAMPLONA ,S.A.U'),
(85, 8, 'SOLEX LOGISTICS (SINGAPORE) PTE LTD'),
(86, 8, 'NUCAF COMMERCIAL SERVICES OFFICE'),
(87, 8, 'FAST FORWARDING LOGISTICS INDIA PVT LTD'),
(88, 8, 'DENY CARGO B.V.B.A - S.P.R.L'),
(89, 8, 'INTERCARGO S.A'),
(90, 8, 'Daxel Italy Srl  Logistics & Solutions'),
(91, 8, 'TSI INTERNATIONAL SPEDITION UND HANDELS GMBH'),
(92, 8, 'VELOCITY GLOBAL LOGISTICS (HONGKONG)LIMITED'),
(93, 8, 'AJ WORLD WIDE SERVICES LIMITED U.K'),
(94, 8, 'RAKAEZ'),
(95, 8, 'Bertling'),
(96, 8, 'Schafer & SIS internationale speditions - Gmbh'),
(97, 8, 'ACCORD PILOT LOGISTICS (THAILAND)CO.LTD'),
(98, 8, 'TRADE LOGISTICS'),
(99, 8, 'NINGBO STAR ALLIANCE INTERNATIONAL LOGISTICS CO. L'),
(100, 8, 'AIRLOG GROUP'),
(101, 8, 'FAST LOGISTICS'),
(102, 8, 'SOLUTION MAKERS '),
(103, 8, 'EXPEDITING GAS ANAS/MOHAN'),
(104, 8, 'EXPEDITING GAS / ZAHEER TRANSPORTATION'),
(105, 3, 'PARTNER 1'),
(106, 3, 'PARTNER 2'),
(107, 9, 'TELEPHONE AND MOBILE EXPENSES'),
(108, 9, 'FUEL EXPENSES'),
(109, 9, 'PRINTING AND STATIONARY EXPENSES'),
(110, 9, 'REFRESHMENTS AND ENTERTAINMENT EXPENSES'),
(111, 9, 'OFFICE MAINTAINANCE'),
(112, 9, 'VEHICLE MAINTENANCE '),
(113, 9, 'TRANSPORTATION'),
(114, 9, 'SALARY ACCOUNT'),
(115, 9, 'OFFICE RENT ACCOUNT'),
(116, 9, 'VEHICLE INSURANCE'),
(117, 9, 'AIR TICKET EXPENSES'),
(118, 9, 'LEGAL EXPENSES'),
(119, 9, 'VACATION SALARY'),
(120, 9, 'EXIT RE-ENTRY EXPENSES'),
(121, 9, 'GENERAL EXP'),
(122, 9, 'STATIONARY'),
(123, 9, 'BANK CHARGES'),
(124, 9, 'COROLLA ACCOUNT'),
(125, 6, 'COSL MIDDLE EAST FZE'),
(126, 6, 'GULF ROAD CONSTRUCTIONS TRADING EST'),
(127, 6, 'AHMED YAHYA NASSER AL-YAMI TRADING EST'),
(128, 8, 'OMEGA GLOBAL LOGISTICS'),
(129, 8, 'FLEETLANE LOGISTICS ESTABLISHMENT'),
(130, 8, 'QINDAO MAGA INTERNATIONAL LOGISTICS CO., LTD'),
(131, 8, 'DYNAMIC FORWARDING '),
(132, 7, 'UNKNOWN PROFIT'),
(133, 8, 'DISBROQUER'),
(134, 8, 'SABER JITHIN'),
(135, 8, 'DARWIN EXPEDITING'),
(155, 8, 'PACIFIC LOGISTICS SOLUTION'),
(146, 6, 'Weidmuller Saudi Arabia Factory'),
(147, 6, 'TREVI ARABIAN SOIL CONTRACTORS'),
(148, 6, 'MIDDLE EAST SOLUTION FOR LOGISITICS SERVICES EST'),
(156, 8, 'MY BUSINESS SERVICES (144)'),
(154, 6, 'AL-OTHMAN INDUSTRIAL MARKETING CO.LTD'),
(151, 8, 'FREIGHT EXPERT INC (FEI)'),
(152, 8, 'PHOENIX LOGISTICS INDIA PVT LTD'),
(153, 8, 'UNICORN SHIPPING & LOGISTICS'),
(162, 6, 'AL-BABTAIN PLASTIC & INSULATION MAT.CO. LTD'),
(163, 8, 'PGL'),
(164, 8, 'AL KATHA CUSTOMS CLEARANCE'),
(165, 8, 'FRANCE CARGO INTERATIONAL CIE'),
(166, 6, 'HISHAM MOHAMMAD AL QURAISH TRADING EST.'),
(167, 6, 'SADAF ELECTRIC INDUSTRIES CO LTD'),
(168, 8, 'MOHMED A.AL ATTAS CONTRACTING EST.'),
(169, 8, 'ABDULHADI AL JAHANI OFFICE CUSTOMS CLEARANCE'),
(170, 4, 'fghf'),
(171, 4, 'vat@0'),
(172, 1, 'HDFC Bank');

-- --------------------------------------------------------

--
-- Table structure for table `accounts_ledgerbalance`
--

DROP TABLE IF EXISTS `accounts_ledgerbalance`;
CREATE TABLE IF NOT EXISTS `accounts_ledgerbalance` (
  `LedgerBalanceID` bigint(20) NOT NULL,
  `LedgerID` bigint(20) DEFAULT NULL,
  `OpeningBalance` decimal(18,2) DEFAULT NULL,
  `ClosingBalance` decimal(18,2) DEFAULT NULL,
  `TranscationDate` date DEFAULT NULL,
  PRIMARY KEY (`LedgerBalanceID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `accounts_ledgergroup`
--

DROP TABLE IF EXISTS `accounts_ledgergroup`;
CREATE TABLE IF NOT EXISTS `accounts_ledgergroup` (
  `LedgerGroupID` bigint(20) NOT NULL AUTO_INCREMENT,
  `GroupName` varchar(100) DEFAULT NULL,
  `Type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`LedgerGroupID`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts_ledgergroup`
--

INSERT INTO `accounts_ledgergroup` (`LedgerGroupID`, `GroupName`, `Type`) VALUES
(1, 'Bank', 'asset'),
(2, 'Current Asset', 'asset'),
(3, 'Fixed Asset', 'asset'),
(4, 'Current Liability', 'liability'),
(5, 'Fixed Liability', 'liability'),
(6, 'Direct Income', 'income'),
(7, 'Indirect Income', 'income'),
(8, 'Direct Expense', 'expense'),
(9, 'Indirect Expense', 'expense');

-- --------------------------------------------------------

--
-- Table structure for table `accounts_subledger`
--

DROP TABLE IF EXISTS `accounts_subledger`;
CREATE TABLE IF NOT EXISTS `accounts_subledger` (
  `SubLedgerID` bigint(20) NOT NULL,
  `LedgerID` bigint(20) NOT NULL,
  `SubLedger_Name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`SubLedgerID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `accounts_supplierledger`
--

DROP TABLE IF EXISTS `accounts_supplierledger`;
CREATE TABLE IF NOT EXISTS `accounts_supplierledger` (
  `SupplierLedgerID` int(11) NOT NULL AUTO_INCREMENT,
  `SupplierID` int(11) NOT NULL,
  `LedgerID` int(11) NOT NULL,
  PRIMARY KEY (`SupplierLedgerID`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts_supplierledger`
--

INSERT INTO `accounts_supplierledger` (`SupplierLedgerID`, `SupplierID`, `LedgerID`) VALUES
(1, 1, 56),
(2, 2, 57),
(3, 3, 58),
(4, 4, 59),
(5, 5, 60),
(6, 6, 61),
(7, 7, 62),
(8, 8, 63),
(9, 9, 64),
(10, 10, 65),
(11, 11, 66),
(12, 12, 67),
(13, 13, 68),
(14, 14, 69),
(15, 15, 70),
(16, 16, 71),
(17, 17, 72),
(18, 18, 73),
(19, 19, 74),
(20, 20, 75),
(21, 21, 76),
(22, 22, 77),
(23, 23, 78),
(24, 24, 79),
(25, 25, 80),
(26, 26, 81),
(27, 27, 82),
(28, 28, 83),
(29, 29, 84),
(30, 30, 85),
(31, 31, 86),
(32, 32, 87),
(33, 33, 88),
(34, 34, 89),
(35, 35, 90),
(36, 36, 91),
(37, 37, 92),
(38, 38, 93),
(39, 39, 94),
(40, 40, 95),
(41, 41, 96),
(42, 42, 97),
(43, 43, 98),
(44, 44, 99),
(45, 45, 100),
(46, 46, 101),
(47, 47, 102),
(48, 48, 103),
(49, 49, 104),
(50, 50, 128),
(51, 51, 129),
(52, 52, 130),
(53, 53, 131),
(54, 54, 133),
(55, 55, 134),
(56, 56, 135),
(57, 58, 151),
(58, 59, 152),
(59, 60, 153),
(60, 61, 155),
(61, 62, 156),
(62, 63, 157),
(63, 64, 158),
(64, 65, 159),
(65, 66, 160),
(66, 67, 163),
(67, 68, 164),
(68, 69, 165),
(69, 70, 168),
(70, 71, 169);

-- --------------------------------------------------------

--
-- Table structure for table `cmpny_settings_basic_info`
--

DROP TABLE IF EXISTS `cmpny_settings_basic_info`;
CREATE TABLE IF NOT EXISTS `cmpny_settings_basic_info` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Cmpny_name` text NOT NULL,
  `Address` text NOT NULL,
  `Phone` text NOT NULL,
  `FAX` text NOT NULL,
  `VAT` text NOT NULL,
  `CR` text NOT NULL,
  `Email` text NOT NULL,
  `Web` text NOT NULL,
  `Icon_image` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cmpny_settings_basic_info`
--

INSERT INTO `cmpny_settings_basic_info` (`Id`, `Cmpny_name`, `Address`, `Phone`, `FAX`, `VAT`, `CR`, `Email`, `Web`, `Icon_image`) VALUES
(1, 'Freighbrid Logistics', 'Al Khobar, Saudi Arabia', '00966 814 0279', '00966 8142597', '30041706d100003', '2051030330', 'info@ferryfolks.com', 'www.ferryfolks.com', '1646654152iconimage.png');

-- --------------------------------------------------------

--
-- Table structure for table `cmpny_settings_inv_details`
--

DROP TABLE IF EXISTS `cmpny_settings_inv_details`;
CREATE TABLE IF NOT EXISTS `cmpny_settings_inv_details` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Invheaderimage` text NOT NULL,
  `InvfooterImage` text NOT NULL,
  `Invseries` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cmpny_settings_inv_details`
--

INSERT INTO `cmpny_settings_inv_details` (`Id`, `Invheaderimage`, `InvfooterImage`, `Invseries`) VALUES
(1, '1646038410headerimage.png', '1646038410footerimage.png', '1454');

-- --------------------------------------------------------

--
-- Table structure for table `jm_creditnote_details`
--

DROP TABLE IF EXISTS `jm_creditnote_details`;
CREATE TABLE IF NOT EXISTS `jm_creditnote_details` (
  `creditnote_detals_id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` text NOT NULL,
  `UnitPrice` float NOT NULL,
  `Currency` text NOT NULL,
  `ConvFactor` float NOT NULL,
  `Quantity` float NOT NULL,
  `Total` text NOT NULL,
  `Vat_amnt` text NOT NULL,
  `Vat_perc` text NOT NULL,
  `GrandTotal` float NOT NULL,
  `Creditnote_master_id` int(11) NOT NULL,
  PRIMARY KEY (`creditnote_detals_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jm_creditnote_details`
--

INSERT INTO `jm_creditnote_details` (`creditnote_detals_id`, `Description`, `UnitPrice`, `Currency`, `ConvFactor`, `Quantity`, `Total`, `Vat_amnt`, `Vat_perc`, `GrandTotal`, `Creditnote_master_id`) VALUES
(1, 'AIR FREIGHT CHARGES ', 1, 'USD', 3.76, 188, '706.88', '0.0', '0', 706.88, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jm_creditnote_master`
--

DROP TABLE IF EXISTS `jm_creditnote_master`;
CREATE TABLE IF NOT EXISTS `jm_creditnote_master` (
  `Creditnote_master_id` int(11) NOT NULL AUTO_INCREMENT,
  `Code_Id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `PostingDate` date NOT NULL,
  `JobId` int(11) NOT NULL,
  `Total` float NOT NULL,
  `Vat` float NOT NULL,
  `GrandTotal` float NOT NULL,
  `Status` text NOT NULL,
  PRIMARY KEY (`Creditnote_master_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jm_creditnote_master`
--

INSERT INTO `jm_creditnote_master` (`Creditnote_master_id`, `Code_Id`, `Date`, `PostingDate`, `JobId`, `Total`, `Vat`, `GrandTotal`, `Status`) VALUES
(1, 1, '2020-10-15', '2020-10-15', 18, 706.88, 0, 706.88, 'Posted');

-- --------------------------------------------------------

--
-- Table structure for table `jm_debitnote_details`
--

DROP TABLE IF EXISTS `jm_debitnote_details`;
CREATE TABLE IF NOT EXISTS `jm_debitnote_details` (
  `Debit_note_id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` text NOT NULL,
  `unitprice` text NOT NULL,
  `Amount` float NOT NULL,
  `Currency` text NOT NULL,
  `ConvFactor` text NOT NULL,
  `Quantity` text NOT NULL,
  `Vat_amnt` text NOT NULL,
  `Vat_perc` text NOT NULL,
  `GrandTotal` text NOT NULL,
  `Debitnote_Master_id` int(11) NOT NULL,
  PRIMARY KEY (`Debit_note_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jm_debitnote_master`
--

DROP TABLE IF EXISTS `jm_debitnote_master`;
CREATE TABLE IF NOT EXISTS `jm_debitnote_master` (
  `Debitnote_Master_id` int(11) NOT NULL AUTO_INCREMENT,
  `Code_Id` int(11) NOT NULL,
  `PostingDate` date NOT NULL,
  `InvDate` date NOT NULL,
  `SubTotal` float NOT NULL,
  `Vat` float NOT NULL,
  `GrandTotal` float NOT NULL,
  `OurInv` text NOT NULL,
  `SupplierID` int(11) NOT NULL,
  `JobId` int(11) NOT NULL,
  `Reference` text NOT NULL,
  `Mode` text NOT NULL,
  `Status` text NOT NULL,
  PRIMARY KEY (`Debitnote_Master_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jm_documents`
--

DROP TABLE IF EXISTS `jm_documents`;
CREATE TABLE IF NOT EXISTS `jm_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `file_path` text NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jm_estimate_master`
--

DROP TABLE IF EXISTS `jm_estimate_master`;
CREATE TABLE IF NOT EXISTS `jm_estimate_master` (
  `estimate_masterid` int(11) NOT NULL AUTO_INCREMENT,
  `estimate_no` int(11) NOT NULL,
  `e_date` date NOT NULL,
  `job_id` int(11) NOT NULL,
  `total_amount` float NOT NULL,
  `tax_amount` float NOT NULL,
  `grand_total` float NOT NULL,
  `status` text NOT NULL,
  `IsActive` text NOT NULL,
  `Userid` varchar(100) NOT NULL,
  PRIMARY KEY (`estimate_masterid`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jm_estimate_master`
--

INSERT INTO `jm_estimate_master` (`estimate_masterid`, `estimate_no`, `e_date`, `job_id`, `total_amount`, `tax_amount`, `grand_total`, `status`, `IsActive`, `Userid`) VALUES
(1, 35, '2022-03-02', 1, 211200, 6480, 217680, 'drafted', '1', ''),
(2, 2, '2020-10-05', 2, 0, 0, 0, 'drafted', '1', ''),
(3, 39, '2022-03-02', 123, 3375020, 10285.8, 452262, 'drafted', '1', ''),
(4, 4, '2020-10-12', 9, 0, 0, 0, 'drafted', '1', ''),
(5, 5, '2020-10-21', 31, 21600, 216, 21816, 'drafted', '1', ''),
(6, 7, '2020-10-26', 35, 0, 0, 0, 'drafted', '1', ''),
(7, 8, '2020-11-01', 48, 0, 0, 0, 'drafted', '1', ''),
(8, 9, '2020-11-05', 53, 0, 0, 0, 'drafted', '1', ''),
(9, 10, '2020-11-15', 49, 0, 0, 0, 'drafted', '1', ''),
(10, 11, '2022-02-15', 111, 50, 2.5, 52.5, 'drafted', '1', ''),
(11, 12, '2022-02-25', 115, 5000, 750, 5750, 'drafted', '1', ''),
(12, 13, '2022-02-28', 117, 23, 0, 0, 'drafted', '1', ''),
(13, 14, '2022-02-28', 118, 400, 20, 420, 'drafted', '1', ''),
(28, 31, '2022-03-01', 128, 196357000, 1963570, 198320000, 'drafted', '1', ''),
(27, 30, '2022-03-01', 129, 174048, 3480.96, 177529, 'drafted', '1', ''),
(26, 29, '2022-03-01', 129, 15000, 150, 15150, 'drafted', '1', ''),
(25, 27, '2022-02-28', 128, 2706, 54.12, 2760.12, 'drafted', '1', ''),
(24, 26, '2022-02-28', 127, 264, 5.28, 269.28, 'drafted', '1', ''),
(20, 28, '2022-03-01', 126, 3168, 63.36, 3231.36, 'drafted', '1', ''),
(23, 34, '2022-03-02', 122, 54658700, 50214.4, 1724030, 'drafted', '1', ''),
(22, 23, '2022-02-28', 123, 293304, 8799.12, 302103, 'drafted', '1', ''),
(31, 38, '2022-03-02', 129, 21250, 425, 21675, 'drafted', '1', ''),
(32, 41, '2022-03-02', 130, 810615, 16182.3, 826797, 'Posted', '1', ''),
(33, 42, '2022-03-05', 130, 3312, 331.2, 3643.2, 'Posted', '1', '4'),
(34, 43, '2022-03-05', 130, 636, 127.2, 763.2, 'Posted', '1', '4'),
(35, 44, '2022-03-05', 130, 624, 74.88, 698.88, 'Posted', '1', '4'),
(36, 45, '2022-03-05', 130, 144, 93.6, 237.6, 'Posted', '1', '4'),
(37, 46, '2022-03-07', 146, 75348, 26371.8, 101720, 'Posted', '1', '4'),
(38, 47, '2022-03-07', 146, 13800, 276, 14076, 'drafted', '1', '4'),
(39, 48, '2022-03-07', 146, 144, 1.44, 145.44, 'Posted', '1', '4'),
(40, 49, '2022-03-08', 148, 144, 1.44, 145.44, 'drafted', '1', '4');

-- --------------------------------------------------------

--
-- Table structure for table `jm_estimate_master_details`
--

DROP TABLE IF EXISTS `jm_estimate_master_details`;
CREATE TABLE IF NOT EXISTS `jm_estimate_master_details` (
  `estimate_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `estimate_masterid` int(11) NOT NULL,
  `description` text NOT NULL,
  `unitprice` decimal(10,0) NOT NULL,
  `unit_type` text NOT NULL,
  `conv_factor` decimal(10,0) NOT NULL,
  `quantity` float NOT NULL,
  `subtotal` float NOT NULL,
  `vat` float NOT NULL,
  `total` float NOT NULL,
  PRIMARY KEY (`estimate_details_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jm_estimate_master_details`
--

INSERT INTO `jm_estimate_master_details` (`estimate_details_id`, `estimate_masterid`, `description`, `unitprice`, `unit_type`, `conv_factor`, `quantity`, `subtotal`, `vat`, `total`) VALUES
(1, 1, 'TRANSPORTATION CHARGES ', '1200', 'SAR', '1', 1, 1200, 180, 1380),
(2, 5, 'TRANSPORTATION CHARGES ', '600', 'SAR', '6', 6, 21600, 216, 21816),
(3, 10, 'OTHER CHARGES ', '5', 'INR', '2', 5, 50, 2.5, 52.5),
(4, 11, 'Abc ', '100', 'AED', '1', 50, 5000, 750, 5750),
(5, 12, 'as ', '1', 'AED', '1', 23, 23, 0, 0),
(6, 13, 'TRANSPORTATION CHARGES ', '2', 'AED', '1', 200, 400, 20, 420),
(7, 14, 'TRANSPORTATION CHARGES ', '11', 'SAR', '12', 12, 1584, 316.8, 1900.8),
(8, 15, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', 11, 11, 0.11, 11.11),
(9, 16, 'TRANSPORTATION CHARGES FROM AL KAFAA TO JUBAIL GAS ARABIAN SERVICES ', '11', 'SAR', '1', 111, 1221, 12.21, 1233.21),
(10, 17, 'TRANSPORTATION CHARGES ', '12', 'AED', '1', 12, 144, 17.28, 161.28),
(11, 18, 'TRANSPORTATION CHARGES ', '12', 'AED', '12', 22, 3168, 63.36, 3231.36),
(12, 19, 'AIR FREIGHT CHARGES ', '20', 'AED', '20', 20, 8000, 1600, 9600),
(13, 20, 'TRANSPORTATION CHARGES ', '22', 'EUR', '12', 12, 3168, 63.36, 3231.36),
(14, 21, 'CUSTOMS CLEARANCE CHARGES ', '3', 'USD', '1', 111, 333, 6.66, 339.66),
(15, 22, 'MISCELLANEOUS EXP. ', '12', 'GBP', '11', 2222, 293304, 8799.12, 302103),
(16, 3, 'SASO CERTIFICATION CHARGES ', '23', 'SAR', '11', 111, 28083, 561.66, 28644.7),
(17, 23, 'CUSTOMS CLEARANCE CHARGES ', '65', 'AED', '35', 685, 1558380, 46751.2, 1605130),
(18, 24, 'CUSTOMS DUTY (AS ATTACHED) ', '12', 'SAR', '1', 22, 264, 5.28, 269.28),
(19, 25, 'DO/ PORT CHARGES (AS ATTACHED) ', '22', 'INR', '1', 123, 2706, 54.12, 2760.12),
(20, 26, 'SEA FREIGHT CHARGES ', '25', 'USD', '12', 50, 15000, 150, 15150),
(21, 27, 'SEA FREIGHT CHARGES ', '784', 'EUR', '1', 222, 174048, 3480.96, 177529),
(22, 28, 'SEA FREIGHT CHARGES ', '1550', 'USD', '1', 123456, 191357000, 1913570, 193270000),
(23, 28, 'CUSTOMS CLEARANCE CHARGES ', '1000', 'USD', '1', 5000, 5000000, 50000, 5050000),
(24, 30, 'SEA FREIGHT CHARGES ', '12', 'EUR', '1', 22, 264, 2.64, 266.64),
(25, 1, 'AIR FREIGHT CHARGES ', '35', 'AED', '12', 500, 210000, 6300, 216300),
(26, 23, 'AIR FREIGHT CHARGES ', '222', 'SAR', '1', 520, 115440, 3463.2, 118903),
(27, 31, 'TRANSPORTATION CHARGES ', '85', 'INR', '1', 250, 21250, 425, 21675),
(28, 3, 'TRANSPORTATION CHARGES ', '2', 'INR', '23', 3232, 148672, 1486.72, 150159),
(29, 32, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', 250, 3000, 30, 3030),
(30, 32, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', 655, 807615, 16152.3, 823767),
(31, 33, 'TRANSPORTATION CHARGES ', '12', 'SAR', '12', 23, 3312, 331.2, 3643.2),
(32, 34, 'TRANSPORTATION CHARGES ', '53', 'SAR', '1', 12, 636, 127.2, 763.2),
(33, 35, 'TRANSPORTATION CHARGES ', '52', 'SAR', '1', 12, 624, 74.88, 698.88),
(34, 36, 'AIR FREIGHT CHARGES ', '12', 'INR', '1', 12, 144, 93.6, 237.6),
(35, 37, 'TRANSPORTATION CHARGES ', '23', 'SAR', '52', 63, 75348, 26371.8, 101720),
(36, 38, 'TRANSPORTATION CHARGES ', '12', 'INR', '23', 50, 13800, 276, 14076),
(37, 39, 'TRANSPORTATION CHARGES ', '12', 'bank', '1', 12, 144, 1.44, 145.44),
(38, 40, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', 12, 144, 1.44, 145.44);

-- --------------------------------------------------------

--
-- Table structure for table `jm_expensedetail`
--

DROP TABLE IF EXISTS `jm_expensedetail`;
CREATE TABLE IF NOT EXISTS `jm_expensedetail` (
  `ExpenseDetailId` int(11) NOT NULL AUTO_INCREMENT,
  `Description` longtext DEFAULT NULL,
  `Amount` decimal(18,2) DEFAULT NULL,
  `ConvFactor` decimal(18,2) DEFAULT NULL,
  `Vat` decimal(18,2) DEFAULT NULL,
  `Total` decimal(18,2) DEFAULT NULL,
  `Currency` longtext DEFAULT NULL,
  `ExpenseMasterId` int(11) DEFAULT NULL,
  `Code` int(11) NOT NULL,
  `vat_persentage` text DEFAULT NULL,
  PRIMARY KEY (`ExpenseDetailId`)
) ENGINE=MyISAM AUTO_INCREMENT=413 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jm_expensedetail`
--

INSERT INTO `jm_expensedetail` (`ExpenseDetailId`, `Description`, `Amount`, `ConvFactor`, `Vat`, `Total`, `Currency`, `ExpenseMasterId`, `Code`, `vat_persentage`) VALUES
(1, 'TRANSPORTATION CHARGES ', '800.00', '1.00', '0.00', '800.00', 'SAR', 1, 0, NULL),
(2, 'CLEARANCE AND DELIVERY CHARGES ', '39000.00', '1.00', '5850.00', '44850.00', 'SAR', 2, 0, NULL),
(3, 'DO/ PORT CHARGES (AS ATTACHED) ', '1328.25', '1.00', '0.00', '1328.25', 'SAR', 2, 0, NULL),
(6, 'DOCUMENTATION/ HANDLING CHARGES ', '1000.00', '1.00', '0.00', '1000.00', 'SAR', 4, 0, NULL),
(5, 'LABOR CHARGES ', '5000.00', '1.00', '0.00', '5000.00', 'SAR', 3, 0, NULL),
(7, 'TRANSPORTATION CHARGES ', '473.00', '1.00', '0.00', '473.00', 'SAR', 5, 0, NULL),
(8, 'SEA FREIGHT CHARGES ', '2879.91', '1.00', '0.00', '2879.91', 'SAR', 6, 0, NULL),
(9, 'DOCUMENTATION CHARGES ', '402.50', '1.00', '0.00', '402.50', 'SAR', 7, 0, NULL),
(10, 'SEA FREIGHT CHARGES ', '4488.00', '3.76', '0.00', '16874.88', 'USD', 8, 0, NULL),
(11, 'TRANSPORTATION CHARGES ', '800.00', '1.00', '0.00', '800.00', 'SAR', 9, 0, NULL),
(12, 'TRANSPORTATION CHARGES ', '800.00', '1.00', '0.00', '800.00', 'SAR', 10, 0, NULL),
(13, 'TRANSPORTATION CHARGES ', '800.00', '1.00', '0.00', '800.00', 'SAR', 11, 0, NULL),
(14, 'TRANSPORTATION CHARGES ', '2600.00', '1.00', '0.00', '2600.00', 'SAR', 12, 0, NULL),
(15, 'SEA FREIGHT CHARGES ', '585.00', '3.76', '0.00', '2199.60', 'USD', 13, 0, NULL),
(16, 'MISCELLANEOUS EXP. ', '200.00', '1.00', '0.00', '200.00', 'SAR', 14, 0, NULL),
(17, 'SEA FREIGHT CHARGES ', '285.00', '3.75', '0.00', '1068.75', 'USD', 15, 0, NULL),
(18, 'TRANSPORTATION CHARGES ', '800.00', '1.00', '0.00', '800.00', 'SAR', 16, 0, NULL),
(19, 'TRANSPORTATION CHARGES ', '800.00', '1.00', '0.00', '800.00', 'SAR', 17, 0, NULL),
(20, 'TRANSPORTATION CHARGES ', '800.00', '1.00', '0.00', '800.00', 'SAR', 18, 0, NULL),
(21, 'AIR FREIGHT CHARGES ', '1158.08', '3.75', '0.00', '4342.80', 'USD', 19, 0, NULL),
(22, 'SCOC  HANDLING CHARGES ', '402.50', '1.00', '0.00', '402.50', 'SAR', 20, 0, NULL),
(23, 'CUSTOMS DUTY (AS ATTACHED) ', '1596.32', '1.00', '0.00', '1596.32', 'SAR', 21, 0, NULL),
(24, 'TRANSPORTATION CHARGES ', '750.00', '1.00', '0.00', '750.00', 'SAR', 22, 0, NULL),
(25, '1 ', '2268.86', '3.76', '0.00', '8530.91', 'USD', 23, 0, NULL),
(26, 'COO/ HANDLING CHARGES ', '100.00', '1.00', '0.00', '100.00', 'SAR', 24, 0, NULL),
(27, 'CLEARANCE AND DELIVERY CHARGES ', '1150.00', '1.00', '172.50', '1322.50', 'SAR', 25, 0, NULL),
(28, 'DO/ PORT CHARGES (AS ATTACHED) ', '578.00', '1.00', '0.00', '578.00', 'SAR', 25, 0, NULL),
(29, 'AIR FREIGHT CHARGES ', '371.60', '4.60', '0.00', '1709.36', 'EUR', 26, 0, NULL),
(30, 'AIR FREIGHT CHARGES ', '2203.56', '3.75', '0.00', '8263.35', 'USD', 27, 0, NULL),
(31, 'DOCUMENTATION CHARGES ', '2500.00', '1.00', '375.00', '2875.00', 'SAR', 28, 0, NULL),
(32, 'CLEARANCE AND DELIVERY CHARGES ', '550.00', '1.00', '82.50', '632.50', 'SAR', 29, 0, NULL),
(33, 'DO/ PORT CHARGES (AS ATTACHED) ', '2004.56', '1.00', '0.00', '2004.56', 'SAR', 29, 0, NULL),
(34, 'AIR FREIGHT CHARGES ', '573.00', '3.75', '0.00', '2151.04', 'USD', 30, 0, NULL),
(42, 'DO/ PORT CHARGES (AS ATTACHED) ', '333.80', '1.00', '0.00', '333.80', 'SAR', 35, 0, NULL),
(39, 'DOCUMENTATION CHARGES ', '2500.00', '1.00', '375.00', '2875.00', 'SAR', 33, 0, NULL),
(41, 'CLEARANCE AND DELIVERY CHARGES ', '550.00', '1.00', '82.50', '632.50', 'SAR', 35, 0, NULL),
(40, 'AIR FREIGHT CHARGES ', '921.55', '4.55', '0.00', '4193.05', 'EUR', 34, 0, NULL),
(43, 'DO/ PORT CHARGES (AS ATTACHED) ', '1915.76', '1.00', '0.00', '1915.76', 'SAR', 36, 0, NULL),
(44, 'CUSTOMS DUTY (AS ATTACHED) ', '4427.07', '1.00', '0.00', '4427.07', 'SAR', 37, 0, NULL),
(45, 'SEA FREIGHT CHARGES ', '200.00', '3.75', '0.00', '750.00', 'USD', 38, 0, NULL),
(46, 'CLEARANCE AND DELIVERY CHARGES ', '600.00', '1.00', '90.00', '690.00', 'SAR', 39, 0, NULL),
(47, 'DO/ PORT CHARGES (AS ATTACHED) ', '1558.00', '1.00', '0.00', '1558.00', 'SAR', 39, 0, NULL),
(52, 'CUSTOMS CLEARANCE CHARGES ', '350.00', '1.00', '52.50', '402.50', 'SAR', 31, 0, NULL),
(57, 'AIR FREIGHT CHARGES ', '5162.04', '4.55', '0.00', '23487.28', 'EUR', 41, 0, NULL),
(56, 'TRANSPORTATION CHARGES ', '2000.00', '1.00', '0.00', '2000.00', 'SAR', 40, 0, NULL),
(53, 'DO/ PORT CHARGES (AS ATTACHED) ', '285.23', '1.00', '0.00', '285.23', 'SAR', 31, 0, NULL),
(58, 'AIR FREIGHT CHARGES ', '580.00', '3.75', '0.00', '2177.32', 'USD', 42, 0, NULL),
(59, 'TRANSPORTATION CHARGES ', '650.00', '1.00', '0.00', '650.00', 'SAR', 43, 0, NULL),
(60, 'SEA FREIGHT CHARGES ', '608.00', '4.50', '0.00', '2736.00', 'EUR', 44, 0, NULL),
(61, 'TRANSPORTATION CHARGES ', '750.00', '1.00', '0.00', '750.00', 'SAR', 45, 0, NULL),
(62, 'MISCELLANEOUS EXP. ', '1308.00', '1.00', '0.00', '1308.00', 'SAR', 46, 0, NULL),
(63, 'TRANSPORTATION CHARGES ', '750.00', '1.00', '0.00', '750.00', 'SAR', 47, 0, NULL),
(64, 'TRANSPORTATION CHARGES ', '2300.00', '1.00', '0.00', '2300.00', 'SAR', 48, 0, NULL),
(65, 'MISCELLANEOUS EXP. ', '200.00', '1.00', '0.00', '200.00', 'SAR', 49, 0, NULL),
(66, 'AIR FREIGHT CHARGES ', '2563.47', '3.75', '0.00', '9623.27', 'USD', 50, 0, NULL),
(67, 'MISCELLANEOUS EXP. ', '200.00', '1.00', '0.00', '200.00', 'SAR', 51, 0, NULL),
(68, 'DOCUMENTATION CHARGES ', '100.00', '1.00', '0.00', '100.00', 'SAR', 52, 0, NULL),
(69, 'SABER CERTIFICATION CHARGES ', '402.50', '1.00', '0.00', '402.50', 'SAR', 53, 0, NULL),
(70, 'AIR FREIGHT CHARGES ', '4212.30', '3.75', '0.00', '15812.97', 'USD', 54, 0, NULL),
(71, 'MISCELLANEOUS EXP. ', '200.00', '1.00', '0.00', '200.00', 'SAR', 55, 0, NULL),
(72, 'DO/ PORT CHARGES (AS ATTACHED) ', '371.71', '1.00', '0.00', '371.71', 'SAR', 56, 0, NULL),
(73, 'CLEARANCE AND DELIVERY CHARGES ', '550.00', '1.00', '82.50', '632.50', 'SAR', 56, 0, NULL),
(74, 'AIR FREIGHT CHARGES ', '785.75', '3.75', '0.00', '2949.71', 'USD', 57, 0, NULL),
(75, 'SEA FREIGHT CHARGES ', '185.00', '3.75', '0.00', '693.75', 'USD', 58, 0, NULL),
(76, 'SEA FREIGHT CHARGES ', '198.00', '3.76', '0.00', '744.48', 'EUR', 59, 0, NULL),
(77, 'TRANSPORTATION CHARGES ', '1000.00', '1.00', '0.00', '1000.00', 'SAR', 60, 0, NULL),
(78, 'SEA FREIGHT CHARGES ', '3126.78', '3.75', '0.00', '11737.93', 'USD', 61, 0, NULL),
(79, 'TRANSPORTATION CHARGES ', '2000.00', '1.00', '0.00', '2000.00', 'SAR', 62, 0, NULL),
(80, 'TRANSPORTATION CHARGES ', '750.00', '1.00', '0.00', '750.00', 'SAR', 63, 0, NULL),
(81, 'CUSTOMS CLEARANCE CHARGES ', '900.00', '1.00', '135.00', '1035.00', 'SAR', 64, 0, NULL),
(82, 'DO/ PORT CHARGES (AS ATTACHED) ', '1810.37', '1.00', '0.00', '1810.37', 'SAR', 64, 0, NULL),
(83, 'SASO/ COO/ HANDLING CHARGES ', '225.00', '1.00', '33.75', '258.75', 'SAR', 65, 0, NULL),
(84, 'CUSTOMS CLEARANCE CHARGES ', '900.00', '1.00', '135.00', '1035.00', 'SAR', 66, 0, NULL),
(85, 'DO/ PORT CHARGES (AS ATTACHED) ', '2950.10', '1.00', '0.00', '2950.10', 'SAR', 66, 0, NULL),
(86, 'DOCUMENTATION/ HANDLING CHARGES ', '6200.00', '1.00', '0.00', '6200.00', 'SAR', 67, 0, NULL),
(87, 'SASO/ COO/ HANDLING CHARGES ', '402.50', '1.00', '0.00', '402.50', 'SAR', 67, 0, NULL),
(88, 'CLEARANCE AND DELIVERY CHARGES ', '900.00', '1.00', '135.00', '1035.00', 'SAR', 68, 0, NULL),
(89, 'DO/ PORT CHARGES (AS ATTACHED) ', '1482.51', '1.00', '0.00', '1482.51', 'SAR', 68, 0, NULL),
(90, 'SASO/ COO/ HANDLING CHARGES ', '5000.00', '1.00', '0.00', '5000.00', 'SAR', 69, 0, NULL),
(91, 'DOCUMENTATION/ HANDLING CHARGES ', '402.50', '1.00', '0.00', '402.50', 'SAR', 69, 0, NULL),
(92, 'TRANSPORTATION CHARGES ', '250.00', '1.00', '0.00', '250.00', 'SAR', 67, 0, NULL),
(93, 'SEA FREIGHT CHARGES ', '925.00', '3.75', '0.00', '3468.75', 'SAR', 70, 0, NULL),
(94, 'TRANSPORTATION CHARGES ', '750.00', '1.00', '0.00', '750.00', 'SAR', 71, 0, NULL),
(95, 'SEA FREIGHT CHARGES ', '1578.00', '3.75', '0.00', '5917.50', 'USD', 72, 0, NULL),
(96, 'CLEARANCE AND DELIVERY CHARGES ', '1000.00', '1.00', '150.00', '1150.00', 'SAR', 73, 0, NULL),
(97, 'DO/ PORT CHARGES (AS ATTACHED) ', '2385.80', '1.00', '0.00', '2385.80', 'SAR', 73, 0, NULL),
(98, 'SASO/ COO/ HANDLING CHARGES ', '5000.00', '1.00', '750.00', '5750.00', 'SAR', 74, 0, NULL),
(99, 'CLEARANCE AND DELIVERY ', '900.00', '1.00', '135.00', '1035.00', 'SAR', 75, 0, NULL),
(100, 'DO / PORT CHARGES ', '1935.75', '1.00', '0.00', '1935.75', 'SAR', 75, 0, NULL),
(101, 'AIR FREIGHT CHARGES ', '482.90', '3.75', '0.00', '1810.88', 'USD', 76, 0, NULL),
(102, 'AIR FREIGHT CHARGES ', '5063.77', '3.75', '0.00', '18989.14', 'USD', 77, 0, NULL),
(103, 'SEA FREIGHT CHARGES ', '560.00', '4.50', '0.00', '2520.00', 'EUR', 78, 0, NULL),
(104, 'AIR FREIGHT CHARGES ', '567.80', '3.75', '0.00', '2129.25', 'USD', 79, 0, NULL),
(105, 'CLEARANCE AND DELIVERY CHARGES ', '550.00', '1.00', '82.50', '632.50', 'SAR', 80, 0, NULL),
(106, 'DO/ PORT CHARGES (AS ATTACHED) ', '651.65', '1.00', '0.00', '651.65', 'SAR', 80, 0, NULL),
(107, 'CUSTOMS DUTY (AS ATTACHED) ', '2744.32', '1.00', '0.00', '2744.32', 'SAR', 81, 0, NULL),
(108, 'OTHER CHARGES ', '229.25', '3.75', '0.00', '859.69', 'USD', 82, 0, NULL),
(109, 'SASO/ COO/ HANDLING CHARGES ', '3000.00', '1.00', '450.00', '3450.00', 'SAR', 83, 0, NULL),
(110, 'CLEARANCE AND DELIVERY CHARGES ', '650.00', '1.00', '97.50', '747.50', 'SAR', 84, 0, NULL),
(111, 'DO/ PORT CHARGES (AS ATTACHED) ', '1857.00', '1.00', '0.00', '1857.00', 'SAR', 84, 0, NULL),
(112, 'CUSTOMS DUTY (AS ATTACHED) ', '24219.34', '1.00', '0.00', '24219.34', 'SAR', 85, 0, NULL),
(115, 'AIR FREIGHT CHARGES ', '3350.60', '4.50', '0.00', '15077.70', 'EUR', 88, 0, NULL),
(114, 'DO CHARGES (AS ATTACHED) ', '932.75', '1.00', '0.00', '932.75', 'SAR', 87, 0, NULL),
(116, 'CLEARANCE AND DELIVERY CHARGES ', '550.00', '1.00', '82.50', '632.50', 'SAR', 89, 0, NULL),
(117, 'DO/ PORT CHARGES (AS ATTACHED) ', '1479.20', '1.00', '0.00', '1479.20', 'SAR', 89, 0, NULL),
(118, 'TRANSPORTATION CHARGES ', '220.00', '1.00', '0.00', '220.00', 'SAR', 90, 0, NULL),
(119, 'SEA FREIGHT CHARGES ', '125.00', '3.75', '0.00', '468.75', 'SAR', 91, 0, NULL),
(120, 'SEA FREIGHT CHARGES ', '1411.04', '4.50', '0.00', '6349.68', 'EUR', 92, 0, NULL),
(121, 'AIR FREIGHT CHARGES ', '278.15', '4.50', '0.00', '1251.68', 'EUR', 93, 0, NULL),
(122, 'AIR FREIGHT CHARGES ', '855.94', '3.75', '0.00', '3209.78', 'USD', 94, 0, NULL),
(123, 'AIR FREIGHT CHARGES ', '420.00', '3.75', '0.00', '1575.00', 'USD', 95, 0, NULL),
(124, 'SEA FREIGHT CHARGES ', '504.64', '4.60', '0.00', '2320.84', 'EUR', 96, 0, NULL),
(125, 'CLEARANCE AND DELIVERY CHARGES ', '850.00', '1.00', '127.50', '977.50', 'SAR', 97, 0, NULL),
(126, 'DO/ PORT CHARGES (AS ATTACHED) ', '7057.85', '1.00', '0.00', '7057.85', 'SAR', 97, 0, NULL),
(127, 'DO/ PORT CHARGES (AS ATTACHED) ', '3151.30', '1.00', '0.00', '3151.30', 'SAR', 98, 0, NULL),
(128, 'CLEARANCE AND DELIVERY CHARGES ', '950.00', '1.00', '142.50', '1092.50', 'SAR', 98, 0, NULL),
(129, 'CLEARANCE AND DELIVERY CHARGES ', '850.00', '1.00', '127.50', '977.50', 'SAR', 99, 0, NULL),
(130, 'DO/ PORT CHARGES (AS ATTACHED) ', '6439.10', '1.00', '0.00', '6439.10', 'SAR', 99, 0, NULL),
(131, 'SASO/ COO/ HANDLING CHARGES ', '225.00', '1.00', '33.75', '258.75', 'SAR', 100, 0, NULL),
(132, 'CLEARANCE AND DELIVERY CHARGES ', '600.00', '1.00', '90.00', '690.00', 'SAR', 101, 0, NULL),
(133, 'DO/ PORT CHARGES (AS ATTACHED) ', '1606.00', '1.00', '0.00', '1606.00', 'SAR', 101, 0, NULL),
(134, 'SASO/ COO/ HANDLING CHARGES ', '225.00', '1.00', '33.75', '258.75', 'SAR', 102, 0, NULL),
(135, 'CLEARANCE AND DELIVERY CHARGES ', '900.00', '1.00', '135.00', '1035.00', 'SAR', 103, 0, NULL),
(136, 'DO/ PORT CHARGES (AS ATTACHED) ', '3098.64', '1.00', '0.00', '3098.64', 'SAR', 103, 0, NULL),
(137, 'DOCUMENTATION/ HANDLING CHARGES ', '225.00', '1.00', '33.75', '258.75', 'SAR', 104, 0, NULL),
(138, 'CLEARANCE AND DELIVERY CHARGES ', '550.00', '1.00', '82.50', '632.50', 'SAR', 105, 0, NULL),
(139, 'DO/ PORT CHARGES (AS ATTACHED) ', '787.36', '1.00', '0.00', '787.36', 'SAR', 105, 0, NULL),
(140, 'SASO/ COO/ HANDLING CHARGES ', '100.00', '1.00', '0.00', '100.00', 'SAR', 106, 0, NULL),
(141, 'CLEARANCE AND DELIVERY CHARGES ', '900.00', '1.00', '135.00', '1035.00', 'SAR', 107, 0, NULL),
(142, 'DO/ PORT CHARGES (AS ATTACHED) ', '1829.20', '1.00', '0.00', '1829.20', 'SAR', 107, 0, NULL),
(143, 'DOCUMENTATION/ HANDLING CHARGES ', '100.00', '1.00', '0.00', '100.00', 'SAR', 108, 0, NULL),
(144, 'CLEARANCE AND DELIVERY CHARGES ', '600.00', '1.00', '90.00', '690.00', 'SAR', 109, 0, NULL),
(145, 'DO/ PORT CHARGES (AS ATTACHED) ', '1225.50', '1.00', '0.00', '1225.50', 'SAR', 109, 0, NULL),
(146, 'SASO/ COO/ HANDLING CHARGES ', '225.00', '1.00', '33.75', '258.75', 'SAR', 110, 0, NULL),
(147, 'AIR FREIGHT CHARGES ', '8682.56', '3.75', '0.00', '32559.60', 'USD', 111, 0, NULL),
(148, 'CLEARANCE AND DELIVERY CHARGES ', '550.00', '1.00', '82.50', '632.50', 'SAR', 112, 0, NULL),
(149, 'AIR FREIGHT CHARGES ', '2853.35', '4.50', '0.00', '12840.08', 'EUR', 113, 0, NULL),
(150, 'AIR FREIGHT CHARGES ', '1738.00', '3.75', '0.00', '6517.50', 'USD', 114, 0, NULL),
(151, 'AIR FREIGHT CHARGES ', '3132.41', '4.50', '0.00', '14095.85', 'EUR', 115, 0, NULL),
(152, 'MISCELLANEOUS EXP. ', '266.25', '3.75', '0.00', '998.44', 'USD', 116, 0, NULL),
(153, 'TRANSPORTATION CHARGES ', '750.00', '1.00', '0.00', '750.00', 'SAR', 117, 0, NULL),
(154, 'AIR FREIGHT CHARGES ', '1433.30', '4.50', '0.00', '6449.85', 'EUR', 118, 0, NULL),
(155, 'MISCELLANEOUS EXP. ', '200.00', '1.00', '0.00', '200.00', 'SAR', 119, 0, NULL),
(156, 'DOCUMENTATION CHARGES ', '402.50', '1.00', '0.00', '402.50', 'SAR', 120, 0, NULL),
(157, 'AIR FREIGHT CHARGES ', '358.60', '4.50', '0.00', '1613.70', 'EUR', 121, 0, NULL),
(158, 'CLEARANCE AND DELIVERY CHARGES ', '550.00', '1.00', '82.50', '632.50', 'SAR', 122, 0, NULL),
(159, 'DO/ PORT CHARGES (AS ATTACHED) ', '330.76', '1.00', '0.00', '330.76', 'SAR', 122, 0, NULL),
(160, 'MISCELLANEOUS EXP. ', '200.00', '1.00', '0.00', '200.00', 'SAR', 123, 0, NULL),
(161, 'AIR FREIGHT CHARGES ', '408.25', '4.50', '0.00', '1837.13', 'EUR', 124, 0, NULL),
(162, 'CLEARANCE AND DELIVERY CHARGES ', '550.00', '1.00', '82.50', '632.50', 'SAR', 125, 0, NULL),
(163, 'DO/ PORT CHARGES (AS ATTACHED) ', '522.70', '1.00', '0.00', '522.70', 'SAR', 125, 0, NULL),
(164, 'MISCELLANEOUS EXP. ', '200.00', '1.00', '0.00', '200.00', 'SAR', 126, 0, NULL),
(165, 'CLEARANCE AND DELIVERY CHARGES ', '550.00', '1.00', '82.50', '632.50', 'SAR', 127, 0, NULL),
(166, 'DO/ PORT CHARGES (AS ATTACHED) ', '293.70', '1.00', '0.00', '293.70', 'SAR', 127, 0, NULL),
(173, 'CLEARANCE AND DELIVERY CHARGES ', '700.00', '1.00', '105.00', '805.00', 'SAR', 132, 0, NULL),
(172, 'AIR FREIGHT CHARGES ', '355.47', '3.75', '0.00', '1333.01', 'USD', 131, 0, NULL),
(169, 'MISCELLANEOUS EXP. ', '200.00', '1.00', '0.00', '200.00', 'SAR', 129, 0, NULL),
(170, 'CLEARANCE AND DELIVERY CHARGES ', '900.00', '1.00', '135.00', '1035.00', 'SAR', 130, 0, NULL),
(171, 'DO/ PORT CHARGES (AS ATTACHED) ', '1988.63', '1.00', '0.00', '1988.63', 'SAR', 130, 0, NULL),
(174, 'DO/ PORT CHARGES (AS ATTACHED) ', '477.00', '1.00', '0.00', '477.00', 'SAR', 132, 0, NULL),
(175, 'CLEARANCE AND DELIVERY CHARGES ', '550.00', '1.00', '82.50', '632.50', 'SAR', 133, 0, NULL),
(176, 'CLEARANCE AND DELIVERY CHARGES ', '600.00', '1.00', '90.00', '690.00', 'SAR', 134, 0, NULL),
(177, 'DO/ PORT CHARGES (AS ATTACHED) ', '1839.50', '1.00', '0.00', '1839.50', 'SAR', 134, 0, NULL),
(178, 'TRANSPORTATION CHARGES ', '6600.00', '1.00', '0.00', '6600.00', 'SAR', 135, 0, NULL),
(179, 'TRANSPORTATION CHARGES ', '750.00', '1.00', '0.00', '750.00', 'SAR', 136, 0, NULL),
(180, 'CLEARANCE AND DELIVERY CHARGES ', '5487.00', '1.00', '0.00', '5487.00', 'SAR', 137, 0, NULL),
(181, 'TRANSPORTATION CHARGES ', '750.00', '1.00', '0.00', '750.00', 'SAR', 138, 0, NULL),
(182, 'CLEARANCE AND DELIVERY CHARGES ', '700.00', '1.00', '105.00', '805.00', 'SAR', 139, 0, NULL),
(183, 'DO/ PORT CHARGES (AS ATTACHED) ', '671.30', '1.00', '0.00', '671.30', 'SAR', 139, 0, NULL),
(184, 'CLEARANCE AND DELIVERY CHARGES ', '1750.00', '1.00', '262.50', '2012.50', 'SAR', 140, 0, NULL),
(185, 'DO/ PORT CHARGES (AS ATTACHED) ', '1432.47', '1.00', '0.00', '1432.47', 'SAR', 140, 0, NULL),
(186, 'CUSTOMS CLEARANCE CHARGES ', '350.00', '1.00', '52.50', '402.50', 'SAR', 141, 0, NULL),
(187, 'CUSTOMS DUTY (AS ATTACHED) ', '178.00', '1.00', '0.00', '178.00', 'SAR', 141, 0, NULL),
(188, 'DOCUMENTATION CHARGES ', '59.50', '1.00', '0.00', '59.50', 'SAR', 141, 0, NULL),
(189, 'CLEARANCE AND DELIVERY CHARGES ', '900.00', '1.00', '135.00', '1035.00', 'SAR', 142, 0, NULL),
(190, 'DO/ PORT CHARGES (AS ATTACHED) ', '1525.70', '1.00', '0.00', '1525.70', 'SAR', 142, 0, NULL),
(191, 'SEA FREIGHT CHARGES ', '925.00', '3.75', '0.00', '3468.75', 'USD', 143, 0, NULL),
(192, 'CLEARANCE AND DELIVERY CHARGES ', '900.00', '1.00', '135.00', '1035.00', 'SAR', 144, 0, NULL),
(193, 'DO/ PORT CHARGES (AS ATTACHED) ', '2319.00', '1.00', '0.00', '2319.00', 'SAR', 144, 0, NULL),
(194, 'DOCUMENTATION CHARGES ', '300.00', '1.00', '0.00', '300.00', 'SAR', 145, 0, NULL),
(195, 'DOCUMENTATION CHARGES ', '100.00', '1.00', '0.00', '100.00', 'SAR', 146, 0, NULL),
(196, 'DO/ PORT CHARGES (AS ATTACHED) ', '1867.52', '1.00', '0.00', '1867.52', 'SAR', 147, 0, NULL),
(197, 'CLEARANCE AND DELIVERY CHARGES ', '900.00', '1.00', '135.00', '1035.00', 'SAR', 147, 0, NULL),
(198, 'CUSTOMS CLEARANCE CHARGES ', '350.00', '1.00', '52.50', '402.50', 'SAR', 148, 0, NULL),
(199, 'DOCUMENTATION CHARGES ', '7.50', '1.00', '0.00', '7.50', 'SAR', 148, 0, NULL),
(200, 'HANDLING CHARGES ', '8500.00', '1.00', '1275.00', '9775.00', 'SAR', 149, 0, NULL),
(201, 'AIR FREIGHT CHARGES ', '1493.50', '3.75', '0.00', '5600.63', 'USD', 150, 0, NULL),
(202, 'TRANSPORTATION CHARGES ', '0.00', '1.00', '0.00', '0.00', 'SAR', 256, 0, ''),
(203, 'TRANSPORTATION CHARGES ', '0.00', '1.00', '0.00', '0.00', 'SAR', 257, 0, ''),
(204, 'CUSTOMS CLEARANCE CHARGES ', '0.00', '1.00', '0.00', '0.00', 'SAR', 258, 0, ''),
(205, 'TRANSPORTATION CHARGES ', '52.00', '1.00', '26.00', '78.00', 'SAR', 259, 0, ''),
(206, 'TRANSPORTATION CHARGES ', '0.00', '1.00', '1.44', '13.44', 'SAR', 260, 0, ''),
(207, 'TRANSPORTATION CHARGES ', '2.00', '1.00', '4.00', '6.00', 'SAR', 261, 0, ''),
(208, 'TRANSPORTATION CHARGES ', '780.00', '1.00', '663.00', '1443.00', 'SAR', 261, 0, ''),
(209, 'TRANSPORTATION CHARGES ', '1.00', '1.00', '0.65', '1.65', 'SAR', 262, 0, ''),
(210, 'TRANSPORTATION CHARGES ', '0.00', '1.00', '6.00', '0.00', 'SAR', 263, 0, ''),
(211, 'CUSTOMS DUTY (AS ATTACHED) ', '12.00', '1.00', '6.24', '0.00', 'SAR', 264, 0, ''),
(212, 'TRANSPORTATION CHARGES ', '0.00', '1.00', '0.00', '0.00', 'SAR', 265, 0, ''),
(213, 'SEA FREIGHT CHARGES ', '0.00', '21.00', '0.00', '0.00', 'INR', 265, 0, ''),
(214, 'SEA FREIGHT CHARGES ', '58.00', '1.00', '30.16', '88.16', 'SAR', 266, 0, ''),
(215, 'TRANSPORTATION CHARGES ', '34.00', '1.00', '11.90', '45.90', 'SAR', 267, 0, ''),
(216, 'TRANSPORTATION CHARGES ', '52.00', '1.00', '10.40', '62.40', 'SAR', 269, 0, ''),
(217, 'SEA FREIGHT CHARGES ', '36.00', '1.00', '4.32', '40.32', 'SAR', 269, 0, ''),
(218, 'TRANSPORTATION CHARGES ', '52.00', '1.00', '0.52', '52.52', 'SAR', 270, 0, ''),
(219, 'AIR FREIGHT CHARGES ', '12.00', '1.00', '4.20', '16.20', 'SAR', 271, 0, ''),
(220, 'AIR FREIGHT CHARGES ', '20.00', '1.00', '4.20', '24.20', 'SAR', 272, 0, ''),
(221, 'SEA FREIGHT CHARGES ', '20.00', '1.00', '6.40', '26.40', 'SAR', 273, 0, ''),
(222, 'AIR FREIGHT CHARGES ', '32.00', '1.00', '9.60', '41.60', 'SAR', 274, 0, ''),
(223, 'CUSTOMS DUTY (AS ATTACHED) ', '65.00', '1.00', '34.45', '99.45', 'SAR', 274, 0, ''),
(224, 'SEA FREIGHT CHARGES ', '12.00', '1.00', '6.60', '18.60', 'SAR', 275, 0, ''),
(225, 'AIR FREIGHT CHARGES ', '32.00', '1.00', '9.60', '41.60', 'SAR', 276, 0, ''),
(226, 'CUSTOMS DUTY (AS ATTACHED) ', '65.00', '1.00', '34.45', '99.45', 'SAR', 276, 0, ''),
(227, 'SEA FREIGHT CHARGES ', '12.00', '1.00', '2.76', '14.76', 'SAR', NULL, 0, ''),
(228, 'SEA FREIGHT CHARGES ', '12.00', '1.00', '2.76', '14.76', 'SAR', 279, 0, ''),
(229, 'SEA FREIGHT CHARGES ', '12.00', '1.00', '1.44', '13.44', 'SAR', 280, 0, ''),
(230, 'TRANSPORTATION CHARGES ', '34.00', '1.00', '4.08', '38.08', 'SAR', 280, 0, ''),
(231, 'SEA FREIGHT CHARGES ', '12.00', '1.00', '1.44', '13.44', 'SAR', 281, 0, ''),
(232, 'TRANSPORTATION CHARGES ', '34.00', '1.00', '4.08', '38.08', 'SAR', 281, 0, ''),
(233, 'SEA FREIGHT CHARGES ', '30.00', '1.00', '6.90', '36.90', 'SAR', 282, 0, ''),
(234, 'CUSTOMS DUTY (AS ATTACHED) ', '56.00', '1.00', '25.20', '81.20', 'SAR', 282, 0, ''),
(235, 'SEA FREIGHT CHARGES ', '30.00', '1.00', '6.90', '36.90', 'SAR', 283, 0, ''),
(236, 'CUSTOMS DUTY (AS ATTACHED) ', '56.00', '1.00', '25.20', '81.20', 'SAR', 283, 0, ''),
(237, 'SEA FREIGHT CHARGES ', '12.00', '1.00', '2.64', '14.64', 'SAR', 284, 0, ''),
(238, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '1.44', '13.44', 'SAR', 285, 0, ''),
(239, 'SEA FREIGHT CHARGES ', '12.00', '1.00', '1.44', '13.44', 'SAR', NULL, 0, ''),
(240, 'SEA FREIGHT CHARGES ', '1.00', '1.00', '0.01', '1.01', 'SAR', NULL, 0, ''),
(241, 'SEA FREIGHT CHARGES ', '12.00', '1.00', '0.12', '12.12', 'SAR', NULL, 0, ''),
(242, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.12', '12.12', 'SAR', NULL, 0, ''),
(243, 'DO/ PORT CHARGES (AS ATTACHED) ', '12.00', '1.00', '0.12', '12.12', 'SAR', NULL, 0, ''),
(244, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.12', '12.12', 'SAR', NULL, 0, ''),
(245, 'DO/ PORT CHARGES (AS ATTACHED) ', '12.00', '1.00', '0.12', '12.12', 'SAR', NULL, 0, ''),
(246, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.12', '12.12', 'SAR', NULL, 0, ''),
(247, 'SEA FREIGHT CHARGES ', '12.00', '1.00', '2.76', '14.76', 'SAR', NULL, 0, ''),
(248, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.12', '12.12', 'SAR', NULL, 0, ''),
(249, 'SEA FREIGHT CHARGES ', '12.00', '1.00', '2.76', '14.76', 'SAR', NULL, 0, ''),
(250, 'TRANSPORTATION CHARGES ', '30.00', '1.00', '0.30', '30.30', 'SAR', NULL, 0, ''),
(251, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', NULL, 0, ''),
(252, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.12', '12.12', 'SAR', NULL, 0, ''),
(253, 'TRANSPORTATION CHARGES ', '2.00', '1.00', '0.02', '2.02', 'SAR', NULL, 0, ''),
(254, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.12', '12.12', 'SAR', NULL, 0, ''),
(255, 'TRANSPORTATION CHARGES ', '2.00', '1.00', '0.02', '2.02', 'SAR', NULL, 0, ''),
(256, 'TRANSPORTATION CHARGES ', '25.00', '1.00', '8.50', '33.50', 'SAR', NULL, 0, ''),
(257, 'TRANSPORTATION CHARGES ', '35.00', '1.00', '12.25', '47.25', 'SAR', NULL, 0, ''),
(258, 'TRANSPORTATION CHARGES ', '25.00', '1.00', '8.50', '33.50', 'SAR', NULL, 0, ''),
(259, 'TRANSPORTATION CHARGES ', '35.00', '1.00', '12.25', '47.25', 'SAR', NULL, 0, ''),
(260, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', NULL, 0, ''),
(261, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.12', '12.12', 'SAR', NULL, 0, ''),
(262, 'SEA FREIGHT CHARGES ', '12.00', '1.00', '1.32', '13.32', 'SAR', NULL, 0, ''),
(263, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.12', '12.12', 'SAR', NULL, 0, ''),
(264, 'SEA FREIGHT CHARGES ', '12.00', '1.00', '1.32', '13.32', 'SAR', NULL, 0, ''),
(265, 'TRANSPORTATION CHARGES ', '1.00', '1.00', '0.00', '1.00', 'SAR', NULL, 0, ''),
(266, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', NULL, 0, ''),
(267, 'TRANSPORTATION CHARGES ', '25.00', '1.00', '0.00', '25.00', 'SAR', NULL, 0, ''),
(268, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', NULL, 0, ''),
(269, 'TRANSPORTATION CHARGES ', '25.00', '1.00', '0.00', '25.00', 'SAR', NULL, 0, ''),
(270, 'SEA FREIGHT CHARGES ', '11.00', '1.00', '0.00', '11.00', 'SAR', NULL, 0, ''),
(271, 'TRANSPORTATION CHARGES ', '30.00', '1.00', '0.30', '30.30', 'SAR', NULL, 0, ''),
(272, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', NULL, 0, ''),
(273, 'TRANSPORTATION CHARGES ', '30.00', '1.00', '0.30', '30.30', 'SAR', NULL, 0, ''),
(274, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', NULL, 0, ''),
(275, 'TRANSPORTATION CHARGES ', '35.00', '1.00', '10.50', '45.50', 'SAR', NULL, 0, ''),
(276, 'SEA FREIGHT CHARGES ', '30.00', '1.00', '0.00', '30.00', 'SAR', NULL, 0, ''),
(277, 'CUSTOMS DUTY (AS ATTACHED) ', '11.00', '1.00', '0.11', '11.11', 'SAR', NULL, 0, ''),
(278, 'SEA FREIGHT CHARGES ', '30.00', '1.00', '0.00', '30.00', 'SAR', NULL, 0, ''),
(279, 'CUSTOMS DUTY (AS ATTACHED) ', '11.00', '1.00', '0.11', '11.11', 'SAR', NULL, 0, ''),
(280, 'TRANSPORTATION CHARGES ', '1.00', '1.00', '0.00', '1.00', 'SAR', NULL, 0, ''),
(281, 'STORAGE/WAREHOUSE/LOL CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', NULL, 0, ''),
(282, 'TRANSPORTATION CHARGES ', '1.00', '1.00', '0.00', '1.00', 'SAR', NULL, 0, ''),
(283, 'STORAGE/WAREHOUSE/LOL CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', NULL, 0, ''),
(284, 'TRANSPORTATION CHARGES ', '11.00', '1.00', '0.00', '11.00', 'SAR', NULL, 0, ''),
(285, 'TRANSPORTATION CHARGES ', '1.00', '1.00', '0.00', '1.00', 'SAR', NULL, 0, ''),
(286, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', NULL, 0, ''),
(287, 'TRANSPORTATION CHARGES ', '1.00', '1.00', '0.00', '1.00', 'SAR', NULL, 0, ''),
(288, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', NULL, 0, ''),
(289, 'TRANSPORTATION CHARGES ', '1.00', '1.00', '0.01', '1.01', 'SAR', 317, 0, ''),
(290, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 317, 0, ''),
(291, 'TRANSPORTATION CHARGES ', '1.00', '1.00', '0.01', '1.01', 'SAR', 318, 0, ''),
(292, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 318, 0, ''),
(293, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 320, 0, ''),
(294, 'TRANSPORTATION CHARGES ', '23.00', '1.00', '0.00', '23.00', 'SAR', 321, 0, ''),
(295, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 322, 0, ''),
(296, 'TRANSPORTATION CHARGES ', '36.00', '1.00', '0.00', '36.00', 'SAR', 322, 0, ''),
(297, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 323, 0, ''),
(298, 'TRANSPORTATION CHARGES ', '36.00', '1.00', '0.00', '36.00', 'SAR', 323, 0, ''),
(299, 'TRANSPORTATION CHARGES ', '1.00', '1.00', '0.00', '1.00', 'SAR', 324, 0, ''),
(300, 'TRANSPORTATION CHARGES ', '25.00', '1.00', '0.00', '25.00', 'SAR', 325, 0, ''),
(301, 'TRANSPORTATION CHARGES ', '5.00', '1.00', '0.00', '5.00', 'SAR', 327, 0, ''),
(302, 'TRANSPORTATION CHARGES ', '65.00', '1.00', '0.00', '65.00', 'SAR', 328, 0, ''),
(303, 'TRANSPORTATION CHARGES ', '56.00', '1.00', '0.00', '56.00', 'SAR', 329, 0, ''),
(304, 'TRANSPORTATION CHARGES ', '52.00', '1.00', '0.00', '52.00', 'SAR', 330, 0, ''),
(305, 'TRANSPORTATION CHARGES ', '63.00', '1.00', '0.00', '63.00', 'SAR', 330, 0, ''),
(306, 'TRANSPORTATION CHARGES ', '52.00', '1.00', '0.00', '52.00', 'SAR', 331, 0, ''),
(307, 'TRANSPORTATION CHARGES ', '63.00', '1.00', '0.00', '63.00', 'SAR', 331, 0, ''),
(308, 'TRANSPORTATION CHARGES ', '52.00', '1.00', '0.00', '52.00', 'SAR', 332, 0, ''),
(309, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 333, 0, ''),
(310, 'AIR FREIGHT CHARGES ', '65.00', '1.00', '0.00', '65.00', 'SAR', 333, 0, ''),
(311, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 334, 0, ''),
(312, 'AIR FREIGHT CHARGES ', '65.00', '1.00', '0.00', '65.00', 'SAR', 334, 0, ''),
(313, 'TRANSPORTATION CHARGES ', '85.00', '1.00', '0.00', '85.00', 'SAR', 335, 0, ''),
(314, 'TRANSPORTATION CHARGES ', '34.00', '1.00', '0.00', '34.00', 'SAR', 335, 0, ''),
(315, 'TRANSPORTATION CHARGES ', '85.00', '1.00', '0.00', '85.00', 'SAR', 336, 0, ''),
(316, 'TRANSPORTATION CHARGES ', '34.00', '1.00', '0.00', '34.00', 'SAR', 336, 0, ''),
(317, 'TRANSPORTATION CHARGES ', '52.00', '1.00', '0.00', '52.00', 'SAR', 337, 0, ''),
(318, 'TRANSPORTATION CHARGES ', '53.00', '1.00', '0.00', '53.00', 'SAR', 338, 0, ''),
(319, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 339, 0, ''),
(320, 'TRANSPORTATION CHARGES ', '2.00', '1.00', '0.00', '2.00', 'SAR', 339, 0, ''),
(321, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 340, 0, ''),
(322, 'TRANSPORTATION CHARGES ', '2.00', '1.00', '0.00', '2.00', 'SAR', 340, 0, ''),
(323, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 341, 0, ''),
(324, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 342, 0, ''),
(325, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 343, 0, ''),
(326, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 343, 0, ''),
(327, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 344, 0, ''),
(328, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 344, 0, ''),
(329, 'TRANSPORTATION CHARGES ', '1.00', '1.00', '0.00', '1.00', 'SAR', NULL, 0, ''),
(330, 'TRANSPORTATION CHARGES ', '112.00', '1.00', '0.00', '112.00', 'SAR', NULL, 0, ''),
(331, 'TRANSPORTATION CHARGES ', '23.00', '1.00', '0.00', '23.00', 'SAR', NULL, 0, ''),
(332, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.12', '12.12', 'SAR', NULL, 0, ''),
(333, 'TRANSPORTATION CHARGES ', '30.00', '1.00', '0.00', '30.00', 'SAR', NULL, 0, ''),
(334, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', NULL, 0, ''),
(335, 'TRANSPORTATION CHARGES ', '52.00', '1.00', '0.00', '52.00', 'SAR', NULL, 0, ''),
(336, 'TRANSPORTATION CHARGES ', '63.00', '1.00', '0.00', '63.00', 'SAR', NULL, 0, ''),
(337, 'TRANSPORTATION CHARGES ', '1.00', '1.00', '0.00', '1.00', 'SAR', NULL, 0, ''),
(338, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', NULL, 0, ''),
(339, 'TRANSPORTATION CHARGES ', '1.00', '1.00', '0.00', '1.00', 'SAR', NULL, 0, ''),
(340, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', NULL, 0, ''),
(341, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 355, 0, ''),
(342, 'TRANSPORTATION CHARGES ', '1.00', '1.00', '0.00', '1.00', 'SAR', 356, 0, ''),
(343, 'TRANSPORTATION CHARGES ', '1.00', '1.00', '0.00', '1.00', 'SAR', 357, 0, ''),
(344, 'TRANSPORTATION CHARGES ', '2.00', '1.00', '0.00', '2.00', 'SAR', 358, 0, ''),
(345, 'TRANSPORTATION CHARGES ', '1.00', '1.00', '0.00', '1.00', 'SAR', 359, 0, ''),
(346, 'TRANSPORTATION CHARGES ', '60.00', '1.00', '0.00', '60.00', 'SAR', 360, 0, ''),
(347, 'TRANSPORTATION CHARGES ', '50.00', '1.00', '0.00', '50.00', 'SAR', 361, 0, ''),
(348, 'TRANSPORTATION CHARGES ', '1.00', '1.00', '0.00', '1.00', 'SAR', 362, 0, ''),
(349, 'TRANSPORTATION CHARGES ', '30.00', '1.00', '0.00', '30.00', 'SAR', 363, 0, ''),
(350, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.12', '12.12', 'SAR', 364, 0, ''),
(351, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 365, 0, ''),
(352, 'TRANSPORTATION CHARGES ', '1.00', '1.00', '0.00', '1.00', 'SAR', 366, 0, ''),
(353, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 367, 0, ''),
(354, 'TRANSPORTATION CHARGES ', '34.00', '1.00', '0.00', '34.00', 'SAR', 367, 0, ''),
(355, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 368, 0, ''),
(356, 'TRANSPORTATION CHARGES ', '34.00', '1.00', '0.00', '34.00', 'SAR', 368, 0, ''),
(357, 'SEA FREIGHT CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 369, 0, ''),
(358, 'AIR FREIGHT CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 369, 0, ''),
(359, 'SEA FREIGHT CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 370, 0, ''),
(360, 'AIR FREIGHT CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 370, 0, ''),
(361, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', NULL, 0, ''),
(362, 'SEA FREIGHT CHARGES ', '52.00', '1.00', '0.00', '52.00', 'SAR', NULL, 0, ''),
(363, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', NULL, 0, ''),
(364, 'SEA FREIGHT CHARGES ', '52.00', '1.00', '0.00', '52.00', 'SAR', NULL, 0, ''),
(365, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', NULL, 0, ''),
(366, 'OTHER CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', NULL, 0, ''),
(367, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', NULL, 0, ''),
(368, 'OTHER CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', NULL, 0, ''),
(369, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 254, 0, ''),
(370, 'AIR FREIGHT CHARGES ', '30.00', '1.00', '0.00', '30.00', 'SAR', 254, 0, ''),
(371, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 254, 0, ''),
(372, 'AIR FREIGHT CHARGES ', '30.00', '1.00', '0.00', '30.00', 'SAR', 254, 0, ''),
(373, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', NULL, 0, ''),
(374, 'SEA FREIGHT CHARGES ', '63.00', '1.00', '0.00', '63.00', 'SAR', NULL, 0, ''),
(375, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 257, 0, ''),
(376, 'SEA FREIGHT CHARGES ', '63.00', '1.00', '0.00', '63.00', 'SAR', 257, 0, ''),
(377, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', NULL, 0, ''),
(378, 'SEA FREIGHT CHARGES ', '36.00', '1.00', '0.00', '36.00', 'SAR', NULL, 0, ''),
(379, 'TRANSPORTATION CHARGES ', '36.00', '1.00', '0.00', '36.00', 'SAR', 382, 0, ''),
(380, 'CUSTOMS DUTY (AS ATTACHED) ', '63.00', '1.00', '0.00', '63.00', 'SAR', 382, 0, ''),
(381, 'TRANSPORTATION CHARGES ', '62.00', '1.00', '0.00', '62.00', 'SAR', 383, 0, ''),
(382, 'CUSTOMS CLEARANCE CHARGES ', '30.00', '1.00', '0.00', '30.00', 'SAR', 383, 0, ''),
(383, 'SEA FREIGHT CHARGES ', '63.00', '1.00', '0.00', '63.00', 'SAR', 384, 0, ''),
(384, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '2.40', '14.40', 'SAR', 385, 0, ''),
(385, 'SEA FREIGHT CHARGES ', '1.00', '1.00', '0.00', '1.00', 'SAR', 386, 0, ''),
(386, 'SEA FREIGHT CHARGES ', '12.00', '1.00', '0.00', '12.00', 'SAR', 386, 0, ''),
(387, 'TRANSPORTATION CHARGES ', '23.00', '1.00', '2.76', '25.76', 'SAR', 387, 0, ''),
(388, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '2.40', '14.40', 'SAR', 388, 0, ''),
(389, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '2.88', '14.88', 'SAR', 389, 0, ''),
(390, 'TRANSPORTATION CHARGES ', '20.00', '1.00', '6.00', '26.00', 'SAR', 389, 0, ''),
(391, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '2.40', '14.40', 'SAR', 390, 0, ''),
(392, 'TRANSPORTATION CHARGES ', '20.00', '1.00', '6.00', '26.00', 'SAR', 390, 0, ''),
(393, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '2.40', '14.40', 'SAR', 391, 0, ''),
(394, 'CUSTOMS CLEARANCE CHARGES ', '20.00', '1.00', '6.00', '26.00', 'SAR', 391, 0, ''),
(395, 'SEA FREIGHT CHARGES ', '30.00', '1.00', '10.80', '40.80', 'SAR', 392, 0, ''),
(396, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '2.40', '14.40', 'SAR', 393, 0, ''),
(397, 'CUSTOMS DUTY (AS ATTACHED) ', '20.00', '1.00', '6.00', '26.00', 'SAR', 393, 0, ''),
(398, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '2.40', '14.40', 'SAR', 394, 0, ''),
(399, 'TRANSPORTATION CHARGES ', '20.00', '1.00', '6.00', '26.00', 'SAR', 394, 0, ''),
(400, 'SEA FREIGHT CHARGES ', '53.00', '1.00', '15.90', '68.90', 'SAR', 395, 0, ''),
(401, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.12', '12.12', 'SAR', 396, 0, ''),
(402, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '0.12', '12.12', 'SAR', 397, 0, ''),
(403, 'TRANSPORTATION CHARGES ', '20.00', '1.00', '4.00', '24.00', 'SAR', 398, 0, ''),
(404, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '2.40', '14.40', 'SAR', 399, 0, ''),
(405, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '2.40', '14.40', 'SAR', 400, 0, ''),
(406, 'SEA FREIGHT CHARGES ', '45.00', '1.00', '5.40', '50.40', 'SAR', 401, 0, ''),
(407, 'TRANSPORTATION CHARGES ', '35.00', '1.00', '8.75', '43.75', 'SAR', 402, 0, ''),
(408, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '13.20', '25.20', 'SAR', 403, 0, ''),
(409, 'TRANSPORTATION CHARGES ', '10.00', '1.00', '1.00', '11.00', 'SAR', 404, 0, ''),
(410, 'TRANSPORTATION CHARGES ', '10.00', '1.00', '1.00', '11.00', 'SAR', 405, 0, ''),
(411, 'TRANSPORTATION CHARGES ', '12.00', '1.00', '1.44', '13.44', 'SAR', 406, 0, ''),
(412, 'TRANSPORTATION CHARGES ', '500.00', '1.00', '250.00', '750.00', 'SAR', 407, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `jm_expensemaster`
--

DROP TABLE IF EXISTS `jm_expensemaster`;
CREATE TABLE IF NOT EXISTS `jm_expensemaster` (
  `ExpenseMasterId` int(11) NOT NULL AUTO_INCREMENT,
  `PostId` int(11) DEFAULT NULL,
  `PostingDate` date NOT NULL,
  `InvDate` date DEFAULT NULL,
  `Reference` varchar(100) DEFAULT NULL,
  `OurInv` varchar(50) DEFAULT NULL,
  `Mode` varchar(50) DEFAULT NULL,
  `SubTotal` decimal(18,2) DEFAULT NULL,
  `VatTotal` decimal(18,2) DEFAULT NULL,
  `GrandTotal` decimal(18,2) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `JobID` int(11) DEFAULT NULL,
  `SupplierID` int(11) DEFAULT NULL,
  `SupplierInvoiceNo` longtext DEFAULT NULL,
  `Userid` varchar(220) NOT NULL,
  PRIMARY KEY (`ExpenseMasterId`)
) ENGINE=MyISAM AUTO_INCREMENT=408 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jm_expensemaster`
--

INSERT INTO `jm_expensemaster` (`ExpenseMasterId`, `PostId`, `PostingDate`, `InvDate`, `Reference`, `OurInv`, `Mode`, `SubTotal`, `VatTotal`, `GrandTotal`, `Status`, `JobID`, `SupplierID`, `SupplierInvoiceNo`, `Userid`) VALUES
(1, 1, '2020-10-04', '2020-10-04', 'N1', '', 'credit', '800.00', '0.00', '800.00', 'Posted', 1, 16, '1', ''),
(2, 2, '2020-10-05', '2020-09-16', '64319', '', 'credit', '40328.25', '5850.00', '46178.25', 'Posted', 2, 11, '1', ''),
(3, 3, '2020-10-05', '2020-10-05', 'Al Jawra DE 621', '', 'credit', '5000.00', '0.00', '5000.00', 'Posted', 2, 16, '1', ''),
(4, 4, '2020-10-05', '2020-10-05', 'jithin 502', '', 'credit', '1000.00', '0.00', '1000.00', 'Posted', 2, 55, '1', ''),
(5, 5, '2020-10-05', '2020-10-05', 'GAS 503', '', 'credit', '473.00', '0.00', '473.00', 'Posted', 3, 16, '1', ''),
(6, 6, '2020-10-06', '2020-09-11', '2056', '', 'credit', '2879.91', '0.00', '2879.91', 'Posted', 4, 61, '1', ''),
(7, 7, '2020-10-10', '2020-10-01', '62057724', '', 'credit', '402.50', '0.00', '402.50', 'Posted', 7, 62, '1', ''),
(8, 8, '2020-10-12', '2020-10-06', 'MUM-083/20-21', '', 'credit', '16874.88', '0.00', '16874.88', 'Paid', 8, 27, '1', ''),
(9, 9, '2020-10-12', '2020-10-12', '509', '', 'credit', '800.00', '0.00', '800.00', 'Posted', 9, 16, '1', ''),
(10, 10, '2020-10-12', '2020-10-12', '510', '', 'credit', '800.00', '0.00', '800.00', 'Posted', 10, 16, '1', ''),
(11, 11, '2020-10-12', '2020-10-12', '511', '', 'credit', '800.00', '0.00', '800.00', 'Posted', 11, 16, '1', ''),
(12, 12, '2020-10-12', '2020-10-12', '512', '', 'credit', '2600.00', '0.00', '2600.00', 'Posted', 12, 16, '1', ''),
(13, 13, '2020-10-12', '2020-10-12', 'SESP20090006', '', 'credit', '2199.60', '0.00', '2199.60', 'Posted', 13, 63, '1', ''),
(14, 14, '2020-10-12', '2020-10-12', '514', '', 'credit', '200.00', '0.00', '200.00', 'Posted', 13, 56, '1', ''),
(15, 15, '2020-10-12', '2020-10-12', '20200530', '', 'credit', '1068.75', '0.00', '1068.75', 'Posted', 14, 52, '1', ''),
(16, 16, '2020-10-14', '2020-10-14', '515', '', 'credit', '800.00', '0.00', '800.00', 'Posted', 15, 16, '1', ''),
(17, 17, '2020-10-15', '2020-10-15', '516', '', 'credit', '800.00', '0.00', '800.00', 'Posted', 16, 16, '1', ''),
(18, 18, '2020-10-15', '2020-10-15', '517', '', 'credit', '800.00', '0.00', '800.00', 'Posted', 17, 16, '1', ''),
(19, 19, '2020-10-15', '2020-10-12', 'MUM-085/20-21', '', 'credit', '4342.80', '0.00', '4342.80', 'Posted', 18, 27, '1', ''),
(20, 20, '2020-10-18', '2020-10-10', '62611827', '', 'credit', '402.50', '0.00', '402.50', 'Posted', 19, 62, '1', ''),
(21, 21, '2020-10-18', '2020-10-10', '33995290207', '', 'credit', '1596.32', '0.00', '1596.32', 'Posted', 20, 13, '1', ''),
(22, 22, '2020-10-18', '2020-10-18', '521', '', 'credit', '750.00', '0.00', '750.00', 'Posted', 21, 16, '1', ''),
(23, 23, '2020-10-18', '2020-10-15', 'AESP20100003', '', 'credit', '8530.91', '0.00', '8530.91', 'Paid', 22, 63, '1', ''),
(24, 24, '2020-10-18', '2020-10-18', '523', '', 'credit', '100.00', '0.00', '100.00', 'Posted', 23, 65, '1', ''),
(25, 25, '2020-10-18', '2020-10-08', '33603', '', 'credit', '1728.00', '172.50', '1900.50', 'Posted', 7, 22, '1', ''),
(26, 26, '2020-10-18', '2020-09-29', '21118/2020', '', 'credit', '1709.36', '0.00', '1709.36', 'Posted', 7, 7, '1', ''),
(27, 27, '2020-10-19', '2020-09-30', 'AFE/INV/003825/2020', '', 'credit', '8263.35', '0.00', '8263.35', 'Paid', 28, 46, '1', ''),
(28, 28, '2020-10-19', '2020-09-28', 'FL/KSA/MISC/0579', '', 'credit', '2500.00', '375.00', '2875.00', 'Posted', 28, 51, '1', ''),
(29, 29, '2020-10-19', '2020-10-06', '64464', '', 'credit', '2554.56', '82.50', '2637.06', 'Posted', 28, 11, '1', ''),
(30, 30, '2020-10-19', '2020-09-30', 'AFE/INV/003832/2020', '', 'credit', '2151.04', '0.00', '2151.04', 'Paid', 27, 46, '1', ''),
(31, 31, '2020-10-19', '2020-09-28', '64400', '', 'credit', '635.23', '52.50', '687.73', 'Posted', 27, 11, '1', ''),
(40, 39, '2020-10-20', '2020-10-20', '527', '', 'credit', '2000.00', '0.00', '2000.00', 'Posted', 29, 16, '1', ''),
(33, 32, '2020-10-19', '2020-09-16', 'FL/KSA/MISC/0554', '', 'credit', '2500.00', '375.00', '2875.00', 'Posted', 27, 51, '1', ''),
(34, 33, '2020-10-19', '2020-10-08', '16513', '', 'credit', '4193.05', '0.00', '4193.05', 'Posted', 20, 34, '1', ''),
(35, 34, '2020-10-19', '2020-10-13', '64562', '', 'credit', '883.80', '82.50', '966.30', 'Posted', 20, 11, '1', ''),
(36, 35, '2020-10-19', '2020-10-19', '10274349', '', 'credit', '1915.76', '0.00', '1915.76', 'Paid', 23, 66, '1', ''),
(37, 36, '2020-10-20', '2020-10-19', '34097010200', '', 'credit', '4427.07', '0.00', '4427.07', 'Drafted', 19, 13, '1', ''),
(38, 37, '2020-10-20', '2020-08-27', 'MUM-056/20-21', '', 'credit', '750.00', '0.00', '750.00', 'Posted', 26, 27, '1', ''),
(39, 38, '2020-10-20', '2020-10-29', 'DAM FI 10348', '', 'credit', '2158.00', '90.00', '2248.00', 'Posted', 26, 47, '1', ''),
(41, 40, '2020-10-20', '2020-10-09', '206034', '', 'credit', '23487.28', '0.00', '23487.28', 'Drafted', 30, 33, '1', ''),
(42, 41, '2020-10-21', '2020-10-20', 'MUM-091/20-21', '', 'credit', '2177.32', '0.00', '2177.32', 'Drafted', 33, 27, '1', ''),
(43, 42, '2020-10-22', '2020-10-22', '530', '', 'credit', '650.00', '0.00', '650.00', 'Posted', 34, 16, '1', ''),
(44, 43, '2020-10-22', '2020-10-20', '206094', '', 'credit', '2736.00', '0.00', '2736.00', 'Posted', 35, 33, '1', ''),
(45, 44, '2020-10-25', '2020-10-25', '532', '', 'credit', '750.00', '0.00', '750.00', 'Posted', 37, 16, '1', ''),
(46, 45, '2020-10-25', '2020-10-25', 'Barrak 502', '', 'credit', '1308.00', '0.00', '1308.00', 'Posted', 2, 14, '1', ''),
(47, 46, '2020-10-26', '2020-10-26', '533', '', 'credit', '750.00', '0.00', '750.00', 'Drafted', 38, 16, '1', ''),
(48, 47, '2020-10-26', '2020-10-26', '534', '', 'credit', '2300.00', '0.00', '2300.00', 'Posted', 39, 16, '1', ''),
(49, 48, '2020-10-26', '2020-10-26', 'JOB 534 ', '', 'credit', '200.00', '0.00', '200.00', 'Posted', 39, 48, '1', ''),
(50, 49, '2020-10-26', '2020-10-22', '121-201020311557', '', 'credit', '9623.27', '0.00', '9623.27', 'Paid', 40, 20, '1', ''),
(51, 50, '2020-10-26', '2020-10-26', 'JOB : 535 // 077-56191004', '', 'credit', '200.00', '0.00', '200.00', 'Posted', 40, 48, '1', ''),
(52, 51, '2020-10-26', '2020-10-26', '537', '', 'credit', '100.00', '0.00', '100.00', 'Drafted', 43, 65, '1', ''),
(53, 52, '2020-10-27', '2020-10-27', '63624707', '', 'credit', '402.50', '0.00', '402.50', 'Paid', 43, 62, '1', ''),
(54, 53, '2020-10-28', '2020-10-14', '121-201020311039', '', 'credit', '15812.97', '0.00', '15812.97', 'Paid', 44, 20, '1', ''),
(55, 54, '2020-10-28', '2020-10-28', '538 : 077-56188381', '', 'credit', '200.00', '0.00', '200.00', 'Posted', 44, 48, '1', ''),
(56, 55, '2020-10-28', '2020-10-22', '64651', '', 'credit', '921.71', '82.50', '1004.21', 'Posted', 19, 11, '1', ''),
(57, 56, '2020-10-28', '2020-10-08', '121-201020310632', '', 'credit', '2949.71', '0.00', '2949.71', 'Paid', 19, 20, '1', ''),
(58, 57, '2020-10-28', '2020-09-14', 'BHL43371', '', 'credit', '693.75', '0.00', '693.75', 'Paid', 5, 21, '1', ''),
(59, 58, '2020-10-29', '2020-10-16', 'MUM-088/20-21', '', 'credit', '744.48', '0.00', '744.48', 'Drafted', 6, 27, '1', ''),
(60, 59, '2020-10-29', '2020-10-29', '539', '', 'credit', '1000.00', '0.00', '1000.00', 'Posted', 45, 16, '1', ''),
(61, 60, '2020-10-31', '2020-10-02', 'S00600917', '', 'credit', '11737.93', '0.00', '11737.93', 'Drafted', 46, 67, '1', ''),
(62, 61, '2020-11-01', '2020-11-01', '541', '', 'credit', '2000.00', '0.00', '2000.00', 'Posted', 47, 16, '1', ''),
(63, 62, '2020-11-01', '2020-11-01', '542', '', 'credit', '750.00', '0.00', '750.00', 'Drafted', 48, 16, '1', ''),
(64, 63, '2020-11-05', '2020-10-04', '10407', '', 'credit', '2710.37', '135.00', '2845.37', 'Posted', 49, 47, '1', ''),
(65, 64, '2020-11-05', '2020-09-16', '0555', '', 'credit', '225.00', '33.75', '258.75', 'Drafted', 49, 51, '1', ''),
(66, 65, '2020-11-05', '2020-11-01', '2223', '', 'credit', '3850.10', '135.00', '3985.10', 'Paid', 54, 68, '1', ''),
(67, 66, '2020-11-05', '2020-11-01', '548', '', 'credit', '6852.50', '0.00', '6852.50', 'Posted', 54, 16, '1', ''),
(68, 67, '2020-11-05', '2020-11-03', '2224', '', 'credit', '2382.51', '135.00', '2517.51', 'Paid', 55, 68, '1', ''),
(69, 68, '2020-11-05', '2020-11-05', '549', '', 'credit', '5402.50', '0.00', '5402.50', 'Drafted', 55, 16, '1', ''),
(70, 69, '2020-11-08', '2020-10-06', 'MUM-082/20-21', '', 'credit', '3468.75', '0.00', '3468.75', 'Paid', 56, 27, '1', ''),
(71, 70, '2020-11-08', '2020-11-08', '551', '', 'credit', '750.00', '0.00', '750.00', 'Paid', 57, 16, '1', ''),
(72, 71, '2020-11-08', '2020-09-22', '003620', '', 'credit', '5917.50', '0.00', '5917.50', 'Paid', 58, 46, '1', ''),
(73, 72, '2020-11-08', '2020-10-18', '64613', '', 'credit', '3385.80', '150.00', '3535.80', 'Drafted', 58, 11, '1', ''),
(74, 73, '2020-11-08', '2020-09-28', '0575', '', 'credit', '5000.00', '750.00', '5750.00', 'Drafted', 58, 51, '1', ''),
(75, 74, '2020-11-09', '2020-11-08', '64893', '', 'credit', '2835.75', '135.00', '2970.75', 'Drafted', 61, 11, '1', ''),
(76, 75, '2020-11-09', '2020-10-28', '0304185', '', 'credit', '1810.88', '0.00', '1810.88', 'Drafted', 62, 15, '1', ''),
(77, 76, '2020-11-09', '2020-10-19', 'IV2010/0264', '', 'credit', '18989.14', '0.00', '18989.14', 'Paid', 54, 30, '1', ''),
(78, 77, '2020-11-10', '2020-09-18', '1177', '', 'credit', '2520.00', '0.00', '2520.00', 'Paid', 68, 3, '1', ''),
(79, 78, '2020-11-11', '2020-10-24', 'IV2010/0425', '', 'credit', '2129.25', '0.00', '2129.25', 'Paid', 55, 30, '1', ''),
(80, 79, '2020-11-11', '2020-10-27', '64719', '', 'credit', '1201.65', '82.50', '1284.15', 'Drafted', 69, 11, '1', ''),
(81, 80, '2020-11-11', '2020-10-21', '34151450202', '', 'credit', '2744.32', '0.00', '2744.32', 'Drafted', 69, 13, '1', ''),
(82, 81, '2020-11-11', '2020-08-10', '42993', '', 'credit', '859.69', '0.00', '859.69', 'Paid', 70, 21, '1', ''),
(83, 82, '2020-11-11', '2020-08-31', '0508', '', 'credit', '3000.00', '450.00', '3450.00', 'Drafted', 70, 51, '1', ''),
(84, 83, '2020-11-11', '0000-00-00', '64810', '', 'credit', '2507.00', '97.50', '2604.50', 'Drafted', 70, 11, '1', ''),
(85, 84, '2020-11-11', '2020-11-11', '34430600209', '', 'credit', '24219.34', '0.00', '24219.34', 'Paid', 71, 13, '1', ''),
(88, 86, '2020-11-12', '2020-11-02', '201160515', '', 'credit', '15077.70', '0.00', '15077.70', 'Drafted', 72, 41, '1', ''),
(87, 85, '2020-11-11', '2020-11-11', '10289374', '', 'credit', '932.75', '0.00', '932.75', 'Paid', 71, 66, '1', ''),
(89, 87, '2020-11-12', '2020-11-10', '64325', '', 'credit', '2029.20', '82.50', '2111.70', 'Drafted', 72, 11, '1', ''),
(90, 88, '2020-11-12', '2020-11-12', 'adhil aot', '', 'credit', '220.00', '0.00', '220.00', 'Drafted', 72, 16, '1', ''),
(91, 89, '2020-11-12', '2020-09-28', 'MUM-077/20-21', '', 'credit', '468.75', '0.00', '468.75', 'Paid', 63, 27, '1', ''),
(92, 90, '2020-11-12', '2020-10-22', '1607', '', 'credit', '6349.68', '0.00', '6349.68', 'Drafted', 64, 35, '1', ''),
(93, 91, '2020-11-12', '2020-10-28', '23796/2020', '', 'credit', '1251.67', '0.00', '1251.67', 'Drafted', 65, 7, '1', ''),
(94, 92, '2020-11-12', '2020-11-03', 'MAAAE100748/2021', '', 'credit', '3209.78', '0.00', '3209.78', 'Drafted', 66, 46, '1', ''),
(95, 93, '2020-11-12', '2020-10-28', '121-201020311936', '', 'credit', '1575.00', '0.00', '1575.00', 'Paid', 67, 20, '1', ''),
(96, 94, '2020-11-12', '2020-08-20', '2000006277', '', 'credit', '2320.84', '0.00', '2320.84', 'Drafted', 73, 64, '1', ''),
(97, 95, '2020-11-12', '2020-10-31', '64811', '', 'credit', '7907.85', '127.50', '8035.35', 'Drafted', 73, 11, '1', ''),
(98, 96, '2020-11-12', '2020-10-31', '64809', '', 'credit', '4101.30', '142.50', '4243.80', 'Drafted', 76, 11, '1', ''),
(99, 97, '2020-11-15', '2020-10-15', '64597', '', 'credit', '7289.10', '127.50', '7416.60', 'Drafted', 50, 11, '1', ''),
(100, 98, '2020-11-15', '2020-09-28', '0578', '', 'credit', '225.00', '33.75', '258.75', 'Drafted', 50, 51, '1', ''),
(101, 99, '2020-11-15', '2020-10-19', 'DAM FI 10531', '', 'credit', '2206.00', '90.00', '2296.00', 'Drafted', 51, 47, '1', ''),
(102, 100, '2020-11-15', '2020-09-28', '577', '', 'credit', '225.00', '33.75', '258.75', 'Drafted', 51, 51, '1', ''),
(103, 101, '2020-11-15', '2020-11-04', 'DAM FI10408', '', 'credit', '3998.64', '135.00', '4133.64', 'Drafted', 52, 47, '1', ''),
(104, 102, '2020-11-15', '2020-09-16', '553', '', 'credit', '225.00', '33.75', '258.75', 'Drafted', 52, 51, '1', ''),
(105, 103, '2020-11-15', '2020-10-27', '64723', '', 'credit', '1337.36', '82.50', '1419.86', 'Drafted', 53, 11, '1', ''),
(106, 104, '2020-11-15', '2020-11-15', 'S 2', '', 'credit', '100.00', '0.00', '100.00', 'Drafted', 53, 65, '1', ''),
(107, 105, '2020-11-15', '2020-11-05', 'DAM FI 10743', '', 'credit', '2729.20', '135.00', '2864.20', 'Drafted', 78, 47, '1', ''),
(108, 106, '2020-11-15', '2020-11-15', 's4', '', 'credit', '100.00', '0.00', '100.00', 'Drafted', 78, 65, '1', ''),
(109, 107, '2020-11-15', '2020-11-05', 'DAM FI10742', '', 'credit', '1825.50', '90.00', '1915.50', 'Drafted', 79, 47, '1', ''),
(110, 108, '2020-11-16', '2020-09-28', '576', '', 'credit', '225.00', '33.75', '258.75', 'Drafted', 79, 51, '1', ''),
(111, 109, '2020-11-16', '2020-10-12', 'AESP20100002', '', 'credit', '32559.60', '0.00', '32559.60', 'Paid', 23, 63, '1', ''),
(112, 110, '2020-11-16', '2020-11-12', '64974', '', 'credit', '550.00', '82.50', '632.50', 'Drafted', 71, 11, '1', ''),
(113, 111, '2020-11-16', '2020-10-23', '206182', '', 'credit', '12840.07', '0.00', '12840.07', 'Drafted', 71, 33, '1', ''),
(114, 112, '2020-11-16', '2020-11-04', '121-201120310224', '', 'credit', '6517.50', '0.00', '6517.50', 'Paid', 77, 20, '1', ''),
(115, 113, '2020-11-16', '2020-11-12', '206645', '', 'credit', '14095.84', '0.00', '14095.84', 'Drafted', 80, 33, '1', ''),
(116, 114, '2020-11-16', '2020-11-16', '571', '', 'credit', '998.44', '0.00', '998.44', 'Drafted', 80, 48, '1', ''),
(117, 115, '2020-11-16', '2020-11-16', '572', '', 'credit', '750.00', '0.00', '750.00', 'Paid', 81, 16, '1', ''),
(118, 116, '2020-11-16', '2020-11-03', '201145271', '', 'credit', '6449.85', '0.00', '6449.85', 'Drafted', 82, 69, '1', ''),
(119, 117, '2020-11-16', '2020-11-16', '074-39431280', '', 'credit', '200.00', '0.00', '200.00', 'Drafted', 82, 48, '1', ''),
(120, 118, '2020-11-17', '2020-11-12', '64544315', '', 'credit', '402.50', '0.00', '402.50', 'Drafted', 84, 62, '1', ''),
(121, 119, '2020-11-17', '2020-11-12', '25158', '', 'credit', '1613.70', '0.00', '1613.70', 'Drafted', 85, 7, '1', ''),
(122, 120, '2020-11-17', '2020-11-04', '64838', '', 'credit', '880.76', '82.50', '963.26', 'Drafted', 85, 11, '1', ''),
(123, 121, '2020-11-18', '2020-11-18', '576 // 065-35517145', '', 'credit', '200.00', '0.00', '200.00', 'Drafted', 85, 56, '1', ''),
(124, 122, '2020-11-18', '2020-10-26', '23460/2020', '', 'credit', '1837.13', '0.00', '1837.13', 'Drafted', 86, 7, '1', ''),
(125, 123, '2020-11-18', '2020-11-11', '64955', '', 'credit', '1072.70', '82.50', '1155.20', 'Drafted', 86, 11, '1', ''),
(126, 124, '2020-11-18', '2020-11-18', '577', '', 'credit', '200.00', '0.00', '200.00', 'Drafted', 86, 56, '1', ''),
(127, 125, '2020-11-18', '2020-11-10', '64927', '', 'credit', '843.70', '82.50', '926.20', 'Drafted', 87, 11, '1', ''),
(128, 125, '2020-11-18', '2020-11-10', '64927', '', 'credit', '0.00', '0.00', '0.00', 'Drafted', 87, 11, '1', ''),
(129, 126, '2020-11-18', '2020-11-18', '578', '', 'credit', '200.00', '0.00', '200.00', 'Drafted', 87, 56, '1', ''),
(130, 127, '2020-11-18', '2020-11-08', '64894', '', 'credit', '2888.63', '135.00', '3023.63', 'Drafted', 88, 11, '1', ''),
(131, 128, '2020-11-18', '2020-11-05', 'BL43802', '', 'credit', '1333.01', '0.00', '1333.01', 'Drafted', 87, 21, '1', ''),
(132, 129, '2020-11-21', '2020-11-18', '33733', '', 'credit', '1177.00', '105.00', '1282.00', 'Drafted', 89, 22, '1', ''),
(133, 130, '2020-11-22', '2020-11-16', 'DAM FI 10919', '', 'credit', '550.00', '82.50', '632.50', 'Drafted', 23, 47, '1', ''),
(134, 131, '2020-11-22', '2020-11-05', '10741', '', 'credit', '2439.50', '90.00', '2529.50', 'Drafted', 68, 47, '1', ''),
(135, 132, '2020-11-22', '2020-11-22', '581', '', 'credit', '6600.00', '0.00', '6600.00', 'Paid', 90, 16, '1', ''),
(136, 133, '2020-11-22', '2020-11-22', '582', '', 'credit', '750.00', '0.00', '750.00', 'Paid', 91, 16, '1', ''),
(137, 134, '2020-11-23', '2020-11-22', '203-20', '', 'credit', '5487.00', '0.00', '5487.00', 'Paid', 93, 70, '1', ''),
(138, 135, '2020-11-24', '2020-11-24', '583', '', 'credit', '750.00', '0.00', '750.00', 'Paid', 92, 16, '1', ''),
(139, 136, '2020-11-24', '2020-11-17', '65017', '', 'credit', '1371.30', '105.00', '1476.30', 'Drafted', 84, 11, '1', ''),
(140, 137, '2020-11-25', '2020-11-05', '10744', '', 'credit', '3182.47', '262.50', '3444.97', 'Drafted', 56, 47, '1', ''),
(141, 138, '2020-11-25', '2020-11-24', '20/1912', '', 'credit', '587.50', '52.50', '640.00', 'Drafted', 95, 71, '1', ''),
(142, 139, '2020-11-25', '2020-11-24', '11044', '', 'credit', '2425.70', '135.00', '2560.70', 'Drafted', 94, 47, '1', ''),
(143, 140, '2020-11-25', '2020-10-23', '092/20-21', '', 'credit', '3468.75', '0.00', '3468.75', 'Drafted', 94, 27, '1', ''),
(144, 141, '2020-11-26', '2020-11-24', '11043', '', 'credit', '3219.00', '135.00', '3354.00', 'Drafted', 96, 47, '1', ''),
(145, 142, '2020-11-26', '2020-11-26', '587', '', 'credit', '300.00', '0.00', '300.00', 'Drafted', 96, 65, '1', ''),
(146, 143, '2020-11-26', '2020-11-26', '588', '', 'credit', '100.00', '0.00', '100.00', 'Paid', 97, 65, '1', ''),
(147, 144, '2020-11-26', '2020-11-24', '11045', '', 'credit', '2767.52', '135.00', '2902.52', 'Drafted', 97, 47, '1', ''),
(148, 145, '2020-11-29', '2020-11-28', '1934', '', 'credit', '357.50', '52.50', '410.00', 'Drafted', 98, 71, '1', ''),
(149, 146, '2020-12-01', '2020-12-01', '2020925', '', 'credit', '8500.00', '1275.00', '9775.00', 'Drafted', 71, 51, '1', ''),
(150, 147, '2020-12-02', '2020-11-08', '104', '', 'credit', '5600.63', '0.00', '5600.63', 'Drafted', 84, 27, '1', ''),
(151, 148, '2022-03-03', '0000-00-00', '123', '', 'credit', '2.00', '0.02', '2.02', 'Drafted', 130, 1, '1', ''),
(152, 148, '2022-03-03', '0000-00-00', '123', '', 'credit', '2.00', '0.02', '2.02', 'Drafted', 130, 1, '1', ''),
(153, 148, '2022-03-03', '0000-00-00', '123', '', 'credit', '2.00', '0.02', '2.02', 'Drafted', 130, 1, '1', ''),
(154, 148, '2022-03-03', '0000-00-00', '123', '', 'credit', '2.00', '0.02', '2.02', 'Drafted', 130, 1, '1', ''),
(155, 148, '2022-03-03', '0000-00-00', '123', '', 'credit', '2.00', '0.02', '2.02', 'Drafted', 130, 1, '1', ''),
(156, 148, '2022-03-03', '0000-00-00', '123', '', 'credit', '2.00', '0.02', '2.02', 'Drafted', 130, 1, '1', ''),
(157, 148, '2022-03-03', '0000-00-00', '123', '', 'credit', '2.00', '0.02', '2.02', 'Drafted', 130, 1, '1', ''),
(158, 148, '2022-03-03', '0000-00-00', '123', '', 'credit', '2.00', '0.02', '2.02', 'Drafted', 130, 1, '1', ''),
(159, 148, '2022-03-03', '0000-00-00', '123', '', 'credit', '2.00', '0.02', '2.02', 'Drafted', 130, 1, '1', ''),
(160, 148, '2022-03-03', '0000-00-00', '123', '', 'credit', '2.00', '0.02', '2.02', 'Drafted', 130, 1, '1', ''),
(161, 148, '2022-03-03', '0000-00-00', '123', '', 'credit', '2.00', '0.02', '2.02', 'Drafted', 130, 1, '1', ''),
(162, 148, '2022-03-03', '0000-00-00', '123', '', 'credit', '2.00', '0.02', '2.02', 'Drafted', 130, 1, '1', ''),
(163, 148, '2022-03-03', '0000-00-00', '123', '', 'credit', '2.00', '0.02', '2.02', 'Drafted', 130, 1, '1', ''),
(164, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '2.00', '0.04', '2.04', 'Drafted', 130, 1, '1', ''),
(165, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '2.00', '0.04', '2.04', 'Drafted', 130, 1, '1', ''),
(166, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '2.00', '0.04', '2.04', 'Drafted', 130, 1, '1', ''),
(167, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '2.00', '0.04', '2.04', 'Drafted', 130, 1, '1', ''),
(168, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '2.00', '0.04', '2.04', 'Drafted', 130, 1, '1', ''),
(169, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '2.00', '0.04', '2.04', 'Drafted', 130, 1, '1', ''),
(170, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '2.00', '0.04', '2.04', 'Drafted', 130, 1, '1', ''),
(171, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '2.00', '0.04', '2.04', 'Drafted', 130, 1, '1', ''),
(172, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '2.00', '0.04', '2.04', 'Drafted', 130, 1, '1', ''),
(173, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '2.00', '0.04', '2.04', 'Drafted', 130, 1, '1', ''),
(174, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '2.00', '0.04', '2.04', 'Drafted', 130, 1, '1', ''),
(175, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '2.00', '0.04', '2.04', 'Drafted', 130, 1, '1', ''),
(176, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(177, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(178, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(179, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(180, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(181, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(182, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(183, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(184, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(185, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(186, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(187, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(188, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(189, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(190, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(191, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(192, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(193, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(194, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(195, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(196, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(197, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(198, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(199, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(200, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(201, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(202, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(203, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(204, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(205, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(206, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(207, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(208, 149, '2022-03-03', '0000-00-00', '1549', '', 'credit', '3.00', '0.06', '3.06', 'Drafted', 130, 1, '1', ''),
(209, 150, '2022-03-03', '0000-00-00', '11', '', 'credit', '10.00', '0.10', '10.10', 'Drafted', 130, 1, '1', ''),
(210, 1, '2022-03-04', '2022-03-04', '1620', '111', '', '111.00', '0.00', '111.00', 'Drafted', 130, 1, '1', ''),
(211, 151, '2022-03-04', '2022-03-04', '1621', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', ''),
(212, 152, '2022-03-04', '2022-03-04', '1622', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', ''),
(213, 152, '2022-03-04', '2022-03-04', '1622', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', ''),
(214, 153, '2022-03-04', '0000-00-00', '12', '', 'credit', '24.00', '2.88', '26.88', 'Drafted', 130, 1, '1', ''),
(215, 153, '2022-03-04', '0000-00-00', '12', '', 'credit', '24.00', '2.88', '26.88', 'Drafted', 130, 1, '1', ''),
(216, 153, '2022-03-04', '0000-00-00', '12', '', 'credit', '24.00', '2.88', '26.88', 'Drafted', 130, 1, '1', ''),
(217, 153, '2022-03-04', '0000-00-00', '12', '', 'credit', '24.00', '2.88', '26.88', 'Drafted', 130, 1, '1', ''),
(218, 153, '2022-03-04', '0000-00-00', '12', '', 'credit', '24.00', '2.88', '26.88', 'Drafted', 130, 1, '1', ''),
(219, 153, '2022-03-04', '0000-00-00', '12', '', 'credit', '24.00', '2.88', '26.88', 'Drafted', 130, 1, '1', ''),
(220, 153, '2022-03-04', '0000-00-00', '12', '', 'credit', '24.00', '2.88', '26.88', 'Drafted', 130, 1, '1', ''),
(221, 153, '2022-03-04', '0000-00-00', '12', '', 'credit', '24.00', '2.88', '26.88', 'Drafted', 130, 1, '1', ''),
(222, 153, '2022-03-04', '0000-00-00', '12', '', 'credit', '24.00', '2.88', '26.88', 'Drafted', 130, 1, '1', ''),
(223, 153, '2022-03-04', '0000-00-00', '12', '', 'credit', '24.00', '2.88', '26.88', 'Drafted', 130, 1, '1', ''),
(224, 153, '2022-03-04', '0000-00-00', '12', '', 'credit', '24.00', '2.88', '26.88', 'Drafted', 130, 1, '1', ''),
(225, 153, '2022-03-04', '0000-00-00', '12', '', 'credit', '24.00', '2.88', '26.88', 'Drafted', 130, 1, '1', ''),
(226, 153, '2022-03-04', '0000-00-00', '12', '', 'credit', '24.00', '2.88', '26.88', 'Drafted', 130, 1, '1', ''),
(227, 153, '2022-03-04', '0000-00-00', '12', '', 'credit', '24.00', '2.88', '26.88', 'Drafted', 130, 1, '1', ''),
(228, 153, '2022-03-04', '0000-00-00', '12', '', 'credit', '24.00', '2.88', '26.88', 'Drafted', 130, 1, '1', ''),
(229, 153, '2022-03-04', '0000-00-00', '12', '', 'credit', '24.00', '2.88', '26.88', 'Drafted', 130, 1, '1', ''),
(230, 153, '2022-03-04', '0000-00-00', '12', '', 'credit', '24.00', '2.88', '26.88', 'Drafted', 130, 1, '1', ''),
(231, 153, '2022-03-04', '0000-00-00', '12', '', 'credit', '24.00', '2.88', '26.88', 'Drafted', 130, 1, '1', ''),
(232, 153, '2022-03-04', '0000-00-00', '12', '', 'credit', '24.00', '2.88', '26.88', 'Drafted', 130, 1, '1', ''),
(233, 153, '2022-03-04', '0000-00-00', '12', '', 'credit', '24.00', '2.88', '26.88', 'Drafted', 130, 1, '1', ''),
(234, 152, '2022-03-04', '2022-03-04', '1622', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', ''),
(235, 154, '2022-03-04', '2022-03-04', '1623', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', ''),
(236, 155, '2022-03-04', '2022-03-04', '1624', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', ''),
(237, 156, '2022-03-04', '2022-03-04', '1625', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', ''),
(238, 157, '2022-03-04', '0000-00-00', '', '', 'credit', '144.00', '17.28', '161.28', 'Drafted', 130, 1, '1', ''),
(239, 157, '2022-03-04', '0000-00-00', '', '', 'credit', '144.00', '17.28', '161.28', 'Drafted', 130, 1, '1', ''),
(240, 157, '2022-03-04', '0000-00-00', '', '', 'credit', '144.00', '17.28', '161.28', 'Drafted', 130, 1, '1', ''),
(241, 157, '2022-03-04', '0000-00-00', '', '', 'credit', '144.00', '17.28', '161.28', 'Drafted', 130, 1, '1', ''),
(242, 157, '2022-03-04', '0000-00-00', '', '', 'credit', '144.00', '17.28', '161.28', 'Drafted', 130, 1, '1', ''),
(243, 157, '2022-03-04', '0000-00-00', '', '', 'credit', '144.00', '17.28', '161.28', 'Drafted', 130, 1, '1', ''),
(244, 157, '2022-03-04', '0000-00-00', '', '', 'credit', '144.00', '17.28', '161.28', 'Drafted', 130, 1, '1', ''),
(245, 157, '2022-03-04', '0000-00-00', '', '', 'credit', '144.00', '17.28', '161.28', 'Drafted', 130, 1, '1', ''),
(246, 157, '2022-03-04', '0000-00-00', '', '', 'credit', '144.00', '17.28', '161.28', 'Drafted', 130, 1, '1', ''),
(247, 157, '2022-03-04', '0000-00-00', '', '', 'credit', '144.00', '17.28', '161.28', 'Drafted', 130, 1, '1', ''),
(248, 157, '2022-03-04', '0000-00-00', '', '', 'credit', '144.00', '17.28', '161.28', 'Drafted', 130, 1, '1', ''),
(249, 157, '2022-03-04', '0000-00-00', '', '', 'credit', '144.00', '17.28', '161.28', 'Drafted', 130, 1, '1', ''),
(250, 158, '2022-03-04', '2022-03-04', '1626', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', ''),
(251, 159, '2022-03-04', '2022-03-04', '1627', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', ''),
(252, 160, '2022-03-04', '2022-03-04', '1628', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', ''),
(407, 281, '2022-03-08', '2022-03-08', 'INV/2022/03/1814', '', 'credit', '500.00', '250.00', '750.00', 'Drafted', 146, 1, '1', '4'),
(406, 280, '2022-03-08', '2022-03-08', 'INV/2022/03/1837', '', 'credit', '12.00', '1.44', '13.44', 'Drafted', 146, 1, '1', '4'),
(405, 279, '2022-03-08', '2022-03-08', 'INV/2022/03/1836', '', 'credit', '10.00', '1.00', '11.00', 'Drafted', 146, 2, '1', '4'),
(404, 278, '2022-03-08', '2022-03-08', 'INV/2022/03/1835', '', 'credit', '10.00', '1.00', '11.00', 'Drafted', 146, 1, '1', '4'),
(403, 277, '2022-03-08', '2022-03-08', 'INV/2022/03/1823', '', 'credit', '12.00', '13.20', '25.20', 'Drafted', 146, 2, '1', '4'),
(402, 276, '2022-03-08', '2022-03-08', 'INV/2022/03/1822', '', 'credit', '35.00', '8.75', '43.75', 'Drafted', 146, 1, '1', '4'),
(401, 275, '2022-03-07', '2022-03-07', 'INV/2022/03/1821', '', 'credit', '45.00', '5.40', '50.40', 'Drafted', 146, 2, '1', '4'),
(400, 274, '2022-03-07', '2022-03-07', 'INV/2022/03/1819', '', 'credit', '12.00', '2.40', '14.40', 'Drafted', 146, 1, '1', '4'),
(399, 273, '2022-03-07', '2022-03-07', 'INV/2022/03/1818', '', 'credit', '12.00', '2.40', '14.40', 'Drafted', 146, 2, '1', '4'),
(398, 272, '2022-03-07', '2022-03-07', 'INV/2022/03/1817', '', 'credit', '20.00', '4.00', '24.00', 'Drafted', 146, 1, '1', '4'),
(397, 271, '2022-03-05', '2022-03-05', 'INV/2022/03/1', '', 'credit', '12.00', '0.12', '12.12', 'Drafted', 130, 62, '1', '4'),
(396, 270, '2022-03-05', '2022-03-05', 'INV/2022/03/1', '', 'credit', '12.00', '0.12', '12.12', 'Drafted', 130, 1, '1', '4'),
(395, 269, '2022-03-05', '2022-03-05', 'INV/2022/03/1814', '', 'credit', '53.00', '15.90', '68.90', 'Drafted', 130, 7, '1', '4'),
(394, 269, '2022-03-05', '2022-03-05', 'INV/2022/03/1814', '', 'credit', '32.00', '8.40', '40.40', 'Drafted', 130, 1, '1', '4'),
(393, 268, '2022-03-05', '2022-03-05', 'INV/2022/03/1813', '', 'credit', '32.00', '8.40', '40.40', 'Drafted', 130, 1, '1', '4'),
(392, 267, '2022-03-05', '2022-03-05', 'INV/2022/03/1812', '', 'credit', '62.00', '19.20', '81.20', 'Drafted', 130, 4, '1', '4'),
(391, 267, '2022-03-05', '2022-03-05', 'INV/2022/03/1812', '', 'credit', '62.00', '19.20', '81.20', 'Drafted', 130, 1, '1', '4'),
(390, 266, '2022-03-05', '2022-03-05', 'INV/2022/03/1811', '', 'credit', '32.00', '8.40', '40.40', 'Drafted', 130, 1, '1', '4'),
(389, 265, '2022-03-05', '2022-03-05', 'INV/2022/03/1810', '', 'credit', '32.00', '8.88', '40.88', 'Drafted', 130, 1, '1', '4'),
(388, 264, '2022-03-05', '2022-03-05', 'INV/2022/03/1809', '', 'credit', '12.00', '2.40', '14.40', 'Paid', 130, 1, '1', '4'),
(387, 263, '2022-03-05', '2022-03-05', 'INV/2022/03/1808', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', '4'),
(386, 262, '2022-03-05', '2022-03-05', 'INV/2022/03/1807', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', '4'),
(385, 261, '2022-03-05', '2022-03-05', 'INV/2022/03/1806', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', '4'),
(384, 260, '2022-03-05', '2022-03-05', 'INV/2022/03/1805', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 4, '1', '4'),
(383, 260, '2022-03-05', '2022-03-05', 'INV/2022/03/1805', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', '4'),
(382, 259, '2022-03-05', '2022-03-05', 'INV/2022/03/1804', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', '4'),
(381, 258, '2022-03-05', '2022-03-05', 'INV/2022/03/1803', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', '4'),
(380, 257, '2022-03-05', '2022-03-05', 'INV/2022/03/1802', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', '4'),
(379, 257, '2022-03-05', '2022-03-05', 'INV/2022/03/1802', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', '4'),
(378, 256, '2022-03-05', '2022-03-05', 'INV/2022/03/1801', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', '4'),
(377, 255, '2022-03-05', '2022-03-05', 'INV/2022/03/1800', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', '4'),
(376, 254, '2022-03-05', '2022-03-05', 'INV/2022/03/1799', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', '4'),
(375, 254, '2022-03-05', '2022-03-05', 'INV/2022/03/1799', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', '4'),
(374, 253, '2022-03-05', '2022-03-05', 'INV/2022/03/1798', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', '4'),
(373, 253, '2022-03-05', '2022-03-05', 'INV/2022/03/1798', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', '4'),
(372, 252, '2022-03-05', '2022-03-05', 'INV/2022/03/1797', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', '4'),
(371, 252, '2022-03-05', '2022-03-05', 'INV/2022/03/1797', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', '4'),
(370, 251, '2022-03-05', '2022-03-05', 'INV/2022/03/1796', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', '4'),
(369, 251, '2022-03-05', '2022-03-05', 'INV/2022/03/1796', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', '4'),
(368, 250, '2022-03-05', '2022-03-05', 'INV/2022/03/1795', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', '4'),
(367, 250, '2022-03-05', '2022-03-05', 'INV/2022/03/1795', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', '4'),
(366, 249, '2022-03-05', '2022-03-05', 'INV/2022/03/1794', '', 'credit', NULL, NULL, NULL, 'Drafted', 130, 1, '1', '4');

-- --------------------------------------------------------

--
-- Table structure for table `jm_invoicedetail`
--

DROP TABLE IF EXISTS `jm_invoicedetail`;
CREATE TABLE IF NOT EXISTS `jm_invoicedetail` (
  `InvoiceDetailId` int(11) NOT NULL AUTO_INCREMENT,
  `Description` longtext DEFAULT NULL,
  `UnitPrice` varchar(50) DEFAULT NULL,
  `Currency` text NOT NULL,
  `ConvFactor` varchar(50) DEFAULT NULL,
  `Quantity` varchar(50) DEFAULT NULL,
  `Vat` decimal(18,2) DEFAULT NULL,
  `Total` decimal(18,2) DEFAULT NULL,
  `InvoiceMasterId` int(11) DEFAULT NULL,
  PRIMARY KEY (`InvoiceDetailId`)
) ENGINE=MyISAM AUTO_INCREMENT=613 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jm_invoicedetail`
--

INSERT INTO `jm_invoicedetail` (`InvoiceDetailId`, `Description`, `UnitPrice`, `Currency`, `ConvFactor`, `Quantity`, `Vat`, `Total`, `InvoiceMasterId`) VALUES
(1, 'TRANSPORTATION CHARGES ', '1200', 'SAR', '1', ' 1', '180.00', '1380.00', 1),
(16, 'TRUCK DETENTION CHARGES ', '350', 'SAR', '1', '1', '52.50', '402.50', 3),
(26, 'FORKLIFT CHARGE ', '27', 'USD', '3.76', '1', '0.00', '101.52', 4),
(25, 'SEA FREIGHT CHARGES ', '725', 'USD', '3.76', ' 1', '0.00', '2726.00', 4),
(24, 'DO/ PORT CHARGES (AS ATTACHED) ', '23', 'SAR', '1', ' 1', '0.00', '23.00', 3),
(10, 'CUSTOMS CLEARANCE CHARGES', '1500', 'SAR', '1', ' 1', '225.00', '1725.00', 2),
(15, 'TRANSPORTATION CHARGES ', '700', 'SAR', '1', ' 1', '105.00', '805.00', 3),
(12, 'LABOR CHARGES ', '500', 'SAR', '1', '1', '75.00', '575.00', 2),
(13, 'DOCUMENTATION CHARGES ', '500', 'SAR', '1', '1', '75.00', '575.00', 2),
(14, 'DO/ PORT CHARGES (AS ATTACHED) ', '1328.25', 'SAR', '1', '1', '0.00', '1328.25', 2),
(27, 'SEA FREIGHT CHARGES FOR 20FT ', '1180', 'USD', '3.76', '1', '0.00', '4436.80', 5),
(23, 'TRANSPORTATION CHARGES ', '1580', 'SAR', '1', '40', '9480.00', '72680.00', 2),
(28, 'SEA FREIGHT CHARGES FOR 40FT ', '1520', 'USD', '3.76', '2', '0.00', '11430.40', 5),
(29, 'CFS STUFFING CHARGES ', '225', 'USD', '3.76', '3', '0.00', '2538.00', 5),
(30, 'TRANSPORTATION CHARGES(DAMAM TO DAMMAM) ', '1200', 'SAR', '1', ' 1', '180.00', '1380.00', 6),
(31, 'TRANSPORTATION CHARGES(DAMAM YARD TO DAMMAM YARD) ', '1200', 'SAR', '1', ' 1', '180.00', '1380.00', 7),
(32, 'TRANSPORTATION CHARGES : DAMMAM TO NAJRAN ', '3100', 'SAR', '1', ' 1', '465.00', '3565.00', 8),
(33, 'SEA FREIGHT CHARGES ', '735', 'USD', '3.76', ' 1', '0.00', '2763.60', 9),
(34, 'SEA FREIGHT CHARGES ', '395', 'USD', '3.76', ' 1', '0.00', '1485.20', 10),
(35, 'TRANSPORTATION CHARGES : Dammam Yard to Dammam Yard ', '1200', 'SAR', '1', ' 1', '180.00', '1380.00', 11),
(36, 'TRANSPORTATION CHARGES : DAMMAM YARD TO DAMMAM YARD ONE DAY LEASE ', '1200', 'SAR', '1', ' 1', '180.00', '1380.00', 12),
(37, 'TRANSPORTATION CHARGE : DAMMAM TO DAMMAM ( ONE DAY LEASE ) ', '1200', 'SAR', '1', ' 1', '180.00', '1380.00', 13),
(38, 'TRANSPORTATION CHARGES : DAMMAM TO DAMMAM (ONE DAY LEASE)) ', '1200', 'SAR', '1', ' 1', '180.00', '1380.00', 14),
(39, 'AIR FREIGHT CHARGES ', '7.5', 'USD', '3.76', '188', '0.00', '5301.60', 15),
(40, 'TRANSPORTATION CHARGES : DAMMAM YARD TO DAMMAM YARD (ONE DAY LEASE) ', '1200', 'SAR', '1', ' 1', '180.00', '1380.00', 16),
(43, 'AIR FREIGHT CHARGES ', '475', 'EUR', '4.6', ' 1', '0.00', '2185.00', 18),
(42, 'AIR FREIGHT CHARGES ', '5.6', 'USD', '3.76', '439', '0.00', '9243.58', 17),
(44, 'CLEARANCE AND DELIVERY CHARGES ', '1800', 'SAR', '1', '1', '270.00', '2070.00', 18),
(45, 'CUSTOMS DUTY (AS ATTACHED) ', '323', 'SAR', '1', '1', '0.00', '323.00', 18),
(46, 'DO/ PORT CHARGES (AS ATTACHED) ', '255', 'SAR', '1', '1', '0.00', '255.00', 18),
(47, 'DOCUMENTATION CHARGES SCOC ', '3000', 'SAR', '1', '1', '450.00', '3450.00', 18),
(48, 'AIR FREIGHT CHARGES ', '695', 'USD', '3.76', ' 1', '0.00', '2613.20', 19),
(49, 'CLEARANCE AND DELIVERY CHARGES TO JUAYMAH WAREHOUSE ', '1200', 'SAR', '1', '1', '180.00', '1380.00', 19),
(50, 'DOCUMENTATION CHARGES SCOC ', '5000', 'SAR', '1', '1', '750.00', '5750.00', 19),
(51, 'DO/ PORT CHARGES (AS ATTACHED) ', '285.23', 'SAR', '1', '1', '0.00', '285.23', 19),
(57, 'AIR FREIGHT CHARGES ', '4.5', 'EUR', '4.61', '273', '0.00', '5663.39', 21),
(53, 'CLEARANCE AND DELIVERY CHARGES ', '1200', 'SAR', '1', '1', '180.00', '1380.00', 20),
(54, 'DO/ PORT CHARGES (AS ATTACHED) ', '2004.56', 'SAR', '1', '1', '0.00', '2004.56', 20),
(55, 'DOCUMENTATION CHARGES SCOC ', '7500', 'SAR', '1', '1', '1125.00', '8625.00', 20),
(56, 'AIR FREIGHT CHARGES ', '3.45', 'USD', '3.76', '914', '0.00', '11856.41', 20),
(58, 'CLEARANCE AND DELIVERY CHARGES ', '900', 'SAR', '1', '1', '135.00', '1035.00', 21),
(59, 'CUSTOMS DUTY (AS ATTACHED) ', '1596.32', 'SAR', '1', '1', '0.00', '1596.32', 21),
(60, 'DO/ PORT CHARGES (AS ATTACHED) ', '333.8', 'SAR', '1', '1', '0.00', '333.80', 21),
(61, 'SEA FREIGHT CHARGES ', '450', 'USD', '3.76', ' 1', '0.00', '1692.00', 22),
(62, 'CLEARANCE AND DELIVERY CHARGES ', '1200', 'SAR', '1', '1', '180.00', '1380.00', 22),
(63, 'DO/ PORT CHARGES (AS ATTACHED) ', '1558', 'SAR', '1', '1', '0.00', '1558.00', 22),
(64, 'TRANSPORTATION CHARGES : SAECO TO SEC TABUK ', '2500', 'SAR', '1', ' 1', '375.00', '2875.00', 23),
(69, 'TRANSPORTATION CHARGES : DAMMAM TO JUBAIL (ROUND TRIP) ', '1200', 'SAR', '1', ' 1', '180.00', '1380.00', 26),
(66, 'AIR FREIGHT CHARGES ', '4.05', 'USD', '3.76', '1800', '0.00', '27410.40', 24),
(68, 'AIR FREIGHT CHARGES ', '700', 'USD', '3.76', ' 1', '0.00', '2632.00', 25),
(70, 'SEA FREIGHT CHARGES ', '1150', 'USD', '3.76', ' 1', '0.00', '4324.00', 27),
(71, 'TRANSPORTATION CHARGES : DAMMAM TO DAMMAM ( ONE DAY LEASE) ', '1200', 'SAR', '1', ' 1', '180.00', '1380.00', 28),
(72, 'TRANSPORTATION CHARGES : DAMMAM TO DAMMAM (ONE DAY LEASE) ', '1200', 'SAR', '1', ' 1', '180.00', '1380.00', 29),
(73, 'TRANSPORTATION CHARGES : JEDDAH TO FLOUR ARABIA SITE ', '2800', 'SAR', '1', ' 1', '420.00', '3220.00', 30),
(74, 'TRIP CANCELLATION FEE ', '500', 'SAR', '1', '1', '75.00', '575.00', 30),
(75, 'AIR FREIGHT CHARGES ', '4.2', 'USD', '3.76', '679', '0.00', '10722.77', 31),
(76, 'DOCUMENTATION CHARGES SCOC ', '200', 'SAR', '1', ' 1', '0.00', '200.00', 32),
(77, 'DOCUMENTATION CHARGES SCOC ', '125', 'USD', '3.76', ' 1', '70.50', '540.50', 33),
(78, 'SHIPMENT REQUEST FEE ', '402.5', 'SAR', '1', ' 1', '0.00', '402.50', 34),
(79, 'AIR FREIGHT CHARGES ', '3.9', 'USD', '3.76', ' 1126', '0.00', '16511.66', 35),
(80, 'AIR FREIGHT CHARGES ', '6.95', 'USD', '3.76', '147', '0.00', '3841.40', 36),
(81, 'CLEARANCE AND DELIVERY CHARGES ', '1200', 'SAR', '1', '1', '180.00', '1380.00', 36),
(82, 'DOCUMENTATION scoc CHARGES ', '500', 'SAR', '1', '1', '75.00', '575.00', 36),
(87, 'SHIPMENT REQUEST FEE (SADAD PAYMENT) ', '402.5', 'SAR', '1', ' 1', '0.00', '402.50', 36),
(84, 'DO/ PORT CHARGES (AS ATTACHED) ', '371.71', 'SAR', '1', '1', '0.00', '371.71', 36),
(85, 'CUSTOMS DUTY (AS ATTACHED) ', '4427.07', 'SAR', '1', '1', '0.00', '4427.07', 36),
(88, 'SEA FREIGHT CHARGES ', '295', 'USD', '3.76', ' 1', '0.00', '1109.20', 37),
(89, 'SEA FREIGHT CHARGES ', '250', 'USD', '3.76', ' 1', '0.00', '940.00', 38),
(90, 'CLEARANCE CHARGES AT ORIGIN ', '150', 'USD', '3.76', '1', '0.00', '564.00', 38),
(93, 'TRANSPORTATION CHARGES :DAMMAM TO AL QASSIM (REFRIGERATED TRUCK) ', '1400', 'SAR', '1', ' 1', '210.00', '1610.00', 39),
(92, 'WAITING CHARGE ', '100', 'USD', '3.76', ' 1', '0.00', '376.00', 38),
(94, 'SEA FREIGHT CHARGES ', '1800', 'USD', '3.76', ' 1', '0.00', '6768.00', 40),
(95, 'CRATING CHARGES AT ORIGIN ', '695', 'USD', '3.76', '3', '0.00', '7839.60', 40),
(96, 'TRANSPORTATION CHARGES : DAMMAM TO YANBU ', '2500', 'SAR', '1', ' 1', '375.00', '2875.00', 41),
(97, 'TRANSPORTATION CHARGES : DAMMAM TO DAMMAM (ONE DAY LEASE) ', '1200', 'SAR', '1', ' 1', '180.00', '1380.00', 42),
(98, 'CLEARANCE AND DELIVERY CHARGES ', '1300', 'SAR', '1', ' 1', '195.00', '1495.00', 43),
(99, 'DOCUMENTATION CHARGES scoc ', '125', 'USD', '3.76', '1', '70.50', '540.50', 43),
(169, 'CLEARANCE AND DELIVERY CHARGES ', '900', 'SAR', '1', ' 1', '135.00', '1035.00', 68),
(111, 'CLEARANCE AND DELIVERY CHARGES ', '1400', 'SAR', '1', ' 1', '210.00', '1610.00', 48),
(102, 'DO/ PORT CHARGES (AS ATTACHED) ', '1432.47', 'SAR', '1', '1', '0.00', '1432.47', 44),
(103, 'CLEARANCE AND DELIVERY CHARGES TO JUBAIL ', '1500', 'SAR', '1', ' 1', '225.00', '1725.00', 45),
(104, 'TRANSPORTATION CHARGES : DAMMAM TO DAMMAM (ONE DAY LEASE) ', '1200', 'SAR', '1', ' 1', '180.00', '1380.00', 46),
(105, 'SEA FREIGHT CHARGES ', '1840', 'USD', '3.76', ' 1', '0.00', '6918.40', 47),
(106, 'CLEARANCE AND DELIVERY CHARGES ', '375', 'USD', '3.76', '1', '211.50', '1621.50', 47),
(107, 'INSURANCE FEE AT ORIGIN ', '250', 'USD', '3.76', '1', '0.00', '940.00', 47),
(108, 'DOCUMENTATION CHARGES scoc ', '2000', 'USD', '3.76', '1', '1128.00', '8648.00', 47),
(109, 'DO/ PORT CHARGES (AS ATTACHED) ', '2385.8', 'SAR', '1', '1', '0.00', '2385.80', 47),
(110, 'SEA FREIGHT CHARGES ', '1050', 'USD', '3.76', ' 1', '0.00', '3948.00', 44),
(112, 'DO/ PORT CHARGES (AS ATTACHED) ', '1935.75', 'SAR', '1', '1', '0.00', '1935.75', 48),
(117, 'AIR FREIGHT CHARGES ', '620', 'USD', '3.76', ' 1', '0.00', '2331.20', 50),
(120, 'DO/ PORT CHARGES (AS ATTACHED) ', '2950.1', 'SAR', '1', '1', '0.00', '2950.10', 51),
(119, 'CLEARANCE AND DELIVERY CHARGES ', '350', 'USD', '3.76', '1', '197.40', '1513.40', 51),
(118, 'AIR FREIGHT CHARGES ', '5450', 'USD', '3.76', ' 1', '0.00', '20492.00', 51),
(121, 'DOCUMENTATION CHARGES scoc ', '2450', 'USD', '3.76', '1', '1381.80', '10593.80', 51),
(155, 'DOCUMENTATION CHARGES scoc ', '1800', 'USD', '3.76', '1', '0.00', '6768.00', 52),
(123, 'CLEARANCE AND DELIVERY CHARGES ', '400', 'USD', '3.76', '1', '225.60', '1729.60', 52),
(124, 'DO/ PORT CHARGES (AS ATTACHED) ', '285', 'SAR', '1', '1', '0.00', '285.00', 52),
(125, 'CUSTOMS DUTY (AS ATTACHED) ', '1197.51', 'SAR', '1', '1', '0.00', '1197.51', 52),
(154, 'AIR FREIGHT CHARGES ', '800', 'USD', '3.76', ' 1', '0.00', '3008.00', 52),
(127, 'CLEARANCE AND DELIVERY CHARGES ', '900', 'SAR', '1', ' 1', '135.00', '1035.00', 53),
(128, 'CUSTOMS DUTY (AS ATTACHED) ', '2744.32', 'SAR', '1', '1', '0.00', '2744.32', 53),
(129, 'DO/ PORT CHARGES (AS ATTACHED) ', '651.65', 'SAR', '1', '1', '0.00', '651.65', 53),
(130, 'CLEARANCE AND DELIVERY CHARGES ', '1100', 'SAR', '1', ' 1', '165.00', '1265.00', 54),
(131, 'DO/ PORT CHARGES (AS ATTACHED) ', '1857', 'SAR', '1', '1', '0.00', '1857.00', 54),
(132, 'CUSTOMS DUTY (AS ATTACHED) ', '529.67', 'SAR', '1', '1', '0.00', '529.67', 54),
(133, 'DOCUMENTATION CHARGES scoc ', '4500', 'SAR', '1', '1', '675.00', '5175.00', 54),
(134, 'ADVANCE CUSTOMS DUTY ', '24219.34', 'SAR', '1', ' 1', '0.00', '24219.34', 55),
(135, 'AIR FREIGHT CHARGES ', '3350.6', 'EUR', '4.65', ' 1', '0.00', '15580.29', 56),
(136, 'INLAND HANDLING CHARGES ', '100', 'EUR', '4.65', '1', '0.00', '465.00', 56),
(137, 'CLEARANCE AND DELIVERY CHARGES ', '700', 'SAR', '1', '1', '105.00', '805.00', 56),
(138, 'TRANSPORTATION CHARGES FROM AOT YARD TO 2ND IND AREA ', '400', 'SAR', '1', '1', '60.00', '460.00', 56),
(139, 'DO/ PORT CHARGES (AS ATTACHED) ', '1479.2', 'SAR', '1', '1', '0.00', '1479.20', 56),
(140, 'SEA FREIGHT CHARGES ', '175', 'USD', '3.76', ' 1', '0.00', '658.00', 57),
(141, 'SEA FREIGHT CHARGES ', '1620', 'EUR', '4.65', ' 1', '0.00', '7533.00', 58),
(142, 'AIR FREIGHT CHARGES ', '340', 'EUR', '4.65', ' 1', '0.00', '1581.00', 59),
(143, 'AIR FREIGHT CHARGES ', '5.35', 'USD', '3.76', '179', '0.00', '3600.76', 60),
(144, 'AIR FREIGHT CHARGES ', '520', 'USD', '3.76', ' 1', '0.00', '1955.20', 61),
(145, 'SEA FREIGHT CHARGES ', '690', 'EUR', '4.6', ' 1', '0.00', '3174.00', 62),
(146, 'CLEARANCE AND DELIVERY CHARGES ', '1100', 'SAR', '1', '1', '0.00', '1100.00', 62),
(147, 'DO/ PORT CHARGES (AS ATTACHED) ', '7057.85', 'SAR', '1', '1', '0.00', '7057.85', 62),
(148, 'DOCUMENTATION CHARGES scoc ', '200', 'SAR', '1', '1', '0.00', '200.00', 62),
(149, 'DOCUMENTATION CHARGES SCOC ', '200', 'SAR', '1', ' 1', '0.00', '200.00', 63),
(150, 'CLEARANCE AND DELIVERY CHARGES ', '1200', 'SAR', '1', ' 1', '0.00', '1200.00', 64),
(151, 'DO/ PORT CHARGES (AS ATTACHED) ', '3151.3', 'SAR', '1', '1', '0.00', '3151.30', 64),
(158, 'DO/ PORT CHARGES (AS ATTACHED) ', '6439.1', 'SAR', '1', '1', '0.00', '6439.10', 65),
(156, 'DO/ PORT CHARGES (AS ATTACHED) ', '1810.37', 'SAR', '1', ' 1', '0.00', '1810.37', 43),
(164, 'DOCUMENTATION CHARGES scoc ', '125', 'USD', '3.76', ' 1', '70.50', '540.50', 65),
(160, 'CLEARANCE AND DELIVERY CHARGES ', '1100', 'SAR', '1', ' 1', '165.00', '1265.00', 66),
(161, 'DO/ PORT CHARGES (AS ATTACHED) ', '1606', 'SAR', '1', '1', '0.00', '1606.00', 66),
(162, 'DOCUMENTATION CHARGES scoc ', '125', 'USD', '3.76', '1', '70.50', '540.50', 66),
(165, 'CLEARANCE AND DELIVERY CHARGES ', '1300', 'SAR', '1', ' 1', '195.00', '1495.00', 67),
(166, 'DO/ PORT CHARGES (AS ATTACHED) ', '3098.64', 'SAR', '1', '1', '0.00', '3098.64', 67),
(167, 'DOCUMENTATION CHARGES scoc ', '125', 'USD', '3.76', '1', '70.50', '540.50', 67),
(168, 'CLEARANCE AND DELIVERY CHARGES (Trailer) ', '1200', 'SAR', '1', ' 1', '180.00', '1380.00', 65),
(170, 'DO/ PORT CHARGES (AS ATTACHED) ', '787.36', 'SAR', '1', '1', '0.00', '787.36', 68),
(171, 'DOCUMENTATION CHARGES scoc ', '125', 'USD', '3.76', '1', '70.50', '540.50', 68),
(172, 'CLEARANCE AND DELIVERY CHARGES ', '1300', 'SAR', '1', ' 1', '195.00', '1495.00', 69),
(173, 'DO/ PORT CHARGES (AS ATTACHED) ', '1829.2', 'SAR', '1', '1', '0.00', '1829.20', 69),
(174, 'DOCUMENTATION CHARGES scoc ', '125', 'USD', '3.76', '1', '70.50', '540.50', 69),
(175, 'CLEARANCE AND DELIVERY CHARGES ', '1100', 'SAR', '1', ' 1', '165.00', '1265.00', 70),
(176, 'DO/ PORT CHARGES (AS ATTACHED) ', '1225.5', 'SAR', '1', '1', '0.00', '1225.50', 70),
(177, 'DOCUMENTATION CHARGES scoc ', '125', 'USD', '3.76', '1', '70.50', '540.50', 70),
(178, 'AIR FREIGHT CHARGES ', '2.99', 'USD', '3.76', '1055', '0.00', '11860.73', 71),
(179, 'CLEARANCE AND DELIVERY CHARGES ', '900', 'SAR', '1', '1', '135.00', '1035.00', 71),
(180, 'DO/ PORT CHARGES (AS ATTACHED) ', '932.75', 'SAR', '1', '1', '0.00', '932.75', 71),
(181, 'DOCUMENTATION CHARGES scoc ', '24250', 'SAR', '1', '1', '3637.50', '27887.50', 71),
(182, 'AIR FREIGHT CHARGES ', '4.45', 'USD', '3.76', '470', '0.00', '7864.04', 72),
(183, 'AIR FREIGHT CHARGES ', '5.25', 'USD', '3.76', '1812', '0.00', '35768.88', 73),
(184, 'CLEARANCE AND DELIVERY CHARGES ', '900', 'SAR', '1', '1', '135.00', '1035.00', 73),
(185, 'DO/ PORT CHARGES (AS ATTACHED) ', '1915.76', 'SAR', '1', '1', '0.00', '1915.76', 73),
(186, 'DOCUMENTATION CHARGES scoc ', '125', 'USD', '3.76', '1', '70.50', '540.50', 73),
(187, 'AIR FREIGHT CHARGES ', '4.25', 'USD', '3.76', '1065', '0.00', '17018.70', 74),
(188, 'TRANSPORTATION CHARGES : DAMMAM TO DAMMAM (ONE DAY LEASE) ', '1200', 'SAR', '1', ' 1', '180.00', '1380.00', 75),
(189, 'AIR FREIGHT CHARGES ', '4', 'USD', '3.76', '476', '0.00', '7159.04', 76),
(190, 'DOCUMENTATION CHARGES scoc ', '200', 'SAR', '1', ' 1', '0.00', '200.00', 77),
(191, 'AIR FREIGHT CHARGES ', '5.5', 'USD', '3.76', ' 330', '0.00', '6824.40', 78),
(192, 'CLEARANCE AND DELIVERY CHARGES ', '1000', 'SAR', '1', '1', '150.00', '1150.00', 78),
(193, 'DOCUMENTATION CHARGES scoc ', '500', 'SAR', '1', '1', '75.00', '575.00', 78),
(194, 'SCOC SHIPMENT REQUEST FEE ', '402.5', 'SAR', '1', '1', '0.00', '402.50', 78),
(195, 'DO/ PORT CHARGES (As attached)', '671.30', 'SAR', '1', '1', '0.00', '671.30', 78),
(196, 'AIR FREIGHT CHARGES ', '495', 'EUR', '4.66', ' 1', '0.00', '2306.70', 79),
(197, 'CLEARANCE AND DELIVERY CHARGES ', '900', 'SAR', '1', '1', '135.00', '1035.00', 79),
(198, 'DO/ PORT CHARGES (AS ATTACHED) ', '330.76', 'SAR', '1', '1', '0.00', '330.76', 79),
(199, 'AIR FREIGHT CHARGES ', '550', 'USD', '3.76', ' 1', '0.00', '2068.00', 80),
(200, 'CLEARANCE AND DELIVERY CHARGES ', '900', 'SAR', '1', '1', '135.00', '1035.00', 80),
(201, 'DO/ PORT CHARGES (AS ATTACHED) ', '522.7', 'SAR', '1', '1', '0.00', '522.70', 80),
(202, 'AIR FREIGHT CHARGES ', '380', 'GBP', '5.17', ' 1', '0.00', '1964.60', 81),
(203, 'CLEARANCE AND DELIVERY CHARGES ', '900', 'SAR', '1', '1', '135.00', '1035.00', 81),
(204, 'DO/ PORT CHARGES (AS ATTACHED) ', '293.7', 'SAR', '1', '1', '0.00', '293.70', 81),
(205, 'CLEARANCE AND DELIVERY CHARGES ', '1300', 'SAR', '1', ' 1', '195.00', '1495.00', 82),
(209, 'CLEARANCE AND DELIVERY CHARGES ', '1050', 'SAR', '1', ' 1', '157.50', '1207.50', 83),
(207, 'DO/ PORT CHARGES (AS ATTACHED) ', '2088.63', 'SAR', '1', ' 1', '0.00', '2088.63', 82),
(210, 'DO/ PORT CHARGES (AS ATTACHED) ', '477', 'SAR', '1', '1', '0.00', '477.00', 83),
(211, 'SEA FREIGHT CHARGES ', '620', 'USD', '3.76', ' 1', '0.00', '2331.20', 84),
(212, 'INSPECTION FEE AT ORIGIN ', '150', 'EUR', '4.65', '1', '0.00', '697.50', 84),
(213, 'DO/ PORT CHARGES (AS ATTACHED) ', '1839.5', 'SAR', '1', '1', '0.00', '1839.50', 84),
(214, 'CLEARANCE AND DELIVERY CHARGES ', '1200', 'SAR', '1', '1', '180.00', '1380.00', 84),
(215, 'CLEARANCE AND DELIVERY CHARGES (ALL IN) ', '10000', 'SAR', '1', '1', '1500.00', '11500.00', 85),
(216, 'DO/ PORT CHARGES (AS ATTACHED) ', '1487.55', 'SAR', '1', '1', '0.00', '1487.55', 85),
(217, 'TRANSPORTATION CHARGES(DAMAM TO RABIGH) ', '2550', 'SAR', '1', '3', '1147.50', '8797.50', 86),
(218, 'TRANSPORTATION CHARGES : DAMMAM TO DAMMAM (ONE DAY LEASE) ', '1200', 'SAR', '1', ' 1', '180.00', '1380.00', 87),
(219, 'TRANSPORTATION CHARGES : DAMMAM TO DAMMAM (ONE DAY LEASE) ', '1200', 'SAR', '1', ' 1', '180.00', '1380.00', 88),
(220, 'CLEARANCE CHARGES ', '500', 'SAR', '1', ' 1', '75.00', '575.00', 89),
(221, 'DOCUMENTATION CHARGES ', '150', 'SAR', '1', '1', '22.50', '172.50', 89),
(224, 'ENTRY TICKET FEE  ', '100', 'SAR', '1', ' 1', '0.00', '100.00', 89),
(223, 'BAYAN CHARGES (AS ATTACHED) ', '178', 'SAR', '1', ' 1', '0.00', '178.00', 89),
(225, 'SEA FREIGHT CHARGES ', '1050', 'USD', '3.76', ' 1', '0.00', '3948.00', 90),
(226, 'CLEARANCE AND DELIVERY CHARGES ', '1300', 'SAR', '1', '1', '195.00', '1495.00', 90),
(227, 'DO/ PORT CHARGES (AS ATTACHED) ', '1525.7', 'SAR', '1', '1', '0.00', '1525.70', 90),
(228, 'CLEARANCE AND DELIVERY CHARGES ', '1100', 'SAR', '1', ' 1', '165.00', '1265.00', 91),
(229, 'DO/ PORT CHARGES (AS ATTACHED) ', '2319', 'SAR', '1', '1', '0.00', '2319.00', 91),
(230, 'DOCUMENTATION CHARGES scoc ', '125', 'USD', '3.76', '6', '423.00', '3243.00', 91),
(231, 'CLEARANCE AND DELIVERY CHARGES ', '1300', 'SAR', '1', ' 1', '195.00', '1495.00', 92),
(232, 'DO/ PORT CHARGES (AS ATTACHED) ', '1867.52', 'SAR', '1', '1', '0.00', '1867.52', 92),
(233, 'DOCUMENTATION CHARGES scoc ', '125', 'USD', '3.76', '1', '70.50', '540.50', 92),
(234, 'BORDER CLEARANCE CHARGES ', '500', 'SAR', '1', ' 1', '75.00', '575.00', 93),
(235, 'DOCUMENTATION/ HANDLING CHARGES ', '150', 'SAR', '1', '1', '22.50', '172.50', 99),
(236, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 10),
(237, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 10),
(238, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 10),
(239, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 10),
(240, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 10),
(241, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 10),
(242, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 10),
(243, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 10),
(244, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 140),
(245, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 140),
(246, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 141),
(247, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 141),
(248, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 142),
(249, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 142),
(250, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 143),
(251, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 143),
(252, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 144),
(253, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 144),
(254, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 145),
(255, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 145),
(256, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 146),
(257, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 146),
(258, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 147),
(259, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 147),
(260, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 148),
(261, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 148),
(262, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 149),
(263, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 149),
(264, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 150),
(265, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 150),
(266, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 151),
(267, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 151),
(268, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 152),
(269, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 152),
(270, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 153),
(271, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 153),
(272, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 154),
(273, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 154),
(274, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 155),
(275, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 155),
(276, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 156),
(277, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 156),
(278, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 157),
(279, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 157),
(280, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 158),
(281, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 158),
(282, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 159),
(283, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 159),
(284, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 160),
(285, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 160),
(286, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 161),
(287, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 161),
(288, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 162),
(289, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 162),
(290, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 163),
(291, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 163),
(292, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 164),
(293, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 164),
(294, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 165),
(295, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 165),
(296, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 166),
(297, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 166),
(298, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 167),
(299, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 167),
(300, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 168),
(301, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 168),
(302, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 169),
(303, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 169),
(304, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 170),
(305, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 170),
(306, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 171),
(307, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 171),
(308, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 172),
(309, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 172),
(310, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 173),
(311, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 173),
(312, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 174),
(313, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 174),
(314, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 175),
(315, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 175),
(316, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 176),
(317, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 176),
(318, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 177),
(319, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 177),
(320, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 178),
(321, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 178),
(322, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 179),
(323, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 179),
(324, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 180),
(325, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 180),
(326, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 181),
(327, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 181),
(328, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 184),
(329, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 184),
(330, 'TRANSPORTATION CHARGES ', '12', 'USD', '1', '250', '30.00', '3000.00', 185),
(331, 'SEA FREIGHT CHARGES ', '1233', 'USD', '1', '655', '16152.30', '807615.00', 185),
(332, 'TRANSPORTATION CHARGES ', '65', 'SAR', '1', ' 1', '33.80', '98.80', 275),
(333, 'TRANSPORTATION CHARGES ', '10', 'SAR', '1', ' 1', '2.00', '12.00', 276),
(334, 'TRANSPORTATION CHARGES ', '10', 'SAR', '1', '1', '2.00', '12.00', 276),
(335, 'TRANSPORTATION CHARGES ', '20', 'SAR', '1', ' 1', '4.00', '24.00', 277),
(336, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '6.00', '18.00', 278),
(337, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 279),
(338, 'TRANSPORTATION CHARGES ', '20', 'SAR', '1', ' 1', '4.00', '24.00', 280),
(339, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '6.00', '18.00', 281),
(340, 'CUSTOMS CLEARANCE CHARGES ', '35', 'SAR', '1', ' 1', '12.25', '47.25', 282),
(341, 'TRANSPORTATION CHARGES ', '52', 'SAR', '1', ' 1', '26.00', '78.00', 283),
(342, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '1.44', '13.44', 284),
(343, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', '2', '4.00', '6.00', 285),
(344, 'TRANSPORTATION CHARGES ', '52', 'SAR', '1', '15', '663.00', '1443.00', 285),
(345, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.65', '1.65', 286),
(346, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '6.00', '18.00', 287),
(347, 'CUSTOMS DUTY (AS ATTACHED) ', '12', '', '1', ' 1', '6.24', '18.24', 288),
(348, 'TRANSPORTATION CHARGES ', '52', 'SAR', '1', ' 15', '156.00', '936.00', 289),
(349, 'SEA FREIGHT CHARGES ', '12', 'INR', '21', '1', '506.52', '758.52', 289),
(350, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '6.24', '18.24', 290),
(351, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '14.76', '26.76', 291),
(352, 'TRANSPORTATION CHARGES ', '5', 'SAR', '1', ' 1', '33.10', '38.10', 292),
(353, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '6.24', '18.24', 293),
(354, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '4.08', '16.08', 294),
(355, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '4.20', '16.20', 295),
(356, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '2.40', '14.40', 296),
(357, 'SEA FREIGHT CHARGES ', '23', 'SAR', '1', '1', '2.76', '25.76', 296),
(358, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 297),
(359, 'AIR FREIGHT CHARGES ', '20', 'SAR', '1', ' 1', '4.00', '24.00', 298),
(360, 'CUSTOMS CLEARANCE CHARGES ', '20', 'SAR', '1', '1', '6.00', '26.00', 298),
(361, 'AIR FREIGHT CHARGES ', '1', 'SAR', '1', ' 1', '0.35', '1.35', 299),
(362, 'AIR FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '2.52', '14.52', 300),
(363, 'SEA FREIGHT CHARGES ', '52', 'SAR', '1', '1', '16.64', '68.64', 300),
(364, 'AIR FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '3.60', '15.60', 301),
(365, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', '1', '6.60', '18.60', 301),
(366, 'CUSTOMS DUTY (AS ATTACHED) ', '23', 'SAR', '1', '1', '12.19', '35.19', 301),
(367, 'TRANSPORTATION CHARGES ', '11', 'SAR', '1', ' 1', '1.21', '12.21', 302),
(368, 'CUSTOMS CLEARANCE CHARGES ', '12', 'SAR', '1', ' 1', '3.60', '15.60', 303),
(369, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '2.64', '14.64', 304),
(370, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '2.76', '14.76', 305),
(371, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '2.76', '14.76', 306),
(372, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '2.76', '14.76', 307),
(373, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '1.44', '13.44', 308),
(374, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', '1', '1.44', '13.44', 308),
(375, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '2.76', '14.76', 309),
(376, 'CUSTOMS DUTY (AS ATTACHED) ', '23', 'SAR', '1', '1', '10.35', '33.35', 309),
(377, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '6.24', '18.24', 310),
(378, 'DO/ PORT CHARGES (AS ATTACHED) ', '12', 'SAR', '1', '1', '1.20', '13.20', 310),
(379, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '2.64', '14.64', 311),
(380, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', '1', '4.08', '16.08', 311),
(381, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '2.64', '14.64', 312),
(382, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '0.24', '12.24', 313),
(383, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 314),
(384, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 315),
(385, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.36', '12.36', 316),
(386, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '0.36', '12.36', 317),
(387, 'TRANSPORTATION CHARGES ', '22', 'SAR', '1', ' 1', '4.84', '26.84', 318),
(388, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '2.64', '14.64', 319),
(389, 'TRANSPORTATION CHARGES ', '23', 'SAR', '1', ' 1', '2.76', '25.76', 320),
(390, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '1.44', '13.44', 321),
(391, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.24', '12.24', 322),
(392, 'SEA FREIGHT CHARGES ', '1', 'SAR', '1', ' 1', '0.01', '1.01', 323),
(393, 'SEA FREIGHT CHARGES ', '1', 'SAR', '1', ' 1', '0.01', '1.01', 324),
(394, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 325),
(395, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.01', '1.01', 326),
(396, 'DO/ PORT CHARGES (AS ATTACHED) ', '12', 'SAR', '1', '1', '0.12', '12.12', 326),
(397, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.01', '1.01', 327),
(398, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', '1', '2.76', '14.76', 327),
(399, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 328),
(400, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 329),
(401, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.01', '1.01', 330),
(402, 'TRANSPORTATION CHARGES ', '11', 'SAR', '1', '1', '0.11', '11.11', 330),
(403, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '4.08', '16.08', 331),
(404, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', '1', '4.20', '16.20', 331),
(405, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 332),
(406, 'TRANSPORTATION CHARGES ', '23', 'SAR', '1', '1', '7.82', '30.82', 332),
(407, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 333),
(408, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', '1', '0.00', '1.00', 333),
(409, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.01', '1.01', 334),
(410, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', '1', '0.12', '12.12', 334),
(411, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 335),
(412, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 336),
(413, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.01', '1.01', 337),
(414, 'SEA FREIGHT CHARGES ', '11', 'SAR', '1', '1', '1.21', '12.21', 337),
(415, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 338),
(416, 'TRANSPORTATION CHARGES ', '11', 'SAR', '1', ' 1', '0.00', '11.00', 339),
(417, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 340),
(418, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', '1', '0.00', '12.00', 340),
(419, 'SEA FREIGHT CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 341),
(420, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.01', '1.01', 342),
(421, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', '1', '0.00', '12.00', 342),
(422, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '3.60', '15.60', 343),
(423, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 344),
(424, 'CUSTOMS DUTY (AS ATTACHED) ', '12', 'SAR', '1', '1', '0.12', '12.12', 344),
(425, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 345),
(426, 'SEA FREIGHT CHARGES ', '1', 'SAR', '1', '1', '0.00', '1.00', 345),
(427, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 346),
(428, 'STORAGE/WAREHOUSE/LOL CHARGES ', '1', 'SAR', '1', '1', '0.00', '1.00', 346),
(429, 'TRANSPORTATION CHARGES ', '5', 'SAR', '1', ' 1', '0.00', '5.00', 347),
(430, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 348),
(431, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', '1', '0.00', '12.00', 348),
(432, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 349),
(433, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 350),
(434, 'TRANSPORTATION CHARGES ', '11', 'SAR', '1', '1', '0.00', '11.00', 350),
(435, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 351),
(436, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', '1', '0.00', '1.00', 351),
(437, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 352),
(438, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', '1', '0.00', '12.00', 352),
(439, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 353),
(440, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', '1', '0.00', '12.00', 353),
(441, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 354),
(442, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', '1', '0.00', '12.00', 354),
(443, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 355),
(444, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', '1', '0.00', '12.00', 355),
(445, 'TRANSPORTATION CHARGES ', '2', 'SAR', '1', ' 1', '0.00', '2.00', 356),
(446, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 357),
(447, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 358),
(448, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 359),
(449, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 360),
(450, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 361),
(451, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 362),
(452, 'CUSTOMS DUTY (AS ATTACHED) ', '12', 'SAR', '1', '1', '0.00', '12.00', 362),
(453, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 363),
(454, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 364),
(455, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 365),
(456, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 366),
(457, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 367),
(458, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 368),
(459, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.01', '1.01', 369),
(460, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 370),
(461, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 371),
(462, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 372),
(463, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 373),
(464, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 374),
(465, '605 ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 375),
(466, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 376),
(467, 'TRANSPORTATION CHARGES ', '23', 'SAR', '1', ' 1', '0.00', '23.00', 377),
(468, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 378),
(469, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 379),
(470, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 380),
(471, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 381),
(472, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 382),
(473, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 383),
(474, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 384),
(475, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 385),
(476, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', '1', '0.00', '12.00', 385),
(477, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 386),
(478, 'TRANSPORTATION CHARGES ', '36', 'SAR', '1', ' 1', '0.00', '36.00', 387),
(479, 'AIR FREIGHT CHARGES ', '2', 'SAR', '1', '1', '0.00', '2.00', 387),
(480, 'TRANSPORTATION CHARGES ', '2', 'SAR', '1', ' 1', '0.00', '2.00', 388),
(481, 'TRANSPORTATION CHARGES ', '2', 'SAR', '1', '1', '0.00', '2.00', 388),
(482, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 389),
(483, 'TRANSPORTATION CHARGES ', '23', 'SAR', '1', '1', '0.00', '23.00', 389),
(484, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 390),
(485, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 391),
(486, 'TRANSPORTATION CHARGES ', '123', 'SAR', '1', ' 1', '0.00', '123.00', 392),
(487, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 393),
(488, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 394),
(489, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', '1', '0.00', '12.00', 394),
(490, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 395),
(491, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 396),
(492, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 397),
(493, 'TRANSPORTATION CHARGES ', '2', 'SAR', '1', '1', '0.00', '2.00', 397),
(494, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 398),
(495, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 399),
(496, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 400),
(497, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 401),
(498, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 402),
(499, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 403),
(500, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 404),
(501, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 405),
(502, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 406),
(503, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 407),
(504, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 408),
(505, 'TRANSPORTATION CHARGES ', '52', 'SAR', '1', ' 1', '0.00', '52.00', 409),
(506, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 410),
(507, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 411),
(508, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 412),
(509, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 413),
(510, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 414),
(511, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 415),
(512, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 416),
(513, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 417),
(514, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 418),
(515, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 419),
(516, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 420),
(517, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 421),
(518, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '1.20', '13.20', 422),
(519, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.01', '1.01', 423),
(520, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 424),
(521, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 425),
(522, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 426),
(523, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 427),
(524, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 428),
(525, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 429),
(526, 'TRANSPORTATION CHARGES ', '2', 'SAR', '1', '1', '0.00', '2.00', 429),
(527, 'TRANSPORTATION CHARGES ', 'NaN', 'SAR', '1', ' 1', '0.00', '0.00', 430),
(528, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', '1', '0.00', '12.00', 430),
(529, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 431),
(530, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 432),
(531, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 433),
(532, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 434),
(533, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 435),
(534, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 436),
(535, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 437),
(536, 'TRANSPORTATION CHARGES ', 'NaN', 'SAR', '1', ' 1', '0.00', '0.00', 438),
(537, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 439),
(538, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 440),
(539, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 441),
(540, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 442),
(541, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 443),
(542, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', '1', '0.00', '1.00', 443),
(543, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 444),
(544, 'AIR FREIGHT CHARGES ', '12', 'SAR', '1', '1', '0.00', '12.00', 444),
(545, 'TRANSPORTATION CHARGES ', '2', 'SAR', '1', ' 1', '0.00', '2.00', 445),
(546, 'SEA FREIGHT CHARGES ', '1', 'SAR', '1', '1', '0.00', '1.00', 445),
(547, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 446),
(548, 'OTHER CHARGES ', '1', 'SAR', '1', '1', '0.00', '1.00', 446),
(549, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 447),
(550, 'AIR FREIGHT CHARGES ', '12', 'SAR', '1', '1', '0.00', '12.00', 447),
(551, 'SEA FREIGHT CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 448),
(552, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', '1', '0.00', '12.00', 448),
(553, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.00', '1.00', 449),
(554, 'TRANSPORTATION CHARGES ', '23', 'SAR', '1', '1', '0.00', '23.00', 449),
(555, 'TRANSPORTATION CHARGES ', '11', 'SAR', '1', ' 1', '0.00', '11.00', 450),
(556, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', '1', '0.00', '12.00', 450),
(557, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 451),
(558, 'SEA FREIGHT CHARGES ', '23', 'SAR', '1', '1', '0.00', '23.00', 451),
(559, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 452),
(560, 'CUSTOMS DUTY (AS ATTACHED) ', '12', 'SAR', '1', '1', '0.00', '12.00', 452),
(561, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 453),
(562, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', '1', '0.00', '12.00', 453),
(563, 'CUSTOMS CLEARANCE CHARGES ', '12', 'SAR', '1', '1', '0.00', '12.00', 453),
(564, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '2.40', '14.40', 454),
(565, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '0.00', '12.00', 455),
(566, 'SEA FREIGHT CHARGES ', '1', 'SAR', '1', '1', '0.00', '1.00', 455),
(567, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '1.44', '13.44', 456),
(568, 'TRANSPORTATION CHARGES ', '20', 'SAR', '1', ' 1', '4.00', '24.00', 457),
(569, 'TRANSPORTATION CHARGES ', '65', 'SAR', '1', ' 1', '15.60', '80.60', 458),
(570, 'TRANSPORTATION CHARGES ', '32', 'SAR', '1', '1', '9.60', '41.60', 458),
(571, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '2.40', '14.40', 459),
(572, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', '1', '3.60', '15.60', 459),
(573, 'TRANSPORTATION CHARGES ', '52', 'SAR', '1', ' 1', '10.40', '62.40', 460),
(574, 'SEA FREIGHT CHARGES ', '52', 'SAR', '1', '1', '18.72', '70.72', 460),
(575, 'CUSTOMS CLEARANCE CHARGES ', '35', 'SAR', '1', '1', '10.50', '45.50', 460),
(576, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '2.40', '14.40', 461),
(577, 'CUSTOMS DUTY (AS ATTACHED) ', '50', 'SAR', '1', '1', '15.00', '65.00', 461),
(578, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '2.40', '14.40', 462),
(579, 'SEA FREIGHT CHARGES ', '32', 'SAR', '1', '1', '9.60', '41.60', 462),
(580, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', '1', '3.60', '15.60', 462),
(581, 'TRANSPORTATION CHARGES ', '12', 'SAR', '12', '23', '331.20', '3312.00', 463),
(582, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 1),
(583, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.01', '1.01', 1),
(584, 'TRANSPORTATION CHARGES ', '53', 'SAR', '1', '12', '127.20', '636.00', 464),
(585, 'TRANSPORTATION CHARGES ', '52', 'SAR', '1', '12', '74.88', '624.00', 465),
(586, 'AIR FREIGHT CHARGES ', '12', 'INR', '1', '12', '93.60', '144.00', 1),
(587, 'TRANSPORTATION CHARGES ', '23', 'SAR', '52', '63', '26371.80', '75348.00', 466),
(588, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '2.40', '14.40', 467),
(589, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '2.40', '14.40', 468),
(590, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '2.40', '14.40', 469),
(591, 'TRANSPORTATION CHARGES ', '12', 'bank', '1', '12', '1.44', '144.00', 470),
(592, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '1.44', '13.44', 471),
(593, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '3.00', '15.00', 472),
(594, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '13.20', '25.20', 473),
(595, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 474),
(596, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 476),
(597, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 477),
(598, 'TRANSPORTATION CHARGES ', '1', 'SAR', '1', ' 1', '0.01', '1.01', 479),
(599, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 480),
(600, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 481),
(601, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 482),
(602, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 483),
(603, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 484),
(604, 'SEA FREIGHT CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 485),
(605, 'TRANSPORTATION CHARGES ', '1', 'INR', '1', ' 1', '0.01', '1.01', 486),
(606, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '1.44', '13.44', 487),
(607, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 488),
(608, 'TRANSPORTATION CHARGES ', '10', 'SAR', '1', ' 1', '1.00', '11.00', 489),
(609, 'TRANSPORTATION CHARGES ', '10', 'SAR', '1', ' 1', '1.00', '11.00', 490),
(610, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '1.44', '13.44', 491),
(611, 'TRANSPORTATION CHARGES ', '122', 'SAR', '1', ' 1', '61.00', '183.00', 492),
(612, 'TRANSPORTATION CHARGES ', '12', 'SAR', '1', ' 1', '0.12', '12.12', 493);

-- --------------------------------------------------------

--
-- Table structure for table `jm_invoicemaster`
--

DROP TABLE IF EXISTS `jm_invoicemaster`;
CREATE TABLE IF NOT EXISTS `jm_invoicemaster` (
  `InvoiceMasterId` int(11) NOT NULL AUTO_INCREMENT,
  `Inv` varchar(150) DEFAULT NULL,
  `Date` varchar(50) DEFAULT NULL,
  `JobId` int(11) DEFAULT NULL,
  `Bank` varchar(100) DEFAULT NULL,
  `InvoiceType` varchar(50) DEFAULT NULL,
  `ReceiptNo` varchar(50) DEFAULT NULL,
  `ReceiptDescription` varchar(50) DEFAULT NULL,
  `Amount` decimal(18,2) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Active` varchar(50) DEFAULT NULL,
  `Total` decimal(18,2) DEFAULT NULL,
  `VatTotal` decimal(18,2) DEFAULT NULL,
  `GrandTotal` decimal(18,2) DEFAULT NULL,
  `Userid` varchar(220) NOT NULL,
  `Remark` mediumtext NOT NULL,
  PRIMARY KEY (`InvoiceMasterId`)
) ENGINE=MyISAM AUTO_INCREMENT=494 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jm_invoicemaster`
--

INSERT INTO `jm_invoicemaster` (`InvoiceMasterId`, `Inv`, `Date`, `JobId`, `Bank`, `InvoiceType`, `ReceiptNo`, `ReceiptDescription`, `Amount`, `Status`, `Active`, `Total`, `VatTotal`, `GrandTotal`, `Userid`, `Remark`) VALUES
(1, '1454', '2020-10-04', 1, '1', 'credit', '', '', '0.00', 'Paid', 'active', '1200.00', '180.00', '1380.00', '0', ''),
(2, '1455', '2020-10-06', 2, '1', 'credit', '', '', '0.00', 'Posted', 'active', '67028.25', '9855.00', '76883.25', '0', ''),
(3, '1456', '2020-10-06', 3, '1', 'credit', '', '', '0.00', 'Posted', 'active', '1073.00', '157.50', '1230.50', '0', ''),
(4, '1457', '2020-10-06', 4, '1', 'credit', '', '', '0.00', 'Paid', 'active', '2827.52', '0.00', '2827.52', '0', ''),
(5, '1458', '2020-10-12', 8, '1', 'credit', '', '', '0.00', 'Posted', 'active', '18405.20', '0.00', '18405.20', '0', ''),
(6, '1459', '2020-10-12', 9, '1', 'credit', '', '', '0.00', 'Posted', 'active', '1200.00', '180.00', '1380.00', '0', ''),
(7, '1460', '2020-10-12', 10, '1', 'credit', '', '', '0.00', 'Posted', 'active', '1200.00', '180.00', '1380.00', '0', ''),
(8, '1461', '2020-10-12', 12, '1', 'credit', '', '', '0.00', 'Posted', 'active', '3100.00', '465.00', '3565.00', '0', ''),
(9, '1462', '2020-10-12', 13, '1', 'credit', '', '', '0.00', 'Posted', 'active', '2763.60', '0.00', '2763.60', '0', ''),
(10, '1463', '2020-10-12', 14, '1', 'credit', '', '', '0.00', 'Posted', 'active', '1485.20', '0.00', '1485.20', '0', ''),
(11, '1464', '2020-10-13', 11, '1', 'credit', '', '', '0.00', 'Posted', 'active', '1200.00', '180.00', '1380.00', '0', ''),
(12, '1465', '2020-10-14', 15, '1', 'credit', '', '', '0.00', 'Posted', 'active', '1200.00', '180.00', '1380.00', '0', ''),
(13, '1466', '2020-10-15', 16, '1', 'credit', '', '', '0.00', 'Posted', 'active', '1200.00', '180.00', '1380.00', '0', ''),
(14, '1467', '2020-10-15', 17, '1', 'credit', '', '', '0.00', 'Posted', 'active', '1200.00', '180.00', '1380.00', '0', ''),
(15, '1468', '2020-10-15', 18, '1', 'credit', '', '', '0.00', 'Posted', 'active', '5301.60', '0.00', '5301.60', '0', ''),
(16, '1469', '2020-10-18', 21, '1', 'credit', '', '', '0.00', 'Posted', 'active', '1200.00', '180.00', '1380.00', '0', ''),
(17, '1470', '2020-10-18', 22, '1', 'credit', '', '', '0.00', 'Posted', 'active', '9243.58', '0.00', '9243.58', '0', ''),
(18, '1471', '2020-10-18', 7, '1', 'credit', '', '', '0.00', 'Posted', 'active', '7563.00', '720.00', '8283.00', '0', ''),
(19, '1472', '2020-10-19', 27, '1', 'credit', '', '', '0.00', 'Posted', 'active', '9098.43', '930.00', '10028.43', '0', ''),
(20, '1473', '2020-10-19', 28, '1', 'credit', '', '', '0.00', 'Posted', 'active', '22560.97', '1305.00', '23865.97', '0', ''),
(21, '1474', '2020-10-19', 20, '1', 'credit', '', '', '0.00', 'Posted', 'active', '8493.50', '135.00', '8628.50', '0', ''),
(22, '1475', '2020-10-20', 26, '1', 'credit', '', '', '0.00', 'Posted', 'active', '4450.00', '180.00', '4630.00', '0', ''),
(23, '1476', '2020-10-20', 29, '1', 'credit', '', '', '0.00', 'Posted', 'active', '2500.00', '375.00', '2875.00', '0', ''),
(24, '1477', '2020-10-20', 30, '1', 'credit', '', '', '0.00', 'Posted', 'active', '27410.40', '0.00', '27410.40', '0', ''),
(25, '1478', '2020-10-21', 33, '1', 'credit', '', '', '0.00', 'Posted', 'active', '2632.00', '0.00', '2632.00', '0', ''),
(26, '1479', '2020-10-22', 34, '1', 'credit', '', '', '0.00', 'Posted', 'active', '1200.00', '180.00', '1380.00', '0', ''),
(27, '1480', '2020-10-22', 35, '1', 'credit', '', '', '0.00', 'Posted', 'active', '4324.00', '0.00', '4324.00', '0', ''),
(28, '1481', '2020-10-25', 37, '1', 'credit', '', '', '0.00', 'Posted', 'active', '1200.00', '180.00', '1380.00', '0', ''),
(29, '1482', '2020-10-26', 38, '1', 'credit', '', '', '0.00', 'Posted', 'active', '1200.00', '180.00', '1380.00', '0', ''),
(30, '1483', '2020-10-26', 39, '1', 'credit', '', '', '0.00', 'Posted', 'active', '3300.00', '495.00', '3795.00', '0', ''),
(31, '1484', '2020-10-26', 40, '1', 'credit', '', '', '0.00', 'Posted', 'active', '10722.77', '0.00', '10722.77', '0', ''),
(32, '1485', '2020-10-26', 41, '1', 'credit', '', '', '0.00', 'Paid', 'active', '200.00', '0.00', '200.00', '0', ''),
(33, '1486', '2020-10-26', 43, '1', 'credit', '', '', '0.00', 'Paid', 'active', '470.00', '70.50', '540.50', '0', ''),
(34, '1487', '2020-10-27', 43, '1', 'credit', '', '', '0.00', 'Paid', 'active', '402.50', '0.00', '402.50', '0', ''),
(35, '1488', '2020-10-28', 44, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '16511.66', '0.00', '16511.66', '0', ''),
(36, '1489', '2020-10-28', 19, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '10742.68', '255.00', '10997.68', '0', ''),
(37, '1490', '2020-10-28', 5, '1', 'credit', '', '', '0.00', 'Posted', 'active', '1109.20', '0.00', '1109.20', '0', ''),
(38, '1491', '2020-10-29', 6, '1', 'credit', '', '', '0.00', 'Posted', 'active', '1880.00', '0.00', '1880.00', '0', ''),
(39, '1492', '2020-10-29', 45, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1400.00', '210.00', '1610.00', '0', ''),
(40, '1493', '2020-10-31', 46, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '14607.60', '0.00', '14607.60', '0', ''),
(41, '1494', '2020-11-01', 47, '1', 'credit', '', '', '0.00', 'Posted', 'active', '2500.00', '375.00', '2875.00', '0', ''),
(42, '1495', '2020-11-01', 48, '1', 'credit', '', '', '0.00', 'Posted', 'active', '1200.00', '180.00', '1380.00', '0', ''),
(43, '1496', '2020-11-15', 49, '1', 'credit', '', '', '0.00', NULL, 'active', '3580.37', '265.50', '3845.87', '0', ''),
(44, '1497', '2020-11-09', 56, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '5380.47', '0.00', '5380.47', '0', ''),
(45, '1498', '2020-11-08', 56, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1500.00', '225.00', '1725.00', '0', ''),
(46, '1499', '2020-11-08', 57, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1200.00', '180.00', '1380.00', '0', ''),
(47, '1500', '2020-11-08', 58, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '19174.20', '1339.50', '20513.70', '0', ''),
(48, '1501', '2020-11-09', 61, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '3335.75', '210.00', '3545.75', '0', ''),
(51, '1503', '2020-11-09', 54, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '33970.10', '1579.20', '35549.30', '0', ''),
(50, '1502', '2020-11-09', 62, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '2331.20', '0.00', '2331.20', '0', ''),
(52, '1504', '2020-11-15', 55, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12762.51', '225.60', '12988.11', '0', ''),
(53, '1505', '2020-11-11', 69, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '4295.97', '135.00', '4430.97', '0', ''),
(54, '1506', '2020-11-11', 70, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '7986.67', '840.00', '8826.67', '0', ''),
(55, '1507', '2020-11-11', 71, '1', 'credit', '', '', '0.00', 'Paid', 'active', '24219.34', '0.00', '24219.34', '0', ''),
(56, '1508', '2020-11-12', 72, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '18624.49', '165.00', '18789.49', '0', ''),
(57, '1509', '2020-11-15', 63, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '658.00', '0.00', '658.00', '0', ''),
(58, '1510', '2020-11-15', 64, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '7533.00', '0.00', '7533.00', '0', ''),
(59, '1511', '2020-11-17', 65, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1581.00', '0.00', '1581.00', '0', ''),
(60, '1512', '2020-11-17', 66, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '3600.76', '0.00', '3600.76', '0', ''),
(61, '1513', '2020-11-12', 67, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1955.20', '0.00', '1955.20', '0', ''),
(62, '1514', '2020-11-12', 73, '1', 'credit', '', '', '0.00', NULL, 'active', '11531.85', '0.00', '11531.85', '0', ''),
(63, '1515', '2020-11-12', 75, '1', 'credit', '', '', '0.00', NULL, 'active', '200.00', '0.00', '200.00', '0', ''),
(64, '1516', '2020-11-12', 76, '1', 'credit', '', '', '0.00', 'Paid', 'active', '4351.30', '0.00', '4351.30', '0', ''),
(65, '1517', '2020-11-15', 50, '1', 'credit', '', '', '0.00', NULL, 'active', '8109.10', '250.50', '8359.60', '0', ''),
(66, '1518', '2020-11-15', 51, '1', 'credit', '', '', '0.00', NULL, 'active', '3176.00', '235.50', '3411.50', '0', ''),
(67, '1519', '2020-11-15', 52, '1', 'credit', '', '', '0.00', NULL, 'active', '4868.64', '265.50', '5134.14', '0', ''),
(68, '1520', '2020-11-15', 53, '1', 'credit', '', '', '0.00', NULL, 'active', '2157.36', '205.50', '2362.86', '0', ''),
(69, '1521', '2020-11-15', 78, '1', 'credit', '', '', '0.00', NULL, 'active', '3599.20', '265.50', '3864.70', '0', ''),
(70, '1522', '2020-11-15', 79, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '2795.50', '235.50', '3031.00', '0', ''),
(71, '1523', '2020-11-16', 71, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '37943.48', '3772.50', '41715.98', '0', ''),
(72, '1524', '2020-11-16', 77, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '7864.04', '0.00', '7864.04', '0', ''),
(73, '1525', '2020-11-16', 23, '1', 'credit', '', '', '0.00', NULL, 'active', '39054.64', '205.50', '39260.14', '0', ''),
(74, '1526', '2020-11-16', 80, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '17018.70', '0.00', '17018.70', '0', ''),
(75, '1527', '2020-11-16', 81, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1200.00', '180.00', '1380.00', '0', ''),
(76, '1528', '2020-11-16', 82, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '7159.04', '0.00', '7159.04', '0', ''),
(77, '1529', '2020-11-16', 83, '1', 'credit', '', '', '0.00', NULL, 'active', '200.00', '0.00', '200.00', '0', ''),
(78, '1530', '2020-11-17', 84, '1', 'credit', '', '', '0.00', 'Paid', 'active', '9398.20', '225.00', '9623.20', '0', ''),
(79, '1531', '2020-11-17', 85, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '3537.46', '135.00', '3672.46', '0', ''),
(80, '1532', '2020-11-17', 86, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '3490.70', '135.00', '3625.70', '0', ''),
(81, '1533', '2020-11-17', 87, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '3158.30', '135.00', '3293.30', '0', ''),
(82, '1534', '2020-11-18', 88, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '3388.63', '195.00', '3583.63', '0', ''),
(83, '1535', '2020-11-21', 89, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1527.00', '157.50', '1684.50', '0', ''),
(84, '1536', '2020-11-22', 68, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '6068.20', '180.00', '6248.20', '0', ''),
(85, '1537', '2020-11-22', 93, '1', 'credit', '', '', '0.00', 'Paid', 'active', '11487.55', '1500.00', '12987.55', '0', ''),
(86, '1538', '2020-11-22', 90, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '7650.00', '1147.50', '8797.50', '0', ''),
(87, '1539', '2020-11-22', 91, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1200.00', '180.00', '1380.00', '0', ''),
(88, '1540', '2020-11-24', 92, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1200.00', '180.00', '1380.00', '0', ''),
(89, '1541', '2020-11-25', 95, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '928.00', '97.50', '1025.50', '0', ''),
(90, '1542', '2020-11-25', 94, '1', 'credit', '', '', '0.00', 'Posted', 'active', '6773.70', '195.00', '6968.70', '0', ''),
(91, '1543', '2020-11-26', 96, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '6239.00', '588.00', '6827.00', '0', ''),
(92, '1544', '2020-11-26', 97, '1', 'credit', '', '', '0.00', 'Posted', 'active', '3637.52', '265.50', '3903.02', '0', ''),
(93, '1545', '2020-11-29', 98, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '650.00', '97.50', '747.50', '0', ''),
(94, '1546', '2022-03-01', 128, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '2300.00', '46.00', '2346.00', '0', ''),
(95, '1546', '2022-03-01', 128, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '2300.00', '46.00', '2346.00', '0', ''),
(96, '1547', '2022-03-01', 128, '1', 'cash', '21212', '', '0.00', 'Drafted', 'active', '19434.00', '388.68', '19822.68', '0', ''),
(97, '1548', '2022-03-01', 129, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '150548.00', '3010.96', '153558.96', '0', ''),
(98, '1549', '2022-03-02', 128, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '3450.00', '69.00', '3519.00', '0', ''),
(99, '1549', '2022-03-02', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '3450.00', '69.00', '3519.00', '0', ''),
(211, '1571', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.12', '1.12', '0', ''),
(187, '1551', '2022-03-03', 130, '3', 'credit', '', '', '0.00', 'Drafted', 'active', '300200.00', '6400.00', '306600.00', '0', ''),
(186, '1551', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '200.00', '400.00', '600.00', '0', ''),
(185, '1550', '2022-03-03', 130, '1', 'credit', NULL, NULL, NULL, 'Drafted', 'active', '810615.00', '16182.30', '826797.00', '0', ''),
(207, '1567', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.20', '1.20', '0', ''),
(208, '1568', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.01', '1.01', '0', ''),
(209, '1569', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.02', '1.02', '0', ''),
(210, '1570', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.10', '1.10', '0', ''),
(188, '1551', '2022-03-03', 130, '3', 'cash', '89596526', '', '0.00', 'Drafted', 'active', '300200.00', '6400.00', '306600.00', '0', ''),
(189, '1552', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '2400.00', '48.00', '2448.00', '0', ''),
(190, '1553', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '532000.00', '10640.00', '542640.00', '0', ''),
(191, '1554', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '2000.00', '40.00', '2040.00', '0', ''),
(192, '1555', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '2000.00', '20.00', '2020.00', '0', ''),
(193, '1555', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '2000.00', '20.00', '2020.00', '0', ''),
(194, '1555', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '2000.00', '20.00', '2020.00', '0', ''),
(195, '1556', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '2400.00', '24.00', '2424.00', '0', ''),
(196, '1557', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '240.00', '2.40', '242.40', '0', ''),
(197, '1558', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '10.00', '0.10', '10.10', '0', ''),
(198, '1559', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '10.00', '0.10', '10.10', '0', ''),
(199, '1560', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '10.00', '0.50', '10.50', '0', ''),
(200, '1561', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.01', '1.01', '0', ''),
(201, '1562', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '100.00', '1.00', '101.00', '0', ''),
(202, '1562', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '100.00', '1.00', '101.00', '0', ''),
(203, '1563', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '122.00', '1.22', '123.22', '0', ''),
(204, '1564', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.01', '1.01', '0', ''),
(205, '1565', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.01', '1.01', '0', ''),
(206, '1566', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '10.00', '1.00', '11.00', '0', ''),
(212, '1572', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.01', '1.01', '0', ''),
(213, '1573', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.10', '1.10', '0', ''),
(214, '1574', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.11', '1.11', '0', ''),
(215, '1575', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '2.00', '0.04', '2.04', '0', ''),
(216, '1576', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.01', '1.01', '0', ''),
(217, '1577', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.01', '1.01', '0', ''),
(218, '1578', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '2.00', '4.44', '6.44', '0', ''),
(219, '1579', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.11', '1.11', '0', ''),
(220, '1580', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '22.00', '4.84', '26.84', '0', ''),
(221, '1581', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '90.00', '91.00', '0', ''),
(222, '1582', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '11.00', '1.21', '12.21', '0', ''),
(223, '1583', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.12', '1.12', '0', ''),
(224, '1584', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '2.00', '0.04', '2.04', '0', ''),
(225, '1585', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '2.76', '14.76', '0', ''),
(226, '1586', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.11', '1.11', '0', ''),
(227, '1586', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.11', '1.11', '0', ''),
(228, '1587', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '1.44', '13.44', '0', ''),
(229, '1588', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '13.32', '25.32', '0', ''),
(230, '1589', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '123.00', '41.82', '164.82', '0', ''),
(231, '1590', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.01', '1.01', '0', ''),
(232, '1591', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '20.00', '21.00', '0', ''),
(233, '1592', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.01', '1.01', '0', ''),
(234, '1593', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '2.00', '160.00', '162.00', '0', ''),
(235, '1594', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '111.00', '123.21', '234.21', '0', ''),
(236, '1595', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '1.23', '2.23', '0', ''),
(237, '1596', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '50.00', '51.00', '0', ''),
(238, '1597', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '122.00', '390.40', '512.40', '0', ''),
(239, '1598', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '123.00', '615.00', '738.00', '0', ''),
(240, '1598', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '123.00', '615.00', '738.00', '0', ''),
(241, '1599', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '50.00', '200.00', '250.00', '0', ''),
(242, '1600', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '60.00', '72.00', '0', ''),
(243, '1600', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '60.00', '72.00', '0', ''),
(244, '1601', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '69.84', '81.84', '0', ''),
(245, '1602', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '102.00', '114.00', '0', ''),
(246, '1603', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '60.00', '72.00', '0', ''),
(247, '1604', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '6.96', '18.96', '0', ''),
(248, '1605', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '12.00', '24.00', '0', ''),
(249, '1605', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '12.00', '24.00', '0', ''),
(250, '1605', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '12.00', '24.00', '0', ''),
(251, '1606', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '10.20', '22.20', '0', ''),
(252, '1607', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(253, '1608', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '64.80', '76.80', '0', ''),
(254, '1609', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '24.00', '36.00', '0', ''),
(255, '1610', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '6.00', '18.00', '0', ''),
(256, '1611', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '10.20', '22.20', '0', ''),
(257, '1612', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '10.56', '22.56', '0', ''),
(258, '1613', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '2.50', '3.50', '0', ''),
(259, '1614', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.06', '1.06', '0', ''),
(260, '1615', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '23.00', '2.76', '25.76', '0', ''),
(261, '1616', '2022-03-03', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '123.00', '6396.00', '6519.00', '0', ''),
(262, '1617', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '6.00', '18.00', '0', ''),
(263, '1618', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '6.96', '18.96', '0', ''),
(264, '1619', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '69.84', '81.84', '0', ''),
(265, '1619', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '69.84', '81.84', '0', ''),
(266, '1620', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '123.00', '151.29', '274.29', '0', ''),
(267, '1621', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '60.00', '72.00', '0', ''),
(268, '1622', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '48.00', '8.04', '56.04', '0', ''),
(269, '1622', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '48.00', '8.04', '56.04', '0', ''),
(270, '1622', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '48.00', '8.04', '56.04', '0', ''),
(271, '1623', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '0.00', '0.00', '0.00', '0', ''),
(272, '1624', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '1.20', '13.20', '0', ''),
(273, '1625', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '11.00', '1.21', '12.21', '0', ''),
(274, '1626', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '23.00', '12.42', '35.42', '0', ''),
(275, '1627', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '65.00', '33.80', '98.80', '0', ''),
(276, '1628', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '20.00', '4.00', '24.00', '0', ''),
(277, '1629', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '20.00', '4.00', '24.00', '0', ''),
(278, '1630', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '6.00', '18.00', '0', ''),
(279, '1631', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(280, '1632', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '20.00', '4.00', '24.00', '0', ''),
(281, '1633', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '6.00', '18.00', '0', ''),
(282, '1634', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '35.00', '12.25', '47.25', '0', ''),
(283, '1635', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '52.00', '26.00', '78.00', '0', ''),
(284, '1636', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '0.00', '1.44', '13.44', '0', ''),
(285, '1637', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '782.00', '667.00', '1449.00', '0', ''),
(286, '1638', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '0.00', '0.65', '1.65', '0', ''),
(287, '1639', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '6.00', '18.00', '0', ''),
(288, '1640', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '6.24', '18.24', '0', ''),
(289, '1641', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1032.00', '662.52', '1694.52', '0', ''),
(290, '1642', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '6.24', '18.24', '0', ''),
(291, '1643', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '14.76', '26.76', '0', ''),
(292, '1644', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '5.00', '33.10', '38.10', '0', ''),
(293, '1645', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '6.24', '18.24', '0', ''),
(294, '1646', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '4.08', '16.08', '0', ''),
(295, '1647', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '4.20', '16.20', '0', ''),
(296, '1648', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '35.00', '5.16', '40.16', '0', ''),
(297, '1649', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.12', '12.12', '0', ''),
(298, '1650', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '40.00', '10.00', '50.00', '0', ''),
(299, '1651', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.35', '1.35', '0', ''),
(300, '1652', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '64.00', '19.16', '83.16', '0', ''),
(301, '1653', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '47.00', '22.39', '69.39', '0', ''),
(302, '1654', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '11.00', '1.21', '12.21', '0', ''),
(303, '1655', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '3.60', '15.60', '0', ''),
(304, '1656', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '2.64', '14.64', '0', ''),
(305, '1657', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '2.76', '14.76', '0', ''),
(306, '1658', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '2.76', '14.76', '0', ''),
(307, '1659', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '2.76', '14.76', '0', ''),
(308, '1660', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '24.00', '2.88', '26.88', '0', ''),
(309, '1661', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '35.00', '13.11', '48.11', '0', ''),
(310, '1662', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '24.00', '7.44', '31.44', '0', ''),
(311, '1663', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '24.00', '6.72', '30.72', '0', ''),
(312, '1664', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '2.64', '14.64', '0', ''),
(313, '1665', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.24', '12.24', '0', ''),
(314, '1666', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.12', '12.12', '0', ''),
(315, '1667', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.12', '12.12', '0', ''),
(316, '1668', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.36', '12.36', '0', ''),
(317, '1669', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.36', '12.36', '0', ''),
(318, '1670', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '22.00', '4.84', '26.84', '0', ''),
(319, '1671', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '2.64', '14.64', '0', ''),
(320, '1672', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '23.00', '2.76', '25.76', '0', ''),
(321, '1673', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '1.44', '13.44', '0', ''),
(322, '1674', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.24', '12.24', '0', ''),
(323, '1675', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.01', '1.01', '0', ''),
(324, '1676', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.01', '1.01', '0', ''),
(325, '1677', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.12', '12.12', '0', ''),
(326, '1678', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '13.00', '0.13', '13.13', '0', ''),
(327, '1679', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '13.00', '2.77', '15.77', '0', ''),
(328, '1680', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.12', '12.12', '0', ''),
(329, '1681', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(330, '1682', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.12', '12.12', '0', ''),
(331, '1683', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '24.00', '8.28', '32.28', '0', ''),
(332, '1684', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '35.00', '7.94', '42.94', '0', ''),
(333, '1685', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '13.00', '0.12', '13.12', '0', ''),
(334, '1686', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '13.00', '0.13', '13.13', '0', ''),
(335, '1687', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(336, '1688', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(337, '1689', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '1.22', '13.22', '0', ''),
(338, '1690', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(339, '1691', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '11.00', '0.00', '11.00', '0', ''),
(340, '1692', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '13.00', '0.00', '13.00', '0', ''),
(341, '1693', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(342, '1694', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '13.00', '0.01', '13.01', '0', ''),
(343, '1695', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '3.60', '15.60', '0', ''),
(344, '1696', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '24.00', '0.12', '24.12', '0', ''),
(345, '1697', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '2.00', '0.00', '2.00', '0', ''),
(346, '1698', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '2.00', '0.00', '2.00', '0', ''),
(347, '1699', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '5.00', '0.00', '5.00', '0', ''),
(348, '1700', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '13.00', '0.00', '13.00', '0', ''),
(349, '1701', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(350, '1702', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(351, '1703', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '13.00', '0.12', '13.12', '0', ''),
(352, '1704', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '24.00', '0.12', '24.12', '0', ''),
(353, '1705', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '24.00', '0.12', '24.12', '0', ''),
(354, '1706', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '24.00', '0.00', '24.00', '0', ''),
(355, '1707', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '24.00', '0.00', '24.00', '0', ''),
(356, '1708', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '2.00', '0.00', '2.00', '0', ''),
(357, '1709', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(358, '1710', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(359, '1711', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(360, '1712', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(361, '1713', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(362, '1714', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '24.00', '0.00', '24.00', '0', ''),
(363, '1715', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(364, '1716', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.12', '12.12', '0', ''),
(365, '1717', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(366, '1718', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(367, '1719', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(368, '1720', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(369, '1721', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.01', '1.01', '0', ''),
(370, '1722', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(371, '1723', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(372, '1724', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(373, '1725', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(374, '1726', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(375, '1727', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(376, '1728', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(377, '1729', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '23.00', '0.00', '23.00', '0', ''),
(378, '1730', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(379, '1731', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(380, '1732', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(381, '1733', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(382, '1734', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(383, '1735', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(384, '1736', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(385, '1737', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '24.00', '0.00', '24.00', '0', ''),
(386, '1738', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(387, '1739', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '38.00', '0.00', '38.00', '0', ''),
(388, '1740', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '4.00', '0.00', '4.00', '0', ''),
(389, '1741', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '35.00', '0.00', '35.00', '0', ''),
(390, '1742', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(391, '1743', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(392, '1744', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '123.00', '0.00', '123.00', '0', ''),
(393, '1745', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(394, '1746', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '24.00', '0.00', '24.00', '0', ''),
(395, '1747', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(396, '1748', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(397, '1749', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '14.00', '0.00', '14.00', '0', ''),
(398, '1750', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(399, '1751', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(400, '1752', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(401, '1753', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(402, '1754', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(403, '1755', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(404, '1756', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(405, '1757', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(406, '1758', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(407, '1759', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(408, '1760', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(409, '1761', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '52.00', '0.00', '52.00', '0', ''),
(410, '1762', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(411, '1763', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(412, '1764', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(413, '1765', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(414, '1766', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(415, '1767', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(416, '1768', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(417, '1769', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(418, '1770', '2022-03-04', 6, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(419, '1771', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.12', '12.12', '0', ''),
(420, '1772', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(421, '1773', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(422, '1774', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '1.20', '13.20', '0', ''),
(423, '1775', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.01', '1.01', '0', ''),
(424, '1776', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(425, '1777', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(426, '1778', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(427, '1779', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(428, '1780', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '0', ''),
(429, '1781', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '3.00', '0.00', '3.00', '0', ''),
(430, '1782', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '0.00', '0.00', '0.00', '0', ''),
(431, '1783', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(432, '1784', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(433, '1785', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(434, '1786', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '0', ''),
(435, '1787', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '', ''),
(436, '1788', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '', ''),
(437, '1789', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '4', ''),
(438, '1790', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '0.00', '0.00', '0.00', '4', ''),
(439, '1791', '2022-03-04', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '4', ''),
(440, 'INV/2022/03/1792', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.12', '12.12', '4', ''),
(441, 'INV/2022/03/1793', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '1.00', '0.00', '1.00', '4', ''),
(442, 'INV/2022/03/1794', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.00', '12.00', '4', ''),
(443, 'INV/2022/03/1795', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '2.00', '0.00', '2.00', '4', ''),
(444, 'INV/2022/03/1796', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '24.00', '0.00', '24.00', '4', ''),
(445, 'INV/2022/03/1797', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '3.00', '0.00', '3.00', '4', ''),
(446, 'INV/2022/03/1798', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '13.00', '0.00', '13.00', '4', ''),
(447, 'INV/2022/03/1799', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '13.00', '0.00', '13.00', '4', ''),
(448, 'INV/2022/03/1800', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '13.00', '0.00', '13.00', '4', ''),
(449, 'INV/2022/03/1801', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '24.00', '0.00', '24.00', '4', ''),
(450, 'INV/2022/03/1802', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '23.00', '0.00', '23.00', '4', ''),
(451, 'INV/2022/03/1803', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '35.00', '0.00', '35.00', '4', ''),
(452, 'INV/2022/03/1804', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '24.00', '0.00', '24.00', '4', ''),
(453, 'INV/2022/03/1805', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '36.00', '0.00', '36.00', '4', ''),
(454, 'INV/2022/03/1806', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '2.40', '14.40', '4', ''),
(455, 'INV/2022/03/1807', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '13.00', '0.00', '13.00', '4', ''),
(456, 'INV/2022/03/1808', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '1.44', '13.44', '4', ''),
(457, 'INV/2022/03/1809', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '20.00', '4.00', '24.00', '4', ''),
(458, 'INV/2022/03/1810', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '97.00', '25.20', '122.20', '4', ''),
(459, 'INV/2022/03/1811', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '24.00', '6.00', '30.00', '4', ''),
(460, 'INV/2022/03/1812', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '139.00', '39.62', '178.62', '4', ''),
(461, 'INV/2022/03/1813', '2022-03-05', 130, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '62.00', '17.40', '79.40', '4', ''),
(492, 'INV/2022/03/1814', '2022-03-08', 146, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '122.00', '61.00', '183.00', '4', ''),
(493, 'INV/2022/03/1815', '2022-03-09', 148, '1', 'credit', '', '', '0.00', 'Drafted', 'active', '12.00', '0.12', '12.12', '4', '');

-- --------------------------------------------------------

--
-- Table structure for table `jm_job`
--

DROP TABLE IF EXISTS `jm_job`;
CREATE TABLE IF NOT EXISTS `jm_job` (
  `JobId` int(11) NOT NULL AUTO_INCREMENT,
  `Number` longtext DEFAULT NULL,
  `Jobcode` longtext NOT NULL,
  `Date` text DEFAULT NULL,
  `Shipper` text DEFAULT NULL,
  `Consignee` text DEFAULT NULL,
  `client_name` text DEFAULT NULL,
  `Type` text DEFAULT NULL,
  `ShipmentTerms` varchar(200) DEFAULT NULL,
  `shipment_type` text DEFAULT NULL,
  `CargoDescription` text DEFAULT NULL,
  `Origin` text DEFAULT NULL,
  `Destination` text DEFAULT NULL,
  `Etd` text DEFAULT NULL,
  `Eta` text DEFAULT NULL,
  `Carrier` text DEFAULT NULL,
  `NoContainers` int(11) DEFAULT NULL,
  `TruckNo` text DEFAULT NULL,
  `ContainerNo` text DEFAULT NULL,
  `ContType` text DEFAULT NULL,
  `Hbl` text DEFAULT NULL,
  `Mbl` text DEFAULT NULL,
  `PoNo` text DEFAULT NULL,
  `Pod` text DEFAULT NULL,
  `Pol` text DEFAULT NULL,
  `Mawb` text DEFAULT NULL,
  `Hawb` text DEFAULT NULL,
  `Nopcs` text DEFAULT NULL,
  `ActualWeight` text DEFAULT NULL,
  `ChargeableWeight` text DEFAULT NULL,
  `Dimension` text DEFAULT NULL,
  `BayanNo` text DEFAULT NULL,
  `BayanDate` text DEFAULT NULL,
  `Status` text DEFAULT NULL,
  `JobStatus` text DEFAULT NULL,
  `PoP` text DEFAULT NULL,
  `LabUndertaking` text DEFAULT NULL,
  `DocsGuarantee` text DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `salesman` text DEFAULT NULL,
  `consignor_id` int(11) NOT NULL,
  `consignee_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`JobId`)
) ENGINE=MyISAM AUTO_INCREMENT=149 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jm_job`
--

INSERT INTO `jm_job` (`JobId`, `Number`, `Jobcode`, `Date`, `Shipper`, `Consignee`, `client_name`, `Type`, `ShipmentTerms`, `shipment_type`, `CargoDescription`, `Origin`, `Destination`, `Etd`, `Eta`, `Carrier`, `NoContainers`, `TruckNo`, `ContainerNo`, `ContType`, `Hbl`, `Mbl`, `PoNo`, `Pod`, `Pol`, `Mawb`, `Hawb`, `Nopcs`, `ActualWeight`, `ChargeableWeight`, `Dimension`, `BayanNo`, `BayanDate`, `Status`, `JobStatus`, `PoP`, `LabUndertaking`, `DocsGuarantee`, `Description`, `salesman`, `consignor_id`, `consignee_id`, `client_id`) VALUES
(130, '605', '', '2022-03-01', 'JFC CORPORATION', 'ALI GASHASH AL OMARI TRADING EST.', 'Flow Line Trading W L L', 'airexport', '', 'Export', NULL, 'a', 'a', '2022-03-01', '', 'EMIRATES', 0, '', '', '', '', NULL, '859', '', '', '176-85869321', 'aaa', '7845', '96852', '520', '352', '', '', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, 8, 2, 5),
(148, '616', 'FBL616-Energy Supply & Services Company (ESSCO)', '2022-03-08', 'BULMANN ROHR-FITTINGS STAHLHANDEL', 'BULMANN ROHR-FITTINGS STAHLHANDEL', 'Energy Supply & Services Company (ESSCO)', 'airexport', '', 'Export', NULL, 'A', 'B', '2022-03-08', '', 'SAUDI', 0, '', '', '', '', NULL, '', '', '', '065-', '', '', '', '', '', '', '', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, 1, 1, 2),
(144, '613', 'Gulf Petrolic International Est', '2022-03-07', 'NEXUS ALLOYS', 'ALI GASHASH AL OMARI TRADING EST.', 'Gulf Petrolic International Est', 'airexport', '', 'Export', NULL, '', '', '', '', 'select', 0, '', '', '', '', NULL, '', '', '', '-', '', '', '', '', '', '', '', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, 3, 2, 3),
(145, '614', 'Energy Supply & Services Company (ESSCO).614', '2022-03-07', 'ALI GASHASH AL OMARI TRADING EST.', 'BULMANN ROHR-FITTINGS STAHLHANDEL', 'Energy Supply & Services Company (ESSCO)', 'airexport', '', 'Export', NULL, '', '', '', '', 'select', 0, '', '', '', '', NULL, '', '', '', '-', '', '', '', '', '', '', '', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, 2, 1, 2),
(146, '615', 'Energy Supply & Services Company (ESSCO).615', '2022-03-07', 'BULMANN ROHR-FITTINGS STAHLHANDEL', 'BULMANN ROHR-FITTINGS STAHLHANDEL', 'Energy Supply & Services Company (ESSCO)', 'airexport', '', 'Export', NULL, 'A', 'B', '2022-03-07', '', 'EMIRATES', 0, '', '', '', '', NULL, '454', '', '', '176-85869321', 'a', '', '', '', '', '', '', 'OPEN', NULL, NULL, NULL, NULL, '', NULL, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `jm_receiptdetail`
--

DROP TABLE IF EXISTS `jm_receiptdetail`;
CREATE TABLE IF NOT EXISTS `jm_receiptdetail` (
  `ReceiptDetailId` int(11) NOT NULL AUTO_INCREMENT,
  `JobNo` varchar(50) DEFAULT NULL,
  `Amount` decimal(18,2) DEFAULT NULL,
  `Currency` varchar(50) DEFAULT NULL,
  `ConvFactor` decimal(18,2) DEFAULT NULL,
  `Total` decimal(18,2) DEFAULT NULL,
  `ReceiptMasterId` int(11) DEFAULT NULL,
  `InvoiceMasterID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ReceiptDetailId`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jm_receiptdetail`
--

INSERT INTO `jm_receiptdetail` (`ReceiptDetailId`, `JobNo`, `Amount`, `Currency`, `ConvFactor`, `Total`, `ReceiptMasterId`, `InvoiceMasterID`) VALUES
(2, '1', '1380.00', 'SAR', '1.00', '1380.00', 2, 1),
(3, '43', '540.50', 'SAR', '1.00', '540.50', 3, 33),
(4, '43', '402.50', 'SAR', '1.00', '402.50', 3, 34),
(5, '4', '2827.52', 'SAR', '1.00', '2827.52', 4, 4),
(6, '84', '10951.90', 'SAR', '1.00', '10951.90', 5, 78),
(7, '71', '24219.34', 'SAR', '1.00', '24219.34', 6, 55),
(8, '93', '12987.55', 'SAR', '1.00', '12987.55', 7, 85),
(9, '41', '200.00', 'SAR', '1.00', '200.00', 8, 32),
(10, '76', '4351.30', 'SAR', '1.00', '4351.30', 10, 64),
(11, '75', '200.00', 'SAR', '1.00', '200.00', 11, 63),
(12, '75', '200.00', 'SAR', '1.00', '200.00', 11, 63),
(13, '73', '11531.85', 'SAR', '1.00', '11531.85', 12, 62),
(14, '83', '200.00', 'SAR', '1.00', '200.00', 13, 77),
(15, '49', '3845.87', 'SAR', '1.00', '3845.87', 15, 43),
(16, '50', '8359.60', 'SAR', '1.00', '8359.60', 16, 65),
(17, '51', '3411.50', 'SAR', '1.00', '3411.50', 17, 66),
(18, '78', '3864.70', 'SAR', '1.00', '3864.70', 18, 69),
(19, '23', '39260.14', 'SAR', '1.00', '39260.14', 19, 73),
(20, '53', '2362.86', 'SAR', '1.00', '2362.86', 20, 68),
(21, '52', '5134.14', 'SAR', '1.00', '5134.14', 21, 67);

-- --------------------------------------------------------

--
-- Table structure for table `jm_receiptmaster`
--

DROP TABLE IF EXISTS `jm_receiptmaster`;
CREATE TABLE IF NOT EXISTS `jm_receiptmaster` (
  `ReceiptMasterId` int(11) NOT NULL AUTO_INCREMENT,
  `ID` int(50) DEFAULT NULL,
  `Date` varchar(50) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `SubTotal` decimal(18,2) DEFAULT NULL,
  `vatTotal` decimal(18,2) DEFAULT NULL,
  `ClientID` int(11) DEFAULT NULL,
  `Mode` text DEFAULT NULL,
  `ChequeNo` int(11) NOT NULL,
  `ChequeDate` date NOT NULL,
  `BankID` int(11) NOT NULL,
  `TransactionID` int(11) NOT NULL,
  `Userid` varchar(50) NOT NULL,
  PRIMARY KEY (`ReceiptMasterId`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jm_receiptmaster`
--

INSERT INTO `jm_receiptmaster` (`ReceiptMasterId`, `ID`, `Date`, `Status`, `SubTotal`, `vatTotal`, `ClientID`, `Mode`, `ChequeNo`, `ChequeDate`, `BankID`, `TransactionID`, `Userid`) VALUES
(2, 1, '2020-10-31', 'Paid', '1380.00', '0.00', 9, 'electronic', 0, '0000-00-00', 1, 0, ''),
(3, 2, '2020-11-03', 'Paid', '943.00', '0.00', 49, 'cash', 0, '0000-00-00', 1, 0, ''),
(4, 3, '2020-11-16', 'Paid', '2827.52', '0.00', 4, 'electronic', 0, '0000-00-00', 1, 0, ''),
(5, 4, '2020-11-21', 'Paid', '10951.90', '0.00', 21, 'electronic', 0, '0000-00-00', 1, 0, ''),
(6, 5, '2020-11-28', 'Paid', '24219.34', '0.00', 49, 'cash', 0, '0000-00-00', 1, 0, ''),
(7, 6, '2020-11-28', 'Paid', '12987.55', '0.00', 51, 'electronic', 0, '0000-00-00', 1, 0, ''),
(8, 7, '2022-02-24', 'Paid', '200.00', '0.00', 1, 'cash', 0, '0000-00-00', 1, 0, ''),
(9, 8, '2022-02-24', 'Paid', '0.00', '0.00', 1, 'cash', 0, '0000-00-00', 1, 0, ''),
(10, 9, '2022-02-24', 'Paid', '4351.30', '0.00', 1, '', 0, '0000-00-00', 1, 0, ''),
(11, 10, '2022-02-24', 'Paid', '400.00', '0.00', 1, 'cash', 0, '0000-00-00', 1, 0, ''),
(12, 11, '2022-02-24', 'Paid', '11531.85', '0.00', 1, 'cash', 0, '0000-00-00', 1, 0, ''),
(13, 12, '2022-02-24', 'Paid', '200.00', '0.00', 1, '', 0, '0000-00-00', 1, 0, ''),
(14, 13, '2022-02-24', 'Paid', '0.00', '0.00', 1, '', 0, '0000-00-00', 1, 0, ''),
(15, 14, '2022-02-24', 'Paid', '3845.87', '0.00', 2, 'cash', 0, '0000-00-00', 1, 0, ''),
(16, 15, '2022-02-24', 'Paid', '8359.60', '0.00', 2, 'cash', 0, '0000-00-00', 1, 0, ''),
(17, 16, '2022-02-24', 'Paid', '3411.50', '0.00', 2, 'cash', 0, '0000-00-00', 1, 0, ''),
(18, 17, '2022-02-24', 'Paid', '3864.70', '0.00', 2, 'cash', 0, '0000-00-00', 1, 0, ''),
(19, 18, '2022-02-24', 'Paid', '39260.14', '0.00', 2, 'cash', 0, '0000-00-00', 1, 0, ''),
(20, 19, '2022-02-24', 'Paid', '2362.86', '0.00', 2, '', 0, '0000-00-00', 1, 0, ''),
(21, 20, '2022-02-24', 'Paid', '5134.14', '0.00', 2, 'cash', 0, '0000-00-00', 1, 0, ''),
(22, 21, '2022-03-04', 'Paid', '19603.00', '0.00', 3, '', 0, '0000-00-00', 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `jm_supplierpaymentdetail`
--

DROP TABLE IF EXISTS `jm_supplierpaymentdetail`;
CREATE TABLE IF NOT EXISTS `jm_supplierpaymentdetail` (
  `SupplierPaymentDetailId` int(11) NOT NULL AUTO_INCREMENT,
  `JobNo` varchar(50) DEFAULT NULL,
  `Amount` decimal(18,2) DEFAULT NULL,
  `Currency` varchar(50) DEFAULT NULL,
  `ConvFactor` decimal(18,2) DEFAULT NULL,
  `Total` decimal(18,2) DEFAULT NULL,
  `SupplierPaymentMasterId` int(11) DEFAULT NULL,
  `SupplierExpenseMasterID` int(11) DEFAULT NULL,
  PRIMARY KEY (`SupplierPaymentDetailId`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jm_supplierpaymentdetail`
--

INSERT INTO `jm_supplierpaymentdetail` (`SupplierPaymentDetailId`, `JobNo`, `Amount`, `Currency`, `ConvFactor`, `Total`, `SupplierPaymentMasterId`, `SupplierExpenseMasterID`) VALUES
(4, '23', '1915.76', '', '1.00', '1915.76', 4, 36),
(5, '54', '3985.10', '', '1.00', '3985.10', 5, 66),
(6, '55', '2517.51', '', '1.00', '2517.51', 5, 68),
(7, '68', '2520.00', '', '1.00', '2520.00', 6, 78),
(8, '5', '693.75', '', '1.00', '693.75', 7, 58),
(9, '70', '859.69', '', '1.00', '859.69', 7, 82),
(10, '28', '8263.35', '', '1.00', '8263.35', 8, 27),
(11, '27', '2151.04', '', '1.00', '2151.04', 8, 30),
(12, '58', '5917.50', '', '1.00', '5917.50', 8, 72),
(13, '71', '932.75', '', '1.00', '932.75', 9, 87),
(14, '71', '24219.34', '', '1.00', '24219.34', 10, 85),
(15, '43', '402.50', '', '1.00', '402.50', 11, 53),
(16, '57', '750.00', '', '1.00', '750.00', 12, 71),
(17, '8', '16874.88', '', '1.00', '16874.88', 13, 8),
(18, '56', '3468.75', '', '1.00', '3468.75', 13, 70),
(19, '63', '468.75', '', '1.00', '468.75', 13, 91),
(20, '22', '8530.91', '', '1.00', '8530.91', 14, 23),
(21, '23', '32559.60', '', '1.00', '32559.60', 14, 111),
(22, '54', '18989.14', '', '1.00', '18989.14', 15, 77),
(23, '55', '2129.25', '', '1.00', '2129.25', 15, 79),
(24, '81', '750.00', '', '1.00', '750.00', 16, 117),
(25, '72', '220.00', '', '1.00', '170.00', 16, 90),
(26, '93', '5487.00', '', '1.00', '5487.00', 17, 137),
(27, '40', '9623.27', '', '1.00', '9623.27', 18, 50),
(28, '44', '15812.97', '', '1.00', '15812.97', 18, 54),
(29, '19', '2949.71', '', '1.00', '2949.71', 18, 57),
(30, '67', '1575.00', '', '1.00', '1575.00', 18, 95),
(31, '77', '6517.50', '', '1.00', '6517.50', 18, 114),
(32, '97', '100.00', '', '1.00', '100.00', 19, 146),
(33, '90', '6600.00', '', '1.00', '6600.00', 20, 135),
(34, '91', '750.00', '', '1.00', '750.00', 20, 136),
(35, '92', '750.00', '', '1.00', '750.00', 20, 138),
(36, '130', '14.40', '', '1.00', '14.40', 25, 388),
(37, '130', '10.10', '', '1.00', '8.00', 25, 209);

-- --------------------------------------------------------

--
-- Table structure for table `jm_supplierpaymentmaster`
--

DROP TABLE IF EXISTS `jm_supplierpaymentmaster`;
CREATE TABLE IF NOT EXISTS `jm_supplierpaymentmaster` (
  `SupplierPaymentMasterId` int(11) NOT NULL AUTO_INCREMENT,
  `ID` int(50) DEFAULT NULL,
  `Date` varchar(50) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `SubTotal` decimal(18,2) DEFAULT NULL,
  `vatTotal` decimal(18,2) DEFAULT NULL,
  `SuplierID` int(11) DEFAULT NULL,
  `Mode` varchar(50) DEFAULT NULL,
  `ChequeNo` varchar(50) DEFAULT NULL,
  `ChequeDate` varchar(50) DEFAULT NULL,
  `BankId` int(11) DEFAULT NULL,
  `TransactionId` varchar(50) NOT NULL,
  `Userid` varchar(50) NOT NULL,
  PRIMARY KEY (`SupplierPaymentMasterId`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jm_supplierpaymentmaster`
--

INSERT INTO `jm_supplierpaymentmaster` (`SupplierPaymentMasterId`, `ID`, `Date`, `Status`, `SubTotal`, `vatTotal`, `SuplierID`, `Mode`, `ChequeNo`, `ChequeDate`, `BankId`, `TransactionId`, `Userid`) VALUES
(4, 1, '2020-10-26', 'Paid', '1915.76', '0.00', 66, 'electronic', '', '', 1, '', ''),
(5, 2, '2020-11-07', 'Paid', '6502.61', '0.00', 68, 'cash', '', '', 1, '', ''),
(6, 3, '2020-11-16', 'Paid', '2520.00', '0.00', 3, 'electronic', '', '', 1, 'TRANSFER', ''),
(7, 4, '2020-11-16', 'Paid', '1553.44', '0.00', 21, 'electronic', '', '', 1, 'TRANSFER', ''),
(8, 5, '2020-11-16', 'Paid', '16331.89', '0.00', 46, 'electronic', '', '', 1, 'TRANSFER', ''),
(9, 6, '2020-11-16', 'Paid', '932.75', '0.00', 66, 'cash', '', '', 1, '', ''),
(10, 7, '2020-11-16', 'Paid', '24219.34', '0.00', 13, 'cash', '', '', 1, '', ''),
(11, 8, '2020-11-16', 'Paid', '402.50', '0.00', 62, 'cash', '', '', 1, '', ''),
(12, 9, '2020-11-16', 'Paid', '750.00', '0.00', 16, 'cash', '', '', 1, '', ''),
(13, 10, '2020-11-21', 'Paid', '20812.38', '0.00', 27, 'electronic', '', '', 1, 'TRANSFER', ''),
(14, 11, '2020-11-21', 'Paid', '41090.51', '0.00', 63, 'electronic', '', '', 1, 'TRANSFER', ''),
(15, 12, '2020-11-21', 'Paid', '21118.39', '0.00', 30, 'electronic', '', '', 1, 'TRANSFER', ''),
(16, 13, '2020-11-21', 'Paid', '920.00', '0.00', 16, 'cash', '', '', 1, '', ''),
(17, 14, '2020-11-28', 'Paid', '5487.00', '0.00', 70, 'electronic', '', '', 1, 'TRANSFER', ''),
(18, 15, '2020-11-28', 'Paid', '36478.45', '0.00', 20, 'electronic', '', '', 1, 'TRANSFER', ''),
(19, 16, '2020-11-28', 'Paid', '100.00', '0.00', 65, 'cash', '', '', 1, '', ''),
(20, 17, '2020-11-28', 'Paid', '8100.00', '0.00', 16, 'cash', '', '', 1, '', ''),
(21, 18, '2022-02-24', 'Paid', '0.00', '0.00', 1, '', '', '', 1, '', ''),
(22, 19, '2022-02-24', 'Paid', '0.00', '0.00', 10, '', '', '', 1, '', ''),
(23, 20, '2022-02-24', 'Paid', '0.00', '0.00', 10, '', '', '', 1, '', ''),
(24, 21, '2022-02-25', 'Paid', '0.00', '0.00', 3, '', '', '', 1, '', ''),
(25, 22, '2022-03-08', 'Paid', '22.40', '0.00', 1, 'cash', '', '', 1, '', '4');

-- --------------------------------------------------------

--
-- Table structure for table `mst_bank`
--

DROP TABLE IF EXISTS `mst_bank`;
CREATE TABLE IF NOT EXISTS `mst_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `bank_name` text NOT NULL,
  `acc_type` text NOT NULL,
  `acc_number` text NOT NULL,
  `iban` text NOT NULL,
  `opening_bal` text NOT NULL,
  `other_info` text NOT NULL,
  `IsActive` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `bankledgerid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mst_bank`
--

INSERT INTO `mst_bank` (`id`, `code`, `bank_name`, `acc_type`, `acc_number`, `iban`, `opening_bal`, `other_info`, `IsActive`, `created_date`, `updated_at`, `bankledgerid`) VALUES
(1, 1, 'BANK NAME: ALINMA BANK', 'Saving', 'A/C No. : 7820238460400', 'IBAN : SA4705000067202384604000', '0.00', 'BENEFICIARY NAME : FERRYFOLKS TRADING EST', '1', '2021-11-10 10:24:33', '2021-11-09 22:23:27', 15),
(3, 2, 'HDFC Bank', 'savings', '7854693250', '', '25000', '', '1', '2022-03-02 09:24:53', '2022-03-02 09:24:53', 172);

-- --------------------------------------------------------

--
-- Table structure for table `mst_carrier`
--

DROP TABLE IF EXISTS `mst_carrier`;
CREATE TABLE IF NOT EXISTS `mst_carrier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carrier_type` text NOT NULL,
  `code` text DEFAULT NULL,
  `name` text NOT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL,
  `country` text NOT NULL,
  `telephone` text NOT NULL,
  `mobile` text NOT NULL,
  `fax` text NOT NULL,
  `email` text NOT NULL,
  `remarks` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `IsActive` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mst_carrier`
--

INSERT INTO `mst_carrier` (`id`, `carrier_type`, `code`, `name`, `contact`, `address`, `country`, `telephone`, `mobile`, `fax`, `email`, `remarks`, `created_at`, `updated_at`, `IsActive`) VALUES
(1, 'Land', '', 'land Arabia ', '', '', '', '', '', '', '', '', '2020-08-24 08:56:41', '2020-08-23 20:56:42', 1),
(2, 'Air', '103', 'air Arabia ', '', '', '', '', '', '', '', '', '2020-08-24 08:56:27', '2020-08-23 20:56:28', 1),
(3, 'Sea', '', 'sea Arabia ', '', '', '', '', '', '', '', '', '2020-08-23 20:31:11', NULL, 1),
(4, 'Transportation', '', 'Transportation Arabia ', '', '', '', '', '', '', '', '', '2020-08-23 20:31:37', NULL, 1),
(5, 'Air', '176', 'EMIRATES', '', '', '', '', '', '', '', '', '2020-10-24 06:45:23', NULL, 1),
(6, 'Air', '065', 'SAUDI', '', '', '', '', '', '', '', '', '2020-10-24 06:45:32', NULL, 1),
(7, 'Air', '615', 'DHL', '', '', '', '', '', '', '', '', '2020-11-10 22:18:41', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_client`
--

DROP TABLE IF EXISTS `mst_client`;
CREATE TABLE IF NOT EXISTS `mst_client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `name` text NOT NULL,
  `name_arabic` text NOT NULL,
  `contact_person` text NOT NULL,
  `contact_person_arabic` text NOT NULL,
  `address` text NOT NULL,
  `address_arabic` text NOT NULL,
  `vat_no` text NOT NULL,
  `country` text NOT NULL,
  `country_arabic` text NOT NULL,
  `remarks` text NOT NULL,
  `remarks_arabic` text NOT NULL,
  `vendor_id` text NOT NULL,
  `telephone` text NOT NULL,
  `mobile` text NOT NULL,
  `fax` text NOT NULL,
  `email` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `IsActive` int(11) NOT NULL,
  `trn_no` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mst_client`
--

INSERT INTO `mst_client` (`id`, `code`, `name`, `name_arabic`, `contact_person`, `contact_person_arabic`, `address`, `address_arabic`, `vat_no`, `country`, `country_arabic`, `remarks`, `remarks_arabic`, `vendor_id`, `telephone`, `mobile`, `fax`, `email`, `created_at`, `updated_at`, `IsActive`, `trn_no`) VALUES
(1, 1, 'ALI GASHASH AL OMARI TRADING EST', 'مؤسسة علي قشاش العمري التجارية', 'FAJIS', '', 'AL KHOBAR', '', '30041706610003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '013-8140279', '0509829004', '013-8140279', 'sales@ali-alomaritrading.com', '2020-09-15 10:18:45', '0000-00-00 00:00:00', 1, ''),
(2, 2, 'Energy Supply & Services Company (ESSCO)', ' (ESSCO) شركة إمدادات الطاقة والخدمات', 'Gaurav Sharma', '', 'Al-Khobar', '', '310089243700003', 'Saudi Arabia', 'المملكة العربية السعودية', '', '', '', '+966 13 867 6222', '+966 54 741 6784', '', 'gaurav.s@essco.com.sa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(3, 3, 'Gulf Petrolic International Est', 'مؤسسة الخليج للبترول الدولية', 'Suhail Imran', '', 'Dammam', '', '300934276500003', 'Saudi Arabia', 'المملكة العربية السعودية', '', '', '', '00966 13 857 8355', '00966 507454729', '00966 13 857 2881', 'suhail@petrolic.net', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(4, 4, 'Safe Arabia Trading & Contracting Co. Ltd.', 'شركة الآمن العربية للتجارة والمقاولات المحدودة', 'Asharaf A', '', 'Arab Business Tower | Abu Baker Siddiq Street\r\nP.O. Box :1105 | 31951 Al Jubail ', '', '310259261300003', 'Saudi Arabia', 'المملكة العربية السعودية', '', '', '', '+966 13 361 4096', '+966 50097392', '+966 13 363 1556', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(5, 5, 'Flow Line Trading W L L', 'W L L فلو لاين للتجارة', 'Asmeer T', '', 'Manama', '', '', 'Bahrain', 'البحرين', '', '', '', '0097334244320', '', '', 'Info@flowlinetrading.com ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(6, 6, 'JFC ARABIA COMPANY LTD', 'شركة جيه إف سي العربية المحدودة', 'Shijo Varghese', '', 'Jubail', '', '300549863600003', 'Saudi Arabia', 'المملكة العربية السعودية', '', '', '', '+966 13 3418453', '+966-591100730', '+966 13 3418354', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(7, 7, 'ALI BIN GASHASH AL UMARI TRADING AND CONTRACTING EST', 'مؤسسة علي بن قشاش العمري للتجارة والمقاولات', 'Sajeer T. V.', '', 'DAMMAM', '', '300417066100003', 'Saudi Arabia', 'المملكة العربية السعودية', '', '', '', '+966 13 832 0193/881 9903 -Ext. 100', '+966 546 189 119', '', 'sajeer@bgatesa.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(8, 8, 'BARTEC MIDDLE EAST LLC', '  L L C بارتيك الشرق الاوسط', 'Ratheesh Kelothidathil', '', 'PO Box 3685, Al Khobar 31952', '', '', 'Saudi Arabia', 'المملكة العربية السعودية', '', '', 'BKSAVID0014', '+966 13 8238101 x 107', '00966 506470355', '+966 13 8238102', 'Ratheesh.Kelothidathil@bartec.de', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(9, 10, 'GAS ARABIAN SERVICES CO.LTD', 'شركة خدمات الغاز العربي', 'MOHAN', '', 'Dammam', '', '300495046500003', 'SAUDI ARABIA', '300495046500003', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-10-18 06:28:39', '2020-10-18 03:58:39', 1, ''),
(10, 11, 'EZDEHAR INDUSTRIAL SERVICES EST', 'مؤسسة الإزدهار للخدمات الصناعية', '', '', 'DAMMAM, SAUDI ARABIA', '', '300549467700003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(11, 12, 'ARABIAN POWER ELECTRONICS COMPANY, KHOBAR', 'الشركة العربية للإلكترونيات', '', '', 'AL KHOBAR, DAMMAM', '', '300554059100003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(12, 13, 'INTERNATIONAL SOLUTIONS FOR INDUSTRIAL SERVICES CO.LTD', ' شركة الحلول الدولية للخدمات الصناعية ', '', '', 'JUBAIL', '', '300092418300003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(13, 14, 'FRONTLINE LOGISTICS-DAMMAM', 'لوجستيات الجبهة - الدمام', '', '', 'DAMMAM', '', '300092418300003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(14, 15, 'AL KAFAA TRADING COMPANY', 'شركة الكفاء التجارية', 'DARWIN', '', 'DAMMAM', '', '300506278800003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(15, 15, 'GULF ROAD OF CONSTRUCTION TRADING EST', 'GULF ROAD OF CONSTRUCTION TRADING EST', '', '', 'DAMMAM', '', '300429599300003', 'SAUDI ARABIA', '', '', '', '', '', '', '', '', '2020-11-24 10:46:21', '2020-11-23 20:16:18', 1, ''),
(49, 46, 'AL-BABTAIN PLASTIC & INSULATION MAT.CO. LTD', '', '', '', 'DAMMAM ', '', '', 'SAUDI ARABIA', '', '', '', '', '', '', '', '', '2020-10-25 23:11:16', '0000-00-00 00:00:00', 1, ''),
(16, 15, 'SAUDI ARABIAN FABRICATED METAL INDUSTRY (SAFAMI)', 'الشركة السعودية العربية لصناعة المعادن (سافامي) ', '', '', '', '', '300449966200003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(17, 16, 'ALMEER SAUDI TECHNICAL SERVICES CO.WLL', 'ALMEER SAUDI TECHNICAL SERVICES CO.WLL', '', '', '', '', '300513035600003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(18, 17, 'ABDULLAH AL BARRAK FACTORY FOR PLASTICS PRODUCTS', 'مصنع عبدالله البراك للمنتجات البلاستيكية ', '', '', 'JUBAIL', '', '300511062600003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(19, 18, 'FLEET LANE LOGISTICS LLC', 'FLEET LANE LOGISTICS LLC', '', '', '', '', '', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(20, 19, 'HUSSAIN ABDULLAH AIAJMI TRADING EST', 'مؤسسة حسين عبدالله عجمى التجارية', 'MUMTHAZIR', '', 'PRINCE MUHAMMED STREET CROSS NO 10/11. AL KHOBAR. PO BOX 79860\r\nDAMMAM', '', '300349063700003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(21, 20, 'ABDULLAH A AL BARRAK AND SONS CO.', 'شركة عبدالله البراك واولاده', '', '', '', '', '300578485100003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(22, 21, 'SAUDI ARABIAN ENGINEERING COMPANY', 'الشركة السعودية العربية للهندسة', '', '', 'SECOND INDUSTRIAL AREA DAMMAM', '', '300449958200003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(23, 22, 'TAZEZ ADVANCED INDUSTRIAL CO LTD', ' شركة تعزيز المتقدمة الصناعية المحدودة ', 'SHAJAHAN KUNJU', '', 'PORT ROAD DAMMAM', '', '3000445141200003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(24, 23, 'Rezayat Protective Coating Co. Ltd.', 'شركة رزايات للطلاء الواقي المحدودة ', 'MAHDI', '', 'Dammam', '', '300448908100003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(25, 24, 'SMASH GLOBAL LOGISTICS', 'سماش العالمية لوجستيات', 'AHMED', '', 'EGYPT', '', '545-233-305', 'EGYPT', ' مصر بلد', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(26, 25, 'JUBAIL CHEMICAL INDUSTRIES ( JANA ) JUBAIL INDUSTRIAL CITY 31961 SAUDI ARABIA', 'الجبيل للصناعات الكيماوية (يانا) مدينة الجبيل الصناعية 31961 المملكة العربية السعودية ', '', '', '', '', '300483973200003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(27, 26, 'HK AL SADIQ SONS contracting Co. Ltd', ' H.K. شركة أبناء الصادق للمقاولات المحدودة H.K.', '', '', '', '', '300439703200003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '2020-11-12 06:09:28', '2020-11-12 03:39:26', 1, ''),
(28, 27, 'Sinsina Industrial Works & Metal Construction Factory ', ' مصنع سينسينا للأعمال الصناعية والإنشاءات المعدنية ', 'Mr. Umair', '', 'Jubail KSA', '', '310499500100003', 'SAUDI ARABIA', 'المملكة العربية السعودية ', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(29, 28, 'ARABIAN NEON EST ', 'مؤسسة نيون العربية', 'MR. Sree Kumar', '', '', '', '200012234700002', 'SAUDI ARABIA', 'المملكة العربية السعودية ', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(30, 29, 'AL AMARA INTERNATIONAL TRADING & CONTRACTING COMPANY LTD', ' شركة العمارة الدولية للتجارة والمقاولات المحدودة ', 'PRAYAG', '', 'JUBAIL , SAUDI ARABIA', '', '300527213900003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(31, 30, 'Daxel Italy Srl  Logistics & Solutions', '  الخدمات اللوجستية والحلول ', '', '', '', '', '03319071209', 'ITALY', 'إيطاليا', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(32, 31, 'PEPPERL+FUCHS GULF LLC. AL KHOBAR ', 'شركة بيبيريل فوكس الخليج د م م', 'IMRAN', '', 'Al Khobar', '', '310148231700003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '2020-10-15 12:25:03', '2020-10-14 21:55:02', 1, ''),
(33, 32, 'BRIGHT WORLD TRADING EST', 'مؤسسة برايت وورلد للتجارة', 'VISHNU', '', 'JUBAIL', '', '300381366600003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(34, 33, 'GAS-VECTOR SAUDI ARABIA LTD', 'ناقلات الغاز السعودية المحدودة', 'ZANDRO', '', 'DAMMAM', '', '300462385300003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(35, 34, 'GABAS ALBILAD HOLDING CO', 'شركة جاباس البلاد القابضة', 'GEO JOSEPH', '', 'AL KHOBAR', '', '3005054838000003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(36, 35, 'SAHER AL-FAISALIYAH TRADING EST.', 'مؤسسة سحر الفيصلية التجارية ', '', '', 'AL KHOBAR', '', '302045195200003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(37, 36, 'COSL DRILLING SAUDI LTD', 'السعودية المحدودة للحفر', '', '', 'NOVOTEL, DAMMAM BUSINESS PARK-TOWER #2-4TH FLOOR, KING FAHAD STREET \r\nP O BOX 32200\r\nAL KHOBAR 31952', '', '310024479600003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(38, 37, 'Al Abar Oilfield Services Est ', 'مؤسسة الآبار لخدمات حقول النفط', 'Fazil', '', '', '', '300517277300003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(39, 38, 'MISFER HASAN AHMED AL MALKI TRADING EST.', ' مؤسسة مسفر حسن احمد المالكي للتجارة ', 'UNNI', '', '', '', '300430863900003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(40, 39, 'MAGA LOGISTICS', 'لوجستيات ماغا', '', '', '', '', '', 'CHINA', 'الصين', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(41, 40, 'GULF ROAD CONSTRUCTIONS TRADING EST', 'مؤسسة الخليج للتجارة والانشاءات', 'UDESH', '', '', '', '300429599300003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(42, 41, 'AHMED YAHYA NASSER AL-YAMI TRADING EST', 'مؤسسة احمد يحيى ناصر اليامي للتجارة ', '', '', '', '', '300470588600003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(45, 42, 'Weidmuller Saudi Arabia Factory', 'Weidmuller Saudi Arabia Factory', '', '', '', '', '310525051100003', 'SAUDI ARABIA', 'SAUDI ARABIA', '', '', '', '', '', '', '', '2020-10-04 01:56:51', '2020-10-03 23:26:53', 1, ''),
(46, 43, 'TREVI ARABIAN SOIL CONTRACTORS', 'TREVI ARABIAN SOIL CONTRACTORS', '', '', 'SAUDI ARABIA', 'SAUDI ARABIA', '', '', '', '', '', '', '', '', '', '', '2020-10-04 02:15:54', '2020-10-03 23:45:55', 1, ''),
(47, 44, 'MIDDLE EAST SOLUTION FOR LOGISITICS SERVICES EST', 'MIDDLE EAST SOLUTION FOR LOGISITICS SERVICES EST', '', '', 'IBN TULUN STREET - RIYADH - KSA', '', '', 'SAUDI ARABIA', 'SAUDI ARABIA', '', '', '', '', '', '', '', '2020-10-04 02:20:43', '2020-10-03 23:50:44', 1, ''),
(48, 45, 'AL-OTHMAN INDUSTRIAL MARKETING CO.LTD', 'شركة العثمان للتسويق الصناعي', 'SHAJAHAN KUNJU', '', 'DAMMAM', '', '300054953100003', 'SAUDI ARABIA', 'المملكة العربية السعودية', '', '', '', '', '', '', '', '2020-10-14 08:05:07', '2020-10-14 05:35:08', 1, ''),
(50, 47, 'HISHAM MOHAMMAD AL QURAISH TRADING EST.', '', '', '', 'DAMMAM', '', '', '', '', '', '', '', '', '', '', '', '2020-11-18 07:05:34', '0000-00-00 00:00:00', 1, ''),
(51, 48, 'SADAF ELECTRIC INDUSTRIES CO LTD', '', '', '', 'JEDDAH', '', '', 'SAUDI ARABIA', '', '', '', '', '', '', '', '', '2020-11-22 09:37:49', '2020-11-22 07:07:48', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `mst_companies`
--

DROP TABLE IF EXISTS `mst_companies`;
CREATE TABLE IF NOT EXISTS `mst_companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` text NOT NULL,
  `enabled` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mst_currency`
--

DROP TABLE IF EXISTS `mst_currency`;
CREATE TABLE IF NOT EXISTS `mst_currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency` text NOT NULL,
  `created_at` text NOT NULL,
  `updated_at` text NOT NULL,
  `IsActive` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mst_currency`
--

INSERT INTO `mst_currency` (`id`, `currency`, `created_at`, `updated_at`, `IsActive`) VALUES
(1, 'SAR', '2020-03-04 10:29:08 am', '2020-04-15 12:47:17 pm', 1),
(2, 'INR', '2020-03-04 10:29:18 am', '', 1),
(3, 'GBP', '2020-03-04 10:29:30 am', '', 1),
(4, 'EUR', '2020-03-04 10:29:41 am', '', 1),
(5, 'USD', '2020-03-04 10:29:49 am', '', 1),
(6, 'AED', '2020-03-04 10:29:59 am', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_description`
--

DROP TABLE IF EXISTS `mst_description`;
CREATE TABLE IF NOT EXISTS `mst_description` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `description` text NOT NULL,
  `description_arabic` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `IsActive` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3113 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mst_description`
--

INSERT INTO `mst_description` (`id`, `code`, `description`, `description_arabic`, `created_at`, `updated_at`, `IsActive`) VALUES
(11, 3, 'TRANSPORTATION CHARGES', 'رسوم الشحن البري ', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(10, 2, 'SEA FREIGHT CHARGES', 'رسوم الشحن البحري ', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(9, 1, 'AIR FREIGHT CHARGES', 'رسوم الشحن الجوي', '2020-09-15 10:44:33', '2020-04-15 07:16:22', 1),
(12, 4, 'CUSTOMS CLEARANCE CHARGES', 'رسوم التخليص الجمركي ', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(13, 5, 'OTHER CHARGES', 'رسوم اخري ', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(14, 6, 'CUSTOMS DUTY (AS ATTACHED)', 'الرسوم الجمركيه (مرفقه )', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(15, 7, 'DO/ PORT CHARGES (AS ATTACHED)', 'رسوم الميناء (مرفقه)', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(16, 8, 'MISCELLANEOUS EXP.', 'منصرفات متفرقه', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(17, 9, 'SASO CERTIFICATION CHARGES', 'رسوم شهاده الجوده السعوديه ', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(18, 10, 'SASO/ COO/ HANDLING CHARGES', 'رسوم شهاده الجوده السعوديه  شهادة المنشأ  اتعاب', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(19, 11, 'LINE DETENTION CHARGES (AS ATTACHED)', 'رسوم حجز خط (مرفقه)', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(20, 12, 'CONTAINER DEPOSIT', 'دفعه مقدمه للكونترات', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(21, 13, 'TRUCK DETENTION CHARGES', 'رسوم حجز خط للشاحنات (الترلات)', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(22, 14, 'LABOR CHARGES', 'مصاريف عمال ', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(23, 15, 'DEMURRAGE CHARGES (AS ATTACHED)', 'رسوم غرامه التأخير (مرفقه)', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(24, 16, 'DOCUMENTATION/ HANDLING CHARGES', 'اتعاب تخليص الاوراق الرسميه', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(25, 17, 'PORT CHARGES (AS ATTACHED)', 'رسوم الميناء (كما هو موصوف)', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(26, 18, 'TRANSLATION: ', 'ترجمة', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(27, 19, 'B/L EXCHANGE CHARGES (AS ATTACHED)', 'رسوم صرف B / L (كما هو موصوف)', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(28, 20, 'TRANSPORTATION (PORT SHUTTLING)', 'النقل (نقل الميناء)', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(30, 21, 'STORAGE/WAREHOUSE/LOL CHARGES', 'التخزين / التخزين / LOL', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(33, 22, 'INSPECTION / STRIP - STUFF / X RAY', 'تفتيش / الشريط - الاشياء / X راي', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(34, 23, 'TRANSPORTATION CHARGES(DAMAM TO AL JUBAIL)', '(رسوم الشحن البري ( دمام و الجبيل', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(35, 24, 'TRANSPORTATION CHARGES(DAMAM TO AL KHURAISE)', '(رسوم الشحن البري ( دمام و الخريس', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(36, 25, 'TRANSPORTATION CHARGES(DAMAM TO AL FADHLI)', '(رسوم الشحن البري ( دمام و الفدلي', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(37, 26, 'EXEMPTION HANDLING', 'التعامل مع الإعفاء', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(39, 28, 'FORKLIFT AND LOADING HANDLING CHARGE', 'رافعة شوكية وتحميل المسؤولية', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(40, 29, 'ADVANCE CUSTOMS DUTY', 'تقدم الرسوم الجمركية', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(41, 30, 'ADVANCE VAT AMOUNT', 'دفعه مقدمه الضريبي', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(42, 31, 'DELIVERY ORDER CHARGE ADVANCE', 'دفعه مقدمه ادن التسليم', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(43, 32, 'COO CERTIFICATION CHARGES', 'رسوم COO الترخيص', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(44, 33, 'LAND FREIGHT CHARGES', 'رسوم الشحن البري', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(45, 34, 'WHITE STICKER WITH CUTTING..', 'ملصقا الأبيض مع قطع ..', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(46, 35, 'STICKER DESIGN AND PRINTING', 'تصميم ملصق وطباعة', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(47, 36, 'EDI DOCUMENTATION AND LOADING CHARGE', 'EDI الوثائق وتحميلها', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(48, 37, 'DGR APPROVAL& INSPECTION CHARGE ', 'DGR موافقة وفحص تهمة', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(49, 38, 'BOX OPENING CHARGES FOR INSPECTION ', 'صندوق فتح رسوم التفتيش', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(50, 39, 'SASO AND LAB HANDLING CHARGE', 'ساسو والمعالجة باللعب', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(51, 40, 'SNICKERING AND LABOUR CHARGE AND MADE HANDLING ', 'التشويش وتهمة العمال والمناولة المصنوعة', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(52, 41, 'CUSTOM DUTY DIFFERENCE AND DEMURAGE  CHARGES (AS ATTACHED)', 'فرق الرسوم الجمركية ورسوم الرسوم الجمركية (المرفقة)', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(53, 42, 'PORT SHUTTLING AND STORAGE CHARGES AS ATTACHED', 'رسوم النقل والتخزين في الموانئ (المرفقة)', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(54, 43, 'CLEARANCE AND DELIVERY CHARGES', 'التخليص ورسوم الشحن', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(55, 44, 'ADDITIONAL PICKUP CHARGES ', 'رسوم إضافية انتقاء الرسوم', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(56, 45, 'AWB / BL AMENDMENT FEE', 'رسوم تعديل AWB / BL', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(57, 46, 'VGM CHARGES', 'رسوم VGM', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(58, 47, 'TRANSPORTATION CHARGES FROM DAMMAM TO BAHRAIN', 'رسوم النقل من الدمام إلى البحرين', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(59, 48, 'DETENTION CHARGES FOR  ONE DAY', 'رسوم الاحتجاز ليوم واحد', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(60, 49, 'TRANSPORTATION CHARGES FROM YAMAMA SITE TO GAS ARABIAN SERVICES JUBAIL', 'رسوم النقل من موقع ياما إلى خدمات الغاز العربية في جبيل ', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(61, 50, 'TRANSPORTATION CHARGES FROM AL KAFAA TO JUBAIL GAS ARABIAN SERVICES', ' رسوم النقل من شركة الكفاءة إلى جبيل للخدمات العربية ', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(1058, 51, 'TRANSPORTATION CHARGES DAMMAM TO RIYADH ROUND TRIP', ' النقل يدفع رسوم الدمام إلى جولة الرياض ', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(2058, 52, 'TRANSPORTATION CHARGES : DAMMAM TO TIHAMA', 'رسوم النقل: الدمام إلى تهامة ', '2020-04-01 11:25:55', '0000-00-00 00:00:00', 1),
(3058, 53, 'TRANSPORTATION CHARGES FROM RIYADH TO YAMAMA GAS PLANT', 'رسوم النقل من الرياض إلى محطة ياما للغاز ', '2020-10-26 05:36:41', '2020-10-26 05:36:42', 1),
(3112, 54, 'DOCUMENTATION CHARGES', 'رسوم التوثيق', '2020-10-04 22:23:21', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_permission`
--

DROP TABLE IF EXISTS `mst_permission`;
CREATE TABLE IF NOT EXISTS `mst_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `display_name` text NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mst_permission`
--

INSERT INTO `mst_permission` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'read user', 'read user', 'read user', '2019-12-30 06:24:40', '2019-12-30 19:54:39'),
(2, 'create user', 'create user', 'create user', '2019-12-26 11:05:26', '0000-00-00 00:00:00'),
(3, 'update users', 'update users', 'update users', '2019-12-26 11:06:01', '0000-00-00 00:00:00'),
(4, 'read permission', 'read permission', 'read permission', '2019-12-26 11:57:02', '0000-00-00 00:00:00'),
(5, 'create permissions', 'create permissions', 'create permissions', '2019-12-26 12:31:03', '2019-12-26 14:01:00'),
(7, 'read role', 'read role', 'read role', '2019-12-26 12:00:19', '0000-00-00 00:00:00'),
(6, 'update permission', 'update permission', 'update permission', '2019-12-26 11:59:07', '0000-00-00 00:00:00'),
(8, 'create role', 'create role', 'create role', '2019-12-26 12:17:01', '0000-00-00 00:00:00'),
(9, 'update roles', 'update roles', 'update roles', '2020-01-24 13:07:36', '0000-00-00 00:00:00'),
(27, 'read supplier', 'read supplier', 'read supplier', '2020-01-29 04:55:32', '0000-00-00 00:00:00'),
(26, 'read client', 'read client', 'read client', '2020-01-29 04:55:16', '0000-00-00 00:00:00'),
(25, 'read  carrier', 'read  carrier', 'read  carrier', '2020-01-29 04:55:01', '0000-00-00 00:00:00'),
(24, 'read job view', 'read job view', 'read job view', '2020-01-26 22:30:00', '0000-00-00 00:00:00'),
(23, 'read transaction ', 'read transaction ', 'read transaction ', '2020-01-26 22:29:32', '0000-00-00 00:00:00'),
(22, 'read bank', 'read bank', 'read bank', '2020-01-29 04:53:25', '2020-01-29 04:53:25'),
(21, 'create master', 'create master', 'create master', '2020-01-27 11:02:24', '2020-01-26 23:02:24'),
(28, 'read descriptionmaster', 'read decriptionmaster', 'read decription master', '2020-01-29 05:12:17', '0000-00-00 00:00:00'),
(29, 'read shipper', 'read shipper', 'read shipper', '2020-01-29 04:56:19', '0000-00-00 00:00:00'),
(30, 'read currency', 'read currency', 'read currency', '2020-01-29 04:58:37', '0000-00-00 00:00:00'),
(31, 'create bank', 'create bank', 'create bank', '2020-01-29 05:25:20', '0000-00-00 00:00:00'),
(32, 'create client', 'create client', 'create client', '2020-01-29 05:25:39', '0000-00-00 00:00:00'),
(33, 'create carrier', 'create carrier', 'create carrier', '2020-01-29 05:25:59', '0000-00-00 00:00:00'),
(34, 'create supplier', 'create supplier', 'create supplier', '2020-01-29 05:26:15', '0000-00-00 00:00:00'),
(35, 'create descriptionmaster', 'create descriptionmaster', 'create descriptionmaster', '2020-01-29 05:26:33', '0000-00-00 00:00:00'),
(36, 'create shipper', 'create shipper', 'create shipper', '2020-01-29 05:26:46', '0000-00-00 00:00:00'),
(37, 'create currency', 'create currency', 'create currency', '2020-01-29 05:27:01', '0000-00-00 00:00:00'),
(38, 'update supplier', 'update supplier', 'update supplier', '2020-01-29 06:17:28', '0000-00-00 00:00:00'),
(39, 'update shipper', 'update shipper', 'update shipper', '2020-01-29 06:18:34', '0000-00-00 00:00:00'),
(40, 'update client', 'update client', 'update client', '2020-01-29 06:19:16', '0000-00-00 00:00:00'),
(41, 'update carrier', 'update carrier', 'update carrier', '2020-01-29 06:19:29', '0000-00-00 00:00:00'),
(42, 'update bank', 'update bank', 'update bank', '2020-01-29 06:19:46', '0000-00-00 00:00:00'),
(43, 'update descriptionmaster', 'update descriptionmaster', 'update descriptionmaster', '2020-01-29 06:20:06', '0000-00-00 00:00:00'),
(44, 'update currency', 'update currency', 'update currency', '2020-01-29 06:20:52', '0000-00-00 00:00:00'),
(45, 'read supplier search', 'read supplier search', 'read supplier search', '2020-01-29 06:59:15', '0000-00-00 00:00:00'),
(46, 'read client search', 'read client search', 'read client search', '2020-01-29 06:59:29', '0000-00-00 00:00:00'),
(47, 'read supplier payment', 'read supplier payment', 'read supplier payment', '2020-01-29 06:59:43', '0000-00-00 00:00:00'),
(48, 'read jobreports', 'read jobreports', 'read jobreports', '2020-01-29 07:00:03', '0000-00-00 00:00:00'),
(49, 'read nonbilledreports', 'read nonbilledreports', 'read nonbilledreports', '2020-01-29 07:00:15', '0000-00-00 00:00:00'),
(50, 'read invoicereports', 'read invoicereports', 'read invoicereports', '2020-01-29 07:00:36', '0000-00-00 00:00:00'),
(51, 'read pendinginvoice', 'read pendinginvoice', 'read pendinginvoice', '2020-01-29 07:00:52', '0000-00-00 00:00:00'),
(52, 'read billreport', 'read billreport', 'read billreport', '2020-01-29 07:01:07', '0000-00-00 00:00:00'),
(53, 'read pendingbills', 'read pendingbills', 'read pendingbills', '2020-01-29 07:01:22', '0000-00-00 00:00:00'),
(54, 'create ledgergroup', 'create ledgergroup', 'create ledgergroup', '2020-01-29 07:09:27', '0000-00-00 00:00:00'),
(55, 'create ledger', 'create ledger', 'create ledger', '2020-01-29 07:09:40', '0000-00-00 00:00:00'),
(56, 'create accountsentry', 'create accountsentry', 'create accountsentry', '2020-01-29 07:09:55', '0000-00-00 00:00:00'),
(57, 'read daybook', 'read daybook', 'read daybook', '2020-01-29 07:10:13', '0000-00-00 00:00:00'),
(58, 'read trialbalance', 'read trialbalance', 'read trialbalance', '2020-01-29 07:10:36', '0000-00-00 00:00:00'),
(59, 'read balancesheet', 'read balancesheet', 'read balancesheet', '2020-01-29 07:11:07', '0000-00-00 00:00:00'),
(60, 'read ledgerview', 'read ledgerview', 'read ledgerview', '2020-01-29 07:11:21', '0000-00-00 00:00:00'),
(61, 'create debitnote', 'create debitnote', 'create debitnote', '2020-01-28 19:30:28', '0000-00-00 00:00:00'),
(62, 'create expense', 'create expense', 'create expense', '2020-01-28 19:30:44', '0000-00-00 00:00:00'),
(63, 'create creditnote', 'create creditnote', 'create creditnote', '2020-01-28 19:31:02', '0000-00-00 00:00:00'),
(64, 'create invoice', 'create invoice', 'create invoice', '2020-06-11 09:10:49', '0000-00-00 00:00:00'),
(65, 'update invoice', 'update invoice', 'update invoice', '2020-01-28 19:36:42', '0000-00-00 00:00:00'),
(66, 'update expense', 'update expense', 'update expense', '2020-01-28 19:36:56', '0000-00-00 00:00:00'),
(67, 'read clientreceipt', 'read clientreceipt', 'read clientreceipt', '2020-01-28 19:46:15', '0000-00-00 00:00:00'),
(68, 'create supplier payment', 'create supplier payment', 'create supplier payment', '2020-01-28 19:49:40', '0000-00-00 00:00:00'),
(69, 'create clientreceipt', 'create clientreceipt', 'create clientreceipt', '2020-01-28 19:54:13', '0000-00-00 00:00:00'),
(70, 'create nonbilledreports', 'create nonbilledreports', 'create nonbilledreports', '2020-01-28 19:58:21', '0000-00-00 00:00:00'),
(71, 'read basic settings', 'read basic settings', 'read basic settings', '2020-02-03 04:25:52', '0000-00-00 00:00:00'),
(72, 'update basic settings', 'update basic settings', 'update basic settings', '2020-02-03 04:33:18', '0000-00-00 00:00:00'),
(73, 'create job', 'create job', 'create job', '2020-02-04 07:01:31', '0000-00-00 00:00:00'),
(74, 'update job', 'update job', 'update job', '2020-02-04 07:04:06', '0000-00-00 00:00:00'),
(79, 'read paymentreports', 'read paymentreports', 'read paymentreports', '2020-02-25 00:20:59', '0000-00-00 00:00:00'),
(80, 'read vatreports', 'read vatreports', 'read vatreports', '2020-02-25 00:22:12', '0000-00-00 00:00:00'),
(81, 'read profit and loss', 'read profit and loss', 'read profit and loss', '2020-02-25 00:23:29', '0000-00-00 00:00:00'),
(82, 'read receipt reports', 'read receipt reports', 'read receipt reports', '2020-02-25 00:24:24', '0000-00-00 00:00:00'),
(83, 'read payment receipt reports', 'read payment receipt reports', 'read payment receipt reports', '2020-02-26 04:54:49', '0000-00-00 00:00:00'),
(84, 'read soa report', 'read soa report', 'read soa report', '2020-10-11 20:35:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mst_roles`
--

DROP TABLE IF EXISTS `mst_roles`;
CREATE TABLE IF NOT EXISTS `mst_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `display_name` text NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mst_roles`
--

INSERT INTO `mst_roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin', '2020-02-27 12:44:10', '2020-02-27 00:44:10'),
(2, 'manager', 'manager', 'manager', '2020-02-03 04:34:02', '2020-02-03 04:34:02');

-- --------------------------------------------------------

--
-- Table structure for table `mst_role_permissions`
--

DROP TABLE IF EXISTS `mst_role_permissions`;
CREATE TABLE IF NOT EXISTS `mst_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mst_role_permissions`
--

INSERT INTO `mst_role_permissions` (`role_id`, `permission_id`) VALUES
(1, 82),
(1, 74),
(1, 72),
(2, 2),
(1, 66),
(1, 65),
(1, 44),
(1, 43),
(1, 42),
(1, 41),
(1, 40),
(1, 39),
(1, 38),
(2, 71),
(1, 9),
(1, 6),
(1, 3),
(1, 73),
(1, 70),
(1, 69),
(1, 68),
(1, 64),
(1, 63),
(1, 62),
(1, 61),
(1, 56),
(1, 55),
(1, 54),
(1, 37),
(1, 36),
(1, 35),
(1, 34),
(1, 33),
(1, 32),
(1, 31),
(1, 21),
(1, 8),
(1, 5),
(1, 2),
(1, 83),
(1, 81),
(2, 1),
(1, 80),
(1, 79),
(1, 71),
(1, 67),
(1, 60),
(1, 59),
(1, 58),
(1, 57),
(1, 53),
(1, 52),
(1, 51),
(1, 50),
(1, 49),
(1, 48),
(1, 47),
(1, 46),
(1, 45),
(1, 30),
(1, 29),
(1, 28),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(34, 1),
(35, 1),
(0, 1),
(1, 26),
(1, 27),
(1, 7),
(1, 4),
(1, 1),
(1, 84),
(36, 1),
(36, 4),
(36, 7),
(36, 27),
(36, 26),
(36, 25),
(36, 24),
(36, 23),
(36, 22),
(36, 28),
(36, 29),
(36, 30),
(36, 45),
(36, 46),
(36, 47),
(36, 48),
(36, 49),
(36, 50),
(36, 51),
(36, 52),
(36, 53),
(36, 57),
(36, 58),
(36, 59),
(36, 60),
(36, 67),
(36, 71),
(36, 79),
(36, 80),
(36, 81),
(36, 82),
(36, 83),
(36, 84);

-- --------------------------------------------------------

--
-- Table structure for table `mst_shipper`
--

DROP TABLE IF EXISTS `mst_shipper`;
CREATE TABLE IF NOT EXISTS `mst_shipper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `name` text NOT NULL,
  `contact_person` text NOT NULL,
  `address` text NOT NULL,
  `country` text NOT NULL,
  `telephone` text NOT NULL,
  `mobile` text NOT NULL,
  `fax` text NOT NULL,
  `email` text NOT NULL,
  `remarks` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL,
  `IsActive` int(11) NOT NULL,
  `type` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=136 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mst_shipper`
--

INSERT INTO `mst_shipper` (`id`, `code`, `name`, `contact_person`, `address`, `country`, `telephone`, `mobile`, `fax`, `email`, `remarks`, `created_at`, `updated_at`, `IsActive`, `type`) VALUES
(1, 1, 'BULMANN ROHR-FITTINGS STAHLHANDEL', '', 'GMBH CO.KG', 'GERMANY', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(2, 2, 'ALI GASHASH AL OMARI TRADING EST.', '', 'AL KHOBAR', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(3, 3, 'NEXUS ALLOYS', 'BHUSAN', 'MUMBAI', 'INDIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(4, 4, 'GMS KOREA', '', '', 'KOREA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(5, 5, 'M.E.G.A SPA', '', '', 'ITALY', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(6, 6, 'SAFE ARABIAN TRADING AND CONTRACTING LTD', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(7, 7, 'TEMPSENS INSTRUMENTS PVT LTD', '', '', 'INDIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(8, 8, 'JFC CORPORATION', '', '', 'KOREA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(9, 9, 'JFC ARABIA COMPANY LTD', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(10, 10, 'KEONWOO METALS CO.LTD', '', '', 'KOREA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(11, 11, 'GULF PETROLIC INTERNATIONAL EST', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(12, 12, 'SAUDI ARABIAN FABRICATED METAL INDUSTRY ( SAFAMI )', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(13, 13, 'ALI BIN GHASHASH B GATE', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(14, 14, 'ENERGY SUPPLY AND SERVICES COMPANY', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(15, 15, 'BARTEC MIDDLE EAST LLC', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(16, 16, 'FENEX SRL', '', '', 'ITALY', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(17, 17, 'FEAM ', '', '', 'ITALY', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(18, 18, 'KRUSMAN EMERGENCY SHOWERS', '', '', 'DUBAI', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(19, 19, 'ELITE PROFIT INTERNATIONAL', '', '', 'CHINA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(20, 20, 'ALI BIN GHASHASH CONTRACTING EST. ( B GATE)', 'SAJEER', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(21, 21, 'ZHEJIANG ASKE BUILDING MATERIALS', '', '', 'CHINA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(22, 22, 'TEMPSENS INSTRUMENTS PVT LTD. INDIA', '', '', 'INDIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(23, 23, 'ELLIOT GROUP EASTERN PARK,SILCHESTER UK', '', '', 'UNITED KINGDOM', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(24, 24, 'GAS ARABIAN SERVICES CO.LTD', 'MOHAN', 'GAS ARABIAN SERVICES DAMMAM', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(25, 25, 'EZDEHAR', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(26, 26, 'EZDEHAR INDUSTRIAL SERVICES EST.', '', 'DAMMAM', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(27, 27, 'EZDEHAR INDUSTRIAL SERVICES EST.', '', 'DAMMAM', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(28, 28, 'N-STEELS (SHANGAI) CO.LTD', '', '', 'CHINA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(29, 29, 'BUMWOO , 48 YEOSUSANDAN 1 RO, HAESANDONG', '', '', 'KOREA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(30, 30, 'INTERNATIONAL SOLUTIONS FOR INDUSTRIAL SERVICES CO', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(31, 31, 'ARABIAN POWER ELECTRONICS COMPANY', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(32, 31, 'ARABIAN POWER ELECTRONICS COMPANY', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(33, 32, 'T K CORPORATION', '', '', 'KOREA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(34, 33, 'NAUTIC STEELS LTD', '', '', 'UNITED KINGDOM', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(35, 34, 'AL KAFAA TRADING COMPANY', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(36, 35, 'AL OTHMAN INDUSTRIAL MARKETING', 'SHAJAHAN KUNJU', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(37, 36, 'AL-OTHMAN INDUSTRIAL MARKETING', 'SHAJAHAN KUNJU', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(38, 37, 'AL OTHMAN INDUSTRIAL MARKETING', '', 'DAMMAM', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(39, 38, 'SAUDI ARABIAN FABRICATED METALS INDUSTRY (SAFAMI)', 'KATHIRESAN', 'DAMMAM', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(40, 39, 'DELCORTE SAS', '', '', 'FRANCE', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(41, 40, 'PENTAFLEX FILMS LLP', '', '', 'INDIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(42, 41, 'ABDULLAH AL BARRAK FACTORY FOR PLASTICS PRODUCTS', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(43, 42, 'HUSSAIN ABDULLAH AIAJMI TRADING EST', 'MUMTHAZIR', 'PRINCE MUHAMMED STREET CROSS NO 10/11 AL KHOBAR', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(44, 43, 'EAST WEST INTERNATIONAL INC 901 S.W. MARTIN DOWNS ', '', '', 'GERMANY', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(45, 44, 'ABDULLAH A AL BARRAK AND SONS CO. JUBAIL / SAUDIA ', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(46, 45, 'ABDULLAH A AL BARRAK AND SONS CO. JUBAIL / SAUDIA ', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(47, 46, 'NUNGWON METAL INDUSTRY CO LTD', '', '', 'KOREA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(48, 47, 'B.F.E.SRL ITALY', '', '', 'ITALY', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(49, 48, 'EUROMISURE ITALY', '', '', 'ITALY', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(50, 49, 'THERMO ELECTRIC INSTRUMENTATION B.V ', '', '', 'NETHERLAND', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(51, 50, 'TAZEZ ADVANCED INDUSTRIAL CO LTD', '', 'DAMMAM', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(52, 51, 'PALL (EUROPE) LTD C/O DHL SUPPLY CHAIN', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(53, 52, 'TANAJIB FOR TRADING COMPANY LTD', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(54, 53, 'PALL TRINITY MICRO 3643 NYS RT 281 USA', '', '', 'USA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(55, 54, 'EXTEC CORP', '', '', 'USA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(56, 55, 'HUB TECHNICAL SERVICES & TRADING', '', '', 'USA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(57, 56, 'TRANSCEDENCE AUTOMATION PRIVATE LIMITED', '', '', 'INDIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(58, 57, 'TTI,TUBACEX TUBOS INOXIDABLESM S.A.U', 'SHAJAHAN KUNJU', '', 'SPAIN', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(59, 58, 'SIN GHEE HUAT CORPORATION LTD. SINGAPORE', '', '', 'SINGAPORE', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(60, 59, 'sAUDI ARABIAN ENGINEERING CO.LTD', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(61, 60, 'MERSEN FRANCE PY S.A.S', '', '', 'FRANCE', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(62, 61, 'JUBAIL CHEMICAL INDUSTRIES ( JANA)', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(63, 62, 'SAUDI ELECTRICITY COMPANY', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(64, 63, 'H.K AL SADIQ SONS Contracting Co.Ltd', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(65, 64, 'SAUDI ELECTRICAL TRANSFORMER FACTORY ', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(66, 65, 'Sinsina Industrial Works & Metal Construction Fact', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(67, 66, 'WEIDMUELLER INTERFACE GmbH & CO.KG', '', '', 'GERMANY', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(68, 67, 'AL AMARA INTERNATIONAL TRADING & CONTRACTING COMPA', '', 'JUBAIL', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(69, 68, 'L&T VALVES LIMITED ', 'UMA', '', 'INDIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(70, 69, 'PEPPERL&FUCHS MANUFACTURING (INDIA) PVT LTD', 'SRINIVASA', '', 'INDIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(71, 70, 'PEPPERL+FUCHS GULF LLC', '', 'AL KHOBAR', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(72, 71, 'SAHER AL FAISALIYAH TRADING EST', '', 'DAMMAM', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(73, 72, 'COSL DRILLING SAUDI LTD', '', '', 'CHINA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(74, 73, 'OMEGA GLOBAL LOGISTICS', '', '', 'USA', '', '', '', '', '', '2020-06-24 06:04:48', '2020-06-24 06:04:48', 1, 'text'),
(75, 74, 'AHMED YAHYA NASSER AL-YAMI TRADING EST-', '', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-08-05 07:29:09', '2020-08-05 07:29:09', 1, 'text'),
(77, 0, 'DRILLINGER MIDDLE EAST FZE', '', '', '', '', '', '', '', '', '2020-10-05 12:12:33', '0000-00-00 00:00:00', 1, 'text'),
(78, 0, 'CRANE PROCESS FLOW TECHNOLOGIES', '', '', '', '', '', '', '', '', '2020-10-06 17:24:29', '0000-00-00 00:00:00', 1, 'text'),
(79, 0, 'PROCESS PUMPS PVT LTD', '', '', '', '', '', '', '', '', '2020-10-06 17:47:11', '0000-00-00 00:00:00', 1, 'text'),
(80, 0, 'RACI SRL', '', '', '', '', '', '', '', '', '2020-10-10 13:09:54', '0000-00-00 00:00:00', 1, 'text'),
(81, 0, 'HK AL SADIQ & SONS', '', '', '', '', '', '', '', '', '2020-10-10 13:09:54', '0000-00-00 00:00:00', 1, 'text'),
(82, 0, 'TRILLIUM FLOW TECHNOLOGIES INDIA PVT LTD', '', '', '', '', '', '', '', '', '2020-10-12 12:50:09', '0000-00-00 00:00:00', 1, 'text'),
(83, 0, 'TK CORPORATION', '', '', '', '', '', '', '', '', '2020-10-12 16:53:31', '0000-00-00 00:00:00', 1, 'text'),
(84, 0, 'JIANGXI RUIPAI HARDWARE CO., LTD', '', '', '', '', '', '', '', '', '2020-10-12 17:20:18', '0000-00-00 00:00:00', 1, 'text'),
(85, 0, 'CRANE RESISTOFLEX', '', '', '', '', '', '', '', '', '2020-10-17 14:31:51', '0000-00-00 00:00:00', 1, 'text'),
(86, 0, 'DELTA PLUS STAINLESS STEEL', '', '', '', '', '', '', '', '', '2020-10-18 11:26:02', '0000-00-00 00:00:00', 1, 'text'),
(87, 0, 'AESTEIRO STEELS LLP', '', '', '', '', '', '', '', '', '2020-10-19 12:11:18', '0000-00-00 00:00:00', 1, 'text'),
(88, 0, 'SPIRAX SARCO', '', '', '', '', '', '', '', '', '2020-10-19 12:37:04', '0000-00-00 00:00:00', 1, 'text'),
(89, 0, 'TECH HARD OIL FEILD SUPPLIES FZE', '', '', '', '', '', '', '', '', '2020-10-19 12:39:49', '0000-00-00 00:00:00', 1, 'text'),
(90, 0, 'SAECO', '', '', '', '', '', '', '', '', '2020-10-20 14:23:07', '0000-00-00 00:00:00', 1, 'text'),
(91, 0, 'SAECO', '', '', '', '', '', '', '', '', '2020-10-20 14:23:07', '0000-00-00 00:00:00', 1, 'text'),
(92, 0, 'MAGNETROL INTERNATIONAL', '', '', '', '', '', '', '', '', '2020-10-20 14:44:40', '0000-00-00 00:00:00', 1, 'text'),
(93, 0, 'APURV ELECTRICALS', '', '', '', '', '', '', '', '', '2020-10-21 18:06:13', '0000-00-00 00:00:00', 1, 'text'),
(94, 0, 'FLOOR ARABIA', '', '', '', '', '', '', '', '', '2020-10-22 10:46:00', '0000-00-00 00:00:00', 1, 'text'),
(95, 0, 'FS-ELLIOTT CO., LLC', '', '', '', '', '', '', '', '', '2020-10-26 15:56:31', '0000-00-00 00:00:00', 1, 'text'),
(96, 0, 'ARROW PIPES & FITTINGS FZCO', '', '', '', '', '', '', '', '', '2020-10-26 18:19:36', '0000-00-00 00:00:00', 1, 'text'),
(97, 0, 'PRIME PACK MANUFACTURING LLC', '', '', '', '', '', '', '', '', '2020-10-26 19:14:02', '0000-00-00 00:00:00', 1, 'text'),
(98, 0, 'AL-BABTAIN PLASTIC & INSULATION MAT. CO. LTD', '', '', '', '', '', '', '', '', '2020-10-26 19:14:02', '0000-00-00 00:00:00', 1, 'text'),
(99, 0, 'GAS ARABIAN SERVICES CO.LTD', '', '', '', '', '', '', '', '', '2020-10-27 18:57:10', '0000-00-00 00:00:00', 1, 'text'),
(100, 0, 'SAECO', '', '', '', '', '', '', '', '', '2020-10-29 13:20:29', '0000-00-00 00:00:00', 1, 'text'),
(101, 0, 'SAUDI ARABIAN ENGINEERING CO.LTD', '', '', '', '', '', '', '', '', '2020-10-31 12:40:42', '0000-00-00 00:00:00', 1, 'text'),
(102, 0, 'TK CORPORATION', '', '', '', '', '', '', '', '', '2020-11-05 12:34:35', '0000-00-00 00:00:00', 1, 'text'),
(103, 0, 'TK CORPORATION', '', '', '', '', '', '', '', '', '2020-11-05 12:37:52', '0000-00-00 00:00:00', 1, 'text'),
(104, 0, 'TK CORPORATION', '', '', '', '', '', '', '', '', '2020-11-05 12:55:20', '0000-00-00 00:00:00', 1, 'text'),
(105, 0, 'COSL DRILLING SAUDI LTD', '', '', '', '', '', '', '', '', '2020-11-05 16:40:10', '0000-00-00 00:00:00', 1, 'text'),
(106, 0, 'COSL DRILLING SAUDI LTD', '', '', '', '', '', '', '', '', '2020-11-05 16:42:13', '0000-00-00 00:00:00', 1, 'text'),
(107, 0, 'COSL DRILLING SAUDI LTD', '', '', '', '', '', '', '', '', '2020-11-08 17:31:11', '0000-00-00 00:00:00', 1, 'text'),
(108, 0, 'AHMED YAHYA NASSER AL-YAMI TRADING EST-', '', '', '', '', '', '', '', '', '2020-11-09 13:10:27', '0000-00-00 00:00:00', 1, 'text'),
(109, 0, 'AL OTHMAN INDUSTRIAL MARKETING', '', '', '', '', '', '', '', '', '2020-11-09 17:42:49', '0000-00-00 00:00:00', 1, 'text'),
(110, 0, 'AL OTHMAN INDUSTRIAL MARKETING', '', '', '', '', '', '', '', '', '2020-11-09 18:08:29', '0000-00-00 00:00:00', 1, 'text'),
(111, 0, 'AL OTHMAN INDUSTRIAL MARKETING', '', '', '', '', '', '', '', '', '2020-11-09 18:24:39', '0000-00-00 00:00:00', 1, 'text'),
(112, 0, 'TAZEZ ADVANCED INDUSTRIAL CO LTD', '', '', '', '', '', '', '', '', '2020-11-09 19:15:53', '0000-00-00 00:00:00', 1, 'text'),
(113, 0, 'OFFICINE GALPERTI & FIGLIO SPA', '', '', '', '', '', '', '', '', '2020-11-10 17:32:47', '0000-00-00 00:00:00', 1, 'text'),
(114, 0, 'GULF ROAD OF CONSTRUCTION TRADING EST', '', '', '', '', '', '', '', '', '2020-11-10 17:32:47', '0000-00-00 00:00:00', 1, 'text'),
(115, 0, 'EZDEHAR INDUSTRIAL SERVICES EST.', '', '', '', '', '', '', '', '', '2020-11-11 17:14:08', '0000-00-00 00:00:00', 1, 'text'),
(116, 0, 'GULF PETROLIC INTERNATIONAL EST', '', '', '', '', '', '', '', '', '2020-11-11 17:26:32', '0000-00-00 00:00:00', 1, 'text'),
(117, 0, 'GRACO DISTRIBUTION BVBA', '', '', '', '', '', '', '', '', '2020-11-11 17:47:49', '0000-00-00 00:00:00', 1, 'text'),
(118, 0, 'AL BABTAIN PLASTIC & INSULATION MAT.CO', '', '', '', '', '', '', '', '', '2020-11-11 17:47:49', '0000-00-00 00:00:00', 1, 'text'),
(119, 0, 'SAFE ARABIAN TRADING AND CONTRACTING LTD', '', '', '', '', '', '', '', '', '2020-11-12 11:59:59', '0000-00-00 00:00:00', 1, 'text'),
(120, 0, 'ALI GASHASH AL OMARI TRADING EST.', '', '', '', '', '', '', '', '', '2020-11-12 18:33:41', '0000-00-00 00:00:00', 1, 'text'),
(121, 0, 'ALI GASHASH AL OMARI TRADING EST.', '', '', '', '', '', '', '', '', '2020-11-12 18:40:13', '0000-00-00 00:00:00', 1, 'text'),
(122, 0, 'ALI GASHASH AL OMARI TRADING EST.', '', '', '', '', '', '', '', '', '2020-11-12 18:42:07', '0000-00-00 00:00:00', 1, 'text'),
(123, 0, 'ALI GASHASH AL OMARI TRADING EST.', '', '', '', '', '', '', '', '', '2020-11-12 18:44:14', '0000-00-00 00:00:00', 1, 'text'),
(124, 0, 'AHMED YAHYA NASSER AL-YAMI TRADING EST-', '', '', '', '', '', '', '', '', '2020-11-12 18:46:19', '0000-00-00 00:00:00', 1, 'text'),
(125, 0, 'ABDULLAH A AL BARRAK AND SONS CO. JUBAIL / SAUDIA ', '', '', '', '', '', '', '', '', '2020-11-17 12:32:35', '0000-00-00 00:00:00', 1, 'text'),
(126, 0, 'AL KAFAA TRADING COMPANY', '', '', '', '', '', '', '', '', '2020-11-17 16:37:50', '0000-00-00 00:00:00', 1, 'text'),
(127, 0, 'AL KAFAA TRADING COMPANY', '', '', '', '', '', '', '', '', '2020-11-17 16:40:35', '0000-00-00 00:00:00', 1, 'text'),
(128, 0, 'FOSHAN NANYU TECHNOLOGY CO LTD', '', '', '', '', '', '', '', '', '2020-11-18 15:20:25', '0000-00-00 00:00:00', 1, 'text'),
(129, 0, 'HISHAM MOHAMMED AL QURAISH TRADING EST', '', '', '', '', '', '', '', '', '2020-11-18 15:20:25', '0000-00-00 00:00:00', 1, 'text'),
(130, 0, 'LEE WELDS INDUSTRIES CO-LTD', '', '', '', '', '', '', '', '', '2020-11-22 14:50:45', '0000-00-00 00:00:00', 1, 'text'),
(131, 0, 'SADAF ELECTRIC INDUSTRIES CO-LTD', '', '', '', '', '', '', '', '', '2020-11-22 14:50:45', '0000-00-00 00:00:00', 1, 'text'),
(132, 0, 'HK AL SADIQ & SONS', '', '', '', '', '', '', '', '', '2020-11-25 15:44:26', '0000-00-00 00:00:00', 1, 'text'),
(133, 0, 'ENERGY SUPPLY AND SERVICES COMPANY', '', '', '', '', '', '', '', '', '2020-11-29 11:51:37', '0000-00-00 00:00:00', 1, 'text'),
(134, 0, 'Abc', '', '', '', '', '', '', '', '', '2022-02-25 10:28:45', '0000-00-00 00:00:00', 1, 'text'),
(135, 0, 'xyz', '', '', '', '', '', '', '', '', '2022-02-25 10:28:45', '0000-00-00 00:00:00', 1, 'text');

-- --------------------------------------------------------

--
-- Table structure for table `mst_supplier`
--

DROP TABLE IF EXISTS `mst_supplier`;
CREATE TABLE IF NOT EXISTS `mst_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `supplier_name` text NOT NULL,
  `contact_person` text NOT NULL,
  `address` text NOT NULL,
  `vat_no` text NOT NULL,
  `country` text NOT NULL,
  `telephone` text NOT NULL,
  `mobile` text NOT NULL,
  `fax` text NOT NULL,
  `email` text NOT NULL,
  `remarks` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `IsActive` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mst_supplier`
--

INSERT INTO `mst_supplier` (`id`, `code`, `supplier_name`, `contact_person`, `address`, `vat_no`, `country`, `telephone`, `mobile`, `fax`, `email`, `remarks`, `created_at`, `updated_at`, `IsActive`) VALUES
(1, 1, 'Wadi Al Noor Cargo FZC', 'ADEEL AHMED', 'Dubai', '', 'UAE', '', '0097152 1488816', '', 'adeellive@gmail.com', '', '2020-09-15 10:21:23', '2020-09-14 22:21:03', 1),
(2, 2, 'HWASIN SHIPPING & AIRCARGO CO., LTD (KOREA)', 'SY SHIN ', 'Busan', '000', 'South Korea', '0082-51-465-6615 ', '', '0082-51-741-5724', 'syshin@seke.co.kr', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(3, 3, 'Etex Logistic S.r.l', 'Luca Monfrini', 'Via Socrate', '000', 'Italy', '+ 39 031 3529166   +39 031 4560232', '', '+39 031 396214', 'monfrini@etexlogistic.com', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(4, 4, 'LIT Air & Sea GmbH', ' A. Tim Weykenat', 'Bremen/Deutschland', '000', 'Germany', '+49 421 80710-138', '', '+49 421 80710-027', 'tim.weykenat@lit.de', '', '2020-10-28 12:25:08', '2020-10-27 21:55:08', 1),
(5, 5, 'VELOCITY Global Logistics Pvt. Ltd.', 'Smith Nagda', 'Mumbai - 400 009', '000', 'India', '00-91-22-6631-0094 / 6654-6678/ 79', '+91 9920751443', '00-91-22-6631-0095', 'smit@velocitygl.com', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(6, 6, 'Blue Wing Global Freight Pvt Ltd', 'Jitendra Trigunayat', 'Mumbai', '000', 'India', '+91 9504280428', '+91 9664742230', '', 'jitendra@bluewingglobal.com', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(7, 7, 'Francesco Parisi Casa di Spedizioni S.p.A', 'Simone Vaglica', 'Milano', '000', 'Italy', '+39 02 92393351', '', '', 'simone.vaglica@francescoparisi.com', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(8, 8, 'CHAIN LOGISTICS', 'Murat Ozakdag', 'NJ 07644 ', '000', 'United States', '+1 973 272 6727 Ext:1040&1130 ', '', '+1 973 272 6733', 'airexport@chainlogistics.com', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(9, 9, 'Nordic Shipping Canada Ltd', 'Sammir Manjrekar', ' Mississauga ON L5A 3X2', '000', 'Canada', ' +1-905-461-3804 | +1-647-269-7386', '', '', 'sammir@nordiccanada.com', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(10, 10, 'Globe Success Internation Transportation (Shenzhen', ' Chloe Huang', 'Shenzhen', '000', 'China', '0086-755-82145368-5581', '0086-18316569671', '', 'OVSTP1@globesuccess.com.cn', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(11, 11, 'AL JAWHRA TRADING', '', '', '30064656300003', 'Saudi Arabia', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(12, 12, 'ASAT CUSTOMS CLEARANCE', '', '', '310073744300003', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(13, 13, 'SAUDI CUSTOMS', '', '', '0', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(14, 14, 'EXPEDITING', '', '', '0', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(15, 15, 'ADVANTAGE WORLDWIDE (UK).LTD ', 'ROGER', 'LONDON HEATHROW \r\nUNIT 11 BROOK LANDS CLOSE\r\nMIDDLE SEX', '', 'UNITED KINGDOM', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(16, 16, 'LOCAL SUPPLIER', '', '', '0', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(17, 10, 'KHONAINI CLEARANCE', 'JENEESH', '', '0', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(18, 10, 'TRANSPEED CARGO PTE LTD', '', '', '0', 'SINGAPORE', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(19, 17, 'TRANS BUSINESS INTERNATIONAL', '', '', '0', 'FRANCE', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(20, 18, 'AJ WORLDWIDE SERVICES INC.', '', '', '0', 'USA', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(21, 19, 'BARKER & HOOD GLOBAL LOGISTICS', '', '', '0', 'UNITED KINGDOM', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(22, 20, 'ALOUFI LOGISTICS SERVICES', '', '', '0', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(23, 21, 'ALI GASHASH AL OMARI TRADING EST', '', '', '0', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(24, 22, 'DHL EXPRESS', '', '', '0', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(25, 23, 'GLOBE SKY LOGISTICS COMPANY LIMITED', '', '', '0', 'HONGKONG', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(26, 24, 'AIR CARGO.NL', '', '', 'NL816027821B01', 'NETHERLAND', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(27, 25, 'IMPO FREIGHT PVT LTD', 'SHAMIK', 'INDIA', '27AAFC12203M1ZN', 'INDIA', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(28, 26, 'EMBASSY FREIGHT', 'ALBERTO', 'ITALY', '01523940359', 'ITALY', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(29, 27, 'CARGO SERVICES PAMPLONA ,S.A.U', '', '', '0000658000', 'SPAIN', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(30, 28, 'SOLEX LOGISTICS (SINGAPORE) PTE LTD', 'XAVIER', '', '199701597H', 'SINGAPORE', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(31, 29, 'NUCAF COMMERCIAL SERVICES OFFICE', 'THOUSEEF', '', '300590083900003', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(32, 30, 'FAST FORWARDING LOGISTICS INDIA PVT LTD', '', '', '27AACCF2972P2Z2', 'INDIA', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(33, 31, 'DENY CARGO B.V.B.A - S.P.R.L', 'KAREN', '', '41', 'BELGIUM', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(34, 32, 'INTERCARGO S.A', '', '', 'FR 44 334 749 371', 'FRANCE', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(35, 33, 'Daxel Italy Srl  Logistics & Solutions', 'MARCO', 'ITALY', '03319071209', 'ITALY', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(36, 34, 'TSI INTERNATIONAL SPEDITION UND HANDELS GMBH', '', '', '27/655/01643', 'GERMANY', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(37, 35, 'VELOCITY GLOBAL LOGISTICS (HONGKONG)LIMITED', 'SANDY', 'CHINA', 'NIL', 'CHINA', '', '', '', '', '', '2020-06-24 13:04:48', '2020-06-24 13:04:48', 1),
(38, 36, 'AJ WORLD WIDE SERVICES LIMITED U.K', 'ANTONY', '', '745115840', 'UNITED KINGDOM', '', '', '', '', '', '2020-06-24 13:04:49', '2020-06-24 13:04:49', 1),
(39, 37, 'RAKAEZ', '', '', 'NIL', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 13:04:49', '2020-06-24 13:04:49', 1),
(40, 38, 'Bertling', '', '', '00', 'swedan', '', '', '', '', '', '2020-06-24 13:04:49', '2020-06-24 13:04:49', 1),
(41, 39, 'Schafer & SIS internationale speditions - Gmbh', '', '', '00', 'germany', '', '', '', '', '', '2020-06-24 13:04:49', '2020-06-24 13:04:49', 1),
(42, 40, 'ACCORD PILOT LOGISTICS (THAILAND)CO.LTD', '', '', 'NIL', 'THAILAND', '', '', '', '', '', '2020-06-24 13:04:49', '2020-06-24 13:04:49', 1),
(43, 41, 'TRADE LOGISTICS', '', '', '00', 'SLOVENIA', '', '', '', '', '', '2020-06-24 13:04:49', '2020-06-24 13:04:49', 1),
(44, 42, 'NINGBO STAR ALLIANCE INTERNATIONAL LOGISTICS CO. L', '', '', '00', 'NINGBO', '', '', '', '', '', '2020-06-24 13:04:49', '2020-06-24 13:04:49', 1),
(45, 43, 'AIRLOG GROUP', 'MARTIN', '', 'SA300417066100', 'NORWAY', '', '', '', '', '', '2020-06-24 13:04:49', '2020-06-24 13:04:49', 1),
(46, 44, 'FAST LOGISTICS', '', '', '00', 'DUBAI', '', '', '', '', '', '2020-06-24 13:04:49', '2020-06-24 13:04:49', 1),
(47, 45, 'SOLUTION MAKERS ', 'WERDANI', 'DAMMAM', '300417066100003', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 13:04:49', '2020-06-24 13:04:49', 1),
(48, 46, 'EXPEDITING GAS ANAS/MOHAN', '', '', 'gas ', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 13:04:49', '2020-06-24 13:04:49', 1),
(49, 47, 'EXPEDITING GAS / ZAHEER TRANSPORTATION', '', '', 'EXPEDITING GAS ZAHEER', 'SAUDI ARABIA', '', '', '', '', '', '2020-06-24 13:04:49', '2020-06-24 13:04:49', 1),
(50, 48, 'OMEGA GLOBAL LOGISTICS', 'SHARATH', '', '0210000021', 'USA', '', '', '', '', '', '2020-07-16 17:18:47', '2020-07-16 17:18:47', 1),
(51, 49, 'FLEETLANE LOGISTICS ESTABLISHMENT', '', '', '300397771800003', 'SAUDI ARABIA', '', '', '', '', '', '2020-11-16 07:24:40', '2020-11-16 04:54:39', 1),
(52, 50, 'QINDAO MAGA INTERNATIONAL LOGISTICS CO., LTD', '', '', '', 'CHINA', '', '', '', '', '', '2020-07-16 17:18:47', '2020-07-16 17:18:47', 1),
(53, 51, 'DYNAMIC FORWARDING ', '', '', 'ART 44', 'NETHERLAND', '', '', '', '', '', '2020-07-16 17:18:47', '2020-07-16 17:18:47', 1),
(54, 52, 'DISBROQUER', '', '', '0000000000000005', 'SPAIN', '', '', '', '', '', '2020-08-05 14:27:12', '2020-08-05 14:27:12', 1),
(55, 53, 'SABER JITHIN', '', '', 'SABER JITHIN ', 'SAUDI ARABIA', '', '', '', '', '', '2020-08-05 14:27:12', '2020-08-05 14:27:12', 1),
(56, 54, 'DARWIN EXPEDITING', '', '', 'DARWIN EXPEDITING', 'SAUDI ARABIA', '', '', '', '', '', '2020-08-05 14:27:12', '2020-08-05 14:27:12', 1),
(58, 55, 'FREIGHT EXPERT INC (FEI)', '', '', '', 'JAPAN', '', '', '', '', '', '2020-10-03 23:54:13', '0000-00-00 00:00:00', 1),
(59, 56, 'PHOENIX LOGISTICS INDIA PVT LTD', '', '', '', 'INDIA', '', '', '', '', '', '2020-10-03 23:55:31', '0000-00-00 00:00:00', 1),
(60, 57, 'UNICORN SHIPPING & LOGISTICS', '', '', '', 'INDIA', '', '', '', '', '', '2020-10-03 23:56:32', '0000-00-00 00:00:00', 1),
(61, 58, 'PACIFIC LOGISTICS SOLUTION', '', 'DAMMAM', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-10-05 19:31:35', '0000-00-00 00:00:00', 1),
(62, 59, 'MY BUSINESS SERVICES (144)', '', 'SAUDI ARABIA', '', 'KSA', '', '', '', '', 'BILLER NO : 144', '2020-10-10 05:05:44', '0000-00-00 00:00:00', 1),
(63, 60, 'SEKE SHIPPING & AIR CARGO CO., LTD', '', 'KOREA', '', 'KOREA', '', '', '', '', '', '2020-10-12 04:20:27', '0000-00-00 00:00:00', 1),
(64, 61, 'ALLTRANS WORLDWIDE LOGISTICS', '', 'ITALY', '', 'ITALY', '', '', '', '', '', '2020-10-12 04:25:04', '0000-00-00 00:00:00', 1),
(65, 62, 'SALIH SABER', '', 'DAMMAM', '', 'KSA', '', '', '', '', '', '2020-10-18 05:49:53', '0000-00-00 00:00:00', 1),
(66, 63, 'SAL : Saudia Cargo Company', '', 'Dammam', '', 'Saudi Arabia', '', '', '', '', '', '2020-10-19 12:31:50', '2020-10-18 22:01:49', 1),
(67, 64, 'PGL', '', '', '', 'USA', '', '', '', '', '', '2020-10-31 05:55:01', '0000-00-00 00:00:00', 1),
(68, 65, 'AL KATHA CUSTOMS CLEARANCE', '', 'DAMMAM', '', 'SAUDI ARABIA', '', '', '', '', '', '2020-11-04 20:45:05', '0000-00-00 00:00:00', 1),
(69, 66, 'FRANCE CARGO INTERATIONAL CIE', '', '', '', 'FRACE', '', '', '', '', '', '2020-11-07 05:45:39', '0000-00-00 00:00:00', 1),
(70, 67, 'MOHMED A.AL ATTAS CONTRACTING EST.', '', 'JEDDAH', '', '', '', '', '', '', '', '2020-11-22 21:03:24', '0000-00-00 00:00:00', 1),
(71, 68, 'ABDULHADI AL JAHANI OFFICE CUSTOMS CLEARANCE', '', 'DAMMAM', '', '', '', '', '', '', '', '2020-11-24 21:26:25', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_transaction_job`
--

DROP TABLE IF EXISTS `mst_transaction_job`;
CREATE TABLE IF NOT EXISTS `mst_transaction_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  `code` text NOT NULL,
  `date` datetime NOT NULL,
  `shipper_name` text NOT NULL,
  `consignee_name` text NOT NULL,
  `client_name` text NOT NULL,
  `shipment_type` text NOT NULL,
  `shipment_terms` text NOT NULL,
  `cargo_description` text NOT NULL,
  `origin` text NOT NULL,
  `destination` text NOT NULL,
  `etd` text NOT NULL,
  `eta` text NOT NULL,
  `carrier` text NOT NULL,
  `po_no` text NOT NULL,
  `mawb` text NOT NULL,
  `hawb` text NOT NULL,
  `no_pcs` text NOT NULL,
  `actual_weight` text NOT NULL,
  `chargeable_weight` text NOT NULL,
  `dimension` text NOT NULL,
  `pol` text NOT NULL,
  `pod` text NOT NULL,
  `mbl` text NOT NULL,
  `hbl` text NOT NULL,
  `cont_type` text NOT NULL,
  `no_containers` text NOT NULL,
  `container_no` text NOT NULL,
  `weight` text NOT NULL,
  `truck_no` text NOT NULL,
  `bayan_no` text NOT NULL,
  `bayan_date` datetime NOT NULL,
  `status` text NOT NULL,
  `job_status` text NOT NULL,
  `pop` text NOT NULL,
  `lab_understanding` text NOT NULL,
  `docs_guarantee` text NOT NULL,
  `description` text NOT NULL,
  `salesman` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mst_truck`
--

DROP TABLE IF EXISTS `mst_truck`;
CREATE TABLE IF NOT EXISTS `mst_truck` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `truck` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `IsActive` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_truck`
--

INSERT INTO `mst_truck` (`id`, `truck`, `created_at`, `updated_at`, `IsActive`) VALUES
(1, 'Van', '2021-08-03 11:56:08', '2021-08-03 23:56:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_users`
--

DROP TABLE IF EXISTS `mst_users`;
CREATE TABLE IF NOT EXISTS `mst_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `remember_token` text NOT NULL,
  `last_logged_in_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `enabled` text NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` datetime(6) NOT NULL,
  `user_image` text NOT NULL,
  `locale` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_users`
--

INSERT INTO `mst_users` (`id`, `user_name`, `email`, `password`, `remember_token`, `last_logged_in_at`, `enabled`, `created_at`, `updated_at`, `user_image`, `locale`) VALUES
(4, 'Ferryfolks Admin', 'admin@ferryfolks.com', '123', '4690606063', '2022-02-23 09:47:51.478681', '1', '2019-12-26 17:14:59', '2021-11-10 15:05:38.000000', '1636538738user-image.png', 'english'),
(8, 'Shahabaz Siraj Ahmed', 'operations@ferryfolks.com', 'ferryfolks123.', '', '2021-11-10 10:06:22.925931', '0', '2020-10-03 15:10:50', '2021-11-10 15:06:22.000000', '1636538782user-image.png', 'english'),
(9, 'zuhin ', 'zuhin@ferryfolks.com', 'password@ferryfolks', '', '2021-11-10 10:06:53.135154', '0', '2020-10-03 15:16:08', '2021-11-10 15:06:53.000000', '1636538813user-image.png', 'english');

-- --------------------------------------------------------

--
-- Table structure for table `mst_user_companies`
--

DROP TABLE IF EXISTS `mst_user_companies`;
CREATE TABLE IF NOT EXISTS `mst_user_companies` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `user_type` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mst_user_permissions`
--

DROP TABLE IF EXISTS `mst_user_permissions`;
CREATE TABLE IF NOT EXISTS `mst_user_permissions` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_id` int(11) NOT NULL,
  `user_type` date NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mst_user_roles`
--

DROP TABLE IF EXISTS `mst_user_roles`;
CREATE TABLE IF NOT EXISTS `mst_user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_type` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mst_user_roles`
--

INSERT INTO `mst_user_roles` (`user_id`, `role_id`, `user_type`) VALUES
(4, 1, 'user'),
(5, 2, 'user'),
(6, 1, 'Admin'),
(7, 1, 'user'),
(8, 1, 'user'),
(9, 1, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `n_e_employee_details`
--

DROP TABLE IF EXISTS `n_e_employee_details`;
CREATE TABLE IF NOT EXISTS `n_e_employee_details` (
  `employeeid` int(11) NOT NULL AUTO_INCREMENT,
  `employee_code` text COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `employee_phone` text COLLATE utf8_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL,
  PRIMARY KEY (`employeeid`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `n_e_employee_details`
--

INSERT INTO `n_e_employee_details` (`employeeid`, `employee_code`, `name`, `employee_phone`, `is_active`) VALUES
(21, '1', 'MAnu', '7845963215', 1);

-- --------------------------------------------------------

--
-- Table structure for table `n_v_vehicledetails`
--

DROP TABLE IF EXISTS `n_v_vehicledetails`;
CREATE TABLE IF NOT EXISTS `n_v_vehicledetails` (
  `vehicleid` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_code` text NOT NULL,
  `Vehicle_number` text NOT NULL,
  `vehicle_manufactur` text NOT NULL,
  `vehicle_model` text NOT NULL,
  `vehicle_category` text NOT NULL,
  `ownershipdetails` text NOT NULL,
  `is_active` int(11) NOT NULL,
  `closed_narration` text NOT NULL,
  `purchase_date` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`vehicleid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `n_v_vehicledetails`
--

INSERT INTO `n_v_vehicledetails` (`vehicleid`, `vehicle_code`, `Vehicle_number`, `vehicle_manufactur`, `vehicle_model`, `vehicle_category`, `ownershipdetails`, `is_active`, `closed_narration`, `purchase_date`, `created_date`) VALUES
(10, '1', 'KL12545', 'Abc A', '45', 'Xy', 'Ad', 1, '', '20-08-2020', '2022-03-07 10:57:46');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
